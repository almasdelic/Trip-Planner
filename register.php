<?php

require_once "db_config.php";

// Inicijalizacija varijable za poruku:
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($name) && !empty($password)) {
        // Provjera da su sva obavezna polja ispunjena
        
        // Provjera podudaranja lozinke i potvrde lozinke nije uključena u ovom kodu
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (username, name, password) VALUES ('$username', '$name', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            $message = "Registration successful.";
        } else {
            $message = "Error: " . $conn->error;
        }
    } else {
        $message = "Please fill out the entire form.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="register_style.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?php echo $message; ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            Username: <input type="text" name="username"><br>
            Name: <input type="text" name="name"><br>
            Password: <input type="password" name="password"><br>
            Confirm Password: <input type="password" name="confirm_password"><br>
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
