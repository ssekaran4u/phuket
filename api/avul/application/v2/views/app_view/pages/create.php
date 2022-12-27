<?php
    $n_id          = !empty($dataval->n_id)?$dataval->n_id:'';
    $c_pages       = !empty($dataval->c_pages)?$dataval->c_pages:'';
    $n_page_type   = !empty($dataval->n_page_type)?$dataval->n_page_type:'';
    $c_description = !empty($dataval->c_description)?$dataval->c_description:'';
    $n_status      = !empty($dataval->n_status)?$dataval->n_status:'';

    $text_page    = 'show';
    $google_form  = 'hide';

    if($method == '_Edit' && $n_page_type == 2)
    {   
        $text_page    = 'hide';
        $google_form  = 'show';
        
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
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Page Name <span class="text-danger">*</span></label>
                                                    <input type="text" id="first-name-column" class="form-control input_field" placeholder="Page Name" name="c_pages" value="<?php echo $c_pages; ?>" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Page Type <span class="text-danger">*</span></label>
                                                    <select class="select2 form-select n_page_type" name="n_page_type">
                                                        <option value="0">Select Option</option>
                                                        <option value="1" <?php if($n_page_type == '1')echo 'selected';?>>Text page</option>
                                                        <option value="2" <?php if($n_page_type == '2')echo 'selected';?>>Link Page</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Description <span class="text-danger">*</span></label>
                                                    <div class="text_page <?php echo $text_page; ?>">
                                                        <textarea id="additional_details" class="form-control additional_details editor" placeholder="Description" name="c_description" rows="3" style="border-radius: 4px;"><?php echo $c_description; ?></textarea>
                                                    </div>
                                                    <div class="google_form <?php echo $google_form; ?>">
                                                        <textarea id="c_link" class="form-control c_link" placeholder="Page Link" name="c_link" rows="3" style="border-radius: 4px;"><?php echo $c_description; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                                if($method == '_Edit')
                                                {
                                                    ?>
                                                        <div class="col-12">
                                                            <div class="demo-inline-spacing">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="n_status" id="inlineRadio1" value="1" <?php echo $n_status== '1' ? 'checked' : ''; ?> />
                                                                    <label class="form-check-label" for="inlineRadio1">Active</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="n_status" id="inlineRadio2" value="2" <?php echo $n_status== '2' ? 'checked' : ''; ?> />
                                                                    <label class="form-check-label" for="inlineRadio2">Inactive</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                }
                                            ?>
                                            <div class="col-12">
                                                <input type="hidden" id="n_id" name="n_id" class="n_id" value="<?php echo $n_id; ?>">
                                                <input type="hidden" id="method" name="method" class="method" value="<?php echo $method; ?>">
                                                <input type="hidden" id="formpage" name="formpage" class="formpage" value="<?php echo $formpage; ?>">

                                                <button type="submit" class="btn btn-primary form_submit me-1">
                                                    <span class="first_btn show"><i class="icon-check"></i> Submit</span>
                                                    <span class="span_btn hide"><i class="icon-refresh"></i> Loading....</span>
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