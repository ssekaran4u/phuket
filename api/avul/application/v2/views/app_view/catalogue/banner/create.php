<?php
    $n_id           = !empty($dataval->n_id)?$dataval->n_id:'';
    $c_banner       = !empty($dataval->c_banner)?$dataval->c_banner:'';
    $c_short_code   = !empty($dataval->c_short_code)?$dataval->c_short_code:'';
    $c_banner_link  = !empty($dataval->c_banner_link)?$dataval->c_banner_link:'';
    $n_banner_type  = !empty($dataval->n_banner_type)?$dataval->n_banner_type:'';
    $n_banner_pos  = !empty($dataval->n_banner_pos)?$dataval->n_banner_pos:'';
    $dt_start_date  = !empty($dataval->dt_start_date)?view_date($dataval->dt_start_date):'';
    $dt_end_date    = !empty($dataval->dt_end_date)?view_date($dataval->dt_end_date):'';
    $c_banner_image = !empty($dataval->c_banner_image)?$dataval->c_banner_image:'';
    $n_status       = !empty($dataval->n_status)?$dataval->n_status:'';

    if(!empty($c_banner_image))
    {
        $img_value = IMG_URL.'banner/'.$c_banner_image;
    }
    else
    {
        $img_value = BASE_URL.'app-assets/images/img_icon.png';
    }

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
                        <?php if($page_access): ?>
                        <div class="mb-1 breadcrumb-right">
                            <div class="dropdown">
                                <a class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" href="<?php echo BASE_URL.$pre_menu; ?>"><?php echo $pre_title; ?></a>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"><?php echo $page_title; ?></h4>
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

                                        <div class="row">
                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Banner Name <span class="text-danger">*</span></label>
                                                    <input type="text" id="first-name-column" class="form-control input_field" placeholder="Banner Name" name="c_banner" value="<?php echo $c_banner; ?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Banner Type</label>
                                                    <select class="select2 form-select n_banner_type" name="n_banner_type">
                                                        <option value="0">Select Option</option>
                                                        <option value="1" <?php if($n_banner_type == '1')echo 'selected';?>>Parmanent</option>
                                                        <option value="2" <?php if($n_banner_type == '2')echo 'selected';?>>Temporary</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Start Date <span class="text-danger required hide">*</span></label>
                                                    <input type="text" id="fp-default" class="form-control flatpickr-add flatpickr-input active date-picker" name="dt_start_date" placeholder="DD-MM-YYYY" value="<?php echo $dt_start_date; ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">End Date <span class="text-danger required hide">*</span></label>
                                                    <input type="text" id="fp-default" class="form-control flatpickr-add flatpickr-input active date-picker" name="dt_end_date" placeholder="DD-MM-YYYY" value="<?php echo $dt_end_date?>" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Banner Position <span class="text-danger">*</span> </label>
                                                    <select class="select2 form-select n_banner_pos" name="n_banner_pos">
                                                        <option value="0">Select Option</option>
                                                        <option value="1" <?php if($n_banner_pos == '1')echo 'selected';?>>Home Screen</option>
                                                        <option value="2" <?php if($n_banner_pos == '2')echo 'selected';?>>Inner Screen</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Category</label>
                                                    <select class="select2 form-select" name="n_category">
                                                        <option value="">Select Option</option>
                                                        <?php echo $category_val; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Banner Link <span class="text-danger">*</span></label>
                                                    <input type="text" id="first-name-column" class="form-control input_field" placeholder="Banner Link" name="c_banner_link" value="<?php echo $c_banner_link; ?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <div class="d-flex">
                                                        <a href="#" class="me-25">
                                                        <img src="<?php echo $img_value; ?>" id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100"/>
                                                        </a>
                                                        <div class="d-flex align-items-end mt-75 ms-1">
                                                            <div>
                                                                <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75 file_upload">Upload</label>
                                                                <input type="file" id="account-upload" name="c_banner_image" class="" hidden accept="image/*" />
                                                                <p class="mb-0">Allowed file types: png, jpg, jpeg.<br> Size : 1920 X 800</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <input type="hidden" id="n_id" name="n_id" class="n_id" value="<?php echo $n_id; ?>">
                                                <input type="hidden" id="method" name="method" class="method" value="<?php echo $method; ?>">
                                                <input type="hidden" id="formpage" name="formpage" class="formpage" value="<?php echo $formpage; ?>">

                                                <button type="submit" class="btn btn-primary form_submit me-1">
                                                    <span class="first_btn show"><i class="icon-check"></i> Submit</span>
                                                    <span class="span_btn hide"><i class="icon-refresh"></i> Loading....</span>
                                                </button>
                                                <!-- <button type="reset" class="btn btn-outline-secondary">Reset</button> -->
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