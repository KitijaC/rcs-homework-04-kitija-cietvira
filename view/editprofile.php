<?php

    session_start();

    if (!isset($_SESSION["signedin"]) && $_SESSION["signedin"] !== TRUE) {
        header("location: index.php");
        exit;
    }

    require_once '../db.php';

    $text = "";
    $text_err = "";

    $userOwnsThisPost = FALSE;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty(trim($_POST["text"]))) {
            $text_err = "This has to contain some text about you!";
        } else {
            $textEdited = trim($_POST["text"]);
        }

        if (empty($text_err)) {

            $sql = "UPDATE profile SET text = ? WHERE user_id = ?";

            $stmt = $dbConnection->stmt_init();

            if ($stmt->prepare($sql)) {

                $stmt->bind_param("si", $param_text, $param_userId);

                $param_text = $textEdited;
                $param_userId = $_SESSION["id"];

                if ($stmt->execute()) {
                    $stmt->close();

                    $userId = $_SESSION["id"];
                    $_SESSION["user-id"] = NULL;
                    header("location: profile.php?user-id=".$param_userId);
                } else {
                    echo "Something went wrong";
                }
            } $stmt->close();

        }
    } else {

        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_components = parse_url($actual_link);
        parse_str($url_components['query'], $urlParams);
        $userId = $urlParams["user-id"];

        $_SESSION["user-id"] = $userId;

        $sql = "SELECT text FROM profile WHERE user_id = ?";

        $stmt = $dbConnection->stmt_init();

        $userOwnsThisPost = FALSE;

        if ($stmt->prepare($sql)) {

            $stmt->bind_param("i", $param_userId);

            $param_userId = (int)$userId;

            if ($stmt->execute()) {
                $stmt->store_result();
                
                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($text);

                    if ($stmt->fetch()) {
                        $profileExists = TRUE;
                        $text = trim($text);
                        $userId = $_SESSION["id"];

                        if ($userId == $_SESSION["id"]) {
                            $userOwnsThisProfile = TRUE;
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
    <title>Edit Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Fasthand&family=Josefin+Sans:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css" type="text/css">
</head>
<body class="body-color">
    <div class="wrapper wrapper-edit-profile">
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
        <h2>Edit Profile</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">  
            <div class="form-group">
                <label>Text</label>
                <textarea type="text" name="text" class="form-control <?php echo (!empty($text_err)) ? 'is-invalid' : ''; ?>" style="resize: none;"><?= trim($text) ?></textarea>
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