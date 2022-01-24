<?php 

// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["login"]) && $_SESSION["login"] === true){
    header("location: dashboard.php");
    exit;
}
 
// Include config file
require_once "cennect_data_base.php";
 
// Define variables and initialize with empty values
$username = $password_users = "";
$username_err = $password_users_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password_users"]))){
        $password_userspassword_users_err = "Please enter your password.";
    } else{
        $password_users = trim($_POST["password_users"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password_users FROM employe WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            // Set parameters
            $param_username = $username;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password_users, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["login"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: dashboard.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Nom d'utilisateur ou mot de passe invalide.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Nom d'utilisateur ou mot de passe invalide.";
                }
            } else{
                echo "Veuillez réessayer plus tard.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/login.css">
    <title>Gestion de stocke</title>
</head>
<body>
    <section>
    <img src="img/logo_1.png" alt="" class="logo">
    <div class="modal-content">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <label for="username">Utilisateur</label><br>
                    <span ><?php echo (!empty($username_error)) ? 'is-invalid' : ''; ?></span>
                    <input type="text" id="username" name="username">
                    <label for="password_users">Mot de passe</label> <br>
                    <span ><?php echo (!empty($password_users_error)) ? 'is-invalid' : ''; ?></span>
                    <input type="password" id="password_users" name="password_users">
                    <br>
                    <input class="ho" type="submit" name="submit" value="Login" >
                </form>
    </div>
    </section>

</body>
</html>