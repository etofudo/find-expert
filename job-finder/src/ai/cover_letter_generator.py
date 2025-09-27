"""
AI-powered cover letter generator for software development positions
"""

import logging
from typing import Dict, List
from pathlib import Path
import openai
from ..core.config import settings

logger = logging.getLogger(__name__)

class CoverLetterGenerator:
    def __init__(self):
        if settings.openai_api_key:
            openai.api_key = settings.openai_api_key
        self.client = openai if settings.openai_api_key else None
        self.resume_data = self._extract_resume_data()
    
    def _extract_resume_data(self) -> Dict:
        """Extract data from resume PDF using CV parser"""
        try:
            from ..core.cv_parser import CVParser
            cv_parser = CVParser()
            return cv_parser.extract_resume_data()
        except Exception as e:
            logger.error(f"Error extracting resume data: {e}")
            # Fallback to default data
            return {
                "name": settings.candidate_name,
                "email": settings.candidate_email,
                "phone": settings.candidate_phone,
                "location": settings.candidate_location,
                "github": settings.candidate_github,
                "linkedin": settings.candidate_linkedin,
                "experience": "8+ years of software development experience",
                "skills": [
                    "JavaScript", "Python", "Java", "C#", "Vue.js", "React.js", 
                    "Node.js", "Nest.js", "Next.js", "PHP", "Laravel", "TypeScript",
                    "Angular", "Django", "Spring", "Express.js", "AWS", "Docker",
                    "Kubernetes", "Git", "REST APIs", "Microservices", "CI/CD"
                ],
                "education": "First Class Honour's degree in Computer Science",
                "certifications": ["New Horizons Awards Winner", "First Class Honour's Degree"],
                "projects": "Developed and maintained frontend applications with newspaper media mentions",
                "achievements": ["New Horizons Awards Winner", "Newspaper Media Mentions", "Team Leadership Experience"]
            }
    
    async def generate_cover_letter(self, job_title: str, company_name: str, job_description: str) -> str:
        """Generate personalized cover letter for software development positions"""
        try:
            if not self.client:
                return self._generate_basic_cover_letter(job_title, company_name, job_description)
            
            # Use AI to generate cover letter
            prompt = self._create_prompt(job_title, company_name, job_description)
            
            response = self.client.ChatCompletion.create(
                model="gpt-3.5-turbo",
                messages=[
                    {"role": "system", "content": "You are a professional cover letter writer specializing in software development and engineering positions."},
                    {"role": "user", "content": prompt}
                ],
                max_tokens=600,
                temperature=0.7
            )
            
            return response.choices[0].message.content.strip()
            
        except Exception as e:
            logger.error(f"Error generating AI cover letter: {e}")
            return self._generate_basic_cover_letter(job_title, company_name, job_description)
    
    def _create_prompt(self, job_title: str, company_name: str, job_description: str) -> str:
        """Create prompt for AI cover letter generation"""
        # Extract key technologies from job description
        tech_keywords = self._extract_tech_keywords(job_description)
        
        return f"""
        Write a professional cover letter for the following software development position:
        
        Position: {job_title}
        Company: {company_name}
        Job Description: {job_description[:800]}...
        
        Candidate Information:
        - Name: {self.resume_data['name']}
        - Location: {self.resume_data['location']}
        - Experience: {self.resume_data['experience']}
        - Skills: {', '.join(self.resume_data['skills'][:15])}
        - Education: {self.resume_data['education']}
        - GitHub: {self.resume_data['github'] or 'Available upon request'}
        - LinkedIn: {self.resume_data['linkedin'] or 'Available upon request'}
        
        Key Technologies in Job: {', '.join(tech_keywords[:10])}
        
        Requirements:
        - Keep it professional and concise (4-5 paragraphs)
        - Highlight relevant technical skills and experience
        - Show enthusiasm for the role and technology
        - Mention specific technologies that match the job requirements
        - Emphasize remote work capabilities if it's a remote position
        - Show passion for software development and continuous learning
        - Use a professional but approachable tone suitable for tech industry
        - Include a strong closing statement with call to action
        - Address the hiring manager directly
        """
    
    def _extract_tech_keywords(self, text: str) -> List[str]:
        """Extract technology keywords from job description"""
        tech_keywords = [
            'javascript', 'python', 'java', 'c#', 'php', 'typescript', 'go', 'rust', 'kotlin', 'swift',
            'react', 'vue', 'angular', 'node.js', 'express', 'django', 'flask', 'spring', 'laravel',
            'aws', 'azure', 'gcp', 'docker', 'kubernetes', 'terraform', 'jenkins', 'git', 'github',
            'mysql', 'postgresql', 'mongodb', 'redis', 'elasticsearch', 'graphql', 'rest', 'api',
            'microservices', 'ci/cd', 'devops', 'agile', 'scrum', 'tdd', 'bdd', 'unit testing'
        ]
        
        found_keywords = []
        text_lower = text.lower()
        
        for keyword in tech_keywords:
            if keyword in text_lower:
                found_keywords.append(keyword)
        
        return found_keywords
    
    def _generate_basic_cover_letter(self, job_title: str, company_name: str, job_description: str) -> str:
        """Generate basic cover letter using Israel Odufote's actual template"""
        try:
            # Try to use the actual cover letter template
            template_path = Path("templates/israel_odufote_cover_letter.txt")
            if template_path.exists():
                with open(template_path, 'r', encoding='utf-8') as f:
                    template = f.read()
                
                # Replace placeholders with actual data
                cover_letter = template.replace("{JOB_TITLE}", job_title.upper())
                cover_letter = cover_letter.replace("{PHONE}", self.resume_data['phone'])
                cover_letter = cover_letter.replace("{EMAIL}", self.resume_data['email'])
                cover_letter = cover_letter.replace("{GITHUB}", self.resume_data['github'] or 'Available upon request')
                cover_letter = cover_letter.replace("{LINKEDIN}", self.resume_data['linkedin'] or 'Available upon request')
                
                return cover_letter
        except Exception as e:
            logger.error(f"Error loading cover letter template: {e}")
        
        # Fallback to default template
        return f"""
        Dear Hiring Manager,

        APPLICATION FOR {job_title.upper()} ROLE

        I am a New Horizons awards winning seasoned software engineer with over 8 years of experience in developing efficient, highly scalable and secure software with React.js, Node.js, C#/.NET, Angular, MySQL, among other programming languages.

        I have developed and maintained the frontend of several applications which have newspaper media mentions.

        I have experience working with several software architectures, MVC, microservices, monolithic and many others.

        I am a team player and a team leader that have led my team to deliver exceptional results.

        I have a First Class Honour's degree in Computer Science and excellence is my mantra.

        I will be delighted to be given an opportunity to deliver value and excellent results in your company.

        Kind Regards,
        ODUFOTE ISRAEL
        {self.resume_data['phone']}
        {self.resume_data['email']}
        {self.resume_data['github'] or 'Available upon request'}
        {self.resume_data['linkedin'] or 'Available upon request'}
        """
    
    def generate_job_specific_cover_letter(self, job_type: str, job_title: str, company_name: str) -> str:
        """Generate cover letter specific to software development job type"""
        templates = {
            "frontend": self._generate_frontend_cover_letter,
            "backend": self._generate_backend_cover_letter,
            "fullstack": self._generate_fullstack_cover_letter,
            "mobile": self._generate_mobile_cover_letter,
            "devops": self._generate_devops_cover_letter,
            "cloud": self._generate_cloud_cover_letter,
            "ai_ml": self._generate_ai_ml_cover_letter,
            "contract": self._generate_contract_cover_letter,
            "freelance": self._generate_freelance_cover_letter
        }
        
        generator = templates.get(job_type, self._generate_basic_cover_letter)
        return generator(job_title, company_name, "")
    
    def _generate_frontend_cover_letter(self, job_title: str, company_name: str, job_description: str) -> str:
        """Generate cover letter for frontend development positions"""
        return f"""
        Dear Hiring Manager,
        
        I am excited to apply for the {job_title} position at {company_name}. As a frontend developer with extensive experience in modern JavaScript frameworks, I am well-positioned to create exceptional user experiences for your applications.
        
        My technical expertise includes React.js, Vue.js, Angular, TypeScript, and modern CSS frameworks. I have a strong focus on responsive design, performance optimization, and accessibility. I am passionate about creating intuitive interfaces that users love.
        
        I am particularly drawn to {company_name} because of your commitment to innovation and user-centric design. As a remote developer based in {self.resume_data['location']}, I bring a global perspective and am fully equipped to collaborate with distributed teams.
        
        I look forward to discussing how I can contribute to {company_name}'s frontend development goals.
        
        Best regards,
        {self.resume_data['name']}
        GitHub: {self.resume_data['github'] or 'Available upon request'}
        """
    
    def _generate_backend_cover_letter(self, job_title: str, company_name: str, job_description: str) -> str:
        """Generate cover letter for backend development positions"""
        return f"""
        Dear Hiring Manager,
        
        I am writing to express my interest in the {job_title} position at {company_name}. With my strong background in backend development and API design, I am confident that I can help build robust and scalable server-side solutions.
        
        My technical expertise includes Node.js, Python, Java, C#, PHP, Laravel, and various databases. I have extensive experience in RESTful API development, microservices architecture, and cloud deployment. I am passionate about writing clean, maintainable code and implementing best practices.
        
        I am particularly drawn to {company_name} because of your focus on technical excellence and innovation. As a remote developer based in {self.resume_data['location']}, I am experienced in working with distributed teams and can contribute to your backend infrastructure.
        
        I would welcome the opportunity to discuss how my backend development skills can benefit {company_name}.
        
        Best regards,
        {self.resume_data['name']}
        GitHub: {self.resume_data['github'] or 'Available upon request'}
        """
    
    def _generate_fullstack_cover_letter(self, job_title: str, company_name: str, job_description: str) -> str:
        """Generate cover letter for full-stack development positions"""
        return f"""
        Dear Hiring Manager,
        
        I am excited to apply for the {job_title} position at {company_name}. As a full-stack developer with comprehensive experience across the entire development stack, I am well-equipped to contribute to all aspects of your software development lifecycle.
        
        My technical expertise spans frontend technologies (React.js, Vue.js, Angular) and backend technologies (Node.js, Python, Java, PHP, Laravel). I have experience with databases, cloud platforms, and DevOps practices. I am passionate about building end-to-end solutions that deliver real value.
        
        I am particularly drawn to {company_name} because of your commitment to full-stack innovation and technical excellence. As a remote developer based in {self.resume_data['location']}, I bring versatility and can adapt to various project requirements.
        
        I look forward to discussing how I can contribute to {company_name}'s full-stack development initiatives.
        
        Best regards,
        {self.resume_data['name']}
        GitHub: {self.resume_data['github'] or 'Available upon request'}
        """
    
    def _generate_mobile_cover_letter(self, job_title: str, company_name: str, job_description: str) -> str:
        """Generate cover letter for mobile development positions"""
        return f"""
        Dear Hiring Manager,
        
        I am writing to express my interest in the {job_title} position at {company_name}. With my experience in mobile app development and cross-platform solutions, I am confident that I can help create engaging mobile experiences for your users.
        
        My technical expertise includes React Native, Flutter, native iOS and Android development, and mobile UI/UX design. I have experience with app store deployment, performance optimization, and mobile-specific testing. I am passionate about creating mobile apps that users love.
        
        I am particularly drawn to {company_name} because of your focus on mobile innovation and user experience. As a remote developer based in {self.resume_data['location']}, I can contribute to your mobile development efforts from anywhere.
        
        I would welcome the opportunity to discuss how my mobile development skills can benefit {company_name}.
        
        Best regards,
        {self.resume_data['name']}
        GitHub: {self.resume_data['github'] or 'Available upon request'}
        """
    
    def _generate_devops_cover_letter(self, job_title: str, company_name: str, job_description: str) -> str:
        """Generate cover letter for DevOps positions"""
        return f"""
        Dear Hiring Manager,
        
        I am excited to apply for the {job_title} position at {company_name}. With my experience in DevOps practices and cloud infrastructure, I am well-positioned to help streamline your development and deployment processes.
        
        My technical expertise includes Docker, Kubernetes, AWS, Azure, CI/CD pipelines, and infrastructure as code. I have experience with monitoring, logging, and automation. I am passionate about improving development workflows and system reliability.
        
        I am particularly drawn to {company_name} because of your commitment to technical excellence and scalable infrastructure. As a remote DevOps engineer based in {self.resume_data['location']}, I can help optimize your development processes.
        
        I look forward to discussing how I can contribute to {company_name}'s DevOps initiatives.
        
        Best regards,
        {self.resume_data['name']}
        GitHub: {self.resume_data['github'] or 'Available upon request'}
        """
    
    def _generate_cloud_cover_letter(self, job_title: str, company_name: str, job_description: str) -> str:
        """Generate cover letter for cloud engineering positions"""
        return f"""
        Dear Hiring Manager,
        
        I am writing to express my interest in the {job_title} position at {company_name}. With my experience in cloud platforms and distributed systems, I am confident that I can help optimize your cloud infrastructure and services.
        
        My technical expertise includes AWS, Azure, Google Cloud Platform, containerization, and serverless architectures. I have experience with cloud security, cost optimization, and scalability. I am passionate about leveraging cloud technologies to solve complex problems.
        
        I am particularly drawn to {company_name} because of your focus on cloud innovation and technical excellence. As a remote cloud engineer based in {self.resume_data['location']}, I can contribute to your cloud strategy.
        
        I would welcome the opportunity to discuss how my cloud engineering skills can benefit {company_name}.
        
        Best regards,
        {self.resume_data['name']}
        GitHub: {self.resume_data['github'] or 'Available upon request'}
        """
    
    def _generate_ai_ml_cover_letter(self, job_title: str, company_name: str, job_description: str) -> str:
        """Generate cover letter for AI/ML positions"""
        return f"""
        Dear Hiring Manager,
        
        I am excited to apply for the {job_title} position at {company_name}. With my background in AI/ML development and data science, I am well-positioned to help build intelligent solutions that drive business value.
        
        My technical expertise includes Python, machine learning frameworks, data analysis, and model deployment. I have experience with various ML algorithms, data preprocessing, and model optimization. I am passionate about applying AI/ML to solve real-world problems.
        
        I am particularly drawn to {company_name} because of your commitment to AI innovation and data-driven solutions. As a remote AI/ML engineer based in {self.resume_data['location']}, I can contribute to your machine learning initiatives.
        
        I look forward to discussing how I can contribute to {company_name}'s AI/ML development goals.
        
        Best regards,
        {self.resume_data['name']}
        GitHub: {self.resume_data['github'] or 'Available upon request'}
        """
    
    def _generate_contract_cover_letter(self, job_title: str, company_name: str, job_description: str) -> str:
        """Generate cover letter for contract positions"""
        return f"""
        Dear Hiring Manager,
        
        I am writing to express my interest in the {job_title} contract position at {company_name}. With my extensive software development experience and proven track record of delivering quality work, I am confident that I can make an immediate impact on your project.
        
        My technical expertise includes full-stack development, modern frameworks, and cloud technologies. I have experience working on diverse projects and can quickly adapt to new technologies and requirements. I am committed to delivering high-quality work within agreed timelines.
        
        I am particularly drawn to {company_name} because of your innovative projects and technical challenges. As a contract developer based in {self.resume_data['location']}, I am flexible and can work within your project constraints.
        
        I would welcome the opportunity to discuss how I can contribute to {company_name}'s project goals.
        
        Best regards,
        {self.resume_data['name']}
        GitHub: {self.resume_data['github'] or 'Available upon request'}
        """
    
    def _generate_freelance_cover_letter(self, job_title: str, company_name: str, job_description: str) -> str:
        """Generate cover letter for freelance positions"""
        return f"""
        Dear Hiring Manager,
        
        I am excited to apply for the {job_title} freelance opportunity at {company_name}. With my diverse software development experience and entrepreneurial mindset, I am well-equipped to deliver exceptional results for your project.
        
        My technical expertise spans multiple technologies and I have experience working with various clients and project types. I am self-motivated, reliable, and committed to exceeding expectations. I bring fresh perspectives and innovative solutions to every project.
        
        I am particularly drawn to {company_name} because of your innovative approach and interesting projects. As a freelance developer based in {self.resume_data['location']}, I offer flexibility and can work around your schedule.
        
        I look forward to discussing how I can contribute to {company_name}'s project success.
        
        Best regards,
        {self.resume_data['name']}
        GitHub: {self.resume_data['github'] or 'Available upon request'}
        """
