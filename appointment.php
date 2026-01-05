<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="form.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Salama/appointment</title>
</head>

<body>
    <?php
    $success = false;
    $errors = [];
    $uploadDir = __DIR__ . "/uploads/";
    require_once __DIR__ . "/connection.php";
    function clean($value)
    {
        return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
    }
    try {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $stmt1 = $mysqlClient->prepare("SELECT * FROM appointments WHERE id = :id ");
            $stmt1->execute([':id' => $id]);
            $appointment = $stmt1->fetch();
        }
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $id = $_POST['id'] ?? null;
            $fname = clean($_POST['first_name']);
            $lname = clean($_POST['last_name']);
            $bday = $_POST['birthdate'];
            $gender = $_POST['gender'];
            $rs = clean($_POST['requested_service']);
            $date = $_POST['preferred_date'];
            $time = $_POST['preferred_time'];
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $phone = preg_replace('/\D/', '', $_POST['phone']);
            $address = clean($_POST['address']);
            $ah = clean($_POST['allergies_history'] ?? '');
            $sd = clean($_POST['selected_doctor']);
            $mf = $_FILES['medical_file'] ?? null;
            $medicalFileName = null;


            if (!$email) {
                $errors[] = "Invalid email format.";
            }

            if (!preg_match('/^0\d{9}$/', $phone)) {
                $errors[] = "Phone number must be exactly 10 digits and start with 0.";
            }

            if (!in_array($gender, ['m', 'f'])) {
                $errors[] = "Invalid gender selection.";
            }

            if ($date && strtotime($date) < strtotime(date('Y-m-d'))) {
                $errors[] = "Preferred date cannot be in the past.";
            }
            if ($mf && $mf['error'] === UPLOAD_ERR_OK) {

                $ext = strtolower(pathinfo($mf['name'], PATHINFO_EXTENSION));
                $allowed = ['pdf', 'jpg', 'png'];

                if (!in_array($ext, $allowed)) {
                    $errors[] = "Invalid file format. Only PDF, JPG, PNG allowed.";
                } else {
                    $medicalFileName = uniqid('mf_', true) . '.' . $ext;
                    move_uploaded_file($mf['tmp_name'], $uploadDir . $medicalFileName);
                }
            }
            if (empty($errors)) {
                if (empty($id)) {
                    $sqlQuery = "INSERT INTO appointments
                                    (first_name , last_name , birthdate , gender , requested_service , preferred_date , preferred_time , email , phone , address , allergies_history , selected_doctor,medical_file )
                                    VALUES (:first_name ,:last_name ,:birthdate ,:gender ,:requested_service ,:preferred_date ,:preferred_time ,:email ,:phone ,:address ,:allergies_history ,:selected_doctor ,:medical_file)";

                    $stmt = $mysqlClient->prepare($sqlQuery);
                    $stmt->execute([
                        ':first_name' => $fname,
                        ':last_name' => $lname,
                        ':birthdate' => $bday,
                        ':gender' => $gender,
                        ':requested_service' => $rs,
                        ':preferred_date' => $date,
                        ':preferred_time' => $time,
                        ':email' => $email,
                        ':phone' => $phone,
                        ':address' => $address,
                        ':allergies_history' => $ah,
                        ':selected_doctor' => $sd,
                        ':medical_file' => $medicalFileName,
                    ]);
                    header("Location: appointment.php?success=1");
                } else {

                    $stmt = $mysqlClient->prepare("UPDATE appointments SET first_name = :first_name, last_name = :last_name, birthdate = :birthdate, gender = :gender,
                        requested_service = :requested_service, preferred_date = :preferred_date, preferred_time = :preferred_time , email = :email, phone = :phone, address = :address, allergies_history = :allergies_history,
                        selected_doctor = :selected_doctor,medical_file = :medical_file Where id = :id");

                    $stmt->execute([
                        ':first_name' => $fname,
                        ':last_name' => $lname,
                        ':birthdate' => $bday,
                        ':gender' => $gender,
                        ':requested_service' => $rs,
                        ':preferred_date' => $date,
                        ':preferred_time' => $time,
                        ':email' => $email,
                        ':phone' => $phone,
                        ':address' => $address,
                        ':allergies_history' => $ah,
                        ':selected_doctor' => $sd,
                        ':medical_file' => $medicalFileName,
                        ':id' => $id,
                    ]);
                    header("Location: appointment.php?&updated=1");
                }


                exit;
            }
        }
    } catch (Exception $e) {
        $errors[] = "Something went wrong with request. Please try again.";
    }
    ?>
    <!-- <nav>
        <img src="assets/images/Group 2.png" alt="logo" width="250">
        <div class="links">
            <a href="index.php">HOME</a>
            <a href="about.html">ABOUT</a>
            <a href="services.html">SERVICES</a>
            <a href="appointment.php" style="text-decoration: underline;">APPOINTMENT</a>
            <a href="contact.html">CONTACT</a>
        </div>
    </nav> -->
    <img src="assets/doodles/doodle1.svg" alt="flower" class="doodle1">
    <img src="assets/doodles/doodle2.svg" alt="flower" class="doodle2">
    <img src="assets/doodles/doodle3.svg" alt="flower" class="doodle3">

    <h2>book an appointment !</h2>
    <?php if (isset($_GET['success'])): ?>
        <div class="success">
            Your appointment request has been submitted successfully.
        </div>
    <?php endif; ?>
    <?php if (isset($_GET['updated'])): ?>
        <div class="success">
            Your appointment request has been updated successfully. <a style="color: #2f5f85;"
                href="src/manage_appointments.php">table</a>
        </div>
    <?php endif; ?>
    <?php if (!empty($errors)): ?>
        <div class="error">
            <h3>Error : appointment has not been submitted !</h3>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data" id="appointment">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?? '' ?>">
        <label for="Fname">First name</label>
        <input type="text" id="Fname" name="first_name" value="<?= $appointment['first_name'] ?? '' ?>" required>
        <label for="Lname">Last name</label>
        <input type="text" id="Lname" name="last_name" value="<?= $appointment['last_name'] ?? '' ?>" required>
        <label for="birthday">Birthday</label>
        <input type="date" id="birthday" name="birthdate" value="<?= $appointment['birthdate'] ?? '' ?>" required>
        <label for="gender">Gender</label>

        <div>
            <input type="radio" id="m" name="gender" value="m" <?= ($appointment['gender'] ?? '') === 'm' ? 'checked' : '' ?>>
            <label for="m">male</label>
        </div>
        <div>
            <input type="radio" id="f" name="gender" value="f" <?= ($appointment['gender'] ?? '') === 'f' ? 'checked' : '' ?>>
            <label for="f">female</label>
        </div>

        <label for="service"></label>
        <select name="requested_service" id="service">
            <option value="general" <?= ($appointment['requested_service'] ?? '') === "general" ? 'selected' : '' ?>>
                general consultation</option>
            <option value="pediatric" <?= ($appointment['requested_service'] ?? '') === "pediatric" ? 'selected' : '' ?>>
                pediatric consultation</option>
            <option value="dental" <?= ($appointment['requested_service'] ?? '') === "dental" ? 'selected' : '' ?>>dental
                checkup</option>
            <option value="physiotherapy" <?= ($appointment['requested_service'] ?? '') === "physiotherapy" ? 'selected' : '' ?>>physiotherapy session</option>
            <option value="vaccination" <?= ($appointment['requested_service'] ?? '') === "vaccination" ? 'selected' : '' ?>>vaccination</option>
            <option value="labtest" <?= ($appointment['requested_service'] ?? '') === "labtest" ? 'selected' : '' ?>>lab
                test</option>
            <option value="followup" <?= ($appointment['requested_service'] ?? '') === "followup" ? 'selected' : '' ?>>
                follow-up appointment</option>
            <option value="special" <?= ($appointment['requested_service'] ?? '') === "special" ? 'selected' : '' ?>>
                special consultation</option>
        </select>
        <label for="date">Preferred date</label>
        <input type="date" id="date" name="preferred_date" value="<?= $appointment['preferred_date'] ?? '' ?>" required>
        <label for="appt"> Preferred time</label>
        <input type="time" id="appt" name="preferred_time" min="08:00" max="19:00" step="900"
            value="<?= $appointment['preferred_time'] ?? '' ?>" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= $appointment['email'] ?? '' ?>" required>
        <label for="phone">Phone number</label>
        <input type="number" id="phone" name="phone" value="<?= $appointment['phone'] ?? '' ?>" required>
        <label for="add">Address</label>
        <input type="text" id="add" name="address" value="<?= $appointment['address'] ?? '' ?>" required>
        <label for="MH">Medical history</label>
        <textarea name="allergies_history" id="MH"
            placeholder="write here any allergies, chronic diseases or past experiences worth mentioning "><?= $appointment['allergies_history'] ?? '' ?></textarea>
        <label for="doctor">Select a specific doctor</label>
        <select id="doctor" name="selected_doctor">
            <option value="any" <?= ($appointment['selected_doctor'] ?? '') === "any" ? 'selected' : '' ?>>Any would do
            </option>
            <option value="house" <?= ($appointment['selected_doctor'] ?? '') === "house" ? 'selected' : '' ?>>dr.house
            </option>
            <option value="belfoul" <?= ($appointment['selected_doctor'] ?? '') === "belfoul" ? 'selected' : '' ?>>
                dr.belfoul meryem</option>
            <option value="meli" <?= ($appointment['selected_doctor'] ?? '') === "meli" ? 'selected' : '' ?>>dr.meli
            </option>
            <option value="melohi" <?= ($appointment['selected_doctor'] ?? '') === "melohi" ? 'selected' : '' ?>>dr.melohi
                salime</option>
            <option value="abod" <?= ($appointment['selected_doctor'] ?? '') === "abod" ? 'selected' : '' ?>>dr.abod ahmed
            </option>
            <option value="kadri" <?= ($appointment['selected_doctor'] ?? '') === "kadri" ? 'selected' : '' ?>>dr.kadri
            </option>
        </select>
        <label for="mf">upload a medical file if needed</label>
        <input type="file" name="medical_file" accept=".pdf,.jpg,.png">
        <div class="buttons">
            <button><?= isset($_GET['id']) ? 'update' : 'submit' ?></button>
            <button type="button" class="clear">clear</button>
        </div>
    </form>

    <div class="footer">
        <table>
            <tr>
                <td>clinic address</td>
                <td colspan="2">El Blasa El Flaniya</td>
            </tr>
            <tr>
                <td>emergency hotline</td>
                <td colspan="2">0565889852</td>
            </tr>
            <tr>
                <td>email</td>
                <td colspan="2">salama.clinic@gmail.com</td>
            </tr>
            <tr>
                <td></td>
                <td>abir</td>
                <td>racha</td>
            </tr>
            <tr>
                <td>instagram</td>
                <td><a href="https://www.instagram.com/6lackrosess/#">6lackrosess</a></td>
                <td><a href="https://www.instagram.com/duckyduckdog/#">duckyduckdog</a></td>
            </tr>
            <tr>
                <td>Linked in</td>
                <td><a href="https://www.linkedin.com/in/abir-belhadef-541589387">abir belhadef</a></td>
                <td><a href="https://www.linkedin.com/in/racha-amouri-b5081638b">racha amouri</a></td>
            </tr>
            <tr>
                <td>Gmail</td>
                <td>abir.belhadef@univ-constantine2.dz</td>
                <td>racha.amouri@univ-constantine2.dz</td>
            </tr>

        </table>
    </div>
    <!-- <script src="script.js"></script> -->
</body>

</html>