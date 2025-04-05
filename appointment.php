<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if doctor_name is set in the POST array
    if (isset($_POST['doctor_name']) && isset($_POST['department'])) {
        $patient_name = $_POST['patient_name'];
        $patient_email = $_POST['patient_email'];
        $patient_phone = $_POST['patient_phone'];
        $appointment_date = $_POST['appointment_date'];
        $doctor_name = $_POST['doctor_name']; // Doctor name selected from dropdown
        $department = $_POST['department']; // Department selected from dropdown

        // Find the doctor ID based on the selected name and department
        $sql = "SELECT id FROM users WHERE name='$doctor_name' AND department='$department' AND role='doctor'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $doctor = $result->fetch_assoc();
            $doctor_id = $doctor['id'];

            // Insert the appointment into the database
            $sql = "INSERT INTO appointments (patient_name, patient_email, patient_phone, appointment_date, doctor_id) 
                    VALUES ('$patient_name', '$patient_email', '$patient_phone', '$appointment_date', '$doctor_id')";
            
            if ($conn->query($sql) === TRUE) {
                echo "Appointment booked successfully!";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Doctor not found in the selected department.";
        }
    } else {
        echo "Please select a doctor and department.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Book an Appointment</h2>
        <form method="POST">
            Patient Name: <input type="text" name="patient_name" required><br>
            Patient Email: <input type="email" name="patient_email" required><br>
            Patient Phone: <input type="text" name="patient_phone" required><br>
            Appointment Date: <input type="datetime-local" name="appointment_date" required><br>

            <!-- Department Dropdown -->
            Department: 
            <select name="department" required>
                <option value="Cardiology">Cardiology</option>
                <option value="Neurology">Neurology</option>
                <option value="Orthopedics">Orthopedics</option>
                <option value="Pediatrics">Pediatrics</option>
                <option value="General Medicine">General Medicine</option>
                <option value="Dermatology">Dermatology</option>
            </select><br>

            <!-- Doctor Name Dropdown -->
            Doctor Name: 
            <select name="doctor_name" required>
                <?php
                    // Fetch doctors and their departments from the database
                    $sql = "SELECT name, department FROM users WHERE role='doctor'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // Output each doctor as an option
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='".$row['name']."'>".$row['name']." - ".$row['department']."</option>";
                        }
                    } else {
                        echo "<option value=''>No doctors available</option>";
                    }
                ?>
            </select><br>

            <button type="submit">Book Appointment</button>
        </form>
    </div>
</body>
</html>
