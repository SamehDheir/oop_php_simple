<?php
include 'crud.php';

$select = new DataBaseController('users');
$result_users = $select->read();

if (isset($_POST['submit'])) {
    $select->delete($_POST['delete_id']);
    header('location:showUser.php');
}


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

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            while ($rows  = mysqli_fetch_array($result_users)) {
            ?>
                <tr>
                    <th scope="row"><?php echo $i++ ?></th>
                    <td><?php echo $rows['name'] ?></td>
                    <td><?php echo $rows['email'] ?></td>
                    <td><?php echo $rows['roles'] ?></td>

                    <td>
                        <form method="POST">
                            <input type="hidden" name="delete_id" value="<?php echo $rows['id'] ?>">
                            <button class="btn btn-danger" name="submit" type="submit">DELETE</button>
                        </form>
                        <form method="POST" action="editUser.php">
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>