<?php
session_start();

require "../api/core/Init.php";

$app = new Routes;
$app->loadController();
