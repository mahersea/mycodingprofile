<?php 
$lesson="";
$title="";

if(isset($_POST['lesson_num'])){
    $lesson = $_POST['lesson_num'];
    $title = $_POST['title'];
    try {
        include 'conn.php';
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO presentation_table (lesson_num, presentation_title) VALUES ('$lesson', '$title')";
        $conn->query($sql);
    }
    catch(PDOException $err) {
        echo "ERROR: Unable to connect: " . $err->getMessage();
    }
}else{
    $lesson = "lesson not found";
}
?>