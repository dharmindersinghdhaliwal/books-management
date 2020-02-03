<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<div id="wrap">
    <div class="container">
        <p>&nbsp;</p>
        <div class="row">
            <div class="col col-4">
                <h1 class="h1"><?php echo __('Import Books','bkmt');?></h1>
            </div>
        </div>

        <p>&nbsp;</p>
        <div class="row text-center">

            <div class="col col-12">
                <h2 class="h2"><?php echo __('Import Books','bkmt');?></h2>
                <hr>
            </div>

            <div class="col col-12">

                <form class="form-horizontal form" action="<?php echo admin_url('admin-post.php') ?>" method="post" enctype="multipart/form-data">                

                    <input type="hidden" name="action" value="save_csv_data">

                    <div class="file btn  btn-primary" style="position: relative; overflow: hidden;"><?php echo __('Select file','bkmt');?>

                        <input type="file" name="file" required  style="position: absolute; font-size: 50px; opacity: 0; right: 0; top: 0;" />

                    </div> 
                     &nbsp;&nbsp;
                     <input type="submit" id="submit" name="Import" class="btn btn-success button-loading" data-loading-text="Loading..." value="<?php echo __('Save Records','bkmt');?>">
                </form><!-- form ends-->

            </div><!--/col-->

            <div class="col col-12">                        
                <small class="text-danger"><?php echo __('Only csv file is allowed','bkmt');?></small>
            </div><!--/col-->

        </div><!--/row-->

    </div><!--/container-->

</div><!--/#wrap-->