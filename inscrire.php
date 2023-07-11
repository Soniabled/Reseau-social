<?php
session_start();
include 'db.php';

if (isset($_POST['inscrire'])) {
  $name = $_POST['nom'];
  $donner= $name. " ; "."\n";
  if (file_exists("fichierins.txt") && is_file("fichierins.txt")) {
      $fichier=fopen("fichierins.txt","a");
      fwrite($fichier,$donner);
      fclose($fichier);
  }else{
      $fichier=fopen("fichierins.txt","a");
  }
}

if (isset($_POST['inscrire'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $pays = $_POST['pays'];
    $dateN = $_POST['dateN'];
    $sexe = $_POST['sexe'];
    $motdp= $_POST['motdp'];
    $photo = $_FILES['photo']['name'];
    $dest = "img/".$photo;
    move_uploaded_file($_FILES['photo']['tmp_name'],$dest);
    $query = "SELECT * FROM utilisateur WHERE mail = '$mail'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
      echo "L'email est déjà utilisé, veuillez en choisir un autre.";
    } else {

    $hashedPassword = password_hash($motdp, PASSWORD_DEFAULT);

    $query = "INSERT INTO `utilisateur`(`Nom`, `Prenom`, `images`, `pays`, `dateN`, `sexe`, `mail`, `motdp`) VALUES ('$nom','$prenom','$photo','$pays','$dateN','$sexe','$mail','$hashedPassword')";
    mysqli_query($conn, $query);

    echo "Inscription réussie !";

    header('location: accueil.php');
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<style>
.register{
    background: -webkit-linear-gradient(left, #3931af, #00c6ff);
    margin-top: 3%;
    padding: 3%;
}
.register-left{
    text-align: center;
    color: #fff;
    margin-top: 4%;
}
.register-left input{
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    width: 60%;
    background: #f8f9fa;
    font-weight: bold;
    color: #383d41;
    margin-top: 30%;
    margin-bottom: 3%;
    cursor: pointer;
}
.register-right{
    background: #f8f9fa;
    border-top-left-radius: 10% 50%;
    border-bottom-left-radius: 10% 50%;
}
.register-left img{
    margin-top: 15%;
    margin-bottom: 5%;
    width: 25%;
    -webkit-animation: mover 2s infinite  alternate;
    animation: mover 1s infinite  alternate;
}
@-webkit-keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
@keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
.register-left p{
    font-weight: lighter;
    padding: 12%;
    margin-top: -9%;
}
.register .register-form{
    padding: 10%;
    margin-top: 10%;
}
.btnRegister{
    float: right;
    margin-top: 10%;
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    background: #0062cc;
    color: #fff;
    font-weight: 600;
    width: 50%;
    cursor: pointer;
}
.register .nav-tabs{
    margin-top: 3%;
    border: none;
    background: #0062cc;
    border-radius: 1.5rem;
    width: 28%;
    float: right;
}
.register .nav-tabs .nav-link{
    padding: 2%;
    height: 34px;
    font-weight: 600;
    color: #fff;
    border-top-right-radius: 1.5rem;
    border-bottom-right-radius: 1.5rem;
}
.register .nav-tabs .nav-link:hover{
    border: none;
}
.register .nav-tabs .nav-link.active{
    width: 100px;
    color: #0062cc;
    border: 2px solid #0062cc;
    border-top-left-radius: 1.5rem;
    border-bottom-left-radius: 1.5rem;
}
.register-heading{
    text-align: center;
    margin-top: 8%;
    margin-bottom: -15%;
    color: #495057;
}
</style>
    
</head>
<body>
    <form action="inscrire.php" method="POST" enctype="multipart/form-data">
<div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <img src="img/reseau.jpg" alt="reseau.jpg" width="100px">
                        <h3>Welcome</h3>
                        <input type="submit" name="" value="Inscription"/><br/>
                    </div>
                    <div class="col-md-9 register-right">
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Bienvenu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"></a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">INSCRIPTION</h3>
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Nom *" name="nom" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Prenom *" name="prenom" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Password *" name="motdp" />
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
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email *" name="mail" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text"   name="pays" class="form-control" placeholder="Pays *" value="" />
                                        </div>
                                        
                                        <div class="form-group">
                                        <input type="file" class="form-control" placeholder=""  name="photo" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="date"  name="dateN" class="form-control" placeholder="Date de naissance *" value="" />
                                        </div>
                                   
                                
                                        <button type="submit" class="btnRegister" name="inscrire">Inscrire</button>
                                    </div>
                                    
                                </div>
                            
                        </div>
                    </div>
                </div>

            </div>
</form>
</body>
</html>