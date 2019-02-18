
<?php foreach($air_bersih->result_array() as $i) : ?>
  <div id="myModal<?= $i['air_bersih_id']; ?>air_bersih" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Air Bersih</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-pills nav-fill nav-tabs">
            <li class="active"><a data-toggle="pill" href="#home<?= $i['air_bersih_id']; ?>air_bersih">Data Umum</a></li>
            <li><a data-toggle="pill" href="#menu1<?= $i['air_bersih_id']; ?>air_bersih">Historis Penanganan</a></li>
            
            <li><a data-toggle="pill" href="#menu3<?= $i['air_bersih_id']; ?>air_bersih">Target</a></li>
            <li><a data-toggle="pill" href="#menu2<?= $i['air_bersih_id']; ?>air_bersih">Dokumentasi</a></li>
          </ul>

          <div class="tab-content">
            <div id="home<?= $i['air_bersih_id']; ?>air_bersih" class="tab-pane fade in active">
             <table class="table table-striped">
              <tr>
                <th>ID</th>
                <td><?= $i['air_bersih_id']; ?></td>
              </tr>
              <tr>
                <th>Kabupaten / Kota</th>
                <td><?= $i['kabupaten_kota'];?></td>
              </tr>
              <tr>
                <th>Kecamatan</th>
                <td><?= $i['kecamatan'];?></td>
              </tr>
              <tr>
                <th>Kode Wilayah</th>
                <td><?= $i['kode_wilayah'];?></td>
              </tr>
              <tr>
                <th>Kode Kecamatan</th>
                <td><?= $i['kode_kecamatan'];?></td>
              </tr>
              <tr>
                <th>Luas</th>
                <td><?= $i['luas']." ha";?></td>
              </tr>
              <tr>
                <th>Persentase Penyaluran</th>
                <td><?= $i['air_bers_1']." %";?></td>
              </tr>
            </table> 
          </div>
          <div id="menu1<?= $i['air_bersih_id']; ?>air_bersih" class="tab-pane fade">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Tahun</th>
                  <th>Nama Kegiatan</th>
                  <th>Volume Penanganan (km)</th>
                  <th>Sumber Dana</th>
                  <th>Ket</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $kode=$i['air_bersih_id'];
                $ghistoris=$this->modelgeojson->get_data_historis_air_bersih($kode);
                $no=0;
                foreach ($ghistoris->result_array() as $j) :
                  $no++;
                  ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $j['historis_tahun']; ?></td>
                    <td><?= $j['historis_namakeg']; ?></td>
                    <td><?= $j['historis_vpenanganan']. " km"; ?></td>
                    <td><?= $j['historis_sdana']; ?></td>
                    <td><?= $j['historis_ket']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

          </div>
          
          <div id="menu3<?= $i['air_bersih_id']; ?>air_bersih" class="tab-pane fade">
           <table class="table table-striped">
            <thead>
              <tr>
             <th class="col-md-1">No.</th>
                <th class="col-md-5">Tahun</th>
                <th  class="col-md-6">Volume (m)</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $kode=$i['air_bersih_id'];
              $gtarget=$this->modelgeojson->get_target('target_air_bersih',$kode);
              $no=0;
              foreach ($gtarget->result_array() as $j) :
                $no++;
                ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $j['target_tahun'];?></td>
                  <td><?= $j['target_volume']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        
        
        <div id="menu2<?= $i['air_bersih_id']; ?>air_bersih" class="tab-pane fade">
          <table class="table table-striped">
            <thead>
              <tr>
                    <th class="col-md-1">No.</th>
                <th class="col-md-4">Keterangan</th>
                <th class="col-md-4">File</th>
                <th class="col-md-3">Tanggal</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $kode=$i['air_bersih_id'];
              $gdokumen=$this->modelgeojson->get_dokumen_air_bersih($kode);
              $no=0;
              foreach ($gdokumen->result_array() as $j) :
                $no++;
                ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $j['dokumentasi_nama']; ?></td>
                  <td><a href="<?= base_url();?>uploads/dokumentasi_air_bersih/<?= $j['file']; ?>" target="blank">
                    <img border="0"  src="<?= base_url();?>uploads/dokumentasi_air_bersih/<?= $j['file']; ?>" width="200px" height="150px">
                  </a></td>
                  <td><?= $j['dokumen_tanggal']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>

</div>
</div>


<?php endforeach; ?>




