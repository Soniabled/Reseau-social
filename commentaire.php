<?php
 session_start();
 include_once "db.php";
 if(isset($_GET['id'])){
$_SESSION['id_p']=$_GET['id'];
$id_p=$_SESSION['id_p'];

 $req="SELECT Nom,contenu,images FROM publication P,utilisateur U WHERE P.id_u=U.id_u and id_p=$id_p";
$result=mysqli_query($conn,$req);
if($result)
{
    if($rows=mysqli_fetch_assoc($result))
    {
        
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Chat</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
	<style>
        	body,html{
			height: 100%;
			margin: 0;
            background-color: #eeeeee
		
		}

		.chat{
			margin-top: auto;
			margin-bottom: auto;
		}
		.card{
			height: 500px;
			border-radius: 15px !important;
			background-color: rgba(0,0,0,0.4) !important;
		}
		
		.msg_card_body{
			overflow-y: auto;
		}
		.card-header{
			border-radius: 15px 15px 0 0 !important;
			border-bottom: 0 !important;
		}
	 .card-footer{
		border-radius: 0 0 15px 15px !important;
			border-top: 0 !important;
	}
		.container{
			align-content: center;
		}
		
		.type_msg{
			background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color:white !important;
			height: 60px !important;
			overflow-y: auto;
		}
			.type_msg:focus{
		     box-shadow:none !important;
           outline:0px !important;
		}
		.attach_btn{
	border-radius: 15px 0 0 15px !important;
	background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color: white !important;
			cursor: pointer;
		}
		.send_btn{
	border-radius: 0 15px 15px 0 !important;
	background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color: white !important;
			cursor: pointer;
		}
		
	
		.user_img{
			height: 70px;
			width: 70px;
			border:1.5px solid #f5f6fa;
		
		}
		.user_img_msg{
			height: 40px;
			width: 40px;
			border:1.5px solid #f5f6fa;
		
		}
	.img_cont{
			position: relative;
			height: 70px;
			width: 70px;
	}
	.img_cont_msg{
			height: 40px;
			width: 40px;
	}
	
	.user_info{
		margin-top: auto;
		margin-bottom: auto;
		margin-left: 15px;
	}
	.user_info span{
		font-size: 20px;
		color: white;
	}
	.user_info p{
	font-size: 20px;
	color: rgba(255,255,255,0.6);
	}
	
	.msg_cotainer{
		margin-top: auto;
		margin-bottom: auto;
		margin-left: 10px;
		border-radius: 25px;
		background-color: #82ccdd;
		padding: 10px;
		position: relative;
	}
	.msg_cotainer_send{
		margin-top: auto;
		margin-bottom: auto;
		margin-right: 10px;
		border-radius: 25px;
		background-color: #78e08f;
		padding: 10px;
		position: relative;
	}
	.msg_time{
		position: absolute;
		left: 0;
		bottom: -15px;
		color: rgba(255,255,255,0.5);
		font-size: 10px;
	}
	.msg_time_send{
		position: absolute;
		right:0;
		bottom: -15px;
		color: rgba(255,255,255,0.5);
		font-size: 10px;
	}
	.msg_head{
		position: relative;
	}
	
    </style>
    </head>
	<body>
		<div class="container-fluid h-100">
			<div class="row justify-content-center h-100">
				
				<div class="col-md-8 col-xl-6 chat">
					<div class="card">
						<div class="card-header msg_head">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
                                <img class="rounded-circle user_img" src="img/<?= $rows['images'] ?>" alt="" width="50rem" height="50rem">
									<span class="online_icon"></span>
								</div>
								<div class="user_info">
									<span><?= $rows['Nom']?></span>

									<p><b>Publication:</b> <?= $rows['contenu'] ?></p>
								</div>
								
						 </div>
                         <?php  
                         $idp=$_SESSION['id_p']; 
                         $req="SELECT * FROM commentaire where id_p = $idp";
                         $result=mysqli_query($conn,$req);
                         if($result)
                         {
                            while($row=mysqli_fetch_assoc($result))
                            {
                                $idu=$row['id_u'];
                                $req="SELECT * FROM utilisateur where id_u=$idu";
                         $resultat=mysqli_query($conn,$req);
                         if($resultat)
                         {
                            if($rows=mysqli_fetch_assoc($resultat))
                            {
                         
                         ?>
						<div class="card-body msg_card_body">
							<div class="d-flex justify-content-start mb-4">
								<div class="img_cont_msg">
									<img src="img/<?= $rows['images'] ?>" class="rounded-circle user_img_msg">
								</div>
                                <?php }} ?>
								<div class="msg_cotainer">
                                    <?= $row['contenuC'] ?>
									<span class="msg_time"><?= $row['dateC'] ?></span>
								</div>
							</div>
							<?php  }}}     
                            }
                         } ?>
                            <form action="commentaire.php" method="POST">
                            <div class="card-footer">
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
								</div>
								<textarea name="contenuC" class="form-control type_msg" placeholder="Type your message..."></textarea>
								<div class="input-group-append">
									<button class="input-group-text send_btn" type="submit" name="submit"><i  class="fas fa-location-arrow"></i></button>
								</div>
							</div>
                        </div>
                        </form>
						</div>
                    </div>	
				</div>
			</div>
		</div>

	</body>
</html>
<?php  
 if(isset($_SESSION['id_u']))
 {
if (isset($_POST['submit'])) {
 $contenuC = $_POST['contenuC'];
 $idu=$_SESSION['id_u'];
 $idp=$_SESSION['id_p'];
 $query = "INSERT INTO commentaire (contenuC,id_u,id_p) VALUES ('$contenuC','$idu','$idp')";
 mysqli_query($conn, $query);

 echo "Publication ajoutée avec succès !";
 header('location: accueil.php');
}
mysqli_close($conn);
 }
?>