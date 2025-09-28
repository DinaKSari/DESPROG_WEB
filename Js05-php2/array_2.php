<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>
</head>
<body>
    <?php
    $Dosen = ['nama' => 'Elok Nur Hamdana',
    'domisili' => 'Malang',
    'jenis_kelamin' => 'Perempuan' ];
    ?>
    <table border="1" height="100%" width="40%" cellpadding="20" cellspacing="5">
        <tr>
            <td>
                <?php 
                    echo "Nama";
                ?>
            </td>
            <td>
                <?php 
                    echo "{$Dosen ['nama']}";
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php 
                    echo "Domisili";
                ?>
            </td>
            <td>
                <?php 
                    echo "{$Dosen ['domisili']}";
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php 
                    echo "Jenis Kelamin";
                ?>
            </td>
            <td>
                <?php 
                    echo "{$Dosen ['jenis_kelamin']}";
                ?>
            </td>
        </tr>
    </table>
</body>
</html>