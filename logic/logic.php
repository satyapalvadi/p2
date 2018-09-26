<?php
require '../includes/helpers.php';
require 'bmrCalculators.php';

session_start();

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

# Load activity multipliers from the data file
$activityMultipliersJson = file_get_contents('../data/activityMultipliers.json');
$activityMultipliers = json_decode($activityMultipliersJson, true);

# Calculate calories burned/day based on activity levels and round the value
$caloriesBurnedMiffin = round($bmrMiffin * $activityMultipliers[$activity], 0, PHP_ROUND_HALF_UP);

# Calculate BMR based on Harris-Benedict equation and round the value
if ($calculateBmrHarris == 'yes') {
    $bmrHarris = round(calculateBmrHarris($age, $gender, $height, $weight), 0, PHP_ROUND_HALF_UP);
}

# Calculate calories burned based on different activity levels
if ($compareCaloriesBurned == 'yes') {
    foreach ($activityMultipliers as $activityKey => $activityMultiplier) {
        $caloriesForActivitiesMiffin[$activityKey] = round(($activityMultipliers[$activityKey] * $bmrMiffin), 0, PHP_ROUND_HALF_UP);
    }
}

# Save the results to $_SESSION global var
$_SESSION['results'] = [
    'bmrMiffin' => $bmrMiffin,
    'caloriesBurnedMiffin' => $caloriesBurnedMiffin,
    'calculateBmrHarris' => $calculateBmrHarris,
    'bmrHarris' => $bmrHarris,
    'compareCaloriesBurned' => $compareCaloriesBurned,
    'caloriesForActivitiesMiffin' => $caloriesForActivitiesMiffin,
    'inputAge' => $age,
    'inputHeight' => $_GET['heightValue'],
    'inputHeightRadio' => $heightRadio,
    'inputWeight' => $_GET['weightValue'],
    'inputWeightRadio' => $weightRadio,
    'inputGender' => $gender,
    'inputActivity' => $activity,
    'selectedBmrHarris' => $calculateBmrHarris,
    'selectedCompareCalories' => $compareCaloriesBurned
];

# Redirect the user to index.php
header('Location: ../index.php');


