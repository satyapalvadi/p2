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
    <meta charset='utf-8'>
</head>
<body>
<h1>Calories Burned Calculator</h1>
<form action='logic/logic.php' method='GET'>
    <label for='age'> Age:
        <input type='text' name='age'> Years
    </label>
    <br/>
    <label> Gender:
        <input type='radio' id='male' name='gender' value='male' checked>
        <label for='male'>Male</label>
        <input type='radio' id='female' name='gender' value='female'>
        <label for='female'>Female</label>
    </label>
    <br/>
    <label> Weight:
        <input type='text' id='weightValue' name='weightValue'>
        <input type='radio' id='lbs' name='weightRadio' value='lbs' checked>
        <label for='lbs'>lbs</label>
        <input type='radio' id='kgs' name='weightRadio' value='kgs'>
        <label for='kgs'>kgs</label>

    </label>
    <br/>
    <label> Height
        <input type='text' id='heightValue' name='heightValue'>
        <input type='radio' id='inches' name='heightRadio' value='inches' checked>
        <label for='inches'>inches</label>
        <input type='radio' id='cms' name='weightRadio' value='cms'>
        <label for='cms'>cms</label>
    </label>
    <br/>
    <label> Activity:
        <select name='activity'>
            <option value='low'>Low - You get little to no exercise</option>
            <option value='light'>Light - You exercise lightly (1-3 days per week)</option>
            <option value='moderate'>Moderate - You exercise moderately (3-5 days per week)</option>
            <option value='high'>High - You exercise heavily (6-7 days per week)</option>
            <option value='veryHigh'>Very High - You exercise very heavily (i.e. 2x per day, extra heavy workouts)</option>
        </select>
    </label>
    <br/>
    <input type='checkbox' id='harrisBenedict' name='harrisBenedict' value='harrisBenedict'>
    <label for='harrisBenedict'>Show results for Harris-Benedict Equation</label>
    <br/>
    <input type='checkbox' id='compareCalories' name='compareCalories' value='compareCalories'>
    <label for='compareCalories'>Show how activity impacts calories burned</label>
    </br>
    <input type='submit' id='calculate' value='Calculate'>
</form>
<div>
    <h2>Output</h2>
    <?php if (isset($bmrMiffin)): ?>
        <?= 'BMR' . $bmrMiffin; ?>
    <?php endif; ?>
</div>

</body>

</html>
