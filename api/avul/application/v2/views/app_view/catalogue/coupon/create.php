<?php
    $n_id         = !empty($dataval->n_id)?$dataval->n_id:'';
    $c_coupon         = !empty($dataval->c_coupon)?$dataval->c_coupon:'';
    $n_spend_amount   = !empty($dataval->n_spend_amount)?$dataval->n_spend_amount:'';
    $n_discount_percentage = !empty($dataval->n_discount_percentage)?$dataval->n_discount_percentage:'';
    $n_coupon_price         = !empty($dataval->n_coupon_price)?$dataval->n_coupon_price:'';
    $n_vailidity         = !empty($dataval->n_vailidity)?$dataval->n_vailidity:'';
    $c_description   = !empty($dataval->c_description)?$dataval->c_description:'';
    $n_status     = !empty($dataval->n_status)?$dataval->n_status:'';
    $n_type     = !empty($dataval->n_type)?$dataval->n_type:'';
    $n_payable     = !empty($dataval->n_payable)?$dataval->n_payable:'';
    $coupon_img = !empty($dataval->c_image)?$dataval->c_image:'';
    if(!empty($coupon_img))
    {
        $img_value = IMG_URL.'coupon/'.$coupon_img;
    }
    else
    {
        $img_value = BASE_URL.'app-assets/images/img_icon.png';
    }

?>        
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0 coupon-code">
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
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="c_coupon">Title <span class="text-danger">*</span></label>
                                            <input type="text" id="c_coupon" class="typeahead form-control input_field" placeholder="Title" name="c_coupon" value="<?php echo $c_coupon; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-12">
                                        <div class="d-flex flex-column mb-1">
                                            <label class="form-label mb-50" for="n_type">Min spend</label>
                                            <div class="form-check form-switch form-check-primary">
                                                <input type="checkbox" class="form-check-input" 
                                                id="n_type" 
                                                <?php if($method == '_Edit'): ?>
                                                    <?php echo $n_type==1 ? 'checked' : ''; ?>
                                                    value="<?php echo $n_type; ?>"    
                                                <?php else: ?>
                                                    value="1"
                                                <?php endif; ?>
                                                name="n_type" />
                                                <label class="form-check-label" for="n_type">
                                                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12" id="spendingAmount"
                                    <?php if($method == '_Edit'): ?>
                                        style="display: <?php echo $n_type==2 ? 'none' : 'block'; ?>;" 
                                    <?php else: ?>
                                        style="display: none;" 
                                    <?php endif; ?> >
                                        <div class="mb-1">
                                            <label class="form-label" for="n_spend_amount">Spending amount <span class="text-danger">*</span></label>
                                            <input type="text" id="n_spend_amount" class="numbersOnly form-control input_field" placeholder="Spending amount" name="n_spend_amount" value="<?php echo $n_spend_amount; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="n_coupon_price">Coupon price <span class="text-danger">*</span>  </label>
                                            <input type="text" id="n_coupon_price" class="numbersOnly form-control input_field" placeholder="Coupon price" name="n_coupon_price" value="<?php echo $n_coupon_price; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="n_discount_percentage">Discount percentage <span class="text-danger">*</span></label>
                                            <input type="text" id="n_discount_percentage" class="numbersOnly form-control input_field" placeholder="Discount percentage" name="n_discount_percentage" value="<?php echo $n_discount_percentage; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="n_payable">Payable amount <span class="text-danger">*</span></label>
                                            <input type="text" id="n_payable" class="numbersOnly form-control input_field" placeholder="Payable amount" name="n_payable" value="<?php echo $n_payable; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="n_vailidity">Validity <span class="text-danger">*</span></label>
                                            <input type="text" id="n_vailidity" class="numbersOnly form-control input_field" placeholder="Validity in days" name="n_vailidity" value="<?php echo $n_vailidity; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="c_description">Description</label>
                                            <textarea class="form-control text_field" id="c_description" name="c_description" rows="3" placeholder="Description" ><?php echo $c_description; ?></textarea>
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
                                                        <p class="mb-1">Coupon image <span class="text-danger">*</span> </p>
                                                        <label for="account-upload" class="btn btn-sm btn-primary file_upload mb-1">Upload</label>
                                                        <input type="file" id="account-upload" name="c_coupon_image" class="" hidden accept="image/*" />
                                                        <p class="mb-0">Allowed file types: png, jpg, jpeg</p>
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