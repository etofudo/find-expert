"""
Anti-detection utilities for web scraping
"""

import random
import time
from typing import Dict, List
from ..core.config import settings

class AntiDetectionManager:
    def __init__(self):
        self.user_agents = settings.user_agents
    
    def get_random_user_agent(self) -> str:
        """Get a random user agent"""
        return random.choice(self.user_agents)
    
    def get_random_viewport_size(self) -> Dict[str, int]:
        """Get a random viewport size"""
        viewports = [
            {'width': 1920, 'height': 1080},
            {'width': 1366, 'height': 768},
            {'width': 1440, 'height': 900},
            {'width': 1536, 'height': 864},
            {'width': 1280, 'height': 720}
        ]
        return random.choice(viewports)
    
    def get_random_delay(self) -> float:
        """Get a random delay between actions"""
        return random.uniform(settings.random_delay_min, settings.random_delay_max)
    
    def human_like_delay(self):
        """Add human-like delay"""
        delay = self.get_random_delay()
        time.sleep(delay)
    
    def get_random_mouse_movement(self) -> Dict[str, int]:
        """Get random mouse movement coordinates"""
        return {
            'x': random.randint(100, 800),
            'y': random.randint(100, 600)
        }
    
    def simulate_typing_delay(self, text: str) -> float:
        """Calculate typing delay based on text length"""
        base_delay = 0.1  # Base delay per character
        variation = random.uniform(0.05, 0.15)  # Random variation
        return len(text) * (base_delay + variation)