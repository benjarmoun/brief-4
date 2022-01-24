<?php 

if(isset($_SESSION["login"]) && $_SESSION["login"] === true){
    header("location: dashboard.php");
    exit;
}
include "cennect_data_base.php";

$firstname = $lastname = $username = $password_users ="";
$firstname_error = $lastname_error = $username_error =$password_users_error = "";
// Check existence of id parameter before processing further

    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM employe WHERE id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    
                    // Définir les paramètres
              $firstname = $row['firstname'];
              $lastname = $row['lastname'];
              $username = $row['username'];
              $password_users = $row['password_users'];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: page_error.php");
                    exit();
                }
                
            } else{
                echo "Veuillez réessayer plus tard.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($conn);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: index.php");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet"  href="./css/view_Employeurs.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Gestion de stocke</title>
</head>

<body>
    <header class="header_desktop">
     <img src="img/LOGO_1.png" alt="" class="logo">
        <nav class="navigation">
            <a href="index.php"aria-label="Facebook" ><img src="img/icon/icons8-home.svg" alt=""></a>
            <a href="#"aria-label="Facebook" ><img src="img/icon/icons8-user.svg" alt=""></a>
            <a href="#"aria-label="Facebook" ><img src="img/icon/logout.svg" alt=""></a>
        </nav>
    </header>
    <header class="header_mobile">
     <img src="img/LOGO_1.png" alt="" class="logo">
        <nav class="navigation">
            <a href="index.php"aria-label="Facebook" ><img src="img/icon/icons8-home.svg" alt=""></a>
          <a href="index.php"  aria-label="Facebook" id="affich_menu"><img src="img/icon/menu.svg" alt=""></i></a>
        </nav>
    </header>
    
        <div id="my_menu">
          <a href="./produits.php"aria-label="Facebook" ><img src="img/icon/book.svg" alt=""> <p> Produits</p></a>
          <a href="./Employeurs.php"aria-label="Facebook" ><img src="img/icon/employer.svg" alt=""><p> Employeurs</p></a>
          <a href="brief_4_PHP/Profile.php"aria-label="Facebook" ><img src="img/icon/icons8-user.svg" alt="">Profile</a>
          <a href="#"aria-label="Facebook" ><img src="img/icon/logout.svg" alt=""><p> déconection</p></a>
      </div>

    <hr>

     <section class="content">
          <a href="./produits.php"aria-label="Facebook" ><img src="img/icon/book.svg" alt=""> <p> Produits</p></a>
         <a href="./Employeurs.php"aria-label="Facebook" ><img src="img/icon/employer.svg" alt=""><p> Employeurs</p></a>
     </section>
     <section class="content_statistic_1">
        <div id="operation_1">
             <p>Employeurs</p>
        </div>
        <div id="operation_2">
            <a href="#" id="btn_ajouter" aria-label="Facebook" ><img src="img/icon/add.svg" alt=""> <p> Ajouter Employeur</p></a>
        </div>
</section>

<section class="ajouter">
        <div id="page_ajouter" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                
            <a href="Employeurs.php"  aria-label="Facebook" ><span class="close">&times;</span></a><br>
                
              <div class="modal-body ma_contact_child">
              <p>information de Utilisateu </p>
                <br><br>
              <div class="page_information">
                  <p>NOM :</p>
                    <p> <?php echo $firstname; ?></p><br>
                </div>  
                <div class="page_information">  
                    <p>Prénom :</p>
                    <p> <?php echo $lastname; ?></p><br>
                </div>
                <div class="page_information">    
                    <p>Utilisateur :</p>
                    <p> <?php echo $username; ?></p><br>
                </div>
              </div>
             
            </div>
          
          </div>
     </section>
     <script src="./js/index.js"></script>
</body>
</html>