<?php


// $error='';
// $fullName = $_SESSION["name"];
$username = $_SESSION["username"];
// $location = $_SESSION["country"];
// $firstName = explode(" ", $fullName)[0];
// $lastName = explode(" ", $fullName)[1];

$stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if($result["is_blocked"]==1){
    include "blockPage.php";
    exit;
}

$firstName = explode(" ", $result["name"])[0];
$lastName = explode(" ", $result["name"])[1];
$location = $result["country"];
$username = $result["username"];
$photo = $result["photo"];
$email = $result["email"];
$phone = $result["phone"];
$bio = $result["bio"];
$age= $result["age"];


$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["save"])) {
    $u_fristName = htmlspecialchars($_POST["surname"]);
    $u_lastName = htmlspecialchars($_POST["lastname"]);
    $u_fullname = $u_fristName. " " . $u_lastName;
    $u_bio = htmlspecialchars($_POST["bio"]);
    $u_country = htmlspecialchars($_POST["country"]);
    $u_email =  htmlspecialchars($_POST["email"]);
    $u_phone = htmlspecialchars($_POST["phone"]);
    $u_age = $_POST["age"];

    
    if (strlen($u_fristName)<3) {
        $error = "Ad düzgün deyil.";
    } elseif (strlen($u_lastName) < 3) {
        $error = "Soyad düzgün deyil.";
    }  elseif (strlen($u_country)<3) {
        $error = "Ölkə düzgün seçilməyib.";
    }  elseif (strlen($u_age)<3) {
        $error = "Doğum tarixiniz düzgün deyil.";
    }
    if (empty($error)) {
        $stmt = $db->prepare("UPDATE users SET name=?, bio=?, country=?, email=?, phone=?, age=? WHERE username=?");
        $stmt->execute([$u_fullname, $u_bio, $u_country, $u_email, $u_phone, $u_age, $username]);
        

     if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
        $file_name = $_FILES["photo"]["name"];
        $file_size = $_FILES["photo"]["size"];
        $file_tmp = $_FILES["photo"]["tmp_name"];
        $file_type = $_FILES["photo"]["type"];

        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_extensions = array("jpg", "jpeg", "png");

         if (in_array($file_ext, $allowed_extensions)) {
            $target_dir = "user_images/";
            $target_file = $target_dir . basename($file_name);

            
            $max_file_size = 5.89 * 1024 * 1024; // 5 MB
            if ($file_size <= $max_file_size) {
                if (move_uploaded_file($file_tmp, $target_file)) {
                    $stmt = $db->prepare("UPDATE users SET photo=? WHERE username=?");
                    $stmt->execute([$target_file, $username]);
                   



                } else {
                    $error = "Fayl yükleme xətası.";
                }
            } else {
                $error = "Fayl maksimum 5 MB olmalıdır.";
            }
         } else {
            $error = "Dəstəklənməyən Fayl ancaq (JPG, JPEG ve PNG) olmalıdır.";
         }
    }
     if(isset($_POST["save"])){
        echo "Yaddasa Yazildi";
        header("Location: http://localhost/social%20M/index.php?settings");
     }
    }

    


}
?>

<style>

