</div>
<link rel="stylesheet" href="<?php echo base_url();?>public/assets/global/plugins/jquery-ui/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<!-- END HEADER -->
<style>	
	.row{
		margin-bottom: 10px;
	}

	.align-right{
		float: right;
	}

	.tooltipx-css {
	    position: relative;
	    display: inline-block;
	    border-bottom: 1px dotted black;
	}

	.tooltip-css .tooltiptext {
	    visibility: hidden;
	    width: 120px;
	    background-color: black;
	    color: #fff;
	    text-align: center;
	    border-radius: 6px;
	    padding: 10px 15px;

	    /* Position the tooltip */
	    position: absolute;
	    z-index: 999;
	}

	.tooltip-css:hover .tooltiptext {
	    visibility: visible;
	}
</style>
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE CONTENT -->
	<div class="page-content">
		<div class="container-fluid">
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet light">
						<?php echo form_open($action, $attribute)?>
							<div class="row">
								<div class="col-md-7">
									<div class="form-group">
										<label class="control-label col-md-offset-5 col-md-1" style="width: 100px !important; padding-left: 0">Status</label>
										<div class="col-md-3">
											<select class="form-control input-sm select2me align-right" name="filter_status" id="filter_status">
												<?php 
													if($filter_status!="")
													{
														switch($filter_status)
														{
															case '1': $filter_status_text="Active"; break;
															case '0': $filter_status_text="Suspend"; break;
															default: $filter_status_text="Suspend"; break;
														}
												?>
														<option value="<?php echo $filter_status;?>" selected><?php echo $filter_status_text;?></option>
												<?php
													}
												?>
												<option value="">- Please Select -</option>
												<option value="1">Active</option>	
												<option value="0">Suspend</option>	
											</select>
										</div>
										<div class="col-md-2" style="width: 100px !important;">
											<button type="submit" class="btn green"><i class="fa fa-check"></i> Submit</button>
										</div>
									</div>
								</div>
								<div class="col-md-5">
									<a data-toggle="modal" href="#add_item" data-id="0" class="btn btn-primary add_item_modal align-right">
										Add Agent
									</a>
								</div>
							</div>
						</form>
						<div class="portlet-body">
							<table class="table table-bordered table-striped table-hover" id="agent_detail">
								<thead>
									<tr style="border-bottom: solid 1px #ddd">
										<th class="text-center">&nbsp;</th>
										<th colspan="5" class="text-center">General Information</th>
										<th colspan="4" class="text-center">Profile Information</th>
										<th colspan="4" class="text-center">Administration Information</th>
									</tr>
									<tr>
										<th width="10px" class="text-center">S/N</th>
										<th width="60px" class="text-center">SH ID</th>
										<th width="60px" class="text-center">AG ID</th>
										<th width="60px" class="text-center">Password</th>
										<th width="80px" class="text-center">Status</th>
										<th width="80px" class="text-center">Action</th>
										<th width="160px" class="text-center">Name</th>
										<th width="100px" class="text-center">Contact No.</th>
										<th width="200px" class="text-center">Bank Detail or Definition</th>
										<th class="text-center">Remark</th>
										<th width="100px" class="text-center">IP Address</th>
										<th width="100px" class="text-center">Login Date</th>
										<th width="140px" class="text-center">Create Date</th>
										<th width="100px" class="text-center">Create By</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										if(!empty($agent))
										{
											$i=0;
											foreach ($agent as $row){
												$i++;
												switch($row['status'])
												{
													case '1': $status_str="Active"; break;
													case '0': $status_str="Suspend"; break;
													default: $status_str="Suspend"; break;
												}
									?>
												<tr>
													<td class="text-center"><?php echo $i; ?></td>
													<td class="text-center">
														<?php echo $row['sh_id']; ?>
													</td>
													<td class="text-center">
														<?php echo $row['code']; ?>
													</td>
													<td class="text-center">*****</td>
													<td class="text-center"><?php echo $status_str; ?></td>
													<td class="text-center actions">
														<a data-toggle="modal" href="#add_item" data-id="<?php echo $row['id'];?>" class="add_item_modal">
															<img src="<?php echo base_url();?>public/images/icon/edit.png">
														</a>
														&nbsp;
														&nbsp;
														<?php echo anchor('agent/delete/'.$row['id'].'/index', "
															<img height='16px' src='".base_url()."public/images/icon/delete.png'>",array('onclick'=>"return confirm('Are you sure to remove this agent?')"));?>
													</td>
													<td><?php echo $row['name']; ?></td>
													<td class="text-center"><?php echo $row['contact']; ?></td>
													<td><?php echo $row['bank_acc_info']; ?></td>
													<td><?php echo $row['remark']; ?></td>
													<td class="text-center"><?php echo $row['ipaddress']; ?></td>
													<td class="text-center"><?php echo $row['last_login']; ?></td>
													<td class="text-center"><?php echo $row['createdate']; ?></td>
													<td class="text-center"><?php echo $row['createby']; ?></td>
												</tr>
									<?php 
											}
										}
										else
										{
									?>
											<tr class="gradeX">
												<td colspan="14" class="text-center"> -- No Data Available -- </td>
											</tr>
									<?php
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT INNER -->
		</div>
	</div>
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->

<div id="add_item" class="modal fade" tabindex="-2" aria-hidden="true" >
	<div class="modal-dialog" style="width: 500px">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Agent</h4>
			</div>
			<div class="modal-body">
				<div class="scroller" style="height:370px" data-always-visible="1" data-rail-visible1="1">
					<div class="col-md-12">
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-4 font-sm">Shareholder ID <font color='red'>*</font></label>
								<div class="col-md-5">
									<input type="hidden" id="agent_id" name="agent_id">
									<select class="form-control input-sm select2me" name="sh_id" id="sh_id">
									<?php
										if(!empty($shareholder))
										{
											$i=0;
											foreach ($shareholder as $row){
												$i++;
									?>
												<option value="<?php echo $row['code'];?>"><?php echo $row['code'];?></option>
									<?php
											}
										}
									?>
								</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-4 font-sm">Agent ID <font color='red'>*</font></label>
								<div class="col-md-3">
									<input class="form-control form-control-inline input-sm" size="20" maxlength="9" type="text" name="code" id="code"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-4 font-sm">Password <font color='red'>*</font></label>
								<div class="col-md-4">
									<input class="form-control form-control-inline input-sm" size="20" maxlength="50" type="password" name="password" id="password"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-4 font-sm">Status</label>
								<div class="col-md-5">
									<select class="form-control input-sm select2me" name="status" id="status">
										<option value="1">Active</option>	
										<option value="0">Suspend</option>	
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-4 font-sm">Name</label>
								<div class="col-md-6">
									<input class="form-control form-control-inline input-sm" size="20" maxlength="20" type="text" name="name" id="name"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-4 font-sm">Contact No.</label>
								<div class="col-md-4">
									<input class="form-control form-control-inline input-sm" size="20" maxlength="20" type="text" name="contact" id="contact"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-4 font-sm">Bank Acc. Info</label>
								<div class="col-md-8">
									<textarea class="form-control form-control-inline input-sm" name="bank_acc_info" id="bank_acc_info"></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-4 font-sm">Remark</label>
								<div class="col-md-8">
									<textarea class="form-control form-control-inline input-sm" name="remark" id="remark"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn default">Close</button>
				<button type="button" class="btn red" onclick="save_agent();">Save</button>
			</div>
		</div>
	</div>
</div>

<script>
	function home(){
		window.location.href = '<?PHP echo site_url("announcement/index"); ?>';
	}

	function save_agent()
	{
		var id=$("#agent_id").val();
		var sh_id=$("#sh_id").val();
		var code=$("#code").val();
		var password=$("#password").val();
		var status=$("#status").val();
		var name=$("#name").val();
		var contact=$("#contact").val();
		var bank_acc_info=$("#bank_acc_info").val();
		var remark=$("#remark").val();
		if(code!="" && password!="")
		{
			$.ajax({
		        type:"POST",
		        url: "<?php echo site_url('agent/get_counter'); ?>",
		        data:{"code": code},
		        success: function(response){
		        	if(response>=1 && id == "0")
		        	{
		        		alert('ID already exist!');
		        		console.log('res 22 '+response+' '+id);
		        	}
		        	else
		        	{
		        		$.ajax({
					        type:"POST",
					        url: "<?php echo site_url('agent/save_agent'); ?>",
					        data:{"id":id,"sh_id":sh_id,"code":code,"password":password,"status":status,"name":name,"contact":contact,"bank_acc_info":bank_acc_info,"remark":remark},
					        success: function(response){
					        	console.log('res: '+response);
					        	$("#agent_detail").load(location.href + " #agent_detail");
					        	$('#add_item').modal('hide');
					        }
					    });
		        	}
		        }
		    });
		    console.log('res 44 ');
		}
		else
		{
			alert('Agent ID & Password cannot be empty!');
		}
	}

	$(document).on("click", ".add_item_modal", function () {
		var id = $(this).data('id');
		var status_text;
		$("#agent_id").val(id);

		$.ajax({
	        type:"POST",
	        url: "<?php echo site_url('agent/get_agent_detail'); ?>",
	        data:{"id":id},
	        success: function(response){
	        	response = JSON.parse(response);
	        	//console.log(response);
	        	set_select2me_text('#sh_id',response.sh_id,response.sh_id);
	        	$("#code").val(response.code);
	        	$("#name").val(response.name);
	        	$("#contact").val(response.contact);
	        	$("#bank_acc_info").val(response.bank_acc_info);
	        	$("#remark").val(response.remark);

	        	switch(response.status)
	        	{
	        		case "0": status_text="Suspend";break;
	        		case "1": status_text="Active"; break;
	        		default: status_text="Suspend";break;
	        	}
	        	set_select2me_text('#status',response.status,status_text);
	        }
	    });
	});
</script>

<script src="<?php echo base_url();?>public/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url();?>public/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url();?>public/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>	