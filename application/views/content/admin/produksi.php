<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Data Produksi Jamur Tiram PT Jasentra</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url("admin/produksi/tambah") ?>" method="post" class="form-horizontal form-label-left">
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
            <button type="submit" style="float: right; margin-left: 5px;" id="submit_edit" class="btn btn-success">Submit</button>
            <button type="reset" style="float: right;" class="btn btn-primary">Reset</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php foreach ($produksi as $key) : ?>
  <div class="modal fade bs-example-modal-lga<?php echo $key->id_produksi ?> " tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Edit Data Produksi</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url("admin/produksi/edit") ?>" method="post" class="form-horizontal form-label-left">
            <div class="form-group">
              <label class="col-form-label">ID Produksi</label>
              <input type="text" class="form-control" id="id_produksi" name="id_produksi" value="<?php echo $key->id_produksi ?>" readonly="readonly" required="required">
            </div>
            <div class="form-group">
              <label class="col-form-label">Tanggal <span class="required">*</span></label>
              <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $key->tanggal ?>" readonly="readonly" required="required">
            </div>
            <div class="form-group">
              <label class="col-form-label">Suhu Baglog <span class="required">*</span></label>
              <input type="text" class="form-control" id="suhu_baglog" name="suhu_baglog" value="<?php echo $key->suhu_baglog ?>" placeholder="Suhu Baglog" required="required">
            </div>
            <div class="form-group">
              <label class="col-form-label">Suhu Kumbung <span class="required">*</span></label>
              <input type="text" class="form-control" id="suhu_kumbung" name="suhu_kumbung" value="<?php echo $key->suhu_kumbung ?>" placeholder="Suhu Kumbung" required="required">
            </div>
            <div class="form-group">
              <label class="col-form-label">Kelembapan <span class="required">*</span></label>
              <input type="text" class="form-control" id="kelembapan" name="kelembapan" value="<?php echo $key->kelembapan ?>" placeholder="Kelembapan" required="required">
            </div>
            <div class="form-group">
              <label class="col-form-label">Jumlah Produksi <span class="required">*</span></label>
              <input type="text" class="form-control" id="jumlah_produksi" name="jumlah_produksi" value="<?php echo $key->jumlah_produksi ?>" placeholder="Jumlah Produksi" required="required">
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" style="float: right; margin-left: 5px;" id="submit_edit" class="btn btn-success">Submit</button>
              <button type="reset" style="float: right;" class="btn btn-primary">Reset</button>
            </div>
          </div>
        </form>
      </div>


    </div>
  </div>
<?php endforeach ?>

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
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                foreach ($produksi as $key) : ?>

                  <tr>
                    <td><?php echo $no++?></td>
                    <!-- <td><?php echo $key->id_produksi ?></td> -->
                    <td><?php echo $key->tanggal ?></td>
                    <td><?php echo $key->suhu_baglog ?></td>
                    <td><?php echo $key->suhu_kumbung ?></td>
                    <td><?php echo $key->kelembapan ?></td>
                    <td><?php echo $key->jumlah_produksi ?></td>
                    <td>
                      <div class="form-group">
                        <a href="#" data-feather="edit" data-toggle="modal" data-target=".bs-example-modal-lga<?php echo $key->id_produksi ?>">Edit</a>

                        <a id="id_produksi_hapus" name="id_produksi_hapus" href="#" data-toggle="modal" data-target="#delete<?php echo $key->id_produksi ?>" data-feather="trash-2">Hapus</a>
                      </div>
                    </td>
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
                 <th>Action</th>
               </tr>
             </tfoot>
           </table>
         </div>
       </div>
     </div>
   </div>
 </div>


 <script type="text/javascript">
  $(document).ready(function() {
      // alert("1");
      $("#username_isi").on("input", function(){
        var username = $("#username_isi").val();
        $.ajax({
          url: "<?php echo base_url("admin/DataUser/check") ?>",
          type: "POST",
          dataType: "JSON",
          data: {
            username: username
          },
          cache: false,
          success: function(msg) {
            if (msg.message == "True") {
              pesan.innerHTML = "Username telah dipakai";
              pesan.style.color = "#ff6666";
              submit.disabled = "true"
            } else if (msg.message == "False") {
              pesan.innerHTML = "Username bisa dipakai";
              pesan.style.color = "#66cc66";
              submit.disabled = ""

            }
          }
        });
      })

    });

  </script>
  <?php foreach ($produksi as $key) : ?>
    <div class="modal fade" id="delete<?php echo $key->id_produksi ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <a class="btn btn-primary" href="<?php echo base_url("admin/produksi/hapus/$key->id_produksi") ?>">Hapus</a>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach ?>