body{margin-top:20px;
background-color:#f2f6fc;
color:#69707a;
}
.img-account-profile {
    height: 10rem;
}
.rounded-circle {
    border-radius: 50% !important;
}
.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
}
.card .card-header {
    font-weight: 500;
}
.card-header:first-child {
    border-radius: 0.35rem 0.35rem 0 0;
}
.card-header {
    padding: 1rem 1.35rem;
    margin-bottom: 0;
    background-color: rgba(33, 40, 50, 0.03);
    border-bottom: 1px solid rgba(33, 40, 50, 0.125);
}
.form-control, .dataTable-input {
    display: block;
    width: 100%;
    padding: 0.875rem 1.125rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1;
    color: #69707a;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #c5ccd6;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.35rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.nav-borders .nav-link.active {
    color: #0061f2;
    border-bottom-color: #0061f2;
}
.nav-borders .nav-link {
    color: #69707a;
    border-bottom-width: 0.125rem;
    border-bottom-style: solid;
    border-bottom-color: transparent;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    padding-left: 0;
    padding-right: 0;
    margin-left: 1rem;
    margin-right: 1rem;
}
</style>
<script>
    function showSelectedImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                document.getElementById('profileImage').src = e.target.result;
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link active ms-0" href="https://www.bootdey.com/snippets/view/bs5-edit-profile-account-details" target="__blank">Profile</a>
        <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-profile-billing-page" target="__blank">Billing</a>
        <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-profile-security-page" target="__blank">Security</a>
        <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-edit-notifications-page"  target="__blank">Notifications</a>
    </nav>
    <form method="POST"  action="" enctype="multipart/form-data">
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profil Şəkli</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img id="profileImage" class="img-account-profile rounded-circle mb-4 width-200" src="<?=$photo?>" alt="" style="max-width: 200px; max-height: 200px;">
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG və ya PNG max 5 MB ola bilər!</div>
                    <!-- Profile picture upload button-->
                    <button class="btn btn-primary" type="button" onclick="document.getElementById('inputPhoto').click()">Şəkli dəyiş</button>
                    <input class="form-control-file d-none" id="inputPhoto" type="file" name="photo" onchange="showSelectedImage(this)">
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">İstifadəçi Məlumatları</div>
                <div class="card-body">
                    
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">İstifadəçi adı (istifadəçi adı dəyişdirilə bilməz!!)</label>
                            <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="<?=$username?>" readonly>
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                          <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Adınız <span class="text-danger">*</span></label>
                                <input class="form-control <?php if(strlen($error)>0 && (empty($u_fristName) || strlen($u_fristName) < 3)) echo 'is-invalid'; ?>" id="inputFirstName" type="text" name="surname" placeholder="Adinizi giriniz." value="<?=$firstName?>">
                                <?php if(strlen($error)>0 && (empty($u_fristName) || strlen($u_fristName) < 3)) echo '<div class="invalid-feedback">'.$error.'</div>'; ?>
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Soyadınız <span class="text-danger">*</span></label>
                                <input class="form-control <?php if(strlen($error)>0 && (empty($u_lastName) || strlen($u_lastName) < 3)) echo 'is-invalid'; ?>" id="inputFirstName" type="text" name="lastname" placeholder="Adinizi giriniz." value="<?=$lastName?>">
                                <?php if(strlen($error)>0 && (empty($u_lastName) || strlen($u_lastName) < 3)) echo '<div class="invalid-feedback">'.$error.'</div>'; ?>
                            </div>
                        </div>
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (organization name)-->
                            <div class="col-md-6">
                            <label class="small mb-1" for="inputOrgName">Bio-nuz</label>
                             <textarea class="form-control" id="inputOrgName" name="bio" placeholder="BİO hissəsi"><?=$bio?></textarea>
                            </div>
                            <!-- Form Group (location)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLocation">Ölkə <span class="text-danger">*</span> </label>
                                <input class="form-control <?php if(strlen($error)>0 && (empty($u_country) || strlen($u_country) < 3)) echo 'is-invalid'; ?>" id="inputFirstName" type="text" name="country" placeholder="Ölkənizi giriniz." value="<?=$location?>">
                                <?php if(strlen($error)>0 && (empty($u_country) || strlen($u_country) < 3)) echo '<div class="invalid-feedback">'.$error.'</div>'; ?>
                            </div>
                        </div>
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Elektron Poçt </label>
                            <input class="form-control" id="inputEmailAddress" type="email" name="email" placeholder="Elektron poçt adresini giriniz!" value="<?=$email?>">
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Telefon nömrəniz</label>
                                <input class="form-control" id="inputPhone" type="tel" name="phone" placeholder="Telefon nömrəsini giriniz!" value="<?=$phone?>">
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Doğum tarixiniz</label>
                                <input class="form-control" id="inputBirthday" type="date" name="age" placeholder="Doğum tarixinizi giriniz!" value="<?=$age?>">
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit" name="save">Yadda saxla</button>
                        <a style="color:white;" class="btn btn-primary bg-danger" type="button" href="http://localhost/social%20M/index.php?timeline">Geri qayıt</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


