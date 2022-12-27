<?php
    $n_id         = isset($dataval[0]->n_id)?$dataval[0]->n_id:'';
    $c_role_title      = isset($dataval[0]->c_role_title)?$dataval[0]->c_role_title:'';
    $n_status     = isset($dataval[0]->n_status)?$dataval[0]->n_status:'';
    $c_role_heading = !empty($dataval[0]->c_role_heading)?$dataval[0]->c_role_heading:'';
    $c_role_list    = !empty($dataval[0]->c_role_list)?$dataval[0]->c_role_list:'';
    $role_heading   = explode(',', $c_role_heading);
    $role_list      = explode(',', $c_role_list);
?>        
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>app/dashboard"><i data-feather="home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="javascript:void()"><?php echo $main_heading; ?></a>
                                </li>
                                <li class="breadcrumb-item active"><?php echo $page_title; ?>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                <div class="mb-1 breadcrumb-right">
                    <div class="dropdown">
                        <?php if($role_access): ?>
                        <a class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" href="<?php echo BASE_URL.$pre_menu; ?>"><?php echo $pre_title; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <section id="multiple-column-form">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title m-0"><?php echo $page_title; ?></h4>
                        </div>
                        <div class="card-body">
                            <form id="form_data" class="form_data" name="form_data" method="post">
                                <?php if($method == '_Edit'): ?>
                                    <div class="col-md-12">
                                        <div class="d-flex flex-column mb-1">
                                            <label class="form-label mb-50" for="n_status">Status</label>
                                            <div class="form-check form-switch form-check-primary">
                                                <input type="checkbox" class="form-check-input" id="n_status" value="<?php echo $n_status; ?>" <?php echo $n_status==1 ? 'checked' : ''; ?> name="n_status" />
                                                <label class="form-check-label" for="n_status">
                                                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-column">Role <span class="text-danger">*</span></label>
                                        <input type="text" id="first-name-column" class="form-control input_field" placeholder="Role Name" name="c_role" value="<?php echo $c_role_title; ?>" />
                                    </div>
                                </div>
                                <div class="table-responsive mb-2">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th style="width:50px;">
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input" id="checkAll"/>
                                                    </div>
                                                </th>
                                                <th><strong>Module</strong></th>
                                                <th><strong>Add</strong></th>
                                                <th><strong>Edit</strong></th>
                                                <th><strong>View</strong></th>
                                                <th><strong>Delete</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input data-item="1" type="checkbox" class="accessModule form-check-input" name="heading_val[]" value="vendor_list" <?php echo in_array('vendor_list', $role_heading) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td><strong>Vendors</strong></td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input vendorChk" name="check_val[]" value="vendor_add" <?php echo in_array('vendor_add', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input vendorChk" name="check_val[]" value="vendor_edit" <?php echo in_array('vendor_edit', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input vendorChk" name="check_val[]" value="vendor_view" <?php echo in_array('vendor_view', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input vendorChk" name="check_val[]" value="vendor_delete" <?php echo in_array('vendor_delete', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input data-item="2" type="checkbox" class="accessModule form-check-input" name="heading_val[]" value="city_list" <?php echo in_array('city_list', $role_heading) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td><strong>City</strong></td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input cityChk" name="check_val[]" value="city_add" <?php echo in_array('city_add', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input cityChk" name="check_val[]" value="city_edit" <?php echo in_array('city_edit', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input cityChk" name="check_val[]" value="city_view" <?php echo in_array('city_view', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input cityChk" name="check_val[]" value="city_delete" <?php echo in_array('city_delete', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input data-item="3" type="checkbox" class="accessModule form-check-input" name="heading_val[]" value="district_list" <?php echo in_array('district_list', $role_heading) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td><strong>District</strong></td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input districtChk" name="check_val[]" value="district_add" <?php echo in_array('district_add', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input districtChk" name="check_val[]" value="district_edit" <?php echo in_array('district_edit', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input districtChk" name="check_val[]" value="district_view" <?php echo in_array('district_view', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input districtChk" name="check_val[]" value="district_delete" <?php echo in_array('district_delete', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                            </tr>                                            
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input data-item="4" type="checkbox" class="accessModule form-check-input" name="heading_val[]" value="town_list" <?php echo in_array('town_list', $role_heading) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td><strong>Town</strong></td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input townChk" name="check_val[]" value="town_add" <?php echo in_array('town_add', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input townChk" name="check_val[]" value="town_edit" <?php echo in_array('town_edit', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input townChk" name="check_val[]" value="town_view" <?php echo in_array('town_view', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input townChk" name="check_val[]" value="town_delete" <?php echo in_array('town_delete', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input data-item="5" type="checkbox" class="accessModule form-check-input" name="heading_val[]" value="coupon_list" <?php echo in_array('coupon_list', $role_heading) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td><strong>Coupons</strong></td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input couponChk" name="check_val[]" value="coupon_add" <?php echo in_array('coupon_add', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input couponChk" name="check_val[]" value="coupon_edit" <?php echo in_array('coupon_edit', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input couponChk" name="check_val[]" value="coupon_view" <?php echo in_array('coupon_view', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input couponChk" name="check_val[]" value="coupon_delete" <?php echo in_array('coupon_delete', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input data-item="6" type="checkbox" class="accessModule form-check-input" name="heading_val[]" value="role_list" <?php echo in_array('role_list', $role_heading) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td><strong>Role</strong></td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input roleChk" name="check_val[]" value="role_add" <?php echo in_array('role_add', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input roleChk" name="check_val[]" value="role_edit" <?php echo in_array('role_edit', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input roleChk" name="check_val[]" value="role_view" <?php echo in_array('role_view', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input roleChk" name="check_val[]" value="role_delete" <?php echo in_array('role_delete', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input data-item="7" type="checkbox" class="accessModule form-check-input" name="heading_val[]" value="user_list" <?php echo in_array('user_list', $role_heading) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td><strong>Users</strong></td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input userChk" name="check_val[]" value="user_add" <?php echo in_array('user_add', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input userChk" name="check_val[]" value="user_edit" <?php echo in_array('user_edit', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input userChk" name="check_val[]" value="user_view" <?php echo in_array('user_view', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input userChk" name="check_val[]" value="user_delete" <?php echo in_array('user_delete', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input data-item="8" type="checkbox" class="accessModule form-check-input" name="heading_val[]" value="category_list" <?php echo in_array('category_list', $role_heading) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td><strong>Category</strong></td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input categoryChk" name="check_val[]" value="category_add" <?php echo in_array('category_add', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input categoryChk" name="check_val[]" value="category_edit" <?php echo in_array('category_edit', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input categoryChk" name="check_val[]" value="category_view" <?php echo in_array('category_view', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input categoryChk" name="check_val[]" value="category_delete" <?php echo in_array('category_delete', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input data-item="9" type="checkbox" class="accessModule form-check-input" name="heading_val[]" value="banner_list" <?php echo in_array('banner_list', $role_heading) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td><strong>Ad Banner</strong></td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input bannerChk" name="check_val[]" value="banner_add" <?php echo in_array('banner_add', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input bannerChk" name="check_val[]" value="banner_edit" <?php echo in_array('banner_edit', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input bannerChk" name="check_val[]" value="banner_view" <?php echo in_array('banner_view', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input bannerChk" name="check_val[]" value="banner_delete" <?php echo in_array('banner_delete', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input data-item="11" type="checkbox" class="accessModule form-check-input" name="heading_val[]" value="demographic_list" <?php echo in_array('demographic_list', $role_heading) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td><strong>Demographic</strong></td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input demographicChk" name="check_val[]" value="demographic_add" <?php echo in_array('demographic_add', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input demographicChk" name="check_val[]" value="demographic_edit" <?php echo in_array('demographic_edit', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input demographicChk" name="check_val[]" value="demographic_view" <?php echo in_array('demographic_view', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input demographicChk" name="check_val[]" value="demographic_delete" <?php echo in_array('demographic_delete', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input data-item="12" type="checkbox" name="heading_val[]" value="pages_list" class="accessModule form-check-input" <?php echo in_array('pages_list', $role_heading) ? 'checked' : ''; ?> />
                                                    </div>
                                                </td>
                                                <td><strong>Pages</strong></td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" name="check_val[]" value="pages_add" class="form-check-input pagesChk checkVal" <?php echo in_array('pages_add', $role_list) ? 'checked' : ''; ?> />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" name="check_val[]" value="pages_edit" class="form-check-input pagesChk checkVal" <?php echo in_array('pages_edit', $role_list) ? 'checked' : ''; ?> />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" name="check_val[]" value="pages_view" class="form-check-input pagesChk checkVal" <?php echo in_array('pages_view', $role_list) ? 'checked' : ''; ?> />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" name="check_val[]" value="pages_delete" class="form-check-input pagesChk checkVal" <?php echo in_array('pages_delete', $role_list) ? 'checked' : ''; ?> />
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="table-responsive mb-1">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th style="width:50px;"></th>
                                                <th><strong>Module</strong></th>
                                                <th><strong>Payment</strong></th>
                                                <th><strong>Customer</strong></th>
                                                <th><strong>Reports</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input data-item="10" type="checkbox" class="accessModule form-check-input" name="heading_val[]" value="manage_list" <?php echo in_array('manage_list', $role_heading) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td><strong>Manage</strong></td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input manageChk" name="check_val[]" value="manage_payment" <?php echo in_array('manage_payment', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input manageChk" name="check_val[]" value="manage_customer" <?php echo in_array('manage_customer', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-success">
                                                        <input type="checkbox" class="form-check-input manageChk" name="check_val[]" value="manage_report" <?php echo in_array('manage_report', $role_list) ? 'checked' : ''; ?>/>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                
                                <div class="col-12">
                                    <input type="hidden" id="n_id" name="n_id" class="n_id" value="<?php echo $n_id; ?>">
                                    <input type="hidden" id="method" name="method" class="method" value="<?php echo $method; ?>">
                                    <input type="hidden" id="formpage" name="formpage" class="formpage" value="<?php echo $formpage; ?>">

                                    <button type="submit" class="btn btn-primary form_submit me-1">
                                        <span class="first_btn show">Submit</span>
                                        <span class="span_btn hide">Loading....</span>
                                    </button>
                                </div>
                            </form>                                
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>