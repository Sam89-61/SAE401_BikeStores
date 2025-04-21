<?php
/**
 * Chef employee homepage for the BikeStores website.
 *
 * Displays the interactive map of stores using Leaflet for Chef employees.
 * Can be extended with Chef-specific features.
 *
 * @package view\Chef
 * @version 1.0
 */

$page="accueilE";
include_once("www/Chef/headerEC.php");
?>
<h1>Employee Chef Home</h1>


<div id="map"></div>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="JS/Carte/carte.js"></script>
   
</script>
<?php include_once("www/footer.php");?>
</main>