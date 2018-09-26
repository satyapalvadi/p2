<?php
require 'display_logic.php';
?>

<!DOCTYPE html>
<html lang='en-US'>
<head>
    <title>P2 - Calories Burned Estimator</title>
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
    <link rel="stylesheet" href="styles/main.css">
    <meta charset='utf-8'>
</head>
<body>
<div class='container container-style'>
    <!-- title -->
    <div class='col text-center'>
        <h1>Calories Burned Estimator</h1>
    </div>

    <form action='logic/logic.php' method='GET'>
        <!-- Age text box -->
        <div class='form-group row align-middle'>
            <div class='col-sm-5 text-right no-right-gutter'>
                <span><strong>Age</strong></span>
            </div>
            <div class='col-sm-7'>
                <input id='age'
                       type='text'
                       name='age'
                    <?php if (isset($inputAge)): ?> value='<?= $inputAge ?>' <?php endif; ?>>
                <span>Years</span>
            </div>
        </div>

        <!-- Gender radio -->
        <div class='form-group row align-middle'>
            <div class='col-sm-5 text-right no-right-gutter'>
                <span><strong>Gender</strong></span>
            </div>
            <div class='col-sm-7'>
                <input type='radio'
                       id='male'
                       name='gender'
                       value='male'
                    <?php if (isset($inputGender)):
                        if ($inputGender == 'male'):
                            echo 'checked';
                        endif;
                    else:
                        echo 'checked';
                    endif; ?>>
                <span>Male</span>
                <input type='radio'
                       id='female'
                       name='gender'
                       value='female' <?php if (isset($inputGender) && $inputGender == 'female'): ?> checked <?php endif; ?>>
                <span>Female</span>
            </div>
        </div>

        <!-- Weight text box and units radio -->
        <div class='form-group row align-middle'>
            <div class='col-sm-5 text-right no-right-gutter'>
                <span><strong>Weight</strong></span>
            </div>
            <div class='col-sm-7'>
                <input type='text'
                       id='weightValue'
                       name='weightValue' <?php if (isset($inputWeight)): ?> value='<?= $inputWeight ?>' <?php endif; ?>>
                <input type='radio' id='lbs' name='weightRadio' value='lbs'
                    <?php if (isset($inputWeightRadio)):
                        if ($inputWeightRadio == 'lbs'):
                            echo 'checked';
                        endif;
                    else:
                        echo 'checked';
                    endif; ?>>
                <span>lbs</span>
                <input type='radio'
                       id='kgs'
                       name='weightRadio'
                       value='kgs' <?php if (isset($inputWeightRadio) && $inputWeightRadio == 'kgs'): ?> checked <?php endif; ?>>
                <span>kgs</span>
            </div>
        </div>

        <!-- Height text box and units radio -->
        <div class='form-group row align-middle'>
            <div class='col-sm-5 text-right no-right-gutter'>
                <span><strong>Height</strong></span>
            </div>
            <div class='col-sm-7'>
                <input type='text'
                       id='heightValue'
                       name='heightValue' <?php if (isset($inputHeight)): ?> value='<?= $inputHeight ?>' <?php endif; ?>>
                <input type='radio' id='inches' name='heightRadio' value='inches'
                    <?php if (isset($inputHeightRadio)):
                        if ($inputHeightRadio == 'inches'):
                            echo 'checked';
                        endif;
                    else:
                        echo 'checked';
                    endif; ?>>
                <span>inches</span>
                <input type='radio'
                       id='cms'
                       name='heightRadio'
                       value='cms' <?php if (isset($inputHeightRadio) && $inputHeightRadio == 'cms'): ?> checked <?php endif; ?>>
                <span>cms</span>
            </div>
        </div>

        <!-- Drop down to select activity levels -->
        <div class='form-group row align-middle'>
            <div class='col-sm-5 text-right no-right-gutter'>
                <span><strong>Activity Level</strong></span>
            </div>
            <div class='col-sm-7'>
                <select name='activity'>
                    <option value='low' <?php if (isset($inputActivity) && $inputActivity == 'low'): ?> selected <?php endif; ?>>Low - You get little to no exercise</option>
                    <option value='light' <?php if (isset($inputActivity) && $inputActivity == 'light'): ?> selected <?php endif; ?>>Light - You exercise lightly (1-3 days per week)</option>
                    <option value='moderate' <?php if (isset($inputActivity) && $inputActivity == 'moderate'): ?> selected <?php endif; ?>>Moderate - You exercise moderately (3-5 days per week)</option>
                    <option value='high' <?php if (isset($inputActivity) && $inputActivity == 'high'): ?> selected <?php endif; ?>>High - You exercise heavily (6-7 days per week)</option>
                    <option value='very_high' <?php if (isset($inputActivity) && $inputActivity == 'very_high'): ?> selected <?php endif; ?>>Very High - You exercise very heavily (i.e. 2x per day, extra heavy workouts)</option>
                </select>
            </div>
        </div>

        <!-- Checkbox to calculate using an alternate equation -->
        <div class='form-group row align-middle'>
            <div class='col-sm-5 no-right-gutter checkbox'>
                <input type='checkbox'
                       id='harrisBenedict'
                       name='harrisBenedict'
                       value='yes' <?php if (isset($selectedBmrHarris) && $selectedBmrHarris == 'yes'): ?> checked <?php endif; ?>>
            </div>
            <div class='col-sm-7 text-left'>
                <span>Show BMR value for Harris-Benedict equation</span>
            </div>
        </div>

        <!-- Checkbox to compare calories based on different activity levels -->
        <div class='form-group row align-middle'>
            <div class='col-sm-5 no-right-gutter checkbox'>
                <input type='checkbox'
                       id='compareCalories'
                       name='compareCalories'
                       value='yes' <?php if (isset($selectedCompareCalories) && $selectedCompareCalories == 'yes'): ?> checked <?php endif; ?>>
            </div>
            <div class='col-sm-7 text-left'>
                <span>Show how different levels of activity impact calories burned</span>
            </div>
        </div>
        <div class='col text-center'>
            <input class='btn btn-primary' type='submit' id='calculate' value='Calculate'>
        </div>
    </form>
