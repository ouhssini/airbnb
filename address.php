<?php

require_once 'vendor/autoload.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve selected gender and country from the form
    $selectedGender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $selectedCountry = isset($_POST['country']) ? $_POST['country'] : '';

    // Create an instance of the Faker class based on the selected country
    $faker = \Faker\Factory::create($selectedCountry);

    // Output generated data to HTML
    echo "<!DOCTYPE html>
    <html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <title>Generated Data</title>

        <!-- Include Bootstrap CSS -->
        <link href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css\" rel=\"stylesheet\">
        
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
            }

            .data-box {
                border: 1px solid #ccc;
                border-radius: 8px;
                padding: 10px;
                margin-bottom: 20px;
            }

            h2 {
                color: #333;
            }

            p {
                margin: 8px 0;
            }
        </style>
    </head>
    <body class=\"bg-light\">

    <div class=\"container mt-5\">";
    
    // Display 10 sets of generated data, arranging three sets in one row
    for ($i = 1; $i <= 10; $i += 3) {
        echo "<div class=\"row\">";
        
        // Generate fake data for the first set
        generateData($faker, $selectedGender, $selectedCountry, $i);
        
        // Generate fake data for the second set (if applicable)
        if ($i + 1 <= 10) {
            generateData($faker, $selectedGender, $selectedCountry, $i + 1);
        }

        // Generate fake data for the third set (if applicable)
        if ($i + 2 <= 10) {
            generateData($faker, $selectedGender, $selectedCountry, $i + 2);
        }

        echo "</div>";
    }

    // Close the HTML document
    echo "</div>
        <!-- Include Bootstrap JS and Popper.js -->
        <script src=\"https://code.jquery.com/jquery-3.5.1.slim.min.js\"></script>
        <script src=\"https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js\"></script>
        <script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js\"></script>
    </body>
    </html>";
} else {
    // If the form is not submitted, redirect to the form page
    header('Location: index.html');
    exit;
}

// Function to generate fake data and display it within a box
function generateData($faker, $selectedGender, $selectedCountry, $setNumber) {
    $ein = $faker->ein();
    $name = $faker->name;
    $email = $faker->email;
    $sentence = $faker->sentence;
    $address = $faker->address;
    $phone = $faker->e164PhoneNumber;
    $cardtype = $faker->creditCardType;
    $cardnumber = $faker->creditCardNumber;
    $cardexpire = $faker->creditCardExpirationDateString;

    echo "<div class=\"col-md-4\">
        <div class=\"data-box\">
            <h2>Generated Data Set $setNumber</h2>
            <p><strong>Employer Identification Number:</strong> $ein </p>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Sentence:</strong> $sentence</p>
            <p><strong>Address:</strong> $address </p>
            <p><strong>Phone:</strong> $phone </p>
            <p><strong>Gender:</strong> $selectedGender</p>
            <p><strong>Country:</strong> $selectedCountry</p>
            <p><strong>Credit Card Type:</strong> $cardtype </p>
            <p><strong>Credit Card Number :</strong> $cardnumber </p>
            <p><strong>Credit Card Expiration Date:</strong> $cardexpire </p>
        </div>
    </div>";
}
?>
