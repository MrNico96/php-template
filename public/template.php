<?php
require_once '../config.php';

// name of the page
$page_title = "Template";

// hide or show header
$header = false;

// hide or show sidebar
$sidebar = false;

// hide or show footer
$footer = false;


// awesome php functions....


// contains all css Files and start html and body tag
include_once '../views/layout/header.view.php';

// contains the html for this page.
include_once '../views/template.view.php';

/* here you can load all the components you need on the page
 include_once DIR . '/views/components/.....';
*/

// end html and body tag
include_once '../views/layout/footer.view.php';