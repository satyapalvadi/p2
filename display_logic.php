<?php
session_start();

# Dump various values from session into individual variables for index.php to process easily
if (isset($_SESSION['results'])) {
    $results = $_SESSION['results'];
    $bmrMiffin = $results['bmrMiffin'];
    $caloriesBurnedMiffin = $results['caloriesBurnedMiffin'];
    $calculateBmrHarris = $results['calculateBmrHarris'];
    if ($calculateBmrHarris == 'yes') {
        $bmrHarris = $results['bmrHarris'];
    }
    $compareCaloriesBurned = $results['compareCaloriesBurned'];
    if ($compareCaloriesBurned == 'yes') {
        $caloriesForActivitiesMiffin = $results['caloriesForActivitiesMiffin'];
    }
    $inputAge = $results['inputAge'];
    $inputGender = $results['inputGender'];
    $inputWeight = $results['inputWeight'];
    $inputHeight = $results['inputHeight'];
    $inputWeightRadio = $results['inputWeightRadio'];
    $inputHeightRadio = $results['inputHeightRadio'];
    $selectedCompareCalories = $results['selectedCompareCalories'];
    $selectedBmrHarris = $results['selectedBmrHarris'];
    $inputActivity = $results['inputActivity'];
}

session_unset();