<?php
require 'function.php';

$login = new Login();
$errors = [];

if (isset($_POST['send'])) {

    //check email
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Enter VALID Email';
        
    }else{
        $email = $_POST["email"];
    }
     
    //check password
    if (strlen($_POST['password']) < 8) {
        $errors[] = 'Weak password';
    }
    else{
        $password =md5($_POST["password"]);
    }

    
    // check checked box
    if (!isset($_POST['checkMe'])) {
        $errors[] = 'checked the box please';
    }
    
    // Perform registration if there are no errors
    if (count($errors) == 0) {
        $result = $login-> login( $_POST["email"] ,md5($_POST["password"]));

        if ($result == 1) {
           $_SESSION["login"] = true;
           $_SESSION["id"] = $login->idUser();
           header("location: user.php");

        } elseif ($result == 10) {
            echo 
            "<script> alert('WRONG PASSWORD!'); </script>";

        } elseif ($result == 100){
            echo 
            "<script> alert('USER NOT REGISTER !'); </script>";
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>login</title>
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
            <li class="item"><a href="#whyUs">why Us</a></li>
            <li class="item"><a href="#contact">Contact</a></li>
        </ul>
    </nav>

    <div class="main-div">
    <div class="img-div">

        <img src="image/log.jpg" width="500">
    </div>
    <div class="form-div">
    <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">

        <div class="row1">
            <h2>Login</h2>
        </div>

        <div class="row2">
            <span id="span">Login to your account by filling in the following fields. </span>
        </div>

        <div class="inputs">
            <input type="email"  placeholder="Email" class="middle" required=""  name="email">
            <input type="Password" placeholder="Password" id="lastinput" maxlength="10" required=""  name="password">
        </div>

        <div class="check" >
            <input type="checkbox" name="checkMe"> Remember me<p></p>
        </div>

        <div>
            <p class="row3">if you don't have acount...
            <a href="sign.php" id="links">sign up here</a></p>
        </div>

        <div id="log">
        <button class="btn" name="send" type="submit">login</button>
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

    <p class="footer-company-name">Copyright © 2021 <strong>LamaDeveloper</strong> All rights reserved</p>
</div>

<div class="footer-center">
    <div>
        <i class="fa fa-map-marker"></i>
        <p><span>Palestine</span>
            Gaza</p>
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
        <strong>Sagar Developer</strong> is a web site where you can sign up and login as admin or user
        and
        Effects along with
        HTML, JavaScript and Projects using C/C++.
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