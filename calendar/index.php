<?php 
 if(isset($_GET['class'])){
   $class = $_GET['class'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Calendar<?= " - Class $class" ?></title>
        <link rel="stylesheet" type="text/css" href="css/calendar.css">
    </head>
    <body>

    <?php
    if($class=="a"){
        $class_date = "2019-06-17";
    }elseif($class=="b"){
        $class_date = "2019-06-20";
    }

    try {
        include 'conn.php';
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo 'Connected to the database.<br>';

        $sql = 'SELECT * FROM lesson_table WHERE lesson_num > 10 order by lesson_num';

        print "<table width=100%>\n\n<tr>";
        if($class=="a"){
            print "<th>Monday</th><th>Tuesday</th><th>Wednesday</th>";
        }elseif($class="b"){
            print "<th>Thursday</th><th>Friday</th><th>Saturday</th>";
        }
        
        print "</tr>\n\n";
        $i=1;
        print "<tr>\n<td>\n"; 
        foreach ($conn->query($sql) as $row) {

            // No Class Dates
            while($class_date == "2019-07-04" || $class_date == "2019-07-15" || $class_date == "2019-07-16" || $class_date == "2019-07-17" || $class_date == "2019-07-18" || $class_date == "2019-07-19" || $class_date == "2019-07-20" || $class_date == "2019-09-02" || $class_date == "2019-09-05"){                                
                print "<div class='day_header' id='" . $i . "'>\n";
                print " <div class='lesson_num'>&nbsp;";
                print "   \n<div class='day_num'>";
                
                $concat_date = substr($class_date,6);

                print  $concat_date;
                print "  </div>";
                print " </div>\n";
                print "</div>\n";

                echo "<h1 style='text-align:center'>No Class</h1>";

                if ($i%3==0) {        // if third day of weekly session
                    print "</td></tr>\n\n<tr><td>"; 
                    if($i==1){              // if not first record
                    }else{
                            $class_date = date('Y-m-d', strtotime($class_date. ' + 5 days'));   // Jump to next week
                    }
                } else { 
                    print "</td>\n<td>"; 
                    $class_date = date('Y-m-d', strtotime($class_date. ' + 1 days'));   // increment day
                }

                $i++;
            }
            //if class==b and lesson == 14.5 FIX
            if($class=="b" && $row['lesson_num']=="14.5"){
            }else{
                print "<div class='day_header' id='" . $i . "'>\n";
                print "<a href='view.php?lesson_num=" . $row['lesson_num'] . "&class=$class' class='nostyle'>";
                print " <div class='lesson_num'>\nLesson " . $row['lesson_num'];
                print "   \n<div class='day_num'>";
                
                $concat_date = substr($class_date,6);

                print  $concat_date;
                print "  </div>";
                print " </div>\n";
                print "</div>\n";

                print "<div class=day_body>\n";
                if($row['intro_notes'] != ""){print "<b>" . $row['intro_notes'] . "</b> &nbsp;<br>\n";} else { print" &nbsp;<br>\n"; }
                if($row['textbook'] != ""){print "<br><span class=strong>Textbook:</span> " . $row['textbook'] . " &nbsp;<br>\n";} else { print" &nbsp;<br>\n"; }
                if($row['homework'] != ""){print "<br><span class=strong>Homework:</span> " . $row['homework'] . " &nbsp;<br>\n";} else { print" &nbsp;<br>\n"; }
                if($row['quiz'] != "" || ($class!="a" && $row['lesson_num']!="15")){print "<br><span class=red>" . $row['quiz'] . "</span> &nbsp;<br>\n";} else { print" &nbsp;<br>\n"; }
                if($row['alert'] != ""){print "<br><span class=green>" . $row['alert'] . "</span> &nbsp;<br>\n";} else { print" &nbsp;<br>\n"; }
                if($row['lab_exercise'] == null || $row['lab_exercise'] == "" || $row['lab_exercise'] == " "){
                } else {
                    print "<br><a href='" . $row['lab_exercise'] . "' class='orange'>Video</a><br>\n";
                }
                
                if ($i==54) {               // if last lesson
                    print ("</td>\n");
                } elseif ($i%3==0) {        // if third day of weekly session
                    print "</td></tr>\n\n<tr><td>"; 
                    if($i==1){              // if not first record
                    }else{
                            $class_date = date('Y-m-d', strtotime($class_date. ' + 5 days'));   // Jump to next week
                    }
                } else { 
                    print "</td>\n<td>"; 
                    $class_date = date('Y-m-d', strtotime($class_date. ' + 1 days'));   // increment day
                }

                $i++;
            }
            
        }
        print "</tr>\n\n</table>";
        $conn = null;

    }
    catch(PDOException $err) {
        echo "ERROR: Unable to connect: " . $err->getMessage();
    }
    ?>
    </body>
</html>

<?php }else{ ?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body style="text-align:center; padding-top:20%; padding-bottom:80%; white-space:nowrap;">

<a href="?class=a#34">Morning Class</a> | <a href="?class=b#34">Evening Class</a>

    </body>
</html>
<?php    
}
?>