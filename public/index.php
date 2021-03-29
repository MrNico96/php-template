<?php
require_once '../config.php';

$page_title = "Home";

$header = true;
$sitebar = false;
$footer = true;

if(isset($_GET['success'])){
    $success = "It worked!";
}

if(isset($_GET['error'])){
    $errors = ["This may be an error message.","This may be an second error message."];
}

include_once '../views/layout/header.view.php';
include_once '../views/index.view.php';
include_once DIR . '/views/components/testModal.component.php';
include_once '../views/layout/footer.view.php';