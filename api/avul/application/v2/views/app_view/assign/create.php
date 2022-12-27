<?php
    $n_id         = isset($dataval->n_id)?$dataval->n_id:'';
    $n_status     = isset($dataval->n_status)?$dataval->n_status:'';    

    // print_r($vendor_list);die();
    // print_r($geo_list);die();
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
                        <a class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" href="<?php echo BASE_URL.$pre_menu; ?>"><?php echo $pre_title; ?></a>
                    </div>
                </div>
            </div>
        </div>

        <section id="multiple-column-form" class="maintain-vendor">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title m-0"><?php echo $page_title; ?></h4>
                        </div>
                        <div class="card-body">                               
                            <form id="form_data" class="form_data socialDiv" name="form_data" method="post">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="first-name-column">Users <span class="text-danger">*</span></label>
                                            <select class="select2 form-select" name="n_user">
                                                <option value="0">Select user</option>
                                                <?php
                                                    if(!empty($user_list))
                                                    {
                                                        foreach ($user_list as $key => $val_1) {
                                                            $n_id         = empty_check($val_1->n_id);
                                                            $c_full_name = empty_check($val_1->c_full_name);
                                                            $c_short_name = empty_check($val_1->c_short_name);
                                                            $c_role_name = empty_check($val_1->c_role_name);
                                                            $select = '';
                                                            if($n_role == $n_id || sizeof($user_list)==1 )
                                                            {
                                                                $select = 'selected';
                                                            }
                                                            echo '<option value="'.$n_id.'" '.$select.'>'.$c_full_name.' '.$c_short_name.' ['.$c_role_name.']</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="first-name-column">Vendor(s) <span class="text-danger">*</span></label>
                                            <select class="select2 form-select" name="n_vendor[]" multiple>
                                                <optgroup label="Select Vendor">
                                                <?php
                                                    if(!empty($vendor_list))
                                                    {
                                                        foreach ($vendor_list as $vendor_) {
                                                            $r_id         = empty_check($vendor_->n_id);
                                                            $c_name = empty_check($vendor_->c_name);
                                                            $c_supervisior = empty_check($vendor_->c_supervisior);
                                                            $c_agent = empty_check($vendor_->c_agent);

                                                            $select = '';
                                                            // if($method=='_Edit'):
                                                            //     if(in_array($r_id, $n_accessible_))
                                                            //     {
                                                            //         $select = 'selected';
                                                            //     }
                                                            // endif;
                                                            echo '<option value="'.$r_id.'" '.$select.'>'.$c_name.(' [Supervisior-'.($c_supervisior ? $c_supervisior : '-Nil').']') .(' [Agent-'.($c_agent ? $c_agent : '-Nil').']').'</option>';
                                                        }
                                                    }
                                                ?>
                                                </optgroup>
                                            </select>
                                        </div>
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
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>