<?php
         if(isset($_GET["shift"]))
         {
            $shift=$_GET["shift"];
             $sql = "SELECT nurse.name as name, nurse.date as date, ward.name as ward_name 
                    FROM nurse INNER JOIN nurse_ward ON nurse.id_nurse = nurse_ward.fid_nurse
                    INNER JOIN ward ON nurse_ward.fid_ward = ward.id_ward
                    WHERE nurse.shift = :shift";
             try
             {
                 include('connect.php');
                 $sth = $dbh->prepare($sql);
                 $sth->execute(array(':shift' => $shift));
                 $timetable = $sth->fetchAll(PDO::FETCH_OBJ);
                 echo json_encode($timetable);
             }
             catch(PDOException $e)
             {
                 print "Error!: ".$e->getMessage()."<br>";
                 die();
             }
         }
        ?>