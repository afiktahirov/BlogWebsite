console.log("hello");




const userSettingsButtons = document.querySelectorAll(".user_settings");
let modal = document.querySelector(".modal")

console.log(userSettingsButtons);

userSettingsButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        const id = button.dataset.id;
        const username = button.dataset.username;
        const name = button.dataset.name;
        const email = button.dataset.email;
        const age = button.dataset.age;


        const idInput = modal.querySelector("#id");
        const usernameInput = modal.querySelector("#username");
        const nameInput = modal.querySelector("#name");
        
        idInput.value = id;
        usernameInput.value = username;
        nameInput.value = name;
        console.log(id,username,name,email,age);
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

 document.getElementById('warnButton').addEventListener('click', function() {
    var warnTextAreaContainer = document.getElementById('warnTextAreaContainer');
    warnTextAreaContainer.style.display = 'block';
  });

  document.getElementById('sendButton').addEventListener('click', function() {
    var warnTextAreaContainer = document.getElementById('warnTextAreaContainer');
    warnTextAreaContainer.style.display = 'none';
  });

  document.getElementById('blockButton').addEventListener('click', function() {
    var warnTextAreaContainer = document.getElementById('warnTextAreaContainer');
    warnTextAreaContainer.style.display = 'none';
  });

  const blockButton = document.querySelector("#blockButton")

  blockButton.addEventListener("click",()=>{
    let id = document.getElementById('id').value;
    window.location.href = 'pages/block.php?blocked_id='+ id;
  })
