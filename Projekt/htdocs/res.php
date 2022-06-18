<!DOCTYPE html>
<html>
    <head>
        <style>
            body {background-image: url("img/background.png");}
            .delete {border-radius: 12px; background-color:#ffb3b3;}
            input {border-radius: 12px;}
            #prev {width: 10%; height: 10%;}
            #all {border-collapse: collapse;}
            #all tr {border:solid black;}
            #all td {width:10%;}
            .select, .add {border-radius: 12px; background-color: grey;}
        </style>
        <title> Rezerwacje </title>
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
                $query = "SELECT * FROM rezerwacja order by przyjazd asc";
                $prepared = $conn->prepare($query);
                $prepared->execute();
                $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
                ?>
                <table id = "all">
                <tr>
                <center><td><b> Edytuj/Usuń</td><center>
                <center><td><b> Nr rezerwacji </td><center>
                <center><td><b> Pesel </td><center>
                <center><td><b> Imię </td><center>
                <center><td><b> Nazwisko </td><center>
                <center><td><b> Przyjazd </td><center>
                <center><td><b> Wyjazd </td><center>
                <center><td><b> Numer pokoju </td><center>
                <center><td><b> Kwota/doba </td><center>
                <center><td><b> Komentarz </td><center>
                </tr>
                <?php
                foreach($result as $data) {
                ?>
                <tr>
                <center><td><button class = "select" id =<?php echo $data['id_rezerwacji']; ?>> Edytuj </button><button id = <?php echo $data['id_rezerwacji'];?> class = "delete"> Usuń </button></td><center>
                <center><td><?php echo $data['id_rezerwacji']; ?> </td><center>
                <center><td><?php echo $data['pesel_id']; ?> </td><center>
                <center><td><?php echo $data['imie']; ?> </td><center>
                <center><td><?php echo $data['nazwisko']; ?> </td><center>
                <center><td><?php echo $data['przyjazd']; ?> </td><center>
                <center><td><?php echo $data['wyjazd']; ?> </td><center>
                <center><td><?php echo $data['numer_pokoju']; ?> </td><center>
                <center><td><?php echo $data['kwota/doba']; ?> </td><center>
                <center><td><?php echo $data['komentarz']; ?> </td><center>
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
            $(".delete").click(function(e) {
            e.preventDefault();
            var Id=$(this).attr('id');
            $.ajax({
                url: 'deleteres.php?Id='+Id,
                method: 'POST',
                success: function () {
                    window.alert("Poprawnie usunięto rezerwację");
                    location.reload();
                }

            });
        });
    });
      
    </script>
    
</body>
</html>