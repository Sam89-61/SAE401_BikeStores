<?php
$page = "gestionIT";
include_once("www/IT/headerIT.php");
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {

        $(".choix-btn").click(function() {
            let valeur = $(this).val();

            if (valeur == "") {
                $('#table').html("Please choose an option");
                return;
            } else if (valeur == "produit") {
                $(".insert").empty();
                $(".insert").html("<a href='index.php?action=insertIT&add=product'>Add Product</a>");
                $.ajax({
                    url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=products",
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        $('#table').html("<thead><tr><th>id</th><th>Product Name</th><th>Brand</th><th>Category</th><th>Model Year</th><th>List Price</th></tr></thead>");
                        data.forEach(product => {
                            $("#table").append(`
                                <tr>
                                    <td>${product.product_id}</td>
                                    <td>${product.product_name}</td>
                                    <td>${product.brand.brand_name}</td>
                                    <td>${product.category.category_name}</td>
                                    <td>${product.model_year}</td>
                                    <td>${product.list_price} €</td>
                                    <td><a href='index.php?action=updateIT&modif=produit&id=${product.product_id}'>Update</a></td>
                                    <td><a href='index.php?action=deleteIT&sup=produit&id=${product.product_id}'>Delete</a></td>
                                </tr>
                            `);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error while retrieving products:", error);
                        console.error("Error while retrieving products:", xhr.status, xhr.responseText);
                        $('#table').html("Error while retrieving products.");
                    }
                });
            } else if (valeur == "brand") {
                $(".insert").empty();
                $(".insert").append("<a href='index.php?action=insertIT&add=brand'>Add Brand</a>");

                $.ajax({
                    url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=brands",
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#table').html("<thead><tr><th>id</th><th>Brand Name</th></tr></thead>");
                        data.forEach(brand => {
                            $("#table").append(`
                                <tr>
                                    <td>${brand.brand_id}</td>
                                    <td>${brand.brand_name}</td>
                                    <td><a href='index.php?action=updateIT&modif=brand&id=${brand.brand_id}'>Update</a></td>
                                    <td><a href='index.php?action=deleteIT&sup=brand&id=${brand.brand_id}'>Delete</a></td>
                                </tr>
                            `);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error while retrieving brands:", error);
                        console.error("Error while retrieving brands:", xhr.status, xhr.responseText);
                        $('#table').html("Error while retrieving brands.");
                    }
                });
            } else if (valeur == "category") {
                $(".insert").empty();
                $(".insert").append("<a href='index.php?action=insertIT&add=category'>Add Category</a>");
                $.ajax({
                    url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=categories",
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#table').html("<thead><tr><th>id</th><th>Category Name</th></tr></thead>");
                        data.forEach(category => {
                            $("#table").append(`
                                <tr>
                                    <td>${category.category_id}</td>
                                    <td>${category.category_name}</td>
                                    <td><a href='index.php?action=updateIT&modif=category&id=${category.category_id}'>Update</a></td>
                                    <td><a href='index.php?action=deleteIT&sup=category&id=${category.category_id}'>Delete</a></td>
                                </tr>
                            `);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error while retrieving categories:", error);
                        console.error("Error while retrieving categories:", xhr.status, xhr.responseText);
                        $('#table').html("Error while retrieving categories.");
                    }
                });
            } else if (valeur == "stock") {
                $(".insert").empty();
                $(".insert").append("<a href='index.php?action=insertIT&add=stock'>Add Stock</a>");
                $.ajax({
                    url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=stockbystore&id=" + <?php echo $_SESSION['StoreEmployee']; ?>,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        $('#table').html("<thead><tr><th>id</th><th>Product</th><th>Store</th><th>Quantity</th></tr></thead>");
                        data.forEach(stock => {
                            $("#table").append(`
                                <tr>
                                    <td>${stock.stock_id}</td>
                                    <td>${stock.product.product_name}</td>
                                    <td>${stock.store.store_name}</td>
                                    <td>${stock.quantity}</td>
                                    <td><a href='index.php?action=updateIT&modif=stock&id=${stock.stock_id}'>Update</a></td>
                                    <td><a href='index.php?action=deleteIT&sup=stock&id=${stock.stock_id}'>Delete</a></td>
                                </tr>
                            `);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error while retrieving stock:", error);
                        console.error("Error while retrieving stock:", xhr.status, xhr.responseText);
                        $('#table').html("Error while retrieving stock.");
                    }
                });
            } else if (valeur == "store") {
                $(".insert").empty();
                $(".insert").append("<a href='index.php?action=insertIT&add=store'>Add Store</a>");
                $.ajax({
                    url: `https://bikestoresab.alwaysdata.net/bikestores/stores`,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#table').html("<thead><tr><th>id</th><th>Store Name</th><th>Address</th><th>City</th><th>State</th><th>Zipcode</th><th>Phone</th></tr></thead>");
                        data.forEach(store => {
                            $("#table").append(`
                                <tr>
                                    <td>${store.store_id}</td>
                                    <td>${store.store_name}</td>
                                    <td>${store.street}</td>
                                    <td>${store.city}</td>
                                    <td>${store.state}</td>
                                    <td>${store.zip_code}</td>
                                    <td>${store.phone}</td>
                                    <td><a href='index.php?action=updateIT&modif=store&id=${store.store_id}'>Update</a></td>
                                    <td><a href='index.php?action=deleteIT&sup=store&id=${store.store_id}'>Delete</a></td>
                                </tr>
                            `);
                        });

                      
                           
                       
                    },
                    error: function(xhr, status, error) {
                        console.error("Error while retrieving stores:", error);
                        console.error("Error while retrieving stores:", xhr.status, xhr.responseText);
                        $('#table').html("Error while retrieving stores.");
                    }
                });
            } else if (valeur == "employee") {
                $(".insert").empty();
                $(".insert").append("<a href='index.php?action=insertIT&add=employee'>Add Employee</a>");
                $.ajax({
                    url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=employees",
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#table').html("<thead><tr><th>id</th><th>Employee Name</th><th>Email</th><th>Role</th><th>Store</th></tr></thead>");
                        data.forEach(employee => {
                            console.log(employee);
                            $("#table").append(`
                                <tr>
                                    <td>${employee.employee_id}</td>
                                    <td>${employee.employee_name}</td>
                                    <td>${employee.employee_email}</td>
                                    <td>${employee.employee_role}</td>
                                    <td>${employee.store_id.store_name}</td>

                                </tr>
                            `);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error while retrieving employees:", error);
                        console.error("Error while retrieving employees:", xhr.status, xhr.responseText);
                        $('#table').html("Error while retrieving employees.");
                    }
                });
            }
        });

        let click = "<?php
                        if (isset($_GET['click'])) {
                            echo $_GET['click'];
                        } else {
                            echo "";
                        };

                        ?>";
        if (click == "") {
            $('#table').html("Please choose an option");
            return;
        } else if (click == "produit") {
            $("#produit").trigger("click");
        } else if (click == "brand") {
            $("#brand").trigger("click");
        } else if (click == "category") {
            $("#category").trigger("click");
        } else if (click == "stock") {
            $("#stock").trigger("click");
        } else if (click == "store") {
            $("#store").trigger("click");
        } else if (click == "employee") {
            $("#employee").trigger("click");
        }
    });
</script>


<div class="container my-4">
    <h1 class="text-center mb-4">Management</h1>
    <div class="d-flex flex-wrap justify-content-center gap-2 mb-3">
        <button id="produit" class="btn btn-primary choix-btn" value="produit">Product</button>
        <button id="brand" class="btn btn-secondary choix-btn" value="brand">Brand</button>
        <button id="category" class="btn btn-success choix-btn" value="category">Category</button>
        <button id="stock" class="btn btn-warning choix-btn" value="stock">Stock</button>
        <button id="store" class="btn btn-info choix-btn" value="store">Store</button>
        <button id="employee" class="btn btn-danger choix-btn" value="employee">Employee</button>
    </div>
    <div class="insert mb-3"></div>
    <div class="table-responsive">
        <table id="table" class="table table-striped table-hover"></table>
    </div>
</div>
</main>


<?php include_once("www/footer.php"); ?>