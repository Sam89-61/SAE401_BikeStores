<?php
/**
 * Entity insertion page for BikeStores IT employees.
 *
 * Allows IT employees to dynamically add a product, brand, category, stock, store, or employee via an interactive form.
 * The form fields are dynamically generated based on the entity to be inserted (GET["add"]).
 * Uses AJAX to load dropdown lists (brands, categories, products, stores) and to send data to the BikeStores API.
 * Displays a success or error message based on the API response, then resets the form if necessary.
 *
 * @package view\IT
 * @version 1.0
 */
$page = "insert";
include_once("www/IT/headerIT.php");
echo "<h1>Insert</h1>";
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        let add = "<?php echo $_GET["add"] ?>";
        $('#back-link').attr('href', 'index.php?action=GestionIT&click=produit');

        if (add == "product") {
            console.log("add product");
            $(".form").append(`
                <label for="product_name">Product Name:</label>
                <input type="text" id="product_name" name="product_name" required><br><br>
                <label for="brand_id">Brand:</label>
                <select id="brand_id" name="brand_id">
                    <option value="" selected disabled>Select a brand</option>
                </select><br><br>
            `);

            $.ajax({
                url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=brands",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    data.forEach(function(brand) {
                        $("#brand_id").append(`<option value="${brand.brand_id}">${brand.brand_name}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching brands:", error);
                }
            });

            $(".form").append(`
                <label for="category_id">Category:</label>
                <select id="category_id" name="category_id">
                    <option value="" selected disabled>Select a category</option>
                </select><br><br>
            `);

            $.ajax({
                url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=categories",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    data.forEach(function(category) {
                        $("#category_id").append(`<option value="${category.category_id}">${category.category_name}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching categories:", error);
                }
            });

            $(".form").append(`
                <label for="product_price">Product Price:</label>
                <input type="number" id="product_price" name="product_price" required><br><br>
                <label for="model-year">Model Year:</label>
                <input type="smallint" id="model-year" name="model-year"><br><br>
            `);

            let submit = document.getElementById("submit");
            if (submit) {
                submit.addEventListener("click", function() {
                    $.ajax({
                        url: `https://bikestoresab.alwaysdata.net/bikestores/api.php?actionPost=insertProduct&name=${$("#product_name").val()}&brand=${$("#brand_id").val()}&category=${$("#category_id").val()}&modelyear=${$("#model-year").val()}&listprice=${$("#product_price").val()}&KEY=e8f1997c763`,
                        type: "POST",
                        dataType: "json",
                        success: function(response) {
                            if (response.error) {
                                $("#error").text("Error inserting product: " + response.error);
                                $("#success").text("");
                            } else {
                                $("#error").text("");

                                $("#success").text("Product inserted successfully!");
                                $(".form").empty();
                                $(".form").append(`
                                <label for="product_name">Product Name:</label>
                                <input type="text" id="product_name" name="product_name" required><br><br>
                                <label for="brand_id">Brand:</label>
                                <select id="brand_id" name="brand_id">
                                    <option value="" selected disabled>Select a brand</option>
                                </select><br><br>
                            `);

                                $.ajax({
                                    url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=brands",
                                    type: "GET",
                                    dataType: "json",
                                    success: function(data) {
                                        data.forEach(function(brand) {
                                            $("#brand_id").append(`<option value="${brand.brand_id}">${brand.brand_name}</option>`);
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        console.error("Error fetching brands:", error);
                                    }
                                });

                                $(".form").append(`
                                <label for="category_id">Category:</label>
                                <select id="category_id" name="category_id">
                                    <option value="" selected disabled>Select a category</option>
                                </select><br><br>
                            `);

                                $.ajax({
                                    url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=categories",
                                    type: "GET",
                                    dataType: "json",
                                    success: function(data) {
                                        data.forEach(function(category) {
                                            $("#category_id").append(`<option value="${category.category_id}">${category.category_name}</option>`);
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        console.error("Error fetching categories:", error);
                                    }
                                });

                                $(".form").append(`
                                <label for="product_price">Product Price:</label>
                                <input type="number" id="product_price" name="product_price" required><br><br>
                                <label for="model-year">Model Year:</label>
                                <input type="smallint" id="model-year" name="model-year"><br><br>
                            `);
                            }
                        },
                        error: function(xhr, status, error) {
                            $("#error").text("Error inserting product. Please try again.");
                            console.error("Error inserting product:", error);
                            console.log(xhr.responseText);
                            console.log(xhr.status);
                        }
                    });
                });
            }
        } else if (add == "brand") {
            $('#back-link').attr('href', 'index.php?action=GestionIT&click=brand');

            $(".form").append(`
                <label for="brand_name">Brand Name:</label>
                <input type="text" id="brand_name" name="brand_name" required><br><br>
            `);

            let submit = document.getElementById("submit");
            if (submit) {
                submit.addEventListener("click", function() {
                    $.ajax({
                        url: `https://bikestoresab.alwaysdata.net/bikestores/api.php?actionPost=insertBrand&name=${$("#brand_name").val()}&KEY=e8f1997c763`,
                        type: "POST",
                        dataType: "json",
                        success: function(response) {
                            if (response.error) {
                                $("#error").text("Error inserting brand: " + response.error);
                                $("#success").text("");
                            } else {
                                $("#success").text("Brand inserted successfully!");
                                $("#error").text("");
                                $(".form").empty();
                                $(".form").append(`
                                <label for="brand_name">Brand Name:</label>
                                <input type="text" id="brand_name" name="brand_name" required><br><br>
                            `);
                            }

                        },
                        error: function(xhr, status, error) {
                            $("#error").text("Error inserting brand. Please try again.");
                            console.error("Error inserting brand:", error);
                            console.log(xhr.responseText);
                            console.log(xhr.status);
                        }
                    });
                });
            }
        } else if (add == "category") {
            $('#back-link').attr('href', 'index.php?action=GestionIT&click=category');

            $(".form").append(`
                <label for="category_name">Category Name:</label>
                <input type="text" id="category_name" name="category_name" required><br><br>
            `);

            let submit = document.getElementById("submit");
            if (submit) {
                submit.addEventListener("click", function() {
                    $.ajax({
                        url: `https://bikestoresab.alwaysdata.net/bikestores/api.php?actionPost=insertCategorie&name=${$("#category_name").val()}&KEY=e8f1997c763`,
                        type: "POST",
                        dataType: "json",
                        success: function(response) {
                            if (response.error) {
                                $("#error").text("Error inserting category: " + response.error);
                                $("#success").text("");
                            } else {
                                $("#success").text("Category inserted successfully!");
                                $("#error").text("");

                                $(".form").empty();
                                $(".form").append(`
                                <label for="category_name">Category Name:</label>
                                <input type="text" id="category_name" name="category_name" required><br><br>
                            `);
                            }
                        },
                        error: function(xhr, status, error) {
                            $("#error").text("Error inserting category. Please try again.");
                            console.error("Error inserting category:", error);
                            console.log(xhr.responseText);
                            console.log(xhr.status);
                        }
                    });
                });
            }
        } else if (add == "stock") {
            $('#back-link').attr('href', 'index.php?action=GestionIT&click=stock');

            $(".form").append(`
                <label for="product_id">Product:</label>
                <select id="product_id" name="product_id">
                    <option value="" selected disabled>Select a product</option>
                </select><br><br>
            `);

            $.ajax({
                url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=products",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    data.forEach(function(product) {
                        $("#product_id").append(`<option value="${product.product_id}">${product.product_name}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching products:", error);
                }
            });

            $.ajax({
                url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=store&id=<?php echo $_SESSION["StoreEmployee"] ?>",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    data.forEach(function(store) {
                        $(".form").append(`
                            <label for="store_id">Store:</label>
                            <select id="store_id" name="store_id">
                                <option value="${store.store_id}" selected>${store.store_name}</option>
                            </select><br><br>
                        `);
                    });
                }
            });

            $(".form").append(`
                <label for="stock_quantity">Stock Quantity:</label>
                <input type="number" id="stock_quantity" name="stock_quantity" required><br><br>
            `);

            let submit = document.getElementById("submit");
            if (submit) {
                submit.addEventListener("click", function() {
                    $.ajax({
                        url: `https://bikestoresab.alwaysdata.net/bikestores/api.php?actionPost=insertStock&product=${$("#product_id").val()}&store=${$("#store_id").val()}&quantity=${$("#stock_quantity").val()}&KEY=e8f1997c763`,
                        type: "POST",
                        dataType: "json",
                        success: function(response) {
                            if (response.error) {
                                $("#error").text("Error inserting stock: " + response.error);
                                $("#success").text("");
                            } else {

                                $("#error").text("");

                                $("#success").text("Stock inserted successfully!");
                                $(".form").empty();
                                $(".form").append(`
                                <label for="product_id">Product:</label>
                                <select id="product_id" name="product_id">
                                    <option value="" selected disabled>Select a product</option>
                                </select><br><br>
                            `);

                                $.ajax({
                                    url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=products",
                                    type: "GET",
                                    dataType: "json",
                                    success: function(data) {
                                        data.forEach(function(product) {
                                            $("#product_id").append(`<option value="${product.product_id}">${product.product_name}</option>`);
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        console.error("Error fetching products:", error);
                                    }
                                });

                                $.ajax({
                                    url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=store&id=<?php echo $_SESSION["StoreEmployee"] ?>",
                                    type: "GET",
                                    dataType: "json",
                                    success: function(data) {
                                        data.forEach(function(store) {
                                            $(".form").append(`
                                            <label for="store_id">Store:</label>
                                            <select id="store_id" name="store_id">
                                                <option value="${store.store_id}" selected>${store.store_name}</option>
                                            </select><br><br>
                                        `);
                                        });
                                    }
                                });

                                $(".form").append(`
                                <label for="stock_quantity">Stock Quantity:</label>
                                <input type="number" id="stock_quantity" name="stock_quantity" required><br><br>
                            `);
                            }
                        },
                        error: function(xhr, status, error) {
                            $("#error").text("Error inserting stock. Please try again.");
                            console.error("Error inserting stock:", error);
                            console.log(xhr.responseText);
                            console.log(xhr.status);
                        }
                    });
                });
            }
        } else if (add == "store") {
            $('#back-link').attr('href', 'index.php?action=GestionIT&click=store');

            $(".form").append(`
                <label for="store_name">Store Name:</label>
                <input type="text" id="store_name" name="store_name" required><br><br>
                <label for="store_phone">Store Phone:</label>
                <input type="text" id="store_phone" name="store_phone" required><br><br>
                <label for="store_email">Store Email:</label>
                <input type="email" id="store_email" name="store_email" required><br><br>
                <label for="store_street">Store Street:</label>
                <input type="text" id="store_street" name="store_street" required><br><br>
                <label for="store_state">Store State:</label>
                <input type="text" id="store_state" name="store_state" required><br><br>
                <label for="store_city">Store City:</label>
                <input type="text" id="store_city" name="store_city" required><br><br>
                <label for="store_zip">Store Zip:</label>
                <input type="text" id="store_zip" name="store_zip" required><br><br>

            `);
            let submit = document.getElementById("submit");
            if (submit) {
                submit.addEventListener("click", function() {
                    $.ajax({
                        url: `https://bikestoresab.alwaysdata.net/bikestores/api.php?actionPost=insertStore&name=${$("#store_name").val()}&phone=${$("#store_phone").val()}&email=${$("#store_email").val()}&street=${$("#store_street").val()}&state=${$("#store_state").val()}&city=${$("#store_city").val()}&zip=${$("#store_zip").val()}&KEY=e8f1997c763`,
                        type: "POST",
                        dataType: "json",
                        success: function(response) {
                            if (response.error) {
                                $("#error").text("Error inserting store: " + response.error);
                                $("#success").text("");
                            } else {
                                $("#error").text("");
                                $("#success").text("Store inserted successfully!");
                                $(".form").empty();
                                $(".form").append(`
                                <label for="store_name">Store Name:</label>
                                <input type="text" id="store_name" name="store_name" required><br><br>
                                <label for="store_phone">Store Phone:</label>
                                <input type="text" id="store_phone" name="store_phone" placeholder="8 number min" required><br><br>
                                <label for="store_email">Store Email:</label>
                                <input type="email" id="store_email" name="store_email" required><br><br>
                                <label for="store_street">Store Street:</label>
                                <input type="text" id="store_street" name="store_street" required><br><br>
                                <label for="store_state">Store State:</label>
                                <input type="text" id="store_state" name="store_state" required><br><br>
                                <label for="store_city">Store City:</label>
                                <input type="text" id="store_city" name="store_city" required><br><br>
                                <label for="store_zip">Store Zip:</label>
                                <input type="text" id="store_zip" name="store_zip" required><br><br>

                            `);
                            }
                        },
                        error: function(xhr, status, error) {
                            $("#error").text("Error inserting store. Please try again.");
                            console.error("Error inserting store:", error);
                            console.log(xhr.responseText);
                            console.log(xhr.status);
                        }
                    });
                });
            }


        } else if (add == "employee") {
            $('#back-link').attr('href', 'index.php?action=GestionIT&click=employee');

            $(".form").append(`
                <label for="store_id">Store:</label>
                <select id="store_id" name="store_id">
                    <option value="" selected disabled>Select a store</option>
 
                </select><br><br>
                <select id="employee_role" name="employee_role">
                    <option value="" selected disabled>Select a role</option>
                    <option value="employee">Employee</option>
                    <option value="chief">Chief</option>
                </select><br><br>
            `);

            $.ajax({
                url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=stores",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    data.forEach(function(store) {
                        $("#store_id").append(`<option value="${store.store_id}">${store.store_name}</option>`);
                    });

                }
            });
            $(".form").append(`
                <label for="employee_name">Employee Name:</label>
                <input type="text" id="employee_name" name="employee_name" required><br><br>
                <label for="employee_email">Employee Email:</label>
                
                <input type="email" id="employee_email" name="employee_email" required><br><br>
                <label for="employee_password">Employee Password:</label>
                <input type="password" id="employee_password" name="employee_password" placeholder="6 character min" required><br><br>
               
            `);
            let submit = document.getElementById("submit");
            if (submit) {
                submit.addEventListener("click", function() {
                 
                    $.ajax({
                        url: `https://bikestoresab.alwaysdata.net/bikestores/api.php?actionPost=insertEmployee&store=${$("#store_id").val()}&name=${$("#employee_name").val()}&email=${$("#employee_email").val()}&password=${$("#employee_password").val()}&role=${$("#employee_role").val()}&KEY=e8f1997c763`,
                        type: "POST",
                        dataType: "json",
                        success: function(response) {
                            if (response.error) {
                                $("#error").text("Error inserting employee: " + response.error);
                                $("#success").text("");
                            } else {
                                $("#error").text("");
                                $("#success").text("Employee inserted successfully!");
                                $(".form").empty();
                                $(".form").append(`
                <label for="store_id">Store:</label>
                <select id="store_id" name="store_id">
                    <option value="" selected disabled>Select a store</option>
                </select><br><br>

                <select id="employee_role" name="employee_role">
                    <option value="" selected disabled>Select a role</option>
                    <option value="employee">Employee</option>
                    <option value="chief">Chief</option>
                </select><br><br>
            `);

                                $.ajax({
                                    url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=stores",
                                    type: "GET",
                                    dataType: "json",
                                    success: function(data) {
                                        data.forEach(function(store) {
                                            $("#store_id").append(`<option value="${store.store_id}">${store.store_name}</option>`);
                                        });

                                    }
                                });
                                $(".form").append(`
                <label for="employee_name">Employee Name:</label>
                <input type="text" id="employee_name" name="employee_name" required><br><br>
                <label for="employee_email">Employee Email:</label>
                <input type="email" id="employee_email" name="employee_email" required><br><br>
                <label for="employee_password">Employee Password:</label>
                <input type="password" id="employee_password" name="employee_password" required><br><br>
              
            `);
                            }
                        },
                        error: function(xhr, status, error) {
                            $("#error").text("Error inserting employee. Please try again.");
                            console.error("Error inserting employee:", error);
                            console.log(xhr.responseText);
                            console.log(xhr.status);
                        }
                    });
                });

            };
        };
    });
</script>
<a id="back-link" href="index.php?action=GestionIT" class="btn btn-warning mb-4">Back</a>
    <div class="card shadow p-4">
        <h2 class="text-center mb-4">Insert</h2>
        <div class="insertion">
            <form method="POST" class="form row g-3">
            </form>
            <div class="d-flex justify-content-center">
                <input type="submit" value="Insert" id="submit" class="btn btn-secondary mt-3">
            </div>
            <p id="error" class="text-danger mt-3 text-center"></p>
            <p id="success" class="text-success mt-3 text-center"></p>
        </div>
    </div>
</main>
<?php include_once("www/footer.php");?>