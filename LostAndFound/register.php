<?php
require_once "config.php";
require_once "includes.php";
require_once "_header.php";

if (isset($_POST["submit"])) {
    $user_email = $_POST["email"];
    $user_name = $_POST["user_name"];
    $user_pass =  $_POST["pass"];
    $sql_query = "INSERT INTO `users` (`email`, `name`, `password`) VALUES ('{$user_email}', '{$user_name}', '{$user_pass}')";
    $result = mysqli_query($con, $sql_query);
    if ($result) {
        redirect('login.php?er=0');
    } else {
        echo '<div class="alert alert-danger" role="alert">
              <h4 class="alert-heading">Registration Failed!</h4>
              </div>';
    }
}

?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="about">
                <h3 class="card-title">Register</h3>
            </div>
            <form action="" method="POST">
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label">Your Name</label>
                        <input type="text" name="user_name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="pass" class="form-control">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Register</button>
            </form>