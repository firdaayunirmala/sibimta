    <!-- Page Heading -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <h5>Data Mahasiswa Bimbingan</h5>
        <?php $nik = $_SESSION['nik']; ?>

        <input type="hidden" id="nik" value="<?php echo $nik ?>" ;>

        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <td>No</td>
                        <td>NIM</td>
                        <td>Nama</td>
                        <td>Judul</td>
                        <td>Jurusan</td>
                        <td>Status</td>
                        <td>Opsi</td>
                    </tr>
                </thead>

                <?php
              $query = "SELECT
              d.id ,
              d.id_user ,
              m.nim ,
              m.name ,
              d.judul ,
              d.status,
              j.nama_jurusan,
              dd.id_dosen,
              dd.id as id_detail
          FROM
              datata d
          inner join datata_detail dd on
              dd.id_datata = d.id
          inner join mahasiswa m on
              m.id = d.id_user
          inner join jurusan j on
          m.kode_jurusan = j.id
          where
              d.id = id_dosen";
            $datata = $this->db->query($query)->result_array();
              ?>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($datata as $d) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $d['nim']; ?></td>
                            <td><?= $d['name']; ?></td>
                            <td><?= $d['judul']; ?></td>
                            <td><?= $d['nama_jurusan']; ?></td>
                            <td class="text-center">
                            <?php $aktif = $d['status'];
                            if ($aktif == 1) { ?>
                            <span class="badge badge-primary">Belum diproses</span>
                            <?php } elseif ($aktif == 2) { ?>
                            <span class="badge badge-success">Di Setujui</span>
                            <?php } else {?> 
                                <span class="badge badge-danger">Tidak Di Setujui</span> 
                            <?php } ?>
                             </td>      
                            <td>
                                
                            <div class="button ">
                            <a class="btn btn-primary btn-sm" href="<?= base_url('dosen/detaildata/') . $d['id']; ?>">Detail</a>
                            </div>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- 
    <script type="text/javascript">
        $(document).ready(function() {
            var nik = $('#nikDosen').val();
            var table = $('#usersData').DataTable({
                "searchable": false,
                "orderable": false,
                "targets": 0,
                "ajax": {
                    "type": 'GET',
                    "url": '<?= base_url(); ?>' + 'API/data/dataDosenBimbingan.php?name=' + nik,
                    "mimeType": 'json',
                },
                "columns": [{
                        "data": "nim"
                    },
                    {
                        "data": "nama"
                    },
                    {
                        "data": "judul"
                    },
                ],
                "columnDefs": [{
                        "targets": 0,
                        "className": "text-left",
                    },
                    {
                        "targets": 1,
                        "className": "text-left",
                    },
                    {
                        "targets": 2,
                        "className": "text-center",
                    },
                ]
            });
        });
    </script> -->