<?php
    $n_id          = !empty($dataval[0]->n_id)?$dataval[0]->n_id:'';
    $c_demographic = !empty($dataval[0]->c_demographic)?$dataval[0]->c_demographic:'';
    $n_status      = !empty($dataval[0]->n_status)?$dataval[0]->n_status:'';
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
                                                    <label class="form-label" for="first-name-column">Demographic Name <span class="text-danger">*</span></label>
                                                    <input type="text" id="first-name-column" class="form-control input_field" placeholder="Demographic Name" name="c_demographic" value="<?php echo $c_demographic; ?>" />
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