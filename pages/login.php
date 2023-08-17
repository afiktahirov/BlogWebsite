<?php

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["register"])) {
    $username = $_POST["username"];
    $name = $_POST["name"]." ".$_POST["lastname"];
    $lastname = $_POST["lastname"];
    $password = $_POST["password"];
    $gender = $_POST["gender"];
    $age = $_POST["age"];
    $country = $_POST["country"];
    

    if(empty($username) || empty($name) || empty($lastname) || empty($gender) || empty($age) || empty($country)) {
        $error = 'Məlumatlar tam şəkildə doldurulmalıdır!';
    } else {
        if (strlen($username) < 3) {
            $error = 'İstifadəçi adı ən azı 3 simvol olmalıdır.';
        }

        if (empty($error)) {
            $hash_password = password_hash($password,PASSWORD_DEFAULT);
            $stmt =$db->prepare("INSERT INTO users (username,name,password,gender,country) VALUES(?,?,?,?,?)");
            $stmt->execute([$username,$name,$hash_password,$gender,$country]);
        }
    }
}

if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["login"])){
        $user_name = htmlspecialchars($_POST["user_login"]);
        $user_password = $_POST["user_password"];
        $stmt = $db->prepare("SELECT * FROM users WHERE username=?");
        $stmt->execute([$user_name]);
        

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
         
       if ($result !== false) {
        $hash_password = $result["password"];
        
        if (password_verify($user_password, $hash_password)) {
            if($result["is_blocked"]==1){
                include "blockPage.php";
                exit;
            }
            $_SESSION["username"] = $result["username"]; 
            $_SESSION["name"] = $result["name"];
            $_SESSION["gender"] = $result["gender"]==1?"Kişi":"Qadın";
            $_SESSION["country"] = $result["country"];
            $_SESSION["photo"] = $result["photo"];
            $_SESSION["user_id"] =$result["id"];
            header("Location:http://localhost/social%20M/index.php?timeline");
        } else {
            echo "Istifadəçi adı və ya şifrə düzgün deyil.";
        }
    } else {
        echo "İstifadəçi tapılmadı";
    }

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
 body {
  margin: 0;
  padding: 0;
  background-color: #17a2b8;
  height: 100vh;
}
#login .container #login-row #login-column #login-box {
  margin-top: 120px;
  max-width: 600px;
  height: 320px;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}
    </style>
    <title>Login Page</title>
</head>
<body>
    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Giriş</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">İstifadəçi adı:</label><br>
                                <input type="text" name="user_login" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Şifrə:</label><br>
                                <input type="text" name="user_password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Yadda saxla</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" name="login" class="btn btn-info btn-md" value="Giriş et">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="http://localhost/social%20M/index.php?register" class="text-info">Qeydiyyatdan Keç</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>



