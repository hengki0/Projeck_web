<?php
session_start();
include 'koneksi.php';
include 'tgl_indo.php';
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

function kode_random($length)
{
    $data = "1234567890";
    $string = 'PJ-';

    for ($i = 0; $i < $length; $i++) {
        $pos = rand(0, strlen($data) - 1);
        // $string .= $data{$pos};
    }

    return $string;
}

$kode = kode_random(10);

$username = $_POST['username'];
$password = $_POST['password'];
$login = $_POST['login'];

if ($login) {
    $sql = $koneksi->query("select * from user where username='$username' and password='$password' ");
    $ketemu = $sql->num_rows;
    $data = $sql->fetch_assoc();

    if ($ketemu >= 1) {
        session_start();

        if ($data['level'] == "kasir") {
            $_SESSION['kasir'] = $data['id'];
            header("location:index.php");
            exit();
        }
    } else {
        echo "Login Gagal";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Halaman Login</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">

        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST">
                    <div class="msg">Masukkan Username dan Password</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xs-4">
                            <input type="submit" name="login" value="Login" class="btn btn-block bg-pink waves-effect">
                        </div>
                    </div>
                </form>

                <!-- Formulir Biodata -->
                <form id="sign_up" method="POST" action="proses_tambah_biodata.php">
                    <div class="msg">Isi Biodata Anda</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                        </div>
                    </div>
                    <!-- Tambahkan field-formulir biodata lainnya sesuai kebutuhan -->
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="submit" name="simpan_biodata" class="btn btn-block bg-pink waves-effect">
                                Simpan Biodata
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-in.js"></script>
    <?php
    // Gabungkan konten dari home.php dan kodepj.php
    include 'home.php';
    include 'kodepj.php';
    ?>
</body>

</html>

<?php
include 'index.php';
include 'tgl_indo.php';
include 'koneksi.php';
include 'logout.php';
?>
