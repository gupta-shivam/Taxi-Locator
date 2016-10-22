<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "rickshaw");

$result = $conn->query("SELECT * FROM driver WHERE avail = true;");

$outp = "[";

while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"id":"'  . $rs["id"] . '",';
    $outp .= '"longitude":"'  . $rs["longitude"] . '",';
    $outp .= '"latitude":"'   . $rs["latitude"]        . '",';
    $outp .= '"avail":"'. $rs["avail"]     . '"}'; 
}
$outp .="]";

$conn->close();

echo($outp);
?>