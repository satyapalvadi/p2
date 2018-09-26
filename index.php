<?php
require 'display_logic.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>P2 - Calories Burned Calculator</title>
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
    <link rel="stylesheet" href="styles/main.css">
    <meta charset='utf-8'>
</head>
<body>
<div class='container' style='border: 5px black solid'>
    <div class='col text-center'>
        <h1>Calories Burned Calculator</h1>
    </div>
    <form action='logic/logic.php' method='GET'>
        <div class='form-group row align-middle'>
            <div class='col-sm-5 text-right'>
                <span>Age</span>
            </div>
            <div class='col-sm-7'>
                <input id='age' type='text' name='age'> <span>Years</span>
            </div>
        </div>
        <div class='form-group row align-middle'>
            <div class='col-sm-5 text-right'>
                <span>Gender</span>
            </div>
            <div class='col-sm-7'>
                <input type='radio' id='male' name='gender' value='male' checked>
                <span>Male</span>
                <input type='radio' id='female' name='gender' value='female'>
                <span>Female</span>
            </div>
        </div>
        <div class='form-group row align-middle'>
            <div class='col-sm-5 text-right'>
                <span> Weight </span>
            </div>
            <div class='col-sm-7'>
                <input type='text' id='weightValue' name='weightValue'>
                <input type='radio' id='lbs' name='weightRadio' value='lbs' checked>
                <span>lbs</span>
                <input type='radio' id='kgs' name='weightRadio' value='kgs'>
                <span>kgs</span>
            </div>
        </div>
        <div class='form-group row align-middle'>
            <div class='col-sm-5 text-right'>
                <span> Height </span>
            </div>
            <div class='col-sm-7'>
                <input type='text' id='heightValue' name='heightValue'>
                <input type='radio' id='inches' name='heightRadio' value='inches' checked>
                <span>inches</span>
                <input type='radio' id='cms' name='weightRadio' value='cms'>
                <span>cms</span>
            </div>
        </div>
        <div class='form-group row align-middle'>
            <label class='col-sm-5 text-right'>Activity</label>
            <div class='col-sm-7'>
                <select name='activity'>
                    <option value='low'>Low - You get little to no exercise</option>
                    <option value='light'>Light - You exercise lightly (1-3 days per week)</option>
                    <option value='moderate'>Moderate - You exercise moderately (3-5 days per week)</option>
                    <option value='high'>High - You exercise heavily (6-7 days per week)</option>
                    <option value='very_high'>Very High - You exercise very heavily (i.e. 2x per day, extra heavy workouts)</option>
                </select>
            </div>
        </div>
        <div class='form-group row align-middle'>
            <div class='col-sm-5' style='display: flex; align-items: center; justify-content: flex-end'>
                <input type='checkbox' id='harrisBenedict' name='harrisBenedict' value='yes'>
            </div>
            <div class='col-sm-7 text-left'>
                <span>Show results for Harris-Benedict Equation</span>
            </div>
        </div>
        <div class='form-group row align-middle'>
            <div class='col-sm-5' style='display: flex; align-items: center; justify-content: flex-end'>
                <input type='checkbox' id='compareCalories' name='compareCalories' value='yes'>
            </div>
            <div class='col-sm-7 text-left'>
                <span>Show how activity impacts calories burned</span>
            </div>
        </div>
        <div class='col text-center'>
            <input class='btn btn-primary' type='submit' id='calculate' value='Calculate'>
        </div>
    </form>
</div>

<div class='container'>
    <div class='col text-center'>
        <?php if (isset($results)): ?>
            <h2>Your Results</h2>
        <?php endif; ?>
    </div>
    <div class='col text-center' style='font-size: 20px'>
        <?php if (isset($bmrMiffin)): ?>
            <?= 'Basal Metabolic Rate (BMR): ' . $bmrMiffin . ' calories/day'; ?>
        <?php endif; ?>
    </div>
    <div class='col text-center' style='font-size: 20px'>
        <?php if (isset($caloriesBurnedMiffin)): ?>
            <?= 'Calories burned based on your activity level: ' . $caloriesBurnedMiffin . ' calories/day' ?>
        <?php endif; ?>
    </div>
    <div class='col text-center' style='font-size: 20px'>
        <?php if (isset($calculateBmrHarris) && $calculateBmrHarris == 'yes'): ?>
            <?= 'BMR (Harris-Benedict equation): ' . $bmrHarris . ' calories/day'; ?>
        <?php endif; ?>
    </div>
    <div class='row justify-content-center'>
        <?php if (isset($compareCaloriesBurned) && $compareCaloriesBurned == 'yes'): ?>
            <table class="table table-bordered" style='width:80%'>
                <thead>
                <tr>
                    <th scope='col'>Activity Level</th>
                    <?php foreach ($caloriesForActivitiesMiffin as $key => $caloriesForActivityMiffin): ?>
                        <th scope='col'><?= $key ?></th>
                    <?php endforeach; ?>
                </tr>
                </thead>
                <tr>
                    <th scope='col'>Calories burned/day</th>
                    <?php foreach ($caloriesForActivitiesMiffin as $key => $caloriesForActivityMiffin): ?>
                        <td scope='col'><?= $caloriesForActivitiesMiffin[$key] ?></td>
                    <?php endforeach; ?>
                </tr>
            </table>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
