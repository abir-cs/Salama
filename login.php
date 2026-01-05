<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>login</title>
</head>

<body class="background">
    <?php
    require_once __DIR__ . "/connection.php";
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $username = $_POST['username'];
        $checkStmt = $mysqlClient->prepare(
            "SELECT id,password FROM authentication WHERE username = :username"
        );
        $checkStmt->execute([':username' => $username]);
        $user = $checkStmt->fetch();
        if (!$user) {
            $error = "Username doesn't exists.";
        } else {
            $password = $_POST["password"];
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $username;

                header("Location: src/dashboard.php?name=" . $username);
                exit;
            } else {
                $error = "Invalid password";
            }
        }

        if (!$error) {

            header("Location: dashboard.php");
            exit;
        }
    }
    ?>
    <div class="coat">
        <h1>LOG IN</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
        <form method="post" class="logincard">
            <h3>Enter credential :</h3>
            <label for="username">username</label>
            <input type="text" id="username" name="username" required>
            <label for="password">password</label>
            <input type="password" id="password" name="password" required>
            <button class="add">login</button>
            <a href="signup.php">dont have an account ? signup</a>
        </form>
    </div>
</body>

</html>