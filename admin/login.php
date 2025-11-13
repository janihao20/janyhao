<?php

session_start();

    if (isset($_SESSION["status"]) && $_SESSION["status"] == "active") {
        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Admin Panel - Login Required</title>
</head>

<body>
    <div class="container">
        <div class="form-box" id="login-form">
            <form method="POST">
                <h2>LOGIN</h2>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
            <?php 

                $username = "janelle-admin";
                $password = '$2y$10$eO289/sEfC6I0F0d3MeaFO14bwr2wUr.n9CQPQOPC0ZgBfZhN97z2';

                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $username_input = htmlspecialchars($_POST["username"]);
                    $password_input = htmlspecialchars($_POST["password"]);

                    if(empty($username_input) && empty($password_input)){
                        echo '<p class="error-message">Please fill up required fields.</p>';
                        exit;
                    }

                    if($username_input == $username && password_verify($password_input, $password)){
                        $_SESSION["status"] = "active";
                        header("Location: index.php");
                        exit;
                    } else{
                        echo '<p class="error-message">Invalid credentials.</p>';
                        exit;
                    }
                }

            ?>
        </div>
    </div>
</body>

</html>

