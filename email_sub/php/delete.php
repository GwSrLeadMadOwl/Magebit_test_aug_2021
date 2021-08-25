<?php
require_once './db.php';

if (isset($_POST['email_delete'])) {
    $id = $_POST['email_delete'];

    $delete = "DELETE FROM emails WHERE emails.email_id = '$id'";
    $statement = $pdo->exec($delete);

    header("Location: email_list.php");
}
