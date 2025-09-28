<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <h2>Array Terindeks</h2>
        <?php
            $Listdosen=["Elok Nur Hamdana", "Unggul Pamenang", "Bagas Nugraha"];
            $i = 0;
            foreach($Listdosen as $list){
                echo $Listdosen [$i] . "<br>";
                $i++;
            }
        ?>
    </body>
</html>