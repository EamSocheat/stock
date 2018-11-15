<?php include 'v_popup_header.php';?>
		  <!-- general form elements -->
		  <input type="hidden" id="staId" name="staId" value="<?php if(isset($_GET["id"])){ echo $_GET["id"]; }?>"/>
		  <input type="hidden" id="frmAct" name="frmAct" value="<?php if(isset($_GET["action"])){ echo $_GET["action"]; }?>"/>
		  <!-- form start -->
          <form role="form" class="form-horizontal" id="frmStaff" action="" style="display: none">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnExit">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="popupTitle">Default Modal</h4>
          </div>
          
          <div class="modal-body" id="modalMdBody">
          		<!-- modal body  -->
            	
            	<div class="row">
            		<div class="col-xs-12 row" style="padding:0px; margin-bottom: 20px;">
            		
            			<div class="col-xs-4 padding-forms-left" style="padding-left: 35px;">
                			<div class="image" style="text-align: center">
                            	<img id="staImgView" src="<?php echo base_url('assets/image/default-staff-photo.png') ?>" class="img-circle" style="width: 150px;height: 150px;" alt="User Image">
                            </div>
                            <div style="text-align: center;margin-top: 5px;">
                            	<button  type="button" class="btn btn-info btn-xs" id="btnSelectPhoto"><i class="fa fa-image" aria-hidden="true"></i> <span data-i18ncd="lb_select_img">Select Image</span></button>
                            	<input type="file" style="display: none" class="form-control" accept="image/*"  id="fileStaPhoto" name="fileStaPhoto">
                            </div>
                		</div>
                		<div class="col-xs-4 padding-forms-right">
                			<div class="form-group">
                				<label for="braNm2" data-i18ncd="lb_branch">Branch Name</label>
                				<div class="input-group">
                                	<input type="text" class="form-control input-sm" disabled="disabled" id="txtBraNm" name="txtBraNm">
                                    <span id="btnPopupBranch" class="input-group-addon label-info" style="border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;cursor: pointer;border-color: #46b8da !important;"><i class="fa fa-search-plus"></i></span>
                                </div>
                                <input type="hidden" id="txtBraId" name="txtBraId">
                			</div>
                			<!--  -->
                			<div class="form-group">
                              <label for="braNm" data-i18ncd="lb_name">Name</label>
                              <input type="text" class="form-control" id="txtStaffNm" name="txtStaffNm" required="required">
                            </div>
                		</div>
                		
                		<div class="col-xs-4 padding-forms-right">
                			<div class="form-group">
                				<label for="txtPosNm" data-i18ncd="lb_position">Position</label>
                				<div class="input-group">
                                	<input type="text" class="form-control input-sm" disabled="disabled" id="txtPosNm" name="txtPosNm">
                                    <span id="btnPopupPosition" class="input-group-addon label-info" style="border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;cursor: pointer;border-color: #46b8da !important;"><i class="fa fa-search-plus"></i></span>
                                </div>
                                <input type="hidden" id="txtPosId" name="txtPosId">
                			</div>
                			<!--  -->
                			<div class="form-group">
                               	<label for="txtStaffNmKh" data-i18ncd="lb_name_kh">Khmer Name</label>
                            	<input type="text" class="form-control" id="txtStaffNmKh" name="txtStaffNmKh" required="required">
                            </div>
                		</div>
                		
                		
                	</div>
                
                	<div class="col-xs-12 row" style="padding:0px">
                		<div class="col-xs-4 padding-forms-left">
                			<div class="form-group">
                              <label for="cboGender" data-i18ncd="cboGender">Gender</label>
                              <select class="form-control" id="cboGender" name="cboGender">
	                    			<option value="M">Male</option>
			                    	<option value="F" selected>Female</option>
			                  </select>
                            </div>
                		</div>
                		<div class="col-xs-4 padding-forms-right">
                			<div class="form-group">
                               	<label for="txtDob" data-i18ncd="staDob">DOB</label>
			                	<div class="input-group date">
				                  	<div class="input-group-addon" style="border-top-left-radius: 5px; border-bottom-left-radius: 5px;">
				                    	<i class="fa fa-calendar"></i>
				                  	</div>
				                  	<input type="text" class="form-control pull-right date-pick" id="txtDob" name="txtDob" required="required" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
				                </div>
                            </div>
                		</div>
                		
                		<div class="col-xs-4 padding-forms-right">
                			<div class="form-group">
                				<label for="txtDes" data-i18ncd="staDes">Description</label>
                              	<input type="text" class="form-control" id="txtDes" name="txtDes" />
                			</div>
                		</div>
                	</div>
                	
                	<div class="col-xs-12 row" style="padding:0px">
                		<div class="col-xs-4 padding-forms-left">
                			<div class="form-group">
                              <label for="txtPhone1" data-i18ncd="lb_phone">Phone</label>
                              <input type="text" class="form-control" id="txtPhone1" name="txtPhone1"  required="required">
                            </div>
                		</div>
                		<div class="col-xs-4 padding-forms-right">
                			<div class="form-group">
                              <label for="txtPhone2" data-i18ncd="lb_phone2">Phone2</label>
                              <input type="text" class="form-control" id="txtPhone2" name="txtPhone2" />
                            </div>
                		</div>
                		<div class="col-xs-4 padding-forms-right">
                			<div class="form-group">
                				<label for="txtEmail" data-i18ncd="lb_email">Email</label>
                              	<input type="email" class="form-control" id="txtEmail" name="txtEmail" />
                			</div>
                		</div>
                	</div>
                	
                	<div class="col-xs-12 row" style="padding:0px">
                		<div class="col-xs-12 padding-forms-left padding-forms-right">
                			<div class="form-group">
                               	<label for="txtAddr" data-i18ncd="txtAddr">Address</label>
                            	<input type="text" class="form-control" id="txtAddr" name="txtAddr">
                            </div>
                		</div>
                	</div>
                	
                	
                	<div class="col-xs-12 row" style="padding:0px">
                		<div class="col-xs-4 padding-forms-left">
                			<div class="form-group">
                				<label for="txtStartDate" data-i18ncd="staStartDate">Start Date</label>
                              	<div class="input-group date">
				                  	<div class="input-group-addon" style="border-top-left-radius: 5px; border-bottom-left-radius: 5px;">
				                    	<i class="fa fa-calendar"></i>
				                  	</div>
				                  	<input type="text" class="form-control pull-right date-pick" id="txtStartDate" name="txtStartDate" required="required" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
				                </div>
                			</div>
                		</div>
                		<div class="col-xs-4 padding-forms-right">
                			<div class="form-group">
                				<label for="txtStopDate" data-i18ncd="staEndDate">Stop Date</label>
                              	<div class="input-group date">
				                  	<div class="input-group-addon" style="border-top-left-radius: 5px; border-bottom-left-radius: 5px;">
				                    	<i class="fa fa-calendar"></i>
				                  	</div>
				                  	<input type="text" class="form-control pull-right date-pick" id="txtStopDate" name="txtStopDate" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
				                </div>
                			</div>
                		</div>
                		
                	</div>
           
                	
            	</div>
                <!-- end modal body  -->
          </div>
     
          <div class="modal-footer">
          	<button data-i18ncd="btn_save_new"  type="submit" class="btn btn-success btn-sm" id="btnSaveNew" style="display:none">Save + New</button>
            <button data-i18ncd="btn_save" type="submit" class="btn btn-primary btn-sm" id="btnSave">Save</button>
            <button data-i18ncd="btn_close" type="button" class="btn btn-default btn-sm" id="btnClose">Close</button>
          </div>
          </form>
          <!-- form end --> 
          <!-- end general form elements -->
<?php include 'v_popup_footer.php';?>
<script src="<?php echo base_url('assets/') ?>js/pages/popup/v_popup_form_staff.js"></script>