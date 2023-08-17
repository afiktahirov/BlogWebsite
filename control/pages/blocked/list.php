<?php
$stmt = $db->query("SELECT id,username,photo,name,email,age FROM users WHERE is_blocked=1");

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="modal" id="modol" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Fealiyyət</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="id" class="mx-1">ID</label>
          <input class="form-control" name="id" id="id" type="text" readonly>
        </div>
        <div class="form-group">
          <label for="username" class="mx-1">İstifadəçi adı</label>
          <input class="form-control" id="username" type="text" readonly>
        </div>
        <div class="form-group">
          <label for="name" class="mx-1">Adı/Soyadı</label>
          <input class="form-control" id="name" type="text" readonly>
        </div>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-block btn-info" id="unblockbtn" >İstifadəçini Blokdan Çıxart</a>
        <a href="#" id="close" class="btn btn-block btn-info btn-secondary" data-dismiss="modal">Bağla</a>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-lg-flex">
                            <div>
                                <h5 class="mb-0">İstifadəçilər</h5>
                            </div>
                            <div class="ms-auto my-auto mt-lg-0 mt-4">
                       
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-0">
                          <div class="table-responsive">
                              <table class="table table-flush data-table">
                                  <thead class="thead-light">
                                      <tr>
                                          <th>id</th>
                                          <th>Şəkli</th>
                                          <th style="padding-right: 250px;">İstifadəçi adı</th>
                                          <th style="padding-right: 200px;">Ad/Soyad</th>
                                          <th style="padding-right: 230px;">email</th>
                                          <th>Təvəlüdü</th>
                                          <th>Post Sayı</th>
                                          <th>Əməliyyatlar</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php foreach($result as $user):?>
                                      <tr>
                                          <td><?= $user['id'] ?></td>
                                          <td>
                                              <div class="d-flex align-items-center">
                                                  <img class="w-20 ms-3 img-fluid rounded-circle me-3" src="http://localhost/social%20M/<?=$user['photo'] ?>" alt="user photo">
                                                  <h6 class="ms-3 my-auto"></h6>
                                              </div>
                                          </td>
                                          <td style="padding-left: 30px;"><?= $user['username'] ?></td>
                                          <td><?= $user['name'] ?></td>
                                          <td><?= $user['email']?$user['email']:"<span style='color: red;'>Qeyd etməyib</span>" ?></td>
                                          <td><?= $user['age']?$user['age']:"<span style='color: red;'>Qeyd etməyib</span>"?></td>
                                          <td><span style='color: red;'>Postu yoxdur</span></td>
                                          
                                          <td class="text-sm" style="padding-left: 50px;" >
                                              <a href="#" class="mx-1 user_settings" 
                                                 data-id="<?= $user['id'] ?>"
                                                 data-username="<?= $user['username'] ?>"
                                                 data-name="<?= $user['name'] ?>"
                                                 data-email="<?= $user['email'] ?>"
                                                 data-age="<?= $user['age'] ?>">
                                                  <i class="material-icons text-secondary position-relative text-lg">lock_open_left</i>
                                              </a>
                                            
                                          </td>
                                      </tr>
                                      <?php endforeach;?>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                </div>
            </div>
        </div>
    </div>

<script>
    const userSettingsButtons = document.querySelectorAll(".user_settings");
    let modal = document.querySelector(".modal")

    console.log(userSettingsButtons);

    userSettingsButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const id = button.dataset.id;
            const username = button.dataset.username;
            const name = button.dataset.name;
    
            // Modal içindeki inputlara değerleri ata
            const idInput = modal.querySelector("#id");
            const usernameInput = modal.querySelector("#username");
            const nameInput = modal.querySelector("#name");
            
            idInput.value = id;
            usernameInput.value = username;
            nameInput.value = name;
            console.log(id,username,name);
            modal.style.display = "block";
        });
});

const closeButton = modal.querySelector(".close");
const closeButton2 = modal.querySelector("#close");
closeButton.addEventListener("click", function() {
    modal.style.display = "none";
});
closeButton2.addEventListener("click", function() {
    modal.style.display = "none";
});
const unblockButton = document.querySelector("#unblockbtn")
unblockButton.addEventListener("click",()=>{
    let id = document.getElementById('id').value;
    window.location.href = 'pages/block.php?unblock_id='+ id;
  })
</script>