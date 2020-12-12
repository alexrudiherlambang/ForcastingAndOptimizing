<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Data User</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url("admin/datauser/tambah") ?>" method="post" class="form-horizontal form-label-left">
          <div class="form-group">
            <label class="col-form-label">ID User</label>
            <input type="text" class="form-control" id="id_user_isi" name="id_user_isi" value="<?php echo $kode ?>" readonly="readonly" required="required">
          </div>
          <div class="form-group">
            <label class="col-form-label">Nama <span class="required">*</span></label>
            <input type="text" class="form-control" id="nama_isi" name="nama_isi" placeholder="Nama Lengkap" required="required">
          </div>
          <div class="form-group">
            <label class="col-form-label">Jenis Kelamin <span class="required">*</span></label>
            <select class="form-control" id="jenis_kelamin_isi" name="jenis_kelamin_isi" required="required">
              <option>--Pilih--</option>
              <option>Laki - Laki</option>
              <option>Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label class="col-form-label">Alamat <span class="required">*</span>
            </label>
            <textarea class="form-control" rows="3" id="alamat_isi" name="alamat_isi" placeholder="Alamat Lengkap" required="required"></textarea>
          </div>
          <div class="form-group">
            <label class="col-form-label">Jabatan <span class="required">*</span></label>
            <select class="form-control" id="jabatan_isi" name="jabatan_isi" required="required">
              <option>--Pilih--</option>
              <option>Admin</option>
              <option>Pegawai</option>
            </select>
          </div>
          <div class="form-group">
            <label class="col-form-label">Username <span class="required">*</span></label>
            <input type="text" class="form-control" id="username_isi" name="username_isi" placeholder="Username" required="required">
            <p id="pesan"></p>
          </div>
          <div class="form-group">
            <label class="col-form-label">Password <span class="required">*</span></label>
            <input type="password" class="form-control" id="password_isi" name="password_isi" placeholder="Password" required="required">
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" style="float: right; margin-left: 5px;" id="submit_edit" class="btn btn-success">Submit</button>
            <button type="reset" style="float: right;" class="btn btn-primary">Reset</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php foreach ($user as $key) : ?>
  <div class="modal fade bs-example-modal-lga<?php echo $key->id_user ?> " tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Edit Data User</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url("admin/datauser/edit") ?>" method="post" class="form-horizontal form-label-left">
            <div class="form-group">
              <label class="col-form-label">ID User</label>
              
              <input type="text" class="form-control" id="id_user" name="id_user" value="<?php echo $key->id_user ?>" readonly="readonly" required="required">



            </div>
            <div class="form-group">
              <label class="col-form-label">Nama <span class="required">*</span></label>              
              <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $key->nama_user ?>" placeholder="Nama Lengkap" required="required">



            </div>
            <div class="form-group">
              <label class="col-form-label">Jenis Kelamin <span class="required">*</span></label>              
              <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                <option>--Pilih--</option>
                <option <?php if ($key->jenis_kelamin == "Laki - Laki") { ?> selected="selected" <?php } ?>>Laki - laki</option>
                <option <?php if ($key->jenis_kelamin == "Perempuan") { ?> selected="selected" <?php } ?>>Perempuan</option>
              </select>



            </div>
            <div class="form-group">
              <label class="col-form-label">Alamat <span class="required">*</span>              </label>
              
              <textarea class="form-control" rows="3" placeholder="Alamat Lengkap" id="alamat" name="alamat" required="required"><?php echo $key->alamat ?></textarea>



            </div>
            <div class="form-group">
              <label class="col-form-label">Jabatan <span class="required">*</span></label>              
              <select class="form-control" id="jabatan" name="jabatan" required="required">
                <option>--Pilih--</option>
                <option <?php if ($key->jabatan == "Admin") { ?> selected="selected" <?php } ?>>Admin</option>
                <option <?php if ($key->jabatan == "Pegawai") { ?> selected="selected" <?php } ?>>Pegawai</option>
              </select>



            </div>
            <div class="form-group">
              <label class="col-form-label">Username <span class="required">*</span></label>              
              <input type="text" class="form-control" id="username" name="username" oninput="check()" value="<?php echo $key->username ?>" placeholder="Username" required="required">
              <p id="pesan_edit"></p>



            </div>
            <div class="form-group">
              <label class="col-form-label">Password <span class="required">*</span></label>              
              <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="required">
            </div>


            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-form-label">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" style="float: right; margin-left: 5px;" id="submit_edit" class="btn btn-success">Submit</button>
                <button type="reset" style="float: right;" class="btn btn-primary">Reset</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach ?>

<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-6 main-header">
          <h2>User<span>Data User</span></h2>
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
                  <th>Nama User</th>
                  <th>Jenis Kelamin</th>
                  <th>Alamat</th>
                  <th>Jabatan</th>
                  <th>Username</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                foreach ($user as $key) : ?>

                  <tr>
                    <td><?php echo $no++?></td>
                    <!-- <td><?php echo $key->id_user ?></td> -->
                    <td><?php echo $key->nama_user ?></td>
                    <td><?php echo $key->jenis_kelamin ?></td>
                    <td><?php echo $key->alamat ?></td>
                    <td><?php echo $key->jabatan ?></td>
                    <td><?php echo $key->username ?></td>
                    <td>
                      <div class="form-group">
                        <a href="#" data-feather="edit" data-toggle="modal" data-target=".bs-example-modal-lga<?php echo $key->id_user ?>">Edit</a>

                        <a id="id_user_hapus" name="id_user_hapus" href="#" data-toggle="modal" data-target="#delete<?php echo $key->id_user ?>" data-feather="trash-2">Hapus</a>
                      </div>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Nama User</th>
                  <th>Jenis Kelamin</th>
                  <th>Alamat</th>
                  <th>Jabatan</th>
                  <th>Username</th>
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
  <?php foreach ($user as $key) : ?>
    <div class="modal fade" id="delete<?php echo $key->id_user ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <a class="btn btn-primary" href="<?php echo base_url("admin/datauser/hapus/$key->id_user") ?>">Hapus</a>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach ?>