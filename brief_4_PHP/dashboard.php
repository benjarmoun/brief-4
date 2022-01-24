<?php 

if(isset($_SESSION["login"]) && $_SESSION["login"] === true){
    header("location: dashboard.php");
    exit;
}
include "cennect_data_base.php";
$reading_data ="SELECT * FROM  products";
$reading_data_employe   ="SELECT * FROM  employe";
$result = mysqli_query($conn, $reading_data);
$result_1 = mysqli_query($conn, $reading_data_employe);
$row_cnt = 1;
if (!$result) { 
    die( "erreur de connexion ".mysqli_errno($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">
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
          <a href="produits.php"aria-label="Facebook" ><img src="img/icon/book.svg" alt=""> <p>Produits</p></a>
          <a href="Employeurs.php"aria-label="Facebook" ><img src="img/icon/employer.svg" alt=""><p>Employeurs</p></a>
          <a href="logout.php"aria-label="Facebook" ><img src="img/icon/logout.svg" alt=""><p>Déconection</p></a>
      </div>

    <hr>

     <section class="content">
          <a href="produits.php"aria-label="Facebook" ><img src="img/icon/book.svg" alt=""> <p>Produits</p></a>
         <a href="Employeurs.php"aria-label="Facebook" ><img src="img/icon/employer.svg" alt=""><p>Employeurs</p></a>
     </section>
     <section class="content_statistic_1">
          <div id="card_1" class="card_statistic ">
               <h3> <?php echo mysqli_num_rows($result); ?></h3>
               <p>Produits</p>
          </div>

          <div id="card_3" class="card_statistic">
               <h3><?php echo mysqli_num_rows($result_1); ?></h3>
               <p>Employeurs</p>
          </div>
     </section>
     <section class="content_statistic_2">
          <div    class="statistic_table">
               <p>Top 5 des livres les plus vendus</p>
               <div style="overflow-x:scroll;">
               <table>
                    <thead>
                    <tr>
                         <th>#</th>
                        <th>titres</th>
                        <th>quantité</th>
                        <th>Catégore</th>
                        <th>Prix</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(mysqli_num_rows($result)>0): ?>
                    <?php while ($product = mysqli_fetch_array($result)) { ?>
                        <?php if($row_cnt <6): ?>
                     <tr>
                         <td><?php echo$product['id'] ; ?></td>
                         <td><?php echo$product['titres'] ; ?></td>
                         <td><?php echo$product['quantite'] ; ?></td>
                         <td><?php echo$product['categore'] ; ?></td>
                         <td><?php echo$product['prix'] ; ?> DH</td>
                     </tr>
                     <?php $row_cnt++ ; ?>
                     <?php endif ; ?>
                     <?php 
                    }?>
                    <?php endif ; ?>
                     </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
          </div>
     </section>
     <script src="./js/index.js"></script>
</body>
</html>