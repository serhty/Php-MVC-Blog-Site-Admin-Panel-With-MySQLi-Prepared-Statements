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
                <div class="row">
                    <div class="col-lg-6 mb-6 order-0">
                        <div class="card">
                            <div class="d-flex align-items-end row">
                                <div class="col-sm-12">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary"><?php if(isset($categories)){ echo count($categories); }else{ echo "0"; }; ?> Categories</h5>
                                        <a href="/admin/category-list" class="btn btn-sm btn-outline-primary">View Categories </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-6 order-0">
                        <div class="card">
                            <div class="d-flex align-items-end row">
                                <div class="col-sm-12">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary"><?php if(isset($posts)){ echo count($posts); }else{ echo "0"; }; ?> Posts</h5>
                                        <a href="/admin/post-list" class="btn btn-sm btn-outline-primary">View Posts </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Content -->

<?php } ?>