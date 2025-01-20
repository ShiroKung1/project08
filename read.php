<?php
include 'config.php';
$sql = "SELECT* FROM product8 ORDER BY created_at DESC";
$result=$conn->query($sql);

$image  =[];
if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
        $images[]=$row;
    }
}
echo json_encode($images);
?>