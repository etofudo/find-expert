"""
LinkedIn Job Scraper with Authentication
"""

import asyncio
import logging
import random
import time
from typing import Dict, List, Optional
from playwright.async_api import async_playwright, Browser, Page
from ..core.config import settings

logger = logging.getLogger(__name__)

class LinkedInScraperAuth:
    def __init__(self):
        self.browser: Optional[Browser] = None
        self.page: Optional[Page] = None
        self.is_logged_in = False
        
    async def __aenter__(self):
        await self.start_browser()
        return self
        
    async def __aexit__(self, exc_type, exc_val, exc_tb):
        await self.close_browser()
    
    async def start_browser(self):
        """Start browser with authentication"""
        try:
            playwright = await async_playwright().start()
            self.browser = await playwright.chromium.launch(
                headless=False,  # Set to True for production
                args=[
                    '--no-sandbox',
                    '--disable-blink-features=AutomationControlled',
                    '--disable-web-security',
                    '--disable-features=VizDisplayCompositor'
                ]
            )
            
            # Create new context with realistic settings
            context = await self.browser.new_context(
                viewport={'width': 1920, 'height': 1080},
                user_agent=random.choice(settings.user_agents),
                locale='en-US',
                timezone_id='America/New_York'
            )
            
            self.page = await context.new_page()
            
            # Add stealth measures
            await self.page.add_init_script("""
                Object.defineProperty(navigator, 'webdriver', {
                    get: () => undefined,
                });
            """)
            
            await self.login()
            
        except Exception as e:
            logger.error(f"Error starting browser: {e}")
            raise
    
    async def close_browser(self):
        """Close browser"""
        if self.browser:
            await self.browser.close()
    
    async def login(self):
        """Login to LinkedIn"""
        try:
            if not settings.linkedin_email or not settings.linkedin_password:
                logger.warning("LinkedIn credentials not provided")
                return False
            
            logger.info("Logging into LinkedIn...")
            
            # Go to LinkedIn login page
            await self.page.goto('https://www.linkedin.com/login')
            await self.page.wait_for_load_state('networkidle')
            
            # Fill in email
            await self.page.fill('input[name="session_key"]', settings.linkedin_email)
            await self.page.wait_for_timeout(random.randint(1000, 2000))
            
            # Fill in password
            await self.page.fill('input[name="session_password"]', settings.linkedin_password)
            await self.page.wait_for_timeout(random.randint(1000, 2000))
            
            # Click login button
            await self.page.click('button[type="submit"]')
            await self.page.wait_for_load_state('networkidle')
            
            # Check if login was successful
            if 'feed' in self.page.url or 'mynetwork' in self.page.url:
                self.is_logged_in = True
                logger.info("Successfully logged into LinkedIn")
                return True
            else:
                logger.error("LinkedIn login failed")
                return False
                
        except Exception as e:
            logger.error(f"Error logging into LinkedIn: {e}")
            return False
    
    async def search_jobs(self, keywords: List[str], location: str = "Remote") -> List[Dict]:
        """Search for jobs on LinkedIn"""
        if not self.is_logged_in:
            logger.error("Not logged into LinkedIn")
            return []
        
        try:
            jobs = []
            
            for keyword in keywords[:5]:  # Limit to first 5 keywords
                logger.info(f"Searching for jobs with keyword: {keyword}")
                
                # Navigate to jobs page
                search_url = f"https://www.linkedin.com/jobs/search/?keywords={keyword}&location={location}&f_TPR=r86400&f_WT=2"
                await self.page.goto(search_url)
                await self.page.wait_for_load_state('networkidle')
                
                # Wait for job listings to load
                await self.page.wait_for_selector('.jobs-search-results-list', timeout=10000)
                
                # Scroll to load more jobs
                await self._scroll_and_load_jobs()
                
                # Extract job data
                job_elements = await self.page.query_selector_all('.jobs-search-results__list-item')
                
                for element in job_elements[:10]:  # Limit to 10 jobs per keyword
                    try:
                        job_data = await self._extract_job_data(element, keyword)
                        if job_data:
                            jobs.append(job_data)
                    except Exception as e:
                        logger.error(f"Error extracting job data: {e}")
                        continue
                
                # Random delay between searches
                await self.page.wait_for_timeout(random.randint(3000, 8000))
            
            return jobs
            
        except Exception as e:
            logger.error(f"Error searching jobs: {e}")
            return []
    
    async def _scroll_and_load_jobs(self):
        """Scroll to load more job listings"""
        try:
            # Scroll down to load more jobs
            for _ in range(3):
                await self.page.evaluate('window.scrollTo(0, document.body.scrollHeight)')
                await self.page.wait_for_timeout(2000)
                
                # Check if "Show more" button exists and click it
                show_more_button = await self.page.query_selector('button[aria-label="Show more jobs"]')
                if show_more_button:
                    await show_more_button.click()
                    await self.page.wait_for_timeout(2000)
        except Exception as e:
            logger.error(f"Error scrolling and loading jobs: {e}")
    
    async def _extract_job_data(self, element, keyword: str) -> Optional[Dict]:
        """Extract job data from a job element"""
        try:
            # Click on job to get more details
            await element.click()
            await self.page.wait_for_timeout(2000)
            
            # Extract job title
            title_element = await element.query_selector('.job-card-list__title')
            title = await title_element.inner_text() if title_element else "N/A"
            
            # Extract company name
            company_element = await element.query_selector('.job-card-container__company-name')
            company = await company_element.inner_text() if company_element else "N/A"
            
            # Extract location
            location_element = await element.query_selector('.job-card-container__metadata-item')
            location = await location_element.inner_text() if location_element else "N/A"
            
            # Extract job description from the right panel
            description_element = await self.page.query_selector('.jobs-description-content__text')
            description = await description_element.inner_text() if description_element else "N/A"
            
            # Extract salary if available
            salary_element = await self.page.query_selector('.jobs-unified-top-card__job-insight')
            salary = await salary_element.inner_text() if salary_element else "N/A"
            
            # Extract job URL
            link_element = await element.query_selector('a[data-control-name="job_card_click"]')
            job_url = await link_element.get_attribute('href') if link_element else "N/A"
            
            # Check if job meets salary requirements
            if not self._meets_salary_requirements(salary):
                return None
            
            job_data = {
                'title': title.strip(),
                'company': company.strip(),
                'location': location.strip(),
                'description': description.strip(),
                'salary': salary.strip(),
                'url': job_url,
                'source': 'LinkedIn',
                'keyword': keyword,
                'posted_date': 'Recent',
                'employment_type': self._extract_employment_type(description)
            }
            
            return job_data
            
        except Exception as e:
            logger.error(f"Error extracting job data: {e}")
            return None
    
    def _meets_salary_requirements(self, salary_text: str) -> bool:
        """Check if job meets salary requirements"""
        if not salary_text or salary_text == "N/A":
            return True  # Apply if no salary info
        
        salary_text = salary_text.lower()
        
        # Look for salary numbers
        import re
        salary_numbers = re.findall(r'[\d,]+', salary_text)
        
        for number_str in salary_numbers:
            try:
                number = int(number_str.replace(',', ''))
                
                # Check if it's in USD (look for $ or USD)
                if '$' in salary_text or 'usd' in salary_text:
                    if number >= settings.min_salary_usd:
                        return True
                
                # Check if it's in NGN (look for ₦ or NGN)
                elif '₦' in salary_text or 'ngn' in salary_text:
                    if number >= settings.min_salary_ngn:
                        return True
                
                # If no currency specified, assume USD if number is high
                elif number >= settings.min_salary_usd:
                    return True
                    
            except ValueError:
                continue
        
        return True  # Apply if we can't determine salary
    
    def _extract_employment_type(self, description: str) -> str:
        """Extract employment type from job description"""
        description_lower = description.lower()
        
        if 'contract' in description_lower:
            return 'Contract'
        elif 'freelance' in description_lower:
            return 'Freelance'
        elif 'part-time' in description_lower:
            return 'Part-time'
        elif 'full-time' in description_lower:
            return 'Full-time'
        else:
            return 'Full-time'  # Default assumption
    
    async def apply_to_job(self, job_data: Dict) -> bool:
        """Apply to a job on LinkedIn"""
        try:
            if not self.is_logged_in:
                logger.error("Not logged into LinkedIn")
                return False
            
            # Navigate to job page
            await self.page.goto(job_data['url'])
            await self.page.wait_for_load_state('networkidle')
            
            # Look for apply button
            apply_button = await self.page.query_selector('button[data-control-name="jobdetails_topcard_inapply"]')
            if not apply_button:
                logger.warning(f"No apply button found for job: {job_data['title']}")
                return False
            
            # Click apply button
            await apply_button.click()
            await self.page.wait_for_timeout(2000)
            
            # Handle application form
            success = await self._fill_application_form(job_data)
            
            if success:
                logger.info(f"Successfully applied to: {job_data['title']} at {job_data['company']}")
            else:
                logger.warning(f"Failed to apply to: {job_data['title']} at {job_data['company']}")
            
            return success
            
        except Exception as e:
            logger.error(f"Error applying to job: {e}")
            return False
    
    async def _fill_application_form(self, job_data: Dict) -> bool:
        """Fill out the job application form"""
        try:
            # This is a simplified version - in practice, you'd need to handle
            # various form types and LinkedIn's application flow
            
            # Look for phone number field
            phone_field = await self.page.query_selector('input[name="phoneNumber"]')
            if phone_field:
                await phone_field.fill(settings.candidate_phone)
                await self.page.wait_for_timeout(1000)
            
            # Look for resume upload (if needed)
            resume_upload = await self.page.query_selector('input[type="file"]')
            if resume_upload:
                # Upload resume file
                resume_path = f"resumes/{settings.primary_resume}"
                await resume_upload.set_input_files(resume_path)
                await self.page.wait_for_timeout(2000)
            
            # Look for cover letter field
            cover_letter_field = await self.page.query_selector('textarea[name="coverLetter"]')
            if cover_letter_field:
                # Generate cover letter
                from ..ai.cover_letter_generator import CoverLetterGenerator
                generator = CoverLetterGenerator()
                cover_letter = await generator.generate_cover_letter(
                    job_data['title'], 
                    job_data['company'], 
                    job_data['description']
                )
                await cover_letter_field.fill(cover_letter)
                await self.page.wait_for_timeout(1000)
            
            # Submit application
            submit_button = await self.page.query_selector('button[type="submit"]')
            if submit_button:
                await submit_button.click()
                await self.page.wait_for_timeout(3000)
                return True
            
            return False
            
        except Exception as e:
            logger.error(f"Error filling application form: {e}")
            return False
