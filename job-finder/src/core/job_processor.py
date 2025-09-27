"""
Job application processor with anti-detection measures
"""

import asyncio
import random
import logging
from datetime import datetime
from typing import List, Dict
from celery import Celery

from .config import settings
from .database import SessionLocal, JobApplication
from .anti_detection import AntiDetectionManager
from ..ai.cover_letter_generator import CoverLetterGenerator
from ..scrapers.base_scraper import BaseScraper

logger = logging.getLogger(__name__)

class JobProcessor:
    def __init__(self):
        self.anti_detection = AntiDetectionManager()
        self.cover_letter_generator = CoverLetterGenerator()
        self.db = SessionLocal()
    
    async def process_job_applications(self):
        """Process pending job applications"""
        try:
            # Get pending applications
            pending_jobs = self.db.query(JobApplication).filter(
                JobApplication.application_status == "pending"
            ).limit(settings.applications_per_hour).all()
            
            logger.info(f"Processing {len(pending_jobs)} job applications...")
            
            for job in pending_jobs:
                try:
                    await self.apply_to_job(job)
                    await asyncio.sleep(random.uniform(
                        settings.random_delay_min,
                        settings.random_delay_max
                    ))
                except Exception as e:
                    logger.error(f"Failed to apply to job {job.id}: {e}")
                    job.retry_count += 1
                    if job.retry_count >= 3:
                        job.application_status = "failed"
                    self.db.commit()
            
        except Exception as e:
            logger.error(f"Error processing job applications: {e}")
        finally:
            self.db.close()
    
    async def apply_to_job(self, job: JobApplication):
        """Apply to a specific job"""
        logger.info(f"Applying to job: {job.job_title} at {job.company_name}")
        
        # Generate cover letter
        cover_letter = await self.cover_letter_generator.generate_cover_letter(
            job_title=job.job_title,
            company_name=job.company_name,
            job_description=job.job_description
        )
        
        # Apply using appropriate scraper
        scraper = self.get_scraper_for_site(job.job_site)
        if scraper:
            success = await scraper.apply_to_job(
                job_url=job.job_url,
                cover_letter=cover_letter,
                candidate_info={
                    "name": settings.candidate_name,
                    "email": settings.candidate_email,
                    "phone": settings.candidate_phone
                }
            )
            
            if success:
                job.application_status = "applied"
                job.cover_letter = cover_letter
                job.applied_at = datetime.utcnow()
                logger.info(f"Successfully applied to {job.job_title}")
            else:
                job.application_status = "failed"
                logger.error(f"Failed to apply to {job.job_title}")
        else:
            logger.error(f"No scraper found for job site: {job.job_site}")
            job.application_status = "failed"
        
        self.db.commit()
    
    def get_scraper_for_site(self, job_site: str):
        """Get appropriate scraper for job site"""
        scraper_map = {
            "linkedin": "LinkedInScraper",
            "indeed": "IndeedScraper",
            "jobberman": "JobbermanScraper",
            "myjobmag": "MyJobMagScraper",
            "greenhouse": "GreenhouseScraper"
        }
        
        scraper_class = scraper_map.get(job_site.lower())
        if scraper_class:
            # Import and return scraper instance
            from ..scrapers import get_scraper
            return get_scraper(scraper_class)
        return None

# Celery task
from .scheduler import celery_app

@celery_app.task
def process_job_applications():
    """Celery task for processing job applications"""
    processor = JobProcessor()
    asyncio.run(processor.process_job_applications())
