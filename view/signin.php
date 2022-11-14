<?php


    if (isset($_SESSION["signedin"]) && $_SESSION["signedin"] === TRUE) {
        header("location: explore.php");
        exit;
    }

    require_once "../db.php";

    $usernameOrEmail = $password = "";
    $usernameOrEmail_err = $password_err = $signin_err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty(trim($_POST["usernameOrEmail"]))) {
            $usernameOrEmail_err = "Enter your username or email!";
        } else {
            $usernameOrEmail = trim($_POST["usernameOrEmail"]);
        }

        if (empty(trim($_POST["password"]))) {
            $password_err = "Enter your password!";
        } else {
            $password = trim($_POST["password"]);
        }

        if (empty($usernameOrEmail_err) && empty($password_err)) {
            $sql = "SELECT id,username,email,password FROM users WHERE username = ? OR email = ?";
            $stmt = $dbConnection->stmt_init();

            if ($stmt->prepare($sql)) {
                $stmt->bind_param("ss", $param_usernameOrEmail, $param_usernameOrEmail);
                $param_usernameOrEmail = $usernameOrEmail;

                if ($stmt->execute()) {
                    $stmt->store_result();

                    if ($stmt->num_rows == 1) {
                        $stmt->bind_result($id, $username, $email, $hashed_password);

                        if ($stmt->fetch()) {
                            if (password_verify($password, $hashed_password)) {
                                session_start();

                                $_SESSION["signedin"] = TRUE;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;

                                header("location: profile.php?user-id=$id");
                            } else {
                                $signin_err = "Invalid username, email or password!";
                            }
                        }
                    } else {
                        $signin_err = "Invalid username, email or password!";
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
    <title>Sign In</title>
    <link href="https://fonts.googleapis.com/css2?family=Fasthand&family=Josefin+Sans:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css" type="text/css">
</head>
<body class="body-color">
    <div class="wrapper wrapper-signin">
        <div class="nav-bar">
            <p>Book Club Blog</p>
            <a href="index.php">Home</a>
        </div>
        <h2>Sign In</h2>
        <?php 
            if (!empty($signin_err)) {
                echo '<div class="alert alert-danger">' . $signin_err . '</div>';
            }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username or Email</label>
                <input type="text" name="usernameOrEmail" class="form-control <?php echo (!empty($usernameOrEmail_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $usernameOrEmail; ?>">
                <span class="invalid-feedback"><?php echo $usernameOrEmail_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Sign in">
            </div> 
            <p class="sign-up-here">Don't have an account? <a href="signup.php">Sign Up now</a>.</p>
        </form>
    </div>
    <div class="footer">
        <p>RCS, Kitija Cietvīra, 2022</p>
    </div>
</body>
</html>