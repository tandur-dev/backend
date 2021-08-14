<body>
    <header class="page-header page-header-dark pb-10" style="background: linear-gradient(90deg, #7CBD1E 0%, #A7D038 100%)">
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
                <a href="<?= base_url('ProvinsiController/tambahProvinsi/'); ?>" class='btn btn-primary btn-sm' type='submit'><i class="fa fa-plus mr-1"></i>Tambah Provinsi</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tableKelurahan" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Kelurahan</th>
                                <th>Nama Kelurahan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#tableKelurahan').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'<?= site_url('master/kelurahan/ajxGetData')?>'
                },
                'columns': [
                    { data: 'idKelurahan' },
                    { data: 'nama' },
                    { data: 'aksi' }
                ]
            });
        });
    </script>
</body>