<?php
require_once('libraries/happpi/LoadAll.php');

if(isset($_GET['catID']) && $_GET['catID'] != ""){
	$Category = new happpi\Category();
	$Category->setCatID($_GET['catID']);
	$cat = $Category->getCategory();
//cat ID is passed to the page and do the lookup

	$numItems = count($Category->getCategoryBreadcrumbs());
	$i = 0;
	foreach($Category->getCategoryBreadcrumbs() as $catBreadCrumb){
		$i += 1;
		if($numItems == 1){
			echo '<a href="category.php?catID=' . $catBreadCrumb->getCatID() . '">';
			echo $catBreadCrumb->getCatTitle();
			echo "</a>";
		}elseif($numItems > 1 && $i != $numItems){
			echo '<a href="category.php?catID=' . $catBreadCrumb->getCatID() . '">';			
			echo $catBreadCrumb->getCatTitle();
			echo "</a>";
			echo " > ";
		}else if($i == $numItems){
			echo $catBreadCrumb->getCatTitle();
		}
		
	} // end of foreach

	echo "<br />";

	// get vehicle info from cookie values (year, make, model, style)
	if(isset($_COOKIE["vehicleID"])){
	$Vehicle = new happpi\Vehicle();
	$Vehicle->setYear($_COOKIE["vehicle_year"]);
	$Vehicle->setMake($_COOKIE["vehicle_make"]);
	$Vehicle->setModel($_COOKIE["vehicle_model"]);
	$Vehicle->setStyle($_COOKIE["vehicle_style"]);
	$yourVehicle = $Vehicle->getVehicle();
	echo "Your vehicle:<strong> " . $yourVehicle->getYear() . " " . $yourVehicle->getMake() . " " . $yourVehicle->getModel() . " " . $yourVehicle->getStyle() . "</strong>";
	}

	echo "<h1>" . $cat->getParent()->getCatTitle() . "</h1>";
	echo "<div style='float:left;'>";
	if($cat->getContent() != null){
		echo "<hr />";
		foreach($cat->getContent() as $content){
			
			echo $content->getContent();
			
		}
		
	}elseif($cat->getParent()->getLongDesc()!="" && $cat->getContent() == ""){
		echo "<hr />";
		echo $cat->getParent()->getLongDesc();
		echo "<hr />";
	}
	echo "</div>";
	echo "<br /><br /><br />";
	echo "<hr />";


	
	$subCatCount = count($cat->getSub_categories());
		if ($subCatCount != 0){
			echo "<h2>Sub Categories</h2>";
			foreach($cat->getSub_categories() as $subCat){
				echo $subCat->getCatTitle();
				echo "<br />";
				
				echo '<a href="category.php?catID=' . $subCat->getCatID() . '">';
				echo '<img src="' . $subCat->getImage() . '" width="200" />';
				echo "</a>";
				echo "<br />";
				echo "<br />";
			}
		}else{
			$Part = new happpi\Part();
			echo "<h2>Parts</h2>";
			$i = 0;
			$perPage = 10;
			$page = 1;
			if(isset($_GET['page'])){
				$page = $_GET['page'];
			}
			$totalPages = $Part->getCategoryPartsCount($_GET['catID']) / $perPage;
			
			echo "Page: ";
			while($i < $totalPages){
				$i++;
				echo '<a href="category.php?catID=' . $_GET['catID'] . '&page=' . $i . '">';
				echo $i . "";
				echo "</a>";
				echo " ";
			}
			foreach($Part->getCategoryParts($_GET['catID'], $page ,$perPage) as $part){
				echo "<h2>" . $part->getShortDesc() . "</h2>";
				echo '<img src="' . $part->getPartImage("a","Grande") . '" width="150" />';
				echo "<span style='color:orange; font-size:25px;' >Price:</span>" . $part->getListPrice() . "";
				echo "<h3>Product Specifications</h3>";
				echo "<ul>";
				foreach($part->getAttributes() as $attr){
					echo "<li>" . $attr->getKey() . ": <strong>" . $attr->getValue() . "</strong></li>";
				}
				echo "</ul>";
				if(count($part->getVehicleAttributes()) !=0){
					echo "<h3>Fits your vehicle!</h3>";
					echo "<h3>For your Vehicle Specifications</h3>";
					echo "<ul>";
					foreach($part->getVehicleAttributes() as $vAttr){
						echo "<li>" . $vAttr->getKey() . ": <strong>" . $vAttr->getValue() . "</strong></li>";
					}
					echo "</ul>";
				}else{
					
				}
				if($Part->getPartID() !=0){
					foreach($Vehicle->getPartVehicles($Part->getPartID()) as $vehicleLookup){
						if($vehicleLookup->getVehicleID() == $Vehicle->getVehicleID()){
							echo "<h3>Fits your vehicle</h3>";
						}else{
							
						}
					}
				}
				
				foreach($part->getImages() as $image){
					if($image->getSize() == "Tall"){
						echo '<img src="' . $image->getPath() . '" width="75" />';
					}
				}
				echo "<br />";
				if ($part->getInstallSheet() !=""){
					echo '<a href="' . $part->getInstallSheet() . '">Install Sheet'; 
					echo "</a>";
				}
				
				$vehicleAttr_array = $part->getVehicleAttributes();

				if(!empty($vehicleAttr_array)){
					$VehicleList = $Vehicle->getPartVehicles($part->getPartID());

					foreach($VehicleList as $vehicleByPart){
						if ($vehicleByPart->getVehicleID() == $_COOKIE["vehicleID"]){
							echo "<h3>Fits your vehicle</h3>";
						}
					}
				}
				echo "<br />";
				echo "<hr />";
			}
		}



}else{
	echo "<h2>No Category Found</h2>";
}


?>

