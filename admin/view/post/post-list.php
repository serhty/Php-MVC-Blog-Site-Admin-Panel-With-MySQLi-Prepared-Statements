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
                    <span class="text-muted fw-light">Posts</span>
                    <span class="text-muted fw-light" style="float:right;">
                        <a href="/admin/post-add">
                            <button type="button" class="btn btn-success"> + Add Post</button>
                        </a>
                    </span>
                </h4>

                <!-- Basic Bootstrap Table -->
                <div class="card">
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php foreach($posts as $post){ ?>
                                <tr>
                                    <td><?php echo $post['id']?></td>
                                    <td><?php echo $post['title']?></td>
                                    <td>
                                        <a href="/admin/post-edit/<?php echo $post['id']; ?>">
                                            <button type="button" class="btn btn-warning">Edit</button>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--/ Basic Bootstrap Table -->
            </div>
            <!-- / Content -->

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
                            window.location = "/admin/post-list";
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
                            window.location = "/admin/post-list";
                        });
                    }, 1000);
                </script>';
    }
}
?>

<?php } ?>