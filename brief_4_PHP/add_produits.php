<?php 
 include "cennect_data_base.php";


$titres = $categore = $quantite = $prix ="";
$titres_error = $categore_error = $quantite_error =$prix_error =$image_error = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // validation de donne
    $titres_input = trim($_POST['titres']);
    if(empty($titres_input)){
        $titres_error = "error donne nom";
    }
    else{
      $titres= $titres_input;
    }

    $categore_input = trim($_POST['categore']);
    if(empty($categore_input)){
        $categore_error = "error donne prenom";
    }
    else{
      $categore= $categore_input;
    }

    $quantite_input = trim($_POST['quantite']);
    if(empty($quantite_input)){
        $quantite_error = "error donne Utilisateur";
    }
    else{
      $quantite= $quantite_input;
    }

    $prix_input = trim($_POST['prix']);
    if(empty($prix_input)){
        $prix_error = "error donne Mot de passe";
    }
    else{
      $prix= $prix_input;
    }
    // Check extensions

    $extension = pathinfo($_FILES['image']['name']);
    
    if ($extension["extension"] == "jpg" || $extension["extension"] == "png" || $extension["extension"] == "gif") {
        $image = $_FILES['image']['name'];       
    }
    else {
      $image_error = "File is not image.";
        exit;
    }
    $post_image_temp = $_FILES['image']['tmp_name'];
    move_uploaded_file($post_image_temp, "images_product/$image");

    // Vérifier les erreurs de saisie avant d'insérer dans la base de données
      if(empty($titres_error) && empty($categore_error) && empty($quantite_error)&& empty($prix_error)&& empty($image_error))
      {
          // Préparer une déclaration d'insertion
          $sql = "INSERT INTO products (titres, categore, quantite, prix, name_image) 
                    VALUES (?, ?, ?, ?, ?)";
  
          if($stmt = mysqli_prepare($conn, $sql)){
              // Lie les variables à l'instruction préparée en tant que paramètres
              mysqli_stmt_bind_param($stmt, "ssiis", $param_titres, $param_categore, $param_quantite, $param_prix, $param_image);
  
              // Définir les paramètres
              $param_titres = $titres;
              $param_categore = $categore;
              $param_quantite = $quantite;
              $param_prix = $prix;
              $param_image = $image;
  
              // Tentative d'exécution de l'instruction préparée
          if(mysqli_stmt_execute($stmt)){
                  // Enregistrements créés avec succès. Rediriger vers la page de destination
                  header("location: produits.php");
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
} 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/add_produits.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Gestion de stocke</title>
</head>

<body>
    <header class="header_desktop">
     <img src="img/logo_1.png" alt="" class="logo">
        <nav class="navigation">
            <a href="dashboard.php"aria-label="Facebook" ><img src="img/icon/icons8-home.svg" alt=""></a>
            <a href="logout.php"aria-label="Facebook" ><img src="img/icon/logout.svg" alt=""></a>
        </nav>
    </header>
    <header class="header_mobile">
     <img src="img/logo_1.png" alt="" class="logo">
        <nav class="navigation">
            <a href="dashboard.php"aria-label="Facebook" ><img src="img/icon/icons8-home.svg" alt=""></a>
          <a href="#"  aria-label="Facebook" id="affich_menu"><img src="img/icon/menu.svg" alt=""></i></a>
        </nav>
    </header>
        <div id="my_menu">
          <a href="produits.php"aria-label="Facebook" ><img src="img/icon/book.svg" alt=""> <p> Produits</p></a>
          <a href="Employeurs.php"aria-label="Facebook" ><img src="img/icon/employer.svg" alt=""><p> Employeurs</p></a>
          <a href="logout.php"aria-label="Facebook" ><img src="img/icon/logout.svg" alt=""><p> déconection</p></a>
      </div>

    <hr>

     <section class="content">
          <a href="produits.php"aria-label="Facebook" ><img src="img/icon/book.svg" alt=""> <p> Produits</p></a>
         <a href="Employeurs.php"aria-label="Facebook" ><img src="img/icon/employer.svg" alt=""><p> Employeurs</p></a>
     </section>
     <section class="content_statistic_1">
        <div id="operation_1">
             <p>Produits</p>
        </div>
        <div id="operation_2">
            <a href="#" id="btn_ajouter" aria-label="Facebook" ><img src="img/icon/add.svg" alt=""> <p> Ajouter Produit</p></a>
        </div>
   </section>
<section class="ajouter">
        <div id="page_ajouter" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
            <a href="produits.php"  aria-label="Facebook" ><span class="close">&times;</span></a><br>
                <p>Nouvel Produit</p>

              <div class="modal-body ma_contact_child">
                <br>
                <form method="POST"  name="myform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" >
                <label for="Image">Image</label>
                <span ><?php echo (!empty($image_error)) ? 'is-invalid' : ''; ?></span>
                    <input type="file" id="Image" name="image"><br>
                     <label for="titres">Titres</label>
                     <span ><?php echo (!empty($titres_error)) ? 'is-invalid' : ''; ?></span>
                    <input type="text" id="titre" name="titres" value="<?php echo $titres; ?>">
                     <label for="Catégore">Catégore</label>
                     <span ><?php echo (!empty($categore_error)) ? 'is-invalid' : ''; ?></span>
                    <select id="Catégore" name="categore" value="<?php echo $categore; ?>">
                      <option selected="true" value="Science" > Science </option>
                      <option value="Voyager">Voyager</option>
                      <option value="Philosophie">Philosophie</option>
                      <option value="Entreprise">Entreprise</option>
                  </select>
                     <label for="Quantité">Quantité</label>
                     <span ><?php echo (!empty($quantite_error)) ? 'is-invalid' : ''; ?></span>
                    <input type="number" name="quantite" id="Quantité" min="1" value="<?php echo $quantite; ?>"><br>
                    <label for="Prix">Prix</label>
                    <span ><?php echo (!empty($prix_error)) ? 'is-invalid' : ''; ?></span>
                    <input type="number" name="prix" id="Prix" min="0" value="<?php echo $prix; ?>">
                    <input class="ho" type="submit" id="submit" value="Ajouter"  >
                </form>
              </div>
            </div>
          </div>
     </section>
     <script src="./js/index.js"></script>
</body>
</html>