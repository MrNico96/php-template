<?php
//Checks if a login session exists. If not forward to login.

if(!isset($_SESSION['XXX'])){
    go(URL . '/login.php?status=not-logged-in');
}