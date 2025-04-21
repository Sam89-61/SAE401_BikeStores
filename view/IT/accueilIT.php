<?php
/**
 * IT employee homepage for the BikeStores website.
 *
 * Displays the interactive map of stores using Leaflet for IT employees.
 * Can be extended with IT-specific features.
 *
 * @package view\IT
 * @version 1.0
 */
$page="accueilIT";
include_once("www/IT/headerIT.php");
?>
<h1>IT Home</h1>


<div id="map"></div>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="JS/Carte/carte.js"></script>
   
</script>
</main>
<?php include_once("www/footer.php");?>