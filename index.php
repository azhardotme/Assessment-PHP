<?php
include "database.php";

//insert data .
$db = new Database();
if (isset($_POST['submit'])) {
    $names  = $_POST['name'];

    if (isset($_FILES['image']['tmp_name'])) {
        $tmp_name = $_FILES['image']['tmp_name'];
        $target = "images/.";
        $name = $_FILES["image"]["name"];
        move_uploaded_file($tmp_name, "$target/$name");
    }
    $image = $name;


    if ($names == '') {
        $msg = "Field must not be empty";
    } else {
        $query = "INSERT INTO students_info(name,image) VALUES('$names','$image')";
        $insert = $db->insert($query);
    }
}

//show all data query.
$db = new database();
$query = "SELECT * FROM students_info";
$read = $db->select($query);


//edit data by id query..

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $db = new Database();
    $query = "SELECT * FROM students_info WHERE id = $id";
    $data = $db->edit($query)->fetch_assoc();
}
//update data......................................................................................

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name  = $_POST['name'];
    $image = $_FILES["image"]["name"];
    $db = new database();
    $update = "UPDATE  students_info SET name ='$name', image='$image' WHERE  id= $id";

    $tmp_name = $_FILES['image']['tmp_name'];
    $target = "images/.";
    $name = $_FILES["image"]["name"];
    move_uploaded_file($tmp_name, "$target/$name");
    $image = $name;

    $save = $db->update($update);
}


//delect data..

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $connection = new Database();
    $del = "DELETE FROM students_info WHERE id=$id";
    $connection->delete($del);
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Information</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="container">
        <h2 class="heading">Students Information</h2>

        <div style="color: red;">
            <samp>
                <?php
                if (isset($_GET['msg'])) {
                    echo " " . $_GET['msg'];
                }
                ?>
            </samp>
        </div>
        </br>
        <form class="form-style-1" method="POST" action="index.php" enctype="multipart/form-data">
            <table class="table table-hover">
                <tr>
                    <td>Student Name :</td>
                    <td>
                        <input type="text" class="required" value="<?php if (isset($_GET['edit'])) echo $data['name']; ?>" name="name" placeholder="Enter  name">
                        <input type="hidden" value="<?php if (isset($_GET['edit'])) echo $data['id']; ?>" name="id">
                    </td>

                </tr>

                <tr>
                    <td>Images:</td>
                    <td>
                        <input type="file" class="required" name="image" value="<?php if (isset($_GET['edit'])) echo $data['image']; ?>" placeholder="Enter image">
                    </td>
                </tr>

                <tr>
                    <td>
                        <?php if (isset($_GET['edit'])) { ?>
                            <input type="submit" name="update" value="Update">

                        <?php  } else { ?>
                            <input type="submit" name="submit" value="Submit">

                        <?php } ?>
                    </td>

                </tr>
            </table>
        </form>
    </div>
    </div>
    </div>
    </div>
    </div>

    <div class="container"></br>

        <table>
            <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            <?php if ($read) { ?>

                <?php while ($row = $read->fetch_assoc()) {  ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>

                        <td>
                            <img src="<?php echo 'images/' . $row['image']; ?>" width="80px" height="80px" />


                        </td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id']; ?>">Edit</a>
                            <a href="index.php?delete=<?php echo $row['id']; ?>">Delete</a>

                        </td>
                    </tr>
                <?php }; ?>
            <?php }; ?>

        </table>



    </div>
</body>

</html>