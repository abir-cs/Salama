<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connecting..</title>
</head>

<body>
    <?php
    try {
        $mysqlClient = new PDO(
            'mysql:host=localhost;dbname=medical_clinic;charset=utf8',
            'root',
            ''
        );


    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    ?>
</body>

</html>