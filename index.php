<?php

$_SESSION['loggedin'] = false;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trip Planner - Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f0f0f0;
        }

        h1 {
            color: #333;
            margin-top: 50px;
        }

        .link {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            font-size: 18px;
            text-decoration: none;
            color: #fff;
            background-color: #3498db;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
        }

        .link:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <h1>Welcome to the Trip Planner</h1>
    <a href="login.php" class="link">Login</a>
    <a href="register.php" class="link" style="margin-left: 10px;">Register</a>
</body>
</html>
