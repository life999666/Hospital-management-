<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing password
    $department = $_POST['department']; // Get department value from dropdown

    // SQL query to insert data into the users table, including the department
    $sql = "INSERT INTO users (name, email, password, role, department) 
            VALUES ('$name', '$email', '$password', 'doctor', '$department')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New doctor registered successfully";
        header("Location: login.php"); // Redirect to login after successful registration
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Doctor Registration</h2>
        <form method="POST">
            Name: <input type="text" name="name" required><br>
            Email: <input type="email" name="email" required><br>
            Password: <input type="password" name="password" required><br>
            
            <!-- Department dropdown -->
            Department: 
            <select name="department" required>
                <option value="Cardiology">Cardiology</option>
                <option value="Neurology">Neurology</option>
                <option value="Orthopedics">Orthopedics</option>
                <option value="Pediatrics">Pediatrics</option>
                <option value="General Medicine">General Medicine</option>
                <option value="Dermatology">Dermatology</option>
            </select><br>
            
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
