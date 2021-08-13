<body>
    <header class="page-header page-header-dark bg-gray-500 pb-10">
        <div class="container-fluid">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="home"></i></div>
                        Urban Farming
                        </h1>
                        Daftar Urban Farming
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid mt-n10">
        <div class="card mb-4">
            <div class="card-header">
                <?= $this->session->flashdata('message'); ?>
                Daftar Urban Farming
            </div>
            <div class="card-body">
                <div class="datatable">
                    <?php
                    $template = array('table_open' => '<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">');
                        $this->table->set_template($template);
                        $this->table->set_heading('No', 'Nama Penyewa', 'Email Penyewa', 'Tanggal Urban', 'Tanggal Selesai', 'Total Bayar', 'Action');
                        
                        $no = 1;
                        foreach ($urbanfarming as $row) {
                        $this->table->add_row(
                        $no++, 
                        $row->NAMA_PENYEWA,
                        $row->EMAIL_PENYEWA,
                        $row->TGL_URBAN,
                        $row->TGLSELESAI_URBAN,
                        number_format($row->TOTBAYAR_URBAN,0,',','.'),
                        '
                        <a title="Verif Urban" href="" type="button" class="btn btn-success mt-1 btn-sm"><i class="fa fa-check"></i>
                        </a>
                        '
                        );
                        ?>
                        <?php
                        }
                        echo $this->table->generate();
                        ?>
                    </div>
                </div>
            </div>
        </div>
</body>