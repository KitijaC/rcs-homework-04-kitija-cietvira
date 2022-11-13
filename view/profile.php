<?php

    session_start();

    $guest = TRUE;
    $userOwnsProfile = FALSE;

    require_once '../db.php';
    require_once '../models/User.php';
    require_once '../models/Post.php';
    require_once '../models/Profile.php';
    require_once '../functions/getParamsFromUrl.php';


    $userId = getParamsFromUrl("user-id");
    $user = new User($dbConnection);
    $user->getOne($userId);

    
    if (isset($_SESSION["signedin"]) && $_SESSION["signedin"] === TRUE) {
        $userOwnsProfile = $user->isOwner($_SESSION["id"]);
        $guest = FALSE;
    }

    $username = $user->getUsername();
    $email = $user->getEmail();

    $allUserPosts = new Post($dbConnection);
    $allUserPosts = $allUserPosts->getAllFromUser($user->getId());
    
    
    $profile = new Profile ($dbConnection);
    $profile->getOne($userId);

    $text = $profile->getProfileText();
    $image = $profile->getProfileImageName();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Fasthand&family=Josefin+Sans:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <div class="wrapper wrapper-profile">
        <div class="nav-bar">
            <p>Book Club Blog</p>
        <?php if (!$guest && $userOwnsProfile === FALSE) { ?>
            <a href="profile.php?user-id=<?= $_SESSION["id"] ?>">My Profile</a>
        <?php } ?>
            <a href="explore.php">Explore</a>
        <?php if (isset($_SESSION["signedin"]) && $_SESSION["signedin"] === TRUE) { ?>
            <a href="../controllers/signout.php">Sign Out</a>
        <?php } else { ?>
            <a href="signin.php">Sign In</a>
            <a href="signup.php">Sign Up</a>
            <a href="index.php">Home</a>
        <?php } ?>
        </div>
        <h2><?php echo ($userOwnsProfile === TRUE) ? "My Profile" : "Users Profile" ?></h2>
        <?php if(!$guest && $userOwnsProfile) { ?>
            <a class="btn-create" href="createpost.php">Create a Post</a>
        <?php } ?>
        <?php if(!$guest && $userOwnsProfile && $text == '') { ?>
            <a class="btn-create" href="createprofile.php">Create your Profile</a>
        <?php } else if ($text != '') { ?>
            <a class="btn-create-hidden" href="createprofile.php">Create your Profile</a>
        <?php } ?>
        <h3><?php echo ($userOwnsProfile === TRUE) ? "Welcome to your profile" : "Viewing Profile of" ?>: <span class="username"><?= $username ?><span></h3> 
        <img class="profile-image" src="../images/profile_images/<?= $image ?>" alt="">
        <p class="profile-text"><?= $text ?></p>
        <?php if ($userOwnsProfile === TRUE && $text != '') { ?>
            <a class="post-buttons" href="editprofile.php?user-id=<?= $userId ?>">Edit profile</a>
        <?php } else if ($text == '')  { ?>
            <a class="btn-create-hidden" href="editprofile.php?user-id=<?= $userId ?>">Edit profile</a>
        <?php } ?>
        <h3 class="all-posts"><?php echo ($userOwnsProfile) ? "All your posts" : "All posts of ".$username ?>: </h3>
        <div class="post-title">
            <?php foreach ($allUserPosts as $post) {?>
            <a class="posts-profile" href="post.php?post-id=<?php echo $post["id"]; ?>">
                <h4><?php echo $post["title"];?></h4>
            </a>
            <?php } ?>
        </div>
    </div>
    <div class="footer">
        <p>RCS, Kitija Cietvīra, 2022</p>
    </div>   
</body>
</html>