<?php
session_start();
require 'functions.php';
//cek cookie
// if(isset($_COOKIE['login'])) {
//     if($_COOKIE['login'] == 'true') {
//         $_SESSION['login'] = true;
//     }
// }

if(isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    //ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username 
    FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    //cek cookie dan username
    if($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if(isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}



if (isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    

     // Menggunakan prepared statement untuk mencegah SQL Injection
    //  $stmt = mysqli_prepare($conn, "SELECT * FROM user WHERE username = ?");
    //  mysqli_stmt_bind_param($stmt, "s", $username);
    //  mysqli_stmt_execute($stmt);
    //  $result = mysqli_stmt_get_result($stmt);

     
    $result = mysqli_query($conn, "SELECT * FROM user 
    WHERE username = '$username'");

    //cek username
    if (mysqli_num_rows($result) === 1){
        //cek password
        $row = mysqli_fetch_assoc($result);
        var_dump($row);
        if(password_verify($password, $row["password"])){
            //set session
            $_SESSION["login"] = true;
            
            //cek remember me
            if(isset($_POST["remember"])){
                // setcookie('login', 'true', time() + 60);
                //buat cookie
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }
            header("Location: index.php");
            exit;
        };
    } 
    $error = true;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1 class="h3 mb-3 text-center">Login</h1>

                        <?php if (isset($error)) : ?>
                            <div class="alert alert-danger" role="alert">
                                Username / Password Salah
                            </div>
                        <?php endif; ?>

                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                  <input type="checkbox" id="remember" name="remember" />
                                  <label for="remember">Remember Me</label>
                                </div>
                            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
