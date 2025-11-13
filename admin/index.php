<?php

session_start();

// Set timezone to Philippines
date_default_timezone_set('Asia/Manila');

    if(!isset($_SESSION["status"]) && $_SESSION["status"] != "active"){
        header("Location: login.php");
        exit;
    }

    // Fetch messages from database
    require_once "../backend/db-config.php";

    $query = "SELECT * FROM contact_messages ORDER BY date_sent DESC";
    $result = $conn->query($query);
    $messages = [];
    
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Janelle's Portfolio</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f5f7fa;
            min-height: 100vh;
            padding: 20px;
        }

        /* Header */
        .admin-header {
            background: linear-gradient(135deg, #0b1d4a 0%, #142f7a 100%);
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(11, 29, 74, 0.15);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            animation: slideDown 0.5s ease;
        }

        .admin-header h1 {
            color: white;
            font-size: 26px;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .admin-header .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .admin-header .user-info span {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            background: rgba(255, 255, 255, 0.1);
            padding: 8px 16px;
            border-radius: 20px;
            backdrop-filter: blur(10px);
        }

        .logout-btn {
            background: white;
            color: #0b1d4a;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
            animation: fadeIn 0.6s ease;
        }

        .stat-card {
            background: linear-gradient(135deg, #0b1d4a 0%, #1e3a8a 100%);
            padding: 28px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 0 0 0 100px;
        }

        .stat-card:nth-child(2) {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
        }

        .stat-card:nth-child(3) {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .stat-card h3 {
            color: white;
            font-size: 36px;
            margin-bottom: 8px;
            font-weight: 700;
            position: relative;
        }

        .stat-card p {
            color: rgba(255, 255, 255, 0.95);
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            font-weight: 600;
            position: relative;
        }

        /* Messages Container */
        .messages-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            animation: fadeIn 0.8s ease;
        }

        .messages-header {
            background: linear-gradient(135deg, #0b1d4a 0%, #142f7a 100%);
            color: white;
            padding: 24px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .messages-header h2 {
            font-size: 20px;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding: 10px 40px 10px 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            outline: none;
            font-size: 14px;
            width: 260px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.95);
            color: #333;
        }

        .search-box input:focus {
            width: 320px;
            border-color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .search-box input::placeholder {
            color: #999;
        }

        .search-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            pointer-events: none;
        }

        /* Messages Table */
        .messages-table {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        thead th {
            padding: 16px;
            text-align: left;
            color: #0b1d4a;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 3px solid #0b1d4a;
        }

        tbody tr {
            border-bottom: 1px solid #f0f0f0;
        }

        tbody td {
            padding: 18px 16px;
            color: #333;
            font-size: 14px;
        }

        .message-cell {
            max-width: 350px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .message-full {
            max-width: 350px;
            line-height: 1.5;
            color: #555;
        }

        .date-cell {
            color: #888;
            font-size: 13px;
        }

        .action-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-right: 6px;
        }

        .view-btn {
            background: linear-gradient(135deg, #4caf50 0%, #45a049 100%);
            color: white;
            box-shadow: 0 2px 6px rgba(76, 175, 80, 0.3);
        }

        .view-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(76, 175, 80, 0.4);
        }

        .delete-btn {
            background: linear-gradient(135deg, #f44336 0%, #da190b 100%);
            color: white;
            box-shadow: 0 2px 6px rgba(244, 67, 54, 0.3);
        }

        .delete-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(244, 67, 54, 0.4);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state svg {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            animation: fadeIn 0.3s ease;
            backdrop-filter: blur(4px);
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            max-width: 650px;
            margin: 50px auto;
            padding: 0;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
            animation: slideUp 0.4s ease;
            max-height: 85vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 24px 32px;
            background: linear-gradient(135deg, #0b1d4a 0%, #142f7a 100%);
            color: white;
        }

        .modal-header h3 {
            color: white;
            font-size: 22px;
            font-weight: 700;
            margin: 0;
        }

        .close-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            font-size: 20px;
            line-height: 1;
            cursor: pointer;
            color: white;
            transition: background 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .close-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .modal-body-wrapper {
            padding: 32px;
            overflow-y: auto;
            flex: 1;
        }

        .message-detail {
            margin-bottom: 24px;
        }

        .message-detail:last-child {
            margin-bottom: 0;
        }

        .message-detail label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #0b1d4a;
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }

        .message-detail label::before {
            content: '';
            width: 4px;
            height: 16px;
            background: linear-gradient(135deg, #0b1d4a 0%, #2563eb 100%);
            border-radius: 2px;
        }

        .message-detail p {
            color: #444;
            font-size: 15px;
            line-height: 1.7;
            padding: 16px 20px;
            background: #f8f9fa;
            border-radius: 10px;
            margin: 0;
        }

        .message-detail p.message-full {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 80px;
        }

        .modal-footer {
            padding: 20px 32px;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .reply-btn {
            background: linear-gradient(135deg, #0b1d4a 0%, #2563eb 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(11, 29, 74, 0.3);
        }

        .reply-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(11, 29, 74, 0.4);
        }

        .cancel-btn {
            background: white;
            color: #666;
            border: 2px solid #e0e0e0;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .cancel-btn:hover {
            border-color: #0b1d4a;
            color: #0b1d4a;
        }

        /* Delete Confirmation Modal */
        .delete-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1001;
            animation: fadeIn 0.3s ease;
            backdrop-filter: blur(4px);
        }

        .delete-modal-content {
            background: white;
            border-radius: 16px;
            max-width: 480px;
            margin: 100px auto;
            padding: 0;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
            animation: slideUp 0.4s ease;
            overflow: hidden;
        }

        .delete-modal-header {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 24px 28px;
            background: linear-gradient(135deg, #f44336 0%, #da190b 100%);
            color: white;
        }

        .delete-modal-header svg {
            flex-shrink: 0;
        }

        .delete-modal-header h3 {
            color: white;
            font-size: 20px;
            font-weight: 700;
            margin: 0;
        }

        .delete-modal-body {
            padding: 28px;
            color: #555;
            font-size: 15px;
            line-height: 1.6;
        }

        .delete-modal-footer {
            padding: 20px 28px;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .confirm-delete-btn {
            background: linear-gradient(135deg, #f44336 0%, #da190b 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(244, 67, 54, 0.3);
        }

        .confirm-delete-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(244, 67, 54, 0.4);
        }

        .cancel-delete-btn {
            background: white;
            color: #666;
            border: 2px solid #e0e0e0;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .cancel-delete-btn:hover {
            border-color: #999;
            color: #333;
        }

        /* Animations */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .admin-header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .search-box input {
                width: 100%;
            }

            .search-box input:focus {
                width: 100%;
            }

            .messages-header {
                flex-direction: column;
                gap: 15px;
            }

            .message-cell {
                max-width: 150px;
            }

            table {
                font-size: 12px;
            }

            .modal-content {
                margin: 20px;
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="admin-header">
        <h1 id="greetingHeader">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 8px;">
                <circle cx="12" cy="12" r="5"></circle>
                <line x1="12" y1="1" x2="12" y2="3"></line>
                <line x1="12" y1="21" x2="12" y2="23"></line>
                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                <line x1="1" y1="12" x2="3" y2="12"></line>
                <line x1="21" y1="12" x2="23" y2="12"></line>
                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
            </svg>
            Good Morning, Janelle
        </h1>
        <div class="user-info">
            <form method="POST" action="logout.php" style="margin: 0;">
                <button type="submit" class="logout-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 6px;">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-container">
        <div class="stat-card">
            <h3><?php echo count($messages); ?></h3>
            <p>Total Messages</p>
        </div>
        <div class="stat-card">
            <h3><?php echo date('M d, Y'); ?></h3>
            <p>Today's Date</p>
        </div>
        <div class="stat-card">
            <h3><?php 
                $today = date('Y-m-d');
                $todayCount = 0;
                foreach($messages as $msg) {
                    if(date('Y-m-d', strtotime($msg['date_sent'])) === $today) {
                        $todayCount++;
                    }
                }
                echo $todayCount;
            ?></h3>
            <p>Messages Today</p>
        </div>
    </div>

    <!-- Messages Container -->
    <div class="messages-container">
        <div class="messages-header">
            <h2>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 8px;">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
                Contact Messages
            </h2>
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search messages..." onkeyup="searchMessages()">
                <span class="search-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0b1d4a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </span>
            </div>
        </div>

        <div class="messages-table">
            <?php if(count($messages) > 0): ?>
            <table id="messagesTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($messages as $message): ?>
                    <tr>
                        <td><?php echo $message['id']; ?></td>
                        <td><?php echo htmlspecialchars($message['name']); ?></td>
                        <td><?php echo htmlspecialchars($message['email']); ?></td>
                        <td class="message-cell"><?php echo htmlspecialchars($message['message']); ?></td>
                        <td class="date-cell"><?php echo date('M d, Y h:i A', strtotime($message['date_sent'])); ?></td>
                        <td>
                            <button class="action-btn view-btn" onclick='viewMessage(<?php echo json_encode($message); ?>)'>View</button>
                            <button class="action-btn delete-btn" onclick="deleteMessage(<?php echo $message['id']; ?>)">Delete</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <h3>No Messages Yet</h3>
                <p>When visitors submit the contact form, their messages will appear here.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal for viewing full message -->
    <div id="messageModal" class="modal" onclick="closeModal(event)">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h3>Message Details</h3>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body-wrapper">
                <div id="modalBody"></div>
            </div>
            <div class="modal-footer">
                <button class="cancel-btn" onclick="closeModal()">Close</button>
                <button class="reply-btn" id="replyBtn" onclick="replyToMessage()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    Reply via Email
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="delete-modal" onclick="closeDeleteModal(event)">
        <div class="delete-modal-content" onclick="event.stopPropagation()">
            <div class="delete-modal-header">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <h3>Confirm Delete</h3>
            </div>
            <div class="delete-modal-body">
                <p>Are you sure you want to delete this message? This action cannot be undone.</p>
            </div>
            <div class="delete-modal-footer">
                <button class="cancel-delete-btn" onclick="closeDeleteModal()">Cancel</button>
                <button class="confirm-delete-btn" onclick="confirmDelete()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 6px;">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        <line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>
                    Delete Message
                </button>
            </div>
        </div>
    </div>

    <script>
        // Dynamic greeting based on time
        function updateGreeting() {
            const hour = new Date().getHours();
            const greetingHeader = document.getElementById('greetingHeader');
            let greeting = '';
            let icon = '';

            if (hour >= 5 && hour < 12) {
                greeting = 'Good Morning, Janelle';
                icon = `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 8px;">
                    <circle cx="12" cy="12" r="5"></circle>
                    <line x1="12" y1="1" x2="12" y2="3"></line>
                    <line x1="12" y1="21" x2="12" y2="23"></line>
                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                    <line x1="1" y1="12" x2="3" y2="12"></line>
                    <line x1="21" y1="12" x2="23" y2="12"></line>
                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                </svg>`;
            } else if (hour >= 12 && hour < 18) {
                greeting = 'Good Afternoon, Janelle';
                icon = `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 8px;">
                    <circle cx="12" cy="12" r="5"></circle>
                    <line x1="12" y1="1" x2="12" y2="3"></line>
                    <line x1="12" y1="21" x2="12" y2="23"></line>
                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                    <line x1="1" y1="12" x2="3" y2="12"></line>
                    <line x1="21" y1="12" x2="23" y2="12"></line>
                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                </svg>`;
            } else {
                greeting = 'Good Evening, Janelle';
                icon = `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 8px;">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                </svg>`;
            }

            greetingHeader.innerHTML = icon + greeting;
        }

        // Update greeting on page load
        updateGreeting();

        // Store current message email for reply
        let currentMessageEmail = '';
        let currentMessageName = '';

        // View message in modal
        function viewMessage(message) {
            const modal = document.getElementById('messageModal');
            const modalBody = document.getElementById('modalBody');
            
            // Store email for reply function
            currentMessageEmail = message.email;
            currentMessageName = message.name;
            
            modalBody.innerHTML = `
                <div class="message-detail">
                    <label>ID</label>
                    <p>${message.id}</p>
                </div>
                <div class="message-detail">
                    <label>Name</label>
                    <p>${escapeHtml(message.name)}</p>
                </div>
                <div class="message-detail">
                    <label>Email</label>
                    <p>${escapeHtml(message.email)}</p>
                </div>
                <div class="message-detail">
                    <label>Message</label>
                    <p class="message-full">${escapeHtml(message.message)}</p>
                </div>
                <div class="message-detail">
                    <label>Date Sent</label>
                    <p>${new Date(message.date_sent).toLocaleString()}</p>
                </div>
            `;
            
            modal.style.display = 'block';
        }

        // Reply to message via email
        function replyToMessage() {
            if (currentMessageEmail) {
                const subject = encodeURIComponent(`Re: Your message to Janelle`);
                const body = encodeURIComponent(`Hi ${currentMessageName},\n\nThank you for reaching out!\n\n`);
                window.location.href = `mailto:${currentMessageEmail}?subject=${subject}&body=${body}`;
            }
        }

        // Close modal
        function closeModal(event) {
            const modal = document.getElementById('messageModal');
            if (!event || event.target === modal) {
                modal.style.display = 'none';
            }
        }

        // Store message ID for deletion
        let messageIdToDelete = null;

        // Delete message - show custom modal
        function deleteMessage(id) {
            messageIdToDelete = id;
            const deleteModal = document.getElementById('deleteModal');
            deleteModal.style.display = 'block';
        }

        // Close delete modal
        function closeDeleteModal(event) {
            const deleteModal = document.getElementById('deleteModal');
            if (!event || event.target === deleteModal) {
                deleteModal.style.display = 'none';
                messageIdToDelete = null;
            }
        }

        // Confirm delete
        function confirmDelete() {
            if (messageIdToDelete) {
                fetch('delete-message.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + messageIdToDelete
                })
                .then(response => response.json())
                .then(data => {
                    closeDeleteModal();
                    if (data.status === 'success') {
                        location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    closeDeleteModal();
                    alert('Network error. Please try again.');
                });
            }
        }

        // Search messages
        function searchMessages() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toUpperCase();
            const table = document.getElementById('messagesTable');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                const row = tr[i];
                const cells = row.getElementsByTagName('td');
                let found = false;

                for (let j = 0; j < cells.length; j++) {
                    const cell = cells[j];
                    if (cell) {
                        const txtValue = cell.textContent || cell.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }

                if (found) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        }

        // Escape HTML to prevent XSS
        function escapeHtml(text) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.replace(/[&<>"']/g, m => map[m]);
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
                closeDeleteModal();
            }
        });
    </script>
</body>

</html>