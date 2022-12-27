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
                                        <li class="breadcrumb-item active"><?php echo $sub_heading; ?>
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
                <div class="content-body">
                    <section class="app-user-list">
                        <div class="row">
                            <div class="col-lg-4 col-sm-4">
                                <div class="card">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div>
                                            <h3 class="fw-bolder mb-75 total_val">0</h3>
                                            <span>Total <?php echo $main_heading; ?></span>
                                        </div>
                                        <div class="avatar bg-light-primary p-50">
                                            <span class="avatar-content">
                                            <i class="font-medium-4 icon-folder-alt"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4">
                                <div class="card">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div>
                                            <h3 class="fw-bolder mb-75 active_val">0</h3>
                                            <span>Active <?php echo $main_heading; ?></span>
                                        </div>
                                        <div class="avatar bg-light-success p-50">
                                            <span class="avatar-content">
                                            <i class="font-medium-4 icon-check"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4">
                                <div class="card">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div>
                                            <h3 class="fw-bolder mb-75 inactive_val">0</h3>
                                            <span>Inactive <?php echo $main_heading; ?></span>
                                        </div>
                                        <div class="avatar bg-light-danger p-50">
                                            <span class="avatar-content">
                                            <i class="font-medium-4 icon-close"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body border-bottom">
                                <div class="row cearfix">
                                    <div class="col-lg-8 align-self-center">
                                        <h4 class="card-title m-0"><?php echo $sub_heading; ?></h4>
                                    </div>
                                    <div class="col-lg-4 text-end">
                                        <a href="<?php echo BASE_URL.$export_menu; ?>">
                                            <button class="dt-button buttons-collection btn btn-outline-secondary dropdown-toggle mr-6"><span><i data-feather='upload'></i> Export</span></button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-datatable pt-0 row">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start">
                                        <div class="limit_drop">
                                            <label class="limit_label lh-32">
                                                Show
                                                <select name="" class="form-select limit_select getlimitval">
                                                    <option value="10" selected>10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                    <option value="500">500</option>
                                                </select> 
                                                entries
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-8 d-flex justify-content-end">
                                        <div class="table_search">
                                            <label class="limit_label lh-40">Search:<input type="search" class="form-control search_box" placeholder="" id="searchval" style="width: 78%;"></label>
                                            <div class="dt-buttons d-inline-flex justify-content-end mt-50">
                                                <button class="dt-button add-new btn btn-primary searchdata" type="button"><i data-feather='search'></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-datatable pt-0">
                                    <div class="table-responsive">
                                        <div class="table_load show">
                                            <table class="user-list-table table">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Demographic</th>
                                                        <th>Status</th>
                                                        <th>Created Date</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="loaddefaultData">
                                                    <tr>
                                                        <td class="tablelocload"></td>
                                                        <td class="tablelocload"></td>
                                                        <td class="tablelocload"></td>
                                                        <td class="tablelocload"></td>
                                                        <td class="tablelocload"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tablelocload"></td>
                                                        <td class="tablelocload"></td>
                                                        <td class="tablelocload"></td>
                                                        <td class="tablelocload"></td>
                                                        <td class="tablelocload"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tablelocload"></td>
                                                        <td class="tablelocload"></td>
                                                        <td class="tablelocload"></td>
                                                        <td class="tablelocload"></td>
                                                        <td class="tablelocload"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="table_value hide">
                                            <div class="col-md-12">
                                                <div id="o-message"></div>
                                            </div>
                                            <table class="user-list-table table">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="sorting active" data-item="1" data-sort="1"># 
                                                            <span class="show-inline up">&#8673;</span>
                                                            <span class="hide down">&#8675;</span>
                                                        </th>
                                                        <th class="sorting" data-item="2" data-sort="1">Demographic
                                                            <span class="hide up">&#8673;</span>
                                                            <span class="hide down">&#8675;</span>
                                                        </th>
                                                        <th class="sorting" data-item="3" data-sort="1">Status
                                                            <span class="hide up">&#8673;</span>
                                                            <span class="hide down">&#8675;</span>
                                                        </th>
                                                        <th class="sorting" data-item="4" data-sort="1">Created Date
                                                            <span class="hide up">&#8673;</span>
                                                            <span class="hide down">&#8675;</span>
                                                        </th>
                        <?php
                            if(userAccess('demographic_edit') == TRUE || userAccess('demographic_delete') == TRUE):
                                ?>
                                    <th>Actions</th>
                                <?php
                            endif;
                        ?>
                                                    </tr>
                                                </thead>
                                                <tbody id="getTableValue">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div id="error" class="alert alert-danger text-center me-8 hide" role="alert">
                                        <div class="alert-body">No data found...</div>
                                    </div>

                                    <div class="paginat_btn dx-2 row">
                                        <div class="col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start">
                                            <div class="page_val"></div>
                                        </div>
                                        <div class="col-sm-12 col-lg-8 d-flex justify-content-center justify-content-lg-end">
                                            <div class="pagination_val">
                                                <div class="pagprev" style="margin-bottom: 20px; position: relative; float: left;">
                                                </div>
                                                <div class="pagnext" style="margin-bottom: 20px; position: relative; float: right;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>