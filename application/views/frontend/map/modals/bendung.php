

<?php foreach($bendung->result_array() as $i) : ?>
  <div id="myModal<?= $i['bendungan_id']; ?>bendung" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Bendungan</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-pills nav-fill nav-tabs">
            <li class="active"><a data-toggle="pill" href="#home<?= $i['bendungan_id']; ?>bendung">Data Umum</a></li>
            <li><a data-toggle="pill" href="#menu1<?= $i['bendungan_id']; ?>bendung">Historis Penanganan</a></li>
            <li><a data-toggle="pill" href="#menu3<?= $i['bendungan_id']; ?>bendung">Target</a></li>
            <li><a data-toggle="pill" href="#menu2<?= $i['bendungan_id']; ?>bendung">Dokumentasi</a></li>
          </ul>

          <div class="tab-content">
            <div id="home<?= $i['bendungan_id']; ?>bendung" class="tab-pane fade in active">
             <table class="table table-striped">
              <tr>
                <th>ID</th>
                <td><?= $i['bendungan_id']; ?></td>
              </tr>
              <tr>
                <th>Status</th>
                <td><?= $i['nama'];?></td>
              </tr>
              
            </table> 
          </div>
          <div id="menu1<?= $i['bendungan_id']; ?>bendung" class="tab-pane fade">
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
                $kode=$i['bendungan_id'];
                $ghistoris=$this->modelgeojson->get_data_historis_bendung($kode);
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
                    <td><?= $j['historis_sdana']; ?></td>
                    <td><?= $j['historis_ket']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

          </div>
          
          
          
          <div id="menu3<?= $i['bendungan_id']; ?>bendung" class="tab-pane fade">
           <table class="table table-striped">
            <thead>
              <tr>
                 <th class="col-md-1">No.</th>
                <th class="col-md-5">Tahun</th>
                <th  class="col-md-6">Volume</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $kode=$i['bendungan_id'];
              $gtarget=$this->modelgeojson->get_target('target_bendungan',$kode);
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
        
        
        <div id="menu2<?= $i['bendungan_id']; ?>bendung" class="tab-pane fade">
         <table class="table table-striped">
          <thead>
            <tr>
                  <th class="col-md-1">No.</th>
                <th class="col-md-4">Nama</th>
                <th class="col-md-4">Dokumentasi</th>
                <th class="col-md-3">Tanggal</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $kode=$i['bendungan_id'];
            $gdokumen=$this->modelgeojson->get_dokumen_bendung($kode);
            $no=0;
            foreach ($gdokumen->result_array() as $j) :
              $no++;
              ?>
              <tr>
                <td><?= $no; ?></td>
                  <td><?= $j['dokumentasi_nama']; ?></td>
                <td><a href="<?= base_url();?>uploads/dokumentasi_bendungan/<?= $j['file']; ?>" target="blank">
                  <img border="0"  src="<?= base_url();?>uploads/dokumentasi_bendungan/<?= $j['file']; ?>" width="200px" height="150px">
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



