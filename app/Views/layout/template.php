<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- css gua -->
    <link rel="stylesheet" href="/css/style.css">
    <title><?= $title; ?></title>
</head>

<body style="background-color:rgb(134, 35, 145);">
    <!-- navbar -->
    <?= $this->include('layout/navbar'); ?>
    <!-- end navbar -->

    <!-- konten -->
    <?= $this->renderSection('content'); ?>
    <!-- end konten -->
    
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script>
      const scriptURL = 'https://script.google.com/macros/s/AKfycbzIVwcs4Vlabj3EtG0osImzbi4GY_fWRhN5Sy92w4RvmwmxiVGmha7MblvYUM4L5qyZ6Q/exec'
      const form = document.forms['contact-dams']
      const btnkirim = document.querySelector(".btnkirim")
      const btnloading = document.querySelector(".btnloading")
      const alert = document.querySelector(".alert")

      
      form.addEventListener('submit', e => {
        e.preventDefault()
        // ketika tombol kirim di klik
        // maka tampilkan loading dan hilangkan kirim
        btnkirim.classList.toggle("d-none");
        btnloading.classList.toggle("d-none");
        fetch(scriptURL, { method: 'POST', body: new FormData(form)})
          .then(response => {
            // setelah success tampilkan kirim dan hilangkan loading
            btnkirim.classList.toggle("d-none");
            btnloading.classList.toggle("d-none");
            // tampilkan alert
            alert.classList.toggle("d-none");
            // reset form
            form.reset();
            console.log('Success!', response)
          })
          .catch(error => console.error('Error!', error.message))
      })

        const sampul = document.querySelector('#sampul');
        const sampulLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.imgPreview');
        // tulisan label kita ubah menjadi nama sampul yang kita pilih
        sampulLabel.textContent = sampul.files[0].name;
        
        // buat function untuk mengubah perview
        function previewImage() {
            // ambil file sampul yang di upload
            const fileSampul = new FileReader();
            // ambil alamat peyimpanannya terus ambil nam filenya
            fileSampul.readAsDataURL(sampul.files[0]);
            // ketika file sampul ini onload jalankan function event
            fileSampul.onload = function(e) {
                // sourcenya kita ganti menjadi gambar yang baru kita upload
                imgPreview.src = e.target.result;
            }
        };
        sampul.addEventListener("change", previewImage);
        </script>
</body>

</html>