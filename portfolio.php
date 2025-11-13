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
            <li style=" font-size: 15px; padding: 8px 0px;"><a href="index.php#education">EDUCATION</a></li>
            <li style=" font-size: 15px; padding: 8px 0px;"><a href="index.php#skills">SKILLS</a></li>
            <li style=" font-size: 15px; padding: 8px 0px;"><a href="index.php#expertise">EXPERTISE</a></li>
            <li style=" font-size: 15px; padding: 8px 0px;"><a href="contact.php#contact">CONTACT</a></li>
        </ul>
    </nav>
    </header>

    <section class="profile">
        <div class="profile-container">
            <div class="profile-image">
                <img src="images/un.png" alt="He Suye">
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

    <!-- Achievements Section -->
    <section id="portfolio" class="achievements">
        <h2>ACHIEVEMENTS</h2>
        <div class="achievements-container">

            <div class="achievement-box">
                <img src="images/physics.png" alt="Achievement">
                <div class="achievement-info">
                    <h4>PHYSICS FAIR</h4>
                    <p>
                        Participated in section-based Physics Fair competition with a project
                        titled Application of Hydromechanics in Deep Water Culture (DWC) of 
                        Hydroponics System on Lettuce, demonstrating the practical use of
                        physics in sustainable agriculture.
                    </p>
                </div>
            </div>

            <div class="achievement-box">
                <img src="images/eng.png" alt="Achievement">
                <div class="achievement-info">
                    <h4>ENGLISH WEEK: REENACRMENT</h4>
                    <p>
                        Participated in a section-based competition reenacting a  
                        literary work titled “Alamat ng Buwan at Bituin.” Demonstrated creativity and 
                        teamwork through acting, costume design, set creation, and booth presentation. 
                        Awarded Champion for outstanding creativity and overall execution.
                    </p>
                </div>
            </div>

            <div class="achievement-box">
                <img src="images/sh.png" alt="Achievement">
                <div class="achievement-info">
                    <h4>SENIOR HIGH GRADUATE</h4>
                    <p>
                        Graduated with honors from Our Lady of Fatima University in 2024, 
                        recognizing consistent academic excellence throughout Senior High School.
                    </p>
                </div>
            </div>

            <div class="achievement-box">
                <img src="images/mv.png" alt="Achievement">
                <div class="achievement-info">
                    <h4>MOVING UP: GRADE 11</h4>
                    <p>
                        Moved in to Grade 12 with High Honors under the STEM strand, reflecting strong 
                        acedative achievement.

                    </p>
                </div>
            </div>

        </div>
    </section>
    

    <!-- Hobbies Section -->
    <section id="hobbies" class="hobbies">
        <h2>HOBBIES</h2>
        <div class="hobbies-container">
            <div class="hobby-box">
                <img src="images/a.png" alt="Hobby 1">
                <div class="hobby-info">
                    <h4>WATCHING SERIES</h4>
                    <p>I enjoy watching different kinds of series, from dramas to thrillers, 
                        to relax and explore different stories and cultures. It also inspires 
                        my creativity and helps me unwind after a long day.</p>
                </div>
            </div>

            <div class="hobby-box">
                <img src="images/b.png" alt="Hobby 2">
                <div class="hobby-info">
                    <h4>TAKING PHOTOS</h4>
                    <p>Capturing moments and scenes is one of my favorite ways to express myself. 
                        I love taking photos of sunsets, nature, and everyday life, finding beauty 
                        in small details that often go unnoticed.</p>
                </div>
            </div>

            <div class="hobby-box">
                <img src="images/c.png" alt="Hobby 3">
                <div class="hobby-info">
                    <h4>MAKE UP</h4>
                    <p>Doing makeup is both my hobby and a form of art. I love experimenting with 
                        different looks and products, learning new techniques, and expressing confidence 
                        through colors and creativity.</p>
                </div>
            </div>
        </div>
    </section>

<style>
    footer {
  background-color: #ffffff;
  text-align: center;
  padding: 15px 0;
  font-size: 14px;
  height: auto;
  width: 100%;
  border-top: 1px solid #f0f0f0;
}

footer p {
  margin: 0 0 10px 0;
  letter-spacing: 0.5px;
  color: #0b1d4a;
}

.admin-access {
  margin-top: 12px;
  padding-top: 12px;
  border-top: 1px solid #f0f0f0;
}

.admin-link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  text-decoration: none;
  color: #666;
  font-size: 13px;
  transition: all 0.3s ease;
  padding: 8px 16px;
  border-radius: 6px;
}

.admin-link:hover {
  color: #0b1d4a;
  background: #f8f9fa;
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