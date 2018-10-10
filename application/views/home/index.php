<!-- DataTables -->
<link rel="stylesheet" media="screen" href="<?php echo base_url();?>public/theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css" />
<link rel="stylesheet" media="screen" href="<?php echo base_url();?>public/theme/scripts/plugins/tables/DataTables/extras/TableTools/media/css/TableTools.css" />

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/jquery.jqplot.min.css" />

<style>
.jqplot-data-label{
	color: #000;
	font-weight: bold;
	font-size: 18px;
}

</style>

<div id="content">
	<ul class="breadcrumb">
		<li><a href="index.html?lang=en" class="glyphicons home"><i></i> <?php echo $site_name;?></a></li>
		<li class="divider"></li>
		<li>Dashboard</li>
	</ul>
	<div class="separator bottom"></div>

	<div class="heading-buttons">
		<h3 class="glyphicons coins"><i></i> Dashboard</h3>
	</div>
	<div class="separator bottom"></div>

	<div class="innerLR">
		<div class="row-fluid">
			<div class="span3">
				<div class="separator"></div>
				<h4 class="glyphicons clock"><i></i> Workers Breakdown</h4>
				<div class="btn-group btn-group-vertical block">
					<?php echo anchor('employee/custom_list/total', '<i></i> <span>'.$no_of_man.'</span>Total Worker', array('class'=>'btn btn-icon btn-default btn-block glyphicons group count'));?>
					<?php echo anchor('employee/custom_list/spass', '<i></i> <span>'.$no_of_man_spass.'</span>SPass', array('class'=>'btn btn-icon btn-default btn-block glyphicons user count'));?>
					<?php echo anchor('employee/custom_list/mye', '<i></i> <span>'.$no_of_man_mye.'</span>MYE', array('class'=>'btn btn-icon btn-default btn-block glyphicons user count'));?>
					<?php echo anchor('employee/custom_list/tier_1', '<i></i> <span>'.$no_of_man_tier_1.'</span>Skilled/Tier 1', array('class'=>'btn btn-icon btn-default btn-block glyphicons user_add count'));?>
					<?php echo anchor('employee/custom_list/tier_2', '<i></i> <span>'.$no_of_man_tier_2.'</span>Unskilled/Tier 2', array('class'=>'btn btn-icon btn-default btn-block glyphicons user count'));?>
				</div>
			</div>
			<div class="span3">
				<div class="separator"></div>
				<h4 class="glyphicons clock"><i></i> Skilled Workers</h4>
				<div class="btn-group btn-group-vertical block">
					<a class="btn btn-icon btn-default btn-block glyphicons group count"><i></i> <span><?php echo number_format(($no_of_man_tier_1/($no_of_man_mye+$no_of_man_tier_1+$no_of_man_tier_2))*100,2);?>%</span>Skilled Worker(%)</a>
					<a class="btn btn-icon btn-default btn-block glyphicons user_add count"><i></i> <span><?php echo $no_of_man_tier_1."/".($no_of_man_mye+$no_of_man_tier_1+$no_of_man_tier_2);?></span>Skilled Worker(#)</a>
					<?php echo anchor('employee/custom_list/ctms', '<i></i> <span>'.$no_of_man_ctms.'</span>Eligible for CT/MS', array('class'=>'btn btn-icon btn-default btn-block glyphicons suitcase count'));?>
					<?php echo anchor('employee/custom_list/ms2', '<i></i> <span>'.$no_of_man_ms2.'</span>Eligible for MS-2', array('class'=>'btn btn-icon btn-default btn-block glyphicons briefcase count'));?>
				</div>
			</div>
		</div>
	</div>

	<div class="separator bottom"></div>

	<div class="separator bottom"></div>

	<div class="innerLR">
		<div class="row-fluid">
			<div class="span6">
				<div class="separator"></div>
				<h4 class="glyphicons clock"><i></i> Work Permit Expiry</h4>
				<div class="btn-group btn-group-vertical block">
					<a class="btn btn-icon btn-default btn-block glyphicons alarm count"><i></i> 
						<span>
							<?php
								$i=0;
								if (!empty($wp_exp_list))
								{
									foreach ($wp_exp_list as $wp_exp_list_item)
									{
										if($i==0)
										{
											echo $wp_exp_list_item["nts"];
										}
										else
										{
											echo ", ".$wp_exp_list_item["nts"];
										}
										$i++;
									}
								}
								else
								{
									echo "-";
								}
							?>
						</span>
						Current Month
					</a>
					<a class="btn btn-icon btn-default btn-block glyphicons alarm count"><i></i> 
						<span>
							<?php
								$i=0;
								if (!empty($wp_exp_list_next))
								{
									foreach ($wp_exp_list_next as $wp_exp_list_item)
									{
										if($i==0)
										{
											echo $wp_exp_list_item["nts"];
										}
										else
										{
											echo ", ".$wp_exp_list_item["nts"];
										}
										$i++;
									}
								}
								else
								{
									echo "-";
								}
							?>
						</span>
						Next Month
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="separator bottom"></div>

	<div class="separator bottom"></div>

	<div class="innerLR">
		<div class="row-fluid">
			<div class="span6">
				<div class="separator"></div>
				<h4 class="glyphicons clock"><i></i> CSOC</h4>
				<div class="btn-group btn-group-vertical block">
					<a class="btn btn-icon btn-default btn-block glyphicons alarm count"><i></i> 
						<span>
							<?php
								$i=0;
								if (!empty($csoc_exp_list))
								{
									foreach ($csoc_exp_list as $csoc_exp_list_item)
									{
										if($i==0)
										{
											echo $csoc_exp_list_item["nts"];
										}
										else
										{
											echo ", ".$csoc_exp_list_item["nts"];
										}
										$i++;
									}
								}
								else
								{
									echo "-";
								}
							?>
						</span>
						Current Month
					</a>
					<a class="btn btn-icon btn-default btn-block glyphicons alarm count"><i></i> 
						<span>
							<?php
								$i=0;
								if (!empty($csoc_exp_list_next))
								{
									foreach ($csoc_exp_list_next as $csoc_exp_list_item)
									{
										if($i==0)
										{
											echo $csoc_exp_list_item["nts"];
										}
										else
										{
											echo ", ".$csoc_exp_list_item["nts"];
										}
										$i++;
									}
								}
								else
								{
									echo "-";
								}
							?>
						</span>
						Next Month
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="separator bottom"></div>

	<div class="separator bottom"></div>

	<div class="innerLR">
		<div class="row-fluid">
			<div class="span3">
				<div class="separator"></div>
				<h4 class="glyphicons clock"><i></i> Position Breakdown </h4>
				<div class="btn-group btn-group-vertical block">
					<?php echo anchor('employee/custom_list/pos_std', '<i></i> <span>'.$no_of_man_std.'</span>Storeman/Driver', array('class'=>'btn btn-icon btn-default btn-block glyphicons group count'));?>
					<?php echo anchor('employee/custom_list/pos_spvsf', '<i></i> <span>'.$no_of_man_spvsf.'</span>Supervisor/Safety', array('class'=>'btn btn-icon btn-default btn-block glyphicons group count'));?>
					<?php echo anchor('employee/custom_list/pos_e', '<i></i> <span>'.$no_of_man_e.'</span>Erector', array('class'=>'btn btn-icon btn-default btn-block glyphicons group count'));?>
					<?php echo anchor('employee/custom_list/pos_gw', '<i></i> <span>'.$no_of_man_gw.'</span>General Worker', array('class'=>'btn btn-icon btn-default btn-block glyphicons group count'));?>
				</div>
			</div>
			<div class="span3">
				<div class="separator"></div>
				<h4 class="glyphicons clock"><i></i> Airport Pass </h4>
				<div class="btn-group btn-group-vertical block">
					<?php echo anchor('employee/custom_list/ap', '<i></i> <span>'.$no_of_man_ap.'</span>Ap Pass Holder (Total)', array('class'=>'btn btn-icon btn-default btn-block glyphicons group count'));?>
					<?php echo anchor('employee/custom_list/ap_i', '<i></i> <span>'.$no_of_man_ap_i.'</span>Ap Pass Holder (Indian)', array('class'=>'btn btn-icon btn-default btn-block glyphicons group count'));?>
					<?php echo anchor('employee/custom_list/ap_b', '<i></i> <span>'.$no_of_man_ap_b.'</span>Ap Pass Holder (Bangladesh)', array('class'=>'btn btn-icon btn-default btn-block glyphicons group count'));?>
				</div>
			</div>
		</div>
	</div>

	<div class="span6" style="position: absolute; top: 25px; left: 50%;">
		<div id="pie8" style="margin-left:20px; width:600px; height:600px;"></div>
	</div>

	<br/>		
		<!-- End Content -->
</div>

<script>
	$(document).ready(function(){ 
	    var data = [['SPass',<?php echo $no_of_man_spass;?>], ['MYE',<?php echo $no_of_man_mye;?>],['Skilled/Tier 1',<?php echo $no_of_man_tier_1;?>],['Unskilled/Tier 2',<?php echo $no_of_man_tier_2;?>]];
	         
	    var plot8 = $.jqplot('pie8', [data], {
	        grid: {
	            drawBorder: false, 
	            drawGridlines: false,
	            background: '#ffffff',
	            shadow:false
	        },
	        axesDefaults: {
	             
	        },
	        seriesDefaults:{
	            renderer:$.jqplot.PieRenderer,
	            rendererOptions: {
	                showDataLabels: true,
	                dataLabelThreshold: 0, 
	            }
	        },
	        legend: {
	            show: true,
	            location: 'e',
	            fontSize: '12pt'
	        }
	    }); 
	});
</script>

<!-- DataTables -->
<script src="<?php echo base_url();?>public/theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>public/theme/scripts/plugins/tables/DataTables/extras/TableTools/media/js/TableTools.min.js"></script>
<script src="<?php echo base_url();?>public/theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js"></script>
<script src="<?php echo base_url();?>public/theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.jqplot.min.js"></script>
<script src="<?php echo base_url();?>public/js/jqplot.pieRenderer.min.js"></script>

