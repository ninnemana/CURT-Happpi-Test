<?php
require_once('libraries/happpi/LoadAll.php');




if(isset($_GET['lifestyle'])){
	// bread crumbs

	$catID = $_GET['lifestyle'];
	$category = new happpi\Category();
	$lifestyle = $category->getLifestyle($catID);

	echo '<a href="lifestyle.php">Lifestyles</a> > ';
	echo $lifestyle->getCatTitle();
	echo "<br />";

	echo "<hr />";
	//echo '<img src="' . . '" />';
	echo "<h1>" . $lifestyle->getCatTitle() . "</h1>";
	echo $lifestyle->getContent()[1]->getContent();

	$towableList = $lifestyle->getTowables();
	foreach($towableList as $trailer){
		echo '<img src="' . $trailer->getImage() . '" height="100" />';
		echo "<br />";
		echo $trailer->getName();
		echo "<br />";
		echo "<br />";
	}
} // end isset lifestyle


echo "<h1>Products to fit your Lifestyle</h1>";


$category = new happpi\Category();

foreach($category->getLifestyles() as $Lifestyle){
	echo '<div style="width:500px;clear:both;padding-bottom: 10px;">';
	echo '<a href="Lifestyle.php?lifestyle=' . $Lifestyle->getCatID() . '">';
		echo '<img src="' . $Lifestyle->getImage() . '" style="float:left;padding-right:10px;" />';
		echo "<h2>" . $Lifestyle->getCatTitle() . "</h2>";
	echo "</a>";
	echo $Lifestyle->getShortDesc();
	echo "</div>";
}


?>