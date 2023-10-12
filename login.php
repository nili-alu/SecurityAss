<?php
include('./backend/handling.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="login-container">
    <h1>Student Login</h1>
    <form action="login.php" method="post">
      <label for="username">Username:</label>
      <input type="text" id="username" name="Names" required>
      
      <label for="password">Password:</label>
      <input type="password" id="password" name="Passwords" required>
      <input type="submit" name="login" value="Login" class="btn"><br>
    </form>
    <p>Are you a student and you don't have an account? <a href="register.php">Register</a></p>
  </div>
</body>
</html>