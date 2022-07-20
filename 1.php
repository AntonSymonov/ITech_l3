<?php
if (isset($_GET["name"])) {
$name = $_GET["name"];
echo "Перечень палат, в которых дежурит медсестра <b>" . $name . "</b>";
echo "<table border ='1'>";
echo "<tr>
<th>WardName</th>
</tr>";
$sql = "SELECT c.name FROM (nurse AS a INNER JOIN nurse_ward AS b ON a.id_nurse = b.fid_nurse) INNER JOIN ward AS c ON b.fid_ward = c.id_ward WHERE a.name = :name";

try {
 include('connect.php');
 $sth = $dbh->prepare($sql);
 $sth->execute(array(':name' => $name));

 $timetable = $sth->fetchAll(PDO::FETCH_NUM);
 foreach ($timetable as $row) {
    $WardName = $row[0];
    print "<tr> <td>$WardName</td> </tr>";
    }
    } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br>";
        die();
    }
    }
?>
