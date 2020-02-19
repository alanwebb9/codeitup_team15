<?php include("classlib/Person.php"); //include the class library?>

<?php
echo "<h3>Reconstruct Objects from a CSV data file</h3>";
$group = array();  //empty array to contain person objects
$dataFile = fopen("persistence/OPHospital2020.csv", "r") or die("Unable to open file!");
$i = 0;  //index for the array
while (!feof($dataFile)) {
    $csv = fgets($dataFile); //read a line from the CSV file
    if (!feof($dataFile)) { //make sure not at end
        $Properties = explode(",", $csv); //parse values to an array
       
        $group[$i] = new Person($Properties[0], $Properties[1], $Properties[2], $Properties[3], $Properties[4], $Properties[5], $Properties[6], $Properties[7], $Properties[8], $Properties[9]); //create new person objects
        $i++;
    }
}
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
      return array( 
	array("label"=>"Children's Health Ireland", "y"=>64.02),
	array("label"=>"Dublin Midlands Hospital Group", "y"=>12.55),
	array("label"=>"Ireland East Hospital Group", "y"=>8.47),
	array("label"=>"RCSI  Hospitals Group", "y"=>6.08),
	array("label"=>"Saolta University Health Care Group", "y"=>4.29),
	array("label"=>"Others", "y"=>4.59)
);
            
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
		text: "Usage Share of Desktop Browsers"
	},
	subtitles: [{
		text: "November 2017"
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
</html>           