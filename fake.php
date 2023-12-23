<?php

require_once 'vendor/autoload.php';

// Function to generate fake data and return it as an array
function generateData($faker, $selectedGender, $selectedCountry) {
    $ein = $faker->ein();
    $name = $faker->name;
    $email = $faker->email;
    $sentence = $faker->sentence;
    $address = $faker->address;
    $phone = $faker->e164PhoneNumber;
    $cardtype = $faker->creditCardType;
    $cardnumber = $faker->creditCardNumber;
    $cardexpire = $faker->creditCardExpirationDateString;

    return [
        'ein' => $ein,
        'name' => $name,
        'email' => $email,
        'sentence' => $sentence,
        'address' => $address,
        'phone' => $phone,
        'gender' => $selectedGender,
        'country' => $selectedCountry,
        'cardtype' => $cardtype,
        'cardnumber' => $cardnumber,
        'cardexpire' => $cardexpire,
    ];
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve selected gender and country from the form
    $selectedGender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $selectedCountry = isset($_POST['country']) ? $_POST['country'] : '';

    // Create an instance of the Faker class based on the selected country
    $faker = \Faker\Factory::create($selectedCountry);

    // Generate fake data for each set
    $dataSets = [];
    for ($i = 1; $i <= 10; $i++) {
        $dataSets[] = generateData($faker, $selectedGender, $selectedCountry);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fake Data Generator</title>

    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4">Fake Data Generator</h1>

        <form action="" method="post" class="mb-4">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="gender">Select Gender:</label>
                    <select name="gender" id="gender" class="form-control">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="country">Select Country:</label>
                    <select name="country" id="country" class="form-control">
                        <option value="us_US">United States</option>
                        <option value="uk_UK">United Kingdom</option>
                        <option value="fr_FR">France</option>
                        <!-- Add more countries as needed -->
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <button type="submit" class="btn btn-primary">Generate Data</button>
                </div>
            </div>
        </form>

        <?php if (isset($dataSets) && !empty($dataSets)) : ?>
            <h2>Generated Data Sets</h2>
            <div class="row">
                <?php foreach ($dataSets as $index => $dataSet) : ?>
                    <div class="<?php echo count($dataSets) === 1 ? 'col-12' : 'col-md-4'; ?> mb-3">
                        <div class="card">
                            <h5 class="card-header">Generated Data Set <?php echo $index + 1; ?></h5>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <?php foreach ($dataSet as $key => $value) : ?>
                                        <li><strong><?php echo ucfirst($key); ?>:</strong> <?php echo $value; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
