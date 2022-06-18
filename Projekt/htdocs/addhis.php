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
            .tel {width: 5%;}
            #zapisz {border-radius: 12px; background-color:#e6ffe6;}
        </style>
        <title> Dodaj nową osobę </title>
    </head>
<body>
    <table>
     <tr>
        <td><img id="prev" src="img/prev.png" onclick="window.location.href='his.php'"></td>
    </tr>
    </table>
    <center><p>Pesel: <input type = "text" id = "pesel"></input></p><center>
    <center><p>Imię: <input type = "text" id = "imie"></input></p><center>
    <center><p>Nazwisko: <input type = "text" id = "nazwisko"></input></p><center>
    <center><p>Rabat: <input type = "text" id = "rabat"></input></p><center>
    <center><p>Telefon: <input type = "text" class = 'tel' id = "telefon1"></input> - <input type = "text" class = 'tel' id = "telefon2"></input> - <input type = "text" class = 'tel' id = "telefon3"></input> </p><center>
    <center><p><button id = "zapisz"> Zapisz </button></p><center>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  
    <script>
        $(document).ready(function(){
            $("#zapisz").click(function(e) {
            e.preventDefault();
            var pesel=document.getElementById("pesel").value;
            var imie=document.getElementById("imie").value;
            var nazwisko=document.getElementById("nazwisko").value;
            var rabat=document.getElementById("rabat").value;
            var telefon=document.getElementById("telefon1").value+'-'+document.getElementById("telefon2").value+'-'+document.getElementById("telefon3").value;
            $.ajax({
                url: 'addnewhis.php?pesel='+pesel+"&imie="+imie+"&nazwisko="+nazwisko+"&rabat="+rabat+"&telefon="+telefon,
                method: 'POST',
                success: function () {
                    window.alert('Dodano poprawnie');
                    window.close();
                    location.reload();
                }

            });
        });
    });
    </script>
    
</body>
</html>