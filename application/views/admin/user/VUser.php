<body>
    <header class="page-header page-header-dark pb-10" style="background: linear-gradient(90deg, #7CBD1E 0%, #A7D038 100%)">
        <div class="container-fluid">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="home"></i></div>
                        User
                        </h1>
                        Daftar User
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid mt-n10">
        <div class="card mb-4">
            <div class="card-header">
                <?= $this->session->flashdata('message'); ?>
                Daftar Lahan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered" id="tableUser" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($users as $item) {

                                $btnVerif = "";
                                if($item->ISVERIF_USER == "0"){
                                    $btnVerif = '
                                            <button type="button" data-toggle="modal" data-id="'.$item->EMAIL_USER.'" data-name="" data-target="#mdlVerif" class="btn btn-green btn-sm rounded mdlVerif" data-tooltip="tooltip" data-placement="top" title="Verif">
                                                <i class="fas fa-check"></i>
                                            </button>&nbsp;
                                            <button type="button" data-toggle="modal" data-id="'.$item->EMAIL_USER.'" data-name="" data-target="#mdlUnverif" class="btn btn-danger btn-sm rounded mdlUnverif" data-tooltip="tooltip" data-placement="top" title="Unverif">
                                                <i class="fa fa-times"></i>
                                            </button>&nbsp;' ;
                                    $status = '<span class="badge badge-light">Belum Terverikasi</span>';
                                }else if($item->ISVERIF_USER == "1"){
                                    $status = '<span class="badge badge-success">Terverifikasi</span>';
                                }else if($item->ISVERIF_USER == "2"){
                                    $status = '<span class="badge badge-danger">Ditolak</span>';
                                }
                                $foto = $item->FOTO_USER != null ? $item->FOTO_USER : base_url('assets/img/avatar.png');
                                echo '
                                    <tr>
                                        <td style="text-align: center;">
                                            <img class="img-account-profile rounded-circle" src="'.$foto.'" alt="" style="height: 3rem;">
                                        </td>
                                        <td>'.$item->EMAIL_USER.'</td>
                                        <td>'.$item->NAMA_USER.'</td>
                                        <td>'.$item->ALAMAT_USER.', '.$item->NAMA_KELURAHAN.', '.$item->NAMA_KECAMATAN.', '.$item->NAMA_KOTA.', '.$item->NAMA_PROVINSI.'</td>
                                        <td>'.$status.'</td>
                                        <td>
                                            '.$btnVerif.'
                                            <button type="button" data-toggle="modal" data-foto="'.$item->FOTOKTP_USER.'" data-id="'.$item->EMAIL_USER.'" data-target="#mdlKTP" class="btn btn-dark btn-sm rounded mdlKTP" data-tooltip="tooltip" data-placement="top" title="Foto KTP">
                                                <i class="fas fa-id-card"></i>
                                            </button>&nbsp;
                                            <button type="button" data-toggle="modal" data-foto="'.$item->SELFIE_USER.'" data-id="'.$item->EMAIL_USER.'" data-name="" data-target="#mdlSelfie" class="btn btn-dark btn-sm rounded mdlSelfie" data-tooltip="tooltip" data-placement="top" title="Selfie">
                                                <i class="fas fa-portrait"></i>
                                            </button>&nbsp;
                                        </td>
                                    </tr>
                                ';
                            }
                        ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Verif -->
    <div class="modal fade" id="mdlVerif" tabindex="-1" role="dialog" aria-labelledby="ubahPassword" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahPassword">Verifikasi User <code class="mdlVerif_name"></code></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin untuk menyetujui user <code class="mdlVerif_name"></code></p>
                </div>
                <div class="modal-footer">
                    <form action="<?= site_url('user/verif')?>" method="POST">
                        <input type="hidden" id="mdlVerif_id" name="EMAIL_USER">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Batal</button>
                        <button type="submit" class="btn btn-green"><i class="fa fa-check mr-1"></i>Setujui</button>
                    </form>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Unverif -->
    <div class="modal fade" id="mdlUnverif" tabindex="-1" role="dialog" aria-labelledby="ubahPassword" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahPassword">Verifikasi User <code class="mdlVerif_name"></code></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin untuk menolak user <code class="mdlVerif_name"></code></p>
                </div>
                <div class="modal-footer">
                    <form action="<?= site_url('user/unverif')?>" method="POST">
                        <input type="hidden" id="mdlUnverif_id" name="EMAIL_USER">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Batal</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-check mr-1"></i>Tolak</button>
                    </form>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Ktp -->
    <div class="modal fade" id="mdlKTP" tabindex="-1" role="dialog" aria-labelledby="ubahPassword" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahPassword">Foto KTP <code class="mdlKTP_id"></code></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="text-align: center;">
                        <img id="mdlKTP_src" style="max-width: 300px;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Selfie -->
    <div class="modal fade" id="mdlSelfie" tabindex="-1" role="dialog" aria-labelledby="ubahPassword" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahPassword">Foto Selfie <code class="mdlSelfie_id"></code></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <img id="mdlSelfie_src" style="max-width: 300px;" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var table = $('#tableUser').DataTable({
                "order": [
                    [0, 'asc']
                ],
                fixedColumns: false
            });
        });
        $('#tableUser tbody').on('click', '.mdlVerif', function(){
            const id = $(this).data('id');
            $('.mdlVerif_name').html(id);
            $('#mdlVerif_id').val(id);
        })
        $('#tableUser tbody').on('click', '.mdlUnverif', function(){
            const id = $(this).data('id');
            $('.mdlUnverif_name').html(id);
            $('#mdlUnverif_id').val(id);
        })
        $('#tableUser tbody').on('click', '.mdlKTP', function(){
            const id    = $(this).data('id');
            const ktp   = $(this).data('foto');

            $('.mdlKTP_id').html(id);
            $('#mdlKTP_src').attr('src', ktp);
        })
        $('#tableUser tbody').on('click', '.mdlSelfie', function(){
            const id    = $(this).data('id');
            const ktp   = $(this).data('foto');

            $('.mdlSelfie_id').html(id);
            $('#mdlSelfie_src').attr('src', ktp);
        })
    </script>
</body>