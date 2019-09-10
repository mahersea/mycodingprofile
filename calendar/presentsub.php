<?php 

$lesson="";
$pres_id="";
$title="";
$link="";

if(isset($_POST['lesson_num'])){
    $lesson = $_POST['lesson_num'];
    $pres_id = $_POST['id'];
    $title = $_POST['title'];
    $link = $_POST['link'];
    try {
        include 'conn.php';
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE presentation_table SET presentation_title = '$title', presentation_url = '$link'  WHERE presentation_id = $pres_id";
        $conn->query($sql);
    }
    catch(PDOException $err) {
        echo "ERROR: Unable to connect: " . $err->getMessage();
    }
}else{
    $lesson = "lesson not found";
}


?>