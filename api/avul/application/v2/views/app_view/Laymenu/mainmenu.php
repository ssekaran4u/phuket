<?php 
// var_dump($this->session->userdata('n_user_access'));die();
$user_accessing = explode(",", $this->session->userdata('n_user_access'));

$city_add  = in_array('city_add', $user_accessing);
$city_view  = in_array('city_view', $user_accessing);
$district_add  = in_array('district_add', $user_accessing);
$district_view  = in_array('district_view', $user_accessing);
$town_add  = in_array('town_add', $user_accessing);
$town_view  = in_array('town_view', $user_accessing);

$role_add  = in_array('role_add', $user_accessing);
$role_view  = in_array('role_view', $user_accessing);
$user_add  = in_array('user_add', $user_accessing);
$user_view  = in_array('user_view', $user_accessing);
$category_add  = in_array('category_add', $user_accessing);
$category_view  = in_array('category_view', $user_accessing);
$coupon_add  = in_array('coupon_add', $user_accessing);
$coupon_view  = in_array('coupon_view', $user_accessing);
$vendor_add  = in_array('vendor_add', $user_accessing);
$vendor_view  = in_array('vendor_view', $user_accessing);
$banner_add  = in_array('banner_add', $user_accessing);
$banner_view  = in_array('banner_view', $user_accessing);

