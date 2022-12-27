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
                <div class="mb-1 breadcrumb-right">
                    <div class="dropdown">
                        <?php if($role_access): ?>
                        <a class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" href="<?php echo BASE_URL.$pre_menu; ?>"><?php echo $pre_title; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
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
                            <div class="col-lg-8">
                                <h4 class="card-title m-0"><?php echo $sub_heading; ?></h4>
                            </div>
                            <div class="col-lg-4 text-end">
                                <a href="<?php echo BASE_URL.$export_menu; ?>">
                                    <button class="dt-button buttons-collection btn btn-outline-secondary dropdown-toggle me-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="true"><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share font-small-4 me-50"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path><polyline points="16 6 12 2 8 6"></polyline><line x1="12" y1="2" x2="12" y2="15"></line></svg>Export</span></button>
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
                                        </select> 
                                        entries
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-8 d-flex justify-content-end">
                                <div class="row clearfix col-12">
                                    <div class="col-lg-12">
                                        <div class="row clearfix col-12">
                                            <div class="col-md-5">
                                               <!--  <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Role</label>
                                                    <select class="select2 form-select" id="select2-multiple" multiple placeholder="Select maximum 2 items">
                                                      <option value="AK">Alaska</option>
                                                      <option value="HI">Hawaii</option>
                                                  </select>
                                                </div> -->
                                            </div>
                                            <div class="col-md-5">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Search</label>
                                                    <input type="search" class="form-control search_box" placeholder="Search..." id="searchval">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="mt-2">
                                                    <button class="dt-button add-new btn btn-primary searchdata" type="button"><i data-feather='search'></i></button>
                                                </div>
                                            </div>
                                        </div>
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
                                                <th>Name</th>
                                                <th>Role</th>
                                                <th>Contact</th>
                                                <th>Email Id</th>
                                                <th>Status</th>
                                                <th>User Since</th>
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
                                    <table class="user-list-table table">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="sorting active" data-item="1" data-sort="1"># 
                                                    <span class="show-inline up">&#8673;</span>
                                                    <span class="hide down">&#8675;</span>
                                                </th>
                                                <th class="sorting" data-item="2" data-sort="1">
                                                    Name
                                                    <span class="hide up">&#8673;</span>
                                                    <span class="hide down">&#8675;</span>
                                                </th>
                                                <th class="sorting" data-item="3" data-sort="1">
                                                    Role
                                                    <span class="hide up">&#8673;</span>
                                                    <span class="hide down">&#8675;</span>
                                                </th>
                                                <th class="sorting" data-item="4" data-sort="1">
                                                    Contact
                                                    <span class="hide up">&#8673;</span>
                                                    <span class="hide down">&#8675;</span>
                                                </th>
                                                <th class="sorting" data-item="5" data-sort="1">
                                                    Email Id
                                                    <span class="hide up">&#8673;</span>
                                                    <span class="hide down">&#8675;</span>
                                                </th>
                                                <th class="sorting" data-item="6" data-sort="1">
                                                    Status
                                                    <span class="hide up">&#8673;</span>
                                                    <span class="hide down">&#8675;</span>
                                                </th>
                                                <th class="sorting" data-item="7" data-sort="1">
                                                    User Since
                                                    <span class="hide up">&#8673;</span>
                                                    <span class="hide down">&#8675;</span>
                                                </th>
                                                <th>Actions</th>
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