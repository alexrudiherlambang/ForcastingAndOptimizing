<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-6 main-header">
          <h2>Grafik<span>Data Produksi</span></h2>
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
        <h5>Grafik Produksi Jamur Tiram</h5>
        <form action="<?php echo base_url("pegawai/grafik") ?>" method="post">
          <div class="col-sm-12 col-xl-6 xl-100">
            <div class="card"> 
              <div class="form-group">
                <label for="">Tahun</label>
                <select class="form-control" id="tahun_isi" name="tahun_isi">
                  <option>2018</option>
                  <option>2019</option>
                  <option>2020</option>
                </select>
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-primary">Filter</button>
                </span>
              </div>
              <div class="card-body p-0">
                <div id="area-spaline"></div>
              </div>
            </div>
          </div>
        </form>
        
      </div>
    </div>
  </div>
</div>
</div>

<!-- Chart.js -->
<script src="<?php echo base_url("assets/js/vendors/Chart.min.js") ?>"></script>
<!-- <script src="<?php echo base_url("assets/js/vendors/Chart.js") ?>"></script> -->
<!-- <script src="<?php echo base_url("assets/js/chart/apex-chart/apex-chart.js") ?>"></script> -->
<script>
  if ($("#grafikperbulan").length) {

    var f = document.getElementById("grafikperbulan");
    new Chart(f, {
      type: "line",
      data: {
        labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
        datasets: [{
          label: "Grafik penjualan per Bulan",
          backgroundColor: "rgba(38, 185, 154, 0.31)",
          borderColor: "rgba(38, 185, 154, 0.7)",
          pointBorderColor: "rgba(38, 185, 154, 0.7)",
          pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
          pointHoverBackgroundColor: "#fff",
          pointHoverBorderColor: "rgba(220,220,220,1)",
          pointBorderWidth: 1,
          data: <?php echo json_encode($tahun); ?>
        }]
      }
    })
  }
</script>