$demographic_add  = in_array('demographic_add', $user_accessing);
$demographic_view  = in_array('demographic_view', $user_accessing);
$pages_add  = in_array('pages_add', $user_accessing);
$pages_view  = in_array('pages_view', $user_accessing);
?>

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="javascript:void()">
                    <span class="brand-logo">
                        <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                            <defs>
                                <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                    <stop stop-color="#000000" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                                <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                    <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                            </defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                    <g id="Group" transform="translate(400.000000, 178.000000)">
                                        <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                                        <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                        <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                        <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                        <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </span>
                    <h2 class="brand-text"><?php echo SITE_NAME; ?></h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    
    
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <?php if($city_add || $city_view  || $district_add || $district_view ||  $town_add || $town_view || $demographic_add || $demographic_view ): ?>
                <li class=" navigation-header">
                    <span data-i18n="Masters">Masters</span>
                    <i data-feather="more-horizontal"></i>
                </li>
                <?php if($city_add || $city_view): ?>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                    <i class="icon-globe"></i>
                    <span class="menu-title text-truncate" data-i18n="City">City</span>
                    </a>
                    <ul class="menu-content">
                        <?php if($city_add): ?>
                        <li class="<?php if($currentmenu == 'city') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/master/city/add">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Create City">Create City</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if($city_view): ?>
                        <li class="<?php if($currentmenu == 'cities') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/master/city/manage">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Manage City">Manage City</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                <?php if($district_add || $district_view): ?>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                    <i class="icon-pie-chart"></i>
                    <span class="menu-title text-truncate" data-i18n="District">District</span>
                    </a>
                    <ul class="menu-content">
                        <?php if($district_add): ?>
                        <li class="<?php if($currentmenu == 'district') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/master/district/add">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Create District">Create District</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if($district_view): ?>
                        <li class="<?php if($currentmenu == 'districts') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/master/district/manage">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Manage District">Manage District</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                <?php if($town_add || $town_view): ?>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                    <i class="icon-share"></i>
                    <span class="menu-title text-truncate" data-i18n="Town">Town</span>
                    </a>
                    <ul class="menu-content">
                        <?php if($town_add): ?>
                        <li class="<?php if($currentmenu == 'town') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/master/town/add">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Create Town">Create Town</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if($town_view): ?>
                        <li class="<?php if($currentmenu == 'towns') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/master/town/manage">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Manage Town">Manage Town</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                <?php if($demographic_add || $demographic_view): ?>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                    <i data-feather="filter"></i>
                    <span class="menu-title text-truncate" data-i18n="Demographic">Demographic</span>
                    </a>
                    <ul class="menu-content">
                        <?php if($demographic_add): ?>
                        <li class="<?php if($currentmenu == 'demographic') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/master/demographic/add">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Create Demographic">Create</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if($demographic_view): ?>
                        <li class="<?php if($currentmenu == 'demographics') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/master/demographic/manage">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Manage Demographic">Manage</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                
            <?php endif; ?>

            <?php if($role_add || $role_view || $user_add || $user_view): ?>
                <li class=" navigation-header">
                    <span data-i18n="User Management">User Management</span>
                    <i data-feather="more-horizontal"></i>
                </li>
                <?php if($role_add || $role_view): ?>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                    <i class="icon-directions"></i>
                    <span class="menu-title text-truncate" data-i18n="Role">Role</span>
                    </a>
                    <ul class="menu-content">
                        <?php if($role_add): ?>
                        <li class="<?php if($currentmenu == 'add_role') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/users/role/add">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Create Role">Create Role</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if($role_view): ?>
                        <li class="<?php if($currentmenu == 'manage_role') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/users/role/manage">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Manage Role">Manage Role</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
                <?php if($user_add || $user_view): ?>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                    <i class="icon-user-follow"></i>
                    <span class="menu-title text-truncate" data-i18n="User">User</span>
                    </a>
                    <ul class="menu-content">
                        <?php if($user_add): ?>
                        <li class="<?php if($currentmenu == 'user') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/users/user/add">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Create User">Create User</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if($user_view): ?>
                        <li class="<?php if($currentmenu == 'users') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/users/user/manage">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Manage User">Manage User</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
            <?php endif; ?>


            <?php if($category_add || $category_view || $coupon_add || $coupon_view || $banner_add || $banner_view): ?>
                <li class=" navigation-header">
                    <span data-i18n="Catalogue">Catalogue</span>
                    <i data-feather="more-horizontal"></i>
                </li>
                <?php if($category_add || $category_view): ?>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                    <i class="icon-docs"></i>
                    <span class="menu-title text-truncate" data-i18n="Category">Category</span>
                    </a>
                    <ul class="menu-content">
                        <?php if($category_add): ?>
                        <li class="<?php if($currentmenu == 'category') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/catalogue/category/add">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Create Category">Create Category</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if($category_view): ?>
                        <li class="<?php if($currentmenu == 'categories') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/catalogue/category/manage">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Manage Category">Manage Category</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                <?php if($coupon_add || $coupon_view): ?>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                    <i class="icon-wallet"></i>
                    <span class="menu-title text-truncate" data-i18n="Coupon">Coupon</span>
                    </a>
                    <ul class="menu-content">
                        <?php if($coupon_add): ?>
                        <li class="<?php if($currentmenu == 'coupon') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/catalogue/coupon/add">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Create Coupon">Create Coupon</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if($coupon_view): ?>
                        <li class="<?php if($currentmenu == 'coupons') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/catalogue/coupon/manage">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Manage Coupon">Manage Coupon</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                <?php if($banner_add || $banner_view): ?>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                    <i class="icon-picture"></i>
                    <span class="menu-title text-truncate" data-i18n="Ad Banner">Ad Banner</span>
                    </a>
                    <ul class="menu-content">
                        <?php if($banner_add): ?>
                        <li class="<?php if($currentmenu == 'banner') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/catalogue/banner/add">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Create Ad Banner">Create Ad</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if($banner_view): ?>
                        <li class="<?php if($currentmenu == 'banners') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/catalogue/banner/manage">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Manage Ad Banner">Manage Ad Banner</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

            <?php endif; ?>


            <?php if(($vendor_add || $vendor_view)): ?>
                <?php if($this->session->get_userdata()['n_accessible_role']!=''): ?>
                <li class=" navigation-header">
                    <span data-i18n="Vendor">Vendor</span>
                    <i data-feather="more-horizontal"></i>
                </li>

                <li class="nav-item">
                    <a class="d-flex align-items-center" href="#">
                    <i class="icon-magnifier-add"></i>
                    <span class="menu-title text-truncate" data-i18n="Assign">Assign Vendor</span>
                    </a>
                    <ul class="menu-content">
                        <li class="<?php if($currentmenu == 'assign') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/assign/add">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="User Vendor">Assign</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="d-flex align-items-center" href="#">
                    <i class="icon-users"></i>
                    <span class="menu-title text-truncate" data-i18n="Vendors">Vendors</span>
                    </a>
                    <ul class="menu-content">
                        <?php if($vendor_add): ?>
                        <li class="<?php if($currentmenu == 'vendor') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/vendor/add">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="User Vendor">Create Vendor</span>
                            </a>
                        </li>
                        <?php if($this->session->get_userdata()['n_id']==1): ?>
                        <li class="<?php if($currentmenu == 'public-vendor') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/public-vendor/add">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="User Public Vendor">Create Public Vendor</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if($vendor_view): ?>
                        <li class="<?php if($currentmenu == 'vendors') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/vendor/manage">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Manage Vendor">Manage Vendor</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>

                <?php if($vendor_add || $vendor_view ): ?>
                <li class="nav-item">
                    <a class="d-flex align-items-center" href="#">
                    <i class="icon-handbag"></i>
                    <span class="menu-title text-truncate" data-i18n="Vendors">Vendor Coupons</span>
                    </a>
                    <ul class="menu-content">
                        <li class="<?php if($currentmenu == 'vendorcoupon') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/vendor-coupon/add">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Assign Coupon">Assign Coupon</span>
                            </a>
                        </li>
                        <li class="<?php if($currentmenu == 'vendorcoupons') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/vendor-coupon/manage">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Manage Coupons">Manage Coupons</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>
            <?php endif; ?>

            <?php if($pages_add || $pages_view): ?>
                <li class=" navigation-header">
                    <span data-i18n="Page Management">Page Management</span>
                    <i data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                    <i data-feather='folder'></i>
                    <span class="menu-title text-truncate" data-i18n="Create Pages">Pages</span>
                    </a>
                    <ul class="menu-content">
                        <?php if($pages_add): ?>
                        <li class="<?php if($currentmenu == 'pages_add') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/pages/add">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="User Role">Create</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if($pages_view): ?>
                        <li class="<?php if($currentmenu == 'pages_view') echo 'active'; ?>">
                            <a class="d-flex align-items-center" href="<?php echo BASE_URL; ?>app/pages/manage">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="User Role">Manage</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
        </ul>
    </div>
</div>