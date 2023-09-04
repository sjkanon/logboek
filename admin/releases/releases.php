<?php

// URL of the GitHub releases page
$releaseUrl = 'https://github.com/sjkanon/logboek/releases';

// Create a DOMDocument object
$doc = new DOMDocument();
libxml_use_internal_errors(true);

// Load the HTML content from the URL
$doc->loadHTMLFile($releaseUrl);

// Get all elements with the class "release"
$releaseElements = $doc->getElementsByClassName('release');

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
    <?php foreach ($releaseElements as $releaseElement): ?>
        <div class="release">
            <?php echo $releaseElement->C14N(); ?>
        </div>
    <?php endforeach; ?>
</body>
</html>
