<?php
    // echo ;die();
    $n_id = isset($dataval->n_id)?$dataval->n_id:'';
    $n_role = isset($dataval->n_role)?$dataval->n_role:'';
    // $c_filter_role = $this->session->userdata('n_accessible_role');
    $n_accessible_role = isset($dataval->n_accessible_role)?$dataval->n_accessible_role:'';
    $n_status = isset($dataval->n_status)?$dataval->n_status:'';
    $c_full_name = isset($dataval->c_full_name)?$dataval->c_full_name:'';
    $c_short_name = isset($dataval->c_short_name)?$dataval->c_short_name:'';
    $c_emailid = isset($dataval->c_emailid)?$dataval->c_emailid:'';
    $c_contact_number = isset($dataval->c_contact_number)?$dataval->c_contact_number:'';

    $c_contact_number_pre = '';
    if(!empty($c_contact_number))
    {
        $c_contact_number_pre = substr($c_contact_number, 0,2);
    }
    // echo $c_contact_number_pre;die();

    $n_is_other = isset($dataval->n_is_other)?$dataval->n_is_other:'';
    $c_whatsapp = isset($dataval->c_whatsapp)?$dataval->c_whatsapp:'';

    $c_whatsapp_pre = '';
    if(!empty($c_whatsapp))
    {
        $c_whatsapp_pre = substr($c_whatsapp, 0,2);
    }

    $c_line_pre = '';
    $c_line = isset($dataval->c_line)?$dataval->c_line:'';
    if(!empty($c_line))
    {
        $c_line_pre = substr($c_line, 0,2);
    }

    $c_address = isset($dataval->c_address)?$dataval->c_address:'';
    // var_dump($dataval);
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
                                    <div class="col-md-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="first-name-column">User role <span class="text-danger">*</span></label>
                                            <select class="select2 form-select" name="n_role">
                                                <option value="0">Select role</option>
                                                <?php
                                                    if(!empty($role_val))
                                                    {
                                                        foreach ($role_val as $key => $val_1) {
                                                            $r_id         = empty_check($val_1['n_id']);
                                                            $c_role_title = empty_check($val_1['c_role_title']);

                                                            $select = '';
                                                            if($n_role == $r_id || sizeof($role_val)==1 )
                                                            {
                                                                $select = 'selected';
                                                            }

                                                            echo '<option value="'.$r_id.'" '.$select.'>'.$c_role_title.'</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php if($this->session->userdata('n_id')==1): ?>
                                    <div class="col-md-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="first-name-column">Accessible role(s) 
                                                <i class="icon-info" data-bs-toggle="tooltip" data-bs-placement="top" title="User can also create users with respective role"></i>
                                            </label>
                                            <select class="select2 form-select" name="n_accessible_role[]" multiple>
                                                <optgroup label="Accessible role">
                                                <?php
                                                    $n_accessible_ = explode(",", $n_accessible_role);
                                                    if(!empty($n_accessible_))
                                                    {
                                                        foreach ($role_val as $key => $val_1) {
                                                            $r_id         = empty_check($val_1['n_id']);
                                                            $c_role_title = empty_check($val_1['c_role_title']);

                                                            $select = '';
                                                            if($method=='_Edit'):
                                                                if(in_array($r_id, $n_accessible_))
                                                                {
                                                                    $select = 'selected';
                                                                }
                                                            endif;

                                                            echo '<option value="'.$r_id.'" '.$select.'>'.$c_role_title.'</option>';
                                                        }
                                                    }
                                                ?>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="first-name-column">Full Name <span class="text-danger">*</span></label>
                                            <input type="text" id="first-name-column" class="form-control input_field" placeholder="Enter full name" name="c_full_name" value="<?php echo $c_full_name; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="first-name-column">Short Name <span class="text-danger">*</span></label>
                                            <input type="text" id="first-name-column" class="form-control input_field" placeholder="Enter short name" name="c_short_name" value="<?php echo $c_short_name; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4 country_lists">
                                        <div class="mb-1 position-relative">
                                            <label class="form-label" for="first-name-column">Contact Number <span class="text-danger">*</span></label>
                                            <input maxlength="10" type="text" id="first-name-column" class="form-control input_field" placeholder="Contact Number" name="c_contact_number" value="<?php echo !empty($c_contact_number) ? substr($c_contact_number,2) : '' ; ?>"/>

                                            <div class="country_list">
                                                <select class="form-control" name="c_contact_number_pre">
                                                    <option <?php echo $c_contact_number_pre==91? 'selected' : ''; ?> value="1">(+91)</option>
                                                    <option <?php echo $c_contact_number_pre==66? 'selected' : ''; ?> value="2">(+66)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-1 mt-8">
                                            <div class="d-flex flex-column">
                                                <label class="form-label mb-50" for="n_is_social">WhatsApp/Line</label>
                                                <div class="form-check form-switch form-check-primary">
                                                    <input type="checkbox" class="form-check-input" 
                                                        id="n_is_social" 
                                                        value="<?php echo $n_is_other ? $n_is_other : '1'; ?>" 
                                                        <?php 
                                                        if($method=='_Edit'):
                                                            echo $n_is_other==2 ? '' : 'checked';
                                                        else:
                                                            echo 'checked';
                                                        endif;
                                                         ?>
                                                        name="n_is_other"
                                                    />
                                                    <label class="form-check-label" for="n_is_social">
                                                        <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                        <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7" style="display: <?php echo $n_is_other==2 ? 'block' : 'none'; ?>;" id="isSocial">
                                        <div class="row clearfix">
                                            <div class="col-md-6 country_lists">
                                                <div class="mb-1 position-relative">
                                                    <label class="form-label" for="first-name-column">WhatsApp Number <span class="text-danger">*</span></label>
                                                    <input type="text" id="first-name-column" class="form-control input_field" placeholder="WhatsApp Number" name="c_whatsapp" value="<?php echo !empty($c_whatsapp) ? substr($c_whatsapp,2) :''; ?>"/>
                                                    <div class="country_list">
                                                        <select class="form-control" name="c_whatsapp_pre">
                                                            <option <?php echo $c_whatsapp_pre==91? 'selected' : ''; ?> value="1">(+91)</option>
                                                            <option <?php echo $c_whatsapp_pre==66? 'selected' : ''; ?> value="2">(+66)</option>
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6 country_lists">
                                                <div class="mb-1 position-relative">
                                                    <label class="form-label" for="first-name-column">Line Number </label>
                                                    <input type="text" id="first-name-column" class="form-control input_field" placeholder="ine Number" name="c_line" value="<?php echo !empty($c_line) ? substr($c_line,2) : ''; ?>"/>
                                                    <div class="country_list">
                                                        <select class="form-control" name="c_line_pre">
                                                            <option <?php echo $c_line_pre==91? 'selected' : ''; ?> value="1">(+91)</option>
                                                            <option <?php echo $c_line_pre==66? 'selected' : ''; ?> value="2">(+66)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="first-name-column">Email Id <span class="text-danger">*</span></label>
                                            <input type="text" id="first-name-column" class="form-control input_field" placeholder="Email Id" name="c_emailid" value="<?php echo $c_emailid; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="first-name-column">Password 
                                                <?php if($method=='_Create'): ?>
                                                    <span class="text-danger">*</span>
                                                <?php endif; ?>
                                            </label>
                                            <input type="password" id="first-name-column" class="form-control input_field" placeholder="Enter password" name="c_password"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="first-name-column">Communication address</label>
                                            <textarea placeholder="Enter communication address" class="form-control" name="c_address"><?php echo $c_address; ?></textarea>
                                        </div>
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
                            </form>  
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>