<?php

require_once("config.php");

if(isset($_POST['register'])){

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
 
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    $sql = "INSERT INTO users (name, username, email, password) 
            VALUES (:name, :username, :email, :password)";
    $stmt = $db->prepare($sql);

    $params = array(
        ":name" => $name,
        ":username" => $username,
        ":password" => $password,
        ":email" => $email
    ); 
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title> Daftar </title>
        <link rel = "stylesheet" type = "text/css" href = "register.css">
    </head>
<body>
    <div class = "loginbox">
    <img src = "img/logo.png" class = "avatar">
      <h1>Register</h1>
        <form action="" method="POST">
            <div class="form-group">
              <label for="name">Nama Lengkap</label>
              <input class="form-control" type="text" name="name" placeholder="Nama Lengkap" />
            </div>

            <div class="form-group">
              <label for="username">Username</label>
              <input class="form-control" type="text" name="username" placeholder="Username" />
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input class="form-control" type="text" name="email" placeholder="Alamat Email" />
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <input class="form-control" type="password" name="password" placeholder="Password" />
            </div>

            <input type="submit" class="btn btn-success btn-block" name="register" value="Daftar" />
            <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>    
          </form>
    </div>
</body>
</html>