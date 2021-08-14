<body>
    <header class="page-header page-header-dark pb-10" style="background-color: #7CBD1E;">
        <div class="container-fluid">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="home"></i></div>
                        Lahan
                        </h1>
                        Daftar Lahan
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
                <table class="table table-bordered" id="tableLahan" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email Pemilik</th>
                            <th>Nama Lahan</th>
                            <th>Alamat Lahan</th>
                            <th>Kota Lahan</th>
                            <th>Ukuran</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($lahans as $item) {
                                $btnVerif = "";
                                if($item->ISVERIF_LAHAN == "0"){
                                    $btnVerif = '
                                            <button type="button" data-toggle="modal" data-id="'.$item->ID_LAHAN.'" data-name="" data-target="#mdlVerif" class="btn btn-green btn-sm rounded mdlVerif" data-tooltip="tooltip" data-placement="top" title="Verif">
                                                <i class="fas fa-check"></i>
                                            </button>&nbsp;
                                            <button type="button" data-toggle="modal" data-id="'.$item->ID_LAHAN.'" data-name="" data-target="#mdlUnverif" class="btn btn-danger btn-sm rounded mdlUnverif" data-tooltip="tooltip" data-placement="top" title="Unverif">
                                                <i class="fa fa-times"></i>
                                            </button>&nbsp;' ;
                                    $status = '<span class="badge badge-light">Belum Terverikasi</span>';
                                }else if($item->ISVERIF_LAHAN == "1"){
                                    $status = '<span class="badge badge-success">Terverifikasi</span>';
                                }else if($item->ISVERIF_LAHAN == "2"){
                                    $status = '<span class="badge badge-danger">Ditolak</span>';
                                }
                                echo '
                                    <tr>
                                        <td>'.$item->ID_LAHAN.'</td>
                                        <td>'.$item->EMAIL_USER.'</td>
                                        <td>'.$item->NAMA_LAHAN.'</td>
                                        <td>'.$item->ALAMAT_LAHAN.'</td>
                                        <td>'.$item->NAMA_KOTA.'</td>
                                        <td>'.$item->PANJANG_LAHAN.' x '.$item->LEBAR_LAHAN.' Meter</td>
                                        <td>Rp.'.number_format($item->HARGA_LAHAN).'</td>
                                        <td>'.$status.'</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                '.$btnVerif.'
                                                <button type="button" data-toggle="modal" data-foto1="'.$item->FOTO1_LAHAN.'" data-foto2="'.$item->FOTO2_LAHAN.'" data-id="'.$item->ID_LAHAN.'" data-target="#mdlFoto" class="btn btn-dark btn-sm rounded mdlFoto" data-tooltip="tooltip" data-placement="top" title="Foto">
                                                    <i class="fas fa-image"></i>
                                                </button>&nbsp;
                                                <button type="button" data-toggle="modal" data-gallery="'.$item->GALLERY_LAHAN.'" data-id="'.$item->ID_LAHAN.'" data-name="" data-target="#mdlGallery" class="btn btn-dark btn-sm rounded mdlGallery" data-tooltip="tooltip" data-placement="top" title="Gallery">
                                                    <i class="fas fa-images"></i>
                                                </button>&nbsp;
                                                <button type="button" data-toggle="modal" data-id="'.$item->ID_LAHAN.'" data-lat="'.$item->LATITUDE_LAHAN.'" data-long="'.$item->LONGITUDE_LAHAN.'" data-name="" data-target="#mdlMaps" class="btn btn-dark btn-sm rounded mdlMaps" data-tooltip="tooltip" data-placement="top" title="Maps">
                                                    <i class="fas fa-map-marked-alt"></i>
                                                </button>
                                            </div>
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
                    <h5 class="modal-title" id="ubahPassword">Verifikasi Lahan <code class="mdlVerif_name"></code></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin untuk menyetujui lahan <code class="mdlVerif_name"></code></p>
                </div>
                <div class="modal-footer">
                    <form action="<?= site_url('lahan/verif')?>" method="POST">
                        <input type="hidden" id="mdlVerif_id" name="ID_LAHAN">
                        <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Batal</button>
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
                    <h5 class="modal-title" id="ubahPassword">Verifikasi Lahan <code class="mdlVerif_name"></code></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin untuk menolak lahan <code class="mdlVerif_name"></code></p>
                </div>
                <div class="modal-footer">
                    <form action="<?= site_url('lahan/unverif')?>" method="POST">
                        <input type="hidden" id="mdlUnverif_id" name="ID_LAHAN">
                        <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Batal</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-check mr-1"></i>Tolak</button>
                    </form>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Foto -->
    <div class="modal fade" id="mdlFoto" tabindex="-1" role="dialog" aria-labelledby="ubahPassword" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahPassword">Foto Lahan <code class="mdlFoto_id"></code></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Foto 1</label>
                            <div class="sbp-preview">
                                <div class="sbp-preview-content">
                                    <div class="form-group">
                                        <!-- wadah preview -->
                                        <div style="text-align: center;">
                                            <img id="mdlFoto_foto1" src="" style="max-width: 300px"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Foto 2</label>
                            <div class="sbp-preview">
                                <div class="sbp-preview-content">
                                    <div class="form-group">
                                        <!-- wadah preview -->
                                        <div style="text-align: center;">
                                            <img id="mdlFoto_foto2" src="" style="max-width: 300px"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Gallery -->
    <div class="modal fade" id="mdlGallery" tabindex="-1" role="dialog" aria-labelledby="ubahPassword" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahPassword">Gallery Lahan <code class="mdlGallery_id"></code></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" id="mdlGallery_items"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Maps -->
    <div class="modal fade" id="mdlMaps" tabindex="-1" role="dialog" aria-labelledby="ubahPassword" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahPassword">Maps Lahan <code class="mdlMaps_id"></code></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="mdlMaps_coor">
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var table = $('#tableLahan').DataTable({
                ordering: false,
                "order": [
                    [0, 'asc']
                ],
                fixedColumns: false
            });
        });
        $('#tableLahan tbody').on('click', '.mdlVerif', function(){
            const id = $(this).data('id');
            $('.mdlVerif_name').html(id);
            $('#mdlVerif_id').val(id);
        })
        $('#tableLahan tbody').on('click', '.mdlUnverif', function(){
            const id = $(this).data('id');
            $('.mdlUnverif_name').html(id);
            $('#mdlUnverif_id').val(id);
        })
        $('#tableLahan tbody').on('click', '.mdlFoto', function(){
            const id    = $(this).data('id');
            const foto1 = $(this).data('foto1');
            const foto2 = $(this).data('foto2');

            console.log(foto1)

            $('.mdlFoto_id').html(id);
            $('#mdlFoto_foto1').attr('src', foto1);
            $('#mdlFoto_foto2').attr('src', foto2);
        })
        $('#tableLahan tbody').on('click', '.mdlGallery', function(){
            const id        = $(this).data('id');
            const gallery   = $(this).data('gallery');
            
            let galleryArr  = gallery.split(';');
            let html        = "";
            let no          = 1;
            for(let i of galleryArr){
                const isActive = no == 1? "active" : "";
                html += `
                    <div class="carousel-item ${isActive}">
                        <img class="d-block w-100" src="${i}">
                    </div>
                `;
                no++;
            }
            html += `
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            `
            $('#mdlGallery_items').html(html);
            $('.mdlGallery_id').html(id);
        })
        $('#tableLahan tbody').on('click', '.mdlMaps', function(){
            const id    = $(this).data('id');
            const lat   = $(this).data('lat');
            const long  = $(this).data('long');

            $('.mdlMaps_id').html(id)
            $('#mdlMaps_coor').html(`
                <iframe
                    width="100%"
                    height="600"
                    frameborder="0"
                    scrolling="no"
                    marginheight="0"
                    marginwidth="0"
                    src="https://maps.google.com/maps?q=${lat}, ${long}&hl=en-US&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                    >
>   
                </iframe>
            `)
        })
    </script>
</body>