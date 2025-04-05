<?php
include('db.php');
session_start();

if (!isset($_SESSION['doctor_id'])) {
    header("Location: login.php");
}

$doctor_id = $_SESSION['doctor_id'];

$sql = "SELECT * FROM appointments WHERE doctor_id='$doctor_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, Dr. <?php echo $_SESSION['doctor_name']; ?></h2>
        <h3>Appointments</h3>
        <table>
            <tr>
                <th>Patient Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Appointment Date</th>
            </tr>
            <?php while($appointment = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $appointment['patient_name']; ?></td>
                    <td><?php echo $appointment['patient_email']; ?></td>
                    <td><?php echo $appointment['patient_phone']; ?></td>
                    <td><?php echo $appointment['appointment_date']; ?></td>
                </tr>
            <?php } ?>
        </table>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
