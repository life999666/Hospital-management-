
-- Users table for doctor registration/login
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('doctor') NOT NULL
);

-- Appointments table for patient bookings
CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_name VARCHAR(100) NOT NULL,
    patient_email VARCHAR(100) NOT NULL,
    patient_phone VARCHAR(15) NOT NULL,
    appointment_date DATETIME NOT NULL,
    doctor_id INT NOT NULL,
    FOREIGN KEY (doctor_id) REFERENCES users(id)
);

