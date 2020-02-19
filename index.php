<?php include("classlib/Person.php"); //include the class library?>

<!DOCTYPE html>
<html>

<head>
  <title>SDYOLO</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<body>

    </body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">SDYOLO</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
      
      </li>
      
      
      
      
      <li class="nav-item">
       
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

</html>
    

<?php
echo "<h3>Reconstruct Objects from a CSV data file</h3>";
$group = array();  //empty array to contain person objects
$dataFile = fopen("persistence/OPHospital2020.csv", "r") or die("Unable to open file!");
$i = 0;  //index for the array
$ignore_line=true;
$csv = fgets($dataFile); //read a line from the CSV file
while (!feof($dataFile)) {
	if ($ignore_line)
	{
		$ignore_line = false;
		$csv = fgets($dataFile); //read a line from the CSV file
		continue;
	}
    // if (!feof($dataFile)) { //make sure not at end
        $Properties = explode(",", $csv); //parse values to an array
	   
		$total = (int)  $Properties[9];
        $group[$i] = new Person($Properties[0], $Properties[1], $Properties[2], $Properties[3], $Properties[4], $Properties[5], $Properties[6], $Properties[7], $Properties[8], $total); //create new person objects
        $i++;
	// }
	$csv = fgets($dataFile); //read a line from the CSV file
}

$Properties = explode(",", $csv); //parse values to an array	   
$total = (int)  $Properties[9];
$group[$i] = new Person($Properties[0], $Properties[1], $Properties[2], $Properties[3], $Properties[4], $Properties[5], $Properties[6], $Properties[7], $Properties[8], $total); //create new person objects

fclose($dataFile); //close the data file


//echo '<table border="1">';
//foreach ($group as $index => $person) {
//    echo '<tr><td>' . $person->get_ArchiveDate() . '</td><td>' . $person->get_Group() . '</td>' . '</td><td>' . $person->get_Hospital_Hipe() . '</td>' . '<td>' . $person->get_Hospital() . '</td>' .
//    '</td><td>' . $person->get_Speciality_Hipe1() . '</td>' .
//    '<td>' . $person->get_Speciality() . '</td>' . '</td><td>' . $person->get_Adult_Child() . '</td>' . '</td><td>' . $person->get_Age_Profile() .
//    '</td>' . '</td><td>' . $person->get_Time_Bands() . '</td>' . '</td><td>' . $person->get_Total() . '</td>';
//
//    echo '<form action="' . $_SERVER["PHP_SELF"] . '" method="post">';
//
//    echo '</form>';
//
//
//    echo '</tr>';
//}
//echo '</table>';
//
//
//
//
//$f=0;
//foreach ($group as $index => $person) 
//{
//    $test[$f]=new array("label"=>$person->get_Group(),"y"=>$person->get_Total()*0.01);
//    $f++;
//}
//$f=1;
// foreach($Properties as $f){
//     
//    $dataPoints = array( 
//        array("label"=>$Properties[$f]->get_Group(), "y"=>$Properties[$f]->get_Total()*0.01)
//        );
//     
//      $f++; 
// }




function getChartData($personList)
{
	$totals_by_group = array();

	$grand_total = 0;

	for ($i =0;$i<sizeof($personList);$i++){
		$person = $personList[$i];
		$total=$person->get_Total();

		$grand_total = $grand_total + $total;
		
		$total_by_group = null;
		$total_index = -1;
		for($j = 0; $j < sizeof($totals_by_group); $j++)
		{
			$total_index++;
			if($totals_by_group[$j]["label"] == $person->get_Group())
			{
				$total_by_group = $totals_by_group[$j];
			    break;
			}
		}

		if ($total_by_group == null){
			$new_total_by_group = array("label"=>$person->get_Group(), "y"=>$total);
			$new_index = sizeof($totals_by_group);
			$totals_by_group[$new_index] = $new_total_by_group;
		}
		else{
			$totals_by_group[$total_index]=array("label"=>$person->get_Group(), "y"=>$total+$total_by_group["y"]);
		}

	}

	

	$result = array();
	for($z = 0; $z < sizeof($totals_by_group); $z++)
	{
		$total_by_group = $totals_by_group[$z];
		$label=$total_by_group["label"];
		$value=$total_by_group["y"];
		$result[sizeof($result)] = array( "label"=>$label, "y"=>($value/$grand_total)*100 );
	}

	return $result;
}


$dataPoints= getChartData($group);

?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Out Patient Waiting List By Group Hospital"
	},
	subtitles: [{
		text: "2020"
	}],
	data: [{
		type: "pie",
		yValueFormatString: "#,##0.00\"%\"",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>




<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
 

<?php
echo'<br>';
echo '<table border="1" align="center" class="table-striped">';

$tmp=0;

    foreach ($group as $index => $person) 
        if ($tmp++ < 20) {
 
    echo '<tr><td>' . $person->get_ArchiveDate() . '</td><td>' . $person->get_Group() . '</td>' . '</td><td>' . $person->get_Hospital_Hipe() . '</td>' . '<td>' . $person->get_Hospital() . '</td>' .
    '</td><td>' . $person->get_Speciality_Hipe1() . '</td>' .
    '<td>' . $person->get_Speciality() . '</td>' . '</td><td>' . $person->get_Adult_Child() . '</td>' . '</td><td>' . $person->get_Age_Profile() .
    '</td>' . '</td><td>' . $person->get_Time_Bands() . '</td>' . '</td><td>' . $person->get_Total() . '</td>';

    echo '<form action="' . $_SERVER["PHP_SELF"] . '" method="post">';

    echo '</form>';


    echo '</tr>';
}
echo '</table>';



?>














<!-- Footer -->
<footer class="page-footer font-small blue">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 SDYOLO
    
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->

</html>    