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


echo '<table border="1">';
foreach ($group as $index => $person) {
    echo '<tr><td>' . $person->get_ArchiveDate() . '</td><td>' . $person->get_Group() . '</td>' . '</td><td>' . $person->get_Hospital_Hipe() . '</td>' . '<td>' . $person->get_Hospital() . '</td>' .
    '</td><td>' . $person->get_Speciality_Hipe1() . '</td>' .
    '<td>' . $person->get_Speciality() . '</td>' . '</td><td>' . $person->get_Adult_Child() . '</td>' . '</td><td>' . $person->get_Age_Profile() .
    '</td>' . '</td><td>' . $person->get_Time_Bands() . '</td>' . '</td><td>' . $person->get_Total() . '</td>';

    echo '<form action="' . $_SERVER["PHP_SELF"] . '" method="post">';

    echo '</form>';


    echo '</tr>';
}
echo '</table>';
