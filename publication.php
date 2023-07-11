<?php
    session_start();
    include_once "db.php";
    if(isset($_SESSION['id_u']))
    {
if (isset($_POST['publier'])) {
    $contenu = $_POST['contenu'];
    $media = $_FILES['media']['name'];
    $dest = "img/".$media;
    $idu=$_SESSION['id_u'];
    move_uploaded_file($_FILES['media']['tmp_name'],$dest);

    $query = "INSERT INTO publication (contenu, media,id_u) VALUES ('$contenu', '$media','$idu')";
    mysqli_query($conn, $query);

    echo "Publication ajoutée avec succès !";
    header('location: accueil.php');
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barre de navigation</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"><title>Page d'accueil - Fil d'actualités</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
    <style>
    .navbar {
            background-color: red;
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
                <a class="nav-link me-3" href="accueil.php">Accueil
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link me-3" href="profil.php">Mon compte
                </a>
            </li>
        </ul>
    </div>
</nav>
 

<div class="container justify-content-center">
  <div>
    <h5 class="card-title">Ajouter une publication</h5>
  </div>
    <div class="card">
  <div class="card-body">
    <form method="POST" action="publication.php" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="contenu" class="form-label">Contenu</label>
        <textarea class="form-control" id="contenu" name="contenu" rows="3" required></textarea>
      </div>
      <div class="mb-3">
        <label for="media" class="form-label">Média</label>
        <input type="file" class="form-control" id="media" name="media">
      </div>
      <button type="submit" class="btn btn-primary" name="publier">Publier</button>
    </form>
  </div>
</div>                           
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php }

?>
