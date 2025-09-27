"""
Base scraper class for all job sites
"""

import asyncio
import logging
from abc import ABC, abstractmethod
from typing import List, Dict, Optional
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

from ..core.config import settings
from ..core.anti_detection import AntiDetectionManager

logger = logging.getLogger(__name__)

class BaseScraper(ABC):
    def __init__(self):
        self.anti_detection = AntiDetectionManager()
        self.driver = None
    
    def setup_driver(self) -> webdriver.Chrome:
        """Setup Chrome driver with anti-detection measures"""
        options = Options()
        
        # Anti-detection options
        options.add_argument("--no-sandbox")
        options.add_argument("--disable-dev-shm-usage")
        options.add_argument("--disable-blink-features=AutomationControlled")
        options.add_experimental_option("excludeSwitches", ["enable-automation"])
        options.add_experimental_option('useAutomationExtension', False)
        
        # Random user agent
        user_agent = self.anti_detection.get_random_user_agent()
        options.add_argument(f"--user-agent={user_agent}")
        
        # Random viewport
        viewport = self.anti_detection.get_random_viewport_size()
        options.add_argument(f"--window-size={viewport['width']},{viewport['height']}")
        
        # Additional options
        options.add_argument("--disable-extensions")
        options.add_argument("--disable-plugins")
        options.add_argument("--disable-images")
        options.add_argument("--disable-javascript")
        
        driver = webdriver.Chrome(options=options)
        
        # Execute anti-detection script
        driver.execute_script("Object.defineProperty(navigator, 'webdriver', {get: () => undefined})")
        
        return driver
    
    async def search_jobs(self, keywords: List[str], location: str = "Lagos, Nigeria") -> List[Dict]:
        """Search for jobs with given keywords and location"""
        try:
            self.driver = self.setup_driver()
            jobs = await self._search_jobs_impl(keywords, location)
            return jobs
        except Exception as e:
            logger.error(f"Error searching jobs: {e}")
            return []
        finally:
            if self.driver:
                self.driver.quit()
    
    async def apply_to_job(self, job_url: str, cover_letter: str, candidate_info: Dict) -> bool:
        """Apply to a specific job"""
        try:
            self.driver = self.setup_driver()
            success = await self._apply_to_job_impl(job_url, cover_letter, candidate_info)
            return success
        except Exception as e:
            logger.error(f"Error applying to job: {e}")
            return False
        finally:
            if self.driver:
                self.driver.quit()
    
    @abstractmethod
    async def _search_jobs_impl(self, keywords: List[str], location: str) -> List[Dict]:
        """Implementation-specific job search"""
        pass
    
    @abstractmethod
    async def _apply_to_job_impl(self, job_url: str, cover_letter: str, candidate_info: Dict) -> bool:
        """Implementation-specific job application"""
        pass
    
    def wait_for_element(self, by: By, value: str, timeout: int = 10):
        """Wait for element to be present"""
        try:
            element = WebDriverWait(self.driver, timeout).until(
                EC.presence_of_element_located((by, value))
            )
            return element
        except Exception as e:
            logger.warning(f"Element not found: {by}={value}, {e}")
            return None
    
    def safe_click(self, element):
        """Safely click element with anti-detection"""
        try:
            # Scroll to element
            self.driver.execute_script("arguments[0].scrollIntoView(true);", element)
            self.anti_detection.random_wait(0.5, 1.0)
            
            # Click element
            element.click()
            self.anti_detection.random_wait(1.0, 2.0)
            
        except Exception as e:
            logger.warning(f"Click failed: {e}")
    
    def safe_send_keys(self, element, text: str):
        """Safely send keys with human-like typing"""
        try:
            element.clear()
            self.anti_detection.human_like_typing(element, text, self.driver)
            self.anti_detection.random_wait(0.5, 1.0)
        except Exception as e:
            logger.warning(f"Send keys failed: {e}")
    
    def extract_salary(self, text: str) -> Optional[str]:
        """Extract salary information from text"""
        import re
        
        # Common salary patterns
        patterns = [
            r'₦\s*(\d{1,3}(?:,\d{3})*(?:\.\d{2})?)\s*-\s*₦\s*(\d{1,3}(?:,\d{3})*(?:\.\d{2})?)',
            r'(\d{1,3}(?:,\d{3})*(?:\.\d{2})?)\s*-\s*(\d{1,3}(?:,\d{3})*(?:\.\d{2})?)\s*NGN',
            r'NGN\s*(\d{1,3}(?:,\d{3})*(?:\.\d{2})?)\s*-\s*(\d{1,3}(?:,\d{3})*(?:\.\d{2})?)',
        ]
        
        for pattern in patterns:
            match = re.search(pattern, text, re.IGNORECASE)
            if match:
                return match.group(0)
        
        return None
