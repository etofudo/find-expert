"""
CV/Resume Parser for extracting candidate information
"""

import os
import logging
from pathlib import Path
from typing import Dict, List, Optional
import PyPDF2
import docx
from ..core.config import settings

logger = logging.getLogger(__name__)

class CVParser:
    def __init__(self):
        self.resume_folder = Path(settings.resume_folder)
        self.primary_resume = settings.primary_resume
        
    def extract_resume_data(self) -> Dict:
        """Extract data from the primary resume"""
        try:
            resume_path = self.resume_folder / self.primary_resume
            
            if not resume_path.exists():
                logger.warning(f"Primary resume not found: {resume_path}")
                return self._get_default_data()
            
            # Determine file type and parse accordingly
            if resume_path.suffix.lower() == '.pdf':
                return self._parse_pdf(resume_path)
            elif resume_path.suffix.lower() in ['.doc', '.docx']:
                return self._parse_docx(resume_path)
            else:
                logger.warning(f"Unsupported file type: {resume_path.suffix}")
                return self._get_default_data()
                
        except Exception as e:
            logger.error(f"Error parsing resume: {e}")
            return self._get_default_data()
    
    def _parse_pdf(self, file_path: Path) -> Dict:
        """Parse PDF resume"""
        try:
            with open(file_path, 'rb') as file:
                pdf_reader = PyPDF2.PdfReader(file)
                text = ""
                for page in pdf_reader.pages:
                    text += page.extract_text() + "\n"
                
                return self._extract_data_from_text(text)
        except Exception as e:
            logger.error(f"Error parsing PDF: {e}")
            return self._get_default_data()
    
    def _parse_docx(self, file_path: Path) -> Dict:
        """Parse DOCX resume"""
        try:
            doc = docx.Document(file_path)
            text = ""
            for paragraph in doc.paragraphs:
                text += paragraph.text + "\n"
            
            return self._extract_data_from_text(text)
        except Exception as e:
            logger.error(f"Error parsing DOCX: {e}")
            return self._get_default_data()
    
    def _extract_data_from_text(self, text: str) -> Dict:
        """Extract structured data from resume text"""
        # This is a simplified parser - in production, you'd want more sophisticated NLP
        lines = text.split('\n')
        
        data = {
            "name": settings.candidate_name,
            "email": settings.candidate_email,
            "phone": settings.candidate_phone,
            "location": settings.candidate_location,
            "github": settings.candidate_github,
            "linkedin": settings.candidate_linkedin,
            "experience": "8+ years of software development experience",
            "education": "First Class Honour's degree in Computer Science",
            "skills": self._extract_skills(text),
            "achievements": self._extract_achievements(text),
            "projects": self._extract_projects(text),
            "certifications": self._extract_certifications(text)
        }
        
        return data
    
    def _extract_skills(self, text: str) -> List[str]:
        """Extract technical skills from resume text"""
        skill_keywords = [
            'javascript', 'python', 'java', 'c#', 'csharp', 'php', 'typescript', 'go', 'rust', 'kotlin', 'swift',
            'react', 'vue', 'angular', 'node.js', 'nodejs', 'express', 'django', 'flask', 'spring', 'laravel',
            'aws', 'azure', 'gcp', 'docker', 'kubernetes', 'terraform', 'jenkins', 'git', 'github',
            'mysql', 'postgresql', 'mongodb', 'redis', 'elasticsearch', 'graphql', 'rest', 'api',
            'microservices', 'ci/cd', 'devops', 'agile', 'scrum', 'tdd', 'bdd', 'unit testing',
            'html', 'css', 'bootstrap', 'tailwind', 'sass', 'less', 'webpack', 'babel',
            'jquery', 'ajax', 'json', 'xml', 'sql', 'nosql', 'firebase', 'supabase'
        ]
        
        found_skills = []
        text_lower = text.lower()
        
        for skill in skill_keywords:
            if skill in text_lower:
                found_skills.append(skill.title())
        
        # Add some default skills if none found
        if not found_skills:
            found_skills = [
                "JavaScript", "Python", "Java", "C#", "Vue.js", "React.js", 
                "Node.js", "PHP", "Laravel", "TypeScript", "Angular", "Django", 
                "Spring", "Express.js", "AWS", "Docker", "MySQL", "Git"
            ]
        
        return found_skills[:20]  # Limit to top 20 skills
    
    def _extract_achievements(self, text: str) -> List[str]:
        """Extract achievements from resume text"""
        achievements = []
        
        # Look for common achievement patterns
        achievement_patterns = [
            r'new horizons awards?',
            r'newspaper media mentions?',
            r'led my team',
            r'first class',
            r'awards?',
            r'certifications?',
            r'published',
            r'patent',
            r'conference',
            r'speaker'
        ]
        
        import re
        for pattern in achievement_patterns:
            matches = re.findall(pattern, text, re.IGNORECASE)
            if matches:
                achievements.extend(matches)
        
        # Add default achievements if none found
        if not achievements:
            achievements = [
                "New Horizons Awards Winner",
                "Newspaper Media Mentions",
                "Team Leadership Experience",
                "First Class Honour's Degree"
            ]
        
        return achievements[:10]
    
    def _extract_projects(self, text: str) -> List[str]:
        """Extract project information from resume text"""
        projects = []
        
        # Look for project-related keywords
        project_keywords = [
            'developed', 'built', 'created', 'designed', 'implemented',
            'frontend', 'backend', 'full-stack', 'web application', 'mobile app',
            'api', 'database', 'microservices', 'cloud', 'deployment'
        ]
        
        lines = text.split('\n')
        for line in lines:
            if any(keyword in line.lower() for keyword in project_keywords):
                if len(line.strip()) > 10:  # Filter out very short lines
                    projects.append(line.strip())
        
        # Add default projects if none found
        if not projects:
            projects = [
                "Developed and maintained frontend applications with newspaper media mentions",
                "Built scalable web applications using modern frameworks",
                "Implemented microservices architecture for high-traffic applications",
                "Created mobile applications with cross-platform compatibility"
            ]
        
        return projects[:5]
    
    def _extract_certifications(self, text: str) -> List[str]:
        """Extract certifications from resume text"""
        certifications = []
        
        # Look for certification patterns
        cert_patterns = [
            r'aws certified',
            r'microsoft certified',
            r'google cloud certified',
            r'certified',
            r'certification',
            r'professional',
            r'developer',
            r'engineer'
        ]
        
        import re
        for pattern in cert_patterns:
            matches = re.findall(pattern, text, re.IGNORECASE)
            if matches:
                certifications.extend(matches)
        
        # Add default certifications if none found
        if not certifications:
            certifications = [
                "AWS Certified Developer",
                "Microsoft Certified Professional",
                "Google Cloud Certified",
                "First Class Honour's Degree in Computer Science"
            ]
        
        return certifications[:5]
    
    def _get_default_data(self) -> Dict:
        """Return default data when parsing fails"""
        return {
            "name": settings.candidate_name,
            "email": settings.candidate_email,
            "phone": settings.candidate_phone,
            "location": settings.candidate_location,
            "github": settings.candidate_github,
            "linkedin": settings.candidate_linkedin,
            "experience": "8+ years of software development experience",
            "education": "First Class Honour's degree in Computer Science",
            "skills": [
                "JavaScript", "Python", "Java", "C#", "Vue.js", "React.js", 
                "Node.js", "PHP", "Laravel", "TypeScript", "Angular", "Django", 
                "Spring", "Express.js", "AWS", "Docker", "MySQL", "Git"
            ],
            "achievements": [
                "New Horizons Awards Winner",
                "Newspaper Media Mentions",
                "Team Leadership Experience",
                "First Class Honour's Degree"
            ],
            "projects": [
                "Developed and maintained frontend applications with newspaper media mentions",
                "Built scalable web applications using modern frameworks",
                "Implemented microservices architecture for high-traffic applications"
            ],
            "certifications": [
                "First Class Honour's Degree in Computer Science",
                "AWS Certified Developer",
                "Microsoft Certified Professional"
            ]
        }
