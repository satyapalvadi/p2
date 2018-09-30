<?php
require '../includes/helpers.php';
require '../includes/calculatorHelpers.php';
require 'Person.php';
require 'Form.php';

use BMR\Person;
use BMR\Form;

session_start();

# Instantiate the Form class
$form = new Form($_GET);

# Retrieve input field values using form class methods.
$age = $form->get('age');
$gender = $form->get('gender');
$heightValue = $form->get('heightValue');
$weightValue = $form->get('weightValue');
$heightRadio = $form->get('heightRadio');
$weightRadio = $form->get('weightRadio');
$activity = $form->get('activity');
$calculateBmrHarris = $form->has('harrisBenedict') ? $form->get('harrisBenedict') : 'no';
$compareCaloriesBurned = $form->has('compareCalories') ? $form->get('compareCalories') : 'no';

# Validation methods
$errors = $form->validate(
    ['age' => 'required|digit',
        'heightValue' => 'required|numeric|min:0',
        'weightValue' => 'required|numeric|min:0'
    ]
);

# Height and weight converters
$height = $heightRadio == 'inches' ? convertToCms($heightValue) : $heightValue;
$weight = $weightRadio == 'lbs' ? convertToKgs($weightValue) : $weightValue;

# Lets start populating the session super variable with what we know so far - inputs & form validation errors.
$_SESSION['results'] = [
    'errors' => $errors,
    'hasErrors' => $form->hasErrors,
    'inputAge' => $age,
    'inputHeight' => $heightValue,
    'inputHeightRadio' => $heightRadio,
    'inputWeight' => $weightValue,
    'inputWeightRadio' => $weightRadio,
    'inputGender' => $gender,
    'inputActivity' => $activity,
    'selectedBmrHarris' => $calculateBmrHarris,
    'selectedCompareCalories' => $compareCaloriesBurned
];

# Let's process the form input if there are no errors during validation
if (!$form->hasErrors) {
    # instantiate the Person class
    $person = new Person($age, $height, $weight, $gender, $activity);

    # Calculate BMR based on Miffin St.Jeor equation
    $bmrMiffin = $person->calculateBMRMiffin();

    # Calculate calories burned/day based on activity levels and round the value
    $caloriesBurnedMiffin = $person->caloriesBurnedMiffin();

    # Calculate BMR based on Harris-Benedict equation and round the value
    if ($calculateBmrHarris == 'yes') {
        $bmrHarris = $person->calculateBMRHarris();
    }

    # Calculate calories burned based on different activity levels
    if ($compareCaloriesBurned == 'yes') {
        $caloriesForActivitiesMiffin = $person->compareCaloriesBurned();
    }

    # add the calculated results to the $_SESSION global var
    $_SESSION['results']['bmrMiffin'] = $bmrMiffin;
    $_SESSION['results']['caloriesBurnedMiffin'] = $caloriesBurnedMiffin;
    $_SESSION['results']['bmrHarris'] = $bmrHarris;
    $_SESSION['results']['caloriesForActivitiesMiffin'] = $caloriesForActivitiesMiffin;
}

# Redirect the user to index.php
header('Location: ../index.php');

