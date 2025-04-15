<?php
header('Content-type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
require __DIR__ . "/../bootstrap.php";

use Entity\Stores;
use Entity\Products;
use Repository\ProductRepository;
use Entity\Stocks;
use Entity\Employees;



$request_method = $_SERVER['REQUEST_METHOD'];
$keyAPI="e8f1997c763";

switch ($request_method) {

    case 'GET':
        if (!isset($_REQUEST["actionGet"])) {
            break;
        }
        switch ($_REQUEST["actionGet"]) {
            case "employees":
                $employees = $entityManager->getRepository('Entity\Employees')->getAllEmployee();
                if ($employees == null) {
                    echo json_encode(["error" => "No employees found"]);
                    break;
                }

                echo json_encode($employees);
                break;
            case "employee":
                if (!isset($_REQUEST["id"])) {
                    echo json_encode(["error" => "No ID provided"]);
                    break;
                }
                $employee = $entityManager->getRepository('Entity\Employees')->getEmployeeById($_REQUEST["id"]);
                if ($employee == null) {
                    echo json_encode(["error" => "No employee found"]);
                    break;
                }

                echo json_encode($employee);
                break;
            case "employeeByStore":
                if (!isset($_REQUEST["id"])) {
                    echo json_encode(["error" => "No ID provided"]);
                    break;
                }
                $employee = $entityManager->getRepository('Entity\Employees')->getEmployeeByStore($_REQUEST["id"]);
                if ($employee == null) {
                    echo json_encode(["error" => "No employee found"]);
                    break;
                }

                echo json_encode($employee);
                break;
            case "stores":
                $stores = $entityManager->getRepository('Entity\Stores')->getAllStore();
                if ($stores == null) {
                    echo json_encode(["error" => "No stores found"]);
                    break;
                }
                echo json_encode($stores);
                break;
            case "store":
                if (!isset($_GET["id"])) {
                    echo json_encode(["error" => "store No ID provided"]);
                    break;
                }
                $store = $entityManager->getRepository('Entity\Stores')->getStoreById($_REQUEST["id"]);
                if ($store == null) {
                    echo json_encode(["error" => "No store found"]);
                    break;
                }
                echo json_encode($store);
                break;
            case "products":
                $repo = $entityManager->getRepository('Entity\Products');
                $products = $repo->getAllProducts();
                if ($products == null) {
                    echo json_encode(["error" => "No products found"]);
                    break;
                }

                echo json_encode($products);
                break;
            case "product":
                if (!isset($_GET["id"])) {
                    echo json_encode(["error" => "product No ID provided"]);
                    break;
                }
                $product = $entityManager->getRepository('Entity\Products')->getProductById($_REQUEST["id"]);
                if ($product == null) {
                    echo json_encode(["error" => "No product found"]);
                    break;
                }

                echo json_encode($product);
                break;
            case "productbybrand":
                if (!isset($_REQUEST["id"])) {
                    echo json_encode(["error" => "product No ID provided"]);
                    break;
                }
                $product = $entityManager->getRepository('Entity\Products')->getProductbyBrand();
                if ($product == null) {
                    echo json_encode(["error" => "No product found"]);
                    break;
                }

                echo json_encode($product);
                break;
            case "productbycategory":
                if (!isset($_REQUEST["id"])) {
                    echo json_encode(["error" => "product No ID provided"]);
                    break;
                }
                $product = $entityManager->getRepository('Entity\Products')->getProductbyCategory();
                if ($product == null) {
                    echo json_encode(["error" => "No product found"]);
                    break;
                }

                echo json_encode($product);
                break;
            case "productbyfiltre":

                $product = $entityManager->getRepository('Entity\Products')->getProductbyFilter();
                if ($product == null) {
                    echo json_encode(["error" => "No product found"]);
                    break;
                }

                echo json_encode($product);
                break;

            case "stocks":
                $stocks = $entityManager->getRepository('Entity\Stocks')->getAllStock();
                if ($stocks == null) {
                    echo json_encode(["error" => "No stocks found"]);
                    break;
                }

                echo json_encode($stocks);
                break;

            case "stock":
                if (!isset($_GET["id"])) {
                    echo json_encode(["error" => "stock No ID provided"]);
                    break;
                }
                $stock = $entityManager->getRepository('Entity\Stocks')->getStockById($_REQUEST["id"]);
                if ($stock == null) {
                    echo json_encode(["error" => "No stock found"]);
                    break;
                }

                echo json_encode($stock);
                break;
            case "stockbystore":
                if (!isset($_GET["id"])) {
                    echo json_encode(["error" => "stock No ID provided"]);
                    break;
                }
                $stock = $entityManager->getRepository('Entity\Stocks')->getStockByStore($_REQUEST["id"]);
                if ($stock == null) {
                    echo json_encode(["error" => "No stock found"]);
                    break;
                }

                echo json_encode($stock);
                break;
            case "brands":
                $brands = $entityManager->getRepository('Entity\Brands')->getAllBrands();
                if ($brands == null) {
                    echo json_encode(["error" => "No brands found"]);
                    break;
                }
                echo json_encode($brands);
                break;
            case "brand":
                if (!isset($_GET["id"])) {
                    echo json_encode(["error" => "brand Noddd ID provided"]);
                    break;
                }
                $brand = $entityManager->getRepository('Entity\Brands')->getBrandById($_REQUEST["id"]);
                if ($brand == null) {
                    echo json_encode(["error" => "No brand found"]);
                    break;
                }
                echo json_encode($brand);
                break;
            case "categories":
                $categories = $entityManager->getRepository('Entity\Categories')->getAllCategories();
                if ($categories == null) {
                    echo json_encode(["error" => "No categories found"]);
                    break;
                }
                echo json_encode($categories);
                break;
            case "categorie":
                if (!isset($_GET["id"])) {
                    echo json_encode(["error" => "categorie No ID provided"]);
                    break;
                }
                $categorie = $entityManager->getRepository('Entity\Categories')->getCategorieById($_REQUEST["id"]);
                if ($categorie == null) {
                    echo json_encode(["error" => "No categorie found"]);
                    break;
                }
                echo json_encode($categorie);
                break;
        }
        break;
    case 'POST':
        if (!isset($_REQUEST['KEY']) || $_REQUEST['KEY'] !== "e8f1997c763") {
            echo json_encode(["error" => "Invalid API key"]);
            break;
        }
        if (!isset($_REQUEST["actionPost"])) {
            break;
        }

        switch ($_REQUEST["actionPost"]) {
            case "insertEmployee":
                if (
                    !isset($_REQUEST["name"]) || trim($_REQUEST["name"]) === "" ||
                    !isset($_REQUEST["role"]) || trim($_REQUEST["role"]) === "null" ||
                    !isset($_REQUEST["store"]) || trim($_REQUEST["store"]) === "null" ||
                    !isset($_REQUEST["email"]) || trim($_REQUEST["email"]) === "" ||
                    !isset($_REQUEST["password"]) || trim($_REQUEST["password"]) === ""
                ) {
                    echo json_encode(["error" => "Missing parameters"]);
                    break;
                }

                // Validation des autres paramètres
                if (!preg_match("/^[a-zA-ZÀ-ÿ0-9' -]{1,255}$/", $_REQUEST["name"])) {
                    echo json_encode(["error" => "Invalid name parameter"]);
                    break;
                }

                if (!filter_var($_REQUEST["email"], FILTER_VALIDATE_EMAIL)) {
                    echo json_encode(["error" => "Invalid email parameter"]);
                    break;
                }

                if (!preg_match("/^[a-zA-ZÀ-ÿ0-9!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?~`]{6,255}$/", $_REQUEST["password"])) {
                    echo json_encode(["error" => "Invalid password parameter (6 characters minimum)"]);
                    break;
                }

                // Récupération du store et insertion
                $st = $entityManager->getRepository('Entity\Stores')->getStoreById($_REQUEST["store"]);
                $result = $entityManager->getRepository('Entity\Employees')->insertEmployee($st[0], $_REQUEST["name"], $_REQUEST["email"], $_REQUEST["password"], $_REQUEST["role"]);
                if ($result === "ok") {
                    echo json_encode(["success" => "Employee added"]);
                } else {
                    echo json_encode(["error" => "Failed to add employee"]);
                }
                break;
            case "insertProduct":
                if (
                    !isset($_REQUEST["name"]) || !isset($_REQUEST["modelyear"]) || !isset($_REQUEST["listprice"]) ||
                    !isset($_REQUEST["category"]) || !isset($_REQUEST["brand"]) || trim($_REQUEST["category"]) === "null" || trim($_REQUEST["brand"]) === "null"
                ) {
                    echo json_encode(["error" => "Missing parameters"]);
                    break;
                }
                if (!preg_match("/^[a-zA-ZÀ-ÿ0-9' -]{1,255}$/", $_REQUEST["name"]) || !preg_match("/^[0-9]{4}$/", $_REQUEST["modelyear"]) || !preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $_REQUEST["listprice"])) {
                    echo json_encode(["error" => "Invalid parameters"]);
                    break;
                }
                $category = $entityManager->getRepository('Entity\Categories')->getCategorieById($_REQUEST["category"]);
                $brand = $entityManager->getRepository('Entity\Brands')->getBrandById($_REQUEST["brand"]);
                $result = $entityManager->getRepository('Entity\Products')->insertProduct($category[0], $brand[0], $_REQUEST["name"], $_REQUEST["modelyear"], $_REQUEST["listprice"]);
                if ($result === "ok") {
                    echo json_encode(["success" => "Product added"]);
                } else {
                    echo json_encode(["error" => "Failed to add product"]);
                }
                break;
            case "insertBrand":
                if (!isset($_REQUEST["name"])) {
                    echo json_encode(["error" => "Missing parameters"]);
                    break;
                }
                if (!preg_match("/^[a-zA-ZÀ-ÿ0-9' -]{1,255}$/", $_REQUEST["name"])) {
                    echo json_encode(["error" => "Invalid parameters"]);
                    break;
                }
                $result = $entityManager->getRepository('Entity\Brands')->insertBrand($_REQUEST["name"]);
                if ($result === "ok") {
                    echo json_encode(["success" => "Brand added"]);
                    break;
                } else {
                    echo json_encode(["error" => "Failed to add brand"]);
                    break;
                }
                break;
            case "insertCategorie":
                if (!isset($_REQUEST["name"])) {
                    echo json_encode(["error" => "Missing parameters"]);
                    break;
                }
                if (!preg_match("/^[a-zA-ZÀ-ÿ0-9' -]{1,255}$/", $_REQUEST["name"])) {
                    echo json_encode(["error" => "Invalid parameters"]);
                    break;
                }
                $result = $entityManager->getRepository('Entity\Categories')->insertCategorie($_REQUEST["name"]);
                if ($result === "ok") {
                    echo json_encode(["success" => "Categorie added"]);
                } else {
                    echo json_encode(["error" => "Failed to add categorie"]);
                }
                break;
            case "insertStore":
                if (!isset($_REQUEST["name"]) || !isset($_REQUEST["email"]) || !isset($_REQUEST["phone"]) || !isset($_REQUEST["street"]) || !isset($_REQUEST["zip"]) || !isset($_REQUEST["city"]) || !isset($_REQUEST["state"])) {
                    echo json_encode(["error" => "Missing parameters"]);
                    break;
                }
                if (!preg_match("/^[a-zA-ZÀ-ÿ0-9' -]{1,255}$/", $_REQUEST["name"])) {
                    echo json_encode(["error" => "Invalid name parameter"]);
                    break;
                }

                if (!filter_var($_REQUEST["email"], FILTER_VALIDATE_EMAIL)) {
                    echo json_encode(["error" => "Invalid email parameter"]);
                    break;
                }

                if (!preg_match("/^[0-9\s()+-]{8,25}$/", $_REQUEST["phone"])) {
                    echo json_encode(["error" => "Insvalid phone parameter"]);
                    break;
                }

                if (!preg_match("/^[a-zA-ZÀ-ÿ0-9' -]{1,255}$/", $_REQUEST["street"])) {
                    echo json_encode(["error" => "Invalid street parameter"]);
                    break;
                }

                if (!preg_match("/^[0-9]{5}$/", $_REQUEST["zip"])) {
                    echo json_encode(["error" => "Invalid zip code parameter"]);
                    break;
                }

                if (!preg_match("/^[a-zA-ZÀ-ÿ0-9' -]{1,255}$/", $_REQUEST["city"])) {
                    echo json_encode(["error" => "Invalid city parameter"]);
                    break;
                }

                if (!preg_match("/^[a-zA-ZÀ-ÿ0-9' -]{1,10}$/", $_REQUEST["state"])) {
                    echo json_encode(["error" => "Invalid state parameter"]);
                    break;
                }

                $result = $entityManager->getRepository('Entity\Stores')->insertStore($_REQUEST["name"], $_REQUEST["email"], $_REQUEST["phone"], $_REQUEST["street"], $_REQUEST["zip"], $_REQUEST["city"], $_REQUEST["state"]);
                if ($result === "ok") {
                    echo json_encode(["success" => "Store added"]);
                } else {
                    echo json_encode(["error" => "Failed to add store"]);
                }
                break;
            case "insertStock":
                if (!isset($_REQUEST["product"]) || !isset($_REQUEST["store"]) || !isset($_REQUEST["quantity"]) || trim($_REQUEST["product"]) === "null" || trim($_REQUEST["store"]) === "null") {
                    echo json_encode(["error" => "Missing parameters"]);
                    break;
                }
                if (!preg_match("/^[0-9]+$/", $_REQUEST["quantity"])) {
                    echo json_encode(["error" => "Invalid parameters"]);
                    break;
                }
                $product = $entityManager->getRepository('Entity\Products')->getProductById($_REQUEST["product"]);
                $store = $entityManager->getRepository('Entity\Stores')->getStoreById($_REQUEST["store"]);
                $result = $entityManager->getRepository('Entity\Stocks')->insertStock($product[0], $store[0], $_REQUEST["quantity"]);
                if ($result === "ok") {
                    echo json_encode(["success" => "Stock added"]);
                } else {
                    echo json_encode(["error" => "Failed to add stock"]);
                }
                break;
        }
        break;
    case "PUT":
        if (!isset($_REQUEST['KEY']) || $_REQUEST['KEY'] !== "e8f1997c763") {
            echo json_encode(["error" => "Invalid API key"]);
            break;
        }
        if (!isset($_REQUEST["actionPut"])) {
            break;
        }
        switch ($_REQUEST["actionPut"]) {
            case "updateEmployee":
                if (!isset($_REQUEST["id"]) || !isset($_REQUEST["name"]) || !isset($_REQUEST["role"]) || !isset($_REQUEST["email"]) || !isset($_REQUEST["store"]) || !isset($_REQUEST["password"])) {
                    echo json_encode(["error" => "Missing parameters"]);
                    break;
                }

                if (!preg_match("/^[a-zA-ZÀ-ÿ0-9' -]{1,255}$/", trim($_REQUEST["name"])) || !preg_match("/^[a-zA-ZÀ-ÿ0-9' -]{2,255}$/", $_REQUEST["role"]) || !filter_var($_REQUEST["email"], FILTER_VALIDATE_EMAIL) || !preg_match("/^[a-zA-ZÀ-ÿ0-9!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?~`]{6,255}$/", $_REQUEST["password"])) {
                    echo json_encode(["error" => "Invalid parameters"]);
                    break;
                }
                $store = $entityManager->getRepository('Entity\Stores')->getStoreById($_REQUEST["store"]);
                $result = $entityManager->getRepository('Entity\Employees')->updateEmployee($_REQUEST["id"], $store[0], $_REQUEST["name"], $_REQUEST["email"], $_REQUEST["password"], $_REQUEST["role"]);
                if ($result === "ok") {
                    echo json_encode(["success" => "Employee updated"]);
                } else {
                    echo json_encode(["error" => "Failed to update employee"]);
                }
                break;
            case "udapteConnexE":
                if (!isset($_REQUEST["id"]) || !isset($_REQUEST["name"]) || !isset($_REQUEST["email"]) || !isset($_REQUEST["password"])) {
                    echo json_encode(["error" => "Missing parameters"]);
                    break;
                }
                if (!preg_match("/^[a-zA-ZÀ-ÿ0-9' -]{1,255}$/", $_REQUEST["name"]) || !filter_var($_REQUEST["email"], FILTER_VALIDATE_EMAIL) || !preg_match("/^[a-zA-ZÀ-ÿ0-9!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?~`]{6,255}$/", $_REQUEST["password"])) {
                    echo json_encode(["error" => "Invalid parameters"]);
                    break;
                }
                $result = $entityManager->getRepository('Entity\Employees')->updateConnexE($_REQUEST["id"], $_REQUEST["email"], $_REQUEST["password"], $_REQUEST["name"]);
                if ($result === "ok") {
                    echo json_encode(["success" => "Employee updated"]);
                } else {
                    echo json_encode(["error" => "Failed to update employee"]);
                }
                break;
            case "updateProduct":
                if (!isset($_REQUEST["id"]) || !isset($_REQUEST["name"]) || !isset($_REQUEST["modelyear"]) || !isset($_REQUEST["listprice"]) || !isset($_REQUEST["category"]) || !isset($_REQUEST["brand"])) {
                    echo json_encode(["error" => "Missing parameters"]);
                    break;
                }

                if (!preg_match("/^[a-zA-ZÀ-ÿ0-9' -]{1,255}$/", trim($_REQUEST["name"])) || !preg_match("/^[0-9]{4}$/", $_REQUEST["modelyear"]) || !preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $_REQUEST["listprice"])) {
                    echo json_encode(["error" => "Invalid parameters"]);
                    break;
                }
                $category = $entityManager->getRepository('Entity\Categories')->getCategorieById($_REQUEST["category"]);
                $brand = $entityManager->getRepository('Entity\Brands')->getBrandById($_REQUEST["brand"]);
                $result = $entityManager->getRepository('Entity\Products')->updateProduct($_REQUEST["id"], $category[0], $brand[0], $_REQUEST["name"], $_REQUEST["modelyear"], $_REQUEST["listprice"]);
                if ($result === "ok") {
                    echo json_encode(["success" => "Product updated"]);
                } else {
                    echo json_encode(["error" => "Failed to update product"]);
                }
                break;
            case "updateBrand":
                if (!isset($_REQUEST["id"]) || !isset($_REQUEST["name"])) {
                    echo json_encode(["error" => "Missing parameters"]);
                    break;
                }
                if (!preg_match("/^[a-zA-ZÀ-ÿ0-9' -]{1,255}$/", $_REQUEST["name"])) {
                    echo json_encode(["error" => "Invalid parameters"]);
                    break;
                }
                $result = $entityManager->getRepository('Entity\Brands')->updateBrand($_REQUEST["id"], $_REQUEST["name"]);
                if ($result === "ok") {
                    echo json_encode(["success" => "Brand updated"]);
                } else {
                    echo json_encode(["error" => "Failed to update brand"]);
                }
                break;
            case "updateCategorie":
                if (!isset($_REQUEST["id"]) || !isset($_REQUEST["name"])) {
                    echo json_encode(["error" => "Missing parameters"]);
                    break;
                }
                if (!preg_match("/^[a-zA-ZÀ-ÿ0-9' -]{1,255}$/", $_REQUEST["name"])) {
                    echo json_encode(["error" => "Invalid parameters"]);
                    break;
                }
                $result = $entityManager->getRepository('Entity\Categories')->updateCategorie($_REQUEST["id"], $_REQUEST["name"]);
                if ($result === "ok") {
                    echo json_encode(["success" => "Categorie updated"]);
                } else {
                    echo json_encode(["error" => "Failed to update categorie"]);
                }
                break;
            case "updateStore":
                if (!isset($_REQUEST["id"]) || !isset($_REQUEST["name"]) || !isset($_REQUEST["email"]) || !isset($_REQUEST["phone"]) || !isset($_REQUEST["street"]) || !isset($_REQUEST["zip"]) || !isset($_REQUEST["city"]) || !isset($_REQUEST["state"])) {
                    echo json_encode(["error" => "Missing parameters"]);
                    break;
                }
                if (!preg_match("/^[a-zA-ZÀ-ÿ0-9' -]{2,255}$/", $_REQUEST["name"])) {
                    echo json_encode(["error" => "Invalid name parameter"]);
                    break;
                }

                if (!filter_var($_REQUEST["email"], FILTER_VALIDATE_EMAIL)) {
                    echo json_encode(["error" => "Invalid email parameter"]);
                    break;
                }

                if (!preg_match("/^[0-9\s()+-]{8,25}$/", $_REQUEST["phone"])) {
                    echo json_encode(["error" => "Insvalid phone parameter"]);
                    break;
                }

                if (!preg_match("/^[a-zA-ZÀ-ÿ0-9' -]{2,255}$/", $_REQUEST["street"])) {
                    echo json_encode(["error" => "Invalid street parameter"]);
                    break;
                }

                if (!preg_match("/^[0-9]{5}$/", $_REQUEST["zip"])) {
                    echo json_encode(["error" => "Invalid zip code parameter"]);
                    break;
                }

                if (!preg_match("/^[a-zA-ZÀ-ÿ0-9' -]{2,255}$/", $_REQUEST["city"])) {
                    echo json_encode(["error" => "Invalid city parameter"]);
                    break;
                }

                if (!preg_match("/^[a-zA-ZÀ-ÿ0-9' -]{1,10}$/", $_REQUEST["state"])) {
                    echo json_encode(["error" => "Invalid state parameter"]);
                    break;
                }
                $result = $entityManager->getRepository('Entity\Stores')->updateStore($_REQUEST["id"], $_REQUEST["name"], $_REQUEST["email"], $_REQUEST["phone"], $_REQUEST["street"], $_REQUEST["zip"], $_REQUEST["city"], $_REQUEST["state"]);
                if ($result === "ok") {
                    echo json_encode(["success" => "Store updated"]);
                } else {
                    echo json_encode(["error" => "Failed to update store"]);
                }
                break;
            case "updateStock":

                if (!isset($_REQUEST["id"]) ||  !isset($_REQUEST["quantity"])) {
                    echo json_encode(["error" => "Missing parameters"]);
                    break;
                }
                if (!preg_match("/^[0-9]+$/", $_REQUEST["quantity"])) {
                    echo json_encode(["error" => "Invalid parameters"]);
                    break;
                }

                $result = $entityManager->getRepository('Entity\Stocks')->updateStock($_REQUEST["id"], $_REQUEST["quantity"]);
                if ($result === "ok") {
                    echo json_encode(["success" => "Stock updated"]);
                } else {
                    echo json_encode(["error" => "Failed to update stock"]);
                }
                break;
        }
        break;
    case "DELETE":
        if (!isset($_REQUEST['KEY']) || $_REQUEST['KEY'] !== "e8f1997c763") {
            echo json_encode(["error" => "Invalid API key"]);
            break;
        }
        if (!isset($_REQUEST["actionDelete"])) {
            break;
        }
        switch ($_REQUEST["actionDelete"]) {
            case "deleteBrand":
                if (!isset($_REQUEST["id"])) {
                    echo json_encode(["error" => "Missing parameters"]);
                    break;
                }
                $brand = $entityManager->getRepository('Entity\Brands')->deleteBrand($_REQUEST["id"]);
                if ($brand) {
                    echo json_encode(["success" => "Brand updated"]);
                } else {
                    echo json_encode(["error" => "Failed to update stock"]);
                }
                break;
            case "deleteCategorie":
                if (!isset($_REQUEST["id"])) {
                    echo json_encode(["error" => "Missing parameters"]);
                    break;
                }
                $categorie = $entityManager->getRepository('Entity\Categories')->deleteCategorie($_REQUEST["id"]);
                if ($categorie) {
                    echo json_encode(["success" => "Categorie updated"]);
                } else {
                    echo json_encode(["error" => "Failed to update stock"]);
                }
                break;
            case "deleteProduct":
                if (!isset($_REQUEST["id"])) {
                    echo json_encode(["error" => "Missing parameters"]);
                    break;
                }
                $categorie = $entityManager->getRepository('Entity\Products')->deleteProduct($_REQUEST["id"]);
                if ($categorie) {
                    echo json_encode(["success" => "Products updated"]);
                } else {
                    echo json_encode(["error" => "Failed to update stock"]);
                }
                break;
            case "deleteStock":
                if (!isset($_REQUEST["id"])) {
                    echo json_encode(["error" => "Missing parameters"]);
                    break;
                }
                $categorie = $entityManager->getRepository('Entity\Stocks')->deleteStock($_REQUEST["id"]);
                if ($categorie) {
                    echo json_encode(["success" => "Stock updated"]);
                } else {
                    echo json_encode(["error" => "Failed to update stock"]);
                }
                break;
            case "deleteStore":
                if (!isset($_REQUEST["id"])) {
                    echo json_encode(["error" => "Missing parameters"]);
                    break;
                }
                $categorie = $entityManager->getRepository('Entity\Stores')->deleteStore($_REQUEST["id"]);
                if ($categorie) {
                    echo json_encode(["success" => "Stores updated"]);
                } else {
                    echo json_encode(["error" => "Failed to update stock"]);
                }
                break;
        }
        break;
}
