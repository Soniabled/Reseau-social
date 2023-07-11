<?php
session_start();
require_once ('db.php');

$req="SELECT * FROM publication";
$result=mysqli_query($conn,$req);
if($result)
{
    if($rows=mysqli_fetch_assoc($result))
    {

if(isset($_SESSION['id_u']))
{
    $id_u=$_SESSION['id_u'];
    $req="SELECT * FROM utilisateur where id_u='$id_u'";
    $result=mysqli_query($conn,$req);
   if($result)
   {
    if($row=mysqli_fetch_assoc($result))
    {

?>

<!DOCTYPE html>
<html>
<head>
    <title>Barre de navigation - Réseau social</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
        crossorigin="anonymous">
        
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

    <!DOCTYPE html>
<html>
<head>
    <title>Réseau social</title>
    <style>
        body {
            background-color: #eeeeee;
        }

        .h7 {
            font-size: 0.8rem;
        }

        .gedf-wrapper {
            margin-top: 0.97rem;
        }

        @media (min-width: 992px) {
            .gedf-main {
                padding-left: 4rem;
                padding-right: 4rem;
            }
            .gedf-card {
                margin-bottom: 2.77rem;
            }
        }

        .dropdown-toggle::after {
            content: none;
            display: none;
        }

        /* Updated styles for the navigation bar */
        .navbar {
            background-color: white;
            color: black;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar .navbar-brand,
        .navbar .nav-link {
            color: black;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand navbar-light bg-white">
    <a href="#" class="navbar-brand">Réseau Social</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav justify-content-around">
            <li class="nav-item">
                <a class="nav-link me-3" href="accueil.php">
                    Accueil
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link me-3" href="amis.php">Amis
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link me-3" href="publication.php">Publier
                </a>
            </li>
        
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false"> Mon compte
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="profil.php">Profil
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="deconnexion.php">Déconnexion</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>


<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-push-6"> 
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Profil de <?= $row['Nom'] ?></h3>
                    </div>
                    <div class="panel-body">

                       <div class="row">
                        <div class="col-md-5">
                       <img src="img/<?= $row['images'] ?>" alt="<?= $row['Nom'] ?>" class="rounded-circle" width="200px" height="200px">
                        </div>
            
                       </div>
                       <?= $row['Nom'] ?> <br>
                       <?= $row['Prenom'] ?> <br>
                       <?= $row['dateN'] ?> <br>
                       <?= $row['pays'] ?> <br>
                       <?= $row['sexe'] ?> <br>
                       <?= $row['mail'] ?> <br>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-md-pull-6"> 
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Modifier mon Profil</h3>
                    </div>

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="panel-body">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prenom"> Nom</label>
                                    <input type="text" name="nom" value=" <?= $row['Nom'] ?>"  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prenom"> Prenom</label>
                                    <input type="text" value=" <?= $row['Prenom'] ?>" name="prenom" class="form-control">
                                </div>
                               
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Date de Naissance </label>
                                    <input type="date" name="dateN"  value=" <?= $row['dateN'] ?>" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Lieu">Pays</label>
                                    <input type="text" name="pays"  value=" <?= $row['pays'] ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                                            <div class="maxl">
                                                <label class="radio inline"> 
                                                    <input type="radio" name="sexe" value="homme" checked>
                                                    <span> Homme </span> 
                                                </label>
                                                <label class="radio inline"> 
                                                    <input type="radio" name="sexe" value="femme">
                                                    <span>Femme </span> 
                                                </label>
                                            </div>
                                        </div>
                                <div class="col-mb-6">
                    <label  class="form-label">photo de profil</label> <br>
                    <input type="file" class="form-control" name="photo">
                    </div>
                    <br>
                    <br>
                </div>
                <a href="accueil.php">
                <button class="btn btn-success" type="submit" id="" name="modifier">Modifier</button></a>
<br>
            </div>
        </div>
    </div>
</form>
</div>
</div>


<div class="container-fluid gedf-wrapper">
    <div style="max-width: 1000px;">
                    <div class="btn-toolbar justify-content-between">
                <div class="card gedf-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                <img class="rounded-circle" src="img/<?= $row['images'] ?>" alt="" width="50rem" height="50rem">
                                </div>
                                <div class="ml-2">
                                    <div class="h5 m-0"><?= $row['Nom']?></div>
                                    <div class="h7 text-muted"><?= $row['Prenom'] ?></div>
                                </div>
                            </div>
                            <div>
                                <div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                        <div class="h6 dropdown-header">Publication</div>
                                        <a class="dropdown-item" href="#">identifier la photo</a>
                                        <a class="dropdown-item" href="#">sauvegarder</a>
                                        <a class="dropdown-item" href="#">copier le lien</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php  }?> 
                    <div class="card-body">
                        <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>Publier le: <?= $rows['datep']; ?></div>
                        

                        <p class="card-text"><?= $rows['contenu']; ?></p>
    
                        <div>
                        <img class="" src="img/<?= $rows['media'] ?>" alt="" width="600px" height="300px">
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="card-link"><i class="fa fa-gittip"></i> J'aime</a>
                        <a href="commentaire.php?id=<?= $rows['id_p']; ?>" class="card-link"><i class="fa fa-comment"></i> Commenter</a>
                        <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Partager</a>
                    </div>
                </div>
                <?php }}}} ?>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php   


if(isset($_POST['modifier']))
{
    $id_u = $_SESSION['id_u'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $pays = $_POST['pays'];
    $dateN = $_POST['dateN'];
    $sexe = $_POST['sexe'];
    $photo = $_FILES['photo']['name'];
    $dest = "img/".$photo;
    move_uploaded_file($_FILES['photo']['tmp_name'],$dest);
    
    $query = "UPDATE `utilisateur` SET Nom ='$nom' , Prenom ='$prenom' , images ='$photo' , pays ='$pays', dateN ='$dateN' , sexe ='$sexe' where id_u ='$id_u'";
    mysqli_query($conn, $query);

    
}

?>