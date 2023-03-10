<?php

use App\ScoresFileDecoder;

require_once '../vendor/autoload.php';

//$filename = 'encoded_scores.txt';
$filename = 'encoded_scores.csv';
$fileDecoder = new ScoresFileDecoder($filename);
$decodedScores = $fileDecoder->getFormattedDecodedScores();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technical task</title>
</head>

<body>
<h1>Sergio Salcedo</h1>
<h2>Decoded Scores</h2>
<section>
    <?= $decodedScores; ?>
</section>
</body>
</html>