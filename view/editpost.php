<?php

    session_start();

    if (!isset($_SESSION["signedin"]) && $_SESSION["signedin"] !== TRUE) {
        header("location: index.php");
        exit;
    }

    require_once '../db.php';

    $title = $text = "";
    $title_err = $text_err = "";

    $userOwnsThisPost = FALSE; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty(trim($_POST["title"]))) {
            $title_err = "This has to contain some text!";
        } else if (strlen(trim($_POST["title"])) > 500) {
            $title_err = "Title is too long!";
        } else {
            $titleEdited = trim($_POST["title"]);
        }

        if (empty(trim($_POST["text"]))) {
            $text_err = "This has to contain some text!";
        } else {
            $textEdited = trim($_POST["text"]);
        }

        if (empty($title_err) && empty($text_err)) {
            
            $sql = "UPDATE posts SET title = ?, text = ? WHERE id = ?";

            $stmt = $dbConnection->stmt_init();

            if ($stmt->prepare($sql)) {

                $stmt->bind_param("ssi", $param_title, $param_text, $param_postEditId);

                $param_title = $titleEdited;
                $param_text = $textEdited;
                $param_postEditId = (int)$_SESSION["post-id"];

                if ($stmt->execute()) {
                    $stmt->close();

                    $userId = $_SESSION["id"];
                    $_SESSION["post-id"] = NULL;
                    header("location: post.php?post-id=".$param_postEditId);
                } else {
                    echo "Something went wrong";
                }
            } $stmt->close();
        }
    } else {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_components = parse_url($actual_link);
        parse_str($url_components['query'], $urlParams);
        $postId = $urlParams["post-id"];

        $_SESSION["post-id"] = $postId;

        $sql = "SELECT title, text, user_id FROM posts WHERE id = ?";

        $stmt = $dbConnection->stmt_init();

        $userOwnsThisPost = FALSE;

        if ($stmt->prepare($sql)) {
            $stmt->bind_param("i", $param_postId);

            $param_postId = (int)$postId;

            if ($stmt->execute()) {
                $stmt->store_result();
                
                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($title, $text, $post_user_id);

                    if ($stmt->fetch()) {
                        $postExists = TRUE;
                        $text = trim($text);
                        $userId = $_SESSION["id"];

                        if ($userId == $post_user_id) {
                            $userOwnsThisPost = TRUE;
                        } else {
                            header("location: index.php");
                            $stmt->close();
                            exit();
                        }
                    }
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
    <title>Edit Post</title>
    <link href="https://fonts.googleapis.com/css2?family=Fasthand&family=Josefin+Sans:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <div class="wrapper wrapper-edit-post">
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
        <h2>Edit Post</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">  
        <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>">
                <span class="invalid-feedback"><?php echo $title_err; ?></span>
            </div>
            <div class="form-group">
                <label>Text</label>
                <textarea type="text" name="text" class="form-control <?php echo (!empty($text_err)) ? 'is-invalid' : ''; ?>"><?= trim($text) ?></textarea>
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