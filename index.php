<!DOCTYPE html>
<html>
<head>
    <title>P2 - Calories Burned Calculator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta charset='utf-8'>
</head>
<body>
    <h1>Calories Burned Calculator</h1>
    <form action='logic/logic.php' method='GET'>
        <label for='age'> Age:
            <input type='text' name='age'> Years
        </label>
        <br/>
        <label for='gender'> Gender:
            <input type='radio' name='male' value='male'> Male
            <input type='radio' name='male' value='male'> Female
        </label>
        <br/>
        <label for='weight'> Weight
            <input type='text' name='weightValue'>
            <input type='radio' name='weightRadio' value='kgs'> kgs
            <input type='radio' name='weightRadio' value='lbs'> lbs
        </label>
        <br/>
        <label for='height'> Height
            <input type='text' name='heightValue'>
            <input type='radio' name='heightRadio' value='inches'> inches
            <input type='radio' name='weightRadio' value='cms'> cm
        </label>
        <br/>
        <label for='activity'> Activity
            <select name='activity'>
                <option value='low'>Low - You get little to no exercise</option>
                <option value='light'>Light - You exercise lightly (1-3 days per week)</option>
                <option value='moderate'>Moderate - You exercise moderately (3-5 days per week)</option>
                <option value='high'>High - You exercise heavily (6-7 days per week)</option>
                <option value='veryHigh'>Very High - You exercise very heavily (i.e. 2x per day, extra heavy workouts)</option>
            </select>
        </label>
        <br/>
        <input type='checkbox' name='harrisBenedict' value='selected'>Show results for Harris-Benedict Equation
        <br/>
        <input type='checkbox' name='compareCalories' value='selected'>Show how activity impacts Calories burned
        </br>
        <input type='submit' value='Calculate'>

    </form>
</body>

</html>
