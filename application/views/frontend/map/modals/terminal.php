
<?php foreach($terminal->result_array() as $i) : ?>
  <div id="myModal<?= $i['terminal_id']; ?>terminal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Terminal</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-pills nav-fill nav-tabs">
            <li class="active"><a data-toggle="pill" href="#home<?= $i['terminal_id']; ?>terminal">Data Umum</a></li>
            <li><a data-toggle="pill" href="#menu1<?= $i['terminal_id']; ?>terminal">Historis Penanganan</a></li>
            <li><a data-toggle="pill" href="#menu3<?= $i['terminal_id']; ?>terminal">Target</a></li>
            <li><a data-toggle="pill" href="#menu2<?= $i['terminal_id']; ?>terminal">Dokumentasi</a></li>
          </ul>

          <div class="tab-content">
            <div id="home<?= $i['terminal_id']; ?>terminal" class="tab-pane fade in active">
             <table class="table table-striped">
              <tr>
                <th>ID</th>
                <td><?= $i['terminal_id']; ?></td>
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
                <td><?= $i['terminal_dtampung']." Jiwa";?></td>
              </tr>
              <tr>
                <th>Tipe</th>
                <td><?= $i['tipe'];?></td>
              </tr>
            </table> 
          </div>
          <div id="menu1<?= $i['terminal_id']; ?>terminal" class="tab-pane fade">
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
                $kode=$i['terminal_id'];
                $ghistoris=$this->modelgeojson->get_data_historis_terminal($kode);
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
          
          <div id="menu3<?= $i['terminal_id']; ?>terminal" class="tab-pane fade">
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
              $kode=$i['terminal_id'];
              $gtarget=$this->modelgeojson->get_target('target_terminal',$kode);
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
        
        
        <div id="menu2<?= $i['terminal_id']; ?>$terminal" class="tab-pane fade">
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
              $kode=$i['terminal_id'];
              $gdokumen=$this->modelgeojson->get_dokumen_terminal($kode);
              $no=0;
              foreach ($gdokumen->result_array() as $j) :
                $no++;
                ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $j['dokumentasi_nama']; ?></td>
                  <td><a href="<?= base_url();?>uploads/dokumentasi_terminal/<?= $j['file']; ?>" target="blank">
                    <img border="0"  src="<?= base_url();?>uploads/dokumentasi_terminal/<?= $j['file']; ?>" width="200px" height="150px">
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


