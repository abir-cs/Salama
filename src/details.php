<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
</head>

<body>
    <div class="details">
        <h1>Appointment Details</h1>
        <div class="detailscard">
            <?php
            require_once __DIR__ . "/../connection.php";
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $stmt = $mysqlClient->prepare("SELECT * FROM appointments WHERE id = :id ");
                $stmt->execute([':id' => $id]);
                $appointment = $stmt->fetch();

                echo "
                <p>First name: " . $appointment['first_name'] . "</p>
                <p>Last name: " . $appointment['last_name'] . "</p>
                <p>Birth date: " . $appointment['birthdate'] . "</p>
                <p>Gender: " . $appointment['gender'] . "</p>
                <p>Requested service: " . $appointment['requested_service'] . "</p>
                <p>Preferred date: " . $appointment['preferred_date'] . "</p>
                <p>Preferred time: " . $appointment['preferred_time'] . "</p>
                <p>Email: " . $appointment['email'] . "</p>
                <p>Phone: " . $appointment['phone'] . "</p>
                <p>Address: " . $appointment['address'] . "</p>
                <p>Allergies history: " . $appointment['allergies_history'] . "</p>
                <p>Selected doctor: " . $appointment['selected_doctor'] . "</p>
                <p>Medical file: " . $appointment['medical_file'] . "</p>
                <p>Created at: " . $appointment['created_at'] . "</p>
                ";
            } else {
                echo "Found a proplem with id";
            }
            ?>
        </div>
    </div>

</body>

</html>