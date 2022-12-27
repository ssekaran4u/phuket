<?php
    $n_id         = !empty($dataval[0]->n_id)?$dataval[0]->n_id:'';
    $n_parent_id  = !empty($dataval[0]->n_parent_id)?$dataval[0]->n_parent_id:'';
    $c_category   = !empty($dataval[0]->c_category)?$dataval[0]->c_category:'';
    $c_meta_title = !empty($dataval[0]->c_meta_title)?$dataval[0]->c_meta_title:'';
    $c_meta_desc  = !empty($dataval[0]->c_meta_desc)?$dataval[0]->c_meta_desc:'';
    $c_meta_key   = !empty($dataval[0]->c_meta_key)?$dataval[0]->c_meta_key:'';
    $category_img = !empty($dataval[0]->c_category_image)?$dataval[0]->c_category_image:'';
    $n_status     = !empty($dataval[0]->n_status)?$dataval[0]->n_status:'';

    if(!empty($category_img))
    {
        $img_value = IMG_URL.'category/'.$category_img;
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
                                            <label class="form-label" for="first-name-column">Category Name <span class="text-danger">*</span></label>
                                            <input type="text" id="first-name-column" class="typeahead form-control input_field" placeholder="Category Name" name="c_category" value="<?php echo $c_category; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="first-name-column">Sub category</label>
                                            <select class="select2 form-select" id="select2-basic" name="n_parent_id">
                                                <option value="0">Select Option</option>
                                                <?php echo $category_val; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="first-name-column">Meta Title</label>
                                            <input type="text" id="first-name-column" class="form-control input_field" placeholder="Meta Title" name="c_meta_title" value="<?php echo $c_meta_title; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="first-name-column">Meta Description</label>
                                            <textarea class="form-control text_field" id="" name="c_meta_desc" rows="3" placeholder="Meta Description" ><?php echo $c_meta_desc; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="first-name-column">Meta Keyword</label>
                                            <textarea class="form-control text_field" id="" name="c_meta_key" rows="3" placeholder="Meta Keyword" ><?php echo $c_meta_key; ?></textarea>
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
                                                        <input type="file" id="account-upload" name="c_category_image" class="" hidden accept="image/*" />
                                                        <p class="mb-0">Allowed file types: png, jpg, jpeg.</p>
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