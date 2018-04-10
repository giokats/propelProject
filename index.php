<?php

require_once 'controller/ContactsController.php';
include "generated-conf/config.php";

$controller = new ContactsController();

$controller->handleRequest();

?>
