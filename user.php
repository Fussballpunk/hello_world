<?php
    include("includes/config.inc.php");
    include("includes/common.inc.php");
    include("includes/db.inc.php");

    $conn = dbConnect();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benutzer</title>
    <style>
        .hideuserdaten {
            display: none;
        }
        .showuserdaten {
            display: inline;
        }
    </style>
    <script>        
        window.addEventListener ("DOMContentLoadet",()=>
        let userdaten = getElementByClassName("hideuserdaten");
        for (let i; i< userdaten.length; i++){
            userdaten[i].addEventListener("click", (ev)=>{
                ev.target.classname ="showuserdaten";
            })
        }
        );
    </script>

</head>
<body>
    <h1>Benutzer</h1>
    <ul>
        <?php
        $sql= "
            SELECT 
                Nachname, 
                Vorname,
                Adresse,
                Ort, 
                Staat
                IDUser                
            FROM tbl_user
            INNER JOIN tbl_personen ON FIDPerson = IDPerson
            INNER JOIN tbl_staaten ON FIDStaat = IDStaat
        ";
        $user = dbQuery ($conn, $sql);
        while ($u = $user-> fetch_object()){
            echo('
                <li>'
                    .$u->Nachname.' ,'.$u.Vorname.' 
                    <a href="ausborgungen.php?user='.$u->IDUser.'">Ausborgungen</a> 
                    <div class="hideuserdaten"> '.$u->Adresse.' ,'.$u->PLZ.' ,'.$u->Ort.' ,'.$u->Staat.' ,'.$u->Email.'</div>
                    <ul>
            ');
            $sql = "
                SELECT 

                    
            ";
            
            echo('</li>');
        }
        ?>
    </ul>
</body>
</html>