#!/usr/bin/env python3
"""
Quick start script for Expert Job Finder
"""

import subprocess
import sys
import os
from pathlib import Path

def check_requirements():
    """Check if requirements are installed"""
    try:
        import fastapi
        import celery
        import playwright
        import openai
        print("✓ All requirements installed")
        return True
    except ImportError as e:
        print(f"✗ Missing requirement: {e}")
        print("Run: pip install -r requirements.txt")
        return False

def check_env_file():
    """Check if .env file exists"""
    if not Path(".env").exists():
        print("✗ .env file not found")
        print("Run: cp env.example .env")
        print("Then edit .env with your configuration")
        return False
    print("✓ .env file found")
    return True

def install_playwright():
    """Install Playwright browsers"""
    try:
        subprocess.run([sys.executable, "-m", "playwright", "install"], check=True)
        print("✓ Playwright browsers installed")
        return True
    except subprocess.CalledProcessError:
        print("✗ Failed to install Playwright browsers")
        return False

def main():
    """Main setup function"""
    print("Expert Job Finder - Setup Check")
    print("=" * 40)
    
    # Check requirements
    if not check_requirements():
        return
    
    # Check environment file
    if not check_env_file():
        return
    
    # Install Playwright
    if not install_playwright():
        return
    
    print("\n✓ Setup complete!")
    print("\nTo start the application:")
    print("1. python main.py")
    print("2. In another terminal: celery -A src.core.scheduler worker --loglevel=info")
    print("3. In another terminal: celery -A src.core.scheduler beat --loglevel=info")
    print("\nAccess dashboard at: http://localhost:8000")

if __name__ == "__main__":
    main()
