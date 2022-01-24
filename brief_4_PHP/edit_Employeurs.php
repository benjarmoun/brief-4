<?php include "cennect_data_base.php";


$firstname = $lastname = $username = $password_users ="";
$firstname_error = $lastname_error = $username_error =$password_users_error = "";

if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];

    // validation de donne
    $nom_input = trim($_POST['firstname']);
    if(empty($nom_input)){
        $firstname_error = "error donne nom";
    }
    else{
      $firstname= $nom_input;
    }

    $prenom_input = trim($_POST['lastname']);
    if(empty($prenom_input)){
        $lastname_error = "error donne prenom";
    }
    else{
      $lastname= $prenom_input;
    }

    $username_input = trim($_POST['username']);
    if(empty($username_input)){
        $username_error = "error donne Utilisateur";
    }
    else{
      $username= $username_input;
    }

    $password_users_input = trim($_POST['password_users']);
    if(empty($password_users_input)){
        $password_users_error = "error donne Mot de passe";
    }
    else{
      $password_users= $password_users_input;
    }
    // Vérifier les erreurs de saisie avant d'insérer dans la base de données
      if(empty($firstname_error) && empty($lastname_error) && empty($username_error)&& empty($password_users_error))
      {
          // Prepare an update statement
          $sql = "UPDATE employe SET firstname=?, lastname=?, username=?, password_users=?
           WHERE id = ?";
  
          if($stmt = mysqli_prepare($conn, $sql)){
              // Lie les variables à l'instruction préparée en tant que paramètres
              mysqli_stmt_bind_param($stmt, "ssssi", $param_firstname, $param_lastname, $param_usersname, $param_password_users,$param_id);
  
              // Définir les paramètres
              $param_firstname = $firstname;
              $param_lastname = $lastname;
              $param_usersname = $username;
              $param_password_users = password_hash($password_users, PASSWORD_DEFAULT);
              $param_id=$id;
  
              // Tentative d'exécution de l'instruction préparée
          if(mysqli_stmt_execute($stmt)){
                  // Enregistrements créés avec succès. Rediriger vers la page de destination
                  header("location: Employeurs.php");
                  exit();
              } else{
                  echo "Oops! Something went wrong. Please try again later.";
              }
          }
  
          // Fermer la déclaration
          mysqli_stmt_close($stmt);
      }
      // Fermer la connexion
      mysqli_close($conn);
}else{
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
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
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
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet"  href="./css/add_Employeurs.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Gestion de stocke</title>
</head>

<body>
    <header class="header_desktop">
     <img src="img/LOGO_1.png" alt="" class="logo">
        <nav class="navigation">
            <a href="index.php"aria-label="Facebook" ><img src="img/icon/icons8-home.svg" alt=""></a>
            <a href="logout.php"aria-label="Facebook" ><img src="img/icon/logout.svg" alt=""></a>
        </nav>
    </header>
    <header class="header_mobile">
     <img src="img/LOGO_1.png" alt="" class="logo">
        <nav class="navigation">
            <a href="dashboard.php"aria-label="Facebook" ><img src="img/icon/icons8-home.svg" alt=""></a>
          <a href="#"  aria-label="Facebook" id="affich_menu"><img src="img/icon/menu.svg" alt=""></i></a>
        </nav>
    </header>
    
        <div id="my_menu">
          <a href="produits.php"aria-label="Facebook" ><img src="img/icon/book.svg" alt=""> <p> Produits</p></a>
          <a href="Employeurs.php"aria-label="Facebook" ><img src="img/icon/employer.svg" alt=""><p> Employeurs</p></a>
          <a href="#"aria-label="Facebook" ><img src="img/icon/logout.svg" alt=""><p> déconection</p></a>
      </div>

    <hr>

     <section class="content">
          <a href="produits.php"aria-label="Facebook" ><img src="img/icon/book.svg" alt=""> <p> Produits</p></a>
         <a href="Employeurs.php"aria-label="Facebook" ><img src="img/icon/employer.svg" alt=""><p> Employeurs</p></a>
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
                <p>Nouvel Employeur</p>

              <div class="modal-body ma_contact_child">
                <br>
                <form method="POST" action="<?php echo htmlspecialchars(basename($_SERVER["PHP_SELF"]));?>">
                  <br>
                     <label for="firstname">NOM</label><br>
                     <span ><?php echo (!empty($firstname_error)) ? 'is-invalid' : ''; ?></span>
                    <input type="text" id="firstname" name="firstname" value="<?php echo $firstname; ?>">
                    
                    <label for="lastname">Prénom</label><br>
                    <span ><?php echo (!empty($lastname_error)) ? 'is-invalid' : ''; ?></span>
                    <input type="text" id="lastname" name="lastname" value="<?php echo $lastname; ?>">
                    
                    <label for="username">Utilisateur</label><br>
                    <span ><?php echo (!empty($username_error)) ? 'is-invalid' : ''; ?></span>
                    <input type="text" id="username" name="username" value="<?php echo $username; ?>">
                    
                    <label for="password_users">Mot de passe</label> <br>
                    <span ><?php echo (!empty($password_users_error)) ? 'is-invalid' : ''; ?></span>
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <input type="password" id="password_users" name="password_users" value="<?php echo $password_users; ?>">
                    
                    <input class="ho" type="submit" name="submit" value="Ajouter" >
                </form>
              </div>
             
            </div>
          
          </div>
     </section>
     <script src="./js/index.js"></script>
</body>
</html>