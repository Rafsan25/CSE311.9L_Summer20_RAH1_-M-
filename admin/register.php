<?php
// import the config file
require_once "../config.php";

// Define variables and initialize with null string
$name=$username= $password = $confirm_password =$email="";
$name_err = $username_err = $password_err = $confirm_password_err =$email_err= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter a name.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM admin WHERE name = ?";

        if ($stmt = mysqli_prepare($con, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_name);

            // Set parameters
            $param_name = trim($_POST["name"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                $name = trim($_POST["name"]);
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }


// Processing form data when form is submitted
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM admin WHERE username = ?";

        if ($stmt = mysqli_prepare($con, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM admin WHERE email = ?";

        if ($stmt = mysqli_prepare($con, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "This email is already taken.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }


    // Check input errors before inserting in database
    if (empty($name_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err)) {

        // Prepare an insert statement
        $sql =mysqli_query($con, "INSERT INTO admin (`name`,`username`, `password`,`email`) VALUES ('$name','$username','$password','$email')");

        if ($stmt = mysqli_prepare($con, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_name, $param_username, $param_password, $param_email);

            // Set parameters
            $param_name = $name;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_email = $email;



            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: Welcome_Page.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($con);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {background-color: rebeccapurple;}
        h2 {color: yellow;}
        p {color: whitesmoke;}
        h2 {text-align: center;}
        p{text-align: center;}
        h2{font-size: 60px;}
        p{font-size: 15px;}
        p{font-style: italic;}
        body{ font: 14px sans-serif; }
        input{font-style: italic;}
        .wrapper{width: 350px; padding: 20px;position: relative ;margin: 0;position: absolute;top: 50%;left: 50%;margin-right: -50%;transform: translate(-50%, -50%)}
    </style>
</head>
<body>
<div class="wrapper">
    <h2>Sign Up</h2>
    <p>Try our delicious items!</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">

            <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $name; ?>">
            <span class="help-block"><?php echo $name_err; ?></span>

        </div>
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">

            <input type="text" name="username" class="form-control" placeholder="User Name" value="<?php echo $username; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>

        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">

            <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo $password; ?>">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">

            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" value="<?php echo $confirm_password; ?>">
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">

            <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>">
            <span class="help-block"><?php echo $email_err; ?></span>

        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-default" value="Reset">
        </div>
        <p>Already have an account? <a href="Login.php">Login here</a></p>
    </form>
</div>
</body>
</html>