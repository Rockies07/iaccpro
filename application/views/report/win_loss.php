</div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
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
								<div class="col-md-12">
									<div class="form-group col-md-12">
										<label class="control-label col-md-1" style="width: 100px !important; padding-left: 0">From</label>
										<div class="col-md-4" style="width:150px !important">
											<input class="form-control form-control-inline input-sm date-picker" size="16" name="filter_from" id="filter_from" type="text" value="<?php echo $filter_from;?>"/>
										</div>
										<div class="col-md-4" style="width:150px !important">
											<input class="form-control form-control-inline input-sm date-picker" size="16" name="filter_to" id="filter_to" type="text" value="<?php echo $filter_to;?>"/>
										</div>
										<div class="col-md-2" style="width:250px !important">
											<select class="form-control input-sm select2me" name='filter_project' id="filter_project">
												<?php
													if($filter_project!='')
													{
												?>
														<option value="<?php echo $filter_project;?>"><?php echo $filter_project_text;?></option>
												<?php
													}
												?>
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
										<label class="control-label col-md-1" style="width: 100px !important; padding-left: 0">Upline</label>
										<div class="col-md-2" style="width:200px !important">
											<select class="form-control input-sm select2me" name="filter_upline" id="filter_upline" style="margin-bottom:10px">
												<?php
													if($filter_upline!='')
													{
														$filter_upline_arr=explode("-", $filter_upline);
														$filter_upline_text=$filter_upline_arr[1];
												?>
														<option value="<?php echo $filter_upline;?>"><?php echo $filter_upline_text;?></option>
												<?php
													}
												?>
												<option value="">- Please Select -</option>
												<optgroup label="Shareholder">
													<?php
														if(!empty($shareholder))
														{
															$i=0;
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
															$i=0;
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
										<div class="col-md-2" style="width:100px !important">
											<button type="submit" class="btn green"><i class="fa fa-check"></i> Submit</button>
										</div>
									</div>
								</div>
							</div>
						</form>
						<div class="portlet-body">
							<table class="table table-bordered table-striped table-hover" id="transaction_detail">
								<thead>
									<tr>
										<th width="10px" class="text-center">S/N</th>
										<th width="120px" class="text-center">Date</th>
										<th width="120px">Project</th>
										<th width="120px">URL</th>
										<th width="250px">Content ID</th>
										<th width="120px" class="text-center">I.Amount</th>
										<th width="60px" class="text-center">Curr</th>
										<th width="150px" class="text-center">Due Balance</th>
										<th width="180px" class="text-center">Formula</th>
										<th width="70px" class="text-center">PPT%</th>
										<th class="text-center">Description</th>
										<th width="100px" class="text-center">Rate@</th>
										<th width="150px" class="text-center">Win/Loss</th>
										<th width="100px" class="text-center">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										if(!empty($transaction))
										{
											$i=0;
											foreach ($transaction as $row){
												$i++;
									?>
												<tr>
													<td class="text-center"><?php echo $i; ?></td>
													<td class="text-center">
														<?php echo date('D, d-M-Y', strtotime($row->date)); ?>
													</td>
													<td>
														<?php echo $row->project_name; ?>
													</td>
													<td>
														<?php echo $row->url; ?>
													</td>
													<td>
														<?php
															if($row->sh_id!="")
															{
																$sh_id=$row->sh_id." <font color='blue'>&#9658;</font> ";
															}
															else
															{
																$sh_id="";
															}

															if($row->ag_id!="")
															{
																$ag_id=$row->ag_id." <font color='blue'>&#9658;</font> ";
															}
															else
															{
																$ag_id="";
															}

															echo $sh_id.$ag_id.$row->meb_id; 
														?>
													</td>
													<td class="text-center">
														<?php echo $utility->set_number($row->amount); ?>
													</td>
													<td class="text-center">
														<?php echo $row->curcode; ?>
													</td>
													<td class="text-center">
														<?php echo $utility->set_number($row->duebalance); ?>
													</td>
													<td class="text-center">
														<?php 
															if($row->formula!="")
															{
																echo $row->amount.$row->formula; 
															}
														?>
													</td>
													<td class="text-center">
														<?php echo $row->ppt; ?>%
													</td>
													<td>
														<?php echo $row->description; ?>
													</td>
													<td class="text-center">
														<?php echo $row->rate; ?>
													</td>
													<td class="text-center">
														<?php echo $utility->set_number($row->cpybalance); ?>
													</td>
													<td class="text-center actions">
														<a data-toggle="modal" href="#add_item" data-id="<?php echo $row->id;?>" class="add_item_modal">
															<img src="<?php echo base_url();?>public/images/icon/edit.png">
														</a>
														&nbsp;
														&nbsp;
														<a data-toggle="modal" href="#"  class="add_item_modal" onclick="delete_transaction(<?php echo $row->id;?>);">
															<img height='16px' src="<?php echo base_url();?>public/images/icon/delete.png">
														</a>
													</td>
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
									<tr>
										<td colspan = "14" class="text-right">&nbsp;</td>
									</tr>
									<tr>
										<td colspan = "12" class="text-right"><strong>Currency</strong></td>
										<!-- <td class="text-center"><strong>Code</strong></td> -->
										<td class="text-center"><strong>Total</strong></td>
										<td  class="text-center">&nbsp;</td>
									</tr>
									<?php 
										if(!empty($total_win_loss))
										{
											$i=0;
											foreach ($total_win_loss as $row){
												$i++;
									?>
												<tr>
													<td class="text-right" colspan='12'><?php echo $row->currency_name; ?></td>
													<td class="text-center">
														<?php
															echo $utility->set_number($row->amount);
														?>
													</td>
													<td class="text-center">&nbsp;</td>
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
				<h4 class="modal-title">Placeout</h4>
			</div>
			<div class="modal-body">
				<div class="scroller" style="height:170px" data-always-visible="1" data-rail-visible1="1">
					<div class="col-md-12">
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-4 font-sm">Project <font color='red'>*</font></label>
								<div class="col-md-5">
									<input type="hidden" id="edit_id" name="edit_id">
									<select class="form-control input-sm select2me" name="project" id="project" onchange="get_member_list();">
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
								<label class="control-label col-md-4 font-sm">Content ID <font color='red'>*</font></label>
								<div class="col-md-5">
									<input type="hidden" id="member_id_str" name="member_id_str">
									<select class="form-control input-sm select2me member_id" name="member_id" id="member_id">
										<option value="">- Please Select -</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-4 font-sm">Amount <font color='red'>*</font></label>
								<div class="col-md-4">
									<input class="form-control form-control-inline input-sm" size="20" maxlength="50" type="amount" name="amount" id="amount"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-4 font-sm">Description</label>
								<div class="col-md-5">
									<select class="form-control input-sm select2me" name="description" id="description">
										<option value="1">Active</option>	
										<option value="0">Suspend</option>	
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn default">Close</button>
				<button type="button" class="btn red" onclick="save_transaction();">Save</button>
			</div>
		</div>
	</div>
</div>

<script>
	function home()
	{
		window.location.href = '<?PHP echo site_url("announcement/index"); ?>';
	}

	function save_transaction()
	{
		var id=$("#edit_id").val();
		var project=$("#project").val();
		var member_id=$("#member_id").val();
		if(member_id=="")
		{
			member_id = $("#member_id_str").val();
		}
		var amount=$("#amount").val();
		var description=$("#description").val();

		if(amount!="" && member_id!="")
		{
			$.ajax({
		        type:"POST",
		        url: "<?php echo site_url('placeout/edit_placeout'); ?>",
		        data:{"edit_id":id,"project":project,"member_id":member_id,"amount":amount,"description":description},
		        success: function(response){
		        	$("#transaction_detail").load(location.href + " #transaction_detail");
		        	$("#add_item").hide();
		        }
		    });
		}
		else
		{
			alert('Amount cannot be empty!');
		}
	}

	function get_member_list()
	{
		var project=$("#project").val();

		$.ajax({
	        type:"POST",
	        url: "<?php echo site_url('member/get_data_list'); ?>",
	        data:{"project":project},
	        success: function(response){
	        	var response = JSON.parse(response);
	        	console.log(response);

	        	for(var counter=1;counter<=20;counter++)
	        	{
	        		$("#member_id").find('option').remove();

	        		$("#member_id").append
					(
				        $('<option></option>').val('').html("- Please Select -")
				    )
	        	}

        		$.each (response, function (data) {
				    var ag_id="";
				    var sh_id="";

				    if(response[data].sh_id!="")
				    {
				    	sh_id=response[data].sh_id+".";
				    }
				    else
				    {
				    	sh_id="";
				    }

				    if(response[data].ag_id!="")
				    {
				    	ag_id=response[data].ag_id+".";
				    }
				    else
				    {
				    	ag_id="";
				    }

				    $("#member_id").append
					(
				        $('<option></option>').val(response[data].code).html(sh_id+ag_id+response[data].code)
				    )
				});
	        }
	    });
	}

	$(document).on("click", ".add_item_modal", function () {
		var id = $(this).data('id');
		var status_text;
		$("#edit_id").val(id);

		$.ajax({
	        type:"POST",
	        url: "<?php echo site_url('placeout/get_placeout_detail'); ?>",
	        data:{"id":id},
	        success: function(response){
	        	response = JSON.parse(response);
	        	console.log(response);
	        	set_select2me_text('#project',response.project_id,response.project_name);
	        	get_member_list();
	        	var ag_id=response.ag_id;
	        	var sh_id=response.sh_id;
	        	var meb_id = "";
	        	if(sh_id!="")
	        	{
	        		meb_id=sh_id+".";
	        	}

	        	if(ag_id!="")
	        	{
	        		meb_id+=ag_id+".";
	        	}

	        	meb_id+=response.meb_id;

	        	set_select2me_text('#member_id',response.meb_id,meb_id);

	        	$("#member_id_str").val(response.meb_id);
	        	$("#amount").val(response.amount);
	        	$("#description").val(response.description);
	        }
	    });
	});

	function delete_transaction(id)
	{
		if(confirm('Are you sure to remove this transaction?'))
		{
			$.ajax({
		        type:"POST",
		        url: "<?php echo site_url('report/delete'); ?>",
		        data:{"id": id},
		        success: function(response){
		        	//console.log('res: '+id);
		        	/*$("#transaction_detail").load(location.href + " #transaction_detail");*/
		        	$("form").submit();
		        }
		    });
		}
	}
</script>

<script src="<?php echo base_url();?>public/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url();?>public/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url();?>public/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>	

<script type="text/javascript" src="<?php echo base_url();?>public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>public/assets/admin/pages/scripts/components-pickers.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {       
       // initiate layout and plugins
       ComponentsPickers.init();
    });   
</script>