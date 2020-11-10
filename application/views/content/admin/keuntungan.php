<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Nilai NK</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url("admin/Keuntungan/keuntungan") ?>" method="post" class="form-horizontal form-label-left">
          <div class="form-group">
            <label class="col-form-label">X1 <span class="required">*</span></label>
            <input type="text" class="form-control" id="x1" name="x1" placeholder="Nilai X1" required="required">
          </div>
          <div class="form-group">
            <label class="col-form-label">X2 <span class="required">*</span></label>
            <input type="text" class="form-control" id="x2" name="x2" placeholder="Nilai X2" required="required">
          </div>
          <div class="form-group">
            <label class="col-form-label">X3 <span class="required">*</span></label>
            <input type="text" class="form-control" id="x3" name="x3" placeholder="Nilai X3" required="required">
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" style="float: right; margin-left: 5px;" id="submit_nk" class="btn btn-success">Hitung !!</button>
            <button type="reset" style="float: right;" class="btn btn-primary">Reset</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade bs-example-modal-lga" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Keuntungan Optimal PT Jasentra</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url("admin/Keuntungan/tambah") ?>" method="post" class="form-horizontal form-label-left">
          <?php foreach ($nk as $key) : ?>
            <div class="form-group">
              <label class="col-form-label">Nilai NK <span class="required">*</span></label>
              <input type="text" class="form-control" id="nilai_nk_isi" name="nilai_nk_isi" value="<?php echo $key->nilai_nk ?>" required="required" readonly="readonly">
            </div>
          <?php endforeach ?>
          <div class="form-group">
            <label class="col-form-label">Kode Peramalan | Tahun | Kuartal <span class="required">*</span></label>
            <select class="form-control" id="id_peramalan_isi" name="id_peramalan_isi">
              <option value="&nbsp"></option>
              <?php foreach ($id_peramalan_isi as $key) : ?>
                <option value="<?php echo $key->id_peramalan ?>"><?php echo $key->id_peramalan ?> | <?php echo $key->tahun ?> | <?php echo $key->kuartal ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label class="col-form-label">Tahun <span class="required">*</span></label>
            <input type="text" class="form-control" id="tahun_isi" name="tahun_isi" placeholder="Tahun" required="required" readonly="readonly">
          </div>
          <div class="form-group">
            <label class="col-form-label">Kuartal <span class="required">*</span></label>
            <input type="text" class="form-control" id="kuartal_isi" name="kuartal_isi" placeholder="Kuartal" required="required" readonly="readonly">
          </div>
          <div class="form-group">
            <label class="col-form-label">Hasil Peramalan <span class="required">*</span></label>
            <input type="text" class="form-control" id="hasil_peramalan_isi" name="hasil_peramalan_isi" placeholder="Hasil Peramalan" required="required" readonly="readonly">
          </div>
          
          <div class="ln_solid"></div>
          <div class="form-group">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" style="float: right; margin-left: 5px;" id="add_chart" class="btn btn-success">Hitung !!</button>
            <button type="reset" style="float: right;" class="btn btn-primary">Reset</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-6 main-header">
          <h2>Optimasi<span>Keuntungan Penjualan</span></h2>
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
              <div class="row">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg"> Hitung NK</button>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lga"> Hitung Keuntungan</button>
                <a type="button" class="btn btn-danger" href="#" data-toggle="modal" data-target="#delete_all"> Hapus Semua Data</a>
              </div>
              <thead>
                <tr>
                  <th>No.</th>
                  <!-- <th>ID Peramalan</th> -->
                  <th>Tahun</th>
                  <th>Kuartal</th>
                  <th>Jumlah Peramalan (KG)</th>
                  <th>Keuntungan (Rp.)</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                foreach ($keuntungan as $key) : ?>

                  <tr>
                    <td><?php echo $no++?></td>
                    <td><?php echo $key->tahun ?></td>
                    <td><?php echo $key->kuartal ?></td>
                    <td><?php echo $key->peramalan_produksi ?></td>
                    <td><?php echo $key->keuntungan ?></td>
                    <td>
                      <div class="form-group">
                        <a id="id_keuntungan_hapus" name="id_keuntungan_hapus" href="#" data-toggle="modal" data-target="#delete<?php echo $key->id_keuntungan ?>" data-feather="trash-2">Hapus</a>
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
                  <th>Jumlah Peramalan (KG)</th>
                  <th>Keuntungan  (Rp.)</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


  <?php foreach ($keuntungan as $key) : ?>
    <div class="modal fade" id="delete<?php echo $key->id_keuntungan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <a class="btn btn-primary" href="<?php echo base_url("admin/keuntungan/hapus_data/$key->id_keuntungan") ?>">Hapus</a>
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
          <a class="btn btn-primary" href="<?php echo base_url("admin/keuntungan/hapus_semua") ?>">Hapus</a>
        </div>
      </div>
    </div>
  </div>

  <!-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $("#id_peramalan_isi").select({
        placeholder: "Masukkan no Kode Peramalan",
        allowClear: true,
        minimumInputLength: 1
      });

      $("#id_peramalan_isi").on('change', function() {
        var id_peramalan = $("#id_peramalan_isi").val();

        $.ajax({
          url: "<?php echo base_url("admin/keuntungan/data_peramalan") ?>",
          type: "POST",
          dataType: "JSON",
          data: {
            id_peramalan: id_peramalan
          },
          cache: false,
          success: function(data) {
            $.each(data, function(hasil_peramalan) {
              console.log(data);
              $("#tahun_isi").val(data.tahun);
              $("#kuartal_isi").val(data.kuartal);
              $("#hasil_peramalan_isi").val(data.hasil_peramalan);
            });
          }
        })
      });
    });
  </script>