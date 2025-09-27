#!/usr/bin/env python3
"""
Simple system test for Software Developer Job Finder
"""

import sys
from pathlib import Path

# Add the project root to Python path
sys.path.insert(0, str(Path(__file__).parent))

def test_basic_functionality():
    """Test basic functionality without complex imports"""
    print("🚀 Software Developer Job Finder - Simple Test")
    print("=" * 60)
    
    # Test 1: Config
    try:
        from src.core.config import settings
        print("✅ Config loaded successfully")
        print(f"   - Name: {settings.candidate_name}")
        print(f"   - Email: {settings.candidate_email}")
        print(f"   - Phone: {settings.candidate_phone}")
        print(f"   - GitHub: {settings.candidate_github}")
        print(f"   - LinkedIn: {settings.candidate_linkedin}")
    except Exception as e:
        print(f"❌ Config failed: {e}")
        return False
    
    # Test 2: Cover Letter Template
    try:
        template_path = Path("templates/israel_odufote_cover_letter.txt")
        if template_path.exists():
            with open(template_path, 'r', encoding='utf-8') as f:
                template = f.read()
            print("✅ Cover letter template loaded successfully")
            print(f"   - Template length: {len(template)} characters")
        else:
            print("❌ Cover letter template not found")
            return False
    except Exception as e:
        print(f"❌ Cover letter template failed: {e}")
        return False
    
    # Test 3: CV Parser (without PDF)
    try:
        from src.core.cv_parser import CVParser
        parser = CVParser()
        data = parser.extract_resume_data()
        print("✅ CV Parser working (using default data)")
        print(f"   - Name: {data['name']}")
        print(f"   - Experience: {data['experience']}")
        print(f"   - Skills count: {len(data['skills'])}")
    except Exception as e:
        print(f"❌ CV Parser failed: {e}")
        return False
    
    # Test 4: Cover Letter Generator
    try:
        from src.ai.cover_letter_generator import CoverLetterGenerator
        generator = CoverLetterGenerator()
        cover_letter = generator._generate_basic_cover_letter(
            "Software Developer", 
            "Test Company", 
            "Test job description"
        )
        print("✅ Cover letter generator working")
        print(f"   - Cover letter length: {len(cover_letter)} characters")
        print(f"   - Contains name: {'ODUFOTE ISRAEL' in cover_letter}")
        print(f"   - Contains New Horizons: {'New Horizons awards' in cover_letter}")
    except Exception as e:
        print(f"❌ Cover letter generator failed: {e}")
        return False
    
    # Test 5: Anti-Detection
    try:
        from src.core.anti_detection import AntiDetectionManager
        manager = AntiDetectionManager()
        user_agent = manager.get_random_user_agent()
        viewport = manager.get_random_viewport_size()
        print("✅ Anti-detection manager working")
        print(f"   - User agent length: {len(user_agent)}")
        print(f"   - Viewport: {viewport['width']}x{viewport['height']}")
    except Exception as e:
        print(f"❌ Anti-detection manager failed: {e}")
        return False
    
    # Test 6: File Structure
    required_files = [
        "templates/israel_odufote_cover_letter.txt",
        "src/core/config.py",
        "src/core/cv_parser.py",
        "src/ai/cover_letter_generator.py",
        "src/core/anti_detection.py",
        "env.example",
        "requirements_simple.txt"
    ]
    
    missing_files = []
    for file_path in required_files:
        if not Path(file_path).exists():
            missing_files.append(file_path)
    
    if missing_files:
        print(f"❌ Missing files: {missing_files}")
        return False
    else:
        print("✅ All required files exist")
    
    print("\n" + "=" * 60)
    print("🎉 Basic functionality test PASSED!")
    print("=" * 60)
    
    print("\n📋 SYSTEM STATUS:")
    print("✅ Configuration: Working")
    print("✅ Cover Letter Template: Working")
    print("✅ CV Parser: Working")
    print("✅ Cover Letter Generator: Working")
    print("✅ Anti-Detection: Working")
    print("✅ File Structure: Complete")
    
    print("\n⚠️  REMAINING REQUIREMENTS:")
    print("1. 📄 Add your resume PDF to: resumes/israel_odufote_resume.pdf")
    print("2. 🔑 Add LinkedIn credentials to .env file")
    print("3. 🗄️ Install and configure PostgreSQL and Redis")
    print("4. 🧪 Test with actual job applications")
    
    print("\n🚀 NEXT STEPS:")
    print("1. Copy your resume PDF to the resumes folder")
    print("2. Edit .env file with your LinkedIn credentials")
    print("3. Install PostgreSQL and Redis")
    print("4. Run: python start.py")
    
    return True

if __name__ == "__main__":
    success = test_basic_functionality()
    sys.exit(0 if success else 1)
