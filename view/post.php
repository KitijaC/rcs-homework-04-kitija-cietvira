<?php

    session_start();

    require_once '../db.php';
    require_once '../models/User.php';
    require_once '../models/Post.php';
    require_once '../functions/getParamsFromUrl.php';

    $postId = getParamsFromUrl("post-id");
    $post = new Post($dbConnection);

    $userOwnsThisPost = "";

    if ($post->getOne($postId) === FALSE) {
        header("location: index.php");
        exit;
    }

    
    if (isset($_SESSION["signedin"]) && $_SESSION["signedin"] === TRUE) {
        $userOwnsThisPost = $post->userOwnsThisPost($_SESSION["id"]);
    }

    $title = $post->getTitle();
    $text = $post->getText();
    $post_user_id = $post->getUserId();
    $publish_date = $post->getPublishDate();
    $postImageName = $post->getImageName();

    $user = new User($dbConnection);

    if ($user->getOne($post_user_id) === FALSE) {
        header("location: index.php");
        exit;
    }


    $postOwnerUsername = $user->getUsername();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viewing post</title>
    <link href="https://fonts.googleapis.com/css2?family=Fasthand&family=Josefin+Sans:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
<div class="wrapper wrapper-post">
    <div class="nav-bar">
        <p>Book Club Blog</p>
        <?php if (!isset($_SESSION["signedin"]) || $_SESSION["signedin"] !== TRUE) { ?>
                <a href="explore.php">Explore</a>
                <a href="signin.php">Sign In</a>
                <a href="signup.php">Sign Up</a>
            <a href="index.php">Home</a>
        <?php } else { ?>
            <a href="profile.php?user-id=<?= $_SESSION["id"] ?>">My Profile</a>
            <a href="explore.php">Explore</a>
            <a href="../controllers/signout.php">Sign Out</a>
        <?php } ?>
    </div>
    <h1>Post</h1>
    <h1 class="title"><?= $title ?></h1>
    <img src="../images/post_images/<?= $postImageName ?>" alt="">
    <?php if (isset($postOwnerUsername)) { ?>
        <a class="post-owner-username" href="profile.php?user-id=<?= $post_user_id ?>"><?= $postOwnerUsername ?></a>
    <?php } ?>
    <p class="post-date"><?= $publish_date ?></p>
    <p class="post-text"><?= $text ?></p>
    <?php if ($userOwnsThisPost) { ?>
        <a class="post-buttons" href="editpost.php?post-id=<?= $postId ?>">Edit post</a>
    <?php } ?>
    <?php if ($userOwnsThisPost) { ?>
        <a class="post-buttons" href="../controllers/deletepost.php?post-id=<?= $postId ?>">Delete post</a>
    <?php } ?>
</div>
<div class="footer">
    <p>RCS, Kitija Cietvīra, 2022</p>
</div>  
</body>
</html>