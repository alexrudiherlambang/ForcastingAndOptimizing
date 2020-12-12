<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-6 main-header">
          <h2>Forecast<span>Data Peramalan</span></h2>
          <h6 class="mb-0">PT Jasentra</h6>
        </div>
        <div class="col-lg-6 breadcrumb-right">     
          <ol class="breadcrumb">
           <?php $this->load->view("partials/main/breadcrumb") ?>
         </ol>
       </div>
     </div>
   </div>
 </div>
 <!-- Container-fluid starts-->
 <div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <div  class="row">
            <a type="button" class="btn btn-pill btn-success" href="#" data-toggle="modal" data-target="#verifikasi_hitung"> Hitung Peramalan</a>
            <a type="button" class="btn btn-pill btn-danger" href="#" data-toggle="modal" data-target="#delete_all"> Hapus Semua Data</a>
          </div>
        </div>
        <div class="card-body">
          <div class="dt-ext table-responsive">
            <table class="display" id="export-button">
              <thead>
                <tr>
                  <th>No.</th>
                  <!-- <th>ID Peramalan</th> -->
                  <th>Tahun</th>
                  <th>Kuartal</th>
                  <th>Trend</th>
                  <th>Indeks Musiman</th>
                  <th>Hasil Peramalan</th>
                  <th>MSE</th>
                  <th>MAPE (%)</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                foreach ($p as $key) : ?>

                  <tr>
                    <td><?php echo $no++?></td>
                    <!-- <td><?php echo $key->id_peramalan ?>;</td> -->
                    <td><?php echo $key->tahun ?></td>
                    <td><?php echo $key->kuartal ?></td>
                    <td><?php echo $key->hasil_trend ?></td>
                    <td><?php echo $key->hasil_indeks_musiman ?></td>
                    <td><?php echo $key->hasil_peramalan ?></td>
                    <td><?php echo $key->nilai_MSE ?></td>
                    <td><?php echo $key->nilai_MAPE ?></td>
                    <td>
                      <div class="form-group">
                        <a href="#" data-feather="edit" data-toggle="modal" data-target=".bs-example-modal-lga<?php echo $key->id_peramalan ?>">Edit</a>

                        <a id="id_peramalan_hapus" name="id_peramalan_hapus" href="#" data-toggle="modal" data-target="#delete<?php echo $key->id_peramalan ?>" data-feather="trash-2">Hapus</a>
                      </div>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
              <tfoot>
                <tr>
                 <th>No.</th>
                 <!-- <th>ID Peramalan</th> -->
                 <th>Tahun</th>
                 <th>Kuartal</th>
                 <th>Trend</th>
                 <th>Indeks Musiman</th>
                 <th>Hasil Peramalan</th>
                 <th>MSE</th>
                 <th>MAPE (%)</th>
                 <th>Action</th>
               </tr>
             </tfoot>
           </table>
         </div>
       </div>
     </div>
   </div>
 </div>


 <?php foreach ($p as $key) : ?>
  <div class="modal fade" id="delete<?php echo $key->id_peramalan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Data?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">INGAT !!! Data yang sudah terhapus tidak dapat di kembalikan lagi.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php echo base_url("admin/peramalan/hapus/$key->id_peramalan") ?>">Hapus</a>
        </div>
      </div>
    </div>
  </div>
<?php endforeach ?>
<!-- modal hapus semua data -->
<div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Data?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Apakah anda yakin untuk menghapus semua data peramalan???</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <a class="btn btn-primary" href="<?php echo base_url("admin/peramalan/hapus_semua") ?>">Hapus</a>
      </div>
    </div>
  </div>
</div>
<!-- modal pastikan data peramalan sudah kosong -->
<div class="modal fade" id="verifikasi_hitung" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hitung Peramalan??</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Pastikan data peramalan harus terhapus semuanya!!!</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <a class="btn btn-primary" href="<?php echo base_url("admin/Peramalan/perhitungan_peramalan") ?>">Hitung</a>
      </div>
    </div>
  </div>
</div>