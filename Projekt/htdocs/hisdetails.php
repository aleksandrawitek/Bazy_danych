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
                $query = "SELECT * FROM gosc WHERE id_pesel = '".$Id."'";
                $prepared = $conn->prepare($query);
                $prepared->execute();
                $result = $prepared -> fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php
                foreach($result as $data) {
                ?>
                <table>
                <tr>
                <td><img id="prev" src="img/prev.png" onclick="window.location.href='his.php'"></td>
                </tr>
                </table>
                <center><p>Pesel: <input type = "text" id = "pesel" value = <?php echo $data['id_pesel'];?>></input></p><center>
                <center><p>Imię: <input type = "text" id = "imie" value = <?php echo $data['imie']; ?>></input></p><center>
                <center><p>Nazwisko: <input type = "text" id = "nazwisko" value = <?php echo $data['nazwisko'];?>></input></p><center>
                <center><p>Rabat: <input type = "text" id = "rabat" value = <?php echo $data['rabat']; ?>></input></p><center>
                <center><p>Telefon: <input type = "text" class = 'tel' id = "telefon1" value= <?php echo $data['telefon']; ?>></input></p><center>
                <center><p>Historia: <?php echo $data['historia']; ?></p><center>

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
            var pesel=document.getElementById("pesel").value;
            var imie=document.getElementById("imie").value;
            var nazwisko=document.getElementById("nazwisko").value;
            var rabat=document.getElementById("rabat").value;
            var telefon=document.getElementById("telefon1").value;
            $.ajax({
                url: 'updatehis.php?pesel='+pesel+"&imie="+imie+"&nazwisko="+nazwisko+"&rabat="+rabat+"&telefon="+telefon,
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