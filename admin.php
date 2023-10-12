
<?php
include('./backend/handling.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
        <h1>Welcome, [Admin Name]</h1>
        <nav>
            <ul>
                <li><a href="view.php">view Feedbacks</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="add-facilitator-section">
        <h2>Add a New Facilitator:</h2>
        <form action="admin.php" method="post">
            <label for="facilitator_name">Facilitator Name:</label>
            <input type="text" id="facilitator_name" name="F_Names" required>

            <label for="facilitator_email">Facilitator Email:</label>
            <input type="email" id="facilitator_email" name="Email" required>

            <label for="facilitator_password">Facilitator Password:</label>
            <input type="password" id="facilitator_password" name="Passwords" required onkeyup="checkPasswordStrength()">
    
            <input type="submit" name="submit" value="Add Facilitator" class="btn">
        </form>
    </div>
    <script src="passwords.js">
  </script>

</body>
</html>
