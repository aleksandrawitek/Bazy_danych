<!DOCTYPE html>
<html>
    <head>
        <style>
            body {background-image: url("img/background.png");}
            #delete {border-radius: 12px; background-color:#ffb3b3;}
            input {border-radius: 12px;}
            #prev {width: 10%; height: 10%;}
            #all {border-collapse: collapse;}
            #all tr {border:solid black;}
            #all td {width:10%;}
            #select {border-radius: 12px; background-color: grey;}
            .new {border-radius: 12px; background-color:#e6ffe6;}
        </style>
        <title> Szczegóły </title>
    </head>
<body>
    <table>
     <tr>
        <td><img id="prev" src="img/prev.png" onclick="window.location.href='main.html'"></td>
    </tr>
    <tr>
        <td></td>
        <td><button class = "new" id = "dodajwpis"><b>Dodaj usługę</b> </button></td>
        <td></td>
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
            
            $query = "SELECT * FROM platnosc";
            $prepared = $conn->prepare($query);
            $prepared->execute();
            $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
            ?>
            <table id = "all">
            <tr>
            <center><td><b> Numer rezerwacji </td><center>
            <center><td><b> Numer pokoju </td><center>
            <center><td> <b>Usługa </td><center>
            <center><td> <b>Kwota </td><center>
            </tr>
            <?php
            foreach($result as $data) {
            
            ?>
            <tr>
            <center><td class = 'rez' id = <?php echo $data['rezerwacja_id']; ?>><?php echo $data['rezerwacja_id']; ?> </td><center>
            <center><td class = 'pokoj' id =<?php echo $data['nr_pokoju']; ?>  ><?php echo $data['nr_pokoju']; ?> </td><center>
            <center><td class = 'usluga'id = <?php echo $data['usluga']; ?> ><?php echo $data['usluga']; ?> </td><center>
            <center><td class = 'kwota'id = <?php echo $data['kwota']; ?> ><?php echo $data['kwota']; ?> </td><center>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  
    <script>
        $("#dodajwpis").click(function() {
            window.close();
            window.open('addbill.php');
            location.close();
        });
    </script>
    
</body>
</html>