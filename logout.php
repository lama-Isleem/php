<?php
require 'function.php';
$_SESSION = [];
session_unset();
session_destroy();
header("location: login.php");

?>



<!doctype html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>logout</title>
    <style>@import url(project.css);</style>
</head>