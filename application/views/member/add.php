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
									<div class="form-group  col-md-3">
										<select class="form-control input-sm select2me" name='project' id="project" onchange="get_url_by_project();">
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
								<div class="col-md-5">
									<button type='button' class="btn btn-primary add_item_modal align-right" onclick='save_member();'>Submit</button>
								</div>
							</div>
						
							<div class="portlet-body">
								<table class="table table-bordered table-striped table-hover" id="member_detail">
									<thead>
										<tr>
											<th width="10px" class="text-center">S/N</th>
											<th width="200px" class="text-center">Upline ID</th>
											<th width="180px" class="text-center">Account ID (Member)*</th>
											<th width="120px" class="text-center">Password</th>
											<th width="150px" class="text-center">URL Site</th>
											<th width="80px" class="text-center">Status</th>
											<th class="text-center">Remarks</th>
											<th width="150px" class="text-center">Curr</th>
											<th width="80px" class="text-center">PPT%</th>
											<th width="150px" class="text-center">Formula</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center"><?php echo "1"; ?></td>
											<td>
												<select class="form-control input-sm select2me" name="upline_1" id="upline_1" style="margin-bottom:10px">
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
												<br>
												<input type="checkbox" id="upline_checkbox" onchange="check_list('upline')">
											</td>
											<td>
												<input class="form-control form-control-inline input-sm" name="code_1" id="code_1"/>
											</td>
											<td>
												<input class="form-control form-control-inline input-sm" name="password_1" id="password_1"/>
											</td>
											<td>
												<select class="form-control input-sm url_site" name="url_1" id="url_1" style="margin-bottom:10px">
													<option value="">- Please Select -</option>

												</select>
												<br>
												<input type="checkbox" id="url_checkbox" onchange="check_list('url')">
											</td>
											<td class="text-center">
												<select class="form-control input-sm select2me" name="status_1" id="status_1" style="margin-bottom:10px">
													<option value="1">Active</option>
													<option value="0">Suspend</option>
												</select>
											</td>
											<td>
												<input class="form-control form-control-inline input-sm" name="remark_1" id="remark_1"/>
											</td>
											<td>
												<select class="form-control input-sm select2me" name="curr_1" id="curr_1" style="margin-bottom:10px">
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
												<br>
												<input type="checkbox" id="curr_checkbox" onchange="check_list('curr')">
											</td>
											<td>
												<input class="form-control form-control-inline input-sm" name="ppt_1" id="ppt_1" onkeypress="return isNumberKey(event);" maxlength='5' value="100"/>
											</td>
											<td>
												<input class="form-control form-control-inline input-sm" name="formula_1" id="formula_1"/>
											</td>
										</tr>
										<?php
											for($i=2; $i<=20; $i++)
											{
										?>
												<tr>
													<td class="text-center"><?php echo $i; ?></td>
													<td>
														<select class="form-control input-sm select2me" name="upline_<?php echo $i;?>" id="upline_<?php echo $i;?>" >
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
													</td>
													<td>
														<input class="form-control form-control-inline input-sm" name="code_<?php echo $i;?>" id="code_<?php echo $i;?>"/>
													</td>
													<td>
														<input class="form-control form-control-inline input-sm" name="password_<?php echo $i;?>" id="password_<?php echo $i;?>"/>
													</td>
													<td>
														<select class="form-control input-sm url_site" name="url_<?php echo $i;?>" id="url_<?php echo $i;?>">
															<option value="">- Please Select -</option>
														</select>
													</td>
													<td class="text-center">
														<select class="form-control input-sm select2me" name="status_<?php echo $i;?>" id="status_<?php echo $i;?>">
															<option value="1">Active</option>
															<option value="0">Suspend</option>
														</select>
													</td>
													<td>
														<input class="form-control form-control-inline input-sm" name="remark_<?php echo $i;?>" id="remark_<?php echo $i;?>"/>
													</td>
													<td>
														<select class="form-control input-sm select2me" name="curr_<?php echo $i;?>" id="curr_<?php echo $i;?>">
															<option value="">- Please Select -</option>
															<?php

																if(!empty($currency))
																{
																	foreach ($currency as $row){
															?>
																		<option value="<?php echo $row['id'];?>"><?php echo $row['code'];?></option>
															<?php
																	}
																}
															?>
														</select>
													</td>
													<td>
														<input class="form-control form-control-inline input-sm" name="ppt_<?php echo $i;?>" id="ppt_<?php echo $i;?>" onkeypress="return isNumberKey(event);" maxlength='5' value="100"/>
													</td>
													<td>
														<input class="form-control form-control-inline input-sm" name="formula_<?php echo $i;?>" id="formula_<?php echo $i;?>"/>
													</td>
												</tr>
										<?php
											}
										?>
									</tbody>
								</table>
							</div>
						</form>
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

<script>
	function home(){
		window.location.href = '<?PHP echo site_url("announcement/index"); ?>';
	}

	function save_member()
	{
		var form=$("form");
		var code=$("#code_1").val();
		var upline=$("#upline_1").val();
		var project=$("#project").val();
		var password_1=$("#password_1").val();
		var codecheck;

		if(code!="" && password_1!= "" && project!="" && upline!="")
		{
			$.ajax({
		        type:"POST",
		        url: "<?php echo site_url('member/get_counter'); ?>",
		        data:form.serialize(),
		        success: function(response){
		        	/*console.log('res '+response);*/
		        	if(response>0)
		        	{
		        		console.log(response);
		        		alert('ID in row '+response+' already exist!');
		        		$("#code_"+response).focus();
		        		return false;
		        	}
		        	else
		        	{
		        		//console.log(form.serialize());
						$.ajax({
					        type:"POST",
					        url: "<?php echo site_url('member/save_member_multiple'); ?>",
					        data:form.serialize(),
					        success: function(response){
					        	console.log(response);
					        	window.location.href="<?php echo site_url('member/index'); ?>";
					        }
					    });
		        	}
		        }
		    });
		}
		else
		{
			alert('Upline, Code, Password & Project cannot be empty!');
		}
	}

	function get_url_by_project()
	{
		var project = $("#project").val();

		$.ajax({
	        type:"POST",
	        url: "<?php echo site_url('url/get_url_by_project_id'); ?>",
	        data:{"project":project},
	        success: function(response){
	        	/*console.log(response);*/
	        	response=JSON.parse(response);

	        	$('.url_site').find('option').remove().end();
	        	var newOption = new Option('- Please Select -', '', false, false);
				$('.url_site').append(newOption);

	        	$.each(response, function(index) {
		            console.log(response[index].url);
		            var newOption = new Option(response[index].url, response[index].id, false, false);
					$('.url_site').append(newOption);
		        });
	        }
	    });
	}

	function check_list(label)
	{
		var checklist=$("#"+label+"_checkbox");
		var value=$("#"+label+"_1").val();
		var text=$("#"+label+"_1 option:selected").text();
		//console.log(value+' '+text);

		if ( checklist.is(':checked') ) 
		{
			for(var i=2;i<=20;i++)
			{
				set_select2me_text('#'+label+'_'+i,value,text);
			}
		}
		else
		{
			for(var i=2;i<=20;i++)
			{
				set_select2me_text('#'+label+'_'+i,'','- Please Select -');
			}
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