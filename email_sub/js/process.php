<?php
echo "Processing...";

$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "email_sub";
$conn = new mysqli($servername, $username, $pass, $dbname);

if ($conn->connect_error) {
    die("Can`t connect to the data base" . $conn->connect_error);
}

$email = mysqli_real_escape_string($conn, implode("", $_POST));

class Email
{
    var $email_id;
    var $email;
    var $host;

    function __construct($email_id, $email, $host)
    {
        $this->email_id = $email_id;
        $this->email = $email;
        $this->host = $host;
    }
}

//creating unique id
$newId = bin2hex(random_bytes(5));
//slice email into parts
list($name, $domain) = explode("@", $email);
list($host, $rest) = explode(".", $domain);

//create new email user
$newEmail = new Email("$newId", "$email", "$host");

$sql = "INSERT INTO emails(email_id, email, host) VALUES ('$newEmail->email_id', '$newEmail->email', '$newEmail->host')";

if (mysqli_query($conn, $sql)) {
    echo "Succesfull submision";
} else {
    echo "ERROR: " . mysqli_error($conn);
}

$conn->close();
