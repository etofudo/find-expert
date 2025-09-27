#!/usr/bin/env python3
"""
System test for Software Developer Job Finder
"""

import asyncio
import sys
import os
from pathlib import Path

# Add the project root to Python path
sys.path.insert(0, str(Path(__file__).parent))

def test_imports():
    """Test that all modules can be imported"""
    print("🔍 Testing imports...")
    
    try:
        from src.core.config import settings
        print("✅ Config imported successfully")
    except Exception as e:
        print(f"❌ Config import failed: {e}")
        return False
    
    try:
        from src.core.cv_parser import CVParser
        print("✅ CV Parser imported successfully")
    except Exception as e:
        print(f"❌ CV Parser import failed: {e}")
        return False
    
    try:
        from src.ai.cover_letter_generator import CoverLetterGenerator
        print("✅ Cover Letter Generator imported successfully")
    except Exception as e:
        print(f"❌ Cover Letter Generator import failed: {e}")
        return False
    
    try:
        from src.core.anti_detection import AntiDetectionManager
        print("✅ Anti-Detection Manager imported successfully")
    except Exception as e:
        print(f"❌ Anti-Detection Manager import failed: {e}")
        return False
    
    try:
        from src.scrapers.linkedin_scraper_auth import LinkedInScraperAuth
        print("✅ LinkedIn Scraper Auth imported successfully")
    except Exception as e:
        print(f"❌ LinkedIn Scraper Auth import failed: {e}")
        return False
    
    return True

def test_config():
    """Test configuration settings"""
    print("\n🔧 Testing configuration...")
    
    try:
        from src.core.config import settings
        
        # Test basic settings
        assert settings.candidate_name == "Israel Odufote", f"Expected 'Israel Odufote', got '{settings.candidate_name}'"
        assert settings.candidate_email == "johnnyodufote@gmail.com", f"Expected 'johnnyodufote@gmail.com', got '{settings.candidate_email}'"
        assert settings.candidate_phone == "+2349037709934", f"Expected '+2349037709934', got '{settings.candidate_phone}'"
        
        print("✅ Basic configuration correct")
        
        # Test job keywords
        assert len(settings.job_keywords) > 0, "No job keywords configured"
        assert "software developer" in settings.job_keywords, "Software developer keyword missing"
        assert "javascript" in settings.job_keywords, "JavaScript keyword missing"
        
        print("✅ Job keywords configured correctly")
        
        # Test user agents
        assert len(settings.user_agents) > 0, "No user agents configured"
        
        print("✅ User agents configured correctly")
        
        return True
        
    except Exception as e:
        print(f"❌ Configuration test failed: {e}")
        return False

def test_cv_parser():
    """Test CV parser"""
    print("\n📄 Testing CV parser...")
    
    try:
        from src.core.cv_parser import CVParser
        
        parser = CVParser()
        data = parser.extract_resume_data()
        
        # Test that we get expected data structure
        required_fields = ['name', 'email', 'phone', 'location', 'github', 'linkedin', 'experience', 'skills']
        for field in required_fields:
            assert field in data, f"Missing field: {field}"
        
        # Test specific values
        assert data['name'] == "Israel Odufote", f"Expected 'Israel Odufote', got '{data['name']}'"
        assert data['email'] == "johnnyodufote@gmail.com", f"Expected 'johnnyodufote@gmail.com', got '{data['email']}'"
        
        print("✅ CV parser working correctly")
        return True
        
    except Exception as e:
        print(f"❌ CV parser test failed: {e}")
        return False

def test_cover_letter_generator():
    """Test cover letter generator"""
    print("\n📝 Testing cover letter generator...")
    
    try:
        from src.ai.cover_letter_generator import CoverLetterGenerator
        
        generator = CoverLetterGenerator()
        
        # Test basic cover letter generation
        cover_letter = generator._generate_basic_cover_letter(
            "Software Developer", 
            "Test Company", 
            "Test job description"
        )
        
        # Check that it contains expected content
        assert "ODUFOTE ISRAEL" in cover_letter, "Name not found in cover letter"
        assert "New Horizons awards" in cover_letter, "New Horizons award not mentioned"
        assert "First Class Honour's degree" in cover_letter, "Education not mentioned"
        assert "8 years of experience" in cover_letter, "Experience not mentioned"
        
        print("✅ Cover letter generator working correctly")
        return True
        
    except Exception as e:
        print(f"❌ Cover letter generator test failed: {e}")
        return False

