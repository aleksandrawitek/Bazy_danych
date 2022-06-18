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
        <td><img id="prev" src="img/prev.png" onclick="window.location.href='extras.php'"></td>
    </tr>
    </table>
    <center><p>Numer rezerwacji: <input id = "res"></input></p><center>
    <center><p>Numer pokoju: <input id = "pokoj"></input></p><center>
    <center><p>Usługa: <input id = "usluga"></input></p><center>
    <center><p>Kwota: <input id = "kwota"></input></p><center>
    <center><p><button id = "zapisz"> Zapisz </button></p><center>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  
    <script>
        $(document).ready(function(){
            $("#zapisz").click(function(e) {
            e.preventDefault();
            var res=document.getElementById("res").value;
            var pokoj=document.getElementById("pokoj").value;
            var usluga=document.getElementById("usluga").value;
            var kwota=document.getElementById("kwota").value;
            $.ajax({
                url: 'addnewbill.php?res='+res+"&pokoj="+pokoj+"&usluga="+usluga+"&kwota="+kwota,
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