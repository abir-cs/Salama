<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>signup</title>
</head>

<body class="background">
    <?php
    require_once __DIR__ . "/connection.php";
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $strongPasswordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';
        if (!preg_match($strongPasswordRegex, $password)) {
            $error = "Password must be at least 8 characters and include uppercase, lowercase, and a number.";
        }

        $checkStmt = $mysqlClient->prepare(
            "SELECT id FROM authentication WHERE username = :username"
        );
        $checkStmt->execute([':username' => $username]);
        if ($checkStmt->fetch()) {
            $error = "Username already exists.";
        }

        if (!$error) {

            $sqlQuery = "INSERT INTO authentication
                                    (username, password)
                                    VALUES (:username, :password)";

            $stmt = $mysqlClient->prepare($sqlQuery);
            $stmt->execute([
                ':username' => $username,
                ':password' => $hashedPassword,
            ]);
            header("Location: src/dashboard.php?name=" . $username);
            exit;
        }
    }
    ?>
    <div class="coat">
        <h1>sign up</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
        <form method="post" class="logincard">
            <h3>Enter credential :</h3>
            <label for="username">username</label>
            <input type="text" id="username" name="username" required>
            <label for="password">password</label>
            <input type="password" id="password" name="password" required>
            <button class="add">signup</button>
            <a href="login.php">already have an account ? signin</a>
        </form>
    </div>
</body>

</html>