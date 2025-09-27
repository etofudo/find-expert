"""
LinkedIn job scraper
"""

import asyncio
import logging
from typing import List, Dict
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

from .base_scraper import BaseScraper
from ..core.config import settings

logger = logging.getLogger(__name__)

class LinkedInScraper(BaseScraper):
    def __init__(self):
        super().__init__()
        self.base_url = "https://www.linkedin.com/jobs/search"
    
    async def _search_jobs_impl(self, keywords: List[str], location: str) -> List[Dict]:
        """Search LinkedIn jobs"""
        jobs = []
        
        try:
            # Navigate to LinkedIn jobs
            self.driver.get(self.base_url)
            self.anti_detection.random_wait(2, 4)
            
            # Search for jobs
            search_keywords = " ".join(keywords)
            await self._perform_search(search_keywords, location)
            
            # Extract job listings
            jobs = await self._extract_job_listings()
            
            logger.info(f"Found {len(jobs)} jobs on LinkedIn")
            
        except Exception as e:
            logger.error(f"Error searching LinkedIn jobs: {e}")
        
        return jobs
    
    async def _perform_search(self, keywords: str, location: str):
        """Perform job search on LinkedIn"""
        try:
            # Wait for search box
            search_box = self.wait_for_element(By.CSS_SELECTOR, "input[aria-label*='Search jobs']")
            if not search_box:
                search_box = self.wait_for_element(By.CSS_SELECTOR, "input[placeholder*='Search jobs']")
            
            if search_box:
                self.safe_send_keys(search_box, keywords)
                self.anti_detection.random_wait(1, 2)
                
                # Search
                search_box.send_keys(Keys.RETURN)
                self.anti_detection.random_wait(3, 5)
            
            # Filter by location if needed
            if location and location != "Lagos, Nigeria":
                await self._filter_by_location(location)
            
            # Filter by time posted (last 5 hours)
            await self._filter_by_time()
            
        except Exception as e:
            logger.error(f"Error performing LinkedIn search: {e}")
    
    async def _filter_by_location(self, location: str):
        """Filter jobs by location"""
        try:
            # Click location filter
            location_filter = self.wait_for_element(By.CSS_SELECTOR, "button[aria-label*='Location']")
            if location_filter:
                self.safe_click(location_filter)
                self.anti_detection.random_wait(1, 2)
                
                # Enter location
                location_input = self.wait_for_element(By.CSS_SELECTOR, "input[placeholder*='City, state, or zip code']")
                if location_input:
                    self.safe_send_keys(location_input, location)
                    self.anti_detection.random_wait(1, 2)
                    location_input.send_keys(Keys.RETURN)
                    self.anti_detection.random_wait(2, 3)
                    
        except Exception as e:
            logger.warning(f"Location filter failed: {e}")
    
    async def _filter_by_time(self):
        """Filter jobs by time posted (last 5 hours)"""
        try:
            # Click time filter
            time_filter = self.wait_for_element(By.CSS_SELECTOR, "button[aria-label*='Date posted']")
            if time_filter:
                self.safe_click(time_filter)
                self.anti_detection.random_wait(1, 2)
                
                # Select "Past 24 hours" or similar
                past_24h = self.wait_for_element(By.CSS_SELECTOR, "label[for*='past-24-hours']")
                if past_24h:
                    self.safe_click(past_24h)
                    self.anti_detection.random_wait(2, 3)
                    
        except Exception as e:
            logger.warning(f"Time filter failed: {e}")
    
    async def _extract_job_listings(self) -> List[Dict]:
        """Extract job listings from LinkedIn"""
        jobs = []
        
        try:
            # Wait for job listings to load
            self.anti_detection.random_wait(3, 5)
            
            # Scroll to load more jobs
            for _ in range(3):
                self.driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
                self.anti_detection.random_wait(2, 3)
            
            # Find job cards
            job_cards = self.driver.find_elements(By.CSS_SELECTOR, "div[data-job-id]")
            
            for card in job_cards[:20]:  # Limit to first 20 jobs
                try:
                    job_data = await self._extract_job_data(card)
                    if job_data and self._is_suitable_job(job_data):
                        jobs.append(job_data)
                except Exception as e:
                    logger.warning(f"Error extracting job data: {e}")
                    continue
            
        except Exception as e:
            logger.error(f"Error extracting job listings: {e}")
        
        return jobs
    
    async def _extract_job_data(self, card) -> Dict:
        """Extract data from a job card"""
        try:
            # Click on job card to get details
            self.safe_click(card)
            self.anti_detection.random_wait(2, 3)
            
            # Extract job details
            job_data = {
                "job_title": "",
                "company_name": "",
                "job_url": "",
                "location": "",
                "salary_range": "",
                "job_description": "",
                "job_site": "linkedin"
            }
            
            # Job title
            title_element = self.wait_for_element(By.CSS_SELECTOR, "h1.job-title")
            if title_element:
                job_data["job_title"] = title_element.text.strip()
            
            # Company name
            company_element = self.wait_for_element(By.CSS_SELECTOR, "a[data-tracking-control-name*='company']")
            if company_element:
                job_data["company_name"] = company_element.text.strip()
            
            # Job URL
            job_data["job_url"] = self.driver.current_url
            
            # Location
            location_element = self.wait_for_element(By.CSS_SELECTOR, "span[data-tracking-control-name*='location']")
            if location_element:
                job_data["location"] = location_element.text.strip()
            
            # Salary (if available)
            salary_element = self.wait_for_element(By.CSS_SELECTOR, "span[data-tracking-control-name*='salary']")
            if salary_element:
                job_data["salary_range"] = salary_element.text.strip()
            
            # Job description
            desc_element = self.wait_for_element(By.CSS_SELECTOR, "div.job-description")
            if desc_element:
                job_data["job_description"] = desc_element.text.strip()
            
            return job_data
            
        except Exception as e:
            logger.warning(f"Error extracting job data: {e}")
            return None
    
    def _is_suitable_job(self, job_data: Dict) -> bool:
        """Check if job is suitable based on criteria"""
        # Check salary
        if job_data.get("salary_range"):
            salary_text = job_data["salary_range"].lower()
            if "₦" in salary_text or "ngn" in salary_text:
                # Extract numeric value and check if >= 600,000
                import re
                numbers = re.findall(r'[\d,]+', salary_text)
                if numbers:
                    try:
                        # Convert to integer (remove commas)
                        salary = int(numbers[0].replace(',', ''))
                        if salary < settings.min_salary:
                            return False
                    except:
                        pass
        
        # Check location
        location = job_data.get("location", "").lower()
        if not any(loc in location for loc in ["lagos", "nigeria", "remote"]):
            return False
        
        # Check job title for legal keywords
        title = job_data.get("job_title", "").lower()
        legal_keywords = ["legal", "lawyer", "attorney", "counsel", "compliance"]
        if not any(keyword in title for keyword in legal_keywords):
            return False
        
        return True
    
    async def _apply_to_job_impl(self, job_url: str, cover_letter: str, candidate_info: Dict) -> bool:
        """Apply to a LinkedIn job"""
        try:
            # Navigate to job URL
            self.driver.get(job_url)
            self.anti_detection.random_wait(3, 5)
            
            # Click apply button
            apply_button = self.wait_for_element(By.CSS_SELECTOR, "button[data-tracking-control-name*='apply']")
            if not apply_button:
                apply_button = self.wait_for_element(By.CSS_SELECTOR, "button[aria-label*='Apply']")
            
            if apply_button:
                self.safe_click(apply_button)
                self.anti_detection.random_wait(2, 3)
                
                # Fill application form
                success = await self._fill_application_form(cover_letter, candidate_info)
                return success
            
            return False
            
        except Exception as e:
            logger.error(f"Error applying to LinkedIn job: {e}")
            return False
    
    async def _fill_application_form(self, cover_letter: str, candidate_info: Dict) -> bool:
        """Fill LinkedIn application form"""
        try:
            # Fill name
            name_input = self.wait_for_element(By.CSS_SELECTOR, "input[name*='name']")
            if name_input:
                self.safe_send_keys(name_input, candidate_info["name"])
            
            # Fill email
            email_input = self.wait_for_element(By.CSS_SELECTOR, "input[name*='email']")
            if email_input:
                self.safe_send_keys(email_input, candidate_info["email"])
            
            # Fill phone
            phone_input = self.wait_for_element(By.CSS_SELECTOR, "input[name*='phone']")
            if phone_input:
                self.safe_send_keys(phone_input, candidate_info["phone"])
            
            # Fill cover letter
            cover_letter_textarea = self.wait_for_element(By.CSS_SELECTOR, "textarea[name*='cover']")
            if cover_letter_textarea:
                self.safe_send_keys(cover_letter_textarea, cover_letter)
            
            # Submit application
            submit_button = self.wait_for_element(By.CSS_SELECTOR, "button[type='submit']")
            if submit_button:
                self.safe_click(submit_button)
                self.anti_detection.random_wait(3, 5)
                return True
            
            return False
            
        except Exception as e:
            logger.error(f"Error filling application form: {e}")
            return False

# Celery task
from ..core.scheduler import celery_app

@celery_app.task
def scrape_linkedin_jobs():
    """Celery task for scraping LinkedIn jobs"""
    scraper = LinkedInScraper()
    asyncio.run(scraper.search_jobs(settings.job_keywords, "Lagos, Nigeria"))
