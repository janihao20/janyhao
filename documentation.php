<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentation - Janelle S. Terez Portfolio</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 50px;
            padding: 40px 20px;
            background: white;
            border-radius: 16px;
            border: 2px solid #e9ecef;
        }

        .header h1 {
            color: #0b1d4a;
            font-size: 36px;
            margin-bottom: 12px;
            font-weight: 700;
        }

        .header p {
            color: #666;
            font-size: 16px;
            line-height: 1.6;
        }

        .section {
            background: white;
            padding: 35px;
            margin-bottom: 24px;
            border-radius: 16px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .section:hover {
            transform: translateY(-4px);
            border-color: #0b1d4a;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 2px solid #f0f0f0;
        }

        .section-header h2 {
            color: #0b1d4a;
            font-size: 24px;
            font-weight: 700;
        }

        .section-content {
            color: #555;
            line-height: 1.8;
        }

        .link-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            margin: 16px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 12px;
            border: 2px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .link-card:hover {
            border-color: #0b1d4a;
        }

        .link-info {
            flex: 1;
        }

        .link-label {
            color: #0b1d4a;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .link-url {
            color: #2563eb;
            font-size: 15px;
            word-break: break-all;
            font-family: 'Courier New', monospace;
        }

        .link-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            background: linear-gradient(135deg, #0b1d4a 0%, #2563eb 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .link-button:hover {
            transform: translateX(4px);
        }

        .access-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .method-card {
            padding: 24px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 12px;
            border: 2px solid #e0e0e0;
            text-align: center;
            transition: all 0.3s ease;
        }

        .method-card:hover {
            border-color: #0b1d4a;
        }

        .method-icon {
            margin-bottom: 16px;
        }

        .method-title {
            color: #0b1d4a;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .method-desc {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 16px;
        }

        .tech-stack {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 20px;
        }

        .tech-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: linear-gradient(135deg, #0b1d4a 0%, #2563eb 100%);
            color: white;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
        }

        .credentials-box {
            margin-top: 20px;
            padding: 20px;
            background: linear-gradient(135deg, #fff3cd 0%, #ffe69c 100%);
            border-radius: 12px;
            border: 2px solid #ffc107;
        }

        .credentials-title {
            color: #856404;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .credential-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 8px 0;
            color: #856404;
            font-size: 14px;
        }

        .credential-label {
            font-weight: 700;
            min-width: 80px;
        }

        .credential-value {
            font-family: 'Courier New', monospace;
            background: white;
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid #ffc107;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: white;
            color: #0b1d4a;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            border: 2px solid #0b1d4a;
            transition: all 0.3s ease;
            margin-bottom: 30px;
        }

        .back-button:hover {
            background: #0b1d4a;
            color: white;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 28px;
            }

            .section {
                padding: 24px;
            }

            .link-card {
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Portfolio Documentation</h1>
            <p>Complete guide to accessing and understanding the portfolio website system</p>
        </div>

        <!-- Live Website Section -->
        <div class="section">
            <div class="section-header">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#0b1d4a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="2" y1="12" x2="22" y2="12"></line>
                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                </svg>
                <h2>Live Website</h2>
            </div>
            <div class="section-content">
                <p>The portfolio website is live and accessible to everyone. Visit the main website to explore projects, achievements, and contact information.</p>
                <div class="link-card">
                    <div class="link-info">
                        <div class="link-label">Main Website URL</div>
                        <div class="link-url">https://janyhao.infinityfreeapp.com/</div>
                    </div>
                    <a href="https://janyhao.infinityfreeapp.com/" target="_blank" class="link-button">
                        Visit Website
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                            <polyline points="15 3 21 3 21 9"></polyline>
                            <line x1="10" y1="14" x2="21" y2="3"></line>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Source Code Section -->
        <div class="section">
            <div class="section-header">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#0b1d4a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="16 18 22 12 16 6"></polyline>
                    <polyline points="8 6 2 12 8 18"></polyline>
                </svg>
                <h2>Source Code</h2>
            </div>
            <div class="section-content">
                <p>The complete source code is available on GitHub. Feel free to explore, learn, and contribute to the project.</p>
                <div class="link-card">
                    <div class="link-info">
                        <div class="link-label">GitHub Repository</div>
                        <div class="link-url">https://github.com/janihao20/janyhao</div>
                    </div>
                    <a href="https://github.com/janihao20/janyhao" target="_blank" class="link-button">
                        View on GitHub
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Admin Access Section -->
        <div class="section">
            <div class="section-header">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#0b1d4a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
                <h2>Admin Access</h2>
            </div>
            <div class="section-content">
                <p>Access the admin dashboard to manage contact messages, view analytics, and maintain the website. Two convenient methods are available:</p>
                
                <div class="access-methods">
                    <div class="method-card">
                        <div class="method-icon">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#0b1d4a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                <line x1="9" y1="10" x2="15" y2="10"></line>
                                <line x1="12" y1="7" x2="12" y2="13"></line>
                            </svg>
                        </div>
                        <div class="method-title">Method 1: Footer Link</div>
                        <div class="method-desc">Scroll to the bottom of any page (Home, Portfolio, Contact) and click the admin access link in the footer.</div>
                    </div>

                    <div class="method-card">
                        <div class="method-icon">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#0b1d4a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                            </svg>
                        </div>
                        <div class="method-title">Method 2: Direct Link</div>
                        <div class="method-desc">Access the admin dashboard directly using the URL below for instant access.</div>
                    </div>
                </div>

                <div class="credentials-box">
                    <div class="credentials-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                        Admin Credentials
                    </div>
                    <div class="credential-item">
                        <span class="credential-label">Username:</span>
                        <span class="credential-value">janelle-admin</span>
                    </div>
                    <div class="credential-item">
                        <span class="credential-label">Password:</span>
                        <span class="credential-value">admin</span>
                    </div>
                </div>

                <div class="link-card" style="margin-top: 24px;">
                    <div class="link-info">
                        <div class="link-label">Admin Dashboard URL</div>
                        <div class="link-url">https://janyhao.infinityfreeapp.com/admin</div>
                    </div>
                    <a href="https://janyhao.infinityfreeapp.com/admin" target="_blank" class="link-button">
                        Access Admin
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
