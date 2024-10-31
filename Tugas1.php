<?php

// Namespace untuk mengatur kelas dalam kelompok berbeda
namespace PemrogramanWebsite2024;

// Trait yang akan digunakan di dalam kelas
trait Pesan {
    public function tampilPesan() {
        return "Ini adalah pesan dari trait Pesan";
    }
}

// Abstract Class
abstract class Manusia {
    abstract public function pekerjaan();
}

// Kelas Orang menggunakan Abstract Class dan Trait
class Orang extends Manusia {
    // Properties
    public $nama;
    public $umur;
    public $hobi;

    use Pesan; // Menggunakan trait

    // Constructor (Magic Method)
    public function __construct($nama, $umur, $hobi) {
        $this->nama = $nama;
        $this->umur = $umur;
        $this->hobi = $hobi;
    }

    // Method pekerjaan diimplementasikan dari Abstract Class
    public function pekerjaan() {
        return "Mahasiswa";
    }

    // Method tambahan
    public function tampilkanInfo() {
        return "Nama : {$this->nama}<br>Umur : {$this->umur}<br>Hobi : {$this->hobi}<br>Pekerjaan : " . $this->pekerjaan();
    }
}

// Kelas Mahasiswa mewarisi (Inheritance) dari kelas Orang
class Mahasiswa extends Orang {
    public $jurusan;

    // Constructor
    public function __construct($nama, $umur, $hobi, $jurusan) {
        parent::__construct($nama, $umur, $hobi);
        $this->jurusan = $jurusan;
    }

    // Method untuk menampilkan jurusan
    public function tampilJurusan() {
        return "Jurusan : {$this->jurusan}";
    }
}

// Instansiasi objek
$mahasiswa = new Mahasiswa("M. Syahrul Bachtiar", 19, "Mendaki", "Teknik Informatika");
echo $mahasiswa->tampilkanInfo() . "<br>";
echo $mahasiswa->tampilJurusan() . "<br>";
echo $mahasiswa->tampilPesan();

?>
