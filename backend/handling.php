<?php
include('db.php');
//include('./register.php');


if(isset($_POST["submit"])){
    $names = $_POST['Names'];
    $emails = $_POST['Email'];
    $passwords = $_POST['Passwords'];
    $roles = $_POST['Roles']; 

    // Hash the password for security
    $hashed_password = password_hash($passwords, PASSWORD_DEFAULT);
    $roles ="Student";
    $sql = "INSERT INTO users (Names, Email, Passwords, Roles) VALUES ('$names', '$emails', '$hashed_password', '$roles')";
    $insert= mysqli_query($conn, $sql);

    if ($insert) {
        header('location: login.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


// <!-- LOGIN CHECKING  -->

// if(isset($_POST["login"])) {
//     $names = $_POST['Names'];
//     $password = $_POST['Passwords'];

//     $sql = "SELECT * FROM users WHERE Names='$names' AND Passwords='$password'";
//     $result = mysqli_query($conn, $sql);

//     if(mysqli_num_rows($result) == 1) {
//         // Fetch user data
//         $user = mysqli_fetch_assoc($result);
        
//         // Start a session and store user details
//         session_start();
//         $_SESSION['Stu_Id'] = $user['Stu_Id'];
//         $_SESSION['Names'] = $user['Names'];

//         // Redirect to home.php
//         header('location: home.php');
//         exit(); // Ensure script stops here after redirection
//     } else {
//         // Login failed
//         echo "Invalid names or password. Please try again.";
//     }
// }

// .........................................................

if(isset($_POST["login"])) {
    $names = $_POST['Names'];
    $password = $_POST['Passwords'];

    // Query for students
    $studentSql = "SELECT * FROM users WHERE Names='$names' AND Passwords='$password'";
    $studentResult = mysqli_query($conn, $studentSql);
    
    if ($studentResult === false) {
        // Handle query error
        echo "Query error: " . mysqli_error($conn);
        exit();
    }

    if(mysqli_num_rows($studentResult) == 1) {
        $user = mysqli_fetch_assoc($studentResult);
        
        // Start a session and store user details
        session_start();
        $_SESSION['Stu_Id'] = $user['Stu_Id'];
        $_SESSION['Names'] = $user['Names'];
        header("Location: home.php");
        exit();  
    }

    // Query for facilitators
    $facilitatorQuery = "SELECT * FROM facilitators WHERE F_Names='$names' AND Passwords='$password'";
    $facilitatorResult = mysqli_query($conn, $facilitatorQuery);
    
    if ($facilitatorResult === false) {
        // Handle query error
        echo "Query error: " . mysqli_error($conn);
        exit();
    }
    
    if (mysqli_num_rows($facilitatorResult) == 1) {
        // Redirect to facilitator dashboard
        header("Location: facilitators.php");
        exit();
    }

    // Query for admins
    $adminQuery = "SELECT * FROM admins WHERE Names='$names' AND Passwords='$password'";
    $adminResult = mysqli_query($conn, $adminQuery);
    
    if ($adminResult === false) {
        // Handle query error
        echo "Query error: " . mysqli_error($conn);
        exit();
    }
    
    if (mysqli_num_rows($adminResult) == 1) {
        // Redirect to admin dashboard
        header("Location: admin.php");
        exit();
    }



else {
        // Login failed
echo "Invalid names or password. Please try again.";
    }
}









// .....................................................................
// INSERT REQUEST INTO TABLE 

if(isset($_POST["request"])) {
    $student_id = $_POST['Stu_Id'];
    $facilitator_id = $_POST['F_Id'];
    $request_content = $_POST['Requests_Content'];

    $sql = "INSERT INTO requests (Stu_Id, F_Id, Requests_Content) VALUES ('$student_id', '$facilitator_id', '$request_content')";

    if (mysqli_query($conn, $sql)) {
        //echo "Request submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


// ADMIN ADD FACILITATORS IN THE DATABSE TABLE OF FACILITATORS

if(isset($_POST["submit"])){
    $names = $_POST['F_Names'];
    $email = $_POST['Email'];
    $password = $_POST['Passwords'];
    $role = 'Facilitator';  // Set role to Facilitator

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert a new facilitator into the "facilitators" table
    $sql = "INSERT INTO facilitators (F_Names, Email, Passwords, Roles) VALUES ('$names', '$email', '$hashed_password', '$role')";

    if (mysqli_query($conn, $sql)) {
        header('location: admin.php');  // Redirect to admin dashboard after successful insertion
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>



