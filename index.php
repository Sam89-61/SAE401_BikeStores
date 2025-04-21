<?php
/**
 * Main entry point for the BikeStores website.
 *
 * Starts the session, includes the main controller, and invokes the controller with the current request.
 *
 * @package root
 * @version 1.0
 */
session_start();
session_regenerate_id();
include_once("controller/Controller.php");
$controller = new Controller($_REQUEST);
$controller->invoke($entityManager);
?>