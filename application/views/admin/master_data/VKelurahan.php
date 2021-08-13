<body>
    <header class="page-header page-header-dark bg-gray-500 pb-10">
        <div class="container-fluid">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="list"></i></div>
                        Kelurahan
                        </h1>
                        Daftar Kelurahan
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid mt-n10">
        <div class="card mb-4">
            <div class="card-header">
                <?= $this->session->flashdata('message'); ?>
                <a href="<?= base_url('ProvinsiController/tambahProvinsi/'); ?>" class='btn btn-primary btn-sm' type='submit'><i class="fa fa-plus mr-1"></i>Tambah Kelurahan</a>
            </div>
            <div class="card-body">
                <div class="datatable">
                    <?php
                    $template = array('table_open' => '<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">');
                        $this->table->set_template($template);
                        $this->table->set_heading('ID Kelurahan', 'ID Kecamatan', 'Nama Kelurahan','Aksi');
                        $no = 1;
                        foreach ($kelurahan as $row) {
                        $this->table->add_row(
                        $row->ID_KELURAHAN,
                        $row->ID_KECAMATAN,
                        $row->NAMA_KELURAHAN,
                        '
                        <a title="Edit Kamar" href="'.  base_url("ProvinsiController/editProvinsi/".$row->ID_KELURAHAN).'" type="button" class="btn btn-warning mt-1 btn-sm"><i class="fa fa-edit"></i>
                        </a>
                        <button title="Hapus Kamar" type="button" class="btn btn-danger mt-1 btn-sm" data-toggle="modal" data-target="#hapusUserModal"><i class="fa fa-trash"></i>
                        </button>
                        '
                        );
                        }
                        echo $this->table->generate();
                        ?>
                    </div>
                </div>
                <!-- Modal Hapus -->
                <div class="modal fade" id="hapusUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Hapus Kamar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                               <h5>Apakah anda yakin akan menghapus kamar <b> <?= $row->NAMA_KELURAHAN ?> ? </b></h5>
                            </div>
                            <div class="modal-footer">
                                <a href="<?= base_url('Kamar/aksiHapusKamar/'.$row->ID_KELURAHAN) ?>" type="button" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Hapus</a>
                                <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>