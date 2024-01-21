<?php
    use Maharah\Classes\Database;

    // require_once __DIR__ . '/autoloader.php';
    require __DIR__.'/vendor/autoload.php';

    use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

 
$log = new Logger('Maharah');
$log->pushHandler(new StreamHandler('logo.log', Level::Warning));

 
$log->warning('Foo');
$log->error('Bar');
    
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
          
            <h1>Exercise</h1>
        </div>

        

        <div class="uk-margin">

            <form class="uk-form-stacked" action="process.php" method="post">
                <label class="uk-form-label" for="quantity">Enter Quantity:</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="number" name="quantity" id="quantity" value="1" required>
                </div>

                <div class="uk-form-controls uk-margin">

                    <?php
                    $database = new Database();
                    $records = $database->getRecords('SELECT * FROM products');

                    foreach ($records as $record) {
                        echo '<input class="uk-radio" type="radio" name="product" value="' . $record['name'] . '" required>
                        ' . $record['name'] . '<br />';
                    }
                    ?>
                </div>

                <button class="uk-button uk-button-secondary uk-margin-top" type="submit">Submit</button>
            </form>

        </div>

    </div>

</body>

</html>