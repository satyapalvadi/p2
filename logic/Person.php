<?php

namespace BMR;

class Person
{

    # Properties
    private $age;
    private $height;
    private $weight;
    private $gender;
    private $activity;
    private $activityMultipliers;

    public function __construct($age, $height, $weight, $gender, $activity)
    {
        $this->age = $age;
        $this->height = $height;
        $this->weight = $weight;
        $this->gender = $gender;
        $this->activity = $activity;

        # Load activity multipliers from the data file
        $activityMultipliersJson = file_get_contents('../data/activityMultipliers.json');
        $this->activityMultipliers = json_decode($activityMultipliersJson, true);
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getActivity()
    {
        return $this->activity;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function calculateBMRMiffin()
    {
        $s = $this->gender == 'male' ? 5 : -161;
        $bmr = ((9.99 * $this->weight) + (6.25 * $this->height) - (4.92 * $this->age) + $s);

        return round($bmr, 0, PHP_ROUND_HALF_UP);
    }

    public function calculateBMRHarris()
    {
        if ($this->gender == 'male') {
            $bmr = ((13.7516 * $this->weight) + (5.0033 * $this->height) - (6.755 * $this->age) + 66.473);
        } else {
            $bmr = ((9.5634 * $this->weight) + (1.8496 * $this->height) - (4.6756 * $this->age) + 655.0955);
        }

        return round($bmr, 0, PHP_ROUND_HALF_UP);
    }

    public function caloriesBurnedMiffin()
    {
        return round($this->calculateBMRMiffin() * $this->activityMultipliers[$this->activity], 0, PHP_ROUND_HALF_UP);
    }

    public function compareCaloriesBurned()
    {
        foreach ($this->activityMultipliers as $activityKey => $activityMultiplier) {
            $caloriesForActivitiesMiffin[$activityKey] = round(($this->activityMultipliers[$activityKey] * $this->calculateBMRMiffin()), 0, PHP_ROUND_HALF_UP);
        }

        return $caloriesForActivitiesMiffin;
    }

}

