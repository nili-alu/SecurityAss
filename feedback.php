<?php
include('./backend/handling.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit_feedback'])) {
        $request_id = isset($_GET['request_id']) ? (int)$_GET['request_id'] : null;
        $facilitator_id = isset($_GET['facilitator_id']) ? (int)$_GET['facilitator_id'] : null;
        $student_id = isset($_GET['student_id']) ? (int)$_GET['student_id'] : null;
        $feedback_content = mysqli_real_escape_string($conn, $_POST['Feedbacks']); // Escape the feedback content

        // Check if the request_id is valid
        if ($request_id === null || $request_id <= 0) {
            echo "Invalid request ID.";
            exit(); // Stop further execution
        }
        echo $request_id;
        echo $facilitator_id;
        echo $student_id;
        // Insert the feedback into the database
        $insert_feedback_query = "INSERT INTO feedback (Re_Id, F_Id, Stu_Id, Feedbacks) VALUES ($request_id, $facilitator_id, $student_id, '$feedback_content')";


        if (mysqli_query($conn, $insert_feedback_query)) {
            echo "Feedback submitted successfully.";
        } else {
            echo "Error: " . $insert_feedback_query . "<br>" . mysqli_error($conn);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Feedback</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Add Feedback</h1>
        <nav>
            <ul>
                <li><a href="facilitators.php">Back to Requests</a></li>
            </ul>
        </nav>
    </header>

    <div class="feedback-section">
        <h2>Request Details: </h2>
        <?php
            $request_id = isset($_GET['request_id']) ? (int)$_GET['request_id'] : null;
            $facilitator_id = isset($_GET['facilitator_id']) ? (int)$_GET['facilitator_id'] : null;
            $student_id = isset($_GET['student_id']) ? (int)$_GET['student_id'] : null;
            echo $request_id;
            echo $facilitator_id;
            echo $student_id;
            if ($request_id === null || $request_id <= 0) {
                echo "Invalid request ID.";
                exit(); // Stop further execution
            }            

            // RETRIEVE A REQUEST CONTENT
            if (isset($request_id) && !empty($request_id)) {
                $request_query = "SELECT * FROM requests WHERE Re_Id = $request_id";
                $request_result = mysqli_query($conn, $request_query);

                if ($request_result && $row = mysqli_fetch_assoc($request_result)) {
                    echo "<p>" . $row['Requests_Content'] . "</p>";
                } else {
                    echo "Error: Unable to fetch request details.";
                }
            }
        ?>

        <h2>Add Feedback</h2>
        <form action="feedback.php?request_id=<?php echo $request_id; ?>&facilitator_id=<?php echo $facilitator_id; ?>&student_id=<?php echo $student_id; ?>" method="post">

            <input type="hidden" name=" Re_id" value="<?php echo $request_id; ?>">
            <input type="hidden" name="F_id" value="<?php echo $facilitator_id; ?>">
            <input type="hidden" name="Stu_id" value="<?php echo $student_id; ?>">
            <label for="feedback_content">Feedback Content:</label>
            <textarea id="feedback_content" name="Feedbacks" rows="5" required></textarea>
            <input type="submit" name="submit_feedback" value="Submit Feedback" class="btn">
        </form>
    </div>
</body>
</html>
