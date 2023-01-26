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
                    <span class="text-muted fw-light">Post Edit</span>
                    <span class="text-muted fw-light" style="float:right;">
                        <a href="/admin/post-add">
                            <button type="button" class="btn btn-success"> + Add Post</button>
                        </a>
                    </span>
                </h4>

                <!-- Basic Layout -->
                <div class="row">
                    <div class="col-xl">
                        <div class="card mb-12">
                            <div class="card-body">
                                <form id="post_update_form" action="" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label class="form-label">Category</label>
                                        <select class="form-select" id="category_id" name="category_id">
                                            <?php foreach($categories as $category){ ?>
                                                <option value="<?php echo $category['id']; ?>" <?php if($post['category_id'] == $category['id']){ echo "selected"; } ?>><?php echo $category['title']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $post['title']?>" />
                                    </div>
                                    <input type="hidden" class="form-control" id="link" name="link" value="<?php echo $post['link']?>" >
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <input type="text" class="form-control" id="description" name="description"  value="<?php echo $post['description']?>" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Keywords</label>
                                        <input type="text" class="form-control" id="keywords" name="keywords"  value="<?php echo $post['keywords']?>" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Content</label>
                                        <textarea class="ckeditor" id="content" name="content"> <?php echo $post['content']?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Image</label>
                                        <?php if(!empty($post_images)){ ?>
                                            <div class="row mb-5">
                                                <?php foreach ($post_images as $image) { ?>
                                                <div class="col-md-6 col-xl-4 post_images_div">
                                                    <div class="card mb-3 post_images_card">
                                                        <img class="card-img-top" src="../../public/images/<?php echo $image['image']; ?>">
                                                    </div>
                                                    <?php if(empty($image['cover'])){ ?>
                                                    <button type="submit" class="btn btn-success" name="makeCover" value="<?php echo $image['id']; ?>">Cover</button>
                                                    <?php } ?>
                                                    <button type="submit" class="btn btn-danger" name="deleteImage" value="<?php echo $image['id']; ?>">Delete</button>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        <!-- / Content -->
                                        <?php } ?>
                                        <input type="file" name="image[]" id="image[]" multiple="multiple">
                                    </div>
                                    <button type="submit" class="btn btn-success" name="postUpdate">Update</button>
                                    <button type="submit" class="btn btn-danger" name="postDelete">Delete</button>
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
                            window.location = "/admin/post-edit/'.$post['id'].'";
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
                            window.location = "/admin/post-edit/'.$post['id'].'";
                        });
                    }, 1000);
                </script>';
    }
}
?>

<?php } ?>