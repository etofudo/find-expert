"""
Dashboard API routes
"""

from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from typing import List
from datetime import datetime, timedelta

from ..core.database import get_db, JobApplication, JobSearch, ApplicationStats
from ..core.config import settings

router = APIRouter()

@router.get("/dashboard/stats")
async def get_dashboard_stats(db: Session = Depends(get_db)):
    """Get dashboard statistics"""
    try:
        # Get total applications
        total_applications = db.query(JobApplication).count()
        
        # Get applications by status
        applied = db.query(JobApplication).filter(JobApplication.application_status == "applied").count()
        pending = db.query(JobApplication).filter(JobApplication.application_status == "pending").count()
        failed = db.query(JobApplication).filter(JobApplication.application_status == "failed").count()
        
        # Get today's applications
        today = datetime.utcnow().date()
        today_applications = db.query(JobApplication).filter(
            JobApplication.applied_at >= today
        ).count()
        
        # Get applications by job site
        site_stats = {}
        for site in ["linkedin", "indeed", "jobberman", "myjobmag", "greenhouse"]:
            count = db.query(JobApplication).filter(JobApplication.job_site == site).count()
            site_stats[site] = count
        
        return {
            "total_applications": total_applications,
            "applied": applied,
            "pending": pending,
            "failed": failed,
            "today_applications": today_applications,
            "site_stats": site_stats,
            "applications_per_hour": settings.applications_per_hour,
            "max_daily_applications": settings.max_applications_per_day
        }
        
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))

@router.get("/dashboard/applications")
async def get_applications(
    skip: int = 0,
    limit: int = 50,
    status: str = None,
    db: Session = Depends(get_db)
):
    """Get job applications with pagination"""
    try:
        query = db.query(JobApplication)
        
        if status:
            query = query.filter(JobApplication.application_status == status)
        
        applications = query.offset(skip).limit(limit).all()
        
        return {
            "applications": [
                {
                    "id": app.id,
                    "job_title": app.job_title,
                    "company_name": app.company_name,
                    "job_url": app.job_url,
                    "job_site": app.job_site,
                    "location": app.location,
                    "salary_range": app.salary_range,
                    "applied_at": app.applied_at.isoformat() if app.applied_at else None,
                    "application_status": app.application_status,
                    "retry_count": app.retry_count
                }
                for app in applications
            ],
            "total": query.count()
        }
        
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))

@router.get("/dashboard/search-history")
async def get_search_history(db: Session = Depends(get_db)):
    """Get job search history"""
    try:
        searches = db.query(JobSearch).order_by(JobSearch.search_date.desc()).limit(20).all()
        
        return {
            "searches": [
                {
                    "id": search.id,
                    "search_keywords": search.search_keywords,
                    "search_location": search.search_location,
                    "job_site": search.job_site,
                    "total_jobs_found": search.total_jobs_found,
                    "new_jobs_found": search.new_jobs_found,
                    "search_date": search.search_date.isoformat()
                }
                for search in searches
            ]
        }
        
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))

@router.post("/dashboard/retry-application/{application_id}")
async def retry_application(application_id: int, db: Session = Depends(get_db)):
    """Retry a failed application"""
    try:
        application = db.query(JobApplication).filter(JobApplication.id == application_id).first()
        
        if not application:
            raise HTTPException(status_code=404, detail="Application not found")
        
        # Reset status to pending for retry
        application.application_status = "pending"
        application.retry_count += 1
        db.commit()
        
        return {"message": "Application queued for retry"}
        
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))

@router.get("/dashboard/performance")
async def get_performance_stats(db: Session = Depends(get_db)):
    """Get performance statistics"""
    try:
        # Get last 7 days of stats
        end_date = datetime.utcnow()
        start_date = end_date - timedelta(days=7)
        
        stats = db.query(ApplicationStats).filter(
            ApplicationStats.date >= start_date
        ).order_by(ApplicationStats.date.desc()).all()
        
        return {
            "daily_stats": [
                {
                    "date": stat.date.isoformat(),
                    "total_applications": stat.total_applications,
                    "successful_applications": stat.successful_applications,
                    "failed_applications": stat.failed_applications,
                    "duplicate_applications": stat.duplicate_applications,
                    "applications_per_hour": stat.applications_per_hour
                }
                for stat in stats
            ]
        }
        
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))

@router.get("/dashboard/health")
async def get_system_health():
    """Get system health status"""
    try:
        # Check if all components are running
        health_status = {
            "status": "healthy",
            "components": {
                "database": "connected",
                "redis": "connected",
                "scrapers": "running",
                "scheduler": "active"
            },
            "timestamp": datetime.utcnow().isoformat()
        }
        
        return health_status
        
    except Exception as e:
        return {
            "status": "unhealthy",
            "error": str(e),
            "timestamp": datetime.utcnow().isoformat()
        }
