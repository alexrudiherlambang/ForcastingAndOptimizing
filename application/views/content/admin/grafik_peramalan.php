<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-6 main-header">
          <h2>Grafik<span>Data Peramalan</span></h2>
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
  <div class="select2-drpdwn">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <form action="<?php echo base_url("admin/grafikperamalan") ?>" method="post">
            <div class="col-sm-12 col-xl-6 xl-100">
              <div class="card-body"> 
                <div class="mb-2">
                  <label for="">Tahun</label>
                  <span class="selection">
                    <select class="form-control form-control-primary btn-square" id="tahun_isi" name="tahun_isi">
                      <option value="&nbsp"></option>
                      <?php foreach ($thn as $key) : ?>
                        <option value="<?php echo $key->tahun ?>"><?php echo $key->tahun ?></option>
                      <?php endforeach; ?>
                    </select>
                  </span>
                </div>
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-primary">Filter</button>
                </span>

                <div class="card-body p-0">
                  <!-- <div id="area-spaline"></div> -->
                  <canvas id="grafikperbulan"></canvas>
                </div>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="<?php echo base_url("assets/js/vendors/Chart.min.js") ?>"></script>
<!-- <script src="<?php echo base_url("assets/js/vendors/Chart.js") ?>"></script> -->
<!-- <script src="<?php echo base_url("assets/js/chart/apex-chart/apex-chart.js") ?>"></script> -->
<script>
  if ($("#grafikperbulan").length) {

    var f = document.getElementById("grafikperbulan");
    new Chart(f, {
      type: "line",
      data: {
        labels: ["Kuartal1", "Kuartal2", "Kuartal3", "Kuartal 4"],
        datasets: [{
          label: "Grafik Peramalan Jamur Tiram per Kuartal",
          backgroundColor: "rgba(38, 185, 154, 0.31)",
          borderColor: "rgba(38, 185, 154, 0.7)",
          pointBorderColor: "rgba(38, 185, 154, 0.7)",
          pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
          pointHoverBackgroundColor: "#fff",
          pointHoverBorderColor: "rgba(220,220,220,1)",
          pointBorderWidth: 1,
          data: <?php echo json_encode($grafik); ?>
        }]
      }
    })
  }
  console.log("<?php echo json_encode($grafik); ?>");
</script>
