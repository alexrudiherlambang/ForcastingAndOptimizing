<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-6 main-header">
          <h2>Profil<span>Data Pribadi User</span></h2>
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
        <form class="form theme-form">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nama</label>
                  <div class="col-sm-9">
                    <input class="form-control" type="text" value="<?php echo $this->session->userdata("nama") ?>" readonly="readonly">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                  <div class="col-sm-9">
                    <input class="form-control" type="text" value="<?php echo $this->session->userdata("jenis_kelamin") ?>" readonly="readonly">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Alamat</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" rows="5" cols="5" readonly="readonly"><?php echo $this->session->userdata("alamat") ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Jabatan</label>
                  <div class="col-sm-9">
                    <input class="form-control" type="text"  value="<?php echo $this->session->userdata("jabatan") ?>" readonly="readonly">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Username</label>
                  <div class="col-sm-9">
                    <input class="form-control" type="text"  value="<?php echo $this->session->userdata("username") ?>" readonly="readonly">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="col-sm-9 offset-sm-3">
              <a class="btn btn-pill btn-primary" href="<?php echo base_url("admin/dashboard") ?> ">Oke</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
