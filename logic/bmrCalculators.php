<?php

# Function to calculate BMR based on MD Miffin and ST St Jeor formula
/**
 * @param $age
 * @param $gender
 * @param $height
 * @param $weight
 */
function calculateBmrMiffin($age, $gender, $height, $weight)
{
    $s = $gender == 'male' ? 5 : -161;
    $bmr = ((9.99 * $weight) + (6.25 * $height) - (4.92 * $age) + $s);

    return $bmr;
}

# Function to calculate BMR based on Harris Benedict formula
function calculateBmrHarris($age, $gender, $height, $weight)
{
    $bmr = 0.0;
    if ($gender == 'male') {
        $bmr = ((13.7516 * $weight) + (5.0033 * $height) - (6.755 * $age) + 66.473);
    } else {
        $bmr = ((9.5634 * $weight) + (1.8496 * $height) - (4.6756 * $age) + 655.0955);
    }

    return $bmr;
}

# Function to convert height in inches to centimeters
function convertToCms($heightInInches)
{
    return $heightInInches / 0.39370;
}

# Function to convert weight in pounds to kilograms
function convertToKgs($weightInLbs)
{
    return $weightInLbs / 2.2046;
}

