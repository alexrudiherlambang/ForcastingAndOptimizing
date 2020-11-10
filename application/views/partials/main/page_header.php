<!-- Page Header Start-->
<div class="page-main-header">
  <div class="main-header-right">
    <div class="main-header-left text-center">
      <div class="logo-wrapper"><a href="#"><img src="<?php echo base_url("assets/images/logo/cloud.png") ?>" alt=""></a></div>
    </div>
    <div class="mobile-sidebar">
      <div class="media-body text-right switch-sm">
        <label class="switch ml-3"><i class="font-primary" id="sidebar-toggle" data-feather="align-center"></i></label>
      </div>
    </div>
    <div class="vertical-mobile-sidebar"><i class="fa fa-bars sidebar-bar"></i></div>
    <div class="nav-right col pull-right right-menu">
      <ul class="nav-menus">
        <li>
          <form >
            <div class="form-group">
              <div class="Typeahead Typeahead--twitterUsers">
                <div class="u-posRelative">                  
                </div>
                <div class="Typeahead-menu"></div>
              </div>
            </div>
          </form>
        </li>
        <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
        <li class="onhover-dropdown"> <span class="media user-header"><img class="img-fluid" src="<?php echo base_url("assets/images/dashboard/user1.png") ?>" alt=""></span>
          <ul class="onhover-show-div profile-dropdown">
            <li class="gradient-primary">
              <h5 class="f-w-600 mb-0"><?php echo $this->session->userdata("nama") ?></h5><span><?php echo $this->session->userdata("jabatan") ?></span>
            </li>
            <li><i data-feather="user"> </i><a href="<?php echo base_url("admin/profil") ?>">Profile</a></li>
            <li><i data-feather="settings"> </i><a href="#">Settings</a></li>
            <li><i data-feather="log-out"> </i><a href="<?php echo base_url("login/logout") ?>">Logout</a></li>
          </ul>
        </li>
      </ul>
      <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
    </div>
  </div>
</div>
      <!-- Page Header Ends -->