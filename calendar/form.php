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
    <div><a href="form.php?lesson_num=<?=$prev_num?>" class="backnforth">&#8656;</a></div>
      <div style="flex-grow:2; text-align:center"><h2>Lesson #<? echo $lesson_num ?></h2></div>
      <div><a href="form.php?lesson_num=<?=$next_num?>" class="backnforth">&#8658;</a></div>
</header>
<div class="majorbreak"></div> 
<div class="maincontainer">
  <div class="maincol">
    <div class="formborder">  
      <span class="formheader">Lesson Details</span>
      <div class="formbox">  
        <form name="lessonform" method="post" action="sub.php">
        <input type="hidden" name="lesson_num" value="<? echo $lesson_num ?>">
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
                  <label class="fieldnames">Title:</label><input type="text" class="field" name="intro_notes" value="<?= $notes ?>" onblur="setfield('intro_notes')"><br>
                  <label class="fieldnames">Textbook:</label><input type="text" class="field" name="textbook" value="<?= $textbook ?>" onblur="setfield('textbook')"><br>
                  <label class="fieldnames">Homework:</label><input type="text" class="field" name="homework" value="<?= $homework ?>" onblur="setfield('homework')"><br>
                  <label class="fieldnames">Quiz:</label><input type="text" class="field" name="quiz" value="<?= $quiz ?>" onblur="setfield('quiz')"><br>
                  <label class="fieldnames">Alert:</label><input type="text" class="field" name="alert" value="<?= $alert ?>" onblur="setfield('alert')"><br>
                  <label class="fieldnames">Lab:</label><input type="text" class="field" name="lab_exercise" value="<?= $lab ?>" onblur="setfield('lab_exercise')"><br>
      
                <? }
              }
              catch(PDOException $err) {
                  echo "ERROR: Unable to connect: " . $err->getMessage();
              }
          ?>
        <input type="hidden" name="field_name">
        </form>
      </div>
    </div>
    <br>
      <div class="formborder-crimson">              
        <span class="formheader_sm">Edit Videos</span>
        <div class="formbox-crimson" id="formbox-crimson">   
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
                      echo "<input type='text' class='videofield' id='video_title_" . $row['video_id'] . "'  value='". $row['video_title'] . "' onblur='setVideoId(\"". $row['video_id'] . "\")'>\n";
                      echo "<input type='text' class='videofield' id='video_url_" . $row['video_id'] . "' value='" . $row['video_url'] . "' onblur='setVideoId(\"". $row['video_id'] . "\")'>\n";
                      echo "<a href='' onmousedown='setDeleteVideoId(\"" . $row['video_id'] . "\")' id='delete' style='color:red'>&#10006;</a>";
                      echo "<br>";
                    }
                  }
                  catch(PDOException $err) {
                      echo "ERROR: Unable to connect: " . $err->getMessage();
                  }
              ?>
            </form>
        </div>
        <div class="formbreak"></div>            
        <span class="formheader_sm">Add Video</span>
        <div class="formbox-crimson" style="margin-left:100px;margin-right:100px;"> 
          <form name="videoform_add" method="post" action="videosub_add.php">  
            <input type="hidden" id="lesson_num" value="<? echo $lesson_num ?>">
            <input type="text" class="video_url_title" id="video_title_add" placeholder="Title">
            <a href="" onclick="" class="ok">&#10004;</a>
          </form>
        </div>
      </div>


  </div>


    <div class="rightcol">
      <div class="formborder-green">              
        <span class="formheader_sm">Edit Key Concepts</span>
        <div class="formbox-green" id="formbox-green">   
            <form name="presentform" id="presentform" method="post" action="presentsub.php">
              <input type="hidden" id="pres_id" value="">
              <input type="hidden" id="delete_id" value="">
              <input type="hidden" id="lesson_num" value="<? echo $lesson_num ?>">
              <!-- Presentation Data-->
              <?php
                  try {
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "SELECT * FROM presentation_table WHERE lesson_num = $lesson_num";
                    foreach ($conn->query($sql) as $row) {
                      echo "<input type='text' class='presfield' id='title_" . $row['presentation_id'] . "'  value='". $row['presentation_title'] . "' onblur='setpresid(\"". $row['presentation_id'] . "\")'>\n";
                      echo "<input type='text' class='presfield' id='url_" . $row['presentation_id'] . "' value='" . $row['presentation_url'] . "' onblur='setpresid(\"". $row['presentation_id'] . "\")'>\n";
                      //echo "<button click=\"delete_id('" . $row['presentation_id'] . "')\" id=\"delete\" style='color:red'>&#10006;</button>";
                      //echo "<a href=\"\" class=\"ok\">&#10004;</a>&nbsp;<a href='' onmousedown='setdeleteid(\"" . $row['presentation_id'] . "\")' id='delete' style='color:red'>&#10006;</a>";
                      echo "<a href='' onmousedown='setdeleteid(\"" . $row['presentation_id'] . "\")' id='delete' style='color:red'>&#10006;</a>";
                      echo "<br>";
                      //echo "<script>console.log('title_" . $row['presentation_id'] . " | url_" . $row['presentation_id'] . "')</script>";
                    }
                  }
                  catch(PDOException $err) {
                      echo "ERROR: Unable to connect: " . $err->getMessage();
                  }
              ?>
            </form>
        </div>
        <div class="formbreak"></div>            
        <span class="formheader_sm">Add Key Concept</span>
        <div class="formbox-green" style="margin-left:100px;margin-right:100px;"> 
          <form name="presentform_add" method="post" action="presentsub_add.php">  
            <input type="hidden" id="lesson_num" value="<? echo $lesson_num ?>">
            <input type="text" class="pres_url_title" id="title_add" placeholder="Title">
            <a href="" onclick="('#presentform').load()" class="ok">&#10004;</a>
          </form>
        </div>
      </div>
    </div>
  </div>


  <script>

  let field_name = "";
  let pres_id = "";
  let new_pres_id = "";

  function setfield(name){
      field_name = name;
  }
  function setpresid(id){
    pres_id = id;
    document.getElementById("pres_id").value = id;
  }
  function setdeleteid(id){
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "presentsub_delete.php?pres_id=" + id, true);
    xhttp.send();
    console.log(id);
  }

  function setVideoId(id){
    video_id = id;
    document.getElementById("video_id").value = id;
  }
  function setDeleteVideoId(id){
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "videosub_delete.php?video_id=" + id, true);
    xhttp.send();
    console.log(id);
  }

  // AJAX for main lesson fields
  $( ".field" ).blur(function() {
      // Stop form from submitting normally
      event.preventDefault();
      // Get some values from elements on the page:
      var value = lessonform.elements[field_name].value;
      var lesson = lessonform.elements["lesson_num"].value;
      var url = "sub.php";
      console.log(field_name + ' | ' + value + ' | ' + lesson + ' | ' + url);
      // Send the data using post
      var posting = $.post( url, { lesson_num: lesson, name: field_name, field_value: value } );

  });

  // AJAX for presentaion fields
  $( ".presfield" ).blur(function() {
      // Stop form from submitting normally
      event.preventDefault();

      var id = document.getElementById("pres_id").value
      var lesson_num = document.getElementById("pres_id").value
      var title = document.getElementById("title_" + pres_id).value;
      var link = document.getElementById("url_" + pres_id).value;
      var url = "presentsub.php";
      console.log(lesson_num + " | " + id + " | " + title + " | " + link);
      var posting = $.post( url, { lesson_num: lesson_num, id:id, title: title, link: link } );
      
      setTimeout(setStyle, 200);
      function setStyle(){
        $("#title_" + id).css("background-color", "#7ab895");
        $("#url_" + id).css("background-color", "#7ab895");
      }
      setTimeout(resetStyle, 1000);
      function resetStyle() {
        $("#title_" + id).css("background-color", "white");
        $("#url_" + id).css("background-color", "white");
      }
      //$(".presfield").css("background-color", "white");
  });

  // AJAX for new presentaion fields
  $( ".pres_url_title" ).blur(function() {
      // Stop form from submitting normally
      event.preventDefault();
      var lesson_num = document.getElementById("lesson_num").value
      var title = document.getElementById("title_add").value;
      var url = "presentsub_add.php";
      console.log(lesson_num + " | " + title );
      var posting = $.post( url, { lesson_num: lesson_num, title: title } );

  });

 
 // AJAX for video fields
 $( ".videofield" ).blur(function() {
      // Stop form from submitting normally
      event.preventDefault();

      var id = document.getElementById("video_id").value
      var lesson_num = document.getElementById("video_id").value
      var title = document.getElementById("video_title_" + video_id).value;
      var link = document.getElementById("video_url_" + video_id).value;
      var url = "videosub.php";
      console.log(lesson_num + " | " + id + " | " + title + " | " + link);
      var posting = $.post( url, { lesson_num: lesson_num, id:id, title: title, link: link } );
      
      setTimeout(setStyle, 200);
      function setStyle(){
        $("#video_title_" + id).css("background-color", "#7ab895");
        $("#video_url_" + id).css("background-color", "#7ab895");
      }
      setTimeout(resetStyle, 1000);
      function resetStyle() {
        $("#video_title_" + id).css("background-color", "white");
        $("#video_url_" + id).css("background-color", "white");
      }
      //$(".presfield").css("background-color", "white");
  });

  // AJAX for new video fields
  $( ".video_url_title" ).blur(function() {
      // Stop form from submitting normally
      event.preventDefault();
      var lesson_num = document.getElementById("lesson_num").value
      var video_title = document.getElementById("video_title_add").value;
      var url = "videosub_add.php";
      console.log(lesson_num + " | " + video_title );
      var posting = $.post( url, { lesson_num: lesson_num, title: video_title } );

  });
  
  


  </script>

</div>
</body>
</html>

<?php
 }else{

 }
?>