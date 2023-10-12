<?php
    // Include your PHP script here
    include('./backend/handling.php');

// Retrieve data from the requests table with student names
// Retrieve data from the requests table with facilitator names
$sql = "SELECT requests.Re_Id, requests.F_Id,requests.Stu_Id,users.Names AS Student_Name, facilitators.F_Names AS Facilitator_Name, requests.Requests_Content, requests.Time 
        FROM requests
        INNER JOIN users ON requests.Stu_Id = users.Stu_Id
        INNER JOIN facilitators ON requests.F_Id = facilitators.F_Id";
$result = mysqli_query($conn, $sql);

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
        <h1>Welcome, [Facilitator Name]</h1>
        <nav>
            <ul>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="dashboard-section" id="view-requests">
        <h2>Students Submitted Requests</h2>
        <table>
            <thead>
                <tr>
                    <!-- <th>Request ID</th> -->
                    <th>Student Name</th>
                    <th>Request Content</th>
                    <th>Time</th>
                    <th>Feedback</th>

                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        //echo "<td>" . $row['Re_Id'] . "</td>";
                        echo "<td>" . $row['Student_Name'] . "</td>";
                        echo "<td>" . $row['Requests_Content'] . "</td>";
                        echo "<td>" . $row['Time'] . "</td>";
                        echo "<td><a href='feedback.php?request_id=" . $row['Re_Id'] . "&facilitator_id=" . $row['F_Id'] . "&student_id=" . $row['Stu_Id'] . "'>Add Feedback</a></td>";

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
