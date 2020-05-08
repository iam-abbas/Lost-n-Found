<?php
require_once "config.php";
require_once "includes.php";
require_once "_header.php";

CheckLogin();

if (!isset($_GET['tid'])) {
    redirect('index.php');
}

$tid = $_GET['tid'];

mysqli_query($con, "UPDATE `items` SET `deleted` = '1' WHERE `id` = '{$tid}' ");
redirect('index.php');


?>