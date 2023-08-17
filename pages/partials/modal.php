<?php
$error = [];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["save_post"])) {
    $post_title = htmlspecialchars($_POST["post-title"]);
    $post_text = htmlspecialchars($_POST["post-content"]);
    $user_id = $result["id"];

    if (strlen($post_title) < 3 && strlen($post_text)>100) {
        $error["title"] = "Paylaşımın başlığı en az 3 və ən çox 100 hərf olmalıdır!";
    }
    if (strlen($post_text) < 10 && strlen($post_text)>255) {
        $error["text"] = "Paylaşım hakkında en az 10 ən çox 255 hərf yazmalısınız!";
    }

    if (empty($error)) {
        $stmt = $db->prepare("INSERT INTO user_posts (title, text, user_id) VALUES (?, ?, ?)");
        $stmt->execute([$post_title, $post_text, $user_id]);

        $lastInsertedId = $db->lastInsertId();

        $post_images = isset($_FILES["images"]["name"]) ? $_FILES["images"]["name"] : [];

        for ($i = 0; $i < count($post_images); $i++) {
            $name = $_FILES["images"]["name"][$i];
            $tmpName = $_FILES["images"]["tmp_name"][$i];
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            $fileName = time() . rand(1000, 9999) . "." . $extension;

            move_uploaded_file($tmpName, "post_images/$fileName");

            $saveImage = $db->prepare("INSERT INTO post_photos (tmp_name, user_id, post_id) VALUES (?, ?, ?)");
            $saveImage->execute([$fileName, $user_id, $lastInsertedId]);
        }
    }
}
?>

<style>
    .info{
        display:flex;
        justify-content:center;
        flex-direction: column;
        align-items:center;
        gap:5px;
    }
</style>
<div class="modal fade" id="textbox" aria-labelledby="textbox">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" enctype="multipart/form-data" id="post-form">
                <div class="modal-header">
                    <h5 class="modal-title">Paylaşımınızı əlavə edin</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body custom-scroll">
                    <div class="form-group">
                        <label for="post-title">Başlık</label>
                        <input type="text" class="form-control" id="post-title" name="post-title" placeholder="Başlık" />
                        <span class="error-message" style="color:red" id="title-error"></span>
                    </div>
                    <div class="form-group">
                        <label for="post-content">Məzmunu</label>
                        <textarea class="form-control" id="post-content" name="post-content" rows="4" placeholder="Max 250 hərf"></textarea>
                        <span class="error-message"  style="color:red" id="text-error"></span>
                    </div>
                    <div class="form-group">
                        <button type="button" class="post-share-btn" id="upload-button">
                            Şəkil əlavə et
                        </button>
                        <input type="file" class="form-control-file" id="post-photos" name="images[]" multiple style="display: none" />
                    </div>
                    
                    <div id="uploaded-photos" class="uploaded-photos"></div>
                </div>
                <div class="info">
                        <b style="color:red" >Diqqət!</b>
                        <p style="color:red">Paylaşım Moderatorlar tərəfindən yoxlanıldıqdan sonra əlavə olunacaq!</p>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="post-share-btn" data-bs-dismiss="modal">
                        Leğv et
                    </button>
                    <button name="save_post" class="post-share-btn" id="save-button">
                        Paylaş
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var titleField = document.getElementById("post-title");
        var textArea = document.getElementById("post-content");
        var titleError = document.getElementById("title-error");
        var textError = document.getElementById("text-error");
        var saveButton = document.getElementById("save-button");

        titleField.addEventListener("input", function() {
            if (titleField.value.length < 3 ) {
                titleError.textContent = "Paylaşımın başlığı en az 3 hərf olmalıdır!";
            } else {
                titleError.textContent = "";
            }
        });

        textArea.addEventListener("input", function() {
            if (textArea.value.length < 10) {
                textError.textContent = "Paylaşım haqqında en az 3 cümlə yazılmalıdır!";
            } else {
                textError.textContent = "";
            }
        });

saveButton.addEventListener("click", function(event) {
    
    if (titleField.value.length < 3) {
        titleError.textContent = "Paylaşımın başlığı en az 3 hərf olmalıdır!";
        event.preventDefault();
        event.stopPropagation();
        return false;
    }

    if (textArea.value.length < 10) {
        textError.textContent = "Paylaşım haqqında en az 3 cümlə yazılmalıdır!";
        event.preventDefault();
        event.stopPropagation();
        return false;
    }
    
});
});
</script>
