<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study case oop</title>
</head>
<style>
    
    body{
        background-color: #d2b48c;
        margin-left: center;
        
        
    }

   
</style>
<body>
<center>
    <form method="GET" action=""></form>
        <h2>Rental Motor</h2>
        <table>
            <form action="" method="post">
                <tr>
                    <td>Nama Pelanggan</td>
                    <td>:</td>
                    <td><input type="text" name="nama"></td>
                </tr>  
                <tr>
                    <td>Lama Waktu Rental (per hari)</td>
                    <td>:</td>
                    <td><input type="text" name="lamaRental"></td>
                </tr>
                <tr>
                    <td>Jenis Motor</td>
                    <td>:</td>
                    <td>
                        <select name="jenis" required>
                            <option value="scooter">Scooter</option>
                            <option value="sport">Sport</option>
                            <option value="sportTouring">Motor Sport Touring</option>
                            <option value="cross">Motocross</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="Submit" name="submit"></td>
                </tr>
            </form>  
        </table>
        
        <?php
    // panggil filenya
    require 'rental.php';
    //baru buka , langsung set harga
    $logic = new Rental();
    $logic-> setharga(10000, 15000, 18000, 20000);
    if (isset($_POST['submit'])){
        $logic->member = $_POST['nama'];
        $logic->jenis = $_POST['jenis'];
        $logic->waktu = $_POST['lamaRental'];
        $logic->hargaRental();
        $logic->pembayaran();
        }
    ?>
            </table>
    </center>
</body>
</html>