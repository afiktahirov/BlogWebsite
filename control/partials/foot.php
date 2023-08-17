</main>
<script src="http://localhost/e-commerce/control/assets/js/popper.min.js"></script>
<script src="http://localhost/e-commerce/control/assets/js/bootstrap.min.js"></script>
<script src="http://localhost/e-commerce/control/assets/js/perfect-scrollbar.min.js"></script>
<script src="http://localhost/e-commerce/control/assets/js/smooth-scrollbar.min.js"></script>
<script src="http://localhost/e-commerce/control/assets/js/datatables.js"></script>
<script>
    if (document.getElementById('products-list')) {
        const dataTableSearch = new simpleDatatables.DataTable("#products-list", {
            searchable: true,
            fixedHeight: false,
            perPage: 7
        });

        document.querySelectorAll(".export").forEach(function(el) {
            el.addEventListener("click", function(e) {
                var type = el.dataset.type;

                var data = {
                    type: type,
                    filename: "material-" + type,
                };

                if (type === "csv") {
                    data.columnDelimiter = "|";
                }

                dataTableSearch.export(data);
            });
        });
    };
</script>
<script src="http://localhost/e-commerce/control/assets/js/dragula.min.js"></script>
<script src="http://localhost/e-commerce/control/assets/js/jkanban.js"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="http://localhost/e-commerce/control/assets/js/material-dashboard.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="http://localhost/e-commerce/control/assets/js/app.js"></script>
</body>

</html>