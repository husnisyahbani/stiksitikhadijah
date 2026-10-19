<?php
if(!$this->session->userdata('id')) {
    redirect(base_url().'admin');
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>View Menu Header</h1>
    </div>
    <div class="content-header-right">
		<a href="<?php echo base_url(); ?>admin/menu/add" class="btn btn-primary btn-sm">Add Menu Header</a>
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
            <div class="box box-info">
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name Menu</th>
                                <th>Status</th>
                                <th>Link</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            if(isset($all_menus))
                            foreach ($all_menus as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo $row['menu_name']; ?></td>
                                    <td><?php echo $row['menu_status']; ?></td>
                                    <td><?php echo $row['menu_link']; ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>admin/menu/edit/<?php echo $row['menu_id']; ?>" class="btn btn-primary btn-xs">Edit</a>
                                        <?php if($row['menu_link']!=""){?>
                                        <a href="<?php echo base_url(); ?>admin/menu/delete/<?php echo $row['menu_id']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?');">Delete</a>
                                        <?php }?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>