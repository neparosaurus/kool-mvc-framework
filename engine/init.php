<?php
session_start();

spl_autoload_register(function($class)
{
	require_once "core/{$class}.php";
});

require_once 'core/config.php';
require_once 'functions/sanitize.php';
?>