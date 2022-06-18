<?php
$hostName = "localhost";
$username = "root";
$password = "";
$databaseName = "awitek_hotel_app";
$conn = new PDO("mysql:host=$hostName;dbname=$databaseName", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {

$query = "SELECT id_rezerwacji, pesel_id, imie, nazwisko, przyjazd, wyjazd, numer_pokoju, 'kwota/doba', komentarz FROM rezerwacja";
$prepared = $conn->prepare($query);
$prepared->execute();
$result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
 ?>
 <table>
 <?php
 foreach($result as $data) {
   
   ?>
    <tr>
   <td><?php echo $sn; ?> </td>
   <td><?php echo $data['id_rezerwacji']; ?> </td>
   <td><?php echo $data['pesel_id']; ?> </td>
   <td><?php echo $data['imie']; ?> </td>
   <td><?php echo $data['nazwisko']; ?> </td>
   <td><?php echo $data['przyjazd']; ?> </td>
   <td><?php echo $data['wyjazd']; ?> </td>
   <td><?php echo $data['numer_pokoju']; ?> </td>
    </tr>
    <?php
  }
  ?>
</table>
  <?php
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
  padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','peter','abc123','my_db');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM user WHERE id = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
<th>Age</th>
<th>Hometown</th>
<th>Job</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['FirstName'] . "</td>";
  echo "<td>" . $row['LastName'] . "</td>";
  echo "<td>" . $row['Age'] . "</td>";
  echo "<td>" . $row['Hometown'] . "</td>";
  echo "<td>" . $row['Job'] . "</td>";
  echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>