<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col mt-2">
            <table class="table">
                <a href="/komik/create" class="btn btn-primary mb-2">Add Data Komik</a>

                <?= session()->getFlashdata('pesan'); ?>

                <h2>Daftar komik</h2>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <?php $no = 1; ?>
                <?php foreach ($komik as $k) : ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><img src="/img/<?= $k['sampul']; ?>" alt="" class="sampul"></td>
                            <td><?= $k['judul']; ?></td>
                            <td>
                                <a href="/komik/<?= $k['slug']; ?>" class="badge bg-success">Detail</a>
                            </td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>