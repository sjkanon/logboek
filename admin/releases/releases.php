<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// URL of the GitHub releases page
$releaseUrl = 'https://github.com/sjkanon/logboek/releases';


$doc = new DOMDocument();
if (!$doc->loadHTMLFile($releaseUrl)) {
    foreach (libxml_get_errors() as $error) {
        echo "XML Error: " . $error->message . "<br>";
    }
    libxml_clear_errors();
}

// Create a DOMDocument object
$doc = new DOMDocument();
libxml_use_internal_errors(true);

// Load the HTML content from the URL
$doc->loadHTMLFile($releaseUrl);

// Get all elements with the class "release"
$releaseElements = $doc->getElementsByClassName('release');
$html = file_get_contents($releaseUrl);
echo $html;

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
