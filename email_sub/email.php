<?php

include "./db.php";

if (isset($_POST['submit'])) {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        class Email
        {
            var $email_id;
            var $email_name;
            var $host;

            function __construct($email_id, $email_name, $host)
            {
                $this->email_id = $email_id;
                $this->email_name = $email_name;
                $this->host = $host;
            }
        }

        //slice email into parts
        $newId = uniqid();
        list($name, $domain) = explode("@", $email);
        list($host, $rest) = explode(".", $domain);

        //create new email user
        $newEmail = new Email($newId, $name, $host);

        $statement = $pdo->prepare("INSERT INTO emails(email_id, email, host) VALUES ($newEmail->email_id, $newEmail->email_name, $newEmail->host)");
        $res = $statement->execute();

        if (empty($email)) {
            header("Location: index.php?error=email_required");
        } else {
            $statement = $pdo->prepare("INSERT INTO 'emails'('email_id', 'email', 'host') VALUES($newEmail->email_id, $newEmail->email_name, $newEmail->domain)");
            $statement->execute();
            if ($res) {
                header("Location: index.php?mess=success");
            } else {
                header("Location: index.php?mess=fail");
            }
            $pdo = null;
            exit();
        }
    } else {
        header("Location: index.php?mess=error");
    }
}
