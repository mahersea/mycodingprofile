<?php 

$lesson="";
$field_name="";
$field_value="";

if(isset($_POST['lesson_num'])){
    $lesson = $_POST['lesson_num'];
    $field_name = $_POST['name'];
    $field_value = $_POST['field_value'];
    try {
        include 'conn.php';
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE lesson_table SET $field_name = '$field_value' WHERE lesson_num = $lesson";
        $conn->query($sql);
    }
    catch(PDOException $err) {
        echo "ERROR: Unable to connect: " . $err->getMessage();
    }
}else{
    $lesson = "lesson not found";
}


echo $lesson . "<br>";
echo $field_name . "<br>";
echo $field_value . "<br>";


?>