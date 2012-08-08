<?php

require_once('libraries/happpi/LoadAll.php');

if(isset($_GET['partID'])){

$Part = new happpi\Part();
$Part->setPartID($_GET['partID']);

$Part = $Part->getPart();




// breadcrumbs for parts

	$cat = $Part->getPartCategories()[0];
	$numItems = count($Part->getPartBreadCrumbs());
	$i = 0;
	foreach($Part->getPartBreadCrumbs($cat->getCatID()) as $partBreadCrumb){
		$i += 1;
		if($numItems == 1){
			echo '<a href="category.php?catID=' . $partBreadCrumb->getCatID() . '">';
			echo $catBreadCrumb->getCatTitle();
			echo "</a>";
		}elseif($numItems > 1){
			echo '<a href="category.php?catID=' . $partBreadCrumb->getCatID() . '">';			
			echo $partBreadCrumb->getCatTitle();
			echo "</a>";
			echo " > ";
		}
	} 
	echo $Part->getShortDesc();

	echo "<br />";
	if(isset($_COOKIE["vehicleID"])){
	$Vehicle = new happpi\Vehicle();
	$Vehicle->setYear($_COOKIE["vehicle_year"]);
	$Vehicle->setMake($_COOKIE["vehicle_make"]);
	$Vehicle->setModel($_COOKIE["vehicle_model"]);
	$Vehicle->setStyle($_COOKIE["vehicle_style"]);
	$yourVehicle = $Vehicle->getVehicle();
	echo "Your vehicle:<strong> " . $yourVehicle->getYear() . " " . $yourVehicle->getMake() . " " . $yourVehicle->getModel() . " " . $yourVehicle->getStyle() . "</strong>";
	}




echo "<h1>";
echo $Part->getShortDesc();
echo "</h1>";

foreach($Part->getAttributes() as $attr){
	echo "<strong>" . $attr->getKey() . "</strong>";
	echo ": ";
	echo $attr->getValue();
	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
}
echo "<br />";

echo '<img src="';
echo $Part->getPartImage("a", "Grande");
echo '" width="250" />';
echo "<br />";
	foreach($Part->getImages() as $image){
		if($image->getSize() == "Tall"){
			echo '<img src="' . $image->getPath() . '" width="75" />';
		}
	}

echo "MSRP:" . $Part->getListPrice();
echo "<br />";
echo "<br />";

echo "<br />";
foreach($Part->getContent() as $content){
	if ($content->getKey() == "Bullet"){
		echo "<li>" . $content->getValue() . "</li>";
	}
}
echo "<br />";
echo "Instruction Sheet: ";
echo '<a href="' . $Part->getInstallSheet() . '">Download</a>';
echo "<br />";
echo "<br />";
echo "Review Rating: " . $Part->getAverageReview();
echo "<hr />";
echo "<hr />";
echo "<h2>Reviews:</h2>";
echo "<hr />";

foreach($Part->getReviews() as $review){
	echo "<h3>" . $review->getSubject() . "</h3>";
	echo $review->getReview_text();
}

echo "<h2>Accessories</h2>";
echo "<hr />";

foreach($Part->getRelatedParts() as $rp){
	echo '<a href="part.php?partID=' . $rp->getPartID() . '">';
	echo '<img src="';
	echo $rp->getPartImage("a", "Grande");
	echo '" width="150" />';
	echo "<br />";
	echo $rp->getShortDesc();
	echo "<br />";
	echo $rp->getListPrice();
	echo "</a>";
	echo "<br />";
	echo "<br />";

}

echo "<h2>Fits these Vehicles</h2>";
echo "<hr />";

$Vehicle = new happpi\Vehicle();
foreach($Vehicle->getPartVehicles($Part->getPartID()) as $pv){
	echo $pv->getYear() . " " . $pv->getMake() . " " . $pv->getModel() . " " . $pv->getStyle();
	echo " &nbsp; &nbsp;";
	echo '<a href="index.php?formSubmit=true&mount=rear&year=' . $pv->getYear() . '&make=' . $pv->getMake() . '&model=' . $pv->getModel() . '&style=' . $pv->getStyle() . '&go=true">Find hitches for this vehicle</a>';
	echo "<br />";
}


echo "<h2>Electrical</h2>";
echo "<hr />";

$Vehicle = new happpi\Vehicle();
if(isset($_COOKIE['vehicleID'])){
$Vehicle->setVehicleID($_COOKIE['vehicleID']);
}

foreach($Vehicle->getConnector() as $Part){
	echo "<h3>";
	echo $Part->getShortDesc();
	echo "</h3>";

	foreach($Part->getAttributes() as $attr){
		echo "<strong>" . $attr->getKey() . "</strong>";
		echo ": ";
		echo $attr->getValue();
		echo "&nbsp;&nbsp;&nbsp;&nbsp;";
	}
	echo "<br />";

	echo '<img src="';
	echo $Part->getPartImage("a", "Grande");
	echo '" width="250" />';
	echo "<br />";
		foreach($Part->getImages() as $image){
			if($image->getSize() == "Tall"){
				echo '<img src="' . $image->getPath() . '" width="75" />';
			}
		}

	echo "MSRP:" . $Part->getListPrice();
	echo "<br />";
	echo "<br />";

	echo "<br />";
	foreach($Part->getContent() as $content){
		if ($content->getKey() == "Bullet"){
			echo "<li>" . $content->getValue() . "</li>";
		}
	}
	echo "<br />";
	echo "Instruction Sheet: ";
	echo '<a href="' . $Part->getInstallSheet() . '">Download</a>';
	echo "<br />";

}





}// end isset partID



?>