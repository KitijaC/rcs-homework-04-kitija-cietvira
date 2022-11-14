<?php

    session_start();

    require_once '../db.php';

    $sql = "SELECT * FROM posts WHERE NOT post_deleted";

    $stmt = $dbConnection->stmt_init();

    if ($stmt->prepare($sql)) {

        if ($stmt->execute()) {
            $allPosts = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } else {
            echo "error";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore</title>
    <link href="https://fonts.googleapis.com/css2?family=Fasthand&family=Josefin+Sans:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css" type="text/css">
</head>
<body class="body-color">
    <div class="wrapper wrapper-explore">
        <div class="nav-bar">
            <p>Book Club Blog</p>
            <?php if (!isset($_SESSION["signedin"]) ||$_SESSION["signedin"] !== TRUE) { ?>
                <a href="signin.php">Sign In</a>
                <a href="signup.php">Sign Up</a>
                <a href="index.php">Home</a>
            <?php } else { ?>
                <a href="profile.php?user-id=<?= $_SESSION["id"] ?>">My Profile</a>
                <a href="../controllers/signout.php">Sign Out</a>
            <?php } ?>
        </div>
        <h1>Here are all the posts from Book Club users</h1>
        <?php foreach ($allPosts as $post) {?>
            <a class="posts-explore" href="post.php?post-id=<?= $post["id"] ?>">
                <h2><?php echo $post["title"];?></h2>
            </a>
        <?php } ?>
    </div>
    <div class="footer">
        <p>RCS, Kitija Cietvīra, 2022</p>
    </div>
</body>
</html>