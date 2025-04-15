<?php
setcookie("emailE", "", 0);
setcookie("mdpE", "", 0);
setcookie("emailEC", "", 0);
setcookie("mdpEC", "", 0);
setcookie("emailIT", "", 0);
setcookie("mdpIT", "", 0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/footer.css" rel="stylesheet" />
</head>
<body class="bg-light">

<main class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
        <h2 class="text-center mb-4">Login</h2>
        <form action="index.php?action=log" method="POST" class="Connexion">
            <div class="mb-3">
                <label for="email" class="form-label">E-Mail</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" pattern="[a-zA-Z0-9._-]+@[a-zA-Z]+\.[a-z]{2,}$" required>
            </div>
            <div class="mb-3">
                <label for="mdp" class="form-label">Password</label>
                <input type="password" name="mdp" id="mdp" class="form-control" placeholder="Enter your password" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>

        <?php 
        if(isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger mt-3" role="alert">';
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            echo '</div>';
        }
        ?>
        <div class="mt-4">
            <p class="text-muted small">Example accounts :</p>
            <ul class="list-unstyled">
                <li><strong>johndoe@bikestore.com</strong> - KQ,wDqd9iGtt</li>
                <li><strong>jeremieroth@bikestore.com</strong> - Hvi>wshhGa2c</li>
                <li><strong>shannahsummer@bikestore.com</strong> - TVv(cB4mBEiC</li>
            </ul>
        </div>
    </div>
</main>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php include_once("www/footer.php");?>