



// fetch('./AJAX/allposts.php')
//   .then(response => response.json())
//   .then(data => {
//     console.log(data);
    
//     data.forEach(a=> {
//        console.log(a);

//     });
     
//   });
 
const addFriendButtons = document.querySelectorAll(".add-frnd");

addFriendButtons.forEach((button) => {
  button.addEventListener("click", () => {
    const userId = button.dataset.userid; 
    const s_id = button.dataset.s_id; 
    fetch("./AJAX/note.php", {
      method: "POST",
      body: new URLSearchParams({
        user_id: userId,
        select_id: s_id,
      }),
    });
  });
});

