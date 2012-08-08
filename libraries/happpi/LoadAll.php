<?php
namespace happpi;
	/*
	*	Includes/Requires all the main classes for the library
	*	This allows you to simply require LoadAll.php rather than...
	*	all of these files individually.
	*
	*	You can still require individual files like so:
	*   require('./Vehicle.php').
	*/
	require_once('lib/Vehicle.php');
	require_once('lib/Part.php');
	require_once('lib/Customer.php');
	require_once('lib/Category.php');
	require_once('lib/Search.php');
	require_once('lib/Configuration.php');
	require_once('lib/Helpers.php');


?>