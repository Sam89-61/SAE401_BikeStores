<?php
/**
 * Employee homepage of the BikeStores website.
 *
 * Displays the interactive map of stores using Leaflet for employees.
 * Can be enhanced with employee-specific features.
 *
 * @package view\Employee
 * @version 1.0
 */

$page="accueilE";
include_once("www/Employee/headerE.php")
?>
<h1>Employee Home</h1>

<div id="map"></div>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="JS/Carte/carte.js"></script>
</main>
<?php include_once("www/footer.php");?>