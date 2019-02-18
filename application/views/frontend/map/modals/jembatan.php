
<?php foreach($jembatan->result_array() as $i) : ?>
  <div id="myModal<?= $i['jembatan_id']; ?>jembatan" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Jembatan</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-pills nav-fill nav-tabs">
            <li class="active"><a data-toggle="pill" href="#home<?= $i['jembatan_id']; ?>jembatan">Data Umum</a></li>
            <li><a data-toggle="pill" href="#menu1<?= $i['jembatan_id']; ?>jembatan">Historis Penanganan</a></li>
            <li><a data-toggle="pill" href="#menu3<?= $i['jembatan_id']; ?>jembatan">Target</a></li>
            <li><a data-toggle="pill" href="#menu2<?= $i['jembatan_id']; ?>jembatan">Dokumentasi</a></li>
          </ul>

          <div class="tab-content">
            <div id="home<?= $i['jembatan_id']; ?>jembatan" class="tab-pane fade in active">
             <table class="table table-striped">
              <tr>
                <th>ID</th>
                <td><?= $i['jembatan_id']; ?></td>
              </tr>
              <tr>
                <th>Longitude</th>
                <td><?= $i['field1'];?></td>
              </tr>
              <tr>
                <th>Latitude</th>
                <td><?= $i['field2'];?></td>
              </tr>
              <tr>
                <th>filed3</th>
                <td><?= $i['field3'];?></td>
              </tr>
              <tr>
                <th>filed4</th>
                <td><?= $i['field4'];?></td>
              </tr>
              <tr>
                <th>Lokasi</th>
                <td><?= $i['field5'];?></td>
              </tr>
              <tr>
                <th>filed6</th>
                <td><?= $i['field6'];?></td>
              </tr>
              <tr>
                <th>STA</th>
                <td><?= $i['field7'];?></td>
              </tr>
              <tr>
                <th>filed8</th>
                <td><?= $i['field8'];?></td>
              </tr>
              <tr>
                <th>filed9</th>
                <td><?= $i['field9'];?></td>
              </tr>
              <tr>
                <th>filed10</th>
                <td><?= $i['field10'];?></td>
              </tr>
              <tr>
                <th>filed11</th>
                <td><?= $i['field11'];?></td>
              </tr>
              <tr>
                <th>filed12</th>
                <td><?= $i['field12'];?></td>
              </tr>
              <tr>
                <th>filed13</th>
                <td><?= $i['field13'];?></td>
              </tr>
              <tr>
                <th>filed14</th>
                <td><?= $i['field14'];?></td>
              </tr>
              <tr>
                <th>filed15</th>
                <td><?= $i['field15'];?></td>
              </tr>
              <tr>
                <th>filed16</th>
                <td><?= $i['field16'];?></td>
              </tr>
              <tr>
                <th>filed17</th>
                <td><?= $i['field17'];?></td>
              </tr>
              <tr>
                <th>filed18</th>
                <td><?= $i['field18'];?></td>
              </tr>
            </table> 
          </div>
          
          
          
          <div id="menu1<?= $i['jembatan_id']; ?>jembatan" class="tab-pane fade">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Tahun</th>
                  <th>Nama Kegiatan</th>
                  <th>Volume Efektif (m)</th>
                  <th>Volume Penanganan (m)</th>
                  <th>Sumber Dana</th>
                  <th>Ket</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $kode=$i['jembatan_id'];
                $ghistoris=$this->modelgeojson->get_data_historis_jembatan($kode);
                $no=0;
                foreach ($ghistoris->result_array() as $j) :
                  $no++;
                  ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $j['historis_tahun']; ?></td>
                    <td><?= $j['historis_namakeg']; ?></td>
                    <td><?= $j['historis_vefektif']." m"; ?></td>
                    <td><?= $j['historis_vpenanganan']." m"; ?></td>
                    <td><?= $j['historis_sdana']; ?></td>
                    <td><?= $j['historis_ket']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

          </div>
          
          
          <div id="menu3<?= $i['jembatan_id']; ?>jembatan" class="tab-pane fade">
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
              $kode=$i['jembatan_id'];
              $gtarget=$this->modelgeojson->get_target('target_jembatan',$kode);
              $no=0;
              foreach ($gtarget->result_array() as $j) :
                $no++;
                ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $j['target_tahun'];?></td>
                  <td><?= $j['target_volume']." m"; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        
        
        
        <div id="menu2<?= $i['jembatan_id']; ?>jembatan" class="tab-pane fade">
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
              $kode=$i['jembatan_id'];
              $gdokumen=$this->modelgeojson->get_dokumen_jembatan($kode);
              $no=0;
              foreach ($gdokumen->result_array() as $j) :
                $no++;
                ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $j['dokumentasi_nama']; ?></td>
                  <td><a href="<?= base_url();?>uploads/dokumentasi_jembatan/<?= $j['file']; ?>" target="blank">
                    <img border="0"  src="<?= base_url();?>uploads/dokumentasi_jembatan/<?= $j['file']; ?>" width="200px" height="150px">
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





