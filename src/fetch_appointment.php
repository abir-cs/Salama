<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require_once __DIR__ . "/../connection.php";

    $search = $_GET['search'] ?? '';
    $sort = $_GET['sort'] ?? '';

    $sql = "SELECT * FROM appointments WHERE 1=1";
    $params = [];

    /* SEARCH */
    if ($search !== '') {
        $sql .= " AND (
        first_name LIKE :search OR
        last_name LIKE :search OR
        requested_service LIKE :search
    )";
        $params['search'] = "%$search%";
    }

    /* SORT */
    switch ($sort) {
        case 'date_asc':
            $sql .= " ORDER BY preferred_date ASC";
            break;
        case 'date_desc':
            $sql .= " ORDER BY preferred_date DESC";
            break;
        case 'lname_asc':
            $sql .= " ORDER BY last_name ASC";
            break;
        case 'lname_desc':
            $sql .= " ORDER BY last_name DESC";
            break;
    }

    $stmt = $mysqlClient->prepare($sql);
    $stmt->execute($params);
    $appointments = $stmt->fetchAll();

    foreach ($appointments as $appointment) {
        echo "<tr>
        <td>{$appointment['first_name']}</td>
        <td>{$appointment['last_name']}</td>
        <td>{$appointment['requested_service']}</td>
        <td class='date'>{$appointment['preferred_date']}</td>
        <td class='buttons'>
            <a href='details.php?id={$appointment['id']}' class='btn btn-sm'>
                <i class='fa-solid fa-eye'></i>
            </a>
            <a href='../appointment.php?id={$appointment['id']}' class='btn btn-sm'>
                <i class='fa-solid fa-pen'></i>
            </a>
               
            <a href='download.php?file=" . $appointment['medical_file'] . "' class='btn btn-sm' title='Download medical file'>
                <i class='fa-solid fa-download'></i>
            </a>

            <form method='POST' style='display:inline;'>
                <input type='hidden' name='id' value='{$appointment['id']}'>
                <button class='btn btn-sm'>
                    <i class='fa-solid fa-trash'></i>
                </button>
            </form>
        </td>
    </tr>";
    }
    ?>

</body>

</html>