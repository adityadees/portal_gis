
<?php foreach($air_bersih->result_array() as $i) : ?>
  <div id="myModal<?= $i['air_bersih_id']; ?>kebencanaan" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kebencanaan</h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-pills nav-fill nav-tabs">
            <li class="active"><a data-toggle="pill" href="#home<?= $i['air_bersih_id']; ?>kebencanaan">Tanah Longsor</a></li>
            <li><a data-toggle="pill" href="#menu1<?= $i['air_bersih_id']; ?>kebencanaan">Banjir</a></li>
            <li><a data-toggle="pill" href="#menu2<?= $i['air_bersih_id']; ?>kebencanaan">Kebakaran Hutan</a></li>
          </ul>

          <div class="tab-content">
            <div id="home<?= $i['air_bersih_id']; ?>kebencanaan" class="tab-pane fade in active">
             <table class="table table-striped">
                 <thead>
              <tr>
                  <th>No</th>
                  <th>Kecamatan</th>
                  <th>Desa / Kelurahan</th>
                  <th>Tahun</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            $where = [
                'kode' => $i['air_bersih_id'],
                ];
            $cc = $this->modelgeojson->get_where('tanah_longsor',$where)->result_array();
            $no=0;
            foreach($cc as $bb) : 
                $no++;
            ?>
            <tr>
                      <td><?= $no; ?></td>
                  <td><?= $bb['longsor_kecamatan']; ?></td>
                  <td><?= $bb['kelurahan']; ?></td>
                  <td><?= $bb['tahun']; ?></td>
            </tr>
            </tbody>
            <?php endforeach; ?>
            </table> 
          </div>
          <div id="menu1<?= $i['air_bersih_id']; ?>kebencanaan" class="tab-pane fade">
            <table class="table table-striped table-hovered">
              <thead>
                 <tr>
                  <th>No</th>
                  <th>Kecamatan</th>
                  <th>Desa / Kelurahan</th>
                  <th>Tahun</th>
            </tr>
            
            
              </thead>
              <tbody>
             <?php 
            $where = [
                'banjir_kode' => $i['air_bersih_id'],
                ];
            $cc = $this->modelgeojson->get_where('banjir',$where)->result_array();
            $no=0;
            foreach($cc as $bb) : 
                $no++;
            ?>
            <tr>
                      <td><?= $no; ?></td>
                  <td><?= $bb['banjir_kecamatan']; ?></td>
                  <td><?= $bb['desa']; ?></td>
                  <td><?= $bb['tahun']; ?></td>
            </tr>
<?php endforeach; ?>
              </tbody>
            </table>

          </div>
        
        
        <div id="menu2<?= $i['air_bersih_id']; ?>kebencanaan" class="tab-pane fade">
          <table class="table table-bordered">
              
            <thead>
         		<tr class="text-center">
			<td rowspan="2">Nomor</td>
			<td colspan="2">Kecamatan</td>
			<td colspan="2">Desa</td>
			<td rowspan="2">Jumlah</td>
		</tr>
		<tr class="text-center">
			<td>Rawan</td>
			<td>Sangat Rawan</td>
			<td>Rawan</td>
			<td>Sangat Rawan</td>
		</tr>
            </thead>
         
         <tbody>
             <?php 
            $where = [
                'kebakaran_kode' => $i['air_bersih_id'],
                ];
            $cc = $this->modelgeojson->get_where('kebakaran_hutan',$where)->result_array();
            $no=0;
            foreach($cc as $bb) : 
                $no++;
            ?>
            <tr>
                      <td><?= $no; ?></td>
                  <td><?= $bb['kecamatan_rawan']; ?></td>
                  <td><?= $bb['kecamatan_sangat_rawan']; ?></td>
                  <td><?= $bb['desa_rawan']; ?></td>
                  <td><?= $bb['desa_sangat_rawan']; ?></td>
                  <td><?= $bb['kecamatan_rawan']+$bb['kecamatan_sangat_rawan']+$bb['desa_rawan']+$bb['desa_sangat_rawan']; ?></td>
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






