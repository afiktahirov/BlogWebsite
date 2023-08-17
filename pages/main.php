<?php

$_SESSION["user_id"];


?>
<main>
<div class="container">
      <div class="row">
        <div class="col-lg-3 order-2 order-lg-1">
          <aside class="widget-area profile-sidebar">
<!-- widget single item start -->
            <div class="card widget-item">
              <h4 class="widget-title"><?=$result["name"]?></h4>
              <div class="widget-body">
                <div class="about-author">
                  <p><?=$result["bio"]?></p>
                </div>
              </div>
            </div>
            <!-- widget single item start -->
               <?php include "partials/topLikeposts.php";?>
            <!-- widget single item end -->
          </aside>
        </div>

        <div class="col-lg-6 order-1 order-lg-2">
          <!-- share box start -->
          <div class="card card-small">
            <div class="share-box-inner">
              <!-- profile picture end -->
              <div class="profile-thumb">
                <a href="#">
                  <figure class="profile-thumb-middle">
                    <img src="<?=$result["photo"]?>" alt="profile picture">
                  </figure>
                </a>
              </div>
              <!-- profile picture end -->

              <!-- share content box start -->
              <div class="share-content-box w-100">
                <form class="share-text-box">
                  <textarea
                    name="share"
                    class="share-text-field"
                    aria-disabled="true"
                    placeholder="Düşüncələrini paylaş"
                    data-bs-toggle="modal"
                    data-bs-target="#textbox"
                    id="email"
                    readonly
                  ></textarea>
                </form>
              </div>
              <!-- share content box end -->
             <?php include "partials/modal.php"?>
            </div>
          </div>
          <!-- share box end -->

          <!-- post -->

           <?php include "partials/posts.php"?>
        </div>
        <?php include "partials/friends.php"?>
      </div>
    </div>
  </div>
</main>

<script>
  document.getElementById('upload-button').addEventListener('click', function() {
    document.getElementById('post-photos').click();
  });

  document.getElementById('post-photos').addEventListener('change', function() {
    var uploadedPhotos = document.getElementById('uploaded-photos');
    uploadedPhotos.innerHTML = '';

    for (var i = 0; i < this.files.length; i++) {
      var file = this.files[i];
      var reader = new FileReader();

      reader.onload = function(e) {
        var img = document.createElement('img');
        img.src = e.target.result;
        img.classList.add('uploaded-photo');
        uploadedPhotos.appendChild(img);
      };

      reader.readAsDataURL(file);
    }
  });
</script>
