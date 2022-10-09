<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Detail Komik</h2>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $komik['sampul']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Judul Komik : <?= $komik['judul']; ?></h5>
                            <p class="card-text"><b>Penulis : </b> <?= $komik['penulis']; ?></p>
                            <p class="card-text"><b>Penerbit : </b> <?= $komik['penerbit']; ?></p>

                            <a href="/komik/edit/<?= $komik['slug']; ?>" class="btn btn-primary">Edit</a>

                            <form action="/komik/<?= $komik['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this data ? ')">Delete</button>
                            </form>

                            <br><br>
                            <a href="/komik" class="btn btn-secondary">Back to komik page list</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>