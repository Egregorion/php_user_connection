<?php 
session_start();
//var_dump($_SESSION);
require_once 'functions.php';

if(isset($_POST) && !empty($_POST)){
    $email = $_POST['email'];
    $password = $_POST['password'];
    login($email, $password);
    if($_SESSION['user']){
        header('location:index.php?message=Vous êtes connecté&status=success');
    }else{
        header('location:index.php?message=mauvais identifiants&status=danger');
    }
}
?> 

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <?php if(isset($_GET['message'])&& !empty($_GET['message'])){?>
        <div class="alert alert-<?php echo $_GET['status']?> alert-dismissible fade show" role="alert">
            <strong><?php echo $_GET['message'] ?>!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php } ?>
        <h1 class="text-center">Connexion utilisateur</h1>
        <form action="" method="post" class="text-center">
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <input class="mt-3" type="submit" value="se connecter">
        </form>
        <?php if($_SESSION['user']){?>
            <a href="logout.php">Se déconnecter</a>
        <?php } ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>