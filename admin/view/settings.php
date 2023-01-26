<?php
if(!isset($_SESSION)){
	session_start(); 
}
if(!isset($_SESSION["login"])){
	echo "You are not authorized to view this page.";
}else{
?> 

<!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4">
                    <span class="text-muted fw-light">Settings</span>
                </h4>

                <!-- Basic Layout -->
                <div class="row">
                    <div class="col-xl">
                        <div class="card mb-12">
                            <div class="card-body">
                                <form id="settings_update_form" action="" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label class="form-label">Link</label>
                                        <input type="text" class="form-control" id="link" name="link" value="<?php echo $settings['link']?>" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $settings['title']?>" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <input type="text" class="form-control" id="description" name="description"  value="<?php echo $settings['description']?>" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Keywords</label>
                                        <input type="text" class="form-control" id="keywords" name="keywords"  value="<?php echo $settings['keywords']?>" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Logo</label>
                                        
                                            <div class="row mb-5">
                                               
                                                <div class="col-md-6 col-xl-4">
                                                    <div class="card mb-3">
                                                        <img class="card-img-top" src="../../public/images/<?php echo $settings['logo']; ?>">
                                                    </div>
                                                </div>
                                             
                                            </div>
                                        <!-- / Content -->
                                 
                                        <input type="file" name="image" id="image">
                                    </div>
                                    <button type="submit" class="btn btn-success" name="settingsUpdate">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php
if(!empty($result)){
    if($result=="success"){
        echo    '<script>
                    setTimeout(function() {
                        swal({
                            title: "Success",
                            text: "Success",
                            type: "success"
                        }).then(function(){
                            window.location = "/admin/settings";
                        });
                    }, 1000);
                </script>';
    }elseif($result=="fail"){
        echo    '<script>
                    setTimeout(function() {
                        swal({
                            title: "Error",
                            text: "Error",
                            type: "error"
                        }).then(function(){
                            window.location = "/admin/settings";
                        });
                    }, 1000);
                </script>';
    }
}
?>

<?php } ?>