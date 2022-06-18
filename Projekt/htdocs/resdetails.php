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
            .tel {width: 8%;}
            #zapisz {border-radius: 12px; background-color:#e6ffe6;}
        </style>
        <title> Edytuj </title>
    </head>
<body>
<?php
        $hostName = "localhost";
        $username = "root";
        $password = "";
        $databaseName = "awitek_hotel_app";
        $conn = new PDO("mysql:host=$hostName;dbname=$databaseName", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $Id=$_GET['Id'];

        try {
                $query = "SELECT * FROM rezerwacja WHERE id_rezerwacji = '".$Id."'";
                $prepared = $conn->prepare($query);
                $prepared->execute();
                $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php
                foreach($result as $data) {
                ?>
                <table>
                <tr>
                <td><img id="prev" src="img/prev.png" onclick="window.location.href='res.php'"></td>
                </tr>
                </table>
                <center><p class =<?php echo $data['id_rezerwacji'];?> id='res'><b>Numer rezerwacji: <?php echo $data['id_rezerwacji'];?></b></p><center>
                <center><p>Pesel: <?php echo $data['pesel_id'];?></p><center>
                <center><p>Imie: <?php echo $data['imie'];?></p><center>
                <center><p>Nazwisko: <?php echo $data['nazwisko'];?></p><center>
                <center><p>Przyjazd: <input type = "date" id = "przyjazd" value = <?php echo $data['przyjazd']; ?>></input></p><center>
                <center><p>Wyjazd: <input type = "date" id = "wyjazd" value= <?php echo $data['wyjazd']; ?>></input></p><center>
                <center><p>Kwota/doba: <input type = "text" id = "kwota" value= <?php echo $data['kwota/doba']; ?>></input></p><center>
                <center><p>Komentarz: <input id = "komentarz" value= <?php echo $data['komentarz']; ?>></input></p><center>
                <button class = "select" id ="zapisz"> Aktualizuj </button>
                
                <?php
                }
                ?>
                <?php
                } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  
    <script>
        $(document).ready(function(){
            $("#zapisz").click(function(e) {
            e.preventDefault();
            var id = $("#res").attr('class');
            var przyjazd=document.getElementById("przyjazd").value;
            var wyjazd=document.getElementById("wyjazd").value;
            var kwota=document.getElementById("kwota").value;
            var komentarz=document.getElementById("komentarz").value;
            $.ajax({
                url: 'updateres.php?id='+id+"&przyjazd="+przyjazd+"&wyjazd="+wyjazd+"&kwota="+kwota+"&komentarz="+komentarz,
                method: 'POST',
                success: function () {
                    window.alert('Zaktualizowano poprawnie');
                    window.close();
                    location.reload();
                }

            });
        });
    });
    </script>
    
</body>
</html>