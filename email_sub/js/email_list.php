<?php

include "./db.php";

//SHOW LIST OF EMAIL'S HOST
$stnm = $pdo->query("SELECT host FROM emails");
$damp = $stnm->fetchAll(PDO::FETCH_ASSOC);
$host = array_column($damp, "host");
$res = array_unique($host, SORT_LOCALE_STRING);
asort($res);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of eMails</title>
    <link rel="stylesheet" href="../styles/table.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>

<body>

    <form action="" method="post">
        <!-- SORTING LIST BY HOST NAME -->
        <select name="Option" id="host" onchange="this.form.submit()" class="inverted">
            <option value="all">all</option>
            <?php
            foreach ($res as $item) { ?>
                <option value=" <?php echo $item; ?>"><?php echo $item; ?></option>
            <?php } ?>
        </select>

        <!-- SEARCH EMAIL -->
        <input id="search" type="text" name="filter" onchange="this.form.submit()" class="inverted">
        <button type="submit" value="" class="inverted">Refresh</button>

    </form>

    <button onclick="document.location.href='../index.html'">Back</button>

    <form action="./delete.php" method="POST">
        <table>
            <caption>Email list</caption>
            <tr>
                <th>id</th>
                <th>email</th>
                <th>created date</th>
                <th>options</th>
            </tr>

            <?php
            //MAP DATA
            if (isset($_POST['Option']) && $_POST['Option'] !== 'all') {
                $option = trim($_POST['Option']);
                $statement = $pdo->query("SELECT * FROM emails WHERE host='$option'");
                // FIND EMAIL
            } elseif (isset($_POST['filter']) && $_POST['filter'] !== "") {
                $filter = trim($_POST['filter']);
                $statement = $pdo->query("SELECT * FROM emails WHERE email='$filter'");
            } else {
                $statement = $pdo->query("SELECT * FROM emails ORDER BY created_date DESC");
            }

            while ($email = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?php echo $email['email_id']; ?></td>
                    <td><?php echo $email['email']; ?></td>
                    <td><?php echo $email['created_date']; ?></td>
                    <td>
                        <!-- DELETE EMAIL -->
                        <button type="submit" class="inverted" name="email_delete" value="<?= $email['email_id'] ?>">Delete</button>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </form>

    <script src="./dark-mode.js"></script>
    <script src="./dynamicSearchResults.js"></script>
</body>

</html>