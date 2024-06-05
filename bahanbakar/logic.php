<?php
    // Sedikan kotak pembungkus yang digunakan (sesuai dengan fitur)
    class DataBahanBakar {
        private $HargaSSuper;
        private $HargaSVPower;
        private $HargaSVPowerDiesel;
        private $HargaSVPowerNitro;
        // Attribut harga2 dibuat private karena sudah ada getter yang akan menampilkan datanya, dan ada setter yang akan mengisi datanya
        public $jenisYangDipilih;
        public $totalLiter;
        // Attribut di atas di set public karena nilai yang diisi berasal dari luar

        protected $totalPembayaran;
        // Set protected karena hanya digunakan oleh class ini dan turunannya untuk proses data, tidak akan ditampilkan di luar

        public function setHarga($valSSuper, $valSVPower, $valSVPowerDiesel, $valSVPowerNitro){
            // Mengisi nilai attribut, nilai nantinya diisi dari luar class melalui fungsi setter ini
            // Nilai dari luar diambil kedalam class melalui parameter (variable yang didalam kurung), nilai dari luar
            // Penamaan parameter bebas asal urutan pengisian dari luar sesuai

            $this->HargaSSuper = $valSSuper;
            $this->HargaSVPower = $valSVPower;
            $this->HargaSVPowerDiesel = $valSVPowerDiesel;
            $this->HargaSVPowerNitro = $valSVPowerNitro;
        }

        public function getHarga() {
            // Setelah nilai dari attribut disimpan, fungsi getter akan mengambilkan/menampilkannya untuk digunakan
            // Karena data yang akan dikirim/dikeluarkan lebih dari satu, maka data tersebut disatukan terlebih dahulu
            $semuaDataSolar['SSuper'] = $this->HargaSSuper;
            $semuaDataSolar['SVPower'] = $this->HargaSVPower;
            $semuaDataSolar['SVPowerDiesel'] = $this->HargaSVPowerDiesel;
            $semuaDataSolar['SVPowerNitro'] = $this->HargaSVPowerNitro;
            // Tujuan utama dari getter : return
            return $semuaDataSolar;
        }
    }

    class Pembelian extends DataBahanBakar {
        // Data sudah disediakan, tinggal proses penghitungan jumlah pembelian
        public function totalHarga(){
            $this->totalPembayaran = $this->getHarga()[$this->jenisYangDipilih] * $this->totalLiter;
        }

        public function cetakBukti() {
            ?>
            <div style="border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9; padding: 10px;">
                <p style="font-weight: bold; color: #333;">----------------------------------------</p>
                <p style="font-weight: bold; color: #333;">Anda membeli bahan bakar tipe: <?php echo $this->jenisYangDipilih; ?></p>
                <p style="font-weight: bold; color: #333;">Dengan jumlah: <?php echo $this->totalLiter; ?></p>
                <p style="font-weight: bold; color: #333;">Harga Bayar: Rp. <?php echo number_format($this->totalPembayaran, 0, ',', '.'); ?></p>
                <p style="font-weight: bold; color: #333;">----------------------------------------</p>
            </div>
            <?php
        }
    }
?>