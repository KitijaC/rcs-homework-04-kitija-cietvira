<?php

    session_start();

    if (!isset($_SESSION["signedin"]) || $_SESSION["signedin"] !== TRUE) {
        header("location: signin.php");
    }

    require_once '../db.php';

    $title = $text = "";
    $title_err = $text_err = "";


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty(trim($_POST["title"]))) {
            $title_err = "This has to contain some text!";
        } else if (strlen(trim($_POST["title"])) > 500) {
            $title_err = "This is too long!";
        } else {
            $title = trim($_POST["title"]);
        }

        if (empty(trim($_POST["text"]))) {
            $text_err = "This has to contain some text!";
        } else {
            $text = trim($_POST["text"]);
        }

        
        $tempname = $_FILES["uploadfile"]["tmp_name"];

        $filepath = tempnam("../images/post_images", "");
        rename($filepath, $filepath .= ".jpg");
        $originalFileName = $_FILES["uploadfile"]["name"];
        unlink($filepath);
        $pathExploded = explode("\\",$filepath);
        $filename = $pathExploded[count($pathExploded)-1];



        if (move_uploaded_file($tempname, $filepath)) {
            header ("location: profile.php?user-id=".$_SESSION["id"]);
        } 

        if (empty($title_err) && empty($text_err)) {
            $sql = "INSERT INTO posts (title,text,user_id,publish_date,image) VALUES (?,?,?,NOW(),?)";
            $stmt = $dbConnection->stmt_init();

            if ($stmt->prepare($sql)) {
                $stmt->bind_param("ssis", $param_title, $param_text, $param_userId, $param_imageName);

                $param_title = $title;
                $param_text = $text;
                $param_imageName = $filename;
                $param_userId = $_SESSION["id"];

                if ($stmt->execute()) {
                    header("location: profile.php?user-id=".$param_userId);
                } else {
                    echo "Something went wrong!";
                }
            } $stmt->close();
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a post</title>
    <link href="https://fonts.googleapis.com/css2?family=Fasthand&family=Josefin+Sans:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css" type="text/css">
</head>
<body class="body-color">
    <div class="wrapper wrapper-create-post">
        <div class="nav-bar">
            <p>Book Club Blog</p>
            <?php { ?>
                <a href="profile.php?user-id=<?= $_SESSION["id"] ?>">My Profile</a>
            <?php } ?>
            <a href="explore.php">Explore</a>
            <?php { ?>
                <a href="../controllers/signout.php">Sign out</a>
            <?php } ?>
        </div>
        <h2>Create Post</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="label-img">Image</label> 
                <input type="file" name="uploadfile" value="" class="form-control"> 
            </div>
            <div class="form-group">
                <label>Title</label> 
                <input type="text" name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>"> 
                <span class="invalid-feedback"><?php echo $title_err; ?></span> 
            </div> 
            <div class="form-group">
                <label>Text</label> 
                <textarea type="text" name="text" class="form-control <?php echo (!empty($text_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $text; ?>" style="resize: none;"></textarea>
                <span class="invalid-feedback"><?php echo $text_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="submit">
            </div>
        </form>
    </div>
    <div class="footer">
        <p>RCS, Kitija Cietvīra, 2022</p>
    </div>
</body>
</html>