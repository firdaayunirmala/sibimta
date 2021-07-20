<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php $nim = $_SESSION['nim'];
    ?>

    <input type="hidden" id="nimCall" value="<?php echo $nim ?>" ;>

    <div class=row>
        <div class="col-lg-6">
            <div class="card-header bg-success py-3">
                <h6 class="m-0 font-weight-bold text-white text-center">Dosen Pembimbing 1</h6>
            </div>
            <div class="card border-left-success shadow h-80 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div id="dataBimbingan" class="row">
                            <div class="col-lg-12" id="pembimbing1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-success py-3">
                    <h6 class="m-0 font-weight-bold text-white text-center">Dosen Pembimbing 2</h6>
                </div>
                <div class="card border-left-success shadow h-80 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div id="dataBimbingan" class="row">
                                <div class="col-lg-12" id="pembimbing2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function() {
        var nimCall = $('#nimCall').val();
        $.ajax({
            type: "GET",
            url: 'API/data/dataDosenPembimbing.php?nim=' + nimCall,
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            success: function(data) {
                if (data == "data_not_found") {
                    var html = '';
                    html += '<div class="row no-gutters"><div class=""><p class="card-text">Anda Belum Meliliki Dosen Pembimbing 1</p></div></div></div>';
                    $('#pembimbing1').html(html);
                    $('#pembimbing2').html(html);
                } else {
                    var StringData = JSON.stringify(data);
                    var MahasiswaData = jQuery.parseJSON(StringData);
                    var mahasiswaDataPush = MahasiswaData.data;
                    console.log(mahasiswaDataPush.length);
                    var html1 = '';
                    var html2 = '';
                    var item1 = mahasiswaDataPush[0];
                    var item2 = mahasiswaDataPush[1];
                    html1 += '<div class="row no-gutters"><div class=""><p class="card-text">Nama Dosen Pembimbing = ' + item1.name + '</p><p class="card-text">Email Dosen = ' + item1.email + '</p><p class="card-text">WhatsApp = ' + item1.hp + '</p></div></div></div>';
                    html2 += '<div class="row no-gutters"><div class=""><p class="card-text">Nama Dosen Pembimbing = ' + item2.name + '</p><p class="card-text">Email Dosen = ' + item2.email + '</p><p class="card-text">WhatsApp = ' + item2.hp + '</p></div></div></div>';
                    
                    $('#pembimbing1').html(html1);
                    $('#pembimbing2').html(html2);
                }
            }
        });
    });
</script>