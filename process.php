<?php

// require_once __DIR__ . '/autoloader.php';
require __DIR__.'/vendor/autoload.php';

use Maharah\Classes\SamsungProduct;
use Maharah\Classes\IphoneProduct;

$formSumitted = false;
$error = '';

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Yes, is POST request, the form has been submitted
    $formSumitted = true;

    // Intval() function is used to convert type string to integer
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;

    $product = isset($_POST['product']) ? htmlspecialchars(strip_tags($_POST['product'])) : '';

    try {

        if (strpos(strtolower($product), 'iphone') !== false) {
            $product = new IphoneProduct($product, $quantity);
        } else {
            $product = new SamsungProduct($product, $quantity);
        }

        $information = $product->displayProductInfo();
        $cost = $product->calculateTotalCost();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }

    // If the page is accessed directly and the form is not submitted, display an error
} else {
    $error = "You can not access this page directly";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/css/uikit.min.css" />
</head>

<body>
    <div class="uk-container uk-margin-top">

        <div class="uk-text-center uk-margin">
            
            <h1> Exercise</h1>
        </div>

        <hr />

        <?php if (!$formSumitted || !empty($error)) { ?>

            <div class="uk-alert-danger uk-padding-small" uk-alert>
                <p><?php echo $error; ?></p>
            </div>

        <?php
            // Everything is ok, display the product information
        } else {
        ?>
            <strong><?php echo $information; ?></strong>
            <br />
            <strong>Price: <?php echo $cost . " LYD"; ?></strong>
        <?php } ?>

    </div>

</body>

</html>