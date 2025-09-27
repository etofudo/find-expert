"""
Database models and connection setup
"""

from sqlalchemy import create_engine, Column, Integer, String, DateTime, Text, Boolean, Float
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy.orm import sessionmaker
from datetime import datetime
import logging

from .config import settings

logger = logging.getLogger(__name__)

# Database setup
engine = create_engine(settings.database_url)
SessionLocal = sessionmaker(autocommit=False, autoflush=False, bind=engine)
Base = declarative_base()

# Database Models
class JobApplication(Base):
    __tablename__ = "job_applications"
    
    id = Column(Integer, primary_key=True, index=True)
    job_title = Column(String, nullable=False)
    company_name = Column(String, nullable=False)
    job_url = Column(String, nullable=False, unique=True)
    job_site = Column(String, nullable=False)  # linkedin, indeed, etc.
    salary_range = Column(String)
    location = Column(String)
    job_description = Column(Text)
    
    # Application details
    applied_at = Column(DateTime, default=datetime.utcnow)
    application_status = Column(String, default="applied")  # applied, rejected, interview, etc.
    cover_letter = Column(Text)
    application_response = Column(Text)
    
    # Tracking
    is_duplicate = Column(Boolean, default=False)
    retry_count = Column(Integer, default=0)
    last_checked = Column(DateTime, default=datetime.utcnow)

class JobSearch(Base):
    __tablename__ = "job_searches"
    
    id = Column(Integer, primary_key=True, index=True)
    search_keywords = Column(String, nullable=False)
    search_location = Column(String, nullable=False)
    job_site = Column(String, nullable=False)
    total_jobs_found = Column(Integer, default=0)
    new_jobs_found = Column(Integer, default=0)
    search_date = Column(DateTime, default=datetime.utcnow)

class ApplicationStats(Base):
    __tablename__ = "application_stats"
    
    id = Column(Integer, primary_key=True, index=True)
    date = Column(DateTime, default=datetime.utcnow)
    total_applications = Column(Integer, default=0)
    successful_applications = Column(Integer, default=0)
    failed_applications = Column(Integer, default=0)
    duplicate_applications = Column(Integer, default=0)
    applications_per_hour = Column(Float, default=0.0)

async def init_db():
    """Initialize database tables"""
    try:
        Base.metadata.create_all(bind=engine)
        logger.info("Database initialized successfully")
    except Exception as e:
        logger.error(f"Failed to initialize database: {e}")
        raise

def get_db():
    """Get database session"""
    db = SessionLocal()
    try:
        yield db
    finally:
        db.close()
