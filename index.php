<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <title>Salama/home</title>
</head>

<body>
    <?php
    require_once __DIR__ . "/connection.php";

    $stmt = $mysqlClient->query(
        "SELECT fname, lname, experience FROM reviews ORDER BY id DESC"
    );
    $reviews = $stmt->fetchAll();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $experience = $_POST['experience'];

        $sqlQuery = "INSERT INTO reviews
                            (fname, lname, experience)
                            VALUES (:fname, :lname, :exp)";

        $stmt = $mysqlClient->prepare($sqlQuery);
        $stmt->execute([
            ':fname' => $fname,
            ':lname' => $lname,
            ':exp' => $experience,

        ]);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
    ?>
    <nav id="nav1">
        <img src="assets/images/Group 2.png" alt="logo" width="225">
        <div class="links">
            <a style="text-decoration: underline;" href="index.php">HOME</a>
            <a href="about.html">ABOUT</a>
            <a href="services.html">SERVICES</a>
            <a href="appointment.php">APPOINTMENT</a>
            <a href="contact.html">CONTACT</a>
            <a href="login.php">LOGIN</a>
        </div>
    </nav>
    <div class="home">
        <div class="welcome">
            <p>welcome to<br><span style="font-size:larger ;">Salama Clinic</span></p>
            <img src="assets/images/Group 1.png" alt="logo" width="250">
        </div>
        <div class="mission">
            <h2>OUR MISSION</h2>
            <p>Our mission is to provide safe, compassionate,
                and high-quality healthcare that supports the physical and emotional well-being of every patient</p>
        </div>
    </div>

    <div class="services">
        <h2>OUR SERVICES</h2>
        <div class="slider">
            <div class="service">
                <img src="assets/images/services/pexels-tima-miroshnichenko-5407221.jpg">
                <h3>General Medicine</h3>
            </div>
            <div class="service">
                <img src="assets/images/services/pexels-thirdman-7659564.jpg">
                <h3>Cardiology</h3>
            </div>
            <div class="service">
                <img src="assets/images/services/pexels-gustavo-fring-7447001.jpg">
                <h3>Pediatrics</h3>
            </div>
            <div class="service">
                <img src="assets/images/services/pexels-eumorfia-panera-504255197-16120490.jpg">
                <h3>Dermatology</h3>
            </div>
            <div class="service">
                <img src="assets/images/services/pexels-mart-production-7089047.jpg">
                <h3>Gynecology & Obstetrics</h3>
            </div>
            <div class="service">
                <img src="assets/images/services/pexels-rdne-6129691.jpg">
                <h3>Emergency Care</h3>
            </div>
            <div class="service">
                <img src="assets/images/services/pexels-tima-miroshnichenko-8376285.jpg">
                <h3>Medical Imaging</h3>
            </div>
            <div class="service">
                <img src="assets/images/services/pexels-chokniti-khongchum-1197604-2280571.jpg">
                <h3>Laboratory Tests</h3>
            </div>
        </div>
    </div>
    <div class="doc-experience">
        <h2>EXPERIENCE</h2>
        <p>although the clinic is newly constructed, our doctors has 9+ years of experience in their domain of experty
        </p>
    </div>
    <div class="experience">
        <h2>CLIENT REVIEWS </h2>
        <div class="slider reviews">
            <?php foreach ($reviews as $review): ?>
                <div class="review">
                    <h3>
                        <?= htmlspecialchars($review['lname']) ?>
                        <?= htmlspecialchars($review['fname']) ?>
                    </h3>
                    <p><?= nl2br(htmlspecialchars($review['experience'])) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="add">Add Yours</button>
    </div>

    <form method="post" id="reviewForm" class="form1 hide">
        <label for="fname">first name</label>
        <input type="text" id="fname" name="fname" required />
        <label for="lname">last name</label>
        <input type="text" id="lname" name="lname" required>
        <label for="experience">your experience in the clinic :</label>
        <textarea id="experience" name="experience" required></textarea>
        <div class="buttons">
            <button type="submit">add</button>
            <button type="button" class="close">close</button>
        </div>
    </form>
    <div class="appointment">
        <div>
            <h3>book an appointment now !</h3>
            <a href="appointment.php">book</a>
        </div>
    </div>

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

    <script>
        $(window).on("scroll", function() {
            let opacity = Math.min($(this).scrollTop() / 300, 1);
            $("#nav1").css("background-color", `rgba(61, 71, 72,${opacity})`);
        });
        $(".add").click(() => {
            $(".form1").removeClass("hide");
        });
        $(".close").click(() => {
            $("#reviewForm")[0].reset();
            $(".form1").addClass("hide");
        });
    </script>
</body>

</html>