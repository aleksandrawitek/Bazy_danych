<!DOCTYPE html>
<html>
    <head>
        <style>
            body {background-image: url("img/background.png");}
            #submit {border-radius: 12px; background-color:#ffb3b3;}
            input {border-radius: 12px;}
            #prev {width: 10%; height: 10%;}
            #all {border-collapse: collapse;}
            #all tr {border:solid black;}
            #all td {width:10%;}
            #select {border-radius: 12px; background-color: grey;}
        </style>
        <title> Zameldowani</title>
    </head>
<body>
    <table>
     <tr>
        <td><img id="prev" src="img/prev.png" onclick="window.location.href='main.html'"></td>
    </tr>
    </table>
    <?php
        $hostName = "localhost";
        $username = "root";
        $password = "";
        $databaseName = "awitek_hotel_app";
        $conn = new PDO("mysql:host=$hostName;dbname=$databaseName", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
                $query = "SELECT * FROM zameldowany";
                $prepared = $conn->prepare($query);
                $prepared->execute();
                $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
                ?>
                <table id = "all">
                <th>
                <center><td> Podgląd</td><center>
                <center><td> Nr rezerwacji </td><center>
                <center><td> Pesel </td><center>
                <center><td> Imię </td><center>
                <center><td> Nazwisko </td><center>
                <center><td> Numer pokoju </td><center>
                <center><td> Płatność </td><center>
                <center><td> Rozliczony </td><center>
                <center><td> Uwagi </td><center>
                </th>
                <?php
                foreach($result as $data) {
                
                ?>
                <tr>
                <center><td><?php echo $sn; ?> </td><center>
                <center><td><button id = "select" onclick = "select()"> Podgląd </button></td><center>
                <center><td><?php echo $data['rezerwacja_id']; ?> </td><center>
                <center><td><?php echo $data['pesel_id']; ?> </td><center>
                <center><td><?php echo $data['imie']; ?> </td><center>
                <center><td><?php echo $data['nazwisko']; ?> </td><center>
                <center><td><?php echo $data['nr_pokoju']; ?> </td><center>
                <center><td><?php echo $data['platnosc']; ?> </td><center>
                <center><td><?php if($data['rozliczony'] == 0){echo "Nie";} else {echo "Tak";}?> </td><center>
                <center><td><?php echo $data['uwagi']; ?> </td><center>
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
    <script>
    </script>
    
</body>
</html>