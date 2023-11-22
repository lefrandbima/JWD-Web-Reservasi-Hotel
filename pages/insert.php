<?php
require_once 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaPemesan = $_POST["nama_pemesan"];
    $jenisKelamin = $_POST["jenis_kelamin"];
    $nomorIdentitas = $_POST["nomor_identitas"];
    $tipeKamarValue = $_POST["tipe_kamar"];
    $harga = $_POST["harga"];
    $tanggalPesan = $_POST["tanggal_pesan"];
    $durasiMenginap = $_POST["durasi_menginap"];
    $breakfast = isset($_POST["breakfast"]) ? 'Ya' : 'Tidak';
    $totalHarga = $_POST["total_harga"];
    $diskon = ($durasiMenginap > 3) ? 0.1 * $harga : 0;

    // Convert the numeric room type to a string
    $tipeKamar = getRoomTypeString($tipeKamarValue);

    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO tbl_pemesanan 
            (nama_pemesan, jenis_kelamin, nomor_identitas, tipe_kamar, harga, tanggal_pesan, durasi_menginap, diskon, breakfast, total_harga)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $namaPemesan, $jenisKelamin, $nomorIdentitas, $tipeKamar, $harga, $tanggalPesan, $durasiMenginap, $diskon, $breakfast, $totalHarga);

    if ($stmt->execute()) {
        echo "Data berhasil disimpan";
    } else {
        echo "Error: " . $sql . "<br>" . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

function getRoomTypeString($value) {
    switch ($value) {
        case "250000":
            return "Standar";
        case "450000":
            return "Deluxe";
        case "650000":
            return "Executive";
        default:
            return "Unknown";
    }
}
?>
