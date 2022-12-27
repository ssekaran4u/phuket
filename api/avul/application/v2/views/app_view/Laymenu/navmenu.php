<?php 
    $short_name = $this->session->userdata('c_full_name');
    $c_short_name = '';
    $short_nameres = explode(" ", $short_name);
    if($short_nameres)
    {
        if(sizeof($short_nameres)==1)
        {
            $c_short_name = substr($short_name,0,2);
        }
        else
        {
            $c_short_name = substr($short_nameres[0],0,1).substr($short_nameres[1],0,1);
        }
    }
?>

<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item">
                    <a class="nav-link menu-toggle" href="#">
                    <i class="ficon" data-feather="menu"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav bookmark-icons">
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link" href="javascript:void()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Email">
                    <i class="ficon" data-feather="mail"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link" href="javascript:void()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Calendar">
                    <i class="ficon" data-feather="calendar"></i>
                    </a>
                </li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">
            <li class="nav-item d-none d-lg-block">
                <!-- <a class="nav-link nav-link-style display_mode"> -->
                <a class="nav-link display_mode" data-val="moon" data-dir="app" data-cntrl="dashboard" data-func="layout_view">
                    <i class="ficon moon_view show" data-feather="moon"></i>
                    <i class="ficon sun_view hide" data-feather="sun"></i>
                </a>
            </li>
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name fw-bolder"><?php echo strtoupper($c_short_name); ?></span>
                        <span class="user-status"><?php echo $this->session->userdata('c_role_title'); ?></span>
                    </div>
                    <span class="avatar">
                    <img class="round" src="<?php echo BASE_URL; ?>app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="40" width="40">
                    <span class="avatar-status-online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="javascript:void()">
                    <i class="me-50" data-feather="user"></i> Profile </a>
                    <a class="dropdown-item" href="javascript:void()">
                    <i class="me-50" data-feather="settings"></i> Settings </a>
                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>app/dashboard/logout">
                    <i class="me-50" data-feather="power"></i> Logout </a>
                </div>
            </li>
        </ul>
    </div>
</nav>