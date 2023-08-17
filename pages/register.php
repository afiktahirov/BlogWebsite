<?php

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["register"])) {
    $username = htmlspecialchars($_POST["username"]);
    $name =  htmlspecialchars($_POST["name"]." ".$_POST["lastname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $password = $_POST["password"];
    $gender = htmlspecialchars($_POST["gender"]);
    $age = htmlspecialchars($_POST["age"]);
    $country = htmlspecialchars($_POST["country"]);
    

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
?>
<style>
      .back-button {
        position: fixed;
        bottom: 250px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 99;
        display: block;
        width: 370px;
        padding: 10px;
        text-align: center;
        background-color: #17a2b8;
        color: #fff;
        border-radius: 5px;
        text-decoration: none;
    }

    .back-button:hover {
        background-color: #138496;
    }
    .signup-inner--form {
        height: 600px; 
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
</style>
<div class="timeline-page-wrapper">
    <div class="container-fluid p-0">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6">
                <div class="signup-form-wrapper">
                    <h1 class="create-acc text-center">İstifadəçi Yarat</h1>
                    <div class="signup-inner text-center">
                        <h3 class="title">Adda Xoş Gəlmisiniz.</h3>
                        <form class="signup-inner--form" method="POST">
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" class="single-field" name="username" placeholder="İstifadəçi Adı">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="single-field" name="name" placeholder="Adınız">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="single-field" name="lastname" placeholder="Soyadınız">
                                </div>
                                <div class="col-12">
                                    <input type="password" class="single-field" name="password" placeholder="Şifrə">
                                </div>
                                <div class="col-md-6">
                                    <select class="nice-select" name="gender">
                                        <option value="trending">Cins</option>
                                        <option value=1>Kişi</option>
                                        <option value=2>Qadın</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select class="nice-select" name="age">
                                        <option value="trending">Yaş</option>
                                        <option value="18+" name="age">18+</option>
                                        <option value="18-" name="age">18-</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <select class="nice-select" name="country">
                                        <option value="trending">Ölkə</option>
                                        <option value="Azərbaycan">Azərbaycan</option>
                                        <option value="Rusya">Rusya</option>
                                        <option value="Türkiyə">Türkiyə</option>
                                        <option value="Gürcüstan">Gürcüstan</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <?php if(!empty($error)):?>
                                        <div class="error-message text-danger">
                                            <?php echo $error; ?>
                                        </div>
                                    <?php endif;?>
                                    <button class="submit-btn" name="register">Qeydiyyatdan Keç</button>
                                    <div class="col-12 mt-3">
                                         <a href="http://localhost/social%20M/index.php" class="back-button">Geri</a>
                                    </div>
                                </div>
                               
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


