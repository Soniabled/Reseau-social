<?php
include 'db.php';

$req="SELECT * FROM publication";
$result=mysqli_query($conn,$req);
if($result)
{

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <a class="nav-link me-3" href="connexion.php">Connexion
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link me-3" href="inscrire.php">Inscription
                </a>
            </li>
        </ul>
    </div>
</nav>



    <?php while($row=mysqli_fetch_assoc($result))
{
    $idu=$row['id_u'];

    $re = "SELECT * FROM utilisateur WHERE id_u = '$idu'";
    $resultat=mysqli_query($conn,$re);
        if($resultat)
    {
        if($rows=mysqli_fetch_assoc($resultat))
{

 ?>
 <div class="container">
<div class="container-fluid gedf-wrapper">
    <div style="max-width: 1000px;">
                    <div class="btn-toolbar justify-content-between">
                <div class="card gedf-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                <img class="rounded-circle" src="img/<?= $rows['images'] ?>" alt="" width="50rem" height="50rem">
                                </div>
                                <div class="ml-2">
                                    <div class="h5 m-0"><?= $rows['Nom']?></div>
                                    <div class="h7 text-muted"><?= $rows['Prenom'] ?></div>
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
                        <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>Publier le: <?= $row['datep']; ?></div>
                        

                        <p class="card-text"><?= $row['contenu']; ?></p>
    
                        <div>
                        <img class="" src="img/<?= $row['media'] ?>" alt="" width="600px" height="300px">
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="card-link"><i class="fa fa-gittip"></i> J'aime</a>
                        <a class="card-link"><i class="fa fa-comment"></i> Commenter</a>
                        
                        <a class="card-link"><i class="fa fa-mail-forward"></i> Partager</a>
                    </div>
                </div>
                    </div>
                <?php }}} ?>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
               