<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Physical Activity Survey and Menopause Rating Scale</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px; /* Add padding to the body to prevent cropping */
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f9f9f9;
            min-height: 100vh; /* Ensure the body takes at least full height */
            box-sizing: border-box; /* Include padding and border in width and height */
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px; /* Set a max width for better readability */
            width: 100%; /* Responsive width */
            box-sizing: border-box; /* Include padding and border in width */
        }
        h2 {
            margin-top: 0; /* Remove margin at the top of headings */
            color: #007bff; /* Optional: change heading color */
        }
        label {
            margin: 10px 0;
            display: block;
        }
        input[type="text"], input[type="number"] {
            margin: 10px 0;
            padding: 10px; /* Increase padding for better touch targets */
            width: 100%; /* Full width inputs */
            border: 1px solid #ccc; /* Add border for text inputs */
            border-radius: 4px; /* Round corners */
            box-sizing: border-box; /* Include padding and border in width */
        }
        input[type="checkbox"] {
            margin: 10px 0;
        }
        .symptom {
            margin: 15px 0;
            padding: 10px;
            border: 1px solid #ccc; /* Add border to symptoms */
            border-radius: 5px; /* Round corners */
            background-color: #f1f1f1; /* Light gray background */
        }
        .radio-group {
            display: flex;
            flex-wrap: wrap; /* Allow wrapping for smaller screens */
            justify-content: flex-start; /* Align items to the start */
            margin-top: 5px;
        }
        .radio-group label {
            flex: 1 0 45%; /* Each label takes up to 45% of the width */
            margin-right: 5%; /* Space between radio buttons */
            margin-bottom: 10px; /* Space below each radio option */
        }
        .radio-group label:nth-child(odd) {
            margin-right: 0; /* Remove right margin for odd labels */
        }
        .radio-group input[type="radio"] {
            margin-right: 5px; /* Spacing between radio buttons */
        }
        button {
            margin-top: 15px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s; /* Smooth transition */
            width: 100%; /* Full width button */
        }
        button:hover {
            background-color: #0056b3;
        }
        @media (max-width: 600px) {
            .radio-group label {
                flex: 1 0 100%; /* Full width on small screens */
                margin-right: 0; /* Remove margin */
            }
        }
    </style>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost"; // Change if needed
    $username = "your_username"; // Your database username
    $password = "your_password"; // Your database password
    $dbname = "your_database"; // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO survey_responses (vigorous_days, no_vigorous, vigorous_time_hours, vigorous_time_minutes, moderate_days, no_moderate, moderate_time_hours, moderate_time_minutes, walking_days, no_walking, walking_time_hours, walking_time_minutes, sitting_time_hours, sitting_time_minutes, hot_flushes, heart_discomfort, sleep_problems, depressive_mood, irritability, anxiety, exhaustion, sexual_problems, bladder_problems, vaginal_dryness, joint_discomfort) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("issssissssissssssssssssssss",
        $_POST['vigorous-days'],
        isset($_POST['no-vigorous']) ? 'yes' : 'no',
        $_POST['vigorous-time-hours'],
        $_POST['vigorous-time-minutes'],
        $_POST['moderate-days'],
        isset($_POST['no-moderate']) ? 'yes' : 'no',
        $_POST['moderate-time-hours'],
        $_POST['moderate-time-minutes'],
        $_POST['walking-days'],
        isset($_POST['no-walking']) ? 'yes' : 'no',
        $_POST['walking-time-hours'],
        $_POST['walking-time-minutes'],
        $_POST['sitting-time-hours'],
        $_POST['sitting-time-minutes'],
        $_POST['hot-flushes'],
        $_POST['heart-discomfort'],
        $_POST['sleep-problems'],
        $_POST['depressive-mood'],
        $_POST['irritability'],
        $_POST['anxiety'],
        $_POST['exhaustion'],
        $_POST['sexual-problems'],
        $_POST['bladder-problems'],
        $_POST['vaginal-dryness'],
        $_POST['joint-discomfort']
    );

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "<p>Data submitted successfully!</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<form id="survey-form" action="" method="post"> <!-- Action is the same page -->
    <h2>Physical Activity Survey</h2>
    
    <label for="vigorous-days">1. During the last 7 days, on how many days did you do vigorous physical activities?</label>
    <input type="text" id="vigorous-days" name="vigorous-days" placeholder="_____ days per week" required>

    <label><input type="checkbox" id="no-vigorous" name="no-vigorous"> No vigorous physical activities (Skip to question 3)</label>

    <label for="vigorous-time-hours">2. How much time did you usually spend doing vigorous physical activities on one of those days?</label>
    <input type="number" id="vigorous-time-hours" name="vigorous-time-hours" placeholder="_____ hours per day">
    <input type="number" id="vigorous-time-minutes" name="vigorous-time-minutes" placeholder="_____ minutes per day">
    <label><input type="radio" name="vigorous-time-know" value="dont-know"> Don’t know/Not sure</label>

    <label>Think about all the moderate activities that you did in the last 7 days...</label>

    <label for="moderate-days">3. During the last 7 days, on how many days did you do moderate physical activities?</label>
    <input type="text" id="moderate-days" name="moderate-days" placeholder="_____ days per week" required>

    <label><input type="checkbox" id="no-moderate" name="no-moderate"> No moderate physical activities (Skip to question 5)</label>

    <label for="moderate-time-hours">4. How much time did you usually spend doing moderate physical activities on one of those days?</label>
    <input type="number" id="moderate-time-hours" name="moderate-time-hours" placeholder="_____ hours per day">
    <input type="number" id="moderate-time-minutes" name="moderate-time-minutes" placeholder="_____ minutes per day">
    <label><input type="radio" name="moderate-time-know" value="dont-know"> Don’t know/Not sure</label>

    <label>Think about the time you spent walking in the last 7 days...</label>

    <label for="walking-days">5. During the last 7 days, on how many days did you walk for at least 10 minutes at a time?</label>
    <input type="text" id="walking-days" name="walking-days" placeholder="_____ days per week" required>

    <label><input type="checkbox" id="no-walking" name="no-walking"> No walking (Skip to question 7)</label>

    <label for="walking-time-hours">6. How much time did you usually spend walking on one of those days?</label>
    <input type="number" id="walking-time-hours" name="walking-time-hours" placeholder="_____ hours per day">
    <input type="number" id="walking-time-minutes" name="walking-time-minutes" placeholder="_____ minutes per day">
    <label><input type="radio" name="walking-time-know" value="dont-know"> Don’t know/Not sure</label>

    <label>7. During the last 7 days, how much time did you spend sitting on a week day?</label>
    <input type="number" id="sitting-time-hours" name="sitting-time-hours" placeholder="_____ hours per day">
    <input type="number" id="sitting-time-minutes" name="sitting-time-minutes" placeholder="_____ minutes per day">

    <h2>Menopause Rating Scale</h2>
    <p>Which of the following symptoms apply to you at this time? Please, mark the appropriate box for each symptom.</p>

    <div class="symptom">
        <label for="hot-flushes">1. Hot flushes, sweating (episodes of sweating)</label>
        <div class="radio-group">
            <label><input type="radio" name="hot-flushes" value="none" required> none</label>
            <label><input type="radio" name="hot-flushes" value="0"> Score = 0</label>
            <label><input type="radio" name="hot-flushes" value="1"> Score = 1</label>
            <label><input type="radio" name="hot-flushes" value="2"> Score = 2</label>
        </div>
    </div>

    <div class="symptom">
        <label for="heart-discomfort">2. Heart discomfort (e.g., palpitations, pounding heart)</label>
        <div class="radio-group">
            <label><input type="radio" name="heart-discomfort" value="none" required> none</label>
            <label><input type="radio" name="heart-discomfort" value="0"> Score = 0</label>
            <label><input type="radio" name="heart-discomfort" value="1"> Score = 1</label>
            <label><input type="radio" name="heart-discomfort" value="2"> Score = 2</label>
        </div>
    </div>

    <div class="symptom">
        <label for="sleep-problems">3. Sleep problems (e.g., difficulty falling asleep, waking up at night)</label>
        <div class="radio-group">
            <label><input type="radio" name="sleep-problems" value="none" required> none</label>
            <label><input type="radio" name="sleep-problems" value="0"> Score = 0</label>
            <label><input type="radio" name="sleep-problems" value="1"> Score = 1</label>
            <label><input type="radio" name="sleep-problems" value="2"> Score = 2</label>
        </div>
    </div>

    <div class="symptom">
        <label for="depressive-mood">4. Depressive mood</label>
        <div class="radio-group">
            <label><input type="radio" name="depressive-mood" value="none" required> none</label>
            <label><input type="radio" name="depressive-mood" value="0"> Score = 0</label>
            <label><input type="radio" name="depressive-mood" value="1"> Score = 1</label>
            <label><input type="radio" name="depressive-mood" value="2"> Score = 2</label>
        </div>
    </div>

    <div class="symptom">
        <label for="irritability">5. Irritability</label>
        <div class="radio-group">
            <label><input type="radio" name="irritability" value="none" required> none</label>
            <label><input type="radio" name="irritability" value="0"> Score = 0</label>
            <label><input type="radio" name="irritability" value="1"> Score = 1</label>
            <label><input type="radio" name="irritability" value="2"> Score = 2</label>
        </div>
    </div>

    <div class="symptom">
        <label for="anxiety">6. Anxiety</label>
        <div class="radio-group">
            <label><input type="radio" name="anxiety" value="none" required> none</label>
            <label><input type="radio" name="anxiety" value="0"> Score = 0</label>
            <label><input type="radio" name="anxiety" value="1"> Score = 1</label>
            <label><input type="radio" name="anxiety" value="2"> Score = 2</label>
        </div>
    </div>

    <div class="symptom">
        <label for="exhaustion">7. Exhaustion (fatigue)</label>
        <div class="radio-group">
            <label><input type="radio" name="exhaustion" value="none" required> none</label>
            <label><input type="radio" name="exhaustion" value="0"> Score = 0</label>
            <label><input type="radio" name="exhaustion" value="1"> Score = 1</label>
            <label><input type="radio" name="exhaustion" value="2"> Score = 2</label>
        </div>
    </div>

    <div class="symptom">
        <label for="sexual-problems">8. Sexual problems</label>
        <div class="radio-group">
            <label><input type="radio" name="sexual-problems" value="none" required> none</label>
            <label><input type="radio" name="sexual-problems" value="0"> Score = 0</label>
            <label><input type="radio" name="sexual-problems" value="1"> Score = 1</label>
            <label><input type="radio" name="sexual-problems" value="2"> Score = 2</label>
        </div>
    </div>

    <div class="symptom">
        <label for="bladder-problems">9. Bladder problems</label>
        <div class="radio-group">
            <label><input type="radio" name="bladder-problems" value="none" required> none</label>
            <label><input type="radio" name="bladder-problems" value="0"> Score = 0</label>
            <label><input type="radio" name="bladder-problems" value="1"> Score = 1</label>
            <label><input type="radio" name="bladder-problems" value="2"> Score = 2</label>
        </div>
    </div>

    <div class="symptom">
        <label for="vaginal-dryness">10. Vaginal dryness</label>
        <div class="radio-group">
            <label><input type="radio" name="vaginal-dryness" value="none" required> none</label>
            <label><input type="radio" name="vaginal-dryness" value="0"> Score = 0</label>
            <label><input type="radio" name="vaginal-dryness" value="1"> Score = 1</label>
            <label><input type="radio" name="vaginal-dryness" value="2"> Score = 2</label>
        </div>
    </div>

    <div class="symptom">
        <label for="joint-discomfort">11. Joint discomfort</label>
        <div class="radio-group">
            <label><input type="radio" name="joint-discomfort" value="none" required> none</label>
            <label><input type="radio" name="joint-discomfort" value="0"> Score = 0</label>
            <label><input type="radio" name="joint-discomfort" value="1"> Score = 1</label>
            <label><input type="radio" name="joint-discomfort" value="2"> Score = 2</label>
        </div>
    </div>

    <button type="submit">Submit</button>
</form>

</body>
</html>
