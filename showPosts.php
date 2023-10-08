<?php
// session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'crud.php';

$select = new DataBaseController('posts');
$result_posts = $select->read();

if (isset($_POST['submit'])) {
    $select->delete($_POST['delete_id']);
    header('location:showPosts.php');
}
// 

// $per = new Roles($_SESSION['permissions'])



// 

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h2 class="text-center m-4 fw-bolder fs-1">POST</h2>


        <a href="logout.php" class="btn btn-warning m-4">LOG OUT</a>
        <?php
        // echo $_SESSION['permissions'];
        if (isset($_SESSION['permissions'])) {

        ?>
            <a href="addPost.php" class="btn btn-success m-4">ADD POST</a>
        <?php
        }
        ?>
        <?php
        if (isset($_SESSION['delete'])) {
        ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php
                echo  $_SESSION['delete'];
                unset($_SESSION['delete']);
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($rows  = mysqli_fetch_array($result_posts)) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $i++ ?></th>
                        <td><?php echo $rows['title'] ?></td>
                        <td><?php echo $rows['description'] ?></td>

                        <td class="d-flex" style="gap: 10px;">
                            <?php
                            if($_SESSION['roles'] == 'owner' || $_SESSION['roles'] == 'admin'){
                            ?>
                            <form method="POST">
                                <input type="hidden" name="delete_id" value="<?php echo $rows['id'] ?>">
                                <button class="btn btn-danger" name="submit" type="submit">DELETE</button>
                            </form>
                            <?php
                            }
                            ?>
                            <form method="POST" action="editPost.php">
                                <input type="hidden" name="edit_id" value="<?php echo $rows['id'] ?>">
                                <button class="btn btn-primary" name="edit" type="submit">EDIT</button>
                            </form>
                        </td>
                    </tr>

                <?php
                }
                ?>
            </tbody>
        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>