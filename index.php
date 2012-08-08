<?php
require_once('libraries/happpi/LoadAll.php'); // just handy for loading the entire library at once
//require_once('libraries/happpi/lib/Part.php');


$Vehicle = new happpi\Vehicle();




?>
<!doctype html>
<html>
	<head>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="scripts/lookup.js"></script>
		<link href="css/stylesheet.css" rel="stylesheet" media="all" />
	</head>
	<body>
		<header>
		<div class="search-box">
			<form class="search-form" action="index.php" method="get" id="search">
				<input type="search" class="search" name="searchTerm" placeholder="Enter your search query..." />
				<button>Search</button>
			</form>
		</div>
		<div class="clearfix"></div>
		<div class="lookup">
			<form name="lookup" action="index.php" method="get" id="lookup">
				<input type="hidden" name="formSubmit" value="true" />
				<a href="lifestyle.php">Shop By Lifestyle</a>
				<?php

					if(!isset($_GET["formSubmit"])){
						echo '<select class="mount" name="mount">';
						echo '<option value="">Select Mount</option>';
						echo '<option value="rear"> Rear Mount </option>';
						echo '<option value="front"> Front Mount </option>';
						echo '</select>';
					}

					if(isset($_GET['mount']) && !isset($_GET['year'])){
						$Vehicle->setMount($_GET['mount']);
						echo '<input type="hidden" name="mount" value="' . $Vehicle->getMount() . '" />';
						echo '<select class="year" name="year">';
						echo '<option value="">Select Year</option>';
						foreach($Vehicle->getYears() as $year){		
							echo '<option value="' . $year . '">' . $year . '</option>';
						}
						echo '</select>';
					}

					if(isset($_GET['year']) && isset($_GET['mount']) && !isset($_GET['make'])){
						$Vehicle->setYear($_GET['year']);
						$Vehicle->setMount($_GET['mount']);
						echo '<input type="hidden" name="mount" value="' . $Vehicle->getMount() . '" />';
						echo '<input type="hidden" name="year" value="' . $Vehicle->getYear() . '" />';
						echo '<select class="make" name="make">';
						echo '<option value="">Select Make</option>';
						foreach($Vehicle->getMakes() as $make){		
							echo '<option value="' . $make . '">' . $make . '</option>';
						}
						echo '</select>';
					}

					if(isset($_GET['make']) && isset($_GET['mount']) && isset($_GET['year']) && !isset($_GET['model'])){
						$Vehicle->setYear($_GET['year']);
						$Vehicle->setMount($_GET['mount']);
						$Vehicle->setMake($_GET['make']);

						echo '<input type="hidden" name="mount" value="' . $Vehicle->getMount() . '" />';
						echo '<input type="hidden" name="year" value="' . $Vehicle->getYear() . '" />';
						echo '<input type="hidden" name="make" value="' . $Vehicle->getMake() . '" />';
						echo '<select class="model" name="model">';
						echo '<option value="">Select Model</option>';
						foreach($Vehicle->getModels() as $model){		
							echo '<option value="' . $model . '">' . $model . '</option>';
						}
						echo '</select>';
					}

					if(isset($_GET['make']) && isset($_GET['mount']) && isset($_GET['year']) && isset($_GET['model']) && !isset($_GET['style'])){
						$Vehicle->setYear($_GET['year']);
						$Vehicle->setMount($_GET['mount']);
						$Vehicle->setMake($_GET['make']);
						$Vehicle->setModel($_GET['model']);

						echo '<input type="hidden" name="mount" value="' . $Vehicle->getMount() . '" />';
						echo '<input type="hidden" name="year" value="' . $Vehicle->getYear() . '" />';
						echo '<input type="hidden" name="make" value="' . $Vehicle->getMake() . '" />';
						echo '<input type="hidden" name="model" value="' . $Vehicle->getModel() . '" />';
						echo '<input type="hidden" name="go" value="true" />';
						echo '<select class="style" name="style">';
						echo '<option value="">Select Style</option>';
						foreach($Vehicle->getStyles() as $style){		
							echo '<option value="' . $style . '">' . $style . '</option>';
						}
						echo '</select>';
					}

					if(isset($_GET['searchTerm'])){

						$searchResult = new happpi\SearchResult();

						$partsList = $searchResult->powerSearch($_GET['searchTerm']);
						$searchResult = $searchResult->search($_GET['searchTerm']);
						

						foreach($partsList as $part){
							echo '<a href="part.php?partID=' . $part->getPartID() . '">';
							echo "<h2>" . $part->getShortDesc() . "</h2>";
							echo "</a>";
							echo '<img src="' . $part->getPartImage("a","Grande") . '" width="150" />';
							echo "<span style='color:orange; font-size:25px;' >Price:</span>" . $part->getListPrice() . "";
							echo "<h3>Product Specifications</h3>";
							echo "<ul>";
							foreach($part->getAttributes() as $attr){
								echo "<li>" . $attr->getKey() . ": <strong>" . $attr->getValue() . "</strong></li>";
							}
							echo "</ul>";
							echo "<h3>For your Vehicle Specifications</h3>";
							echo "<ul>";
							foreach($part->getVehicleAttributes() as $vAttr){
								echo "<li>" . $vAttr->getKey() . ": <strong>" . $vAttr->getValue() . "</strong></li>";
							}
							echo "</ul>";
							foreach($part->getImages() as $image){
								if($image->getSize() == "Tall"){
									echo '<img src="' . $image->getPath() . '" width="75" />';
								}
							}
							echo "<br />";
							echo "<hr />";

						}
						echo "<hr />";
						echo "<hr />";
						echo "<hr />";
						foreach($searchResult as $result){
							$part = new happpi\Part();
							$part->setPartID($result->getPartID());
							$part = $part->getPart();

							echo '<a href="part.php?partID=' . $part->getPartID() . '">';
								echo "<h2>" . $part->getShortDesc() . "</h2>";
							echo "</a>";
							echo '<img src="' . $part->getPartImage("a","Grande") . '" width="150" />';
							echo "<span style='color:orange; font-size:25px;' >Price:</span>" . $part->getListPrice() . "";
							echo "<h3>Product Specifications</h3>";
							echo "<ul>";
							foreach($part->getAttributes() as $attr){
								echo "<li>" . $attr->getKey() . ": <strong>" . $attr->getValue() . "</strong></li>";
							}
							echo "</ul>";
							echo "<h3>For your Vehicle Specifications</h3>";
							echo "<ul>";
							foreach($part->getVehicleAttributes() as $vAttr){
								echo "<li>" . $vAttr->getKey() . ": <strong>" . $vAttr->getValue() . "</strong></li>";
							}
							echo "</ul>";
							foreach($part->getImages() as $image){
								if($image->getSize() == "Tall"){
									echo '<img src="' . $image->getPath() . '" width="75" />';
								}
							}
							echo "<br />";
							echo "<hr />";

						} // end foreach

					}

					if(isset($_GET['make']) && isset($_GET['mount']) && isset($_GET['year']) && isset($_GET['model']) && isset($_GET['style']) && isset($_GET['go'])){
						$Vehicle->setYear($_GET['year']);
						$Vehicle->setMount($_GET['mount']);
						$Vehicle->setMake($_GET['make']);
						$Vehicle->setModel($_GET['model']);
						$Vehicle->setStyle($_GET['style']);
						$Vehicle = $Vehicle->getVehicle();
						$myVehicle = $Vehicle->getVehicle();

						echo "Your vehicle:<strong> " . $Vehicle->getYear() . " " . $Vehicle->getMake() . " " . $Vehicle->getModel() . " " . $Vehicle->getStyle() ."</strong>";

						setcookie("vehicleID",$myVehicle->getVehicleID(),time()+3600);
						setcookie("vehicle_year",$myVehicle->getYear(),time()+3600);
						setcookie("vehicle_make",$myVehicle->getMake(),time()+3600);
						setcookie("vehicle_model",$myVehicle->getModel(),time()+3600);
						setcookie("vehicle_style",$myVehicle->getStyle(),time()+3600);

						echo '<input type="hidden" name="mount" value="' . $Vehicle->getMount() . '" />';
						echo '<input type="hidden" name="year" value="' . $Vehicle->getYear() . '" />';
						echo '<input type="hidden" name="make" value="' . $Vehicle->getMake() . '" />';
						echo '<input type="hidden" name="model" value="' . $Vehicle->getModel() . '" />';
						echo '<input type="hidden" name="style" value="' . $Vehicle->getStyle() . '" />';


						
						// product page

						echo "<h1>Products</h1>";
						echo "<hr />";
						foreach($Vehicle->getParts() as $part){
							echo '<a href="part.php?partID=' . $part->getPartID() . '">';
								echo "<h2>" . $part->getShortDesc() . "</h2>";
							echo "</a>";
							echo '<img src="' . $part->getPartImage("a","Grande") . '" width="150" />';
							echo "<span style='color:orange; font-size:25px;' >Price:</span>" . $part->getListPrice() . "";
							echo "<h3>Product Specifications</h3>";
							echo "<ul>";
							foreach($part->getAttributes() as $attr){
								echo "<li>" . $attr->getKey() . ": <strong>" . $attr->getValue() . "</strong></li>";
							}
							echo "</ul>";
							echo "<h3>For your Vehicle Specifications</h3>";
							echo "<ul>";
							foreach($part->getVehicleAttributes() as $vAttr){
								echo "<li>" . $vAttr->getKey() . ": <strong>" . $vAttr->getValue() . "</strong></li>";
							}
							echo "</ul>";
							foreach($part->getImages() as $image){
								if($image->getSize() == "Tall"){
									echo '<img src="' . $image->getPath() . '" width="75" />';
								}
							}
							echo "<br />";
							echo "<hr />";

						}
					}


					{ // category block
						// timing out ocasionally
						//echo "Your vehicle: " . $Vehicle->getVehicle()->getYear() . " " . $Vehicle->getVehicle()->getMake() . " " . $Vehicle->getVehicle()->getModel() . " " . $Vehicle->getVehicle()->getStyle();
						$Category = new happpi\Category();
						echo "<hr />";
						echo "<h1>Categories</h1>";
						echo "<hr />";
						foreach($Category->getParentCategories() as $parentCat){
							echo '<a href="category.php?catID=' . $parentCat->getCatID() . '">';
							echo '<img src="' . $parentCat->getImage() . '" title="' . $parentCat->getCatTitle() . '" width="100" />';
							echo '</a>';
						}

					}


					{ // latest parts block
						echo "<h1>Latest Parts</h1>";
						$LatestParts = new happpi\Part();

						foreach($LatestParts->getLatestParts() as $lp){
							echo "<hr />";
							echo '<a href="part.php?partID=' . $lp->getPartID() . '">';
							echo "<h2>" . $lp->getShortDesc() . "</h2>";
							echo "</a>";
						}
					}
				?>
			</form>
		</div>
		</header>
		<section class="content">
		</section>
	</body>
</html>