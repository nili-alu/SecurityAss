<?php
include('./backend/handling.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Registration</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="registration-container">
    <h1>Student Registration</h1>
    <form action="register.php" method="post">
      <label for="fullname">Full Name:</label>
      <input type="text" id="Names" name="Names" required>

      <label for="Email">Email:</label>
      <input type="text" id="Email" name="Email" required >

      <label for="password">Password:</label>
      <input type="password" id="password" name="Passwords" required onkeyup="checkPasswordStrength()">
      <div class="password-strength">
        Password Strength: <span id="password-strength-bar"></span>
      </div>

      <input type="submit" name="submit" value="Register" class="btn" id="registration-button"><br>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
  </div>
  <script src="passwords.js">
  </script> 
</body>
</html>
