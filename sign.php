<?php
require 'function.php';

$register = new Register();

$errors = [];

if (isset($_POST['send'])) {
    // Check email
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Enter a valid email';
    } else {
        $email = $_POST["email"];
    }

    // Check password
    if (strlen($_POST['password']) < 8) {
        $errors[] = 'Weak password';
    } else {
        $password = md5($_POST["password"]);
    }

    // Check name
    if ($_POST['name'] == '') {
        $errors[] = 'Name cannot be empty';
    } else {
        $name = $_POST["name"];
    }

    // Check repassword
    if ($_POST['repassword'] == '') {
        $errors[] = 'Re-password cannot be empty';
    } elseif ($_POST['password'] != $_POST['repassword']) {
        $errors[] = 'Passwords must be identical';
    } else {
        $repassword = $_POST["repassword"];
    }

    // Check checked box
    if (!isset($_POST['checkMe'])) {
        $errors[] = 'Please check the box';
    }

    // Perform registration if there are no errors
    if (count($errors) == 0) {
        $result = $register->registration($_POST["name"], $_POST["email"] ,md5($_POST["password"]), md5($_POST["repassword"]));

        if ($result == 1) {
            header("location: login.php");
            // echo 
            // "<script> alert('Registration successful'); </script>";
        } elseif ($result == 10) {
            echo 
            "<script> alert('Name and email have already been taken'); </script>";
        } elseif ($result == 100){
            echo 
            "<script> alert('password not match'); </script>";
        }
}
}
?>

<!doctype html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Signup</title>
    <style>@import url(project.css);</style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
</head>

<body id="backgr">

<?php if (count($errors) > 0) { ?>
    <ul class="text-danger">
        <?php foreach ($errors as $error) { ?>
            <li> <?php echo $error; ?></li>
        <?php } ?>
    </ul>
<?php } ?>


<nav id="navbar" class="bg-dark">
    <div class="logo">
        <h3>User<span>Portal</span></h3>
    </div>
    <ul>
        <li class="item"><a href="#showcase">Home</a></li>
        <li class="item"><a href="#about">About</a></li>
        <li class="item"><a href="#whyUs">Why Us</a></li>
        <li class="item"><a href="#contact">Contact</a></li>
    </ul>
</nav>

<div class="main-div">
    <div class="img-div">
        <img src="image/signup.jpg" width="500">
    </div>

    <div class="form-div">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="row1">
                <h2>Sign Up</h2>
            </div>

            <div class="row2">
                <span> Create an account </span>
            </div>

            <div class="inputs">
                <input type="text"  placeholder="Username" id="firstinput" required="" name="name">
                <input type="email" placeholder="Email" class="middle" required="" name="email">
                <input type="Password"  placeholder="Password" class="middle" required="" maxlength="10" name="password">
                <input type="Password"  placeholder="Re-type Password" class="middle" required="" name="repassword">
            </div>

            <div class="check">
                <input type="checkbox" name="checkMe">
                By clicking the Sign Up button, you agree to our 
                <p id="terms">Terms and Conditions and Privacy Policy.</p>
            </div>

            <div>
                <button class="btn" name="send" type="submit">Sign up</button>
            </div>
        </form>
    </div>
</div>

<footer class="footer-distributed">
    <div class="footer-left">
        <h3>User<span>Portal</span></h3>
        <p class="footer-links">
            <a href="#">Home</a>
            |
            <a href="#">About</a>
            |
            <a href="#">Contact</a>
            |
            <a href="#">Blog</a>
        </p>
        <p class="footer-company-name">Copyright © 2021 <strong>LamaDeveloper</strong>
            All rights reserved</p>
    </div>
    <div class="footer-center">
        <div>
            <i class="fa fa-map-marker"></i>
            <p><span>Palestine</span> Gaza</p>
        </div>
        <div>
            <i class="fa fa-phone"></i>
            <p>+975 592552610</p>
        </div>
        <div>
            <i class="fa fa-envelope"></i>
            <p><a href="mailto:lamaisleem91@gmail.com">lamaisleem91@gmail.com</a></p>
        </div>
    </div>
    <div class="footer-right">
        <p class="footer-company-about">
            <span>About the company</span>
            <strong>Sagar Developer</strong> is a website where you can sign up and log in as an admin or user and explore various HTML, JavaScript, and C/C++ projects.
        </p>
        <div class="footer-icons">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-youtube"></i></a>
        </div>
    </div>
</footer>

</body>
</html>