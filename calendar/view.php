<?php 
 if(isset($_GET['lesson_num'])){
   $lesson_num = $_GET['lesson_num'];
   $prev_num = $lesson_num - 1;
   $next_num = $lesson_num + 1;
   include 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Jquery Ajax</title>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <link rel="stylesheet" type="text/css" href="css/calendar.css">
</head>
<body>
<header>
  <div><a href="view.php?lesson_num=<?=$prev_num?>" class="backnforth">&#8656;</a></div>
  <div style="flex-grow:2; text-align:center"><h2>Lesson #<? echo $lesson_num ?></h2></div>
  <div><a href="view.php?lesson_num=<?=$next_num?>" class="backnforth">&#8658;</a></div>
  
</header>
<div class="majorbreak"></div> 
<div class="maincontainer">
  <div class="maincol">
    <div class="formborder">  
      <span class="formheader">Lesson Details</span>
      <div class="viewbox">  
        <?php
              try {
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM lesson_table WHERE lesson_id = $lesson_num";
                foreach ($conn->query($sql) as $row) { 
                  if($row['intro_notes']!==null){ $notes = $row['intro_notes']; }else{ $notes="";};
                  if($row['textbook']!==null){ $textbook = $row['textbook']; }else{ $textbook="";};
                  if($row['homework']!==null){ $homework = $row['homework']; }else{ $homework="";};
                  if($row['quiz']!==null){ $quiz = $row['quiz']; }else{ $quiz="";};
                  if($row['alert']!==null){ $alert = $row['alert']; }else{ $alert="";};
                  if($row['lab_exercise']!==null){ $lab = $row['lab_exercise']; }else{ $lab="";};
                  
                ?>
                  <label class="labelnames">Title:</label><span class="field" name="intro_notes"><?= $notes ?></span><br>
                  <label class="labelnames">Textbook:</label><span class="field" name="textbook"><?= $textbook ?></span><br>
                  <label class="labelnames">Homework:</label><span class="field" name="homework"><?= $homework ?></span><br>
                  <?php if($quiz !="") {?>
                    <label class="labelnames">Quiz:</label><span class="field" name="quiz" ><?= $quiz ?></span><br>
                  <?php }else{} ?>
                  <?php if($alert !="") {?>
                    <label class="labelnames">Alert:</label><span class="field" name="alert"><?= $alert ?></span><br>
                  <?php }else{} ?>
                  
                <? }
              }
              catch(PDOException $err) {
                  echo "ERROR: Unable to connect: " . $err->getMessage();
              }
          ?>
      </div>
    </div>
    <br>
      <div class="formborder-crimson">              
        <span class="formheader_sm">Videos</span>
        <div class="viewbox-crimson" id="viewbox-crimson">   
            <form name="videoform" id="videoform" method="post" action="videosub.php">
              <input type="hidden" id="video_id" value="">
              <input type="hidden" id="delete_video_id" value="">
              <input type="hidden" id="lesson_num" value="<? echo $lesson_num ?>">
              <!-- Presentation Data-->
              <?php
                  try {
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "SELECT * FROM videos_table WHERE lesson_num = $lesson_num";
                    foreach ($conn->query($sql) as $row) {
                      echo "<span class='videofield' id='video_title_" . $row['video_id'] ."'><a href='../videos/" . $row['video_url'] . "' class='ok-red'>" . $row['video_title'] . "</a></span>";
                      //echo "<span class='videofield' id='video_url_" . $row['video_id'] . "'>" . $row['video_url'] . "</span>";
                      echo "<br>";
                    }
                  }
                  catch(PDOException $err) {
                      echo "ERROR: Unable to connect: " . $err->getMessage();
                  }
              ?>
            </form>
        </div>
      </div>


  </div>
    <div class="rightcol">
      <div class="formborder-green">              
        <span class="formheader_sm">Key Concepts</span>
        <div class="viewbox-green" id="viewbox-green">   
            
              <!-- Presentation Data-->
              <?php
                  try {
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "SELECT * FROM presentation_table WHERE lesson_num = $lesson_num";
                    foreach ($conn->query($sql) as $row) {
                      echo "<input type='checkbox'><a href='". $row['presentation_url'] . "' class='ok' id='title_" . $row['presentation_id'] . "' target='_blank'>". $row['presentation_title'] . "</a>";
                      echo "<br>";
                    }
                  }
                  catch(PDOException $err) {
                      echo "ERROR: Unable to connect: " . $err->getMessage();
                  }
              ?>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<?php
 }else{

 }
?>