</div>

<!-- Output -->
<?php if (isset($results)): ?>
    <div class='container'>
        <div class='row output-title'>
            <div class='col text-center'>
                <h2>Your Results</h2>
            </div>
        </div>

        <!-- Displays BMR if it is set in the results -->
        <div class='row output-row'>
            <div class='col text-left'>
                <?php if (isset($bmrMiffin)): ?>
                <span>Basal Metabolic Rate (BMR): </span>
                <span><strong><?= $bmrMiffin ?></strong><span> <span> calories/day</span>
                        <?php endif; ?>
            </div>
        </div>

        <!-- Displays calories burned if it is set in the results-->
        <div class='row output-row'>
            <div class='col text-left'>
                <?php if (isset($caloriesBurnedMiffin)): ?>
                    <span>Calories burned based on your activity level: </span>
                    <span><strong><?= $caloriesBurnedMiffin ?></strong></span><span> calories/day</span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Displays BMR calculated as per Harris-Benedict equation if the user selected the checkbox and if the value is set in results -->
        <div class='row output-row'>
            <div class='col text-left'>
                <?php if (isset($calculateBmrHarris) && $calculateBmrHarris == 'yes'): ?>
                    <span>BMR (Harris-Benedict equation): </span><span><strong><?= $bmrHarris ?></strong></span>
                    <span> calories/day</span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Displays a table if the user selected the checkbox to compare and if the value array is set in results -->
        <div class='row justify-content-left table-row'>
            <?php if (isset($compareCaloriesBurned) && $compareCaloriesBurned == 'yes'): ?>
                <table class="table table-bordered">
                    <caption class='table-caption'>Calories burned based on different activity levels</caption>
                    <thead>
                    <tr>
                        <th scope='col'
                            class='text-center align-middle bg-light'
                            style='width:20%;'>Activity levels
                        </th>
                        <?php foreach ($caloriesForActivitiesMiffin as $key => $caloriesForActivityMiffin): ?>
                            <th scope='col' style='width:16%;'
                                class='text-center align-middle bg-light <?php if ($key == $inputActivity): ?>matched-activity-table-cell text-primary<?php endif; ?>'>
                                <?= ucwords(str_replace('_', ' ', $key)) ?>
                                <?php if ($key == $inputActivity): ?>
                                    <div class='text-primary'>(selected level)</div><?php endif; ?>
                            </th>
                        <?php endforeach; ?>
                    </tr>
                    </thead>
                    <tr>
                        <th scope='col' class='text-center align-middle bg-light'>Calories burned/day</th>
                        <?php foreach ($caloriesForActivitiesMiffin as $key => $caloriesForActivityMiffin): ?>
                            <td scope='col'
                                class='text-center align-middle <?php if ($key == $inputActivity): ?> matched-activity-table-cell text-primary <?php endif; ?>'>
                                <?= $caloriesForActivitiesMiffin[$key] ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                </table>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

</body>
</html>
