<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Data Produksi Jamur Tiram PT Jasentra</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url("pegawai/produksi/tambah") ?>" method="post" class="form-horizontal form-label-left">
          <div class="form-group">
            <label class="col-form-label">ID Produksi</label>
            <input type="text" class="form-control" id="id_produksi_isi" name="id_produksi_isi" value="<?php echo $kode ?>" readonly="readonly" required="required">
          </div>
          <div class="form-group">
            <label class="col-form-label">Tanggal <span class="required">*</span></label>
            <input type="text" class="form-control" id="tanggal_isi" name="tanggal_isi" value="<?php echo date("Y-m-d"); ?>" readonly="readonly" required="required">
            
          </div>
          <div class="form-group">
            <label class="col-form-label">Suhu Baglog <span class="required">*</span></label>
            <input type="text" class="form-control" id="suhu_baglog_isi" name="suhu_baglog_isi" placeholder="Suhu Baglog" required="required">
          </div>
          <div class="form-group">
            <label class="col-form-label">Suhu Kumbung <span class="required">*</span></label>
            <input type="text" class="form-control" id="suhu_kumbung_isi" name="suhu_kumbung_isi" placeholder="Suhu Kumbung" required="required">
          </div>
          <div class="form-group">
            <label class="col-form-label">Kelembapan <span class="required">*</span></label>
            <input type="text" class="form-control" id="kelembapan_isi" name="kelembapan_isi" placeholder="Kelembapan" required="required">
          </div>
          <div class="form-group">
            <label class="col-form-label">Jumlah Produksi <span class="required">*</span></label>
            <input type="text" class="form-control" id="jumlah_produksi_isi" name="jumlah_produksi_isi" placeholder="Jumlah Produksi" required="required">
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" style="float: right; margin-left: 5px;" id="submit" class="btn btn-success">Submit</button>
            <button type="reset" style="float: right;" class="btn btn-primary">Reset</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-6 main-header">
          <h2>Produksi<span>Data Produksi</span></h2>
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
        <div class="card-body">
          <div class="dt-ext table-responsive">
            <table class="display" id="export-button">
              <div class="card-body btn-showcase">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg"> + Tambah Data</button>
              </div>
              <thead>
                <tr>
                  <th>No.</th>
                  <!-- <th>Id Produksi</th> -->
                  <th>Tanggal</th>
                  <th>Suhu Baglog (°C)</th>
                  <th>Suhu Kumbung (°C)</th>
                  <th>Kelembapan (%)</th>
                  <th>Jumlah Produksi</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                foreach ($produksi as $key) : ?>

                  <tr>
                    <td><?php echo $no++?></td>
                    <td><?php echo $key->tanggal ?></td>
                    <td><?php echo $key->suhu_baglog ?></td>
                    <td><?php echo $key->suhu_kumbung ?></td>
                    <td><?php echo $key->kelembapan ?></td>
                    <td><?php echo $key->jumlah_produksi ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
              <tfoot>
                <tr>
                 <th>No.</th>
                 <!-- <th>Id Produksi</th> -->
                 <th>Tanggal</th>
                 <th>Suhu Baglog (°C)</th>
                 <th>Suhu Kumbung (°C)</th>
                 <th>Kelembapan (%)</th>
                 <th>Jumlah Produksi</th>  
               </tr>
             </tfoot>
           </table>
         </div>
       </div>
     </div>
   </div>
 </div>