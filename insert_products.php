<?php
include_once("controller.php");
?>


<html>
    <body>
    <form action="skateboards.php" method="POST" enctype="multipart/form-data">

    <br>
    
    <label for="name">Name:</label>
    <input type="text" name="name"><br><br>

    <label for="brand">Brand:</label>
    <input type="text" name="brand"><br><br>

    <label for="description">Description:</label>
    <input type="text" name="description"><br><br>

    <label for="price">Price:</label>
    <input type="number" name="price" min="0.00" max="10000.00" step="0.01" /><br><br>

    <label for="photo">Upload product image:</label>
    <input type="file" name="photo[]"><br><br>


    <input type="submit" value="Upload">
    </form>

</body>
        <?php
            //======================================================================
            // Image upload
            //======================================================================
            // We check if the data is coming via POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Iterate all the files
                foreach ($_FILES["photo"]["error"] as $position => $error) {
                    // Check if it uploaded correctly
                    if ($error == UPLOAD_ERR_OK) {
                        // Define a directory to save the images
                        $upload_path = './img/';
                        // Define the final path of the file
                        $uploaded_file = $upload_path . basename($_FILES['photo']['name'][$position]);
                        // Move the file from the temporary folder to the defined path
                        if (move_uploaded_file($_FILES['photo']['tmp_name'][$position], $uploaded_file)) {
                            // Confirmation message if upload is ok
                            echo '<p>Upload ok!' . $_FILES['photo']['name'][$position] . '.</p>';
                            // Show the uploaded image
                            echo '<p><img width="500" src="' . $uploaded_file . '"></p>';
                        } else {
                            // Error message: size? attack?
                            echo '<p>¡Ups! Something\'s wrong.</p>';
                        }
                    }
                }
            }
        ?>
    </body>
</html>
