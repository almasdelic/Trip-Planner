<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1); # Inicijalizacija sesije i postavke za prikazivanje grešaka

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) { # Provjera prijave korisnika

    echo "You cannot enter this form. Please login.";
    exit;
}

require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $country = $_POST['country'];
    $city = $_POST['city'];
    $departure_place = $_POST['departure_place'];
    $return_place = $_POST['return_place'];
    $ticket_price = $_POST['ticket_price']; # Dobavljanje podataka iz baze

    // Spremanje podataka u sesiju
    $_SESSION['form_data'] = [
        'country' => $country,
        'city' => $city,
        'departure_place' => $departure_place,
        'return_place' => $return_place,
        'ticket_price' => $ticket_price
    ];

    // Unos u bazu
    $sql = "INSERT INTO card (country, city, departure_place, return_place, ticket_price)
            VALUES ('$country', '$city', '$departure_place', '$return_place', '$ticket_price')";

    if ($conn->query($sql) === TRUE) {
        // Redirektujemo na drugu stranicu ako je sve uredu
        header("Location: process_trip.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
