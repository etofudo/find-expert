#!/usr/bin/env python3
"""
Installation script for Expert Job Finder
"""

import subprocess
import sys
import os
from pathlib import Path

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

def create_directories():
    """Create necessary directories"""
    print("📁 Creating directories...")
    
    directories = ["static", "templates", "logs"]
    
    for directory in directories:
        Path(directory).mkdir(exist_ok=True)
        print(f"✅ Created directory: {directory}")
    
    return True

def main():
    """Main installation function"""
    print("🚀 Expert Job Finder - Installation")
    print("=" * 50)
    
    success = True
    
    # Create directories
    if not create_directories():
        success = False
    
    # Install requirements
    if not install_requirements():
        success = False
    
    # Install Playwright
    if not install_playwright():
        success = False
    
    # Setup environment file
    if not setup_env_file():
        success = False
    
    print("\n" + "=" * 50)
    
    if success:
        print("🎉 Installation completed successfully!")
        print("\nNext steps:")
        print("1. Edit .env file with your configuration")
        print("2. Run: python start.py")
        print("3. Open http://localhost:8000/dashboard")
    else:
        print("❌ Installation failed. Please check the errors above.")
    
    return success

if __name__ == "__main__":
    main()
