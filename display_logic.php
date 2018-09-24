<?php
session_start();

if (isset($_SESSION['results'])) {
    $results = $_SESSION['results'];
    $bmrMiffin = $results['bmrMiffin'];
    $caloriesBurnedMiffin = $results['caloriesBurnedMiffin'];
    $calculateBmrHarris = $results['calculateBmrHarris'];
    if($calculateBmrHarris == 'yes'){
        $bmrHarris = $results['bmrHarris'];
    }
    $compareCaloriesBurned = $results['compareCaloriesBurned'];
    if($compareCaloriesBurned == 'yes'){
        $caloriesForActivitiesMiffin = $results['caloriesForActivitiesMiffin'];
    }
}

session_unset();