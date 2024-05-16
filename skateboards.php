<?php
include_once("controller.php")
?>

<html>
    <style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    </style>
    <body>
        <p>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo 'Concierto agregado!';
        }
        ?>
        </p>

        <h1>Skate list</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>Brand</th>
            </tr>
            <?php foreach ($skates as $clave => $valor): ?> 
                <tr>
                <td><?= $valor['name']; ?></td>
                <td><?= $valor['brand']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <br><br>
        <!-- <a href="crear_concierto.php"> Crear Concierto >>></a> -->
    </body>


</html>