<?php
require_once 'simple_html_dom.php'; // Include the Simple HTML DOM Parser library

$releaseUrl = 'https://github.com/sjkanon/logboek/releases';

// Load the HTML content from the URL
$html = file_get_html($releaseUrl);

?>

<!DOCTYPE html>
<html>
<head>
    <title>GitHub Releases</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .release {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            max-width: 600px;
        }
    </style>
</head>
<body>
    <h1>GitHub Releases</h1>
    <?php foreach ($html->find('.release') as $releaseElement): ?>
        <div class="release">
            <?php echo $releaseElement->outertext; ?>
        </div>
    <?php endforeach; ?>
</body>
</html>
