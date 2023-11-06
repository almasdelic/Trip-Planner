<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Card</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Your Card</h1>
    <?php

    // Prikaz informacija o putovanju iz sesije
    $form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : null;

    // Prikazuje informacije o putovanju ako postoje u sesiji
    if ($form_data) {
        echo "<p><strong>Country:</strong> " . $form_data['country'] . "</p>";
        echo "<p><strong>City:</strong> " . $form_data['city'] . "</p>";
        echo "<p><strong>Departure Place:</strong> " . $form_data['departure_place'] . "</p>";
        echo "<p><strong>Return Place:</strong> " . $form_data['return_place'] . "</p>";
        echo "<p><strong>Ticket Price:</strong> " . $form_data['ticket_price'] . "</p>";
    } else {
        echo "Form data not found.";
    }

    // Clear the form data from the session after displaying it
    unset($_SESSION['form_data']);
    ?>
</div>
</body>
</html>
