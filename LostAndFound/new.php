<?php
require_once "config.php";
require_once "includes.php";
require_once "_header.php";

CheckLogin();


if (isset($_POST["submit"])) {
    $title = $_POST["title"];
    $desc =  $_POST["desc"];
    $contact = (float) $_POST["contact"];
    $uid = $_SESSION['id'];
    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $image_name = addslashes($_FILES['image']['name']);
    $sql = mysqli_query($con, "INSERT INTO `items` (`uid`, `title`, `desc`, `contact`, `image`, `image_name`) VALUES ('{$uid}', '{$title}', '{$desc}', '{$contact}', '{$image}', '{$image_name}') ");
    if ($sql) {
        echo '
        <div class="alert alert-success" role="alert">
        Succesfully listed your item!
        </div>
        ';
    } else {
        echo '
        <div class="alert alert-warning" role="alert">
        Image file too large!
        </div>
        ';
    }
} else {
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="about">
                <h3 class="card-title">List New Item</h3>
            </div>
            <form action="" method="POST" class="mt-5" enctype="multipart/form-data">
                <div class="form-group row mb-4">
                    <label class="col-sm-2 col-form-label">Enter Listing Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title"
                            placeholder="ex: Lost iPhone 7 Plus Rose Gold">
                    </div>
                </div>
                <div class="form-group row my-4">
                    <label class="col-sm-2 col-form-label">Enter Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="desc" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-sm-2 col-form-label">Contact Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="contact" placeholder="ex: 9898889988">
                    </div>
                </div>
                <div class="form-group row my-4">
                    <label class="col-sm-2 col-form-label">Add Image</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control-file" name="image">
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary my-4 float-right">List Item</button>

            </form>
        </div>
    </div>
</div>

<?php
}
?>