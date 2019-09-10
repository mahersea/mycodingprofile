<?php 
$id="";

if(isset($_GET['video_id'])){
    $id = $_GET['video_id'];
    try {
        include 'conn.php';
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM videos_table WHERE video_id =  '$id'";
        $conn->query($sql);
    }
    catch(PDOException $err) {
        echo "ERROR: Unable to connect: " . $err->getMessage();
    }
}else{
    $lesson = "lesson not found";
}
?>