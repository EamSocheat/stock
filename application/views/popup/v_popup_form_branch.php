<?php include 'v_popup_header.php';?>
		  <!-- general form elements -->
		  <input type="hidden" id="braId" name="braId" value="<?php if(isset($_GET["id"])){ echo $_GET["id"]; }?>"/>
		  <input type="hidden" id="frmAct" name="frmAct" value="<?php if(isset($_GET["action"])){ echo $_GET["action"]; }?>"/>
		  <input type="hidden" id="parentId" name="parentId" value="<?php if(isset($_GET["parentId"])){ echo $_GET["parentId"]; }?>"/>
		 
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
                	<div class="col-xs-12 row" style="padding:0px">
                		<div class="col-xs-6 padding-forms-left">
                			<div class="form-group">
                              <label for="braNm" data-i18ncd="lb_name">Branch Name</label>
                              <input type="text" class="form-control" id="braNm" name="braNm" required="required">
                            </div>
                		</div>
                		<div class="col-xs-6 padding-forms-right">
                			<div class="form-group">
                               	<label for="braNmKh" data-i18ncd="lb_name_kh">Khmer Name</label>
                            	<input type="text" class="form-control" id="braNmKh" name="braNmKh" required="required">
                            </div>
                		</div>
                	</div>
                	
                	<div class="col-xs-12 row" style="padding:0px">
                		<div class="col-xs-6 padding-forms-left">
                			<div class="form-group">
                              <label for="braPhone" data-i18ncd="lb_phone">Phone</label>
                              <input type="text" class="form-control" id="braPhone" name="braPhone"  required="required">
                            </div>
                		</div>
                		<div class="col-xs-6 padding-forms-right">
                			<div class="form-group">
                              <label for="braPhone2" data-i18ncd="lb_phone2">Phone2</label>
                              <input type="text" class="form-control" id="braPhone2" name="braPhone2" />
                            </div>
                		</div>
                	</div>
                	
                	<div class="col-xs-12 row" style="padding:0px">
                		<div class="col-xs-6 padding-forms-left">
                			<div class="form-group">
                				<label for="braEmail" data-i18ncd="lb_email">Email</label>
                              	<input type="email" class="form-control" id="braEmail" name="braEmail" />
                			</div>
                		</div>
                		<div class="col-xs-6 padding-forms-right">
                			<div class="form-group">
                               	<label for="braNm" data-i18ncd="lb_branch_type">Branch Type</label>
                            	<select class="form-control" id="braType" name ="braType">
                            		<option>Main</option>
                            	</select>
                            </div>
                		</div>
                	</div>
                    
                	<div class="col-xs-12 row" style="padding:0px">
                		<div class="col-xs-6 padding-forms-left">
                			<div class="form-group" >
                				<label for="braAddr" data-i18ncd="lb_addr">Address</label>
                				<textarea rows="2" style="width:100%" id="braAddr" name="braAddr"></textarea>
                			</div>
                		</div>
                		
                		<div class="col-xs-6 padding-forms-right">
                			<div class="form-group">
                				<label for="braDes" data-i18ncd="lb_des">Description</label>
                				<textarea rows="2" style="width:100%" id="braDes" name="braDes"></textarea>
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
<script src="<?php echo base_url('assets/') ?>js/pages/popup/v_popup_form_branch.js"></script>