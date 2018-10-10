</div>
<link rel="stylesheet" href="<?php echo base_url();?>public/assets/global/plugins/jquery-ui/jquery-ui.min.css">
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
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

	.text-center{
		vertical-align: middle !important;
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
									<div class="form-group col-md-6">
										<label class="control-label col-md-6 font-sm">Date of Entries</label>
										<div class="col-md-4">
											<input class="form-control form-control-inline input-sm date-picker" size="16" name="date" id="date" type="text" value="<?php echo date('d-m-Y');?>"/>
										</div>
									</div>
									<div class="form-group  col-md-3">
										<select class="form-control input-sm select2me" name='project' id="project" onchange="get_member_list();">
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
									<button type='button' class="btn btn-primary add_item_modal align-right" onclick='return save_member();'>Submit</button>
								</div>
							</div>
						
							<div class="portlet-body">
								<table class="table table-bordered table-striped table-hover" id="member_detail">
									<thead>
										<tr>
											<th width="10px" class="text-center">S/N</th>
											<th width="200px" class="text-center">ID</th>
											<th width="180px" class="text-center">Amount</th>
											<th width="300px" class="text-center">Description</th>
											<th width="150px" class="text-center">Curr</th>
											<th width="80px" class="text-center">PPT%</th>
											<th width="200px" class="text-center">Formula</th>
											<th class="text-center">Remark</th>
										</tr>
									</thead>
									<tbody>
										<?php
											for($i=1; $i<=20; $i++)
											{
										?>
												<tr>
													<td class="text-center"><?php echo $i; ?></td>
													<td>
														<select class="form-control input-sm select2me member_id" name="id_<?php echo $i;?>" id="id_<?php echo $i;?>" onChange="get_member_detail(<?php echo $i;?>)">
															<option value="">- Please Select -</option>
														</select>
													</td>
													<td>
														<input class="form-control form-control-inline input-sm" name="amount_<?php echo $i;?>" id="amount_<?php echo $i;?>" maxlength="15"/>
													</td>
													<td>
														<input class="form-control form-control-inline input-sm" name="description_<?php echo $i;?>" id="description_<?php echo $i;?>" maxlength="80"/>
													</td>
													<td class="text-center">
														<span id="curr_<?php echo $i;?>"></span>
													</td>
													<td class="text-center">
														<span id="ppt_<?php echo $i;?>"></span>
													</td>
													<td class="text-center">
														<span id="formula_<?php echo $i;?>"></span>
													</td>
													<td class="text-center">
														
														<span id="remark_<?php echo $i;?>"></span>
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
		var id=$("#id_1").val();
		var amount=$("#amount_1").val();

		if(id!="" && amount!= "")
		{
			$.ajax({
		        type:"POST",
		        url: "<?php echo site_url('placeout/save_placeout'); ?>",
		        data:form.serialize(),
		        success: function(response){
		        	console.log(response);
		        	window.location.href="<?php echo site_url('placeout/index'); ?>";
		        }
		    });
		}
		else
		{
			alert('ID & Amount cannot be empty!');
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
	        		$("#id_"+counter).find('option').remove();

	        		$("#id_"+counter).append
					(
				        $('<option></option>').val('').html("- Please Select -")
				    )
	        	}

	        	for(var counter=1;counter<=20;counter++)
	        	{
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

					    $("#id_"+counter).append
						(
					        $('<option></option>').val(response[data].id).html(sh_id+ag_id+response[data].code)
					    )
					});
	        	}
	        }
	    });
	}

	function get_member_detail(counter)
	{
		var id=$("#id_"+counter).val();

		if(id!="")
		{
			$.ajax({
		        type:"POST",
		        url: "<?php echo site_url('member/get_member_detail'); ?>",
		        data:{"id":id},
		        success: function(response){
		        	var response = JSON.parse(response);

		        	$('#curr_'+counter).text(response.curcode);
		        	$("#formula_"+counter).text(response.formula);
		        	$("#ppt_"+counter).text(response.ppt);
		        	$("#remark_"+counter).text(response.remark);
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
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url();?>public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>public/assets/admin/pages/scripts/components-pickers.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {       
       // initiate layout and plugins
       ComponentsPickers.init();
    });   
</script>