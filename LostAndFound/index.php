<?php
require_once "config.php";
require_once "includes.php";
require_once "_header.php";

CheckLogin();


$stmt = mysqli_query($con, "SELECT * FROM `items` WHERE `deleted` = '0' AND `found` = '0'");
echo '
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="about">
<h3 class="card-title">All Items Lost</h3>
</div>
';
while ($item = mysqli_fetch_assoc($stmt)) {
    $user_stmt = mysqli_query($con, "SELECT * FROM `users` WHERE `id` = '{$item['uid']}'");
    $userRow = mysqli_fetch_assoc($user_stmt);
    $src = 'data:image/jpeg;base64,'.base64_encode($item['image'] ).'';
    if(empty($item['image'])) {
        $src = "https://semantic-ui.com/images/wireframe/image.png";
    }
?>

<div class="col-md-12 col-xs-12">
    <div class="card-h horizontal">
        <div class="card-image">
            <img src=<?=$src?>>
        </div>
        <div class="card-stacked">
            <div class="card-content">
                <h3><?= $item['title'] ?></h3>
                <p><?= $item['desc'] ?></p>
                <a href="tel:<?=$item['contact']?>" target="_blank"><button type="button" class="btn btn-primary">Contact</button></a>
                <span class="author">Post by: <b><?= $userRow['name'] ?></b></span>
            </div>
        </div>
    </div>
</div>

<?php
}
echo '
</div>
</div>
</div>
';



$stmt2 = mysqli_query($con, "SELECT * FROM `items` WHERE `deleted` = '0' AND `found` = '0' AND `uid` = '{$_SESSION['id']}' ");
echo '
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="about">
<h3 class="card-title">Your Items Lost</h3>
</div>
';
while ($item = mysqli_fetch_assoc($stmt2)) {
    $user_stmt = mysqli_query($con, "SELECT * FROM `users` WHERE `id` = '{$item['uid']}'");
    $userRow = mysqli_fetch_assoc($user_stmt);
    $src = 'data:image/jpeg;base64,'.base64_encode($item['image'] ).'';
    if(empty($item['image'])) {
        $src = "https://semantic-ui.com/images/wireframe/image.png";
    }
?>

<div class="col-md-12 col-xs-12">
    <div class="card-h horizontal">
        <div class="card-image">
            <img src=<?=$src?>>
        </div>
        <div class="card-stacked">
            <div class="card-content">
                <h3><?= $item['title'] ?></h3>
                <p><?= $item['desc'] ?></p>
                <a href="edit.php?tid=<?=$item['id']?>" target="_blank"><button type="button" class="btn btn-warning">Edit</button></a>
                <a href="delete.php?tid=<?=$item['id']?>" target="_blank"><button type="button" class="btn btn-danger">Delete</button></a>
                <span class="author">Post by: <b><?= $userRow['name'] ?></b></span>
            </div>
        </div>
    </div>
</div>

<?php
}
echo '
</div>
</div>
</div>
';


?>