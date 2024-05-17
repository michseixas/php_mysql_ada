<?php
include_once("controller.php");

// Glob dynamically fetch all image files from the img directory and then 
//displays them in an HTML table. Any new images added to the directory will automatically be included. 
//It the creates an array to be easily iterated.
//GLOB_BRACE flag allows the use of the {} syntax to match multiple patterns.
$images = glob('img/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
?>

<!DOCTYPE html>
<html>

<head>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
        }
    </style>
</head>

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
            <th>Price</th>
            <th>Image</th>
        </tr>
        <!-- The foreach loop iterates over the $skates array, and for each skate, it checks if there is a corresponding image in the $images array. -->
        <?php foreach ($skates as $key => $value) : ?>
            <tr>
                <td><?= htmlspecialchars($value['name']); ?></td>
                <td><?= htmlspecialchars($value['brand']); ?></td>
                <td><?= htmlspecialchars($value['price']); ?></td>
                <td>
                    <?php if (isset($images[$key])) : ?> <!-- checks the $images array & sees if there is an image corresponding to the current skate item and displays it -->
                        <img src="<?= htmlspecialchars($images[$key]); ?>" alt="Skate Image" width="100" height="100" style="border:2px solid black">
                    <?php else : ?>
                        No image available
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br><br>
    <a href="insert_products.php"> Insert new product >>></a>
</body>

</html>