


// $(document).ready(function() {
//   var offset = 0;
//   var limit = 5; 

//   function loadPosts() {
//     $.ajax({
//       url: './AJAX/load_posts.php',
//       method: 'GET',
//       data: {
//         offset: offset,
//         limit: limit
//       },
//       success: function(response) {
//         if (response.trim() !== '') {
//           $('#postContainer').append(response);
//           offset += limit;
//         }
//         checkShowMoreButton();
//       }
//     });
//   }

//   function checkShowMoreButton() {
//     var totalPosts = $('.post').length;
//     if (totalPosts > offset) {
//       $('#showMoreButton').show();
//     } else {
//       $('#showMoreButton').hide();
//     }
//   }

//   $('#showMoreButton').click(function() {
//     loadPosts();
//   });

// //   loadPosts();
// });

