<?php
require_once "config.php";
require_once "includes.php";
require_once "_header.php";

CheckLogin();

if (!isset($_GET['tid'])) {
    redirect('index.php');
}

$tid = $_GET['tid'];
$stmt = mysqli_query($con, "SELECT * FROM `items` WHERE `id` = '{$tid}'");
$results = mysqli_fetch_assoc($stmt);
$src = 'data:image/jpeg;base64,' . base64_encode($results['image']) . '';
if (empty($results['image'])) {
    $src = "https://semantic-ui.com/images/wireframe/image.png";
}
if (isset($_POST["submit"])) {
    $title = $_POST["title"];
    $desc =  $_POST["desc"];
    $contact = (float) $_POST["contact"];
    $sql = mysqli_query($con, "UPDATE `items` SET `title` = '{$title}', `desc` = '{$desc}', `contact` = '{$contact}' WHERE `id` = '{$tid}' ");
    if (!empty($_FILES['image']['name'])) {
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $image_name = addslashes($_FILES['image']['name']);
        $exec = mysqli_query($con, "UPDATE `items` SET `image` = '{$image}', `image_name` = '{$image_name}' WHERE `id` = '{$tid}'");
        if(!$exec) {
            echo '
            <div class="alert alert-warning" role="alert">
            Image file too large!
            </div>
            ';
        }
    }
    if ($sql) {
        echo '
        <div class="alert alert-success" role="alert">
        Succesfully edited your item!
        </div>
        ';
    } else {
        echo mysqli_errno($con);
    }
} else {
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="about">
                <h3 class="card-title">Edit Your Listing</h3>
            </div>
            <center>
                <img src=<?= $src ?> style="width: 300px; height: auto;" />
            </center>
            <form action="" method="POST" class="mt-5" enctype="multipart/form-data">
                <div class="form-group row mb-4">
                    <label class="col-sm-2 col-form-label">Enter Listing Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?= $results['title'] ?>" name="title"
                            placeholder="ex: Lost iPhone 7 Plus Rose Gold">
                    </div>
                </div>
                <div class="form-group row my-4">
                    <label class="col-sm-2 col-form-label">Enter Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="desc" rows="3"><?= $results['desc'] ?></textarea>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-sm-2 col-form-label">Contact Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?= $results['contact'] ?>" name="contact"
                            placeholder="ex: 9898889988">
                    </div>
                </div>
                <div class="form-group row my-4">
                    <label class="col-sm-2 col-form-label">Add Image</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control-file" name="image">
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary my-4 float-right">Edit Listing</button>

            </form>
        </div>
    </div>
</div>
<?php
}
?>