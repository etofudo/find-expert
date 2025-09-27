"""
Configuration settings for Software Developer Job Finder - Israel Odufote
"""

import os
from typing import List
from pydantic import BaseSettings

class Settings(BaseSettings):
    # Database
    database_url: str = "postgresql://username:password@localhost:5432/job_finder"
    redis_url: str = "redis://localhost:6379/0"
    
    # Candidate Information - Israel Odufote
    candidate_name: str = "Israel Odufote"
    candidate_email: str = "johnnyodufote@gmail.com"
    candidate_phone: str = "+2349037709934"  # Update with actual phone
    candidate_phone_nigeria: str = "09037709934"  # Update with actual phone
    candidate_location: str = "Nigeria"
    candidate_github: str = "https://github.com/etofudo"  # Update with GitHub profile
    candidate_linkedin: str = "https://www.linkedin.com/in/israel-odufote-5a13b4145"  # Update with LinkedIn profile
    
    # Salary Settings (NGN and USD)
    min_salary_ngn: int = 500000  # NGN per month
    min_salary_usd: int = 2000    # USD per month
    min_hourly_usd: float = 12.5  # USD per hour (2000/160 hours)
    
    # Application Settings
    applications_per_hour: int = 10
    max_applications_per_day: int = 100
    random_delay_min: int = 3
    random_delay_max: int = 12
    
    # Anti-Detection
    use_proxies: bool = True
    proxy_rotation: bool = True
    browser_fingerprinting: bool = True
    human_like_behavior: bool = True
    
    # User Agents for anti-detection
    user_agents: List[str] = [
        "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36",
        "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36",
        "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36",
        "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0",
        "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:121.0) Gecko/20100101 Firefox/121.0"
    ]
    
    # Job Sites - Tech Focus
    linkedin_enabled: bool = True
    indeed_enabled: bool = True
    weworkremotely_enabled: bool = True
    angelist_enabled: bool = True
    stackoverflow_enabled: bool = True
    remoteok_enabled: bool = True
    flexjobs_enabled: bool = True
    dice_enabled: bool = True
    ziprecruiter_enabled: bool = True
    glassdoor_enabled: bool = True
    
    # AI Settings
    openai_api_key: str = ""
    use_ai_cover_letters: bool = True
    use_ai_job_matching: bool = True
    
    # Job Site Authentication
    linkedin_email: str = ""
    linkedin_password: str = ""
    indeed_email: str = ""
    indeed_password: str = ""
    glassdoor_email: str = ""
    glassdoor_password: str = ""
    ziprecruiter_email: str = ""
    ziprecruiter_password: str = ""
    
    # Resume/CV Settings
    resume_folder: str = "resumes"
    primary_resume: str = "israel_odufote_resume.pdf"
    cover_letter_template: str = "israel_odufote_template.txt"
    
    # Monitoring
    enable_monitoring: bool = True
    dashboard_port: int = 8000
    log_level: str = "INFO"
    
    # Security
    secret_key: str = "your_secret_key_here"
    encryption_key: str = "your_encryption_key_here"
    
    # Job Search Keywords - Software Development
    job_keywords: List[str] = [
        # Core Developer Roles
        "software developer", "software engineer", "full stack developer", "fullstack developer",
        "backend developer", "frontend developer", "full stack engineer", "fullstack engineer",
        "backend engineer", "frontend engineer", "software engineering manager",
        
        # Technologies
        "javascript", "python", "java", "c#", "vue.js", "react.js", "node.js", "nest.js", "next.js",
        "php", "laravel", "typescript", "angular", "django", "spring", "express.js",
        "react", "vue", "angular", "svelte", "ember", "backbone",
        
        # Specializations
        "cloud engineer", "devops engineer", "ai engineer", "ml engineer", "mobile developer",
        "ios developer", "android developer", "react native", "flutter", "aws", "azure", "gcp",
        "kubernetes", "docker", "terraform", "jenkins", "ci/cd", "microservices",
        
        # Remote Work Keywords
        "remote", "hybrid", "work from home", "distributed", "virtual", "telecommute",
        
        # Experience Levels
        "junior developer", "mid level developer", "senior developer", "lead developer",
        "principal engineer", "tech lead", "engineering manager", "cto", "staff engineer",
        
        # Contract Types
        "contract", "freelance", "gig", "part-time", "consultant", "contractor"
    ]
    
    # Target Locations - Global Remote Work
    target_locations: List[str] = [
        "Remote", "Nigeria", "Lagos", "Abuja", "Port Harcourt", "Kano",
        "United States", "Canada", "United Kingdom", "Germany", "Netherlands",
        "Singapore", "Australia", "New Zealand", "Global", "Worldwide",
        "Ireland", "Sweden", "Norway", "Denmark", "Finland", "Switzerland"
    ]
    
    # Company Preferences
    company_sizes: List[str] = ["startup", "mid-size", "enterprise", "any"]
    industries: List[str] = ["fintech", "ecommerce", "healthcare", "edtech", "saas", "any"]
    employment_types: List[str] = ["full-time", "contract", "part-time", "freelance", "gig"]
    
    # Countries that allow Nigerian remote workers
    allowed_countries: List[str] = [
        "United States", "Canada", "United Kingdom", "Germany", "Netherlands",
        "Singapore", "Australia", "New Zealand", "Ireland", "Sweden", "Norway",
        "Denmark", "Finland", "Switzerland", "Austria", "Belgium", "Luxembourg",
        "Estonia", "Latvia", "Lithuania", "Poland", "Czech Republic", "Slovakia",
        "Slovenia", "Croatia", "Romania", "Bulgaria", "Hungary", "Portugal",
        "Spain", "Italy", "France", "Malta", "Cyprus", "Global", "Remote"
    ]
    
    class Config:
        env_file = ".env"
        case_sensitive = False

# Global settings instance
settings = Settings()
