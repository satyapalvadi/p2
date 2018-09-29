<?php
session_start();

# Dump various values from session into individual variables for index.php to process easily
if (isset($_SESSION['results'])) {
    $results = $_SESSION['results'];

    $errors = $results['errors'];
    $hasErrors = $results['hasErrors'];

    $inputAge = $results['inputAge'];
    $inputGender = $results['inputGender'];
    $inputWeight = $results['inputWeight'];
    $inputHeight = $results['inputHeight'];
    $inputWeightRadio = $results['inputWeightRadio'];
    $inputHeightRadio = $results['inputHeightRadio'];
    $inputActivity = $results['inputActivity'];
    $selectedCompareCalories = $results['selectedCompareCalories'];
    $selectedBmrHarris = $results['selectedBmrHarris'];

    if (!$hasErrors) {
        $bmrMiffin = $results['bmrMiffin'];
        $caloriesBurnedMiffin = $results['caloriesBurnedMiffin'];
        if ($selectedBmrHarris == 'yes') {
            $bmrHarris = $results['bmrHarris'];
        }
        if ($selectedCompareCalories == 'yes') {
            $caloriesForActivitiesMiffin = $results['caloriesForActivitiesMiffin'];
        }
    }
}

session_unset();