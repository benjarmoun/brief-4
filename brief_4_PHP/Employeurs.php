<?php include "cennect_data_base.php";

$reading_data ="SELECT * FROM  employe";
$result = mysqli_query($conn, $reading_data);
if (!$result) {
    echo "khata2  hna kayn ".mysqli_errno($conn);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet"  href="./css/Employeurs.css"/>
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
            <a href="index.php"aria-label="Facebook" ><img src="img/icon/icons8-home.svg" alt=""></a>
          <a href="index.php"  aria-label="Facebook" id="affich_menu"><img src="img/icon/menu.svg" alt=""></i></a>
        </nav>
    </header>
    
        <div id="my_menu">
          <a href="produits.php"aria-label="Facebook" ><img src="img/icon/book.svg" alt=""> <p> Produits</p></a>
          <a href="Employeurs.php"aria-label="Facebook" ><img src="img/icon/employer.svg" alt=""><p> Employeurs</p></a>
          <a href="logout.php"aria-label="Facebook" ><img src="img/icon/logout.svg" alt=""><p> déconection</p></a>
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
            <a href="add_Employeurs.php" id="btn_ajouter" aria-label="Facebook" ><img src="img/icon/add.svg" alt=""> <p> Ajouter Employeur</p></a>
        </div>
   </section>

  <section class="content_statistic_2">
          <div    class="statistic_table">
               <div>
               <table>
                    <thead>
                    <tr>
                         <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Utilisateur</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (mysqli_num_rows($result)>0): ?>
    <?php 
    while ($users = mysqli_fetch_array($result)) {
    ?>
                     <tr>
                         <td><?php echo $users['id']; ?></td>
                         <td><?php echo $users['firstname']; ?></td>
                         <td><?php echo$users['lastname'] ; ?></td>
                         <td><?php echo $users['username']; ?></td>
                         <td id="action">
                           <a href="view_Employeurs.php?id=<?php echo $users['id']; ?>"><img src="img/icon/views.svg"></a>
                           <a href="delet_Employeurs.php?id=<?php echo $users['id']; ?>"><img src="img/icon/delete.png"></a>
                           <a href="edit_Employeurs.php?id=<?php echo $users['id']; ?>"><img src="img/icon/edit.png"></a>
                        </td>
                     </tr>
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