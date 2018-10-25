<?php include 'v_popup_header.php';?>
		  <!-- general form elements -->
		  <input type="hidden" id="braId" name="braId" value="<?php if(isset($_GET["id"])){ echo $_GET["id"]; }?>"/>
		  <input type="hidden" id="frmAct" name="frmAct" value="<?php if(isset($_GET["action"])){ echo $_GET["action"]; }?>"/>
		  <!-- form start -->
          <form role="form" class="form-horizontal" id="frmBranch" action="" style="display: none">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnExit">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="popupTitle">Default Modal</h4>
          </div>
          
          <div class="modal-body" id="modalMdBody">
          		<!-- modal body  -->
            	
            	<div class="row">
            		<div class="col-xs-12 row" style="padding:0px; margin-bottom: 20px;">
            		
            			<div class="col-xs-4 padding-forms-left">
                			<div class="image" style="text-align: center">
                            	<img src="<?php echo base_url('assets/image/default-staff-photo.png') ?>" class="img-circle" style="width: 150px;" alt="User Image">
                            </div>
                            <div style="text-align: center;margin-top: 5px;">
                            	<button  type="button" class="btn btn-info btn-xs" id="btnSelectPhoto"><i class="fa fa-image" aria-hidden="true"></i> <span data-i18ncd="lb_select_img">Select Image</span></button>
                            	<input type="file" style="display: none" class="form-control" accept="image/*"  id="userfile" name="userfile">
                            </div>
                		</div>
                		<div class="col-xs-4 padding-forms-right">
                			<div class="form-group">
                				<label for="braNm2" data-i18ncd="lb_branch">Branch Name</label>
                				<div class="input-group">
                                	<input type="text" class="form-control input-sm" disabled="disabled" id="txtBraNm" name="txtBraNm">
                                    <span id="btnPopupBranch" class="input-group-addon label-warning" style="cursor: pointer;border-color: #f39c12 !important;"><i class="fa fa-search-plus"></i></span>
                                </div>
                                <input type="hidden" class="form-control input-sm" disabled="disabled" id="txtBraId" name="txtBraId">
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
                                    <span id="btnPopupPosition" class="input-group-addon label-warning" style="cursor: pointer;border-color: #f39c12 !important;"><i class="fa fa-search-plus"></i></span>
                                </div>
                			</div>
                			<!--  -->
                			<div class="form-group">
                               	<label for="braNmKh" data-i18ncd="lb_name_kh">Khmer Name</label>
                            	<input type="text" class="form-control" id="braNmKh" name="braNmKh" required="required">
                            </div>
                		</div>
                		
                		
                	</div>
                
                	<div class="col-xs-12 row" style="padding:0px">
                		<div class="col-xs-4 padding-forms-left">
                			<div class="form-group">
                              <label for="staGender" data-i18ncd="staGender">Gender</label>
                              <input type="text" class="form-control" id="staGender" name="staGender" required="required">
                            </div>
                		</div>
                		<div class="col-xs-4 padding-forms-right">
                			<div class="form-group">
                               	<label for="staDob" data-i18ncd="staDob">DOB</label>
                            	<input type="text" class="form-control" id="staDob" name="staDob" required="required">
                            </div>
                		</div>
                		<div class="col-xs-4 padding-forms-right">
                			<div class="form-group">
                               	<label for="staAddr" data-i18ncd="staAddr">Address</label>
                            	<input type="text" class="form-control" id="staAddr" name="staAddr" required="required">
                            </div>
                		</div>
                		
                	</div>
                	
                	<div class="col-xs-12 row" style="padding:0px">
                		<div class="col-xs-4 padding-forms-left">
                			<div class="form-group">
                              <label for="braPhone" data-i18ncd="lb_phone">Phone</label>
                              <input type="text" class="form-control" id="braPhone" name="braPhone"  required="required">
                            </div>
                		</div>
                		<div class="col-xs-4 padding-forms-right">
                			<div class="form-group">
                              <label for="braPhone2" data-i18ncd="lb_phone2">Phone2</label>
                              <input type="text" class="form-control" id="braPhone2" name="braPhone2" />
                            </div>
                		</div>
                		<div class="col-xs-4 padding-forms-right">
                			<div class="form-group">
                				<label for="braEmail" data-i18ncd="lb_email">Email</label>
                              	<input type="email" class="form-control" id="braEmail" name="braEmail" />
                			</div>
                		</div>
                	</div>
                	
                	<div class="col-xs-12 row" style="padding:0px">
                		<div class="col-xs-4 padding-forms-left">
                			<div class="form-group">
                				<label for="staStartDate" data-i18ncd="staStartDate">Start Date</label>
                              	<input type="email" class="form-control" id="staStartDate" name="staStartDate" />
                			</div>
                		</div>
                		<div class="col-xs-4 padding-forms-right">
                			<div class="form-group">
                				<label for="staEndDate" data-i18ncd="staEndDate">Stop Date</label>
                              	<input type="email" class="form-control" id="staEndDate" name="staEndDate" />
                			</div>
                		</div>
                		<div class="col-xs-4 padding-forms-right">
                			<div class="form-group">
                				<label for="staDes" data-i18ncd="staDes">Description</label>
                              	<input type="email" class="form-control" id="staDes" name="staDes" />
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