"""
Background task scheduler for job applications
"""

import asyncio
import logging
from datetime import datetime, timedelta
from celery import Celery
from celery.schedules import crontab

from .config import settings

logger = logging.getLogger(__name__)

# Celery app
celery_app = Celery(
    "job_finder",
    broker=settings.redis_url,
    backend=settings.redis_url
)

# Configure Celery
celery_app.conf.update(
    task_serializer='json',
    accept_content=['json'],
    result_serializer='json',
    timezone='Africa/Lagos',
    enable_utc=True,
)

# Import tasks
from src.scrapers.linkedin_scraper_auth import LinkedInScraperAuth
from src.scrapers.indeed_scraper import scrape_indeed_jobs
from src.scrapers.jobberman_scraper import scrape_jobberman_jobs
from src.scrapers.myjobmag_scraper import scrape_myjobmag_jobs
from src.scrapers.greenhouse_scraper import scrape_greenhouse_jobs
from src.core.job_processor import process_job_applications

@celery_app.task
def scheduled_job_search():
    """Scheduled job search task"""
    logger.info("Starting scheduled job search...")
    
    # Run all enabled scrapers
    if settings.linkedin_enabled:
        scrape_linkedin_jobs_auth.delay()
    
    if settings.indeed_enabled:
        scrape_indeed_jobs.delay()
    
    if settings.jobberman_enabled:
        scrape_jobberman_jobs.delay()
    
    if settings.myjobmag_enabled:
        scrape_myjobmag_jobs.delay()
    
    if settings.greenhouse_enabled:
        scrape_greenhouse_jobs.delay()

@celery_app.task
def scrape_linkedin_jobs_auth():
    """Celery task for scraping LinkedIn jobs with authentication"""
    async def run_scraper():
        async with LinkedInScraperAuth() as scraper:
            jobs = await scraper.search_jobs(settings.job_keywords, "Remote")
            logger.info(f"Found {len(jobs)} LinkedIn jobs")
            return jobs
    
    return asyncio.run(run_scraper())

@celery_app.task
def process_applications():
    """Process pending job applications"""
    logger.info("Processing job applications...")
    process_job_applications.delay()

# Schedule tasks
celery_app.conf.beat_schedule = {
    'job-search-every-30-minutes': {
        'task': 'src.core.scheduler.scheduled_job_search',
        'schedule': crontab(minute='*/30'),  # Every 30 minutes
    },
    'process-applications-every-5-minutes': {
        'task': 'src.core.scheduler.process_applications',
        'schedule': crontab(minute='*/5'),  # Every 5 minutes
    },
}

async def start_scheduler():
    """Start the background scheduler"""
    logger.info("Starting background scheduler...")
    # Celery beat will be started separately
    pass
