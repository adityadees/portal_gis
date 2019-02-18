
<?php foreach($kawasan_kumuh->result_array() as $i) : ?>
  <div id="myModal<?= $i['kawasan_kumuh_id']; ?>kawasan_kumuh" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">KawaSan kumuh</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-pills nav-fill nav-tabs">
            <li class="active"><a data-toggle="pill" href="#home<?= $i['kawasan_kumuh_id']; ?>kawasan_kumuh">Data Umum</a></li>
            <li><a data-toggle="pill" href="#menu1<?= $i['kawasan_kumuh_id']; ?>kawasan_kumuh">Historis Penanganan</a></li>
            
            <li><a data-toggle="pill" href="#menu3<?= $i['kawasan_kumuh_id']; ?>kawasan_kumuh">Target</a></li>
            <li><a data-toggle="pill" href="#menu2<?= $i['kawasan_kumuh_id']; ?>kawasan_kumuh">Dokumentasi</a></li>
          </ul>

          <div class="tab-content">
            <div id="home<?= $i['kawasan_kumuh_id']; ?>kawasan_kumuh" class="tab-pane fade in active">
             <table class="table table-striped">
              <tr>
                <th>ID</th>
                <td><?= $i['kawasan_kumuh_id']; ?></td>
              </tr>
              <tr>
                <th>Tipology</th>
                <td><?= $i['tipology'];?></td>
              </tr>
              <tr>
                <th>Luas</th>
                <td><?= $i['luas'];?></td>
              </tr>
              <tr>
                <th>No Kawasan</th>
                <td><?= $i['no_kawasan'];?></td>
              </tr>
              <tr>
                <th>Nama Kawasan</th>
                <td><?= $i['nama_kawas'];?></td>
              </tr>
              <tr>
                <th>Kelurahan</th>
                <td><?= $i['kelurahan'];?></td>
              </tr>
              <tr>
                <th>Tambahan</th>
                <td><?= $i['tambahan'];?></td>
              </tr>
              <tr>
                <th>Kawasan ST</th>
                <td><?= $i['kawasan_st'];?></td>
              </tr>
              <tr>
                <th>Peruntukan</th>
                <td><?= $i['peruntukan'];?></td>
              </tr>
              <tr>
                <th>Wilayah Da</th>
                <td><?= $i['wilayah_da'];?></td>
              </tr>
              <tr>
                <th>Prioritas</th>
                <td><?= $i['prioritas'];?></td>
              </tr>
              <tr>
                <th>Tingkat Ke</th>
                <td><?= $i['tingkat_ke'];?></td>
              </tr>
              <tr>
                <th>Dampingan</th>
                <td><?= $i['dampingan'];?></td>
              </tr>
              <tr>
                <th>Kabupaten Kota</th>
                <td><?= $i['kab_kota'];?></td>
              </tr>
              <tr>
                <th>Object Id</th>
                <td><?= $i['objectid'];?></td>
              </tr>
              <tr>
                <th>Nama Kawasan</th>
                <td><?= $i['nama_kaw'];?></td>
              </tr>
              <tr>
                <th>Luas Kawasan</th>
                <td><?= $i['luas_kaw'];?></td>
              </tr>
              <tr>
                <th>Kecamatan</th>
                <td><?= $i['kecamatan'];?></td>
              </tr>
              <tr>
                <th>Shape Leng</th>
                <td><?= $i['shape_leng'];?></td>
              </tr>
              <tr>
                <th>Shape Area</th>
                <td><?= $i['shape_area'];?></td>
              </tr>
              <tr>
                <th>Luas</th>
                <td><?= $i['luas_ha'];?></td>
              </tr>
              <tr>
                <th>Kawasan Kumuh</th>
                <td><?= $i['kawasan_ku'];?></td>
              </tr>
            </table> 
          </div>
          <div id="menu1<?= $i['kawasan_kumuh_id']; ?>kawasan_kumuh" class="tab-pane fade">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Tahun</th>
                  <th>Nama Kegiatan</th>
                  <th>Volume Efektif</th>
                  <th>Volume Penanganan (m)</th>
                  <th>Sumber Dana</th>
                  <th>Ket</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $kode=$i['kawasan_kumuh_id'];
                $ghistoris=$this->modelgeojson->get_data_historis_kawasan_kumuh($kode);
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
          
          <div id="menu3<?= $i['kawasan_kumuh_id']; ?>kawasan_kumuh" class="tab-pane fade">
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
            $kode=$i['kawasan_kumuh_id'];
            $gtarget=$this->modelgeojson->get_target('target_kawasan_kumuh',$kode);
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
      
      
      <div id="menu2<?= $i['kawasan_kumuh_id']; ?>kawasan_kumuh" class="tab-pane fade">
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
            $kode=$i['kawasan_kumuh_id'];
            $gdokumen=$this->modelgeojson->get_dokumen_kawasan_kumuh($kode);
            $no=0;
            foreach ($gdokumen->result_array() as $j) :
              $no++;
              ?>
              <tr>
                <td><?= $no; ?></td>
                <td><?= $j['dokumentasi_nama']; ?></td>
                <td><a href="<?= base_url();?>uploads/dokumentasi_kawasan_kumuh/<?= $j['file']; ?>" target="blank">
                  <img border="0"  src="<?= base_url();?>uploads/dokumentasi_kawasan_kumuh/<?= $j['file']; ?>" width="200px" height="150px">
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




