<?php include 'v_popup_header.php';?>
	  <!-- general form elements -->
	  <input type="hidden" id="supId" name="supId" value="<?php if(isset($_GET["id"])){ echo $_GET["id"]; }?>"/>
	  <input type="hidden" id="frmAct" name="frmAct" value="<?php if(isset($_GET["action"])){ echo $_GET["action"]; }?>"/>
	  <!-- form start -->
      <form role="form" class="form-horizontal" id="frmBranch" action="">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnExit">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="popupTitle"></h4>
          </div>
           
          <div class="modal-body" id="modalMdBody">
          		<!-- modal body  -->
            	<div class="row">
                	<div class="col-xs-12 row" style="padding:0px">
                		<div class="col-xs-6 padding-forms-left">
                			<div class="form-group">
                              <label for="suppplyNm" data-i18ncd="lb_name">Name</label>
                              <input type="text" class="form-control" id="suppplyNm" name="suppplyNm" required="required" style="border-radius:5px;">
                            </div>
                		</div>
                		<div class="col-xs-6 padding-forms-right">
                			<div class="form-group">
                               	<label for="suppplyNmKh" data-i18ncd="lb_name_kh">Khmer Name</label>
                                <input type="text" class="form-control" id="suppplyNmKh" name="suppplyNmKh" required="required" style="border-radius:5px;">
                            </div>
                		</div>
                	</div>
                	<div class="col-xs-12 row" style="padding:0px">
                		<div class="col-xs-6 padding-forms-left">
                			<div class="form-group">
                              <label for="phoneNum" data-i18ncd="lb_phone">Phone Number</label>
                              <input type="text" class="form-control" id="phoneNum" name="phoneNum" required="required" style="border-radius:5px;">
                            </div>
                		</div>
                		<div class="col-xs-6 padding-forms-right">
                			<div class="form-group">
                               	<label for="supplEmail" data-i18ncd="lb_email">Email</label>
                            	<input type="text" class="form-control" id="supplEmail" name="supplEmail" required="required" style="border-radius:5px;">
                            </div>
                		</div>
                	</div>
                	<div class="col-xs-12 row" style="padding:0px">
                		<div class="col-xs-12 padding-forms-left">
                			<div class="form-group">
                              <label for="suppAddr" data-i18ncd="lb_addr">Address</label>
                              <input type="text" class="form-control" id="suppAddr" name="suppAddr" required="required" style="border-radius:5px;">
                            </div>
                		</div>
                	</div>
                    
                	<div class="col-xs-12 row" style="padding:0px">
                		<div class="col-xs-12 padding-forms-left">
                			<div class="form-group">
                				<label for="suppDescr" data-i18ncd="lb_des">Description</label>
                				<textarea rows="2" style="width:100%;border-radius:5px;" id="suppDescr" name="suppDescr" class="form-control md-textarea"></textarea>
                			</div>
                		</div>
                    </div>
                	
            	</div>
                <!-- end modal body  -->
          </div>
     
		  <div class="modal-footer">
			<button type="submit" class="btn btn-success btn-sm" id="btnSaveNew" style="display:none">Save + New</button>
            <button type="submit" class="btn btn-primary btn-sm" id="btnSave">Save</button>
            <button type="button" class="btn btn-default btn-sm" id="btnClose">Close</button>
          </div>
	  </form>
      <!-- form end --> 
      <!-- end general form elements -->
<?php include 'v_popup_footer.php';?>
<script src="<?php echo base_url('assets/') ?>js/pages/popup/v_popup_form_supplier.js"></script>