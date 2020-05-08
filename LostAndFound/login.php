<?php
require_once "config.php";
require_once "includes.php";
require_once "_header.php";

if (isset($_POST["submit"])) {
    $user_email = $_POST["login_email"];
    $user_pass =  $_POST["login_pass"];
    $sql_query = "SELECT * FROM `users` WHERE `email` = '{$user_email}' AND `password` = '{$user_pass}'";
    $result = mysqli_query($con, $sql_query);
    if (mysqli_num_rows($result) >= 1) {
        $row = mysqli_fetch_assoc($result);
        $name = $row["name"];
        $_SESSION['name'] = $name;
        $_SESSION['id'] = $row['id'];
        redirect("index.php");
    } else {
        echo '<div class="alert alert-danger" role="alert">
      <h4 class="alert-heading">Login Failed!</h4>
      <p>Please check your User ID and Password.</p>
    </div>';
    }
}

?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="about">
                <h3 class="card-title">Login</h3>
            </div>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="login_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="login_pass" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Login</button>
            </form>