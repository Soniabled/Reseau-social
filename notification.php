<?php
session_start();
include 'db.php';
if (!$conn) {
    die("Connexion échouée : " . mysqli_connect_error());
}

$sql = "SELECT publication.id_p, publication.contenu, COUNT(likes.id_l) AS nb_l, COUNT(commentaire.id_c) AS nb_c
        FROM publication
        LEFT JOIN likes ON publication.id_p = likes.id_p
        LEFT JOIN commentaire ON publication.id_p = commentaire.id_p
        GROUP BY publication.id_p";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $publicationId = $row['id_p'];
        $contenu = $row['contenu'];
        $nbLikes = $row['nb_l'];
        $nbCommentaires = $row['nb_c'];

        $liked = false;
        if (isset($_SESSION['utilisateur_id'])) {
            $userId = $_SESSION['utilisateur_id'];
            $query = "SELECT COUNT(*) AS count FROM likes WHERE id_u = '$userId' AND id_p = '$publicationId'";
            $likeResult = mysqli_query($conn, $query);
            $likeRow = mysqli_fetch_assoc($likeResult);
            if ($likeRow['count'] > 0) {
                $liked = true;
            }
        }

        

mysqli_close($conn);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Barre de navigation - Réseau social</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
    <style>
        .navbar-custom {
            background-color: #2C3E50; /* Couleur d'arrière-plan personnalisée */
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #ffffff; /* Couleur du texte */
        }

        .navbar-custom .nav-link:hover {
            color: #ffffff; /* Couleur du texte au survol */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="#">Réseau social</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="accueil.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="amis.php">Amis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="parametres.php">Paramètres</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Mon compte
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="deconnexion.php">Deconnexion</a></li>
                        <li><a class="dropdown-item" href="connexion.php">Connexion</a></li>
                        <li><a class="dropdown-item" href="inscrire.php">Inscription</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="moncompte.php">Mon compte</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php

echo '<div class="card">
                <div class="card-body">
                    <p class="card-text">' . $contenu . '</p>

                    <button class="btn btn-primary like-btn" data-publication="' . $publicationId . '" data-liked="' . ($liked ? '1' : '0') . '">'.$nbLikes.'

                        ' . ($liked ? 'Je n\'aime pas' : 'J\'aime') . '
                    </button>
                    <textarea class="form-control comment-input" placeholder="Commenter"></textarea>
                    <button class="btn btn-secondary btn-comment" data-publication="' . $publicationId . '">'.$nbCommentaires.' Commenter</button>
                </div>
            </div>';
    }
} else {
    echo "Aucune publication trouvée.";
}
?>
<script>
$(document).ready(function() {
    // Action d'aimer une publication
    $(".like-btn").click(function() {
        var publicationId = $(this).data("publication");
        var liked = $(this).data("liked");

        // Envoyer la requête AJAX
        $.ajax({
            url: "accueil.php",
            type: "POST",
            data: { 
                action: "like",
                publicationId: publicationId,
                liked: liked
            },
            success: function(response) {
                // Mettre à jour l'interface utilisateur
                if (liked == 1) {
                    $(this).data("liked", 0);
                    $(this).text("J'aime");
                } else {
                    $(this).data("liked", 1);
                    $(this).text("Je n'aime pas");
                }
            }
        });
    });

    // Action de commenter une publication
    $(".comment-btn").click(function() {
        var publicationId = $(this).data("publication");
        var commentaire = $(this).prev(".comment-input").val();

        // Envoyer la requête AJAX
        $.ajax({
            url: "traitement.php",
            type: "POST",
            data: { 
                action: "comment",
                publicationId: publicationId,
                commentaire: commentaire
            },
            success: function(response) {
                // Réinitialiser la zone de commentaire
                $(this).prev(".comment-input").val("");

                // Mettre à jour l'interface utilisateur pour afficher le nouveau commentaire
                // ...
            }
        });
    });
});
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
<?php
if (!$conn) {
    die("Connexion échouée : " . mysqli_connect_error());
}

// Vérifier l'action à effectuer
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    // Action d'aimer une publication
    if ($action == 'id_l') {
        $publicationId = $_POST['id_P'];
        $liked = $_POST['id_l'];

        // Vérifier si l'utilisateur a déjà aimé cette publication
        if ($liked == 0) {
            // Ajouter un j'aime
            $query = "INSERT INTO likes (id_p, id_u) VALUES ('$publicationId', '$userId')";
            mysqli_query($conn, $query);
        } else {
            // Supprimer le j'aime
            $query = "DELETE FROM likes WHERE id_p = '$publicationId' AND id_u = '$userId'";
            mysqli_query($conn, $query);
        }
    }
}

   