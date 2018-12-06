
<?php foreach($pelabuhan->result_array() as $i) : ?>
  <div id="myModal<?= $i['pelabuhan_id']; ?>pelabuhan" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Pelabuhan</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-pills nav-fill nav-tabs">
            <li class="active"><a data-toggle="pill" href="#home<?= $i['pelabuhan_id']; ?>pelabuhan">Data Umum</a></li>
            <li><a data-toggle="pill" href="#menu1<?= $i['pelabuhan_id']; ?>pelabuhan">Historis Penanganan</a></li>
            <li><a data-toggle="pill" href="#menu3<?= $i['pelabuhan_id']; ?>pelabuhan">Target</a></li>
            <li><a data-toggle="pill" href="#menu2<?= $i['pelabuhan_id']; ?>pelabuhan">Dokumentasi</a></li>
          </ul>

          <div class="tab-content">
            <div id="home<?= $i['pelabuhan_id']; ?>pelabuhan" class="tab-pane fade in active">
             <table class="table table-striped">
              <tr>
                <th>ID</th>
                <td><?= $i['pelabuhan_id']; ?></td>
              </tr>
              <tr>
                <th>Nama Terminal</th>
                <td><?= $i['nama_termi'];?></td>
              </tr>
              <tr>
                <th>Klasifikasi</th>
                <td><?= $i['klasifikasi'];?></td>
              </tr>
              <tr>
                <th>Daya Tampung</th>
                <td><?= $i['pelabuhan_dtampung'];?></td>
              </tr>
            </table> 
          </div>
          <div id="menu1<?= $i['pelabuhan_id']; ?>pelabuhan" class="tab-pane fade">
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
                $kode=$i['pelabuhan_id'];
                $ghistoris=$this->modelgeojson->get_data_historis_pelabuhan($kode);
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
          
          <div id="menu3<?= $i['pelabuhan_id']; ?>pelabuhan" class="tab-pane fade">
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
              $kode=$i['pelabuhan_id'];
              $gtarget=$this->modelgeojson->get_target($kode,'13');
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
        
        
        <div id="menu2<?= $i['pelabuhan_id']; ?>$pelabuhan" class="tab-pane fade">
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
              $kode=$i['pelabuhan_id'];
              $gdokumen=$this->modelgeojson->get_dokumen_pelabuhan($kode);
              $no=0;
              foreach ($gdokumen->result_array() as $j) :
                $no++;
                ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><a href="<?= base_url();?>uploads/dokumentasi_pelabuhan/<?= $j['file']; ?>" target="blank">
                    <img border="0"  src="<?= base_url();?>uploads/dokumentasi_pelabuhan/<?= $j['file']; ?>" width="200px" height="150px">
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


