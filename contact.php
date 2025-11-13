<?php
// Only include DB config if you need DB connection server-side in this page.
// Use an absolute path relative to this file to avoid wrong relative resolution.
if (file_exists(__DIR__ . '/../backend/db-config.php')) {
  require_once __DIR__ . '/../backend/db-config.php';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact - Janelle S. Terez</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    /* Minimal inline styles only — keep major styles in style.css */
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: Arial, Helvetica, sans-serif;
      color: #222;
    }

    header {
      background: #fff;
      padding: 16px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 100;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
    }

    .logo a {
      text-decoration: none;
      color: #0b1d4a;
      font-weight: 700;
    }

    .contact {
      background: #f4f4f8;
      padding: 80px 10%;
      text-align: center;
      border-top: 1px solid #eee;
    }

    .contact-container {
      display: flex;
      gap: 40px;
      justify-content: center;
      align-items: flex-start;
      flex-wrap: wrap;
      max-width: 1100px;
      margin: 0 auto;
    }

    .contact-form {
      flex: 1 1 420px;
      text-align: left;
      max-width: 600px;
    }

    .contact-info {
      flex: 0 0 300px;
      text-align: left;
    }

    label {
      display: block;
      margin: 10px 0 6px;
      font-size: 13px;
      color: #333;
    }

    input,
    textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #0b1d4a;
      border-radius: 4px;
      font-size: 14px;
    }

    button {
      background: #0b1d4a;
      color: #fff;
      border: none;
      padding: 10px 16px;
      border-radius: 4px;
      cursor: pointer;
    }

    .reveal {
      display: none;
      opacity: 0;
      transform: translateY(8px);
      transition: all .25s ease;
    }

    .visible {
      display: block;
      opacity: 1;
      transform: translateY(0);
    }

    .error-message {
      display: none;
      color: #f44336;
      font-size: 13px;
      margin-top: 4px;
      margin-bottom: 8px;
      font-weight: 500;
    }

    .error-message.show {
      display: block;
      animation: slideIn 0.3s ease-out;
    }

    input.error,
    textarea.error {
      border-color: #f44336;
      background-color: #fff5f5;
    }

    input.success,
    textarea.success {
      border-color: #4caf50;
    }

    #formStatus {
      display: none;
      padding: 12px 16px;
      border-radius: 6px;
      color: #fff;
      font-size: 15px;
      font-weight: 500;
      align-items: center;
      gap: 10px;
      animation: slideIn 0.4s ease-out;
      max-width: 100%;
      box-sizing: border-box;
    }

    #formStatus.show {
      display: flex;
    }

    #formStatus.success {
      background: linear-gradient(135deg, #4caf50 0%, #45a049 100%);
      box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
    }

    #formStatus.error {
      background: linear-gradient(135deg, #f44336 0%, #e53935 100%);
      box-shadow: 0 4px 12px rgba(244, 67, 54, 0.3);
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes slideOut {
      from {
        opacity: 1;
        transform: translateY(0);
      }
      to {
        opacity: 0;
        transform: translateY(-10px);
      }
    }

    .success-icon {
      width: 24px;
      height: 24px;
      flex-shrink: 0;
    }

    .success-icon circle {
      stroke-dasharray: 166;
      stroke-dashoffset: 166;
      animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
    }

    .success-icon path {
      stroke-dasharray: 48;
      stroke-dashoffset: 48;
      animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.4s forwards;
    }

    @keyframes stroke {
      to {
        stroke-dashoffset: 0;
      }
    }

    footer {
      background: #0b1d4a;
      color: #fff;
      text-align: center;
      padding: 15px 0;
      margin-top: 40px;
    }

    footer p {
      margin: 0 0 10px 0;
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

    @media (max-width:900px) {
      .contact-container {
        flex-direction: column;
        align-items: center;
      }

      .contact-info,
      .contact-form {
        text-align: center;
      }

      label {
        text-align: left;
      }
    }

    /* Smooth transitions for all elements */
    * {
      transition: all 0.3s ease;
    }

    /* Header */
    header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 80px;
      background: white;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
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
      box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
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
      width: 32px;
      height: 31px;
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
</head>

<body>
  <header>
    <h2 class="logo"><a href="index.php">Janelle</a></h2>
    <nav>
      <ul>
        <li><a href="index.php">HOME</a></li>
        <li><a href="portfolio.php#portfolio">PORTFOLIO</a></li>
        <li><a href="index.php#education">EDUCATION</a></li>
        <li><a href="index.php#skills">SKILLS</a></li>
        <li><a href="index.php#expertise">EXPERTISE</a></li>
        <li><a href="contact.php#contact">CONTACT</a></li>
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

  <section class="contact" id="contact">
    <h2>CONTACT ME</h2>
    <div class="contact-container">
      <form id="contactForm" class="contact-form" action="./backend/form-handler.php" method="POST" novalidate>
        <label for="fname">Your name</label>
        <input id="fname" name="fname" type="text" required autocomplete="name" />
        <div id="formStatus" role="status" aria-live="polite"></div>
        <span class="error-message" id="fnameError"></span>

        <div id="welcomeMessage" class="reveal" aria-hidden="true">
          <p>Hello, <strong id="userName"></strong> — please provide your email and message.</p>
        </div>

        <label id="emailLabel" class="reveal" for="email">Email</label>
        <input id="email" class="reveal" name="email" type="email" required autocomplete="email" />
        <span class="error-message reveal" id="emailError"></span>

        <label id="messageLabel" class="reveal" for="message">Message</label>
        <textarea id="message" class="reveal" name="message" rows="5" required></textarea>
        <span class="error-message reveal" id="messageError"></span>

        <button id="submitBtn" class="reveal" type="submit">Send Message</button>
        
      </form>

      <div class="contact-info">
        <h3>Contact details</h3>
        <p><strong>Phone:</strong><br />+63 947 - 608 - 6627</p>
        <p><strong>Email:</strong><br />janelleterez90@gmail.com</p>
        <p><strong>Address:</strong><br />Block 2 Lot 3 San Gabriel<br />Batasan Hills, Quezon City Philippines</p>
      </div>
    </div>
  </section>

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

  <script>
    (function() {
      const fname = document.getElementById('fname');
      const email = document.getElementById('email');
      const message = document.getElementById('message');
      const welcome = document.getElementById('welcomeMessage');
      const userName = document.getElementById('userName');
      const revealEls = [
        document.getElementById('emailLabel'), 
        email, 
        document.getElementById('emailError'),
        document.getElementById('messageLabel'), 
        message, 
        document.getElementById('messageError'),
        document.getElementById('submitBtn')
      ];
      const form = document.getElementById('contactForm');
      const statusBox = document.getElementById('formStatus');

      // Error message elements
      const fnameError = document.getElementById('fnameError');
      const emailError = document.getElementById('emailError');
      const messageError = document.getElementById('messageError');

      // Validation functions
      function validateName(value) {
        if (!value.trim()) {
          return 'Name is required.';
        }
        return '';
      }

      function validateEmail(value) {
        if (!value.trim()) {
          return 'Email is required.';
        }
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
          return 'Please enter a valid email address.';
        }
        return '';
      }

      function validateMessage(value) {
        if (!value.trim()) {
          return 'Message is required.';
        }
        if (value.trim().length < 10) {
          return 'Message must be at least 10 characters.';
        }
        return '';
      }

      function showError(input, errorElement, message) {
        input.classList.add('error');
        input.classList.remove('success');
        errorElement.textContent = message;
        errorElement.classList.add('show');
      }

      function clearError(input, errorElement) {
        input.classList.remove('error');
        input.classList.add('success');
        errorElement.textContent = '';
        errorElement.classList.remove('show');
      }

      // Real-time validation
      fname.addEventListener('blur', function() {
        const error = validateName(this.value);
        if (error) {
          showError(this, fnameError, error);
        } else {
          clearError(this, fnameError);
        }
      });

      fname.addEventListener('input', function() {
        const v = this.value.trim();
        
        // Clear error on input
        if (fnameError.classList.contains('show')) {
          const error = validateName(this.value);
          if (!error) {
            clearError(this, fnameError);
          }
        }

        if (v) {
          userName.textContent = v;
          welcome.classList.add('visible');
          welcome.classList.remove('reveal');
          welcome.setAttribute('aria-hidden', 'false');
          revealEls.forEach(e => {
            if (e) {
              e.classList.add('visible');
              e.classList.remove('reveal');
            }
          });
        } else {
          userName.textContent = '';
          welcome.classList.add('reveal');
          welcome.classList.remove('visible');
          welcome.setAttribute('aria-hidden', 'true');
          revealEls.forEach(e => {
            if (e) {
              e.classList.add('reveal');
              e.classList.remove('visible');
            }
          });
        }
      });

      email.addEventListener('blur', function() {
        if (this.classList.contains('visible')) {
          const error = validateEmail(this.value);
          if (error) {
            showError(this, emailError, error);
          } else {
            clearError(this, emailError);
          }
        }
      });

      email.addEventListener('input', function() {
        if (emailError.classList.contains('show')) {
          const error = validateEmail(this.value);
          if (!error) {
            clearError(this, emailError);
          }
        }
      });

      message.addEventListener('blur', function() {
        if (this.classList.contains('visible')) {
          const error = validateMessage(this.value);
          if (error) {
            showError(this, messageError, error);
          } else {
            clearError(this, messageError);
          }
        }
      });

      message.addEventListener('input', function() {
        if (messageError.classList.contains('show')) {
          const error = validateMessage(this.value);
          if (!error) {
            clearError(this, messageError);
          }
        }
      });

      form.addEventListener('submit', function(e) {
        e.preventDefault();
        statusBox.classList.remove('show', 'success', 'error');

        // Validate all fields
        const nameErr = validateName(fname.value);
        const emailErr = validateEmail(email.value);
        const messageErr = validateMessage(message.value);

        let hasError = false;

        if (nameErr) {
          showError(fname, fnameError, nameErr);
          hasError = true;
        } else {
          clearError(fname, fnameError);
        }

        if (emailErr) {
          showError(email, emailError, emailErr);
          hasError = true;
        } else {
          clearError(email, emailError);
        }

        if (messageErr) {
          showError(message, messageError, messageErr);
          hasError = true;
        } else {
          clearError(message, messageError);
        }

        if (hasError) {
          return;
        }

        const fd = new FormData(form);
        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.textContent = 'Sending...';

        fetch('./backend/form-handler.php', {
            method: 'POST',
            body: fd
          })
          .then(resp => {
            const c = resp.headers.get('content-type') || '';
            if (!resp.ok) throw new Error('Server error ' + resp.status);
            if (c.indexOf('application/json') !== -1) return resp.json();
            return resp.text().then(t => ({
              status: 'error',
              message: t || 'Unexpected response'
            }));
          })
          .then(data => {
            statusBox.className = '';
            
            // Check for success status
            if (data && data.status === 'success') {
              // Success effect with animated SVG
              statusBox.classList.add('show', 'success');
              
              statusBox.innerHTML = `
                <svg class="success-icon" viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="26" cy="26" r="25" fill="none" stroke="#fff" stroke-width="2"/>
                  <path fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" 
                        d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                </svg>
                <span>Message sent successfully!</span>
              `;
              
              // Clear all input fields
              form.reset();
              
              // Clear all error states
              fname.classList.remove('error', 'success');
              email.classList.remove('error', 'success');
              message.classList.remove('error', 'success');
              fnameError.classList.remove('show');
              emailError.classList.remove('show');
              messageError.classList.remove('show');
              
              // Hide revealed elements
              welcome.classList.add('reveal');
              welcome.classList.remove('visible');
              welcome.setAttribute('aria-hidden', 'true');
              revealEls.forEach(e => {
                if (e) {
                  e.classList.add('reveal');
                  e.classList.remove('visible');
                }
              });
              
              // Auto-hide success message after 5 seconds
              setTimeout(() => {
                statusBox.style.animation = 'slideOut 0.4s ease-out forwards';
                setTimeout(() => {
                  statusBox.classList.remove('show', 'success');
                  statusBox.style.animation = '';
                  statusBox.innerHTML = '';
                }, 400);
              }, 5000);
            } else {
              // Error handling
              statusBox.classList.add('show', 'error');
              statusBox.innerHTML = `<span>${(data && data.message) ? data.message : 'Failed to send message.'}</span>`;
            }
          })
          .catch(err => {
            statusBox.className = '';
            statusBox.classList.add('show', 'error');
            statusBox.innerHTML = '<span>Network or server error.</span>';
            console.error(err);
          })
          .finally(() => {
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
          });
      });
    })();
  </script>
</body>

</html>