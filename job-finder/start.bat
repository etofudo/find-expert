@echo off
echo Starting Expert Job Finder...
echo ================================

REM Check if Python is installed
python --version >nul 2>&1
if errorlevel 1 (
    echo Python is not installed or not in PATH
    pause
    exit /b 1
)

REM Start the application
echo Starting FastAPI server...
start "Expert Job Finder API" python main.py

REM Wait a moment
timeout /t 3 /nobreak >nul

REM Start Celery worker
echo Starting Celery worker...
start "Celery Worker" celery -A src.core.scheduler worker --loglevel=info

REM Wait a moment
timeout /t 2 /nobreak >nul

REM Start Celery beat
echo Starting Celery beat...
start "Celery Beat" celery -A src.core.scheduler beat --loglevel=info

echo.
echo ================================
echo Expert Job Finder is starting...
echo.
echo Dashboard: http://localhost:8000/dashboard
echo API: http://localhost:8000
echo.
echo Press any key to exit...
pause >nul
