<?php
require '../includes/helpers.php';
require 'bmrCalculators.php';
session_start();

dump($_GET);

# Variables to hold user inputs
$age = $_GET['age'];
$height = $_GET['heightValue'];
$heightRadio = $_GET['heightRadio'];
$weight = $_GET['weightValue'];
$weightRadio = $_GET['weightRadio'];
$gender = $_GET['gender'];
$activity = $_GET['activity'];
$calculateBmrHarris = isset($_GET['harrisBenedict']) ? $_GET['harrisBenedict'] : 'no';
$compareCaloriesBurned = isset($_GET['compareCalories']) ? $_GET['compareCalories'] : 'no';

# Height and weight converters
$height = $heightRadio == 'inches' ? convertToCms($height) : $height;
$weight = $weightRadio == 'lbs' ? convertToKgs($weight) : $weight;

# Calculate BMR based on Miffin St.Jeor equation
$bmrMiffin = round(calculateBmrMiffin($age, $gender, $height, $weight), 0, PHP_ROUND_HALF_UP);

# Load activity multipliers from a data file
$activityMultipliersJson = file_get_contents('../data/activityMultipliers.json');
$activityMultipliers = json_decode($activityMultipliersJson, true);

# Calculate calories burned/day based on activity and round the value
$caloriesBurnedMiffin = round($bmrMiffin * $activityMultipliers[$activity], 0, PHP_ROUND_HALF_UP);

# Calculate BMR based on Harris-Benedict formula and round the value
if($calculateBmrHarris == 'yes') {
    $bmrHarris = round(calculateBmrHarris($age, $gender, $height, $weight), 0, PHP_ROUND_HALF_UP);
}

if($compareCaloriesBurned == 'yes') {
    foreach($activityMultipliers as $activityKey => $activityMultiplier){
        $caloriesForActivitiesMiffin[ucwords(str_replace('_', ' ', $activityKey))] = round(($activityMultipliers[$activityKey] * $bmrMiffin), 0, PHP_ROUND_HALF_UP) ;
    }
}

$_SESSION['results'] = [
    'bmrMiffin' => $bmrMiffin,
    'caloriesBurnedMiffin' => $caloriesBurnedMiffin,
    'calculateBmrHarris' =>  $calculateBmrHarris,
    'bmrHarris' => $bmrHarris,
    'compareCaloriesBurned' => $compareCaloriesBurned,
    'caloriesForActivitiesMiffin' => $caloriesForActivitiesMiffin
];

echo dump($_SESSION['results']);

header('Location: ../index.php');


