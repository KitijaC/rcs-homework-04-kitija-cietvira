<?php

    require_once "../db.php";

    $username = $email = $password = $password_confirm = "";
    $username_err = $email_err = $password_err = $password_confirm_err = "";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty(trim($_POST["username"]))) {
            $username_err = "Enter your username!";
        } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
            $username_err = "Username can only contain: numbers, letters, underscores!";
        } else {
            $sql = "SELECT id FROM users WHERE username = ?";
            $stmt = $dbConnection->stmt_init();

            if ($stmt->prepare($sql)) {
                $stmt->bind_param("s", $param_username);
                $param_username = trim($_POST["username"]);

                if ($stmt->execute()) {
                    $stmt->store_result();

                    if ($stmt->num_rows() == 1) {
                        $username_err = "This username is already taken!";
                    } else {
                        $username = trim($_POST["username"]);
                    }
                } else {
                    echo "Something went wrong";
                }
            } $stmt->close();
        }

        if (empty(trim($_POST["email"]))) {
            $email_err = "Enter your email!";
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $email_err = "Invalid email format!";
        } else {
            $sql = "SELECT id FROM users WHERE email = ?";
            $stmt = $dbConnection->stmt_init();

            if ($stmt->prepare($sql)) {
                $stmt->bind_param("s", $param_email);

                if ($stmt->execute()) {
                    $stmt->store_result();

                    if ($stmt->num_rows == 1) {
                        $email_err = "This email is already taken!";
                    } else {
                        $email = trim($_POST["email"]);
                    }
                } else {
                    echo "Something went wrong";
                }
            } $stmt->close();
        }

        if (empty(trim($_POST["password"]))) {
            $password_err = "Enter your password!";
        } elseif (strlen(trim($_POST["password"])) < 8) {
            $password_err = "Your password needs to be at least 8 characters long!";
        } else {
            $password = trim($_POST["password"]);
        }

        if (empty(trim($_POST["confirm_password"]))) {
            $password_confirm_err = "Confirm your password!";
        } else {
            $password_confirm = trim($_POST["confirm_password"]);

            if ($password != $password_confirm) {
                $password_confirm_err = "Entered passwords do not match!";
            }
        }

        if (empty($username_err) && empty($email_err) && empty($password_err) && empty($password_confirm_err)) {
            $sql = "INSERT INTO users (username,email,password) VALUES (?,?,?)";

            $stmt = $dbConnection->stmt_init();

            if ($stmt->prepare($sql)) {
                $stmt->bind_param("sss", $param_username, $param_email, $param_password);

                $param_username = $username; 
                $param_email = $email;
                $param_password = password_hash($password, PASSWORD_DEFAULT);

                if ($stmt->execute()) {
                    header("location: signin.php");
                } else {
                    echo "Something went wrong";
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
    <title>Sign Up</title>
    <link href="https://fonts.googleapis.com/css2?family=Fasthand&family=Josefin+Sans:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css" type="text/css">
</head>
<body class="body-color">
    <div class="wrapper wrapper-signup">
        <div class="nav-bar">
            <p>Book Club Blog</p>
            <a href="index.php">Home</a>
        </div>
        <h2>Sign Up</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($password_confirm_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo $password_confirm; ?>">
                <span class="invalid-feedback"><?php echo $password_confirm_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary" value="Reset">
            </div> 
            <p class="sign-in-here">Already have an account? <a href="signin.php">Sign in here</a>.</p>
        </form>
    </div>
    <div class="footer">
        <p>RCS, Kitija Cietvīra, 2022</p>
    </div>
</body>
</html>