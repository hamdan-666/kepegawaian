<?php
include 'db.php';
$kontak = mysqli_query($conn, "SELECT username, password nama FROM admin WHERE id_admin = 1");
$a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <header>
        <div class="logo">Aplikasi Kepagawaian</div>
    </header>
    <main>
        <div class="login-container">
            <div class="login-box">
                <h2>SELAMAT DATANG</h2>
                <form action="" method="POST">
                    <input type="text" name="user" placeholder="Masukkan Username Anda" class="int">
                    <input type="password" name="pass" placeholder="Masukkan Password Anda" class="int">
                    <input type="submit" name="submit" value="Login" class="login-button">
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    session_start();
                    include 'db.php';

                    $user = mysqli_real_escape_string($conn, $_POST['user']);
                    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

                    $cek = mysqli_query(
                        $conn,
                        "SELECT * FROM admin WHERE  username = '" . $user . "' AND password = '" . md5($pass) . "'"
                    );
                    if (mysqli_num_rows($cek) > 0) {
                        $d = mysqli_fetch_object($cek);
                        $_SESSION['status_login'] = true;
                        $_SESSION['a_global'] = $d;
                        $_SESSION['id_admin'] = $d->id_admin;
                        echo '<script>window.location="beranda.php"</script>';
                    } else {
                        echo '<script>alert("Username atau password Anda salah!")</script>';
                    }
                }
                ?>

                <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                <script src="js/jquery.min.js"></script>
                <!-- Include all compiled plugins (below), or include individual files as needed -->
                <script src="js/bootstrap.min.js"></script>
</body>

</html>