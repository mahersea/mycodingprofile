<?php 
$id="";

if(isset($_GET['pres_id'])){
    $id = $_GET['pres_id'];
    try {
        include 'conn.php';
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM presentation_table WHERE presentation_id =  '$id'";
        $conn->query($sql);
    }
    catch(PDOException $err) {
        echo "ERROR: Unable to connect: " . $err->getMessage();
    }
}else{
    $lesson = "lesson not found";
}
?>