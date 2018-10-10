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
									<div class="form-group">
										&nbsp;
									</div>
								</div>
								<div class="col-md-5">
									<button type='button' class="btn btn-primary add_item_modal align-right" onclick='save_ledger();'>Submit</button>
								</div>
							</div>
						
							<div class="portlet-body">
								<table class="table table-bordered table-striped table-hover" id="ledger_detail">
									<thead>
										<tr>
											<th width="10px" class="text-center">S/N</th>
											<th width="80px" class="text-center">Code</th>
											<th width="180px" class="text-center">Header</th>
											<th width="180px" class="text-center">Parent</th>
											<th class="text-center">Ledger</th>
											<th width="150px" class="text-center">Type</th>
											<th width="150px" class="text-center">Report</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center"><?php echo "1"; ?></td>
											<td class="text-center">
												<input class="form-control form-control-inline input-sm" size="15" maxlength="5" placeholder="Code" name="code_1" id="code_1"/>
											</td>
											<td>
												<select class="form-control input-sm select2me" name="header_1" id="header_1" style="margin-bottom:10px">
													<option value="">- Please Select -</option>
													<option value="Assets">Assets</option>
													<option value="Expenses">Expenses</option>
													<option value="Other Expenses">Other Expenses</option>
													<option value="Income">Income</option>
													<option value="Other Income">Other Income</option>
													<option value="Equity">Equity</option>
													<option value="Liability">Liability</option>
												</select>
												<br>
												<input type="checkbox" id="header_checkbox" onchange="check_list('header')">
											</td>
											<td>
												<select class="form-control input-sm select2me" name="parent_1" id="parent_1" style="margin-bottom:10px">
													<option value="">- Please Select -</option>
													<?php

														if(!empty($ledger))
														{
															$i=0;
															foreach ($ledger as $row){
													?>
																<option value="<?php echo $row->name;?>"><?php echo $row->name;?></option>
													<?php
															}
														}
													?>
												</select>
												<br>
												<input type="checkbox" id="parent_checkbox" onchange="check_list('parent')">
											</td>
											<td class="text-center">
												<input class="form-control form-control-inline input-sm" name="ledger_1" id="ledger_1"/>
											</td>
											<td>
												<select class="form-control input-sm select2me" name="type_1" id="type_1" style="margin-bottom:10px">
													<option value="">- Please Select -</option>
													<option value="CR">Credit</option>
													<option value="DR">Debit</option>
												</select>
												<br>
												<input type="checkbox" id="type_checkbox" onchange="check_list('type')">
											</td>
											<td>
												<select class="form-control input-sm select2me" name="report_1" id="report_1" style="margin-bottom:10px">
													<option value="">- Please Select -</option>
													<option value="PL">Profit/Loss</option>
													<option value="BS">Balance Sheet</option>
												</select>
												<br>
												<input type="checkbox" id="report_checkbox" onchange="check_list('report')">
											</td>
										</tr>
										<?php
											for($i=2; $i<=20; $i++)
											{
										?>
												<tr>
													<td class="text-center"><?php echo $i; ?></td>
													<td class="text-center">
														<input class="form-control form-control-inline input-sm" size="15" maxlength="5" placeholder="Code" name="code_<?php echo $i;?>" id="code_<?php echo $i;?>"/>
													</td>
													<td>
														<select class="form-control input-sm select2me header_list" name="header_<?php echo $i;?>" id="header_<?php echo $i;?>">
															<option value="">- Please Select -</option>
															<option value="Assets">Assets</option>
															<option value="Expenses">Expenses</option>
															<option value="Other Expenses">Other Expenses</option>
															<option value="Income">Income</option>
															<option value="Other Income">Other Income</option>
															<option value="Equity">Equity</option>
															<option value="Liability">Liability</option>
														</select>
													</td>
													<td>
														<select class="form-control input-sm select2me parent_list" name="parent_<?php echo $i;?>" id="parent_<?php echo $i;?>">
															<option value="">- Please Select -</option>
															<?php

																if(!empty($ledger))
																{
																	foreach ($ledger as $row){
															?>
																		<option value="<?php echo $row->name;?>"><?php echo $row->name;?></option>
															<?php
																	}
																}
															?>
														</select>
													</td>
													<td class="text-center">
														<input class="form-control form-control-inline input-sm" name="ledger_<?php echo $i;?>" id="ledger_<?php echo $i;?>"/>
													</td>
													<td>
														<select class="form-control input-sm select2me type_list" name="type_<?php echo $i;?>" id="type_<?php echo $i;?>">
															<option value="">- Please Select -</option>
															<option value="CR">Credit</option>
															<option value="DR">Debit</option>
														</select>
													</td>
													<td>
														<select class="form-control input-sm select2me report_list" name="report_<?php echo $i;?>" id="report_<?php echo $i;?>" style="margin-bottom:10px">
															<option value="">- Please Select -</option>
															<option value="PL">Profit/Loss</option>
															<option value="BS">Balance Sheet</option>
														</select>
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

	function save_ledger()
	{
		var form=$("form");
		var code_1=$("#code_1").val();
		var header_1=$("#header_1").val();
		var parent=$("#parent_1").val();
		var ledger_1=$("#ledger_1").val();
		var type_1=$("#type_1").val();
		var report_1=$("#report_1").val();

		if(code_1!="" && ledger_1!= "" && type_1!="" && report_1!="")
		{
			$.ajax({
		        type:"POST",
		        url: "<?php echo site_url('ledger/save_ledger_multiple'); ?>",
		        data:form.serialize(),
		        success: function(response){
		        	window.location.href="<?php echo site_url('ledger/index'); ?>";
		        }
		    });
		}
		else
		{
			alert('Code, Ledger, Type & Report cannot be empty!');
		}
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