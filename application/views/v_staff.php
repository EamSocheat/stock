<?php echo $header; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> <span data-i18ncd="lb_staff">Staff</span>
        <small data-i18ncd="lb_information">Information</small>
      </h1>
      
      <ol class="breadcrumb">
        <li><a href="Dashboard"><i class="fa fa-dashboard"></i> <span data-i18ncd="lb_dasbord">Dashboard</span></a></li>
        <li class="active" data-i18ncd="lb_staff">Staff</li>
      </ol>
     
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- main col -->
        <section class="">
			<div class="col-xs-12">
			  <div class="box">
				<!-- box-header -->
				<div class="box-header">
				
					<div class="box box-solid box-search">
						<div class="box-header with-border">
						  <i class="fa fa-search-plus" aria-hidden="true"></i>
						  <h3 class="box-title" data-i18ncd="lb_search">Search</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							
								<div class="row" >
								    <div class="col-sm-12 col-md-12 col-lg-12 row">
								        <div class="col-sm-3 col-md-3 col-lg-3">
        									<div class="form-group">
                                                <label for="txtSrchBraNm" class="control-label" data-i18ncd="lb_name">Name</label>
                                                <input type="text" class="form-control input-sm" id="txtSrchStaNm" placeholder="Name">
                                              
                                            </div>
        								</div>
        								<div class="col-sm-3 col-md-3 col-lg-3">
        									<div class="form-group">
                                                <label for="txtSrchBraNmKh" class="control-label" data-i18ncd="lb_name_kh">Khmer Name </label>
                                                <input type="text" class="form-control input-sm" id="txtSrchStaNmKh" placeholder="Khmer Name ">
                                        
                                            </div>
        								</div>
        								
        								<div class="col-sm-3 col-md-3 col-lg-3">
        									<div class="form-group">
                                                <label for="txtSrchBraPhone" class="control-label" data-i18ncd="lb_phone">Phone </label>
                                                <input type="text" class="form-control input-sm"  id="txtSrchStaPhone" placeholder="Phone">
                                        
                                            </div>
        								</div>
        								
        								<div class="col-sm-3 col-md-3 col-lg-3">
        									<div class="form-group">
                                                <label for="cbxSrchBraType" class="control-label" data-i18ncd="lb_branch">Branch</label>
                                                <select class="form-control input-sm" id="cbxSrchBranch" name="cbxSrchBranch">
                                                   
                                                </select>
                                        
                                            </div>
        								</div>        								
        								
								    </div>
								    <div class="col-sm-12 col-md-12 col-lg-12 row">
								    	<div class="col-sm-3 col-md-3 col-lg-3">
        									<div class="form-group">
                                                <label for="cbxSrchBraType" class="control-label" data-i18ncd="lb_position">Position</label>
                                                <select class="form-control input-sm" id="cbxSrchPos" name="cbxSrchPos">
                                                   
                                                </select>
                                        
                                            </div>
        								</div> 
								    </div>
    								<div class="col-sm-12 col-md-12 col-lg-12">
    								    <button id="btnSearch" type="button" class="btn btn-success btn-sm pull-right"><i class="fa fa-search" aria-hidden="true"></i> <span data-i18ncd="lb_search">Search</span></button>
    									<button id="btnReset" type="button" class="btn btn-warning btn-sm pull-right" style="margin-right: 5px"><i class="fa fa-refresh" aria-hidden="true"></i> <span data-i18ncd="btn_reset">Reset</span></button>
    								</div>
    								
    							</div>
							
						</div>
						<!-- /.box-body -->
					</div>
									
				</div>
				<!-- /.box-header -->
				
				<!-- button -->
				<div class="row">
					<div class="col-xs-12">
                        <div class="col-xs-12">
    					    <button type="button" id="btnDelete" class="btn btn-danger btn-sm" style="margin-right: 5px"><i class="fa fa-trash" aria-hidden="true"></i> <span data-i18ncd="btn_delete">Delete</span></button>
    					    <!-- <button type="button" id="btnEdit" class="btn btn-primary btn-sm" style="margin-right: 5px"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span data-i18ncd="btn_edit">Edit</span></button> -->
    					    <button type="button" id="btnAddNew" class="btn btn-default btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> <span data-i18ncd="btn_add_new">Add New</span></button>
                        </div>
    					
    		
    				</div>
				</div>
				<!-- /.button -->
				
				<div class="col-sm-12">
				    
				    <div class="pull-right" style="padding-bottom: 5px;">
						<form class="form-inline" action="">
                            <label for="limitRow" data-i18ncd="lb_records">Records</label>
                            <select class="form-control input-sm" id="perPage">
                                <option value="1" data-i18ncd="lb_row1">1 rows</option>
                                <option value="2" data-i18ncd="lb_row2"> 2 rows</option>
                                <option value="3" data-i18ncd="lb_row3">3 rows</option>
                                <option value="10" data-i18ncd="lb_row10">10 rows</option>
                                <option value="20" data-i18ncd="lb_row20">20 rows</option>
                                <option value="50" data-i18ncd="lb_row50">50 rows</option>
                                <option value="100" data-i18ncd="lb_row100">100 rows</option>
                            </select>
                            
                      </form>
                    </div>
				    <br>
				</div>
				
				
				<div class="box-body table-responsive">
				  <table class="table table-hover" id="tblStaff">
				    <thead>  
    					<tr>
    					  <th><input type="checkbox" id="chkAllBox"></th>
    					  <th></th>
    					  <th data-i18ncd="lb_name">Name</th>
    					  <th data-i18ncd="lb_name_kh">Khmer Name</th>
    					  <th data-i18ncd="lb_gender">Gender</th>
    					  <th data-i18ncd="lb_phone">Phone</th>
    					  <th data-i18ncd="lb_position">Position</th>
    					  <th data-i18ncd="lb_branch">Branch</th>
    					  <th data-i18ncd="lb_action">Action</th>
    					</tr>
					</thead>
					<tbody>
					 	<!-- -->				
					</tbody>
					
				  </table>
				</div>
				<!-- /.box-body -->
				<!-- box-footer -->
				<div class="box-footer clearfix">
                  <ul class="pagination pagination-sm no-margin pull-right" id="paging" style="display:none">
                    <!--<li><a href="#">&laquo;</a></li>-->
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <!--<li><a href="#">&raquo;</a></li>-->
                  </ul>
                </div>
                <!-- /.box-footer -->
			  </div>
			  <!-- /.box -->
			<div>
			</div>
			</div>
        </section>
        <!-- main col -->
      </div>
      <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php echo $footer; ?>
<script src="<?php echo base_url('assets/') ?>js/pages/v_staff.js"></script>
<?php echo $iframe; ?>