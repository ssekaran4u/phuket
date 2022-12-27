<?php
    $n_id       = isset($dataval[0]->n_id)?$dataval[0]->n_id:'';
    $n_city = isset($dataval[0]->n_city)?$dataval[0]->n_city:'';
    $c_district     = isset($dataval[0]->c_district)?$dataval[0]->c_district:'';
    $n_status   = isset($dataval[0]->n_status)?$dataval[0]->n_status:'';

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
                        <?php endif ;?>
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
                                <div class="row">
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
                                    <?php endif;  ?>
                                    <div class="col-md-6 mb-1">
                                        <label class="form-label" for="first-name-column">City <span class="text-danger">*</span></label>
                                        <select class="select2 form-select" id="select2-basic" name="n_city">
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
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="first-name-column">District Name <span class="text-danger">*</span></label>
                                            <input type="text" id="first-name-column" class="form-control input_field" placeholder="District Name" name="c_district" value="<?php echo $c_district; ?>" />
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