<?php
if(!$this->session->userdata('id')) {
	redirect(base_url().'admin');
}
?>
<section class="content-header">
	<div class="content-header-left">
		<h1>Add News</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url(); ?>admin/menu" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>


<section class="content">

	<div class="row">
		<div class="col-md-12">

			<?php
			if($this->session->flashdata('error')) {
				?>
				<div class="callout callout-danger">
					<p><?php echo $this->session->flashdata('error'); ?></p>
				</div>
				<?php
			}
			if($this->session->flashdata('success')) {
				?>
				<div class="callout callout-success">
					<p><?php echo $this->session->flashdata('success'); ?></p>
				</div>
				<?php
			}
			?>

			<?php echo form_open_multipart(base_url().'admin/menu/edit/'.$menudata->menu_id,array('class' => 'form-horizontal')); ?>
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Menu Name <span>*</span></label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="menu_name" value="<?php if(isset($menudata->menu_name)) {echo $menudata->menu_name;} ?>">
							</div>
						</div>
						
											
						
                        <div class="form-group">
							<label for="" class="col-sm-2 control-label">Link <span>*</span></label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="menu_link" value="<?php if(isset($menudata->menu_link)) {echo $menudata->menu_link;} ?>" <?php if($menudata->menu_link == ""){ echo "readonly";}?>>
							</div>
						</div>

				        <div class="form-group">
				            <label for="" class="col-sm-2 control-label">Status <span>*</span></label>
				            <div class="col-sm-3">
				            	<select class="form-control select2" name="menu_status">
									<option value="Show" <?php if(isset($menudata->menu_status) && $menudata->menu_status =="Show") {echo "selected";} ?>>Show</option>
									<option value="Hide" <?php if(isset($menudata->menu_status) && $menudata->menu_status =="Hide") {echo "selected";} ?>>Hide</option>
								</select>
				            </div>
				        </div>
				        
						
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form1">Submit</button>
							</div>
						</div>
					</div>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>

</section>