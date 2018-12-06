

<?php foreach($jalan_nasional->result_array() as $i) : ?>
  <div id="myModal<?= $i['jalan_id']; ?>jalan_nasional" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ruas Jalan</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-pills nav-fill nav-tabs">
            <li class="active"><a data-toggle="pill" href="#home<?= $i['jalan_id']; ?>jalan_nasional">Data Umum</a></li>
            <li><a data-toggle="pill" href="#menu1<?= $i['jalan_id']; ?>jalan_nasional">Historis Penanganan</a></li>
            <li><a data-toggle="pill" href="#menu3<?= $i['jalan_id']; ?>jalan_nasional">Target</a></li>
            <li><a data-toggle="pill" href="#menu2<?= $i['jalan_id']; ?>jalan_nasional">Dokumentasi</a></li>
          </ul>

          <div class="tab-content">
            <div id="home<?= $i['jalan_id']; ?>jalan_nasional" class="tab-pane fade in active">
             <table class="table table-striped">
              <tr>
                <th>ID</th>
                <td><?= $i['jalan_id']; ?></td>
              </tr>
              <tr>
                <th>Status</th>
                <td><?= $i['jalan_status'];?></td>
              </tr>
              <tr>
                <th>Fungsi</th>
                <td><?= $i['jalan_fungsi'];?></td>
              </tr>
              <tr>
                <th>Sumber</th>
                <td><?= $i['jalan_sumber'];?></td>
              </tr>
              <tr>
                <th>No. Ruas</th>
                <td><?= $i['jalan_no_ruas'];?></td>
              </tr>
              <tr>
                <th>Nama Ruas</th>
                <td><?= $i['jalan_nama_ruas'];?></td>
              </tr>
              <tr>
                <th>Panjang</th>
                <td><?= number_format($i['jalan_panjang']);?></td>
              </tr>
              <tr>
                <th>Layer</th>
                <td><?= $i['jalan_layer'];?></td>
              </tr>
            </table> 
          </div>
          <div id="menu1<?= $i['jalan_id']; ?>jalan_nasional" class="tab-pane fade">
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
                $kode=$i['jalan_id'];
                $ghistoris=$this->modelgeojson->get_data_historis_jalan_nasional($kode);
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
          
          
          <div id="menu3<?= $i['jalan_id']; ?>jalan_nasional" class="tab-pane fade">
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
              $kode=$i['jalan_id'];
              $gtarget=$this->modelgeojson->get_target($kode,'1');
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
        
        <div id="menu2<?= $i['jalan_id']; ?>jalan_nasional" class="tab-pane fade">
          
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
              $kode=$i['jalan_id'];
              $gdokumen=$this->modelgeojson->get_dokumen_jalan_nasional($kode);
              $no=0;
              foreach ($gdokumen->result_array() as $j) :
                $no++;
                ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><a href="<?= base_url();?>uploads/dokumentasi_jalan_nasional/<?= $j['file']; ?>" target="blank">
                    <img border="0"  src="<?= base_url();?>uploads/dokumentasi_jalan_nasional/<?= $j['file']; ?>" width="200px" height="150px">
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



