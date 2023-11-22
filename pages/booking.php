<!DOCTYPE html>
<html lang="zxx">

<head>
  <title>Tropical Hotel</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script>
    addEventListener("load", function() {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }

    // script validasi untuk menentukan hanya 16 digit
    document.addEventListener("DOMContentLoaded", function() {
      var nomorIdentitasInput = document.getElementById("nomorIdentitas");
      var errorText = document.getElementById("errorText");

      nomorIdentitasInput.addEventListener("input", function() {
        var nomorIdentitas = this.value.replace(/\D/g, '');
        if (nomorIdentitas.length !== 16) {
          errorText.innerText = "Isian salah. Data harus 16 digit.";
        } else {
          errorText.innerText = "";
        }
      });
    });

    // untuk menampilkan harga tipe kamar
    document.addEventListener("DOMContentLoaded", function() {
      var tipeKamarSelect = document.getElementById("tipeKamar");
      var hargaInput = document.getElementById("harga");

      tipeKamarSelect.addEventListener("change", function() {
        var selectedOption = tipeKamarSelect.options[tipeKamarSelect.selectedIndex];
        var hargaValue = parseInt(selectedOption.value, 10); // Konversi ke bilangan bulat

        // Update the harga input value
        hargaInput.value = hargaValue;
      });
    });

    function hitungTotalBayar() {
      var hargaKamar = parseInt(document.getElementById("tipeKamar").value);
      var durasiMenginap = parseInt(document.getElementById("durasiMenginap").value);
      var additionalService = document.getElementById("additionalService").checked;

      // Harga setelah diskon 10% jika durasi menginap lebih dari 3 hari
      var diskon = durasiMenginap > 3 ? 0.1 : 0;
      var hargaSetelahDiskon = hargaKamar - (hargaKamar * diskon);

      // Tambahan biaya breakfast jika dipilih
      var biayaBreakfast = additionalService ? 80000 : 0;

      // Total Harga
      var totalHarga = (hargaSetelahDiskon + biayaBreakfast) * durasiMenginap;

      // Mengisi nilai otomatis pada input total harga
      document.getElementById("totalHarga").value = totalHarga;
    }

    function updateGambar() {
    var tipeKamarSelect = document.getElementById("tipeKamar");
    var fotoKamarDiv = document.getElementById("fotoKamar");
    var selectedOption = tipeKamarSelect.options[tipeKamarSelect.selectedIndex].value;

    // Menentukan gambar berdasarkan tipe kamar yang dipilih
    var imageURL;
    switch (selectedOption) {
      case "250000":
        imageURL = "../assets/images/G1.jpg"; 
        break;
      case "450000":
        imageURL = "../assets/images/G2.jpg";
        break;
      case "650000":
        imageURL = "../assets/images/G3.jpg"; 
        break;
      default:
        imageURL = "../assets/images/G1.jpg"; 
    }

    // Perbarui gambar
    fotoKamarDiv.innerHTML = '<img src="' + imageURL + '" class="img-fluid" alt="">';
  }
  </script>
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
  <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel='stylesheet' type='text/css' media="all">
  <link href="//fonts.googleapis.com/css?family=Playfair+Display:400,700" rel="stylesheet">
  <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
</head>

<body>
  <section class="about py-lg-4 py-md-3 py-sm-3 py-3" id="about">
    <div class="container py-lg-5 py-md-4 py-sm-4 py-3">
      <div class="title-tag mb-lg-5 mb-md-4 mb-sm-4 mb-3 pb-lg-3 pb-md-2">
        <div class="row">
          <div class="title-wls-text col-lg-6 col-md-6 txt-rightside">
            <p>"Selamat datang di formulir pemesanan eksklusif Tropical Hotel, di mana kenyamanan dan kemudahan bertemu dengan kemewahan. Isi formulir ini dengan detail pribadi Anda untuk memastikan pengalaman menginap yang personal dan sesuai dengan preferensi Anda"</p>
          </div>
          <div class="col-lg-6 col-md-6 ">
            <h6 class="title-top-txt mb-2">Get in Touch</h6>
            <h3 class="title">Booking Form</h3>
          </div>
        </div>
      </div>
      <div class="about-details">
        <div class="row">
          <div class="col-lg-6 col-md-6">
            <form action="insert.php" method="post">
              <div class="form-group about-forms">
                <label>Nama Pemesan</label>
                <input type="text" class="form-control" name="nama_pemesan">
              </div>
              <div class="form-group about-forms">
                <p>Jenis Kelamin</p>
                <label>
                  <input type="radio" name="jenis_kelamin" value="Laki-Laki"> Laki-Laki
                </label>
                <label>
                  <input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan
                </label>
              </div>
              <div class="form-group about-forms">
                <label>Nomor Identitas</label>
                <input type="number" class="form-control" id="nomorIdentitas" name="nomor_identitas">
                <small id="errorText" style="color: red;"></small>
              </div>
              <div class="form-group about-forms">
                <label>Tipe Kamar</label>
                <select class="form-control" id="tipeKamar" name="tipe_kamar" onchange="updateGambar()" required="">
                  <option class="form-control" value="" selected disabled>Pilih Tipe Kamar</option>
                  <option class="form-control" value="250000">Standar</option>
                  <option class="form-control" value="450000">Deluxe</option>
                  <option class="form-control" value="650000">Executive</option>
                </select>
              </div>
              <div class="form-group about-forms">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" id="harga" readonly>
              </div>
              <div class="form-group about-forms">
                <label>Tanggal Pesan</label>
                <input type="date" class="form-control" name="tanggal_pesan">
              </div>
              <div class="form-group about-forms">
                <label>Durasi Menginap</label>
                <input type="number" class="form-control" id="durasiMenginap" name="durasi_menginap">
              </div>
              <div class="form-group about-forms">
                <p>Termasuk Breakfast</p>
                <label>
                  <input type="checkbox" id="additionalService" value="80000" name="breakfast"> Ya
                </label>
              </div>
              <div class="form-group about-forms">
                <label>Total Harga</label>
                <input type="number" class="form-control" id="totalHarga" name="total_harga" readonly>
              </div>
              <button type="button" class="btn btn-block sent-butnn" onclick="hitungTotalBayar()">Hitung Total Bayar</button>
              <button type="submit" class="btn btn-block sent-butnn">Simpan</button>
              <button type="reset" class="btn btn-block ">Cancel</button>
            </form>
          </div>

          <div class="col-lg-6 col-md-6 address-grid">
            <div class="row address-about-form">
              <div class="col-lg-3 col-md-4 col-sm-4">
                <div class="footer-icon text-center">
                  <span aria-hidden="true"></span>
                </div>
              </div>
              <div class=" footer-about-list col-lg-9 col-md-8 col-sm-8">
                <h6 class="mb-3">Foto Kamar
                </h6>
                <div class="w3pvt-post-img" id="fotoKamar">
        <img src="../assets/images/g1.jpg" class="img-fluid" alt="">
      </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
   <!-- footer -->
   <footer class="py-lg-4 py-md-3 py-sm-3 py-3">
      <div class="container-fluid">
        <div class="footer-main text-center">
          <p> 
            © 2023 Troppical Hotel. All Rights Reserved</a>
          </p>
        </div>
        <div class="icons txt-center mt-lg-4 mt-3 ">
          <ul>
            <li><a href="#"><span class="fa fa-facebook"></span></a></li>
            <li><a href="#"><span class="fa fa-twitter"></span></a></li>
            <li><a href="#"><span class="fa fa-instagram"></span></a></li>
            <li><a href="#"><span class="fa fa-youtube"></span></a></li>
          </ul>
        </div>
      </div>
    </footer>
    <!--//footer -->
</body>