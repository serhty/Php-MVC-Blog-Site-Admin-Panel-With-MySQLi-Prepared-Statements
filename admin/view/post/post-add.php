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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Post Add</span></h4>

                <!-- Basic Layout -->
                <div class="row">
                    <div class="col-xl">
                        <div class="card mb-12">
                            <div class="card-body">
                                <form id="post_add_form" action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" class="form-control" id="status" name="status" value="1">
                                    <div class="mb-3">
                                        <label class="form-label">Category</label>
                                        <select class="form-select" id="category_id" name="category_id">
                                            <?php foreach($categories as $category){ ?>
                                                <option value="<?php echo $category['id']; ?>"><?php echo $category['title']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="title" />
                                    </div>
                                    <input type="hidden" class="form-control" id="link" name="link">
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <input type="text" class="form-control" id="description" name="description" placeholder="description" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Keywords</label>
                                        <input type="text" class="form-control" id="keywords" name="keywords" placeholder="keywords" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Content</label>
                                        <textarea class="ckeditor" id="content" name="content"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Images</label>
                                        <input type="file" name="image[]" id="image[]" multiple="multiple">
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="postAdd">Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Content -->

<?php } ?>