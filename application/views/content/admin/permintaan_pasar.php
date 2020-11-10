<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Data Permintaan Pasar</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url("admin/PermintaanPasar/tambah") ?>" method="post" class="form-horizontal form-label-left">
          <div class="form-group">
            <label class="col-form-label">ID Permintaan Pasar</label>
            <input type="text" class="form-control" id="id_permintaan_pasar_isi" name="id_permintaan_pasar_isi" value="<?php echo $kode ?>" readonly="readonly" required="required">
          </div>
          <div class="form-group">
            <label class="col-form-label">Nama Daerah <span class="required">*</span></label>
            <select class="form-control" id="nama_daerah_isi" name="nama_daerah_isi" required="required">
              <option>--Pilih--</option>
              <option>Jember</option>
              <option>Bondowoso</option>
              <option>Situbondo</option>
              <option>Banyuwangi</option>
              <option>Lumajang</option>
              <option>Probolinggo</option>
            </select>
          </div>
          <div class="form-group">
            <label class="col-form-label">Jumlah Permintaan <span class="required">*</span></label>
            <input type="text" class="form-control" id="jumlah_isi" name="jumlah_isi" placeholder="Jumlah Permintaan" required="required">
          </div>
          <div class="form-group">
            <label class="col-form-label">Harga<span class="required">*</span></label>
            <input type="text" class="form-control" id="harga_isi" name="harga_isi" placeholder="Rp.xxx.xxx,-" required="required">
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

<?php foreach ($PermintaanPasar as $key) : ?>
  <div class="modal fade bs-example-modal-lga<?php echo $key->id_permintaan_pasar ?> " tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Edit Data Permintaan Pasar</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url("admin/PermintaanPasar/edit") ?>" method="post" class="form-horizontal form-label-left">
            <div class="form-group">
              <label class="col-form-label">ID Permintaan Pasar</label>
              <input type="text" class="form-control" id="id_permintaan_pasar" name="id_permintaan_pasar" value="<?php echo $key->id_permintaan_pasar ?>" readonly="readonly" required="required">
            </div>
            <div class="form-group">
              <label class="col-form-label">Nama Daerah <span class="required">*</span></label>
              <select class="form-control" id="nama_daerah" name="nama_daerah" required="required">
                <option>--Pilih--</option>
                <option <?php if ($key->nama_daerah == "Jember") { ?> selected="selected" <?php } ?>>Jember</option>
                <option <?php if ($key->nama_daerah == "Bondowoso") { ?> selected="selected" <?php } ?>>Bondowoso</option>
                <option <?php if ($key->nama_daerah == "Banyuwangi") { ?> selected="selected" <?php } ?>>Banyuwangi</option>
                <option <?php if ($key->nama_daerah == "Situbondo") { ?> selected="selected" <?php } ?>>Situbondo</option>
                <option <?php if ($key->nama_daerah == "Lumajang") { ?> selected="selected" <?php } ?>>Lumajang</option>
                <option <?php if ($key->nama_daerah == "Probolinggo") { ?> selected="selected" <?php } ?>>Probolinggo</option>
              </select>
            </div>
            <div class="form-group">
              <label class="col-form-label">Jumlah Permintaan <span class="required">*</span></label>
              <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Permintaan" required="required" value="<?php echo $key->jumlah ?>">
            </div>
            <div class="form-group">
              <label class="col-form-label">Harga<span class="required">*</span></label>
              <input type="text" class="form-control" id="harga" name="harga" placeholder="Rp.xxx.xxx,-" required="required" value="<?php echo $key->harga ?>">
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
          <h2>Pasar<span>Data Permintaan Pasar</span></h2>
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
              <div>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg"> + Tambah Data</button>
              </div>
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Daerah Pemesan</th>
                  <th>Jumlah Permintaan (Kg)</th>
                  <th>Harga (Rp.)</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                foreach ($PermintaanPasar as $key) : ?>

                  <tr>
                    <td><?php echo $no++?></td>
                    <!-- <td><?php echo $key->id_permintaan_pasar ?></td> -->
                    <td><?php echo $key->nama_daerah ?></td>
                    <td><?php echo $key->jumlah ?></td>
                    <td><?php echo $key->harga ?></td>
                    <td>
                      <div class="form-group">
                        <a href="#" data-feather="edit" data-toggle="modal" data-target=".bs-example-modal-lga<?php echo $key->id_permintaan_pasar ?>">Edit</a>

                        <a id="id_permintaan_pasar_hapus" name="id_permintaan_pasar_hapus" href="#" data-toggle="modal" data-target="#delete<?php echo $key->id_permintaan_pasar ?>" data-feather="trash-2">Hapus</a>
                      </div>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Nama Daerah Pemesan</th>
                  <th>Jumlah Permintaan (Kg)</th>
                  <th>Harga (Rp.)</th>
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
  <?php foreach ($PermintaanPasar as $key) : ?>
    <div class="modal fade" id="delete<?php echo $key->id_permintaan_pasar ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <a class="btn btn-primary" href="<?php echo base_url("admin/PermintaanPasar/hapus/$key->id_permintaan_pasar") ?>">Hapus</a>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach ?>