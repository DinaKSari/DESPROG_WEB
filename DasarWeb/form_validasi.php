<!DOCTYPE html>
<html>
<head>
    <title>Form Input dengan Validasi</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Form Input dengan Validasi</h1>
    <form id="myForm" method="post" action="proses_validasi.php">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama">
        <span id="nama-error" style="color: red;"></span><br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email">
        <span id="email-error" style="color: red;"></span><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <span id="password-error" style="color: red;"></span><br>

        <input type="submit" value="Submit">
    </form>
    <script>
/*$(document).ready(function() {
    $("#myForm").submit(function(event) {
        var nama = $("#nama").val();
        var email = $("#email").val();
        var valid = true;

        if (nama === "") {
            $("#nama-error").text("Nama harus diisi.");
            valid = false;
        } else {
            $("#nama-error").text("");
        }

        if (email === "") {
            $("#email-error").text("Email harus diisi.");
            valid = false;
        } else {
            $("#email-error").text("");
        }

        if (!valid) {
            event.preventDefault(); 
        }
        // Menghentikan pengiriman form jika validasi gagal
    });
});
*/
$(document).ready(function () {
  $("#myForm").submit(function (event) {
    event.preventDefault(); // Mencegah reload halaman

    var nama = $("#nama").val();
    var email = $("#email").val();
    var valid = true;

    // Validasi sederhana
    if (nama === "") {
      $("#nama-error").text("Nama harus diisi.");
      valid = false;
    } else {
      $("#nama-error").text("");
    }

    if (email === "") {
      $("#email-error").text("Email harus diisi.");
      valid = false;
    } else {
      $("#email-error").text("");
    }

    // Jika validasi lolos, kirim data via AJAX
    if (valid) {
      $.ajax({
        url: "proses_validasi.php",
        type: "POST",
        data: { nama: nama, email: email },
        success: function (response) {
          alert("Data berhasil dikirim: " + response);
          $("#myForm")[0].reset(); // Kosongkan form setelah sukses
        },
        error: function () {
          alert("Terjadi kesalahan saat mengirim data!");
        }
      });
    }
  });
});

</script>
</body>
</html>