<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['Stu_Id'])) {
    header("Location: login.php");
    exit();
}

include('./backend/handling.php');

// Access the user ID from the session
$user_id = $_SESSION['Stu_Id'];

// Retrieve the student's name based on the ID
$get_student_name_query = "SELECT Names FROM users WHERE Stu_Id = $user_id";
$result = mysqli_query($conn, $get_student_name_query);

if ($result && $row = mysqli_fetch_assoc($result)) {
    $student_name = $row['Names'];
} else {
    $student_name = "Student";
}


  $sql = "SELECT * FROM facilitators";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Home</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>Welcome, <?php echo $student_name; ?></h1>
    <nav>
      <ul>
        <li><a href="studentsfeedbacks.php">View Feedback</a></li>
      </ul>
    </nav>
  </header>

  <div class="dashboard-section" id="send-request">
    <h2>Send Request</h2>
    <form action="home.php" method="post">
      <input type="hidden" name="Stu_Id" value="<?php echo $_SESSION['Stu_Id']; ?>">
      <label for="recipient">Select Facilitator:</label>
      <select id="facilitator" name="F_Id" required>
        <option value="1">Choose Facilitator</option>
        <!-- php codes -->
        <?php
          while ($rows = mysqli_fetch_assoc($result)) {
        ?>
            <option value=<?php echo $rows['F_Id']; ?>><?php echo $rows['F_Names']; ?></option>
        <?php
          }
        ?>
      </select>

      <label for="request_content">Request Content:</label>
      <textarea id="request_content" name="Requests_Content" rows="5" required></textarea>
      <input type="submit" name="request" value="Send Request" class="btn">
    </form>
  </div>

</body>
</html>

<?php
  }// close the if condition for mysqli_num_rows($result) check
?>
