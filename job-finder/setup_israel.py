#!/usr/bin/env python3
"""
Setup script for Israel Odufote's Software Developer Job Finder
"""

import os
import sys
import subprocess
from pathlib import Path

def create_directories():
    """Create necessary directories"""
    print("📁 Creating directories...")
    
    directories = [
        "resumes",
        "logs", 
        "static",
        "templates",
        "data"
    ]
    
    for directory in directories:
        Path(directory).mkdir(exist_ok=True)
        print(f"✅ Created directory: {directory}")

def install_requirements():
    """Install Python requirements"""
    print("📦 Installing Python requirements...")
    try:
        subprocess.run([sys.executable, "-m", "pip", "install", "-r", "requirements.txt"], check=True)
        print("✅ Requirements installed successfully")
        return True
    except subprocess.CalledProcessError as e:
        print(f"❌ Error installing requirements: {e}")
        return False

def install_playwright():
    """Install Playwright browsers"""
    print("🎭 Installing Playwright browsers...")
    try:
        subprocess.run([sys.executable, "-m", "playwright", "install"], check=True)
        print("✅ Playwright browsers installed successfully")
        return True
    except subprocess.CalledProcessError as e:
        print(f"❌ Error installing Playwright: {e}")
        return False

def setup_env_file():
    """Setup environment file"""
    print("⚙️ Setting up environment file...")
    
    if Path(".env").exists():
        print("✅ .env file already exists")
        return True
    
    if Path("env.example").exists():
        try:
            import shutil
            shutil.copy("env.example", ".env")
            print("✅ .env file created from template")
            print("⚠️  Please edit .env file with your configuration")
            return True
        except Exception as e:
            print(f"❌ Error creating .env file: {e}")
            return False
    else:
        print("❌ env.example file not found")
        return False

def create_resume_placeholder():
    """Create placeholder for resume file"""
    print("📄 Setting up resume placeholder...")
    
    resume_path = Path("resumes/israel_odufote_resume.pdf")
    if not resume_path.exists():
        # Create a placeholder file
        resume_path.touch()
        print("✅ Created resume placeholder: resumes/israel_odufote_resume.pdf")
        print("⚠️  Please replace this with your actual resume PDF file")
    else:
        print("✅ Resume file already exists")

def test_system():
    """Test the system after setup"""
    print("\n🧪 Testing system...")
    try:
        result = subprocess.run([sys.executable, "test_system.py"], 
                              capture_output=True, text=True, timeout=60)
        if result.returncode == 0:
            print("✅ System test passed!")
            return True
        else:
            print("❌ System test failed!")
            print("Error output:", result.stderr)
            return False
    except subprocess.TimeoutExpired:
        print("⏰ System test timed out")
        return False
    except Exception as e:
        print(f"❌ System test error: {e}")
        return False

def print_next_steps():
    """Print next steps for the user"""
    print("\n" + "="*60)
    print("🎉 Setup completed successfully!")
    print("="*60)
    print("\n📋 NEXT STEPS:")
    print("\n1. 📄 Add your resume:")
    print("   - Place your resume PDF in: resumes/israel_odufote_resume.pdf")
    print("   - Make sure it's named exactly: israel_odufote_resume.pdf")
    
    print("\n2. 🔑 Configure authentication:")
    print("   - Edit .env file with your job site credentials")
    print("   - Add LinkedIn email and password")
    print("   - Add other job site credentials as needed")
    print("   - Add OpenAI API key for AI cover letters")
    
    print("\n3. 🗄️ Setup Database (REQUIRED):")
    print("   - Install PostgreSQL: https://www.postgresql.org/download/")
    print("   - Install Redis: https://redis.io/download")
    print("   - Create database: createdb job_finder")
    print("   - Update DATABASE_URL in .env file")
    
    print("\n4. 🧪 Test the system:")
    print("   - Run: python test_system.py")
    print("   - Fix any issues that come up")
    
    print("\n5. 🚀 Start the system:")
    print("   - Run: python start.py")
    print("   - Open: http://localhost:8000/dashboard")
    
    print("\n6. 📊 Monitor applications:")
    print("   - Check the dashboard for job applications")
    print("   - Review logs for any issues")
    print("   - Adjust settings as needed")
    
    print("\n⚠️  CRITICAL REQUIREMENTS:")
    print("   - LinkedIn credentials are REQUIRED for job applications")
    print("   - PostgreSQL database must be running")
    print("   - Redis must be running")
    print("   - Resume PDF must be in correct location")
    print("   - Test with a small number of applications first")
    
    print("\n🔧 TROUBLESHOOTING:")
    print("   - Run: python test_system.py to diagnose issues")
    print("   - Check logs/ directory for error messages")
    print("   - Ensure all credentials are correct")
    print("   - Verify resume file is accessible")
    print("   - Check database and Redis connections")

def main():
    """Main setup function"""
    print("🚀 Software Developer Job Finder - Setup for Israel Odufote")
    print("="*60)
    
    success = True
    
    # Create directories
    create_directories()
    
    # Install requirements
    if not install_requirements():
        success = False
    
    # Install Playwright
    if not install_playwright():
        success = False
    
    # Setup environment file
    if not setup_env_file():
        success = False
    
    # Create resume placeholder
    create_resume_placeholder()
    
    # Test the system
    if success:
        test_system()
    
    print("\n" + "="*60)
    
    if success:
        print_next_steps()
    else:
        print("❌ Setup failed. Please check the errors above.")
        print("You may need to install dependencies manually:")
        print("pip install -r requirements.txt")
        print("playwright install")
    
    return success

if __name__ == "__main__":
    main()
