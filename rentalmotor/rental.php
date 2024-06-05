<?php 
class Data {
    public $member;
    public $jenis;
    public $waktu;
    public $diskon;

    protected $pajak;

    private $scooter, $sport, $sportTouring, $cross;
    private $listMember = ["sam", "ana", "cia", "hana"];

    function __construct()  {
        $pajak = 10000;
    }

    public function getMember() {
        if (in_array($this->member, $this->listMember)) {
            return "Member";
        } else {
            return "Non Member";
        }
    }

    public function setHarga($jenis1, $jenis2, $jenis3, $jenis4) {
        $this->scooter = $jenis1;
        $this->sport = $jenis2;
        $this->sportTouring = $jenis3;
        $this->cross = $jenis4;
    }

    public function getHarga() {
        $data["scooter"] = $this->scooter;
        $data["sport"] = $this->sport;
        $data["sportTouring"] = $this->sportTouring;
        $data["cross"] = $this->cross;

        return $data;
    }
}

class Rental extends Data {
    public function hargaRental() {
        $dataHarga = $this->getHarga()[$this->jenis];
        $diskon = $this->getMember() == "Member" ? 5 : 0;

        if ($this->waktu === 1) {
            $bayar = ($dataHarga * ($diskon / 100)) + $this->pajak;
        } else {
            $bayar = ($dataHarga * $this->waktu) - ($dataHarga * ($diskon / 100)) + $this->pajak;
        }

        return [$bayar, $diskon];
    }

    public function pembayaran() {
        echo $this->member . " berstatus sebagai " . $this->getMember() . " mendapatkan diskon sebesar " . $this->hargaRental()[1] . "%";
        echo "<br>";
        echo "Jenis motor yang dirental adalah " . $this->jenis . " selama " . $this->waktu . " hari";
        echo "<br>";
        echo "Harga rental per harinya adalah " . number_format($this->getHarga()[$this->jenis], 0, ",",  ".");
        echo "<br>";
        echo "Besar uang yang harus dibayarkan adalah Rp" . number_format($this->hargaRental()[0], 0, ",", ".");
    }
}
?>