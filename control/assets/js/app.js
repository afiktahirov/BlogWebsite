const API_URL = "http://localhost/e-commerce";
const previewInputs = [...document.querySelectorAll(".has__image__preview")];
const progressWrapper = document.querySelector(".progress-wrapper");
previewInputs.map((a) => {
  a.addEventListener("change", (e) => {
    const reader = new FileReader();
    reader.readAsDataURL(e.target.files[0]);
    reader.addEventListener("load", () => {
      a.nextElementSibling.setAttribute("src", reader.result);
      a.nextElementSibling.style.display = "block";
    });
  });
});

const categoriesTable = document.querySelector(".categories__table");
categoriesTable?.addEventListener("click", (e) => {
  const el = e.target.closest(".edit__modal__trigger");
  if (el.classList.contains("edit__modal__trigger")) {
    const editCategoryForm = document.querySelector(
      ".edit__category__modal form"
    );
    const name = el.closest("tr").querySelector("td p").textContent;
    const id = +el.getAttribute("data-id");
    const editCategoryFormData = new FormData();
    editCategoryFormData.append("id", id);
    editCategoryForm.addEventListener("submit", (e) => {
      e.preventDefault();
      editCategoryForm.querySelector('[type="submit"]').disabled = true;
      editCategoryFormData.append(
        "name",
        document.querySelector("#edit__category__name").value
      );
      const xhr = new XMLHttpRequest();
      xhr.open("POST", `${API_URL}/control/ajax/category/edit.php`);
      xhr.upload.addEventListener("progress", (event) => {
        if (event.lengthComputable) {
          progressWrapper.classList.remove("d-none");
          const percentage = Math.round((event.loaded / event.total) * 100);
          progressWrapper.querySelector(
            ".progress-bar"
          ).style.width = `${percentage}%`;
          progressWrapper.querySelector("span").textContent = `${percentage}% `;
        }
      });
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
          editCategoryForm.querySelector('[type="submit"]').disabled = false;
          if (xhr.status === 200) {
            const res = JSON.parse(xhr.responseText);
            if (!res.success) {
              document
                .querySelector("#error__response")
                .classList.remove("text-success");
              document
                .querySelector("#error__response")
                .classList.add("text-danger");
            } else {
              document
                .querySelector("#error__response")
                .classList.remove("text-danger");
              document
                .querySelector("#error__response")
                .classList.add("text-success");
            }
            document.querySelector("#error__response").textContent =
              res.message;
          } else {
            console.error("An error occurred: " + xhr.status);
          }
          progressWrapper.classList.add("d-none");
        }
      };
      xhr.send(editCategoryFormData);
    });

    editCategoryForm
      .querySelector('[type="file"]')
      .addEventListener("change", (e) => {
        editCategoryFormData.append("image", e.target.files[0]);
        const reader = new FileReader();
        reader.addEventListener("load", () => {
          editCategoryForm
            .querySelector("img")
            .setAttribute("src", reader.result);
        });
        reader.readAsDataURL(e.target.files[0]);
      });
    editCategoryForm.querySelector("#edit__category__name").value = name;
    editCategoryForm
      .querySelector("img")
      .setAttribute(
        "src",
        el.closest("tr").querySelector("img").getAttribute("src")
      );
  }
});


new DataTable('.data-table');






modal.classList.add("")