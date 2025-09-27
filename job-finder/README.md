# Software Developer Job Finder

An automated job application system for software developers and engineers. This system crawls multiple job sites, applies to suitable tech positions, and provides a dashboard for monitoring applications.

## Features

- **Multi-Site Job Scraping**: LinkedIn, We Work Remotely, AngelList, Stack Overflow, RemoteOK, FlexJobs, Dice, ZipRecruiter, Glassdoor
- **AI-Powered Cover Letters**: Personalized cover letters using OpenAI GPT for different tech roles
- **Anti-Detection Measures**: Random delays, user agents, human-like behavior
- **Real-time Dashboard**: Monitor applications, success rates, and performance
- **Duplicate Prevention**: Avoid applying to the same job twice
- **Salary Filtering**: Only apply to jobs meeting minimum salary requirements (₦500,000/month or $2,000/month)
- **Remote Work Focus**: Prioritizes remote and hybrid opportunities globally
- **Tech Role Targeting**: Focus on software development, engineering, full-stack, backend, frontend, mobile, DevOps, cloud, AI/ML positions

## Quick Start

### 1. Install Dependencies

```bash
pip install -r requirements.txt
```

### 2. Setup Environment

```bash
cp env.example .env
# Edit .env with your configuration
```

### 3. Install Playwright

```bash
playwright install
```

### 4. Setup Database

```bash
# Create PostgreSQL database
createdb job_finder

# Run migrations (if using Alembic)
alembic upgrade head
```

### 5. Start the Application

```bash
# Start the main application
python main.py

# In another terminal, start Celery worker
celery -A src.core.scheduler worker --loglevel=info

# In another terminal, start Celery beat (scheduler)
celery -A src.core.scheduler beat --loglevel=info
```

## Configuration


### Job Sites

Enable/disable job sites in the configuration:
- LinkedIn
- We Work Remotely
- AngelList
- Stack Overflow
- RemoteOK
- FlexJobs
- Dice
- ZipRecruiter
- Glassdoor

## Usage

### Dashboard

Access the dashboard at `http://localhost:8000` to:
- View application statistics
- Monitor job applications
- Retry failed applications
- Check system health

### API Endpoints

- `GET /api/dashboard/stats` - Get dashboard statistics
- `GET /api/dashboard/applications` - Get job applications
- `GET /api/dashboard/search-history` - Get search history
- `POST /api/dashboard/retry-application/{id}` - Retry failed application

## Architecture

### Core Components

- **Scrapers**: Site-specific job scrapers with anti-detection
- **AI Module**: Cover letter generation and job matching
- **Database**: PostgreSQL for storing applications and statistics
- **Scheduler**: Celery for background task processing
- **Dashboard**: FastAPI-based monitoring interface

### Anti-Detection Features

- Random user agents and viewport sizes
- Human-like typing and mouse movements
- Random delays between actions
- Session rotation and cookie clearing
- Proxy rotation (configurable)

## Job Application Process

1. **Search**: Scrapers search for jobs matching criteria
2. **Filter**: Jobs are filtered by salary, location, and keywords
3. **Apply**: AI generates personalized cover letters
4. **Track**: Applications are tracked in the database
5. **Monitor**: Dashboard shows real-time status

## Safety Features

- Rate limiting to avoid being blocked
- Duplicate application prevention
- Error handling and retry mechanisms
- Comprehensive logging
- Health monitoring

## Legal Compliance

This tool is designed for legitimate job searching purposes. Users are responsible for:
- Complying with job site terms of service
- Using the tool ethically and responsibly
- Respecting rate limits and anti-bot measures
- Following applicable laws and regulations

## Support

For issues or questions:
1. Check the logs in the console output
2. Review the dashboard for error details
3. Ensure all environment variables are set correctly
4. Verify database connectivity

## License

This project is for educational and personal use only.
