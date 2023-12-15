<?php 

function dbconnect(){
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=security_demo', 'root', '');
        return $pdo;
    }catch(PDOException $e){
        echo 'ça marche pas';
    }
}

function login($email, $password) { 
    $dbh = dbconnect();
    $stmt = $dbh->prepare("SELECT * FROM users WHERE users.email= :toto"); // au lieu d'exécuter la requête directement comme avec query(), on va la préparer avec prepare() 
    $stmt->bindParam(':toto', $email);// on définit à quelle variable va être affecté le marqueur :toto qu'on a utiliser dans la préparation de la requête
    $stmt->execute();//on exécute la requête pour de vrai 
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    //var_dump($user);
    if($user){
        //comparaison du pass saisi avec celui de la bdd
        if(password_verify($password, $user['password'])){
            //echo 'utilisateur connecté';
            session_start();
            $_SESSION['user'] = [
                'id' => $user['id_user'],
                'email' => $user['email']
            ];
        }else{
            echo 'mauvais mot de passe';
        }
    }else{
        echo 'adresse email inconnue';
    }
}

function signup($email, $password) {
    $dbh = dbconnect();
    $stmt = $dbh->prepare("SELECT * FROM users WHERE users.email= :toto"); // au lieu d'exécuter la requête directement comme avec query(), on va la préparer avec prepare() 
    $stmt->bindParam(':toto', $email);// on définit à quelle variable va être affecté le marqueur :toto qu'on a utiliser dans la préparation de la requête
    $stmt->execute();//on exécute la requête pour de vrai 
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    //var_dump($user);
    if($user){
        echo 'Adresse mail déjà utilisée';
    } else {
        $stmt = $dbh->prepare("INSERT INTO users VALUES (null, :email, :password)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
    }    
    
} 

function secure_email($email) {
    $sanitize = filter_var($email, FILTER_SANITIZE_EMAIL);
    //var_dump($sanitize);
    $validate = filter_var($sanitize, FILTER_VALIDATE_EMAIL);
    //var_dump($validate);
    if($validate){
        return $validate;
    } 
}


