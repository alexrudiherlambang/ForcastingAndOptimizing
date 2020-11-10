<body id="top">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W24T6W7"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
      <!-- End Google Tag Manager (noscript) -->
      <div class="page_loader"></div>

      <!-- Login 5 start -->
      <div class="login-5">
        <div class="container">
            <div class="row login-box">
                <div class="col-lg-6 align-self-center pad-0">
                    <div class="form-section align-self-center">
                        <h1><strong>JASENTRA LOGIN</strong></h1>
                        <div class="btn-section clearfix">
                        </div>
                        <div class="clearfix"></div>
                        <section class="login_content">
                        <?php 
                            if ($this->session->flashdata("gagal")): ?>
                                <div class="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                <?php echo $this->session->flashdata("gagal") ?>
                                </div>
                        <?php endif ?>
                        <form role="form" action="<?php echo base_url("login/process") ?>" method="post" class="login-form">
                            <div class="form-group form-box">
                                <input type="text" name="username" placeholder="Username..." class="form-username form-control" id="form-username">
                            </div>
                            <div class="form-group form-box clearfix">
                                <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
                            </div>
                            <div class="form-group clearfix mb-0">
                                <button type="submit" name="submit" class="btn-md btn-theme float-center">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 bg-color-15 align-self-center pad-0 none-992 bg-img">
                    <div class="info clearfix">
                        <div class="logo-1">
                            <a href="login-5.html">
                                <img src="assets_login/img/logos/logo_fix.png" alt="logo">
                            </a>
                        </div>
                        <h3>Selamat Datang :)</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Login 5 end -->