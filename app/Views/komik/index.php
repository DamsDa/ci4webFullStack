<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/komik/create" class="btn btn-primary mt-3">Tambah Data Komik</a>
            <h1 class="my-2 text-white">Daftar Komik</h1>
            <!-- jika ada session yang dikirmkan dari method save yang namanya pesan maka-->
            <?php if(session()->getFlashdata('pesan')): ?>
                <!-- tampilkan alert -->
                <div class="alert alert-success" role="alert">
                    <!-- dan tampilkan pesannya -->
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="text-white">
                    <?php $i = 1; ?>
                    <?php foreach($komik as $k): ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><img src="/img/<?= $k['sampul']; ?>" class="sampul"></td>
                        <td><?= $k['judul']; ?></td>
                        <td>
                            <a href="/komik/<?= $k['slug']; ?>" class="btn btn-success">Detail</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<svg class="position-absolute" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f3f4f5" fill-opacity="1" d="M0,96L48,122.7C96,149,192,203,288,213.3C384,224,480,192,576,154.7C672,117,768,75,864,64C960,53,1056,75,1152,74.7C1248,75,1344,53,1392,42.7L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
<?= $this->endSection(); ?>