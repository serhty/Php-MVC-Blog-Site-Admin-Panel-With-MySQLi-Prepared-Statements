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
                    <span class="text-muted fw-light">Category Edit</span>
                    <span class="text-muted fw-light" style="float:right;">
                        <a href="/admin/category-add">
                            <button type="button" class="btn btn-success"> + Category Post</button>
                        </a>
                    </span>
                </h4>

                <!-- Basic Layout -->
                <div class="row">
                    <div class="col-xl">
                        <div class="card mb-12">
                            <div class="card-body">
                                <form id="category_update_form" action="" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $category['title']?>" />
                                    </div>
                                    <input type="hidden" class="form-control" id="link" name="link" value="<?php echo $category['link']?>" >
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <input type="text" class="form-control" id="description" name="description"  value="<?php echo $category['description']?>" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Keywords</label>
                                        <input type="text" class="form-control" id="keywords" name="keywords"  value="<?php echo $category['keywords']?>" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Content</label>
                                        <textarea class="ckeditor" id="content" name="content"> <?php echo $category['content']?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Image</label>
                                        <?php if(!empty($category_images)){ ?>
                                            <div class="row mb-5">
                                                <?php foreach ($category_images as $image) { ?>
                                                <div class="col-md-6 col-xl-4">
                                                    <div class="card mb-3">
                                                        <img class="card-img-top" src="../../public/images/<?php echo $image['image']; ?>">
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        <!-- / Content -->
                                        <?php } ?>
                                        <input type="file" name="image" id="image">
                                    </div>
                                    <button type="submit" class="btn btn-success" name="categoryUpdate">Update</button>
                                    <button type="submit" class="btn btn-danger" name="categoryDelete">Delete</button>
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
                            window.location = "/admin/category-edit/'.$category['id'].'";
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
                            window.location = "/admin/category-edit/'.$category['id'].'";
                        });
                    }, 1000);
                </script>';
    }
}
?>

<?php } ?>