def test_anti_detection():
    """Test anti-detection manager"""
    print("\n🛡️ Testing anti-detection manager...")
    
    try:
        from src.core.anti_detection import AntiDetectionManager
        
        manager = AntiDetectionManager()
        
        # Test user agent generation
        user_agent = manager.get_random_user_agent()
        assert isinstance(user_agent, str), "User agent should be a string"
        assert len(user_agent) > 0, "User agent should not be empty"
        
        # Test viewport generation
        viewport = manager.get_random_viewport_size()
        assert 'width' in viewport, "Viewport should have width"
        assert 'height' in viewport, "Viewport should have height"
        assert viewport['width'] > 0, "Viewport width should be positive"
        assert viewport['height'] > 0, "Viewport height should be positive"
        
        print("✅ Anti-detection manager working correctly")
        return True
        
    except Exception as e:
        print(f"❌ Anti-detection manager test failed: {e}")
        return False

def test_file_structure():
    """Test that required files exist"""
    print("\n📁 Testing file structure...")
    
    required_files = [
        "templates/israel_odufote_cover_letter.txt",
        "src/core/config.py",
        "src/core/cv_parser.py",
        "src/ai/cover_letter_generator.py",
        "src/core/anti_detection.py",
        "src/scrapers/linkedin_scraper_auth.py",
        "env.example",
        "requirements.txt"
    ]
    
    missing_files = []
    for file_path in required_files:
        if not Path(file_path).exists():
            missing_files.append(file_path)
    
    if missing_files:
        print(f"❌ Missing files: {missing_files}")
        return False
    
    print("✅ All required files exist")
    return True

def test_environment_setup():
    """Test environment setup"""
    print("\n🌍 Testing environment setup...")
    
    # Check if .env exists
    if not Path(".env").exists():
        print("⚠️  .env file not found - you'll need to create it from env.example")
        return False
    
    print("✅ .env file exists")
    return True

async def test_linkedin_scraper():
    """Test LinkedIn scraper (without actually running it)"""
    print("\n🔗 Testing LinkedIn scraper...")
    
    try:
        from src.scrapers.linkedin_scraper_auth import LinkedInScraperAuth
        
        # Test that the class can be instantiated
        scraper = LinkedInScraperAuth()
        assert scraper is not None, "LinkedIn scraper should be instantiable"
        
        print("✅ LinkedIn scraper can be instantiated")
        print("⚠️  Note: Full LinkedIn test requires credentials in .env")
        return True
        
    except Exception as e:
        print(f"❌ LinkedIn scraper test failed: {e}")
        return False

def main():
    """Run all tests"""
    print("🚀 Software Developer Job Finder - System Test")
    print("=" * 60)
    
    tests = [
        ("File Structure", test_file_structure),
        ("Imports", test_imports),
        ("Configuration", test_config),
        ("CV Parser", test_cv_parser),
        ("Cover Letter Generator", test_cover_letter_generator),
        ("Anti-Detection", test_anti_detection),
        ("Environment Setup", test_environment_setup),
    ]
    
    passed = 0
    total = len(tests)
    
    for test_name, test_func in tests:
        try:
            if test_func():
                passed += 1
            else:
                print(f"❌ {test_name} test failed")
        except Exception as e:
            print(f"❌ {test_name} test failed with exception: {e}")
    
    # Test LinkedIn scraper separately (async)
    try:
        if asyncio.run(test_linkedin_scraper()):
            passed += 1
        total += 1
    except Exception as e:
        print(f"❌ LinkedIn scraper test failed with exception: {e}")
        total += 1
    
    print("\n" + "=" * 60)
    print(f"📊 Test Results: {passed}/{total} tests passed")
    
    if passed == total:
        print("🎉 All tests passed! System is ready to use.")
        print("\nNext steps:")
        print("1. Copy env.example to .env")
        print("2. Add your LinkedIn credentials to .env")
        print("3. Add your resume PDF to resumes/israel_odufote_resume.pdf")
        print("4. Run: python start.py")
    else:
        print("❌ Some tests failed. Please fix the issues above.")
    
    return passed == total

if __name__ == "__main__":
    success = main()
    sys.exit(0 if success else 1)
