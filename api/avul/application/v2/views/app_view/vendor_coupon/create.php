<?php
    $n_id = isset($dataval->n_id)?$dataval->n_id:'';
    $n_vendor = isset($dataval->n_vendor)?$dataval->n_vendor:'';
    $n_status = isset($dataval->n_status)?$dataval->n_status:'';

    // echo $super_user;die();

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
                            <form id="form_data" class="form_data socialDiv" name="form_data" method="post">
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
                                <div class="row clearfix">
                                    <div class="col-md-8">
                                        <div class="mb-1">
                                            <label class="form-label" for="first-name-column">Vendor <span class="text-danger">*</span></label>
                                            <select class="select2 form-select" name="n_vendor">
                                                <option value="0">Select vendor</option>
                                                <?php
                                                    if(!empty($vendor_list))
                                                    {
                                                        foreach ($vendor_list as $key => $val_1) {
                                                            $r_id         = empty_check($val_1->n_id);
                                                            $c_name = empty_check($val_1->c_name);
                                                            $c_city = empty_check($val_1->c_city);
                                                            $c_category = empty_check($val_1->c_category);
                                                            $select = '';
                                                            if($n_vendor == $r_id)
                                                            {
                                                                $select = 'selected';
                                                            }

                                                            echo '<option value="'.$r_id.'" '.$select.'>'.$c_name.' / '.$c_city.' / '.$c_city.'</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <div class="table-responsive">
                                            <div class="table_load">
                                                <table class="user-list-table table">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Call to confirm</th>
                                                            <th>Coupon Name</th>
                                                            <th>Spend</th>
                                                            <th>Price</th>
                                                            <th>Discount(%)</th>
                                                            <th>Validity Days</th>
                                                            <th>Supervisor</th>
                                                            <th>Admin</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if($coupon_list):
                                                            foreach ($coupon_list as $key => $coupon_) { 
                                                         ?>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex flex-column mb-1">
                                                                    <label class="form-label mb-50" for="n_coupons_<?php echo $key; ?>"></label>
                                                                    <div class="form-check form-switch form-check-primary">
                                                                        <input type="checkbox" class="form-check-input" id="n_coupons_<?php echo $key; ?>" value="<?php echo $coupon_->n_id; ?>" name="n_coupons[]"
                                                                        <?php if($method == '_Edit'):
                                                                            if(in_array($coupon_->n_id, $dataval_cou_det))
                                                                            {
                                                                                echo 'checked';
                                                                            }
                                                                        endif; ?>
                                                                         />
                                                                        <label class="form-check-label" for="n_coupons_<?php echo $key; ?>">
                                                                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column mb-1">
                                                                    <label class="form-label mb-50" for="n_callto_confirm_<?php echo $key; ?>"></label>
                                                                    <div class="form-check form-switch form-check-primary">
                                                                        <input type="checkbox" class="form-check-input" id="n_callto_confirm_<?php echo $key; ?>" value="<?php echo $coupon_->n_id; ?>" name="n_callto_confirm[]"
                                                                        <?php if($method == '_Edit'):
                                                                            if(in_array($coupon_->n_id, $calltoconfirm))
                                                                            {
                                                                                echo 'checked';
                                                                            }
                                                                        endif; ?>
                                                                         />
                                                                        <label class="form-check-label" for="n_callto_confirm_<?php echo $key; ?>">
                                                                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><?php echo $coupon_->c_coupon;?></td>
                                                            <td><?php echo $coupon_->n_type==2? 'No limit' : 'Min spend';?></td>
                                                            <td><?php echo $coupon_->n_coupon_price;?></td>
                                                            <td><?php echo $coupon_->n_discount_percentage;?></td>
                                                            <td><?php echo $coupon_->n_vailidity;?></td>
                                                            <td>
                                                                <?php 
                                                                if($method == '_Edit') {
                                                                    if(isset($super_user) == $active_user) {?>
                                                                    <div class="d-flex flex-column mb-1">
                                                                        <label class="form-label mb-50" for="n_approve_supervisor_<?php echo $key; ?>"></label>
                                                                        <div class="form-check form-switch form-check-primary">
                                                                            <input type="checkbox" class="form-check-input" id="n_approve_supervisor_<?php echo $key; ?>" value="<?php echo $coupon_->n_id; ?>" name="n_approve_supervisor[]"
                                                                            <?php
                                                                                if(in_array($coupon_->n_id, $approve_supervisor))
                                                                                {
                                                                                    echo 'checked';
                                                                                }
                                                                            ?>
                                                                             />
                                                                            <label class="form-check-label" for="n_approve_supervisor_<?php echo $key; ?>">
                                                                                <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                                                <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <?php } else { echo in_array($coupon_->n_id, $approve_supervisor) ? 'Approved' : 'Pending'; }
                                                                }
                                                                else {
                                                                    echo "---";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php 
                                                                if($method == '_Edit'):
                                                                    if($active_user==1): ?>
                                                                    <div class="d-flex flex-column mb-1">
                                                                        <label class="form-label mb-50" for="n_approve_admin_<?php echo $key; ?>"></label>
                                                                        <div class="form-check form-switch form-check-primary">
                                                                            <input type="checkbox" class="form-check-input" id="n_approve_admin_<?php echo $key; ?>" value="<?php echo $coupon_->n_id; ?>" name="n_approve_admin[]"
                                                                            <?php
                                                                                if(in_array($coupon_->n_id, $approve_admin))
                                                                                {
                                                                                    echo 'checked';
                                                                                }
                                                                            ?>
                                                                             />
                                                                            <label class="form-check-label" for="n_approve_admin_<?php echo $key; ?>">
                                                                                <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                                                <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <?php else:
                                                                    echo in_array($coupon_->n_id, $approve_admin) ? 'Approved' : 'Pending';
                                                                    endif;
                                                                else:
                                                                    echo "---";
                                                                endif;
                                                                  ?>
                                                            </td>
                                                            
                                                            <?php
                                                            // if($this->session->get_userdata()['n_id']==1) {
                                                            //     if($this->session->get_userdata()['n_accessible_role'])
                                                            //     {
                                                            //         echo "<th>Supervisor</th>";
                                                            //         echo "<th>Admin</th>";
                                                            //     }
                                                            // }
                                                            // else {
                                                            //     echo "<th>Supervisor</th>";
                                                            // }
                                                            ?>
                                                        </tr>
                                                        <?php } endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12 mt-2">
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