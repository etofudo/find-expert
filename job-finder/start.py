#!/usr/bin/env python3
"""
Startup script for Expert Job Finder
"""

import subprocess
import sys
import time
import os
from pathlib import Path

def start_application():
    """Start the main application"""
    print("Starting Expert Job Finder...")
    print("=" * 50)
    
    # Check if .env exists
    if not Path(".env").exists():
        print("❌ .env file not found!")
        print("Please copy env.example to .env and configure it")
        return False
    
    # Start the main application
    try:
        print("🚀 Starting FastAPI server...")
        subprocess.Popen([
            sys.executable, "main.py"
        ])
        
        print("✅ FastAPI server started on http://localhost:8000")
        print("📊 Dashboard available at http://localhost:8000/dashboard")
        print("\nTo start background workers:")
        print("1. Open another terminal")
        print("2. Run: celery -A src.core.scheduler worker --loglevel=info")
        print("3. Run: celery -A src.core.scheduler beat --loglevel=info")
        
        return True
        
    except Exception as e:
        print(f"❌ Error starting application: {e}")
        return False

if __name__ == "__main__":
    start_application()
