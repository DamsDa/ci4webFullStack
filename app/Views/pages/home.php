<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- jumbotorn -->
<section>
    <div class="jumbotron text-center rounded-0">
        <img src="/img/bujursangkar.jpg" width="200" class="ml-3 mb-3 rounded">
        <h1 class="display-4">Hallo Driyaz Disini</h1>
        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f3f4f5" fill-opacity="1" d="M0,96L48,122.7C96,149,192,203,288,213.3C384,224,480,192,576,154.7C672,117,768,75,864,64C960,53,1056,75,1152,74.7C1248,75,1344,53,1392,42.7L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
  </section>
  <!-- projek style -->
    <section class="p-5 my-3 text-center ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-white mb-3">Projek Back-end Driyaz</h2>
                <div class="card-group ">
                    <?php foreach($komik as $k): ?>     
                        <div class="card">
                            <img src="/img/<?= $k['sampul']; ?>" class="sampul-closer img-thumbnail shadow">
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
          </section>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f3f4f5" fill-opacity="1" d="M0,96L48,122.7C96,149,192,203,288,213.3C384,224,480,192,576,154.7C672,117,768,75,864,64C960,53,1056,75,1152,74.7C1248,75,1344,53,1392,42.7L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        <!-- start contact -->
    <section id="contact" class="mt-3">
      <div class="container text-white">
        <div class="row">
          <div class="col text-center mb-3">
            <h2>Contact Me</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="alert alert-success alert-dismissible fade show d-none" role="alert">
              <strong>Pesan anda</strong> Sudah terkirim terimakasih sudah berkunjung.
            </div>
            <form name="contact-dams">
              <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" aria-describedby="nama" name="nama" required/>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" aria-describedby="email" name="email" required/>
              </div>
              <div class="mb-3">
                <label for="pesan" class="form-label">Pesan</label>
                <textarea class="form-control" id="pesan" rows="3" name="pesan"></textarea>
              </div>
              <button type="submit" class="btn text-white btnkirim" style="background-color: #bb294d">Kirim</button>
              <button class="btn text-white btnloading d-none" style="background-color: #bb294d" type="button" disabled>
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                Loading...
              </button>
            </form>
          </div>
        </div>
      </div>

        <svg class="position-absolute" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f3f4f5" fill-opacity="1" d="M0,96L48,122.7C96,149,192,203,288,213.3C384,224,480,192,576,154.7C672,117,768,75,864,64C960,53,1056,75,1152,74.7C1248,75,1344,53,1392,42.7L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
<?= $this->endSection(); ?>