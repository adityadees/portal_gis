
<?php foreach($sanitasi->result_array() as $i) : ?>
  <div id="myModal<?= $i['air_bersih_id']; ?>sanitasi" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sanitasi</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-pills nav-fill nav-tabs">
            <li class="active"><a data-toggle="pill" href="#home<?= $i['air_bersih_id']; ?>sanitasi">Data Umum</a></li>
            <li><a data-toggle="pill" href="#menu1<?= $i['air_bersih_id']; ?>sanitasi">Historis Penanganan</a></li>
            <li><a data-toggle="pill" href="#menu3<?= $i['air_bersih_id']; ?>sanitasi">Target</a></li>
            <li><a data-toggle="pill" href="#menu2<?= $i['air_bersih_id']; ?>sanitasi">Dokumentasi</a></li>
          </ul>

          <div class="tab-content">
            <div id="home<?= $i['air_bersih_id']; ?>sanitasi" class="tab-pane fade in active">
             <table class="table table-striped">
              <tr>
                <th>ID</th>
                <td><?= $i['air_bersih_id']; ?></td>
              </tr>
              <tr>
                <th>Kabupaten Kota</th>
                <td><?= $i['kabupaten_kota'];?></td>
              </tr>
              <tr>
                <th>Kecamatan</th>
                <td><?= number_format($i['kecamatan']);?></td>
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
                <th>Text Kecamatan</th>
                <td><?= $i['text_kecamatan'];?></td>
              </tr>
              <tr>
                <th>Luas</th>
                <td><?= number_format($i['luas']);?></td>
              </tr>
              <tr>
                <th>Sanitasi</th>
                <td><?= $i['sanitasi'];?></td>
              </tr>
              <tr>
                <th>Air Bersih</th>
                <td><?= $i['air_bersih'];?></td>
              </tr>
              <tr>
                <th>KK MBR</th>
                <td><?= number_format($i['kk_mbr']);?></td>
              </tr>
              <tr>
                <th>KK nonMBR</th>
                <td><?= $i['kk_nonmbr'];?></td>
              </tr>
              <tr>
                <th>Perkebunan</th>
                <td><?= $i['perkebunan'];?></td>
              </tr>
            </table> 
          </div>
          <div id="menu1<?= $i['air_bersih_id']; ?>sanitasi" class="tab-pane fade">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Tahun</th>
                  <th>Nama Kegiatan</th>
                  <th>Volume Efektif</th>
                  <th>Volume Penanganan</th>
                  <th>Sumber Dana</th>
                  <th>Ket</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $kode=$i['air_bersih_id'];
                $ghistoris=$this->modelgeojson->get_data_historis_sanitasi($kode);
                $no=0;
                foreach ($ghistoris->result_array() as $j) :
                  $no++;
                  ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $j['historis_tahun']; ?></td>
                    <td><?= $j['historis_namakeg']; ?></td>
                    <td><?= $j['historis_vefektif']; ?></td>
                    <td><?= $j['historis_vpenanganan']; ?></td>
                    <td><?= number_format($j['historis_sdana']); ?></td>
                    <td><?= $j['historis_ket']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

          </div>
          
          <div id="menu3<?= $i['air_bersih_id']; ?>sanitasi" class="tab-pane fade">
           <table class="table table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Tahun</th>
                <th>Volume</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $kode=$i['air_bersih_id'];
              $gtarget=$this->modelgeojson->get_target($kode,'5');
              $no=0;
              foreach ($gtarget->result_array() as $j) :
                $no++;
                ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $j['target_tahun'];?></td>
                  <td><?= number_format($j['target_volume']); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        
        
        <div id="menu2<?= $i['air_bersih_id']; ?>sanitasi" class="tab-pane fade">
         <table class="table table-striped">
          <thead>
            <tr>
              <th>No.</th>
              <th>Dokumen</th>
                <th>Tanggal Dokumentasi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $kode=$i['air_bersih_id'];
            $gdokumen=$this->modelgeojson->get_dokumen_sanitasi($kode);
            $no=0;
            foreach ($gdokumen->result_array() as $j) :
              $no++;
              ?>
              <tr>
                <td><?= $no; ?></td>
                <td><a href="<?= base_url();?>uploads/dokumentasi_sanitasi_sumsel/<?= $j['file']; ?>" target="blank">
                  <img border="0"  src="<?= base_url();?>uploads/dokumentasi_sanitasi_sumsel/<?= $j['file']; ?>" width="200px" height="150px">
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


