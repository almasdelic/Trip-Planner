<?php

#error_reporting(E_ALL);
#ini_set('display_errors', 1);

session_start();

// Check if the user is logged in
#if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
#    echo "You cannot enter this form. Please login.";
#    exit;
#}

require_once 'db_config.php';   

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $country = $_POST['country'];
    $city = $_POST['city'];
    $departure_place = $_POST['departure_place'];
    $return_place = $_POST['return_place'];
    $ticket_price = $_POST['ticket_price'];

    // Prikupljanje i pohrana podataka o putovanju u sesiju:
    $_SESSION['form_data'] = [
        'country' => $country,
        'city' => $city,
        'departure_place' => $departure_place,
        'return_place' => $return_place,
        'ticket_price' => $ticket_price
    ];

    $sql = "INSERT INTO card (country, city, departure_place, return_place, ticket_price)
            VALUES ('$country', '$city', '$departure_place', '$return_place', '$ticket_price')";

    if ($conn->query($sql) === TRUE) {
        $message = "Card is succesfully checked";
        echo $message;
        header("Location: process_trip.php");
        exit;
    } else {
        $message = "Error: " . $conn->error;
    }
}

$conn->close();
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Trip Plan</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

        <div class="container">
            <h1>Destination Selection</h1>

            <form action="process_form.php" method="POST">

                <div class="form-group">
                    <label for="country">Country:</label>
                    <select name="country" id="country" onchange="updateForm()">
                        <option value="Bosna_i_Hercegovina">Bosna i Hercegovina</option>
                        <option value="Srbija">Srbija</option>
                        <option value="Hrvatska">Hrvatska</option>
                        <!-- Add more countries as needed -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="city">City:</label>
                    <select name="city" id="city">
                        <!-- Default options -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="departure_place">Place of Departure:</label>
                    <select name="departure_place" id="departure_place">
                        <!-- Default options -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="return_place">Place of Return:</label>
                    <select name="return_place" id="return_place">
                        <!-- Default options -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="ticket_price">Ticket price:</label>
                    <select name="ticket_price" id="ticket_price">
                        <option value="25">25$</option>
                        <option value="50">50$</option>
                    </select>
                </div>

                <button type="submit">Submit</button>
            </form>
        </div>

            <script>

                function updateForm() {
                    const countrySelect = document.getElementById('country');
                    const citySelect = document.getElementById('city');
                    const departurePlaceSelect = document.getElementById('departure_place');
                    const returnPlaceSelect = document.getElementById('return_place');
                    const selectedCountry = countrySelect.value;

                    // Clear previous options
                    citySelect.innerHTML = '';
                    departurePlaceSelect.innerHTML = '';
                    returnPlaceSelect.innerHTML = '';

                    // Add options based on the selected country
                    if (selectedCountry === 'Bosna_i_Hercegovina') { // uvjet
                        const bosniaCities = ['Sarajevo', 'Mostar', 'Banja Luka']; // nova varijabla
                        bosniaCities.forEach(city => { // prolazi se kroz petlju
                            const option = document.createElement('option');  // stvara novi HTML element <optio> za izbornik
                            option.value = city;  // postavlja se vrijednost na grad
                            option.textContent = city; // postavlja se text
                            citySelect.appendChild(option);  //Dodaje se option element (grad) u padajući izbornik za gradove (citySelect).

                            const departureOption = document.createElement('option');
                            departureOption.value = city;
                            departureOption.textContent = city;
                            departurePlaceSelect.appendChild(departureOption);

                            const returnOption = document.createElement('option');
                            returnOption.value = city;
                            returnOption.textContent = city;
                            returnPlaceSelect.appendChild(returnOption);
                        });
                    } else if (selectedCountry === 'Srbija') {
                        const serbiaCities = ['Beograd', 'Novi Pazar', 'Novi Sad'];
                        serbiaCities.forEach(city => {
                            const option = document.createElement('option');
                            option.value = city;
                            option.textContent = city;
                            citySelect.appendChild(option);

                            const departureOption = document.createElement('option');
                            departureOption.value = city;
                            departureOption.textContent = city;
                            departurePlaceSelect.appendChild(departureOption);

                            const returnOption = document.createElement('option');
                            returnOption.value = city;
                            returnOption.textContent = city;
                            returnPlaceSelect.appendChild(returnOption);
                        });
                    } else if (selectedCountry === 'Hrvatska') {
                        const croatiaCities = ['Zagreb', 'Osijek', 'Šibenik'];
                        croatiaCities.forEach(city => {
                            const option = document.createElement('option');
                            option.value = city;
                            option.textContent = city;
                            citySelect.appendChild(option);

                            const departureOption = document.createElement('option');
                            departureOption.value = city;
                            departureOption.textContent = city;
                            departurePlaceSelect.appendChild(departureOption);

                            const returnOption = document.createElement('option');
                            returnOption.value = city;
                            returnOption.textContent = city;
                            returnPlaceSelect.appendChild(returnOption);
                        });
                    }
                }

                // Call updateForm initially to populate the initial form options
                updateForm();
            </script>

    </body>
    </html>
