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
						<div class="portlet-body">
							<table class="table table-bordered table-striped table-hover" id="shareholder_detail">
								<thead>
									<tr>
										<th width="10px" class="text-center">S/N</th>
										<th width="60px" class="text-center">SH ID</th>
										<th width="60px" class="text-center">Curr</th>
										<th width="130px" class="text-center">Due Amount</th>
										<th width="120px" class="text-center">Action</th>
										<th width="80px" class="text-center">Edit</th>
										<th width="160px" class="text-center">Name</th>
										<th width="100px" class="text-center">Contact No.</th>
										<th width="120px" class="text-center">Account Ref.</th>
										<th class="text-center">Remarks</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										if(!empty($shareholder))
										{
											$i=0;
											foreach ($shareholder as $row){
												$i++;

												$get_transaction_currency=$report_model->get_transaction_currency($row['code'], 'sh');
												$count=count($get_transaction_currency);
												if($count > 0)
												{
													$x=0;
													foreach ($get_transaction_currency as $row_currency)
														{
															if($x==0)
															{
													?>	
																<tr>
																	<td class="text-center" rowspan="<?php echo $count;?>"><?php echo $i; ?></td>
																	<td class="text-center" rowspan="<?php echo $count;?>">
																		<?php echo $row['code']; ?>
																	</td>
																	<td class="text-center">
																		<?php 
																			echo $row_currency->curcode; 
																		?>
																	</td>
																	<td class="text-center">
																		<?php 
																			echo $utility->set_number($report_model->get_total_amount($row['code'],$row_currency->curr_id,'sh')); 
																		?>
																	</td>
																	<td class="text-center">
																		Payment | <?php echo anchor('report/balance_detail/sh/'.$row['id'].'/'.$row_currency->curr_id, 'View');?>
																	</td>
																	<td class="text-center actions" rowspan="<?php echo $count;?>">
																		<a data-toggle="modal" href="#add_item" data-id="<?php echo $row['id'];?>" class="add_item_modal">
																			<img src="<?php echo base_url();?>public/images/icon/edit.png">
																		</a>
																		&nbsp;
																		&nbsp;
																		<?php echo anchor('shareholder/delete/'.$row['id'].'/index', "
																			<img height='16px' src='".base_url()."public/images/icon/delete.png'>",array('onclick'=>"return confirm('Are you sure to remove this Shareholder?')"));?>
																	</td>
																	<td rowspan="<?php echo $count;?>"><?php echo $row['name']; ?></td>
																	<td class="text-center" rowspan="<?php echo $count;?>"><?php echo $row['contact']; ?></td>
																	<td rowspan="<?php echo $count;?>"><?php echo $row['bank_acc_info']; ?></td>
																	<td rowspan="<?php echo $count;?>"><?php echo $row['remark']; ?></td>
																</tr>
													<?php
															}
															else
															{
													?>
																<tr>
																	<td class="text-center">
																		<?php 
																			echo $row_currency->curcode; 
																		?>
																	</td>
																	<td class="text-center">
																		<?php 
																			echo $utility->set_number($report_model->get_total_amount($row['code'],$row_currency->curr_id,'sh')); 
																		?>
																	</td>
																	<td class="text-center">
																		Payment | <?php echo anchor('report/balance_detail/sh/'.$row['id'].'/'.$row_currency->curr_id, 'View');?>
																	</td>
																</tr>
													<?php
															}
															$x++;
														}
												}
											}
										}
										else
										{
									?>
											<tr class="gradeX">
												<td colspan="10" class="text-center"> -- No Data Available -- </td>
											</tr>
									<?php
										}
									?>
								</tbody>
							</table>

							<br>

							<table class="table table-bordered table-striped table-hover" id="shareholder_detail">
								<thead>
									<tr>
										<th width="10px" class="text-center">S/N</th>
										<th width="60px" class="text-center">AG ID</th>
										<th width="60px" class="text-center">Curr</th>
										<th width="130px" class="text-center">Due Amount</th>
										<th width="120px" class="text-center">Action</th>
										<th width="80px" class="text-center">Edit</th>
										<th width="160px" class="text-center">Name</th>
										<th width="100px" class="text-center">Contact No.</th>
										<th width="120px" class="text-center">Account Ref.</th>
										<th class="text-center">Remarks</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										if(!empty($agent))
										{
											$i=0;
											foreach ($agent as $row){
												$i++;

												$get_transaction_currency=$report_model->get_transaction_currency($row['code'], 'ag');
												$count=count($get_transaction_currency);
												if($count > 0)
												{
													$x=0;
													foreach ($get_transaction_currency as $row_currency)
														{
															if($x==0)
															{
													?>	
																<tr>
																	<td class="text-center" rowspan="<?php echo $count;?>"><?php echo $i; ?></td>
																	<td class="text-center" rowspan="<?php echo $count;?>">
																		<?php echo $row['code']; ?>
																	</td>
																	<td class="text-center">
																		<?php 
																			echo $row_currency->curcode; 
																		?>
																	</td>
																	<td class="text-center">
																		<?php 
																			echo $utility->set_number($report_model->get_total_amount($row['code'],$row_currency->curr_id,'ag')); 
																		?>
																	</td>
																	<td class="text-center">
																		Payment | <?php echo anchor('report/balance_detail/ag/'.$row['id'].'/'.$row_currency->curr_id, 'View');?>
																	</td>
																	<td class="text-center actions" rowspan="<?php echo $count;?>">
																		<a data-toggle="modal" href="#add_item" data-id="<?php echo $row['id'];?>" class="add_item_modal">
																			<img src="<?php echo base_url();?>public/images/icon/edit.png">
																		</a>
																		&nbsp;
																		&nbsp;
																		<?php echo anchor('shareholder/delete/'.$row['id'].'/index', "
																			<img height='16px' src='".base_url()."public/images/icon/delete.png'>",array('onclick'=>"return confirm('Are you sure to remove this Shareholder?')"));?>
																	</td>
																	<td rowspan="<?php echo $count;?>"><?php echo $row['name']; ?></td>
																	<td class="text-center" rowspan="<?php echo $count;?>"><?php echo $row['contact']; ?></td>
																	<td rowspan="<?php echo $count;?>"><?php echo $row['bank_acc_info']; ?></td>
																	<td rowspan="<?php echo $count;?>"><?php echo $row['remark']; ?></td>
																</tr>
													<?php
															}
															else
															{
													?>
																<tr>
																	<td class="text-center">
																		<?php 
																			echo $row_currency->curcode; 
																		?>
																	</td>
																	<td class="text-center">
																		<?php 
																			echo $utility->set_number($report_model->get_total_amount($row['code'],$row_currency->curr_id,'ag')); 
																		?>
																	</td>
																	<td class="text-center">
																		Payment | <?php echo anchor('report/balance_detail/ag/'.$row['id'].'/'.$row_currency->curr_id, 'View');?>
																	</td>
																</tr>
													<?php
															}
															$x++;
														}
												}
											}
										}
										else
										{
									?>
											<tr class="gradeX">
												<td colspan="10" class="text-center"> -- No Data Available -- </td>
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
	<div class="modal-dialog" style="width: 1100px">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Shareholder</h4>
			</div>
			<div class="modal-body">
				<div class="scroller" style="height:330px" data-always-visible="1" data-rail-visible1="1">
					<div class="col-md-6">
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-3 font-sm">Shareholder ID <font color='red'>*</font></label>
								<div class="col-md-3">
									<input type="hidden" id="shareholder_id" name="shareholder_id">
									<input class="form-control form-control-inline input-sm" size="20" maxlength="9" type="text" name="code" id="code"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-3 font-sm">Password <font color='red'>*</font></label>
								<div class="col-md-4">
									<input class="form-control form-control-inline input-sm" size="20" maxlength="50" type="password" name="password" id="password"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-3 font-sm">Status</label>
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
								<label class="control-label col-md-3 font-sm">Name</label>
								<div class="col-md-6">
									<input class="form-control form-control-inline input-sm" size="20" maxlength="20" type="text" name="name" id="name"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-3 font-sm">Contact No.</label>
								<div class="col-md-4">
									<input class="form-control form-control-inline input-sm" size="20" maxlength="20" type="text" name="contact" id="contact"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-3 font-sm">Bank Acc. Info</label>
								<div class="col-md-9">
									<textarea class="form-control form-control-inline input-sm" name="bank_acc_info" id="bank_acc_info"></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-3 font-sm">Remark</label>
								<div class="col-md-9">
									<textarea class="form-control form-control-inline input-sm" name="remark" id="remark"></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-12 font-sm"><strong>Menu Access Setting</strong></label>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<div class="col-md-2" style="width: 30px !important">
									<input type="checkbox" name="placeout" id="placeout">
								</div>
								<label class="control-label col-md-3 font-sm">Placeout</label>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<div class="col-md-2" style="width: 30px !important">
									<input type="checkbox" name="report" id="report">
								</div>
								<label class="control-label col-md-3 font-sm">Report</label>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<div class="col-md-2" style="width: 30px !important">
									<input type="checkbox" name="management" id="management">
								</div>
								<label class="control-label col-md-3 font-sm">Management</label>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<div class="col-md-2" style="width: 30px !important">
									<input type="checkbox" name="transaction" id="transaction">
								</div>
								<label class="control-label col-md-3 font-sm">Transaction</label>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<div class="col-md-2" style="width: 30px !important">
									<input type="checkbox" name="journal" id="journal">
								</div>
								<label class="control-label col-md-3 font-sm">Journal</label>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="row">
							<div class="form-group">
								<label class="control-label col-md-12 font-sm"><strong>Project Access Setting</strong></label>
							</div>
						</div>
						<?php
							if(!empty($project))
							{
								$i=0;
								foreach ($project as $row){
									$i++;
						?>
									<div class="row">
										<div class="form-group">
											<div class="col-md-2" style="width: 30px !important">
												<input type="checkbox" name="project_<?php echo $i;?>" id="project_<?php echo $i;?>" value="<?php echo $row['id'];?>">
											</div>
											<label class="control-label col-md-3 font-sm"><?php echo $row['name'];?></label>
										</div>
									</div>
						<?php
								}
							}
						?>
						<input type='hidden' name='project_counter' id='project_counter' value="<?php echo $i; ?>">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn default">Close</button>
				<button type="button" class="btn red" onclick="save_shareholder();">Save</button>
			</div>
		</div>
	</div>
</div>

<script>
	function home(){
		window.location.href = '<?PHP echo site_url("announcement/index"); ?>';
	}

	function save_menu(counter)
	{
		var id=$("#sh_id_"+counter).val();
		var placeout = 0;
		var management = 0;
		var report = 0;
		var transaction = 0;
		var journal = 0;

		if($("#cb_placeout_"+counter).is(':checked'))
		{
			placeout = 1;
		}

		if($("#cb_management_"+counter).is(':checked'))
		{
			management = 1;
		}

		if($("#cb_report_"+counter).is(':checked'))
		{
			report = 1;
		}

		if($("#cb_transaction_"+counter).is(':checked'))
		{
			transaction = 1;
		}

		if($("#cb_journal_"+counter).is(':checked'))
		{
			journal = 1;
		}

		console.log(id+' '+placeout+' '+journal+' '+management+' '+transaction+' '+report);

		$.ajax({
	        type:"POST",
	        url: "<?php echo site_url('shareholder/save_menu_shareholder'); ?>",
	        data:{"id":id,"placeout":placeout,"transaction":transaction,"journal":journal,"report":report,"management":management},
	        success: function(response){
	        	console.log('res: '+response);
	        }
	    });
	}

	function save_project(counter, project_counter)
	{
		var id=$("#sh_id_"+counter).val();
		var value=$("#cb_project_"+counter+"_"+project_counter).val();
		console.log(counter+" "+project_counter);

		if($("#cb_project_"+counter+"_"+project_counter).is(':checked'))
		{
			console.log('value add:'+value);
			$.ajax({
		        type:"POST",
		        url: "<?php echo site_url('shareholder/save_shareholder_project'); ?>",
		        data:{"id":id,"value":value},
		        success: function(response){
		        	console.log(response);
		        }
		    });
		}
		else
		{
			console.log('value delete:'+value);
			$.ajax({
		        type:"POST",
		        url: "<?php echo site_url('shareholder/delete_project_shareholder'); ?>",
		        data:{"id":id,"value":value},
		        success: function(response){
		        	console.log(response);
		        }
		    });
		}
	}

	function save_shareholder()
	{
		var id=$("#shareholder_id").val();
		var code=$("#code").val();
		var password=$("#password").val();
		var status=$("#status").val();
		var name=$("#name").val();
		var contact=$("#contact").val();
		var bank_acc_info=$("#bank_acc_info").val();
		var remark=$("#remark").val();
		var project_counter=$("#project_counter").val();
		var placeout = 0;
		var management = 0;
		var report = 0;
		var transaction = 0;
		var journal = 0;

		if($("#placeout").is(':checked'))
		{
			placeout = 1;
		}

		if($("#management").is(':checked'))
		{
			management = 1;
		}

		if($("#report").is(':checked'))
		{
			report = 1;
		}

		if($("#transaction").is(':checked'))
		{
			transaction = 1;
		}

		if($("#journal").is(':checked'))
		{
			journal = 1;
		}

		if(code!="" && password!="")
		{
			console.log('res 11 '+id);
			$.ajax({
		        type:"POST",
		        url: "<?php echo site_url('shareholder/get_counter'); ?>",
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
				        url: "<?php echo site_url('shareholder/save_shareholder'); ?>",
				        data:{"id":id,"code":code,"password":password,"status":status,"name":name,"contact":contact,"bank_acc_info":bank_acc_info,"remark":remark,"placeout":placeout,"transaction":transaction,"journal":journal,"report":report,"management":management},
				        success: function(response){
				        	console.log('res: '+response);
				        	$("#shareholder_detail").load(location.href + " #shareholder_detail");
				        	$('#add_item').modal('hide');

				        	if(response != '' && response!=null)
				        	{
				        		$.ajax({
							        type:"POST",
							        url: "<?php echo site_url('shareholder/delete_shareholder_project'); ?>",
							        data:{"id":response},
							        success: function(response){
							        	console.log(response);
							        }
							    });

				        		for(var counter = 1; counter <= project_counter; counter++)
								{
									if($("#project_"+counter).is(':checked'))
									{
										var value=$("#project_"+counter).val();
										console.log('value:'+counter);
										$.ajax({
									        type:"POST",
									        url: "<?php echo site_url('shareholder/save_shareholder_project'); ?>",
									        data:{"id":response,"value":value},
									        success: function(response){
									        	console.log(response);
									        }
									    });
									}
								}
				        	}
				        }
				    });
		        	}
		        }
		    });
		    /*console.log('res 44 ');*/
		}
		else
		{
			alert('Shareholder ID & Password cannot be empty!');
		}
	}

	$(document).on("click", ".add_item_modal", function () {
		var id = $(this).data('id');
		var status_text;
		$("#shareholder_id").val(id);

		$.ajax({
	        type:"POST",
	        url: "<?php echo site_url('shareholder/get_shareholder_detail'); ?>",
	        data:{"id":id},
	        success: function(response){
	        	response = JSON.parse(response);
	        	//console.log(response);
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

	        	if(response.placeout == '1')
	        	{
	        		$("#placeout").prop('checked', true);
	        	}
	        	else
	        	{
	        		$("#placeout").prop('checked', false);
	        	}

	        	if(response.management == '1')
	        	{
	        		$("#management").prop('checked', true);
	        	}
	        	else
	        	{

	        		$("#management").prop('checked', false);
	        	}

	        	if(response.journal == '1')
	        	{
	        		$("#journal").prop('checked', true);
	        	}
	        	else
	        	{

	        		$("#journal").prop('checked', false);
	        	}

	        	if(response.report == '1')
	        	{
	        		$("#report").prop('checked', true);
	        	}
	        	else
	        	{

	        		$("#report").prop('checked', false);
	        	}

	        	if(response.transaction == '1')
	        	{
	        		$("#transaction").prop('checked', true);
	        	}
	        	else
	        	{

	        		$("#transaction").prop('checked', false);
	        	}

	        	$("#placeout").uniform.update();
	        	$("#management").uniform.update();
	        	$("#transaction").uniform.update();
	        	$("#journal").uniform.update();
	        	$("#report").uniform.update();
	        }
	    });

		$.ajax({
	        type:"POST",
	        url: "<?php echo site_url('shareholder/get_shareholder_project_detail'); ?>",
	        data:{"id":id},
	        success: function(response){
	        	response = JSON.parse(response);
	        	console.log(response);

	        	var project_counter=$("#project_counter").val();

	        	for(var counter=1; counter<=project_counter;counter++)
        		{	
    				$("#project_"+counter).prop('checked',false);
    				$("#project_"+counter).uniform.update();
        		}

	        	$.each(response, function(i, item) {
	        		var project_id=item.project_id;

	        		for(var counter=1; counter<=project_counter;counter++)
	        		{
	        			if($("#project_"+counter).val() == project_id)
	        			{
	        				$("#project_"+counter).prop('checked',true);
	        				$("#project_"+counter).uniform.update();
	        			}
	        		}
				});
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