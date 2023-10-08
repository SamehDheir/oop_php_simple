<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'crud.php';

$select = new DataBaseController('users');
if (isset($_POST['edit'])) {
    $result_edit = $select->edit($_POST['edit_id']);
    $row = mysqli_fetch_array($result_edit);
}
if (isset($_POST['update'])) {
    $result_edit = $select->updateRoles($_POST['update_id'], $_POST['role'] );
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
    <div class="container">
        <h2 class="text-center m-4">ADD POST</h2>
        <form method="POST">
            <div class="form-floating mb-3">
                <input type="hidden" name="update_id" value="<?php echo $row['id'] ?>">
                <input type="text" name="name" disabled value="<?php echo $row['name'] ?>" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Name</label>
            </div>
            <div class="form-floating">
                <textarea class="form-control" name="email" disabled placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"><?php echo $row['email'] ?></textarea>
                <label for="floatingTextarea2">Email</label>
            </div>
            <select class="form-select form-select-lg my-3" name="role" aria-label="Large select example">
                <option selected><?php echo $row['roles'] ?></option>
                <option value="user">user</option>
                <option value="admin">admin</option>
            </select>
            <button type="submit" name="update" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>