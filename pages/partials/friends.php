<?php
include "db.php";

$my_id = $_SESSION["user_id"];

$stmt = $db->prepare("SELECT user_id_2 FROM friendships WHERE user_id_1 = ? AND accept_f = 0");
$stmt->execute([$my_id]);

$queryUsers = $stmt->fetchAll(PDO::FETCH_COLUMN);

$users = [];

if (!empty($queryUsers)) {
  $inClause = implode(",", $queryUsers);

  $getUsers = $db->prepare("SELECT id, name, photo FROM users WHERE id IN ($inClause)");
  $getUsers->execute();

  $users = $getUsers->fetchAll(PDO::FETCH_ASSOC);
}

?>
<div class="col-lg-3 order-3">
  <aside class="widget-area">
    <!-- widget single item start -->
    <div class="card widget-item">
      <h4 class="widget-title">Dostluq Təklifləri</h4>
      <div class="widget-body">
        <ul class="like-page-list-wrapper">
          <?php if(count($users) > 0): ?>
            <?php foreach($users as $user): ?>
              <li class="unorder-list">
                <!-- profile picture end -->
                <div class="profile-thumb">
                  <a href="#">
                    <figure class="profile-thumb-small">
                      <img src="./<?=$user["photo"]?>" alt="profile picture" />
                    </figure>
                  </a>
                </div>
                <!-- profile picture end -->
                <div class="unorder-list-info">
                  <h3 class="list-title">
                    <a href="#"><?=$user["name"]?></a>
                  </h3>
                  <button type="button" class="btn-outline-success mr-2 accept_friend" data-accept=<?=$my_id?> data-ac_user=<?=$user["id"]?>> Qebul et</button>
                  <button type="button" class="btn-outline-danger">İmtina et</button>
                </div>
              </li>
            <?php endforeach; ?>
          <?php else: ?>
            <p>Dosluq teklifiniz yoxdur.</p>
          <?php endif; ?>
        </ul>
      </div>
    </div>
    <!-- widget single item end -->
  </aside>
</div>

<script>

const acceptButtons = document.querySelectorAll(".accept_friend");

acceptButtons.forEach((button) => {
  button.addEventListener("click", () => {
    const accept = button.dataset.accept;
    const ac_user = button.dataset.ac_user;
    fetch("./AJAX/acceptFriend.php", {
      method: "POST",
      body: new URLSearchParams({
        accepter: accept,
        sender: ac_user,
      }),
    });
  });
});


</script>

