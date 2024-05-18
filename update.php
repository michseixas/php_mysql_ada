<?php
include_once("controller.php");
?>
<html>

<?php
//This part of the code  is the GET method of the page.  Here we receive the id and we obtain the other attributes to populate the form with the information to be updated
//Its a GET and not a POST because we have to, first, GET  the ID of the skate we want to update. We will use the POST later to do the actual update
if ($_SERVER['REQUEST_METHOD'] == 'GET') { 
    $id = $_GET['id'];

    $skateDetails = getSkateById($id); //call the function getSkateByID created in the controller.php file. The retrieved info of the product is stored in the $skateDetails array.

}

?> 

<body>
    <form method="POST" enctype="multipart/form-data">

        <br>
        <input type="hidden" name="id" value="<?= htmlspecialchars($id); ?>"> <!-- send the skate id as a hidden value to the post -->

        <label for="name">Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($skateDetails['name']) ?>"><br><br>
        
        <label for="brand">Brand:</label>
        <input type="text" name="brand" value="<?= htmlspecialchars($skateDetails['brand']) ?>"><br><br>

        <label for="description">Description:</label>
        <input type="text" name="description" value="<?= htmlspecialchars($skateDetails['description']) ?>"><br><br>

        <label for="price">Price:</label>
        <input type="number" name="price" min="0.00" max="10000.00" step="0.01" value="<?= htmlspecialchars($skateDetails['price']) ?>"><br><br>

        <label for="photo">Upload product image:</label>
        <input type="file" name="photo[]" value="<?= htmlspecialchars($skateDetails['photo']) ?>"><br><br>

        <input type="submit" value="Upload">
    </form>

    <?php
    
    // This part of the code  is the POST method of the page.
    // Here we have all the new values EDITED by the users in the form.
    // with this values, we will update the database record using an SQL UPDATE 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // This is the same File Upload code that was used in the insert_products.php

        foreach ($_FILES["photo"]["error"] as $position => $error) {
            // Check if it uploaded correctly
            if ($error == UPLOAD_ERR_OK) {
                // Define a directory to save the images
                $upload_path = './img/';
                $filename = basename($_FILES['photo']['name'][$position]);
                // Define the final path of the file
                $uploaded_file = $upload_path . $filename;
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
        // Collect form data
        $id = $_POST['id']; //where have to add the ID here because this one is not "auto generated and auto incremented", it's gonna be the same. 
        $name = $_POST['name']; //this is already the edited value that comes from the form
        $brand = $_POST['brand']; //this is already the edited value that comes from the form
        $price = $_POST['price']; //this is already the edited value that comes from the form
        $description = $_POST['description']; //this is already the edited value that comes from the form


        try {
            // Prepare SQL and bind parameters
            $stmt = $myPDO->prepare("UPDATE skates 
                                    SET name = :name, brand = :brand, description = :description, price = :price, photo = :photo
                                    WHERE id = :id; ");
            $stmt->bindParam(':id', $id);  //where have to add the ID here because this one is not "auto generated and auto incremented", it's gonna be the same.                
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':brand', $brand);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':photo', $filename);

            // Execute the prepared statement
            $stmt->execute();

            echo "Record updated successfully";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    ?>

</body>

</html>