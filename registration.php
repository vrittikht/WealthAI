<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="registration.css">
</head>
<body>

    <?php
        if(isset($_POST["submit"])) {
            $name = $_POST['name'];
            $user_email = $_POST["email"];
            $user_name = $_POST["username"];
            $user_pass = $_POST["pass"];
            $user_re_pass = $_POST["re-pass"];

            $paswword_hash = password_hash($user_pass, PASSWORD_DEFAULT);
            
            $error = array();
            
            if(empty($name) or empty($user_email) or empty($user_name) or empty($user_pass) or empty($user_re_pass)){
                array_push($error,"All fileds are required");
            }
            if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
                array_push($error,"Email is not valid");
            }
            if(strlen($user_pass)<8){
                array_push($error,"Password must be at least 8 charactes long");
            }
            if($user_pass!==$user_re_pass){
                array_push($error,"Paswword does not match");
            }

            if(count($error)>0){
                foreach($error as $errors){
                    echo "<div class= 'alert alert-danger'>$errors</div>";
                }
            }
            else{
                require_once "database.php";
                $sql = "INSERT INTO login(name,email,username,password) VALUES(?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                if($prepareStmt){
                    mysqli_stmt_bind_param($stmt,"ssss",$name,$user_email,$user_name,$paswword_hash);
                    mysqli_stmt_execute($stmt);
                    imap_alerts("You are registered successfully...");
                }
                else{
                    die("Something went wrong");
                }
            }
        }
    ?>

   <div class="container" id="container">
    
        <div class="form-container sign-up">
            <form method="POST" action="registration.php">
                <h1>Create Account</h1>
                <div class="social-icon">
                    <a href="#" class="icon"><ion-icon name="logo-google"></ion-icon></a>
                    <a href="#" class="icon"><ion-icon name="logo-facebook"></ion-icon></a>
                    <a href="#" class="icon"><ion-icon name="logo-github"></ion-icon></a>
                    <a href="#" class="icon"><ion-icon name="logo-linkedin"></ion-icon></a>
                </div>
                <span>
                    Or use your email for registeration
                </span>
                <input type="text" placeholder="Name" name="name">
                <input type="email" placeholder="Email" name="email">
                <input type="text" placeholder="Username" name="username">
                <input type="password" placeholder="Password" name="pass">
                <input type="password" placeholder="Re-Password" name="re-pass">
                <input type="submit" value="SIGN-UP" class="btn" name="submit">
            </form>
        </div>

        <div class="form-container sign-in">
            <form> 
                <h1>Sign In</h1>
                <div class="social-icon">
                    <a href="#" class="icon"><ion-icon name="logo-google"></ion-icon></a>
                    <a href="#" class="icon"><ion-icon name="logo-facebook"></ion-icon></a>
                    <a href="#" class="icon"><ion-icon name="logo-github"></ion-icon></a>
                    <a href="#" class="icon"><ion-icon name="logo-linkedin"></ion-icon></a>
                </div>
                <span>
                    Or use your email password
                </span>
                <input type="username" placeholder="Username" name="username">
                <input type="password" placeholder="Password" name="password">
                <a href="#">Forget Password?</a>
                <input type="submit" value="SIGN-IN" class="btn">
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Wellcome Back!</h1>
                    <p>Enter your personal details for access your account</p>
                    <button class="hidden" id="login">Sign-In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello Friend!</h1>
                    <p>Register with your personal details for create your new account</p>
                    <button class="hidden" id="register">Sign-Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="registration.js"></script>

</body>
</html>