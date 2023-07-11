<?php
session_start();
include "db.php";
if(isset($_GET['t'],$_GET['id'],$_SESSION['id_u']) AND !empty($_GET['t']) AND !empty($_GET['id']))
{
    $idu=$_SESSION['id_u'];
    $code= $_GET['id'];
    $t= $_GET['t'];
    $req="SELECT * FROM publication where id_p= $code";
    var_dump($req);
    $resultat=mysqli_query($conn,$req);
    if($resultat)
    {
    if($row=mysqli_fetch_assoc($resultat))
{
       if($t==1)
        $req="SELECT id_p FROM likes where id_u=$idu AND id_p=$code";
        $result=mysqli_query($conn,$req);
        if($row=mysqli_fetch_assoc($result))
        {
          $req="DELETE FROM likes where id_u=$idu AND id_p=$code";
          $resultat=mysqli_query($conn,$req);
            header("location:accueil.php");
        }
        else{
          $req="INSERT INTO likes (id_u,id_p) VALUES('$idu','$code')";
          $resultat=mysqli_query($conn,$req);
          var_dump($req);
            header("location:accueil.php");
        }
    
}
}
}
else{
    echo "erreur";
//   header("location:accueil.php");
}
