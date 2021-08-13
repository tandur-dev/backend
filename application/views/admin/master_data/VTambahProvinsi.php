<body>
    <header class="page-header page-header-dark bg-gray-500 pb-10">
        <div class="container-fluid">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                        <a href="<?= base_url('Kamar'); ?>">
                            <button class="btn btn-primary btn-icon mr-2 my-1" type="button"><i class="fas fa-arrow-left"></i></button>
                        </a>
                        <div class="page-header-icon"><i data-feather="plus-circle"></i></div>
                        <?= $title; ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid mt-n10">
        <div class="row">
            <div class="col-lg-12">
                <!-- Default Bootstrap Form Controls-->
                <div id="default">
                    <div class="card mb-4">
                        <div class="card-header">Form Tambah Kamar</div>
                        <div class="card-body">
                            <form action="<?= base_url('Kamar/aksiTambahKamar/'); ?>" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputNama">Nomor Kamar</label>
                                        <input type="text" class="form-control" placeholder="Nomor Kamar" name="NOMOR_KAMAR" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="jenisKamar">Jenis Kamar</label>
                                        <select class="form-control select-modal-width" id="jenisKamar" name="JENIS_KAMAR">
                                            <option>Pilih Jenis Kamar</option>
                                            <?php
                                            foreach ($jenisKamar as $item) {
                                                echo '
                                                    <option value="' . $item->ID_JENIS . '">' . $item->NAMA_KAMAR . '</option>
                                                ';
                                            }
                                            ?>
                                        </select>                                        
                                    </div>
                                </div>                                
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputUsername">Lantai Kamar</label>
                                        <input type="text" class="form-control" name="LANTAI_KAMAR" placeholder="Lantai Kamar" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-warning">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>