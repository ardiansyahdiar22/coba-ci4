<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-7">
            <h2 class="mt-2">Form add data komik</h2>
            <form action="/komik/save" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : '' ?>" id="judul" name="judul" autofocus value="<?= old('judul'); ?>">
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            <?= $validation->getError('judul'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="penulis" name="penulis" value="<?= old('penulis'); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= old('penerbit'); ?>">
                    </div>
                </div>
                <div class="input-group mb-3">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-2">
                        <img src="/img/default.jpg" class="img-thumbnail img-preview">
                    </div>
                    <input type="file" class="custom-file-input <?= ($validation->hasError('sampul')) ? 'is-invalid' : '' ?>" id="sampul" onchange="previewImg()" name="sampul">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                        <?= $validation->getError('sampul'); ?>
                    </div>
                    <label for="sampul" class="custom-file-label"></label>
                </div>
                <button type="submit" class="btn btn-primary">Save Data</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>