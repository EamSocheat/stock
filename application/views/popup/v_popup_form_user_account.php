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
            		
                		<div class="col-xs-6 padding-forms-left">
                			<div class="form-group">
                				<label for="braNm2" data-i18ncd="lb_branch">Branch Name</label>
                				<div class="input-group">
                                	<input type="text" class="form-control input-sm" disabled="disabled" id="txtBraNm" name="txtBraNm">
                                    <span id="btnPopupBranch" class="input-group-addon label-info" style="cursor: pointer;border-color: #46b8da !important;    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;"><i class="fa fa-search-plus"></i></span>
                                </div>
                                <input type="hidden" id="txtBraId" name="txtBraId">
                			</div>
                			<!--  -->
                			<div class="form-group">
                              <label for="braNm" data-i18ncd="lb_name">Name</label>
                              <input type="text" class="form-control" id="txtStaffNm" name="txtStaffNm" required="required">
                            </div>
                		</div>
                		
                		<div class="col-xs-6 padding-forms-right">
                			<div class="form-group">
                              <label for="txtPhone2" data-i18ncd="">User Account Name</label>
                              <input style="height: 30px;" type="text" class="form-control" id="txtAccNm" name="txtAccNm" />
                            </div>
                			<!--  -->
                			<div class="form-group">
                               	<label for="txtStaffNmKh" data-i18ncd="lb_name_kh">Khmer Name</label>
                            	<input type="text" class="form-control" id="txtStaffNmKh" name="txtStaffNmKh" required="required">
                            </div>
                		</div>
                		
                		
                	</div>
					
					<div class="col-xs-12 row" style="padding:0px">
                		<div class="col-xs-12 padding-forms-left padding-forms-right" style="margin-top: -20px;">
                			<div class="form-group">
	                			<div class="panel panel-default">
							    	<div class="panel-heading"><input type="checkbox" id="chkAllMenuNav" /> <label for="chkAllMenuNav" style="cursor:pointer">MAIN NAVIGATION Menu</label></div>
							    	<div class="panel-body">
			
								    	<div class="col-xs-12 row" id="divMenuNav"  style="padding: 0;">
								    		
								    	</div>
							    	
							    	</div>
							    </div>
							</div>	    
                		</div>
                	</div>
                	
                	<div class="col-xs-12 row" style="padding:0px">
                		<div class="col-xs-12 padding-forms-left padding-forms-right" style="margin-top: -20px;">
                			<div class="form-group">
	                			<div class="panel panel-default">
							    	<div class="panel-heading"><input type="checkbox" id="chkAllMenuPro" /> <label for="chkAllMenuPro" style="cursor:pointer">PRODUCT NAVIGATION Menu</label></div>
							    	<div class="panel-body">
							    	
							    		<div class="col-xs-12 row" id="divMenuPro" style="padding: 0;">
								    		
								    	</div>
								    	
							    	</div>
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
<script src="<?php echo base_url('assets/') ?>js/pages/popup/v_popup_form_user_account.js"></script>