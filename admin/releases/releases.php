<?php
$username = 'username';
$repository = 'repository';
$accessToken = 'YOUR_ACCESS_TOKEN';

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
</head>
<body>
    <h1>GitHub Release Notes</h1>
    <?php foreach ($releases as $release): ?>
        <div>
            <h2><?php echo $release['name']; ?></h2>
            <p><?php echo $release['body']; ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
