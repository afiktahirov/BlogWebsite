<?php

if (isset($_SESSION["user_id"])){
    header("Location: $siteUrl/control");
}
$error = ["email" => "", "password" => ""];
$email = "";
$password = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $email = htmlspecialchars(trim($_POST['email']));
        $password = htmlspecialchars(trim($_POST['password']));
        if (strlen($email) < 3 || strlen($email) > 50) {
            $error["email"] = "Email minimum 3, maksimum 50 simvol olmalıdır.";
        }
        if (strlen($password) < 3 || strlen($password) > 50) {
            $error["password"] = "Şifrə minimum 3, maksimum 50 simvol olmalıdır.";
        }
        if (empty($error['email']) && empty($error['password'])) {
            $query = $db->prepare("SELECT * FROM admins WHERE email = ?");
            $query->execute([$email]);
            if ($query->rowCount() === 1) {
                $admin = $query->fetch(PDO::FETCH_ASSOC);
                if (password_verify($password, $admin["password"])) {
                    $_SESSION["user_id"] = $admin["id"];
                    header("Location: $siteUrl/control");
                } else {
                    $error["password"] = "Şifrə yanlışdır.";
                }
            } else {
                $error["email"] = "Email tapılmadı.";
            }
        }
    }
}
?>
<main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container my-auto">
            <div class="row">
                <div class="col-lg-4 col-md-8 col-12 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Daxil ol</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form role="form" method="POST" action="" class="text-start">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Email</label>
                                    <input value="<?= $email ?>" type="email" name="email" class="form-control">
                                    <?= $error["email"] ? "<span class='text-danger input__error d-block w-100'>" . $error["email"] . "</span>" : "" ?>
                                </div>
                                <div class="input-group input-group-outline mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control">
                                    <?= $error["password"] ? "<span class='text-danger input__error d-block w-100'>" . $error["password"] . "</span>" : "" ?>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Giriş</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>