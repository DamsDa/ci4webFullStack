<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="my-2 text-white">Daftar Orang</h1>
            <a href="/orang/create" class="btn btn-primary mb-3">Tambah Data Member</a>
                        <!-- jika ada session yang dikirmkan dari method save yang namanya pesan maka-->
                        <?php if(session()->getFlashdata('pesan')): ?>
                <!-- tampilkan alert -->
                <div class="alert alert-success" role="alert">
                    <!-- dan tampilkan pesannya -->
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <form action="" method="post" class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Cari Member" name="keyword">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Cari</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="text-white"> 
                    <?php $i = 1 + (6 * ($currentPage - 1)); ?>
                    <?php foreach ($orang as $o): ?>
                        <tr>
                            <th scope="row">
                                <?= $i++; ?>
                            </th>
                            <td>
                                <?= $o['nama']; ?>
                            </td>
                            <td>
                                <?= $o['alamat']; ?>
                            </td>
                            <td>
                                <a href="/orang/<?= $o['id']; ?>" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('orang', 'orang_pagination') ?>
        </div>
    </div>
</div>
<svg class="position-absolute" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f3f4f5" fill-opacity="1" d="M0,96L48,122.7C96,149,192,203,288,213.3C384,224,480,192,576,154.7C672,117,768,75,864,64C960,53,1056,75,1152,74.7C1248,75,1344,53,1392,42.7L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
<?= $this->endSection(); ?>