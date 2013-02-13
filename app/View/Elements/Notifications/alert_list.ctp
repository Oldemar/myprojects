<?php 
if(count($arrNotifications)){
foreach($arrNotifications as $key => $value){?>
<div class="row-fluid" style="padding-bottom: 2px;margin-bottom:2px;border-bottom:1px dotted #ddd;">
	<div class="span2"><img width="60" alt="" src="<?php echo $value['image'];?>"></div>
	<div class="<?php if($value['image2']){echo 'span6';}else{echo 'span8';}?>" style="white-space:normal;">
		<?php if($value['viewed'] == 0){?>
		<span class="label label-info">New</span><br><b>
		<?php } ?>
		<?php echo $value['text'];?>
		
		<?php if($value['viewed'] == 0){echo '</b>';}?>
		
		<br><font color="#AAA"><?php echo $value['date'];?></font>
	</div>
	<?php if($value['image2']){?>
	<div class="span2"><img width="60" alt="" src="<?php echo $value['image2'];?>"></div>
	<?php }?>
	<div class="span2"><a href="<?php echo $value['url_link'];?>" class="btn btn-mini <?php if($value['viewed'] == 0){echo 'btn-primary';}?>" style="width:90%;">View</a></div>
</div>
<?php }
}else{
	echo 'You do not have any notification yet.';
}
?>
