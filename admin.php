<?php require_once("auth_admin.php"); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body text-center">
                    <img class="img img-responsive rounded-circle mb-3" width="160" src="img/<?php echo $_SESSION['user']['photo'] ?>" />
                    <h3><?php echo  $_SESSION["user"]["name"] ?></h3>
                    <p><?php echo $_SESSION["user"]["email"] ?></p>
                    <p><a href="index.php">Home</a></p>
                    <p><a href="index.php">Logout</a></p>
                    <p><a href="database.php">Manage User</a></p>
                </div>
            </div>  
        </div>
    </div>
</div>

</body>
</html>