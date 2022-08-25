<?php
session_start();
session_destroy();
require_once("../Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
header("Location: ".$routeController->getRoute("index"));