<?php
/**
 * Client store page of the BikeStores website.
 *
 * Displays the list of products with dynamic filters (brand, category, price, year).
 * Uses AJAX to load products, brands, and categories from the API.
 * Dynamically updates the display based on the filters selected by the user.
 *
 * @package view\Client
 * @version 1.0
 */
$page = "magasinC";
include_once("www/Client/headerC.php");
?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {


            $.ajax({
                url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=products",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    data.forEach(product => {
                        $("#produits").append(`
                        <div class='product' value='${product.product_id}'>
                            <h3>${product.product_name}</h3>
                            <p>${product.brand.brand_name}</p>
                            <p>${product.category.category_name}</p>
                            <p>${product.model_year}</p>
                            <p>${product.list_price} €</p>
                        </div>
                    `);
                    });
                },
            })

            $.ajax({
                url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=brands",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    data.forEach(brand => {
                        $("#marqueSelect").append(`<option value='${brand.brand_id}'>${brand.brand_name}</option>`);
                    });
                }
            });

            // Charger les catégories
            $.ajax({
                url: "https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=categories",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    data.forEach(category => {
                        $("#categorieSelect").append(`<option value='${category.category_id}'>${category.category_name}</option>`);
                    });
                }
            });

            // Fonction pour appliquer les filtres
            function applyFilters() {
                var brandId = $("#marqueSelect").val();
                var categoryId = $("#categorieSelect").val();
                var priceMin = $("#prixMin").val();
                var priceMax = $("#prixMax").val();
                var year = $("#anneeI").val();

                $.ajax({
                    url: `https://bikestoresab.alwaysdata.net/bikestores/api.php?actionGet=productbyfiltre&brandid=${brandId}&categoryid=${categoryId}&listpricemin=${priceMin}&listpricemax=${priceMax}&annee=${year}`,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $("#produits").empty(); // Vider la liste des produits
                        if (data.length > 0) {
                            data.forEach(product => {
                                $("#produits").append(`
                                <div class='product' value='${product.product_id}'>
                                    <h3>${product.product_name}</h3>
                                    <p>${product.brand.brand_name}</p>
                                    <p>${product.category.category_name}</p>
                                    <p>${product.model_year}</p>
                                    <p>${product.list_price} $</p>
                                </div>
                            `);
                            });
                        } else {
                            $("#produits").append("<p>No products found.</p>");
                        }
                    },
                    error: function() {
                        $("#produits").empty();
                        $("#produits").append("<p>Error while loading products.</p>");
                    }
                });
            }

            // Appliquer les filtres à chaque changement
            $("#marqueSelect, #categorieSelect, #prixMin, #prixMax, #anneeI").on("change keyup", function() {
                applyFilters();
            });
        });
    </script>

    <div id="content">
        <div id="Filtre" class="container my-4">
            <h1 class="text-center mb-4">Filter</h1>
            <div class="row g-3">
                <!-- Marque -->
                <div class="col-md-6 col-lg-3">
                    <h2 class="h5">Brand</h2>
                    <select id="marqueSelect" class="form-select">
                        <option value>Choose a brand</option>
                    </select>
                </div>
                <!-- Catégorie -->
                <div class="col-md-6 col-lg-3">
                    <h2 class="h5">Category</h2>
                    <select id="categorieSelect" class="form-select">
                        <option value>Choose a category</option>
                    </select>
                </div>
                <!-- Prix -->
                <div class="col-md-6 col-lg-3">
                    <h2 class="h5">Price</h2>
                    <input type="number" id="prixMin" class="form-control mb-2" placeholder="Prix minimum">
                    <input type="number" id="prixMax" class="form-control" placeholder="Prix maximum">
                </div>
                <!-- Année -->
                <div class="col-md-6 col-lg-3">
                    <h2 class="h5">Year</h2>
                    <input type="number" id="anneeI" class="form-control" placeholder="Année" maxlength="4">
                </div>
            </div>
        </div>
        <div id="produits"></div>
    </div>

</main>

<?php include_once("www/footer.php");?>