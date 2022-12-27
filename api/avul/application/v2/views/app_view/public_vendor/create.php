<?php
    $n_id         = isset($dataval->n_id)?$dataval->n_id:'';
    $n_city      = isset($dataval->n_city)?$dataval->n_city:'';
    $n_district      = isset($dataval->n_district)?$dataval->n_district:'';
    $n_town      = isset($dataval->n_town)?$dataval->n_town:'';
    $n_status     = isset($dataval->n_status)?$dataval->n_status:'';

    $n_latitude = isset($dataval->n_latitude) ? $dataval->n_latitude:'';
    $n_longitude = isset($dataval->n_longitude) ? $dataval->n_longitude:'';
    $c_name = isset($dataval->c_name) ? $dataval->c_name:'';
    $c_name_in_thai = isset($dataval->c_name_in_thai) ? $dataval->c_name_in_thai:'';
    $c_mobile_numbers = isset($dataval->c_mobile_numbers) ? explode(",", $dataval->c_mobile_numbers):'';
    $c_emailids = isset($dataval->c_emailids) ? explode(",", $dataval->c_emailids):'';
    $c_address = isset($dataval->c_address) ? $dataval->c_address:'';
    $c_c_full_name = isset($dataval->c_c_full_name) ? $dataval->c_c_full_name:'';
    $c_c_short_name = isset($dataval->c_c_short_name) ? $dataval->c_c_short_name:'';
    $c_c_contact_number = isset($dataval->c_c_contact_number) ? $dataval->c_c_contact_number:'';
    $c_n_is_other = isset($dataval->c_n_is_other) ? $dataval->c_n_is_other:'';

    // echo $c_n_is_other;die();
    $c_c_whatsapp = isset($dataval->c_c_whatsapp) ? $dataval->c_c_whatsapp:'';
    $c_c_line = isset($dataval->c_c_line) ? $dataval->c_c_line:'';
    $c_c_emailid = isset($dataval->c_c_emailid) ? $dataval->c_c_emailid:'';
    $time_str = isset($dataval->j_opening_hours) ? json_decode($dataval->j_opening_hours) :'';
    $c_terms = isset($dataval->c_terms) ? $dataval->c_terms:'';
    
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
                            <form id="form_data" class="form_data" name="form_data" method="post">
                                <div class="accordion accordion-margin" id="accordionMargin">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingMarginOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMarginOne" aria-expanded="false" aria-controls="accordionMarginOne">
                                                Name &amp; Location
                                            </button>
                                        </h2>
                                        <div id="accordionMarginOne" class="accordion-collapse collapse show" aria-labelledby="headingMarginOne" data-bs-parent="#accordionMargin">
                                            <div class="accordion-body">
                                                <div class="row clearfix">
                                                    <div class="col-md-7">
                                                        <div class="row clearfix">
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
                                                            <div class="col-md-6">
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="n_city">City </label>
                                                                    <select class="select2 form-select districtOnChange" id="n_city" name="n_city">
                                                                        <option value="0">Select Option</option>
                                                                        <?php
                                                                            if(!empty($city_val))
                                                                            {
                                                                                foreach ($city_val as $key => $val_1) {
                                                                                    $s_id    = empty_check($val_1->n_id);
                                                                                    $c_city = empty_check($val_1->c_city);

                                                                                    $select = '';
                                                                                    if($n_city == $s_id)
                                                                                    {
                                                                                        $select = 'selected';
                                                                                    }

                                                                                    echo '<option value="'.$s_id.'" '.$select.'>'.$c_city.'</option>';
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="first-name-column">District </label>
                                                                    <select class="select2 form-select townOnChange" id="n_district" name="n_district">
                                                                        <option value="0">Select Option</option>
                                                                        <?php
                                                                            if(!empty($district_val))
                                                                            {
                                                                                foreach ($district_val as $key => $val_1) {
                                                                                    $s_id    = empty_check($val_1->n_id);
                                                                                    $c_district = empty_check($val_1->c_district);

                                                                                    $select = '';
                                                                                    if($n_district == $s_id)
                                                                                    {
                                                                                        $select = 'selected';
                                                                                    }

                                                                                    echo '<option value="'.$s_id.'" '.$select.'>'.$c_district.'</option>';
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="first-name-column">Town </label>
                                                                    <select class="select2 form-select" name="n_town" id="n_town">
                                                                        <option value="">Select Option</option>
                                                                        <?php 
                                                                            if(!empty($town_val))
                                                                            {
                                                                                foreach ($town_val as $key => $val_1) {
                                                                                    $s_id    = empty_check($val_1->n_id);
                                                                                    $c_town = empty_check($val_1->c_town);

                                                                                    $select = '';
                                                                                    if($n_town == $s_id)
                                                                                    {
                                                                                        $select = 'selected';
                                                                                    }

                                                                                    echo '<option value="'.$s_id.'" '.$select.'>'.$c_town.'</option>';
                                                                                }
                                                                            }
                                                                            ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="first-name-column">Category </label>
                                                                    <select class="select2 form-select" name="n_category">
                                                                        <option value="">Select Option</option>
                                                                        <?php echo $category_val; ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="first-name-column">Latitude </label>
                                                                    <input type="text" class="form-control input_field" placeholder="Latitude" id="latitude" name="n_latitude" value="<?php echo !empty($n_latitude) ? $n_latitude : '11.024903' ?>" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="first-name-column">Longitude </label>
                                                                    <input type="text" class="form-control input_field" placeholder="Longitude" id="longitude" name="n_longitude" value="<?php echo !empty($n_longitude) ? $n_longitude : '77.0090556' ?>" />
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="first-name-column">Name <span class="text-danger">*</span></label>
                                                                    <input id="c_name" type="text" class="typeahead form-control input_field" placeholder="Name" name="c_name" value="<?php echo $c_name; ?>" />
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="first-name-column">Name in Thai </label>
                                                                    <input type="text" class="form-control input_field name_in_thai" placeholder="Name in Thai" name="c_name_in_thai" value="<?php echo $c_name_in_thai; ?>"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="first-name-column">Address </label>
                                                                    <textarea name="c_address" id="plocation" class="form-control plocation" placeholder="Address"><?php echo $c_address; ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">


                                                                <div class="country_lists">
                                                                    <div class="mb-1 position-relative">
                                                                        <label class="form-label" for="c_mobile_numbers">Mobile Number </label>
                                                                        <input maxlength="10" type="text" id="c_mobile_numbers" class="form-control input_field numbersOnly" placeholder="Contact Number" name="c_mobile_numbers[]" value="<?php echo !empty($c_mobile_numbers[0]) ? $c_mobile_numbers[0] : ''; ?>" maxlength10/>
                                                                        <div class="country_list">
                                                                            <select class="form-control" name="c_contact_number_pre">
                                                                                <option selected value="2">(+66)</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="additional_mobile">
                                                                    <?php if($method == '_Edit'):
                                                                        if(sizeof($c_mobile_numbers)>1)
                                                                        {
                                                                            unset($c_mobile_numbers[0]);
                                                                            foreach ($c_mobile_numbers as $c_mobile_number) 
                                                                            {
                                                                                echo '<div class="country_lists">
                                                                                    <div class="mb-1 position-relative">
                                                                                        <input maxlength="10" type="text" id="c_mobile_numbers" class="form-control input_field numbersOnly" placeholder="Contact Number" name="c_mobile_numbers[]" value="'.$c_mobile_number.'" maxlength10/>
                                                                                        <div class="country_list top-sb-0">
                                                                                            <select class="form-control" name="c_contact_number_pre">
                                                                                                <option selected value="2">(+66)</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>';
                                                                            }
                                                                        }
                                                                     ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="mb-1">
                                                                    <p><strong class="additional_field" data-access="1">Add more</strong></p>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="first-name-column">Business Email Id</label>
                                                                    <input type="text" class="form-control input_field" placeholder="Business Email Id" name="c_emailids[]" value="<?php echo !empty($c_emailids[0]) ? $c_emailids[0] : ''; ?>" />
                                                                </div>
                                                                <div class="additional_email">
                                                                    <?php if($method == '_Edit'):
                                                                        if(sizeof($c_emailids)>1)
                                                                        {
                                                                            unset($c_emailids[0]);
                                                                            foreach ($c_emailids as $c_emailid) 
                                                                            {
                                                                                echo '<div class="mb-1 position-relative"><input type="email" class="form-control input_field" placeholder="Business Email Id" name="c_emailids[]" value="'.$c_emailid.'"><div class="remove"><i class="icon-trash"></i></div></div>';
                                                                            }
                                                                        }
                                                                     ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="mb-1">
                                                                    <p><strong class="additional_field" data-access="2">Add more</strong></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 col-12">
                                                        <input id="searchInput" style="width: 40%; margin-top: 12px;" class="form-control" type="text" value="" placeholder="Search location"/><br/>
                                                        <div class="map" id="map" style="width: 100%; height: 460px; margin-bottom: 20px;"></div>
                                                    </div>
                                                </div>
                                            <div class="col-12">
                                                <button type="button" class="btn btn-primary me-1 openTwo">
                                                    <span class="first_btn"> <i class="icon-paper-plane"></i> Next</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingMarginTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMarginTwo" aria-expanded="false" aria-controls="accordionMarginTwo">
                                            Contact Information
                                        </button>
                                    </h2>
                                    <div id="accordionMarginTwo" class="accordion-collapse collapse" aria-labelledby="headingMarginTwo" data-bs-parent="#accordionMargin">
                                            <div class="accordion-body">
                                                <div class="row clearfix">
                                                    <div class="col-md-6">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="c_c_full_name">Contact person full name</label>
                                                            <input type="text" class="form-control input_field" id="c_c_full_name" placeholder="Contact Number" name="c_c_full_name" value="<?php echo !empty($c_c_full_name) ? $c_c_full_name : '' ?>" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="c_c_short_name">Contact person short name</label>
                                                            <input type="text" class="form-control input_field" id="c_c_short_name" placeholder="Contact person short name" name="c_c_short_name" value="<?php echo !empty($c_c_short_name) ? $c_c_short_name : '' ?>" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 country_lists">
                                                        <div class="mb-1 position-relative">
                                                            <label class="form-label" for="c_c_contact_number">Contact Number </label>
                                                            <input maxlength="10" type="text" id="c_c_contact_number" class="form-control input_field numbersOnly" placeholder="Contact Number" name="c_c_contact_number" value="<?php echo !empty($c_c_contact_number) ? $c_c_contact_number : ''; ?>" maxlength10/>
                                                            <div class="country_list">
                                                                <select class="form-control">
                                                                    <option selected value="2">(+66)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="mb-1 mt-8">
                                                            <div class="d-flex flex-column">
                                                                <label class="form-label mb-50">WhatsApp/Line</label>
                                                                <div class="form-check form-switch form-check-primary">
                                                                    <input 
                                                                        type="checkbox" 
                                                                        class="form-check-input" 
                                                                        id="n_is_social" 
                                                                        <?php if($method == '_Edit'): ?>
                                                                            <?php echo $c_n_is_other==1 ? 'checked' : ''; ?>
                                                                            value="<?php echo $c_n_is_other; ?>"    
                                                                        <?php else: ?>
                                                                            checked value="1"
                                                                        <?php endif; ?>

                                                                        name="c_n_is_other" />
                                                                    <label class="form-check-label" for="n_is_social">
                                                                        <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                                        <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7"
                                                        <?php if($method == '_Edit'): ?>
                                                            style="display: <?php echo $c_n_is_other==1 ? 'none' : 'block'; ?>;" 
                                                        <?php else: ?>
                                                            style="display: none;" 
                                                        <?php endif; ?> id="isSocial">
                                                        <div class="row clearfix">
                                                            <div class="col-md-6">

                                                                <div class="country_lists">
                                                                    <div class="mb-1 position-relative">
                                                                        <label class="form-label" for="c_c_whatsapp">WhatsApp Number</label>
                                                                        <input maxlength="10" type="text" id="c_c_whatsapp" class="form-control input_field numbersOnly" placeholder="WhatsApp Number" name="c_c_whatsapp" value="<?php echo !empty($c_c_whatsapp) ? $c_c_whatsapp : ''; ?>" maxlength10/>
                                                                        <div class="country_list">
                                                                            <select class="form-control">
                                                                                <option selected value="2">(+66)</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="country_lists">
                                                                    <div class="mb-1 position-relative">
                                                                        <label class="form-label" for="c_c_line">Line Number</label>
                                                                        <input maxlength="10" type="text" id="c_c_line" class="form-control input_field numbersOnly" placeholder="Line Number" name="c_c_line" value="<?php echo !empty($c_c_line) ? $c_c_line : ''; ?>" maxlength10/>
                                                                        <div class="country_list">
                                                                            <select class="form-control">
                                                                                <option selected value="2">(+66)</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="first-name-column">Email Id</label>
                                                            <input type="text" class="form-control input_field" placeholder="Email Id" name="c_c_emailid" value="<?php echo !empty($c_c_emailid) ? $c_c_emailid : '' ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary me-1 openThree">
                                                        <span class="first_btn"> <i class="icon-paper-plane"></i> Next</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingMarginThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMarginThree" aria-expanded="false" aria-controls="accordionMarginThree">
                                                Working Hours
                                            </button>
                                        </h2>
                                        <div id="accordionMarginThree" class="accordion-collapse collapse" aria-labelledby="headingMarginThree" data-bs-parent="#accordionMargin">
                                            <div class="accordion-body">
                                                <div class="row clearfix">
                                                    <div class="col-md-12">
                                                        <label class="form-label" for="first-name-column">Working Hours </label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-1 row height32 n_week_days_1">
                                                            <div class="col-md-1">
                                                                <div class="mt-8 form-check form-check-success">
                                                                    <input data-item="1" type="checkbox" class="fe_working_hrs form-check-input" name="n_sunday" value="1" <?php echo !empty($time_str->n_sunday) || (!empty($time_str->n_sunday_start)>0) || (!empty($time_str->n_sunday_end)>0) ? 'checked' : ''; ?> />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="mt-8">
                                                                    <span>Sunday</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <!--  -->
                                                                <div class="n_week_day_txt_1 mt-8" <?php echo !empty($time_str->n_sunday) || (!empty($time_str->n_sunday_start)>0) || (!empty($time_str->n_sunday_end)>0) ? 'style="display:none"' : ''; ?>>
                                                                    <span>Closed</span>
                                                                </div>
                                                                <!-- dhana -->
                                                                <div data-item="1" class="row clearfix n_week_day_1" <?php echo !empty($time_str->n_sunday) || (!empty($time_str->n_sunday_start)>0) || (!empty($time_str->n_sunday_end)>0) ? '' : 'style="display:none"'; ?>>
                                                                    <div class="col-md-6">
                                                                        <div class="did-floating-label-content init_start">
                                                                            <select data-process="1" name="n_sunday_start" class="c_conflict _start did-floating-select form-control" onclick="this.setAttribute('value', this.value);" onchange="this.setAttribute('value', this.value);" value="<?php echo (!empty($time_str->n_sunday) ? $time_str->n_sunday : '')|| (!empty($time_str->n_sunday_start) ? $time_str->n_sunday_start : ''); ?>">
                                                                                <?php 
                                                                                if($method == '_Edit'):
                                                                                if(!empty($time_str->n_sunday) || !empty($time_str->n_sunday_start))
                                                                                {
                                                                                    foreach ($timing_str as $key => $timing_) 
                                                                                    {
                                                                                        $select_ = '';
                                                                                        if(!empty($time_str->n_sunday_start)) 
                                                                                        {
                                                                                            if($key==$time_str->n_sunday_start)
                                                                                            {
                                                                                                $select_ = 'selected';
                                                                                            }
                                                                                            
                                                                                        }
                                                                                        else if(!empty($time_str->n_sunday) ==$key )
                                                                                        {
                                                                                            if($time_str->n_sunday==$key)
                                                                                            {
                                                                                                $select_ = 'selected';
                                                                                            }
                                                                                        }
                                                                                        echo "<option $select_ value='".$key."'>".$timing_."</option>";
                                                                                    }
                                                                                    echo "<option value='".array_key_last($timing_str)."'>".end($timing_str)."</option>";
                                                                                }
                                                                                endif; ?>
                                                                                
                                                                            </select>
                                                                            <label class="did-floating-label">Opens at</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="did-floating-label-content init_end"  <?php echo !empty($time_str->n_sunday_end)>1 || !empty($time_str->n_sunday)==1 ? 'style="display: none;"' : ''; ?> >
                                                                            <select data-process="2" name="n_sunday_end" class="c_conflict _end did-floating-select form-control" onclick="this.setAttribute('value', this.value);" onchange="this.setAttribute('value', this.value);" value="<?php echo (!empty($time_str->n_sunday_end) ? $time_str->n_sunday_end : ''); ?>">
                                                                             <?php 
                                                                             if($method == '_Edit'):
                                                                             if(!empty($time_str->n_sunday_end) && $time_str->n_sunday_end>1)
                                                                             {
                                                                                foreach ($timing_str as $key => $timing_) 
                                                                                {
                                                                                    $select = '';
                                                                                    if($time_str->n_sunday_end==$key)
                                                                                    {
                                                                                        $select = 'selected';
                                                                                    }
                                                                                    echo "<option $select value='".$key."'>".$timing_."</option>";
                                                                                }

                                                                                echo "<option value='".array_key_last($timing_str)."'>".end($timing_str)."</option>";
                                                                            }
                                                                            endif; ?>
                                                                            </select>
                                                                            <label class="did-floating-label">Closes at</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-1 row height32 n_week_days_2">
                                                            <div class="col-md-1">
                                                                <div class="mt-8 form-check form-check-success">
                                                                    <input data-item="2" type="checkbox" class="fe_working_hrs form-check-input" name="n_monday" value="1" <?php echo !empty($time_str->n_monday) || (!empty($time_str->n_monday_start)>0) || (!empty($time_str->n_monday_end)>0) ? 'checked' : ''; ?>/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="mt-8">
                                                                    <span>Monday</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="n_week_day_txt_2 mt-8" <?php echo !empty($time_str->n_monday) || (!empty($time_str->n_monday_start)>0) || (!empty($time_str->n_monday_end)>0) ? 'style="display:none"' : ''; ?>>
                                                                    <span>Closed</span>
                                                                </div>
                                                                <div data-item="2" class="row clearfix n_week_day_2" <?php echo !empty($time_str->n_monday) || (!empty($time_str->n_monday_start)>0) || (!empty($time_str->n_monday_end)>0) ? '' : 'style="display:none"'; ?>>
                                                                    <div class="col-md-6">
                                                                        <div class="did-floating-label-content init_start">
                                                                            <select data-process="1" name="n_monday_start" class="c_conflict _start did-floating-select form-control" onclick="this.setAttribute('value', this.value);" onchange="this.setAttribute('value', this.value);" value="<?php echo (!empty($time_str->n_monday) ? $time_str->n_monday : '')|| (!empty($time_str->n_monday_start) ? $time_str->n_monday_start : ''); ?>">
                                                                                <?php 
                                                                                if($method == '_Edit'):
                                                                                if(!empty($time_str->n_monday) || !empty($time_str->n_monday_start))
                                                                                {
                                                                                    foreach ($timing_str as $key => $timing_) 
                                                                                    {
                                                                                        $select_ = '';
                                                                                        if(!empty($time_str->n_monday_start)) 
                                                                                        {
                                                                                            if($key==$time_str->n_monday_start)
                                                                                            {
                                                                                                $select_ = 'selected';
                                                                                            }
                                                                                            
                                                                                        }
                                                                                        else if(!empty($time_str->n_monday) ==$key )
                                                                                        {
                                                                                            if($time_str->n_monday==$key)
                                                                                            {
                                                                                                $select_ = 'selected';
                                                                                            }
                                                                                        }
                                                                                        echo "<option $select_ value='".$key."'>".$timing_."</option>";
                                                                                    }
                                                                                    echo "<option value='".array_key_last($timing_str)."'>".end($timing_str)."</option>";
                                                                                }
                                                                                endif; ?>
                                                                            </select>
                                                                            <label class="did-floating-label">Opens at</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="did-floating-label-content init_end" <?php echo !empty($time_str->n_monday_end)>1 || !empty($time_str->n_monday)==1 ? 'style="display: none;"' : ''; ?>>
                                                                            <select data-process="2" name="n_monday_end" class="c_conflict _end did-floating-select form-control" onclick="this.setAttribute('value', this.value);" onchange="this.setAttribute('value', this.value);" value="<?php echo (!empty($time_str->n_monday_end) ? $time_str->n_monday_end : ''); ?>">
                                                                                <?php 
                                                                             if($method == '_Edit'):
                                                                             if(!empty($time_str->n_monday_end) && $time_str->n_monday_end>1)
                                                                             {
                                                                                foreach ($timing_str as $key => $timing_) 
                                                                                {
                                                                                    $select = '';
                                                                                    if($time_str->n_monday_end==$key)
                                                                                    {
                                                                                        $select = 'selected';
                                                                                    }
                                                                                    echo "<option $select value='".$key."'>".$timing_."</option>";
                                                                                }

                                                                                echo "<option value='".array_key_last($timing_str)."'>".end($timing_str)."</option>";
                                                                            }
                                                                            endif; ?>
                                                                            </select>
                                                                            <label class="did-floating-label">Closes at</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-1 row height32 n_week_days_3">
                                                            <div class="col-md-1">
                                                                <div class="mt-8 form-check form-check-success">
                                                                    <input data-item="3" type="checkbox" class="fe_working_hrs form-check-input" name="n_tuesday" value="1" <?php echo !empty($time_str->n_tuesday) || (!empty($time_str->n_tuesday_start)>0) || (!empty($time_str->n_tuesday_end)>0) ? 'checked' : ''; ?> />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="mt-8">
                                                                    <span>Tuesday</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="n_week_day_txt_3 mt-8" <?php echo !empty($time_str->n_tuesday) || (!empty($time_str->n_tuesday_start)>0) || (!empty($time_str->n_tuesday_end)>0) ? 'style="display:none"' : ''; ?>>
                                                                    <span>Closed</span>
                                                                </div>
                                                                <div data-item="3" class="row clearfix n_week_day_3" <?php echo !empty($time_str->n_tuesday) || (!empty($time_str->n_tuesday_start)>0) || (!empty($time_str->n_tuesday_end)>0) ? '' : 'style="display:none"'; ?>>
                                                                    <div class="col-md-6">
                                                                        <div class="did-floating-label-content init_start">
                                                                            <select data-process="1" name="n_tuesday_start" class="c_conflict _start did-floating-select form-control" onclick="this.setAttribute('value', this.value);" onchange="this.setAttribute('value', this.value);" value="<?php echo (!empty($time_str->n_tuesday) ? $time_str->n_tuesday : '')|| (!empty($time_str->n_tuesday_start) ? $time_str->n_tuesday_start : ''); ?>">
                                                                                <?php 
                                                                                if($method == '_Edit'):
                                                                                if(!empty($time_str->n_tuesday) || !empty($time_str->n_tuesday_start))
                                                                                {
                                                                                    foreach ($timing_str as $key => $timing_) 
                                                                                    {
                                                                                        $select_ = '';
                                                                                        if(!empty($time_str->n_tuesday_start)) 
                                                                                        {
                                                                                            if($key==$time_str->n_tuesday_start)
                                                                                            {
                                                                                                $select_ = 'selected';
                                                                                            }
                                                                                            
                                                                                        }
                                                                                        else if(!empty($time_str->n_tuesday) ==$key )
                                                                                        {
                                                                                            if($time_str->n_tuesday==$key)
                                                                                            {
                                                                                                $select_ = 'selected';
                                                                                            }
                                                                                        }
                                                                                        echo "<option $select_ value='".$key."'>".$timing_."</option>";
                                                                                    }
                                                                                    echo "<option value='".array_key_last($timing_str)."'>".end($timing_str)."</option>";
                                                                                }
                                                                                endif; ?>
                                                                            </select>
                                                                            <label class="did-floating-label">Opens at</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="did-floating-label-content init_end" <?php echo !empty($time_str->n_tuesday_end)>1 || !empty($time_str->n_tuesday)==1 ? 'style="display: none;"' : ''; ?>>
                                                                            <select data-process="2" name="n_tuesday_end" class="c_conflict _end did-floating-select form-control" onclick="this.setAttribute('value', this.value);" onchange="this.setAttribute('value', this.value);" value="<?php echo (!empty($time_str->n_tuesday_end) ? $time_str->n_tuesday_end : ''); ?>">
                                                                                <?php 
                                                                             if($method == '_Edit'):
                                                                             if(!empty($time_str->n_tuesday_end) && $time_str->n_tuesday_end>1)
                                                                             {
                                                                                foreach ($timing_str as $key => $timing_) 
                                                                                {
                                                                                    $select = '';
                                                                                    if($time_str->n_tuesday_end==$key)
                                                                                    {
                                                                                        $select = 'selected';
                                                                                    }
                                                                                    echo "<option $select value='".$key."'>".$timing_."</option>";
                                                                                }

                                                                                echo "<option value='".array_key_last($timing_str)."'>".end($timing_str)."</option>";
                                                                            }
                                                                            endif; ?>
                                                                            </select>
                                                                            <label class="did-floating-label">Closes at</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-1 row height32 n_week_days_4">
                                                            <div class="col-md-1">
                                                                <div class="mt-8 form-check form-check-success">
                                                                    <input data-item="4" type="checkbox" class="fe_working_hrs form-check-input" name="n_wednesday" value="1" <?php echo !empty($time_str->n_wednesday) || (!empty($time_str->n_wednesday_start)>0) || (!empty($time_str->n_wednesday_end)>0) ? 'checked' : ''; ?>/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="mt-8">
                                                                    <span>Wednesday</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="n_week_day_txt_4 mt-8" <?php echo !empty($time_str->n_wednesday) || (!empty($time_str->n_wednesday_start)>0) || (!empty($time_str->n_wednesday_end)>0) ? 'style="display:none"' : ''; ?>>
                                                                    <span>Closed</span>
                                                                </div>
                                                                <div data-item="4" class="row clearfix n_week_day_4" <?php echo !empty($time_str->n_wednesday) || (!empty($time_str->n_wednesday_start)>0) || (!empty($time_str->n_wednesday_end)>0) ? '' : 'style="display:none"'; ?>>
                                                                    <div class="col-md-6">
                                                                        <div class="did-floating-label-content init_start">
                                                                            <select data-process="1" name="n_wednesday_start" class="c_conflict _start did-floating-select form-control" onclick="this.setAttribute('value', this.value);" onchange="this.setAttribute('value', this.value);" value="<?php echo (!empty($time_str->n_wednesday) ? $time_str->n_wednesday : '')|| (!empty($time_str->n_wednesday_start) ? $time_str->n_wednesday_start : ''); ?>">
                                                                                <?php 
                                                                                if($method == '_Edit'):
                                                                                if(!empty($time_str->n_wednesday) || !empty($time_str->n_wednesday_start))
                                                                                {
                                                                                    foreach ($timing_str as $key => $timing_) 
                                                                                    {
                                                                                        $select_ = '';
                                                                                        if(!empty($time_str->n_wednesday_start)) 
                                                                                        {
                                                                                            if($key==$time_str->n_wednesday_start)
                                                                                            {
                                                                                                $select_ = 'selected';
                                                                                            }
                                                                                            
                                                                                        }
                                                                                        else if(!empty($time_str->n_wednesday) ==$key )
                                                                                        {
                                                                                            if($time_str->n_wednesday==$key)
                                                                                            {
                                                                                                $select_ = 'selected';
                                                                                            }
                                                                                        }
                                                                                        echo "<option $select_ value='".$key."'>".$timing_."</option>";
                                                                                    }
                                                                                    echo "<option value='".array_key_last($timing_str)."'>".end($timing_str)."</option>";
                                                                                }
                                                                                endif; ?>
                                                                            </select>
                                                                            <label class="did-floating-label">Opens at</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="did-floating-label-content init_end" <?php echo !empty($time_str->n_wednesday_end)>1 || !empty($time_str->n_wednesday)==1 ? 'style="display: none;"' : ''; ?>>
                                                                            <select data-process="2" name="n_wednesday_end" class="c_conflict _end did-floating-select form-control" onclick="this.setAttribute('value', this.value);" onchange="this.setAttribute('value', this.value);" value="<?php echo (!empty($time_str->n_wednesday_end) ? $time_str->n_wednesday_end : ''); ?>">
                                                                                <?php 
                                                                             if($method == '_Edit'):
                                                                             if(!empty($time_str->n_wednesday_end) && $time_str->n_wednesday_end>1)
                                                                             {
                                                                                foreach ($timing_str as $key => $timing_) 
                                                                                {
                                                                                    $select = '';
                                                                                    if($time_str->n_wednesday_end==$key)
                                                                                    {
                                                                                        $select = 'selected';
                                                                                    }
                                                                                    echo "<option $select value='".$key."'>".$timing_."</option>";
                                                                                }

                                                                                echo "<option value='".array_key_last($timing_str)."'>".end($timing_str)."</option>";
                                                                            }
                                                                            endif; ?>
                                                                            </select>
                                                                            <label class="did-floating-label">Closes at</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-1 row height32 n_week_days_5">
                                                            <div class="col-md-1">
                                                                <div class="mt-8 form-check form-check-success">
                                                                    <input data-item="5" type="checkbox" class="fe_working_hrs form-check-input" name="n_thursday" value="1" <?php echo !empty($time_str->n_thursday) || (!empty($time_str->n_thursday_start)>0) || (!empty($time_str->n_thursday_end)>0) ? 'checked' : ''; ?>/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="mt-8">
                                                                    <span>Thursday</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="n_week_day_txt_5 mt-8" <?php echo !empty($time_str->n_thursday) || (!empty($time_str->n_thursday_start)>0) || (!empty($time_str->n_thursday_end)>0) ? 'style="display:none"' : ''; ?>>
                                                                    <span>Closed</span>
                                                                </div>
                                                                <div data-item="5" class="row clearfix n_week_day_5" <?php echo !empty($time_str->n_thursday) || (!empty($time_str->n_thursday_start)>0) || (!empty($time_str->n_thursday_end)>0) ? '' : 'style="display:none"'; ?>>
                                                                    <div class="col-md-6">
                                                                        <div class="did-floating-label-content init_start">
                                                                            <select data-process="1" name="n_thursday_start" class="c_conflict _start did-floating-select form-control" onclick="this.setAttribute('value', this.value);" onchange="this.setAttribute('value', this.value);" value="<?php echo (!empty($time_str->n_thursday) ? $time_str->n_thursday : '')|| (!empty($time_str->n_thursday_start) ? $time_str->n_thursday_start : ''); ?>">
                                                                                <?php 
                                                                                if($method == '_Edit'):
                                                                                if(!empty($time_str->n_thursday) || !empty($time_str->n_thursday_start))
                                                                                {
                                                                                    foreach ($timing_str as $key => $timing_) 
                                                                                    {
                                                                                        $select_ = '';
                                                                                        if(!empty($time_str->n_thursday_start)) 
                                                                                        {
                                                                                            if($key==$time_str->n_thursday_start)
                                                                                            {
                                                                                                $select_ = 'selected';
                                                                                            }
                                                                                            
                                                                                        }
                                                                                        else if(!empty($time_str->n_thursday) ==$key )
                                                                                        {
                                                                                            if($time_str->n_thursday==$key)
                                                                                            {
                                                                                                $select_ = 'selected';
                                                                                            }
                                                                                        }
                                                                                        echo "<option $select_ value='".$key."'>".$timing_."</option>";
                                                                                    }
                                                                                    echo "<option value='".array_key_last($timing_str)."'>".end($timing_str)."</option>";
                                                                                }
                                                                                endif; ?>
                                                                            </select>
                                                                            <label class="did-floating-label">Opens at</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="did-floating-label-content init_end" <?php echo !empty($time_str->n_thursday_end)>1 || !empty($time_str->n_thursday)==1 ? 'style="display: none;"' : ''; ?>>
                                                                            <select data-process="2" name="n_thursday_end" class="c_conflict _end did-floating-select form-control" onclick="this.setAttribute('value', this.value);" onchange="this.setAttribute('value', this.value);" value="<?php echo (!empty($time_str->n_thursday_end) ? $time_str->n_thursday_end : ''); ?>">
                                                                                <?php 
                                                                             if($method == '_Edit'):
                                                                             if(!empty($time_str->n_thursday_end) && $time_str->n_thursday_end>1)
                                                                             {
                                                                                foreach ($timing_str as $key => $timing_) 
                                                                                {
                                                                                    $select = '';
                                                                                    if($time_str->n_thursday_end==$key)
                                                                                    {
                                                                                        $select = 'selected';
                                                                                    }
                                                                                    echo "<option $select value='".$key."'>".$timing_."</option>";
                                                                                }

                                                                                echo "<option value='".array_key_last($timing_str)."'>".end($timing_str)."</option>";
                                                                            }
                                                                            endif; ?>
                                                                            </select>
                                                                            <label class="did-floating-label">Closes at</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-1 row height32 n_week_days_6">
                                                            <div class="col-md-1">
                                                                <div class="mt-8 form-check form-check-success">
                                                                    <input data-item="6" type="checkbox" class="fe_working_hrs form-check-input" name="n_friday" value="1" <?php echo !empty($time_str->n_friday) || (!empty($time_str->n_friday_start)>0) || (!empty($time_str->n_friday_end)>0) ? 'checked' : ''; ?>/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="mt-8">
                                                                    <span>Friday</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="n_week_day_txt_6 mt-8" <?php echo !empty($time_str->n_friday) || (!empty($time_str->n_friday_start)>0) || (!empty($time_str->n_friday_end)>0) ? 'style="display:none"' : ''; ?>>
                                                                    <span>Closed</span>
                                                                </div>
                                                                <div data-item="6" class="row clearfix n_week_day_6" <?php echo !empty($time_str->n_friday) || (!empty($time_str->n_friday_start)>0) || (!empty($time_str->n_friday_end)>0) ? '' : 'style="display:none"'; ?>>
                                                                    <div class="col-md-6">
                                                                        <div class="did-floating-label-content init_start">
                                                                            <select data-process="1" name="n_friday_start" class="c_conflict _start did-floating-select form-control" onclick="this.setAttribute('value', this.value);" onchange="this.setAttribute('value', this.value);" value="<?php echo (!empty($time_str->n_friday) ? $time_str->n_friday : '')|| (!empty($time_str->n_friday_start) ? $time_str->n_friday_start : ''); ?>">
                                                                                <?php 
                                                                                if($method == '_Edit'):
                                                                                if(!empty($time_str->n_friday) || !empty($time_str->n_friday_start))
                                                                                {
                                                                                    foreach ($timing_str as $key => $timing_) 
                                                                                    {
                                                                                        $select_ = '';
                                                                                        if(!empty($time_str->n_friday_start)) 
                                                                                        {
                                                                                            if($key==$time_str->n_friday_start)
                                                                                            {
                                                                                                $select_ = 'selected';
                                                                                            }
                                                                                            
                                                                                        }
                                                                                        else if(!empty($time_str->n_friday) ==$key )
                                                                                        {
                                                                                            if($time_str->n_friday==$key)
                                                                                            {
                                                                                                $select_ = 'selected';
                                                                                            }
                                                                                        }
                                                                                        echo "<option $select_ value='".$key."'>".$timing_."</option>";
                                                                                    }
                                                                                    echo "<option value='".array_key_last($timing_str)."'>".end($timing_str)."</option>";
                                                                                }
                                                                                endif; ?>
                                                                            </select>
                                                                            <label class="did-floating-label">Opens at</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="did-floating-label-content init_end" <?php echo !empty($time_str->n_friday_end)>1 || !empty($time_str->n_friday)==1 ? 'style="display: none;"' : ''; ?>>
                                                                            <select data-process="2" name="n_friday_end" class="c_conflict _end did-floating-select form-control" onclick="this.setAttribute('value', this.value);" onchange="this.setAttribute('value', this.value);" value="<?php echo (!empty($time_str->n_friday_end) ? $time_str->n_friday_end : ''); ?>">
                                                                                <?php 
                                                                             if($method == '_Edit'):
                                                                             if(!empty($time_str->n_friday_end) && $time_str->n_friday_end>1)
                                                                             {
                                                                                foreach ($timing_str as $key => $timing_) 
                                                                                {
                                                                                    $select = '';
                                                                                    if($time_str->n_friday_end==$key)
                                                                                    {
                                                                                        $select = 'selected';
                                                                                    }
                                                                                    echo "<option $select value='".$key."'>".$timing_."</option>";
                                                                                }

                                                                                echo "<option value='".array_key_last($timing_str)."'>".end($timing_str)."</option>";
                                                                            }
                                                                            endif; ?>
                                                                            </select>
                                                                            <label class="did-floating-label">Closes at</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-1 row height32 n_week_days_7">
                                                            <div class="col-md-1">
                                                                <div class="mt-8 form-check form-check-success">
                                                                    <input data-item="7" type="checkbox" class="fe_working_hrs form-check-input" name="n_saturday" value="1" <?php echo !empty($time_str->n_saturday) || (!empty($time_str->n_saturday_start)>0) || (!empty($time_str->n_saturday_end)>0) ? 'checked' : ''; ?>/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="mt-8">
                                                                    <span>Saturday</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="n_week_day_txt_7 mt-8" <?php echo !empty($time_str->n_saturday) || (!empty($time_str->n_saturday_start)>0) || (!empty($time_str->n_saturday_end)>0) ? 'style="display:none"' : ''; ?>>
                                                                    <span>Closed</span>
                                                                </div>
                                                                <div data-item="7" class="row clearfix n_week_day_7" <?php echo !empty($time_str->n_saturday) || (!empty($time_str->n_saturday_start)>0) || (!empty($time_str->n_saturday_end)>0) ? '' : 'style="display:none"'; ?>>
                                                                    <div class="col-md-6">
                                                                        <div class="did-floating-label-content init_start">
                                                                            <select data-process="1" name="n_saturday_start" class="c_conflict _start did-floating-select form-control" onclick="this.setAttribute('value', this.value);" onchange="this.setAttribute('value', this.value);" value="<?php echo (!empty($time_str->n_saturday) ? $time_str->n_saturday : '')|| (!empty($time_str->n_saturday_start) ? $time_str->n_saturday_start : ''); ?>">
                                                                                <?php 
                                                                                if($method == '_Edit'):
                                                                                if(!empty($time_str->n_saturday) || !empty($time_str->n_saturday_start))
                                                                                {
                                                                                    foreach ($timing_str as $key => $timing_) 
                                                                                    {
                                                                                        $select_ = '';
                                                                                        if(!empty($time_str->n_saturday_start)) 
                                                                                        {
                                                                                            if($key==$time_str->n_saturday_start)
                                                                                            {
                                                                                                $select_ = 'selected';
                                                                                            }
                                                                                            
                                                                                        }
                                                                                        else if(!empty($time_str->n_saturday) ==$key )
                                                                                        {
                                                                                            if($time_str->n_saturday==$key)
                                                                                            {
                                                                                                $select_ = 'selected';
                                                                                            }
                                                                                        }
                                                                                        echo "<option $select_ value='".$key."'>".$timing_."</option>";
                                                                                    }
                                                                                    echo "<option value='".array_key_last($timing_str)."'>".end($timing_str)."</option>";
                                                                                }
                                                                                endif; ?>
                                                                            </select>
                                                                            <label class="did-floating-label">Opens at</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="did-floating-label-content init_end" <?php echo !empty($time_str->n_saturday_end)>1 || !empty($time_str->n_saturday)==1 ? 'style="display: none;"' : ''; ?>>
                                                                            <select data-process="2" name="n_saturday_end" class="c_conflict _end did-floating-select form-control" onclick="this.setAttribute('value', this.value);" onchange="this.setAttribute('value', this.value);" value="<?php echo (!empty($time_str->n_saturday_end) ? $time_str->n_saturday_end : ''); ?>">
                                                                                <?php 
                                                                             if($method == '_Edit'):
                                                                             if(!empty($time_str->n_saturday_end) && $time_str->n_saturday_end>1)
                                                                             {
                                                                                foreach ($timing_str as $key => $timing_) 
                                                                                {
                                                                                    $select = '';
                                                                                    if($time_str->n_saturday_end==$key)
                                                                                    {
                                                                                        $select = 'selected';
                                                                                    }
                                                                                    echo "<option $select value='".$key."'>".$timing_."</option>";
                                                                                }

                                                                                echo "<option value='".array_key_last($timing_str)."'>".end($timing_str)."</option>";
                                                                            }
                                                                            endif; ?>
                                                                            </select>
                                                                            <label class="did-floating-label">Closes at</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary me-1 openFour">
                                                        <span class="first_btn"> <i class="icon-paper-plane"></i> Next</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingMarginFour">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMarginFour" aria-expanded="false" aria-controls="accordionMarginFour">
                                                Photos / Terms &amp; Conditions
                                            </button>
                                        </h2>
                                        <div id="accordionMarginFour" class="accordion-collapse collapse" aria-labelledby="headingMarginFour" data-bs-parent="#accordionMargin">
                                            <div class="accordion-body">
                                                <div class="row clearfix">
                                                    <div class="col-md-6">
                                                        <div class="mb-1">
                                                            <div class="img_place position-relative">
                                                                <div id="img_list" class="row clearfix list">
                                                                    <?php if(!empty($img_val)): 
                                                                    foreach ($img_val as $key => $val_1) {
                                                                        $img_id  = empty_check($val_1->n_id);
                                                                        $pdt_img = empty_check($val_1->c_listing_img);
                                                                        $pdt_val = IMG_URL.'vendors/'.$pdt_img;

                                                                        echo '<div class="col-md-3 img_'.$key.' row_'.$img_id.'">
                                                                            <div class="img_list mt-8">
                                                                                <img class="thumb plan_img" src="'.$pdt_val.'"/>
                                                                                <span data-directory="app" data-cntrl="vendor" data-func="add" data-key="'.$key.'" data-id="'.$img_id.'" data-pid="'.$n_id.'" class="close close_btn del_btn" data-close>&times;</span>
                                                                            </div>
                                                                        </div>';
                                                                    }
                                                                    endif; ?>
                                                                </div>
                                                                <div class="position-absolute bottom-0 start-0 upload_btn">
                                                                    <input id="file_upload" class="file_upload mt-10" multiple="true" name="c_product_image[]" type="file" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="first-name-column">Terms &amp; Conditions </label>
                                                            <textarea rows="5" name="c_terms" class="form-control plocation" placeholder="Provide terms &amp; conditions"><?php echo $c_terms; ?></textarea>
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

                                                    <!-- <button type="button" class="btn btn-primary me-1">
                                                        <span class="first_btn"> 
                                                            <i class="icon-paper-plane"></i> Submit
                                                        </span>
                                                    </button> -->
                                                </div>
                                            </div>
                                        </div>
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