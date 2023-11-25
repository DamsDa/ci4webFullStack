<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Detail Member</h2>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="/img/default.jpg" class="sampul-detail-orang">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $orang['nama']; ?></h5>
                            <p class="card-text"><b>Alamat : </b><?= $orang['alamat']; ?></p>
                            <a href="/orang/edit/<?= $orang['id']; ?>" class="btn btn-warning">Edit</a>
                            <form action="/orang/<?= $orang['id']; ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yaqueen Hapus?')">Delete</button>
                            </form>
                            <br></br>
                            <a href="/orang">Back To Daftar Member</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>