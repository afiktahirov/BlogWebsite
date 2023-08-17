<?php




$stmt = $db->query("SELECT u.id, u.username, u.photo, u.name, u.email, u.age, COUNT(p.user_id) AS post_count
FROM users u
LEFT JOIN user_posts p ON u.id = p.user_id
GROUP BY u.id, u.username, u.photo, u.name, u.email, u.age
");


$result = $stmt->fetchAll(PDO::FETCH_ASSOC);







?>
<style>
.form-control {
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
}

.form-control:focus {
  border-color: #80bdff;
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}
</style>

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
        <div id="warnTextAreaContainer">
          <label for="warnMessage" class="mx-1">Xəbərdarlıq Mesajı</label>
          <textarea class="form-control" id="warnMessage" rows="3"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="sendButton" class="btn btn-primary">Göndər</button>
        <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Bağla</button>
        <a href="#" class="btn btn-block btn-info" id="blockButton" >İstifadəçini Blokla</a>
        <a href="#" class="btn btn-block btn-warning" id="warnButton" onclick="sendWarning()">İstifadəçiyə Xəbərdarlıq Göndər</a>
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
                                          <th>Paylaşımları</th>
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
                                          <?php if($user["post_count"]<1):?>
                                          <td><span style='color: red;'>Paylaşımı yoxdur</span></td>
                                          <?php else:?>
                                          <td><span style='padding-left:50px'><b><?=$user["post_count"]?></b></span></td>
                                          <?php endif;?>
                                          <td class="text-sm" style="padding-left: 30px;" >
                                              <a href="#" class="mx-1 user_settings" 
                                                 data-id="<?= $user['id'] ?>"
                                                 data-username="<?= $user['username'] ?>"
                                                 data-name="<?= $user['name'] ?>"
                                                 data-email="<?= $user['email'] ?>"
                                                 data-age="<?= $user['age'] ?>">
                                                  <i class="material-icons text-secondary position-relative text-lg">settings</i>
                                              </a>
                                              <a href="javascript:;" class="mx-1 user_delete">
                                                  <i class="material-icons text-secondary position-relative text-lg">delete</i>
                                              </a>

                                              <a href="javascript:;" class="mx-1 user_warn ">
                                                  <i class="material-icons text-secondary position-relative text-lg">gpp_maybe</i>
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

<script src="./assets/js/modal.js"></script>
