<?php
$username = 'sjkanon';
$repository = 'logboek';
$accessToken = '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';

$url = "https://api.github.com/repos/{$username}/{$repository}/releases";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer {$accessToken}"]);

$response = curl_exec($ch);
curl_close($ch);

$releases = json_decode($response, true);
?>


<!DOCTYPE html>
<html>
<head>
    <title>GitHub Release Notes</title>
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
    <h1>GitHub Release Notes</h1>
    <?php foreach ($releases as $release): ?>
        <div class="release">
            <h2><?php echo $release['name']; ?></h2>
            <p><?php echo $release['body']; ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>