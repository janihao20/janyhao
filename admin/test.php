<?php
// index.php
session_start();

// helper: return 'active' class if form is active
function isActiveForm($name, $activeForm) {
    return ($name === $activeForm) ? 'active' : '';
}

// helper: show error / success HTML (escaped)
function showError($msg) {
    if (empty($msg)) return '';
    $safe = htmlspecialchars($msg, ENT_QUOTES, 'UTF-8');
    return "<div class=\"error-message\">{$safe}</div>";
}

// gather flash messages (only the keys we care about)
$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''
];
$activeForm = $_SESSION['active_form'] ?? 'login';
$success = $_SESSION['success'] ?? '';

// Clear only the flash keys
unset($_SESSION['login_error'], $_SESSION['register_error'], $_SESSION['active_form'], $_SESSION['success']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="container">
        <!-- Login form -->
        <div class="form-box <?= isActiveForm('login', $activeForm); ?>" id="login-form">
            <form action="login_register.php" method="post" autocomplete="off">
                <h2>LOGIN</h2>
                <?= showError($errors['login']) ?>
                <?php if ($success): ?>
                    <div class="error-message" style="background:#ddffdd;color:#2b662b;"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></div>
                <?php endif; ?>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
                <p>Don't have an account? <a href="#" onclick="showForm('register-form'); return false;">Register</a></p>
            </form>
        </div>

        <!-- Register form -->
        <div class="form-box <?= isActiveForm('register', $activeForm); ?>" id="register-form">
            <form action="login_register.php" method="post" autocomplete="off">
                <h2>REGISTER</h2>
                <?= showError($errors['register']) ?>
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password (min 6 chars)" required>
                <button type="submit" name="register">Register</button>
                <p>Already have an account? <a href="#" onclick="showForm('login-form'); return false;">Login</a></p>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
    <script>
    // Ensure client-side activation matches server-side active form
    (function() {
        // if server set register active, show register form on load
        var active = <?= json_encode($activeForm); ?>;
        if (active === 'register') {
            // show register form
            document.addEventListener('DOMContentLoaded', function() {
                // remove 'active' from others, add to target
                document.querySelectorAll('.form-box').forEach(function(f){ f.classList.remove('active'); });
                var el = document.getElementById('register-form');
                if (el) el.classList.add('active');
            });
        }
    })();
    </script>
</body>
</html>
