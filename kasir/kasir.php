<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Kasir</title>
</head>
<style>
    a {
        text-decoration: none;
        color: white;
    }

    body{
        background-color: #ffdab9;
    }

    .card{
        background-color: #EEE8AA;
    }
</style>

<body>
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 m-auto">
                <div class="card text-center">
                    <div class="card-body">
                        <h1>KASIR</h1>
                        <form action="" method="POST" class="row d-flex align-items-center">
                            <label for="nama">Nama Barang</label>
                            <input type="text" id="nama" placeholder="Masukkan nama barang" name="nama"
                                class="form-control mb-2">

                            <label for="kode">Kode Barang</label>
                            <input type="number" id="kode" placeholder="Masukkan kode barang" name="kode"
                                class="form-control mb-2">

                            <label for="harga">Harga</label>
                            <input type="number" id="harga" placeholder="Masukkan harga barang" name="harga"
                                class="form-control mb-2">

                            <label for="jumlah">Jumlah Barang</label>
                            <input type="number" id="jumlah" placeholder="Masukkan jumlah barang" name="jumlah"
                                class="form-control mb-2">

                            <div class="col mt-3">
                                <button class="btn btn-primary" type="submit" name="kirim">
                                    <i class='bx bx-plus'></i> Tambah</button>
                                <button class="btn btn-danger" type="button" onclick="window.print()">
                                    <i class='bx bx-printer'></i> Print</button>
                                <button class="btn btn-secondary" type="button">
                                    <a href="destroy.php">Reset</a></button>
                                <button class="btn btn-warning" type="submit" name="hapus_semua">
                                    <i class='bx bx-trash'></i> Hapus Semua</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    session_start();

    // Initialize an array if the array is not initialized yet
    if (!isset($_SESSION['dataBarang'])) {
        $_SESSION['dataBarang'] = array();
    }

    if (isset($_POST["kirim"])) {
        if (empty($_POST['nama']) || empty($_POST['kode']) || empty($_POST['harga']) || empty($_POST['jumlah'])) {
            echo "<div class='alert alert-danger text-center'>Data kosong</div>";
        } else {
            $barang = array(
                "nama" => $_POST['nama'],
                "kode" => $_POST['kode'],
                "harga" => $_POST['harga'],
                "jumlah" => $_POST['jumlah']
            );

            array_push($_SESSION['dataBarang'], $barang);
        }
    }

    if (isset($_POST['hapus_semua'])) {
        // Clear all data
        $_SESSION['dataBarang'] = array();
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }

    if (!empty($_SESSION['dataBarang'])) {
        $totalHarga = 0;
        echo "<div class='container mt-3' id='printArea'><ul class='list-group'>";
        foreach ($_SESSION['dataBarang'] as $key => $value) {
            $subtotal = $value["harga"] * $value["jumlah"];
            $totalHarga += $subtotal;
            echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
            echo $value["nama"] . " - " . $value["kode"] . " - Rp" . number_format($value["harga"], 0, ',', '.') . " x " . $value["jumlah"] . " = Rp" . number_format($subtotal, 0, ',', '.');
            echo "<div>";
            echo "<a href='?edit=".$key."' class='btn btn-warning btn-sm me-2'>Edit</a>";
            echo "<a href='?hapus=".$key."' class='btn btn-danger btn-sm'>Hapus</a>";
            echo "</div>";
            echo "</li>";
        }
        echo "</ul></div>";
        echo "<div class='container mt-3'>";
        echo "<h3>Total: Rp" . number_format($totalHarga, 0, ',', '.') . "</h3>";
        echo "<form action='' method='POST' class='mt-3'>";
        echo "<label for='bayar'>Bayar</label>";
        echo "<input type='number' id='bayar' name='bayar' class='form-control mb-2' placeholder='Masukkan jumlah bayar'>";
        echo "<button class='btn btn-success' type='submit' name='selesai'><i class='bx bx-check'></i> Selesai</button>";
        echo "</form>";
        echo "</div>";
    }

    if (isset($_GET['hapus'])) {
        $index = $_GET['hapus'];
        unset($_SESSION['dataBarang'][$index]);
        $_SESSION['dataBarang'] = array_values($_SESSION['dataBarang']);
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }

    if (isset($_POST['selesai'])) {
        $bayar = $_POST['bayar'];
        if ($bayar >= $totalHarga) {
            $kembalian = $bayar - $totalHarga;
            echo "<div class='alert alert-success text-center'>Pembayaran berhasil! Kembalian: Rp" . number_format($kembalian, 0, ',', '.') . "</div>";
        } else {
            echo "<div class='alert alert-danger text-center'>Uang tidak cukup!</div>";
        }
    }
    ?>
</body>

</html>