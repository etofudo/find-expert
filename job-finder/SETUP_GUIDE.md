# 🚀 Software Developer Job Finder - Complete Setup Guide

## ⚠️ **CRITICAL REQUIREMENTS**

This system **WILL NOT WORK** without proper configuration. Here's what you need:

### 1. **Job Site Credentials (REQUIRED)**
- **LinkedIn**: Email and password for job applications
- **Indeed**: Email and password for job applications  
- **Glassdoor**: Email and password for job applications
- **ZipRecruiter**: Email and password for job applications

### 2. **Resume File (REQUIRED)**
- Place your resume PDF in: `resumes/israel_odufote_resume.pdf`
- Must be named exactly: `israel_odufote_resume.pdf`

### 3. **OpenAI API Key (OPTIONAL but RECOMMENDED)**
- For AI-generated cover letters
- Get from: https://platform.openai.com/api-keys

## 🛠️ **Setup Instructions**

### Step 1: Run Setup Script
```bash
cd job-finder
python setup_israel.py
```

### Step 2: Add Your Resume
```bash
# Copy your resume to the resumes folder
cp /path/to/your/resume.pdf resumes/israel_odufote_resume.pdf
```

### Step 3: Configure Authentication
Edit the `.env` file with your credentials:

```bash
# Job Site Authentication (REQUIRED)
LINKEDIN_EMAIL=your_linkedin_email@example.com
LINKEDIN_PASSWORD=your_linkedin_password
INDEED_EMAIL=your_indeed_email@example.com
INDEED_PASSWORD=your_indeed_password
GLASSDOOR_EMAIL=your_glassdoor_email@example.com
GLASSDOOR_PASSWORD=your_glassdoor_password
ZIPRECRUITER_EMAIL=your_ziprecruiter_email@example.com
ZIPRECRUITER_PASSWORD=your_ziprecruiter_password

# AI Settings (OPTIONAL)
OPENAI_API_KEY=your_openai_api_key_here
```

### Step 4: Start the System
```bash
python start.py
```

### Step 5: Access Dashboard
Open: http://localhost:8000/dashboard

## 🔧 **System Components**

### **1. CV Parser (`src/core/cv_parser.py`)**
- Extracts data from your PDF resume
- Identifies skills, experience, education, achievements
- Updates cover letter generator with real data

### **2. Cover Letter Generator (`src/ai/cover_letter_generator.py`)**
- Uses your actual cover letter template
- Generates job-specific cover letters
- Integrates with CV parser for personalized content

### **3. LinkedIn Scraper with Auth (`src/scrapers/linkedin_scraper_auth.py`)**
- Authenticates with LinkedIn
- Searches for jobs using your keywords
- Applies to jobs with your resume and cover letter

### **4. Job Application Process**
1. **Search**: Scrapers search for jobs matching your criteria
2. **Filter**: Jobs are filtered by salary, location, and keywords
3. **Apply**: System applies with your resume and personalized cover letter
4. **Track**: Applications are tracked in the database
5. **Monitor**: Dashboard shows real-time status

## 📊 **Your Configuration**

### **Personal Information**
- **Name**: Israel Odufote
- **Email**: johnnyodufote@gmail.com
- **Phone**: +2349037709934
- **Location**: Nigeria
- **GitHub**: https://github.com/etofudo
- **LinkedIn**: https://www.linkedin.com/in/israel-odufote-5a13b4145

### **Job Search Criteria**
- **Keywords**: Software Developer, Software Engineer, Full Stack, Backend, Frontend, Mobile, DevOps, Cloud, AI/ML
- **Technologies**: JavaScript, Python, Java, C#, Vue.js, React.js, Node.js, PHP, Laravel, TypeScript, Angular
- **Salary**: Minimum ₦500,000/month or $2,000/month
- **Location**: Remote, Nigeria, Global
- **Employment Types**: Full-time, Contract, Freelance, Gigs

### **Cover Letter Template**
Your actual cover letter template is used:
```
Dear Hiring Manager,

APPLICATION FOR {JOB_TITLE} ROLE

I am a New Horizons awards winning seasoned software engineer with over 8 years of experience in developing efficient, highly scalable and secure software with React.js, Node.js, C#/.NET, Angular, MySQL, among other programming languages.

I have developed and maintained the frontend of several applications which have newspaper media mentions.

I have experience working with several software architectures, MVC, microservices, monolithic and many others.

I am a team player and a team leader that have led my team to deliver exceptional results.

I have a First Class Honour's degree in Computer Science and excellence is my mantra.

I will be delighted to be given an opportunity to deliver value and excellent results in your company.

Kind Regards,
ODUFOTE ISRAEL
```

## 🚨 **Important Notes**

### **Authentication Requirements**
- **LinkedIn**: Most important - requires email/password
- **Indeed**: Secondary - requires email/password
- **Other sites**: Optional but recommended

### **Resume Requirements**
- Must be PDF format
- Must be named exactly: `israel_odufote_resume.pdf`
- Place in: `resumes/` folder

### **Rate Limiting**
- 10 applications per hour
- 100 applications per day
- Random delays between actions (3-12 seconds)

### **Anti-Detection**
- Random user agents
- Human-like behavior simulation
- Session rotation
- Proxy support (configurable)

## 🔍 **Troubleshooting**

### **Common Issues**

1. **"Not logged into LinkedIn"**
   - Check LinkedIn credentials in `.env`
   - Verify email/password are correct
   - LinkedIn may require 2FA - disable temporarily

2. **"Resume not found"**
   - Ensure resume is in `resumes/israel_odufote_resume.pdf`
   - Check file permissions
   - Verify file is not corrupted

3. **"No apply button found"**
   - Job may not be available for application
   - LinkedIn may have changed their interface
   - Check if job requires different application method

4. **"Cover letter generation failed"**
   - Check OpenAI API key in `.env`
   - Verify internet connection
   - Check API usage limits

### **Logs and Monitoring**
- Check `logs/` directory for error messages
- Dashboard shows real-time application status
- Monitor system performance and success rates

## 🎯 **Success Tips**

1. **Start Small**: Test with 1-2 applications first
2. **Monitor Closely**: Watch the first few runs carefully
3. **Update Regularly**: Keep resume and cover letter current
4. **Check Credentials**: Ensure all job site logins work
5. **Review Applications**: Check applied jobs manually

## 📞 **Support**

If you encounter issues:
1. Check the logs in `logs/` directory
2. Review the dashboard for error details
3. Verify all credentials are correct
4. Ensure resume file is accessible
5. Check internet connection and job site availability

---

**Remember**: This system requires your actual job site credentials to work. Without them, it can only search for jobs but cannot apply to them.
