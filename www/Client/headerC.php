<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bike</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="style/header.css" rel="stylesheet" />
    <link href="style/Client/accueilC.css" rel="stylesheet" />
    <link href="style/image.css" rel="stylesheet">

    <?php
    if ($page == "magasinC") {
        echo '<link href="style/magasin.css" rel="stylesheet" />';
    }
    ?>
    <link href="style/footer.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-black w-100">
            <div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <img src="assets/bike.png" alt="Bicycle Icon" width="40" height="40" class="me-2">
                    <span class="fw-bold">BikeShop</span>
                </a>

                <!-- Button for responsive menu -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navigation links -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white fw-semibold" href="index.php?action=accueilC">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fw-semibold" href="index.php?action=magasinC">Stores</a>
                        </li>
                    </ul>

                    <!-- User icon -->
                    <div class="d-flex align-items-center">
                        <a href="index.php?action=form" class="text-white text-decoration-none d-flex align-items-center icon">
                            <img src="assets/iconC1.png" alt="User Icon" width="35" height="35" class="rounded-circle me-2">
                            <span class="fw-semibold">My Account</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>