<?php

$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "email_sub";
$conn = new mysqli($servername, $username, $pass, $dbname);

if ($conn->connect_error) {
    die("Can`t connect to the data base" . $conn->connect_error);
}

$message = "";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    $patternVALID = "/^\\w+@[a-zA-Z_]+?\\.[a-zA-Z]{2,3}$/";
    $resultVALID = (bool) preg_match($patternVALID, $email, $matches);

    $patternCO = "/([\\.]co|[\\.]CO)$/";
    $resultCO = (bool) preg_match($patternCO, $email, $matches);

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

    // if (isset($_POST['email'])) {    
    if (empty($_POST['email']) && empty($_POST["check"])) {
        $message = "Email address is required";
    } elseif ($resultVALID && empty($_POST["check"])) {
        $message = "Please provide a valid e-mail address";
    } elseif ($resultCO && !empty($_POST["check"])) {
        $message = "We are not accepting subscriptions from Colombia emails";
    } elseif (!empty($_POST['email']) && empty($_POST["check"])) {
        $message = "You should accept the terms and conditions";
    } else {
        //creating unique id
        $newId = bin2hex(random_bytes(5));
        //slice email into parts
        list($name, $domain) = explode("@", $email);
        list($host, $rest) = explode(".", $domain);

        //create new email user
        $newEmail = new Email("$newId", "$email", "$host");

        $sql = "INSERT INTO emails(email_id, email, host) VALUES ('$newEmail->email_id', '$newEmail->email', '$newEmail->host')";

        if ($conn->query($sql) === TRUE) {
            $success = '
        document.getElementById("intro").classList.add("hide");
        document.getElementById("succeded").classList.remove("hide");
        document.getElementById("succeded").classList.add("show");';

            // header('refresh:4; index.php');
            header('refresh:4; email_list.php');
        } else {
            echo 'error' . $sql . $conn->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website made for MAGEBIT">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./src/Union.svg" type="image/x-icon">
    <title>pineapple.</title>
</head>

<body ontouchstart="">

    <div class="nav-bar">
        <a href="#">
            <div class="logo">
                <img src="./src/Union.svg" alt="union.svg">
                <p>pineapple.</p>
            </div>
        </a>
        <ul>
            <li><a href="#">About</a></li>
            <li><a href="#">How it works</a></li>
            <li><a href="#">Contacts</a></li>
        </ul>
    </div>

    <div class="subscription">
        <div id="intro">
            <h1>Subscribe to newslatter</h1>
            <p>Subscribe to our newsletter and get 10% discount on pineapple glasses.</p>
            <!-- <form id="form" action="email.php" method="POST" onsubmit="return false" novalidate> -->
            <form id="form" action="" method="POST">
                <div class="email-input">
                    <div class="blue-line"></div>
                    <input id="email_input" type="email" name="email" value="<?php echo $email ?>" placeholder="Type your email address here...">
                    <button id="post_button" onclick="emailSubmit()" type="submit" name="submit" value="Submit">
                        <img src="./src/ic_arrow.svg" alt="arrow.svg">
                    </button>
                </div>
                <!-- SHOW WARNING MEASSAGES -->
                <span id="message" class="fail"><?php echo $message; ?></span>
                <div class="TOS">
                    <input id="check_tos" type="checkbox" name="check" value="Submit"></input>
                    <p>I agree to <a href="#">terms of service</a></p>
                </div>
            </form>
        </div>

        <div id="succeded" class="hide">
            <a href="./email_list.php" target="_blank"><img src="./src/ic_success.svg" alt="success.svg"></a>
            <h1>Thanks for subscribing!</h1>
            <p>You have successfully subscribed to our email listing. Check your email for the discount code.</p>
        </div>
        <hr>
        <div class="social_links">
            <a href="#" class="fb"><img src="./src/ic_facebook.svg" alt="facebook"></a>
            <a href="#" class="ins"><img src="./src/ic instagram.svg" alt="instgram"></a>
            <a href="#" class="tw"><img src="./src/ic_twitter.svg" alt="twitter"></a>
            <a href="#" class="yt"><img src="./src/ic youtube.svg" alt="youtube"></a>
        </div>
    </div>

    <div class="bg_img">
        <img src="./src/image_summer.png" alt="img_summer.jpg">
    </div>

    <!-- <script src="./app.js"></script> -->
    <script>
        <?php echo $success ?>
    </script>
</body>

</html>