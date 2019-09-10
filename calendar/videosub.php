<?php 

$lesson="";
$video_id="";
$title="";
$link="";

if(isset($_POST['lesson_num'])){
    $lesson = $_POST['lesson_num'];
    $video_id = $_POST['id'];
    $title = $_POST['title'];
    $link = $_POST['link'];
    try {
        include 'conn.php';
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE videos_table SET video_title = '$title', video_url = '$link'  WHERE video_id = $video_id";
        $conn->query($sql);
    }
    catch(PDOException $err) {
        echo "ERROR: Unable to connect: " . $err->getMessage();
    }
}else{
    $lesson = "lesson not found";
}


?>