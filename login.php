<?php
session_start(); # Pokretanje sesije

require_once "db_config.php";

#$_SESSION['loggedin'] = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") { # Ako je zahtjev POST
    $username = $_POST['username'];
    $password = $_POST['password']; # Uzimanje podataka iz baze

    $sql = "SELECT * FROM users WHERE username='$username'"; # SQL upit
    $result = $conn->query($sql); 

    if ($result) {
        if ($result->num_rows == 1) { # Ako je pronadjen bar jedan korisnik
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) { # Podudaranje lozinke
                $_SESSION['loggedin'] = true; # funkcija loggedin
                $_SESSION['username'] = $username;
                header("Location: trip_selection.php"); # Preusmjeravanje na drugu stranicu
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "User not found.";
        }
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="login_style.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            Username: <input type="text" name="username"><br>
            Password: <input type="password" name="password"><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>

