<?php
         header('Content-Type: text/xml');
         if(isset($_GET["department"]))
         {
            $department=$_GET["department"];
            echo '<?xml version="1.0" ?>';
            echo "<root>";
             $sql = "SELECT nurse.name FROM nurse WHERE nurse.department = :department";
             try
             {
                 include('connect.php');
                 $sth = $dbh->prepare($sql);
                 $sth->execute(array(':department' => $department));
                 
                 $timetable = $sth->fetchAll(PDO::FETCH_NUM);
                 foreach($timetable as $row)
                 {
                     $NurseName = $row[0];
                     print "<row><name>$NurseName</name></row>";
                 }
                 echo "</root>";
             }
             catch(PDOException $e)
             {
                 print "Error!: ".$e->getMessage()."<br>";
                 die();
             }
         }
?>
