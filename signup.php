<?php 
    require_once "includes/db.php";
    if (isset($_POST["submit"])) {
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $pfp = $_POST["pfp"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password1 = $_POST["password1"];
        $password2 = $_POST["password2"];
        if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($username) && !empty($password1) && !empty($password2)) {
            if ($password1 === $password2) {
                $checkUser = mysqli_query($conn,"SELECT username,email FROM users WHERE username='$username' OR email='$email'");
                if (mysqli_num_rows($checkUser) > 0) {
                    echo '
                        <div class="message show error">Username or email already in use</div>
                    ';
                } else {
                    $InsertUser = mysqli_query($conn,"INSERT INTO users(lastname, firstname, email, username, passkey, pfp) VALUES('$lastname','$firstname','$email','$username','$password2','$pfp')");
                    mysqli_close($conn);
                    header("Location: pages/home");
                }
            } else {
                echo '
                    <div class="message show error">Passwords doesn\'t match</div>
                ';
            }
        } else{
            echo '
                <div class="message show error">All input fields are required</div>
            ';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Sign Up - M A T R I X</title>
</head>
<body>
    <section class="signing">
        <form action="" method="post">
            <div class="label">
                <span>MATRIX</span>
                <i></i>
                <p>Sign Up</p>
            </div>
            <div class="double">
                <div class="field">
                    <input type="text" id="firstname" name="firstname" placeholder="First name" value="<?php echo $firstname ?>">
                </div>
                <div class="field">
                    <input type="text" id="lastname" name="lastname" placeholder="Last name" value="<?php echo $lastname ?>">
                </div>
            </div>
            <div class="field">
                <input type="email" id="email" name="email" placeholder="Email" value="<?php echo $email ?>">
            </div>
            <div class="field">
                <span>Choose a profile picture</span>
                <input type="file" id="pfp" name="pfp">
            </div>
            <div class="field">
                <input type="text" id="username" name="username" placeholder="Username" value="<?php echo $username ?>">
            </div>
            <div class="double">
                <div class="field">
                    <input type="password" id="password1" name="password1" placeholder="Password" value="<?php echo $password1 ?>">
                </div>
                <div class="field">
                    <input type="password" id="password2" name="password2" placeholder="Confirm password" value="<?php echo $password2 ?>">
                </div>
            </div>
            <div class="field">
                <button name="submit" type="submit">Sign Up</button>
            </div>
            <div class="label">
                <p>Already have an account? <a href="./">Sign In</a></p>
            </div>
        </form>
    </section>
</body>
</html>
