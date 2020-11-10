<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-6 main-header">
          <h2>Home<span>Dashboard </span></h2>
          <h6 class="mb-0">admin panel</h6>
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
      <div class="col-lg-12 xl-100">
        <div class="row">
          <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
            <div class="card gradient-primary o-hidden">
              <div class="b-r-4 card-body">
                <div class="media static-top-widget">
                  <div class="align-self-center text-center"><i data-feather="users"></i></div>
                  <div class="media-body"><span class="m-0 text-white">Jumlah User</span>
                    <h4 class="mb-0 counter">
                      <?php foreach ($jumlah_user as $key) : ?>
                        <div class="count"><?php echo number_format($key->jumlah) ?></div>
                      <?php endforeach ?>
                    </h4><i class="icon-bg" data-feather="users"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
            <div class="card gradient-secondary o-hidden">
              <div class="b-r-4 card-body">
                <div class="media static-top-widget">
                  <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
                  <div class="media-body"><span class="m-0">Produksi Hari Ini</span>
                    <h4 class="mb-0 counter">
                      <?php foreach ($produksi_harian as $key) : ?>
                        <div class="count"><?php echo number_format($key->jumlah_produksi) ?></div>
                      <?php endforeach ?>
                    </h4><i class="icon-bg" data-feather="shopping-bag"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
            <div class="card gradient-warning o-hidden">
              <div class="b-r-4 card-body">
                <div class="media static-top-widget">
                  <div class="align-self-center text-center">
                    <div class="text-white i" data-feather="briefcase"></div>
                  </div>
                  <div class="media-body"><span class="m-0 text-white">Produksi Bulan Ini</span>
                    <h4 class="mb-0 counter text-white">
                      <?php foreach ($produksi_bulanan as $key) : ?>
                        <div class="count"><?php echo number_format($key->jumlah_produksi) ?></div>
                      <?php endforeach ?>
                    </h4><i class="icon-bg" data-feather="briefcase"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
            <div class="card gradient-info o-hidden">
              <div class="b-r-4 card-body">
                <div class="media static-top-widget">
                  <div class="align-self-center text-center">
                    <div class="text-white i" data-feather="box"></div>
                  </div>
                  <div class="media-body"><span class="m-0 text-white">Produksi Tahun Ini</span>
                    <h4 class="mb-0 counter text-white">
                      <?php foreach ($produksi_tahunan as $key) : ?>
                        <div class="count"><?php echo number_format($key->jumlah_produksi) ?></div>
                      <?php endforeach ?>
                    </h4><i class="icon-bg" data-feather="box"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



