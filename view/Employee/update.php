<?php
$page = "update";
include_once("www/Employee/headerE.php");
echo "<h1>Update</h1>";
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let modif = "<?php echo $_GET["modif"] ?>";
        if (modif == "produit") {
            $('#back-link').attr('href', 'index.php?action=GestionE&click=produit');
            $.ajax({
                url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=product&id=<?php echo $_GET["id"] ?>",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    let selected = "";
                    $(".form").append(`
                    
                        <label for="product_name">Product Name:</label>
                        <input type="text" id="product_name" name="product_name" value="${data[0].product_name}">
                        <input type="hidden" id="product_id" name="product_id" value="${data[0].product_id}"><br><br>

                        <label for="brand_id">Brand:</label>
                        <select id="brand_id" name="brand_id">
                        </select><br><br>`);
                    $.ajax({
                        url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=brands",
                        type: "GET",
                        dataType: "json",
                        success: function(dataBrands) {
                            data.forEach(brand => {
                                console.log(brand.brand_id);
                                dataBrands.forEach(brandData => {
                                    if (brandData.brand_id == data[0].brand.brand_id) {
                                        selected = "selected";
                                    } else {
                                        selected = "";
                                    }
                                    $("#brand_id").append(`
                                            <option value="${brandData.brand_id}" ${selected}>${brandData.brand_name}</option>
                                        `);
                                });
                            })
                        }
                    })
                    $(".form").append(`
                        <label for="category_id">Category:</label>
                        <select id="category_id" name="category_id">
                        </select><br><br>`);
                    $.ajax({
                        url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=categories",
                        type: "GET",
                        dataType: "json",
                        success: function(dataCategories) {
                            data.forEach(brand => {
                                dataCategories.forEach(categoryData => {
                                    if (categoryData.category_id == data[0].category.category_id) {
                                        selected = "selected";
                                    } else {
                                        selected = "";
                                    }
                                    $("#category_id").append(`
                                            <option value="${categoryData.category_id}" ${selected}>${categoryData.category_name}</option>
                                        `);
                                });
                            })
                        }
                    })
                    $(".form").append(`
                        <label for="product_price">Product Price:</label>
                        <input type="int" id="product_price" name="product_price" value="${data[0].list_price}"><br><br>
                        <label for="model-year">Model Year:</label>
                        <input type="smallint" id="model-year" name="model-year" value="${data[0].model_year}"><br><br>
                       
                        `);



                }
            })
            let submit = document.getElementById("submit");
            if (submit) {
                submit.addEventListener("click", function() {
                    $.ajax({
                        url: `https://bikestoresab.alwaysdata.net/bikestores/api.php?actionPut=updateProduct&id=${$("#product_id").val()}&name=${$("#product_name").val()}
                        &modelyear=${$("#model-year").val()}&listprice=${$("#product_price").val()}&category=${$("#category_id").val()}&brand=${$("#brand_id").val()}&KEY=e8f1997c763`,
                        type: "PUT",
                        dataType: "json",

                        success: function(data) {
                            console.log(data);
                            if (data.error) {
                                $("#success").empty();
                                $("#error").text("Error updating product:) " + data.error);
                            } else {
                                $("#error").empty();
                                $("#success").text("Product updated successfully");}
                        },
                        error: function(xhr, status, error) {
                            console.error("Error:", error);
                            console.error("Response Text:", xhr.responseText); // Affiche la réponse brute
                            document.getElementById("error").innerHTML = "Error updating product";
                        }
                    });
                })
            }

        }
        if (modif == "brand") {
            $('#back-link').attr('href', 'index.php?action=GestionE&click=brand');

            $.ajax({
                url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=brand&id=<?php echo $_GET["id"] ?>",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $(".form").append(`
                        <label for="brand_name">Brand Name:</label>
                        <input type="int" id="brand_name" name="brand_name" value="${data[0].brand_name}">
                        <input type="hidden" id="brand_id" name="brand_id" value="${data[0].brand_id}"><br><br>
                        `);
                }
            })
            let submit = document.getElementById("submit");
            if (submit) {
                console.log("submit exists");
                submit.addEventListener("click", function() {
                    console.log("submit clicked");
                    $.ajax({
                        url: `https://bikestoresab.alwaysdata.net/bikestores/api.php?actionPut=updateBrand&id=${$("#brand_id").val()}&name=${$("#brand_name").val()}&KEY=e8f1997c763`,
                        type: "PUT",
                        dataType: "json",
                        success: function(data) {
                            if (data.error) {
                                $("#success").empty();
                                $("#error").text("Error updating brand:) " + data.error);
                            } else {
                                $("#error").empty();
                                $("#success").text("brand updated successfully");}
                        },
                        error: function(xhr, status, error) {
                            console.error("Error:", error);
                            console.error("Response Text:", xhr.responseText); // Affiche la réponse brute
                            document.getElementById("error").innerHTML = "Error updating brand";
                        }
                    });
                })
            }
        }
        if (modif == "category") {
            $('#back-link').attr('href', 'index.php?action=GestionE&click=category');

            $.ajax({
                url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=categorie&id=<?php echo $_GET["id"] ?>",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data[0].category_id);

                    $(".form").append(`
                        <label for="category_name">Category Name:</label>
                        <input type="int" id="category_name" name="category_name" value="${data[0].category_name}">
                        <input type="hidden" id="category_id" name="category_id" value="${data[0].category_id}"><br><br>
                        `);
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                    console.error("Response Text:", xhr.responseText); // Affiche la réponse brute
                    document.getElementById("error").innerHTML = "Error fetching category data";
                }
            })
            let submit = document.getElementById("submit");
            if (submit) {
                console.log("submit exists");
                submit.addEventListener("click", function() {
                    console.log("submit clicked");
                    $.ajax({
                        url: `https://bikestoresab.alwaysdata.net/bikestores/api.php?actionPut=updateCategorie&id=${$("#category_id").val()}&name=${$("#category_name").val()}&KEY=e8f1997c763`,
                        type: "PUT",
                        dataType: "json",
                        success: function(data) {
                           if(data.error){
                                $("#success").empty();
                                $("#error").text("Error updating category:) " + data.error);
                            }else{
                                $("#error").empty();
                                $("#success").text("category updated successfully");}
                        },
                        error: function(xhr, status, error) {
                            console.error("Error:", error);
                            console.error("Response Text:", xhr.responseText); // Affiche la réponse brute
                            document.getElementById("error").innerHTML = "Error updating category";
                        }
                    });
                })
            }


        }
        if (modif == "stock") {
            $('#back-link').attr('href', 'index.php?action=GestionE&click=stock');
            $.ajax({
                url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=stock&id=<?php echo $_GET["id"] ?>",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $(".form").append(`
                        <label for="product_id">Product:</label>
                        <input type="text" id="product_name" name="product_name" value="${data[0].product.product_name}" disabled>
                        <input type="hidden" id="stock_id" name="stock_id" value="${data[0].stock_id}"><br><br>
                        <label for="store_id">Store:</label>
                        <input type="int" id="store_id" name="store_id" value="${data[0].store.store_name}" disabled>
                        <label for="quantity">Quantity:</label>
                        <input type="int" id="quantity" name="quantity" value="${data[0].quantity}"><br><br>
                        `);
                }
            })
            let submit = document.getElementById("submit");
            if (submit) {
                console.log("submit exists");
                submit.addEventListener("click", function() {
                    console.log("submit clicked");
                    $.ajax({
                        url: `https://bikestoresab.alwaysdata.net/bikestores/api.php?actionPut=updateStock&id=${$("#stock_id").val()}&quantity=${$("#quantity").val()}&KEY=e8f1997c763`,
                        type: "PUT",
                        dataType: "json",
                        success: function(data) {

                            if (data.error) {
                                $("#success").empty();
                                $("#error").text("Error updating stock:) " + data.error);
                            } else {
                                $("#error").empty();
                                $("#success").text("Stock updated successfully");}
                        },
                        error: function(xhr, status, error) {
                            console.error("Error:", error);
                            console.error("Response Text:", xhr.responseText); // Affiche la réponse brute
                            document.getElementById("error").innerHTML = "Error updating stock";
                        }
                    });
                })
            }
        }
        if (modif == "store") {
            $('#back-link').attr('href', 'index.php?action=GestionE&click=store');

            $.ajax({
                url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=store&id=<?php echo $_GET["id"] ?>",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $(".form").append(`
                        <label for="store_name">Store Name:</label>
                        <input type="text" id="store_name" name="store_name" value="${data[0].store_name}">
                        <input type="hidden" id="store_id" name="store_id" value="${data[0].store_id}"><br><br>
                        <label for="store_phone">Store Phone:</label>
                        <input type="text" id="store_phone" name="store_phone" value="${data[0].phone}"><br><br>
                        <label for="store_email">Store Email:</label>
                        <input type="text" id="store_email" name="store_email" value="${data[0].email}"><br><br>
                        <label for="store_street">Store Street:</label>
                        <input type="text" id="store_street" name="store_street" value="${data[0].street}"><br><br>
                        <label for="store_city">Store City:</label>
                        <input type="text" id="store_city" name="store_city" value="${data[0].city}"><br><br>
                        <label for="store_state">Store State:</label>
                        <input type="text" id="store_state" name="store_state" value="${data[0].state}"><br><br>
                        <label for="store_zip">Store Zip Code:</label>
                        <input type="text" id="store_zip" name="store_zip" value="${data[0].zip_code}"><br><br>

                        `);
                }
            })
            let submit = document.getElementById("submit");
            if (submit) {
                console.log("submit exists");
                submit.addEventListener("click", function() {
                    console.log("submit clicked");
                    $.ajax({
                        url: `https://bikestoresab.alwaysdata.net/bikestores/api.php?actionPut=updateStore&id=${$("#store_id").val()}&name=${$("#store_name").val()}&phone=${$("#store_phone").val()}&email=${$("#store_email").val()}&street=${$("#store_street").val()}&city=${$("#store_city").val()}&state=${$("#store_state").val()}&zip=${$("#store_zip").val()}&KEY=e8f1997c763`,
                        type: "PUT",
                        dataType: "json",
                        success: function(data) {
                            if(data.error){
                                $("#success").empty();
                                $("#error").text("Error updating store:) " + data.error);
                            }else{
                                $("#error").empty();
                                $("#success").text("Store updated successfully");}
                        },
                        error: function(xhr, status, error) {
                            console.error("Error:", error);
                            console.error("Response Text:", xhr.responseText); // Affiche la réponse brute
                            document.getElementById("error").innerHTML = "Error updating store";
                        }
                    });
                })
            }
        }
    });
</script>
<a id="back-link" href="index.php?action=GestionE" class="btn btn-warning mb-4">Back</a>
    <div class="card shadow p-4">
        <div class="modification">
            <form method="POST" class="form row g-3">
            </form>
            <div class="d-flex justify-content-center">
                <input type="submit" value="Update" id="submit" class="btn btn-secondary mt-3">
            </div>
            <p id="error" class="text-danger mt-3 text-center"></p>
            <p id="success" class="text-success mt-3 text-center"></p>
        </div>
    </div>
</main>
<?php include_once("www/footer.php");?>