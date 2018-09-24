<?php
require '../includes/helpers.php';
require 'bmrCalculators.php';

session_start();

echo "here in logic file";
dump($_GET);

$age = $_GET['age'];
$height = $_GET['heightValue'];
$heightRadio = $_GET['heightRadio'];
$weight = $_GET['weightValue'];
$weightRadio = $_GET['weightRadio'];
$gender = $_GET['gender'];

$height = $heightRadio == 'inches' ? convertToCms($height) : $height;
$weight = $weightRadio == 'lbs' ? convertToKgs($weight) : $weight;

$bmr = round(calculateBmrMiffin($age, $gender, $height, $weight), 0, PHP_ROUND_HALF_UP);

echo 'BMR using Miffin:' . $bmr;

$_SESSION['results'] = [
    'bmrMiffin' => $bmr
];

echo dump($_SESSION['results']);

header('Location: ../index.php');


