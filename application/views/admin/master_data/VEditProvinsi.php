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
                        <div class="page-header-icon"><i data-feather="edit-3"></i></div>
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
                        <div class="card-header">Form Edit Kamar</div>
                        <div class="card-body">
                            <form action="<?= base_url('Kamar/aksiEditKamar/'); ?>" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputNama">Nomor Kamar</label>
                                        <input type="text" class="form-control" value="<?= $kamar[0]->NOMOR_KAMAR ?>"  placeholder="Nomor Kamar" name="NOMOR_KAMAR" required>
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
                                        <input type="text" class="form-control" name="LANTAI_KAMAR" value="<?= $kamar[0]->LANTAI_KAMAR ?>"  placeholder="Lantai Kamar" required>
                                    </div>
                                </div>
                                <input type="hidden" value="<?= $kamar[0]->ID_KAMAR ?>" name="ID_KAMAR" class="form-control">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    //konfirmasi password sama
    $('#password, #confirm_password').on('keyup', function () {
    if ($('#password').val() == $('#confirm_password').val()) {
    $('#message').html('Matching').css('color', 'green');
    } else
    $('#message').html('Not Matching').css('color', 'red');
    });
    //preview sebelum upload
    function previewKTP() {
    document.getElementById("ktp-preview").style.display = "block";
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("source-fileKTP").files[0]);
    oFReader.onload = function(oFREvent) {
    document.getElementById("ktp-preview").src = oFREvent.target.result;
    };
    };
    //preview sebelum upload
    function previewFoto() {
    document.getElementById("foto-preview").style.display = "block";
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("source-foto").files[0]);
    oFReader.onload = function(oFREvent) {
    document.getElementById("foto-preview").src = oFREvent.target.result;
    };
    };
    // Add the following code if you want the name of the file appear on select
    $(".fileKTP").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".label-ktp").addClass("selected").html(fileName);
    });
    // Add the following code if you want the name of the file appear on select
    $(".foto").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".label-foto").addClass("selected").html(fileName);
    });
    </script>
</body>
<script>
Pusher.logToConsole = true;
var pusher = new Pusher('ee692ab95bb9aeaa1dcc', {
cluster: 'ap1',
forceTLS: true
});
var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(response) {
xhr=$.ajax({
method: 'POST',
url: "<?php echo base_url()?>/Notifikasi/listNotifikasi",
success : function(response){
$('.list-notifikasi').html(response);
}
})
});
$('.list-notifikasi').on('click','.notifikasi', function(e) {
console.log("Clicked");
});
</script>
</html>