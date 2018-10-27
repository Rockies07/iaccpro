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
									<?php echo anchor('member/add', 'Add Member',array('class' => 'btn btn-primary add_item_modal align-right', 'target' => '_blank'));?>
								</div>
							</div>
						</form>
						<div class="portlet-body">
							<table class="table table-bordered table-striped table-hover" id="member_detail">
								<thead>
									<tr style="border-bottom: solid 1px #ddd">
										<th class="text-center">&nbsp;</th>
										<th colspan="7" class="text-center">General Information</th>
										<th colspan="3" class="text-center">Account Setting</th>
										<th colspan="3" class="text-center">&nbsp;</th>
									</tr>
									<tr>
										<th width="10px" class="text-center">S/N</th>
										<th width="100px" class="text-center">Project</th>
										<th width="120px" class="text-center">Upline ID</th>
										<th width="180px" class="text-center">Account ID (Member)*</th>
										<th width="60px" class="text-center">Password</th>
										<th width="100px" class="text-center">URL Site</th>
										<th width="80px" class="text-center">Status</th>
										<th class="text-center">Remark</th>
										<th width="60px" class="text-center">Curr</th>
										<th width="60px" class="text-center">PPT%</th>
										<th width="160px" class="text-center">Formula</th>
										<th width="80px" class="text-center">Action</th>
										<th width="140px" class="text-center">Create Date</th>
										<th width="100px" class="text-center">Create By</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										if(!empty($member))
										{
											$i=0;
											foreach ($member as $row){
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
													<td class="text-center"><?php echo $row['project_name']; ?></td>
													<td class="text-center">
														<?php 
															$sh_id=$row['sh_id'];
															$ag_id=$row['ag_id'];

															if($sh_id!="")
															{
																if($ag_id!="")
																{
																	echo $sh_id." <font color='blue'>&#9658;</font> ".$ag_id;
																}	
																else
																{
																	echo $sh_id;
																}
															}
															else
															{
																echo $ag_id;
															}
														?>
													</td>
													<td class="text-center">
														<?php echo $row['code']; ?>
													</td>
													<td class="text-center">*****</td>
													<td class="text-center"><?php echo $row['url_name'];?></td>
													<td class="text-center"><?php echo $status_str; ?></td>
													<td><?php echo $row['remark']; ?></td>
													<td class="text-center"><?php echo $row['curcode']; ?></td>
													<td class="text-center"><?php echo $row['ppt']; ?></td>
													<td class="text-center"><?php echo $row['formula']; ?></td>
													<td class="text-center actions">
														<a data-toggle="modal" href="#add_item" data-id="<?php echo $row['id'];?>" class="add_item_modal">
															<img src="<?php echo base_url();?>public/images/icon/edit.png">
														</a>
														&nbsp;
														&nbsp;
														<?php echo anchor('member/delete/'.$row['id'].'/index', "
															<img height='16px' src='".base_url()."public/images/icon/delete.png'>",array('onclick'=>"return confirm('Are you sure to remove this member?')"));?>
													</td>
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
				<h4 class="modal-title">Member</h4>
			</div>
			<div class="modal-body">
				<div class="scroller" style="height:450px" data-always-visible="1" data-rail-visible1="1">
					<div class="col-md-12">
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-4 font-sm">Project <font color='red'>*</font></label>
								<div class="col-md-6">
									<select class="form-control input-sm select2me" name='project' id="project">
										<option value="">- Please Select -</option>
										<?php
											if(!empty($project))
											{
												$i=0;
												foreach ($project as $row){
										?>
													<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
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
								<label class="control-label col-md-4 font-sm">Upline ID <font color='red'>*</font></label>
								<div class="col-md-5">
									<input type="hidden" id="member_id" name="member_id">
									<select class="form-control input-sm select2me" name="upline_id" id="upline_id">
										<option value="">- Please Select -</option>
										<optgroup label="Shareholder">
											<?php
												if(!empty($shareholder))
												{
													foreach ($shareholder as $row){
											?>
														<option value="<?php echo 'sh-'.$row['code'];?>"><?php echo $row['code'];?></option>
											<?php
													}
												}
											?>
										</optgroup>
										<optgroup label="Agent">
											<?php

												if(!empty($agent))
												{
													foreach ($agent as $row){
											?>
														<option value="<?php echo 'ag-'.$row['code'];?>"><?php echo $row['sh_id'].' <font color="blue">&#9658;</font> '.$row['code'];?></option>
											<?php
													}
												}
											?>
										</optgroup>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-4 font-sm">Member ID <font color='red'>*</font></label>
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
								<label class="control-label col-md-4 font-sm">URL Site</label>
								<div class="col-md-6">
									<select class="form-control input-sm select2me" name="url" id="url">
										<option value="">- Please Select -</option>
										<?php

											if(!empty($url))
											{
												$i=0;
												foreach ($url as $row){
										?>
													<option value="<?php echo $row['id'];?>"><?php echo $row['url'];?></option>
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
								<label class="control-label col-md-4 font-sm">Remark</label>
								<div class="col-md-8">
									<textarea class="form-control form-control-inline input-sm" name="remark" id="remark"></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-4 font-sm">Curr</label>
								<div class="col-md-8">
									<select class="form-control input-sm select2me" name="curr" id="curr">
										<option value="">- Please Select -</option>
										<?php

											if(!empty($currency))
											{
												$i=0;
												foreach ($currency as $row){
										?>
													<option value="<?php echo $row['id'];?>"><?php echo $row['code'];?></option>
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
								<label class="control-label col-md-4 font-sm">PPT</label>
								<div class="col-md-4">
									<input class="form-control form-control-inline input-sm" size="5" maxlength="5" type="text" name="ppt" id="ppt"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-4 font-sm">Formula</label>
								<div class="col-md-8">
									<textarea class="form-control form-control-inline input-sm" name="formula" id="formula"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn default">Close</button>
				<button type="button" class="btn red" onclick="save_member();">Save</button>
			</div>
		</div>
	</div>
</div>

<script>
	function home(){
		window.location.href = '<?PHP echo site_url("announcement/index"); ?>';
	}

	function save_member()
	{
		var project=$("#project").val();
		var id=$("#member_id").val();
		var upline_id=$("#upline_id").val();
		var code=$("#code").val();
		var password=$("#password").val();
		var status=$("#status").val();
		var url=$("#url").val();
		var remark=$("#remark").val();
		var curr=$("#curr").val();
		var ppt=$("#ppt").val();
		var formula=$("#formula").val();
		if(code!="")
		{
			if(id=="" && password=="")
			{
				alert('Password cannot be empty!');
				return false;
			}
			else
			{
				$.ajax({
			        type:"POST",
			        url: "<?php echo site_url('member/save_member'); ?>",
			        data:{"id":id,"upline_id":upline_id,"code":code,"password":password,"status":status,"url":url,"curr":curr,"ppt":ppt,"remark":remark,"formula":formula,"project":project},
			        success: function(response){
			        	console.log('res: '+response);
			        	$("#member_detail").load(location.href + " #member_detail");
			        	$('#add_item').modal('hide');
			        }
			    });
			}
		}
		else
		{
			alert('Member ID & Password cannot be empty!');
		}
	}

	$(document).on("click", ".add_item_modal", function () {
		var id = $(this).data('id');
		var status_text;
		$("#member_id").val(id);

		$.ajax({
	        type:"POST",
	        url: "<?php echo site_url('member/get_member_detail'); ?>",
	        data:{"id":id},
	        success: function(response){
	        	response = JSON.parse(response);
	        	console.log(response);
	        	var sh_id=response.sh_id;
	        	var ag_id=response.ag_id;
	        	if(sh_id!='')
	        	{
	        		if(ag_id!="")
	        		{
	        			set_select2me_text('#upline_id','ag-'+ag_id,sh_id+" &#9658; "+ag_id);
	        		}
	        		else
	        		{
	        			set_select2me_text('#upline_id','sh-'+sh_id,sh_id);
	        		}
	        	}
	        	else
	        	{
	        		set_select2me_text('#upline_id','ag-'+ag_id,ag_id);
	        	}

	        	$("#code").val(response.code);

	        	set_select2me_text('#url',response.url_id,response.url_name);
	        	set_select2me_text('#curr',response.curr,response.curcode);
	        	$("#formula").val(response.formula);
	        	$("#ppt").val(response.ppt);
	        	$("#remark").val(response.remark);

	        	switch(response.status)
	        	{
	        		case "0": status_text="Suspend";break;
	        		case "1": status_text="Active"; break;
	        		default: status_text="Suspend";break;
	        	}
	        	set_select2me_text('#status',response.status,status_text);
	        	set_select2me_text('#project',response.project_id,response.project_name);
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