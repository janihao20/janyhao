<?php
    $dbFile = __DIR__ . '/../backend/db-config.php';
    $dbFile = __DIR__ . '/backend/db-config.php';
     if (file_exists($dbFile)) {
         require_once $dbFile;
     } else {
         http_response_code(500);
         echo 'Configuration file not found: ' . htmlspecialchars($dbFile);
         exit;
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Janelle S. Terez</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<style>
    /* Smooth transitions for all elements */
    * {
      transition: all 0.3s ease;
    }

    /* Header */
    header {
      position: fixed;
      top: 0; left: 0;
      width: 100%;
      z-index: 1000;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 80px;
      background: white;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }


    nav ul {
      list-style: none;
      display: flex;
      gap: 25px;
    }

    nav a {
      text-decoration: none;
      color: #333;
      font-size: 15px;
      font-weight: 500;
      position: relative;
    }

    /* Animated underline effect */
    nav a::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: -4px;
      width: 0%;
      height: 2px;
      background: #0b1d4a;
      transition: width 0.3s ease;
    }

    nav a:hover::after {
      width: 100%;
    }

    nav a:hover {
      color: #0b1d4a;
    }

    /* Profile Section */
    .profile {
      background: url('images/bg2.png') no-repeat center/cover;
      padding: 100px 0 60px;
      text-align: center;
    }

    .profile-container {
      display: flex;
      flex-wrap: wrap;
      background: white;
      width: 75%;
      margin: 0 auto;
      box-shadow: 0 8px 18px rgba(0,0,0,0.1);
      border-radius: 8px;
      overflow: hidden;
    }


    .profile-info {
      flex: 1;
      padding: 40px;
      text-align: left;
      color: #333;
    }

    .social-icons a img {
      width: 32px; height: 31px;
      transition: transform 0.3s ease, filter 0.3s ease;
    }

    .social-icons a img:hover {
      transform: scale(1.15);
      filter: brightness(1.1);
    }

    /* Section Titles */
 
    /* Education */
    .education-item {
      display: flex;
      justify-content: center;
      gap: 40px;
      margin-bottom: 50px;
      text-align: left;
    }

    .edu-details {
      border-left: 0.5px solid #bbbbbbff;
      padding-left: 40px;
    }

    .education-item:hover .edu-details {
      transform: translateX(10px);
    }

    /* Skills Boxes */
    .skills {
      background: #0b1d4a;
      color: white;
      text-align: center;
      padding: 80px 10%;
    }

    .skills-box {
      background: rgba(255,255,255,0.1);
      border-radius: 6px;
      padding: 15px;
      transition: transform 0.3s ease, background 0.3s ease;
    }

    .skills-box:hover {
      transform: translateY(-8px);
      background: rgba(255,255,255,0.2);
    }

    /* Expertise Boxes */
    .expertise-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
      padding: 0 10%;
    }

    .expertise-box {
      background: #fff;
      border: 1px solid #eee;
      border-radius: 6px;
      padding: 25px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .expertise-box:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    /* Contact Button Hover */
    .contact-form button {
      background-color: #0b1d4a;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .contact-form button:hover {
      background-color: #142f7a;
      transform: scale(1.05);
    }

    /* Fade-in on Scroll (optional) */
    [data-animate] {
      opacity: 0;
      transform: translateY(20px);
    transition: all 0.6s ease-out;
    }

    [data-animate].visible {
      opacity: 1;
      transform: translateY(0);
    }
</style>

<header>
    <h2 class="logo"><a href="index.php">Janelle</a></h2>
    <nav>
        <ul>
            <li style=" font-size: 15px; padding: 8px 0px;"><a href="index.php">HOME</a></li>
            <li style=" font-size: 15px; padding: 8px 0px;"><a href="portfolio.php#portfolio">PORTFOLIO</a></li>
            <li style=" font-size: 15px; padding: 8px 0px;"><a href="#education">EDUCATION</a></li>
            <li style=" font-size: 15px; padding: 8px 0px;"><a href="#skills">SKILLS</a></li>
            <li style=" font-size: 15px; padding: 8px 0px;"><a href="#expertise">EXPERTISE</a></li>
            <li style=" font-size: 15px; padding: 8px 0px;"><a href="contact.php#contact">CONTACT</a></li>
        </ul>
    </nav>
</header>

<section class="profile">
    <div class="profile-container">
        <div class="profile-image">
            <img src="images/un.png" alt="profile">
        </div>

        <div class="profile-info">
            <h2>Janelle S. Terez</h2>
            <h4>SECOND YEAR COLLEGE STUDENT</h4>

            <p><strong>Phone:</strong><br>+63 947 - 608 - 6627</p>
            <p><strong>Email:</strong><br>janelleterez90@gmail.com</p>
            <p><strong>Address:</strong><br>Block 2 Lot 3 San Gabriel<br>Batasan Hills, Quezon City Philippines</p>
            <p><strong>Date of Birth:</strong><br>December 20, 2005</p>
            <p><strong>Socials:</strong></p>
        
            <div class="social-icons">
                <a href="https://www.instagram.com/jahny.hao_" target="_blank">
                    <img src="images/social.png" alt="Instagram" style="width: 32px; height: 31px;">
                </a>
                <a href="https://www.facebook.com/Janeel.Terz" target="_blank">
                    <img src="images/facebook.png" alt="Facebook" style="width: 32px; height: 31px;">
                </a>
                <a href="mailto:janelleterez90@gmail.com" target="_blank">
                    <img src="images/gmail.png" alt="Gmail" style="width: 32px; height: 31px;">
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Introduction Section -->
<section class="introduction">
    <h2>Hello! I'm Janelle</h2>
    <p>
        I'm an Information Technology student at Our Lady of Fatima University who 
        is passionate about technology and loves exploring new advancements in the field. 
        I’m eager to learn and grow as a professional, and I’m excited to see where my career in IT will take me.
        
    </p>
</section>

<!-- Education Section -->
<section id="education" class="education">
    <h2>EDUCATION</h2>

    <div class="education-item">
        <div class="year-degree">
            <p>2024-Present</p>
            <h4>Bachelor’s Degree</h4>
        </div>
        <div class="edu-details">
            <h5>UNIVERSITY</h5>
            <p>
                Pursuing a Bachelor of Science in Information Technology. Currently 
                learning web development, database management, and software design. Active 
                in academic events and campus events, enhancing both technical and communication skills.
            </p>
        </div>
    </div>

    <div class="education-item">
        <div class="year-degree">
            <p>2018-2024</p>
            <h4>High School Degree</h4>
        </div>
        <div class="edu-details">
            <h5>HIGH SCHOOL</h5>
            <p>
                Graduated with high honors during junior high and honor in senior high, recognized for academic excellence. 
                Actively participated in students competitions and performing arts. 
                Developed teamwork and communication skills through various school projects and competitions.
            </p>
        </div>
    </div>

    <div class="education-item">
        <div class="year-degree">
            <p>2012–2013</p>
            <h4>Elementary School Diploma</h4>
        </div>
        <div class="edu-details">
            <h5>ELEMENTARY SCHOOL</h5>
            <p>
                Completed primary education with consistent academic performance. Built a strong foundation 
                in core subjects and participated in school programs that nurtured creativity and discipline.
            </p>
        </div>
    </div>
</section>

<!-- Skills Section -->
<section id="skills" class="skills">
    <h2>SKILLS</h2>
    <div class="skills-container">
        <div class="skills-box">
            <p><strong>Microsoft Excel - Proficient</strong></p>
        </div>
        <div class="skills-box">
            <p><strong>Figma - Proficient</strong></p>
        </div>
        <div class="skills-box">
            <p><strong>Microsoft Word - Proficient</strong></p>
        </div>
        <div class="skills-box">
            <p><strong>Filipino - Mother Tongue</strong></p>
        </div>
        <div class="skills-box">
            <p><strong>PowerPoint - Proficient</strong></p>
        </div>
        <div class="skills-box">
            <p><strong>English - Advanced</strong></p>
        </div>
    </div>
</section>

<!-- Expertise Section -->
<section id="expertise" class="expertise">
    <h2>EXPERTISE</h2>
    <div class="expertise-container">
        <div class="expertise-box">
            <h4>FOUNDATIONAL CONTENT STRATEGY</h4>
            <p>
                I am capable of curating and scheduling engaging digital content across social media platforms. 
                My focus is on sourcing, editing, and scheduling content while ensuring basic alignment with 
                simple brand messaging and visual identity guidelines.
            </p>
        </div>
        <div class="expertise-box">
            <h4>BASIC UI/UX PROTOTYPING</h4>
            <p>
                I have practical experience using Figma for fundamental user interface (UI) and user experience 
                (UX) tasks, including creating simple wireframes, building component libraries, and developing 
                basic interactive prototypes for web or mobile concepts.
            </p>
        </div>
        <div class="expertise-box">
            <h4>DATA ORGANIZATION & REPORTING</h4>
            <p>
                Experienced in leveraging Microsoft Excel and PowerPoint to analyze data, generate 
                insightful reports, and create clear, compelling presentations for stakeholders.
            </p>
        </div>
    </div>
</section>


<style>
    footer {
  background-color: #0b1d4a;
  text-align: center;
  padding: 15px 0;
  font-size: 14px;
  height: auto;
  width: 100%;
}

footer p {
  margin: 0 0 10px 0;
  letter-spacing: 0.5px;
  color: #f7f7f7ff;
}

.admin-access {
  margin-top: 12px;
  padding-top: 12px;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.admin-link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  text-decoration: none;
  color: rgba(255, 255, 255, 0.7);
  font-size: 13px;
  transition: all 0.3s ease;
  padding: 8px 16px;
  border-radius: 6px;
}

.admin-link:hover {
  color: white;
  background: rgba(255, 255, 255, 0.1);
}

.admin-link svg {
  transition: transform 0.3s ease;
}

.admin-link:hover svg {
  transform: translateX(3px);
}
</style>

<footer>
    <p>© 2025 Janelle S. Terez. All rights reserved.</p>
    <div class="admin-access">
        <a href="admin/" class="admin-link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
            Are you the admin? Click here to access dashboard
        </a>
    </div>
</footer>

</body>
</html>