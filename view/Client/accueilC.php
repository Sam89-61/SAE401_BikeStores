<?php
/**
 * Client homepage of the BikeStores website.
 *
 * Displays the interactive map of stores using Leaflet.
 * 
 * @package view\Client
 * @version 1.0
 */

$page = "accueilC";
include_once("www/Client/headerC.php");
?>

<h1>Client Home</h1>
<div id="map"></div>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="JS/Carte/carte.js"></script>
</main>
<?php include_once("www/footer.php"); ?>