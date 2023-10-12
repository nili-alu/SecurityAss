<?php
    // Include your PHP script here
    include('./backend/handling.php');

// Retrieve data from the requests table with student names
// Retrieve data from the requests table with facilitator names
$sql = "SELECT users.Names AS Student_Name, facilitators.F_Names AS Facilitator_Name, requests.Requests_Content, feedback.Feedbacks AS Given_Feedback, requests.Time 
        FROM feedback
        INNER JOIN users ON feedback.Stu_Id = users.Stu_Id
        INNER JOIN facilitators ON feedback.F_Id = facilitators.F_Id
        INNER JOIN requests ON feedback.Re_Id = requests.Re_Id";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facilitator Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Welcome, [Admin Name]</h1>
        <nav>
            <ul>
                <li><a href="admin.php">Add Facilitator</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="dashboard-section" id="view-requests">
        <h2>Given FeedBacks</h2>
        <table>
            <thead>
                <tr>
                    <!-- <th>Request ID</th> -->
                    <th>Student Name</th>
                    <th>Facilitator Names</th>
                    <th>Request Content</th>
                    <th>Given Feedback</th>
                    <th>Time</th>

                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        //echo "<td>" . $row['Re_Id'] . "</td>";
                        echo "<td>" . $row['Student_Name'] . "</td>";
                        echo "<td>" . $row['Facilitator_Name'] . "</td>";
                        echo "<td>" . $row['Requests_Content'] . "</td>";
                        echo "<td>" . $row['Given_Feedback'] . "</td>";
                        echo "<td>" . $row['Time'] . "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
    // Close the connection
    mysqli_close($conn);
?>
