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
            .checkin {border-radius: 12px; background-color: #e6ffe6;}
            .select {border-radius: 12px; background-color: grey;}
        </style>
        <title> Zamelduj </title>
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
            $date = date("Y-m-d");
            echo "<h2> Dzisiejsza data: ";
            echo $date;
            echo "</h2>";
            $query = "SELECT * FROM rezerwacja WHERE przyjazd = '".$date."'";
            $prepared = $conn->prepare($query);
            $prepared->execute();
            $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
            ?>
            <table id = "all">
            <th>
            <center><td> Zamelduj/Edytuj </td><center>
            <center><td> Nr rezerwacji </td><center>
            <center><td> Pesel </td><center>
            <center><td> Imię </td><center>
            <center><td> Nazwisko </td><center>
            <center><td> Przyjazd </td><center>
            <center><td> Wyjazd </td><center>
            <center><td> Numer pokoju </td><center>
            <center><td> Kwota/doba </td><center>
            <center><td> Komentarz </td><center>
            </th>
            <?php
            foreach($result as $data) {
            
            ?>
            <tr>
            <center><td><?php echo $sn; ?> </td><center>
            <center><td><button class = "checkin" id =<?php echo $data['id_rezerwacji']; ?>> Zamelduj </button> <button class = "select" id =<?php echo $data['id_rezerwacji']; ?>> Edytuj </button></td><center>
            <center><td><?php echo $data['id_rezerwacji']; ?> </td><center>
            <center><td class = 'pesel' id = <?php echo $data['pesel_id']; ?>><?php echo $data['pesel_id']; ?> </td><center>
            <center><td class = 'imie' id =<?php echo $data['imie']; ?>><?php echo $data['imie']; ?> </td><center>
            <center><td class = 'nazwisko' id =<?php echo $data['nazwisko']; ?>><?php echo $data['nazwisko']; ?> </td><center>
            <center><td class = 'przyjazd' id =<?php echo $data['przyjazd']; ?>><?php echo $data['przyjazd']; ?> </td><center>
            <center><td class = 'wyjazd' id = <?php echo $data['wyjazd']; ?>  ><?php echo $data['wyjazd']; ?> </td><center>
            <center><td class = 'pokoj' id =<?php echo $data['numer_pokoju']; ?>  ><?php echo $data['numer_pokoju']; ?> </td><center>
            <center><td class = 'kwota'id = <?php echo $data['kwota/doba']; ?> ><?php echo $data['kwota/doba']; ?> </td><center>
            <center><td class = 'komentarz' id =<?php echo $data['komentarz']; ?> ><?php echo $data['komentarz']; ?> </td><center>
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
        $(".select").click(function() {
            var Id=$(this).attr('id');
            window.close();
            window.open('resdetails.php?Id='+Id);
            location.close();
        });
        $(document).ready(function(){
            $(".checkin").click(function(e) {
            e.preventDefault();
            var Id=$(this).attr('id');
            var pesel = $(".pesel").attr('id');
            var imie = $(".imie").attr('id');
            var nazwisko = $(".nazwisko").attr('id');
            var przyjazd = $(".przyjazd").attr('id');
            var wyjazd = $(".wyjazd").attr('id');
            var pokoj = $(".pokoj").attr('id');
            var kwota = $(".kwota").attr('id');
            var komentarz = $(".komentarz").attr('id');
            $.ajax({
                url: 'finalcheckin.php?Id='+Id+"&pesel="+pesel+"&nazwisko="+nazwisko+"&imie="+imie+"&przyjazd="+przyjazd+"&wyjazd="+wyjazd+"&pokoj="+pokoj+"&kwota="+kwota+"&komentarz="+komentarz,
                method: 'POST',
                success: function () {
                    window.alert('Poprawnie zameldowano');
                    location.reload();
                }
            });
        });
    });
    </script>
    
</body>
</html>