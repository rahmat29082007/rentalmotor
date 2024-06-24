<?php
    class Data{
        public $member;
        public $jenis;
        public $waktu;
        public $diskon;
        public $pajak;
        private $Vario,$Beat,$Nmax,$Mio,$Aerox;
        private $listMember = ['Christy','Sam','Alex','Ara'];

        function __construct(){
            $this->pajak = 10000;
        }

        public function getMember(){
            if(in_array($this->member, $this->listMember)){
                return "Member";
            }else{
                return "Non Member";
            }
        }

        public function setHarga($Jenis1,$Jenis2,$Jenis3,$Jenis4,$Jenis5){
            $this->Vario = $Jenis1;
            $this->Beat = $Jenis2;
            $this->Nmax = $Jenis3;
            $this->Mio = $Jenis4;
            $this->Aerox = $Jenis5;
        }

        public function getHarga(){
            $data['Vario'] = $this->Vario;
            $data['Beat'] = $this->Beat;
            $data['Nmax'] = $this->Nmax;
            $data['Mio'] = $this->Mio;
            $data['Aerox'] = $this->Aerox;
            return $data;
        }
    }    

    class Rental extends Data {
        public function hargaRental(){
            $dataHarga = $this->getHarga()[$this->jenis];
            $diskon = $this->getMember() == "Member" ? 5 : 0;
            if($this->waktu === 1){
                $bayar = ($dataHarga - ($dataHarga * $diskon / 100)) + $this->pajak;
            }else{
                $bayar = (($dataHarga * $this->waktu) - ($dataHarga * $diskon/100)) + $this->pajak;
            }
            return [$bayar,$diskon];
        }

        public function pembayaran(){
            echo '<div style="border : 1px solid black; width: 40%; padding: 10px; margin: 10px;">';
            echo "<center>";
            echo $this->member . " berstatus sebagai " . $this->getMember() . " mendapatkan diskon sebesar " . $this->hargaRental()[1] . "%";
            echo "<br>";
            echo "Jenis motor yang dirental adalah" . $this->jenis . " selama " . $this->waktu . " hari";
            echo "<br>";
            echo "Harga rental per-harinya : Rp. " . number_format($this->getHarga()[$this->jenis],0,',','.');
            echo "<br>";
            echo "<br>";
            echo "Besar yang harus dibayarkan adalah Rp. " . number_format($this->hargaRental()[0], 0,',','.');
            echo "</center>";
            echo '</div>';
        }
    }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Rental Well </title>
</head>
<body>
    <center>
        <h1><b>Rental Motor</b></h1>
        <table>
            <form action="" method="post">
                <tr>
                    <td>Nama Pelanggan</td>
                    <td>:</td>
                    <td><input type="text" name="nama" required></td>
                </tr>
                <tr>
                    <td>Lama Waktu Rental (Per-Hari)</td>
                    <td>:</td>
                    <td><input type="number" name="LamaRental" min="0 "max="100000000" required></td>
                </tr>
                <tr>
                    <td>Jenis Motor</td>
                    <td>:</td>
                    <td>
                        <select name="jenis" required;>
                            <option value="Vario">Vario</option>
                            <option value="Beat">Beat</option>
                            <option value="Nmax">Nmax</option>
                            <option value="Mio">Mio</option>
                            <option value="Aerox">Aerox</option>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="Bayar" name="Bayar"></td>
                </tr>
        </table>
        <?php
        $proses = new Rental();
        $proses -> setHarga(70000,90000,90000,100000,120000);
        
        if(isset($_POST['Bayar'])){
            $proses->member = $_POST['nama'];
            $proses->jenis = $_POST['jenis'];
            $proses->waktu = $_POST['LamaRental'];
            $proses->pembayaran();
        }
        ?>
    </center>
</body>
</html>
