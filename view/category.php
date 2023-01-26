    <!-- News With Sidebar Start -->
    <div class="container-fluid py-3">
        <div class="container" style="max-width:100%;">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                                <h3 class="m-0">New Posts</h3>
                            </div>
                        </div>
                        <?php foreach($categoryPosts as $postKey => $post){ 
                            foreach($categories as $categoryKey => $category){
                                if($category['id'] == $post['category_id']){
                                    $postCategoryLink = $category['link'];
                                    $postCategoryTitle = $category['title'];
                                }
                            }
                            if($postKey <= 5){
                        ?>
                        <div class="col-lg-4">
                            <a href="/<?php echo $postCategoryLink; ?>/<?php echo $post['link']; ?>">
                                <div class="position-relative mb-3">
                                    <img class="img-fluid w-100" src="/public/images/<?php echo $post['cover_image']; ?>" style="object-fit: cover; height:250px;">
                                    <div class="overlay position-relative bg-light">
                                        <div class="mb-2" style="font-size: 14px;">
                                            <a href="/<?php echo $postCategoryLink; ?>/<?php echo $post['link']; ?>"><?php echo $postCategoryTitle; ?></a>
                                        </div>
                                        <a class="h4" href="/<?php echo $postCategoryLink; ?>/<?php echo $post['link']; ?>"><?php echo $post['title']; ?></a>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php } } ?>

                        <div class="mb-3 pb-3 col-lg-12">
                            <a href=""><img class="img-fluid w-100" src="/public/site/img/ads-700x70.jpg" alt=""></a>
                        </div>

                        <?php foreach($categoryPosts as $postKey => $post){ 
                            foreach($categories as $categoryKey => $category){
                                if($category['id'] == $post['category_id']){
                                    $postCategoryLink = $category['link'];
                                    $postCategoryTitle = $category['title'];
                                }
                            }
                            if($postKey >= 6){
                        ?>
                        <div class="col-lg-4">
                            <a href="/<?php echo $postCategoryLink; ?>/<?php echo $post['link']; ?>">
                                <div class="d-flex mb-3">
                                    <img src="/public/images/<?php echo $post['cover_image']; ?>" style="width: 100px; height: 100px; object-fit: cover;">
                                    <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                        <div class="mb-1" style="font-size: 13px;">
                                            <a href="/<?php echo $postCategoryLink; ?>/<?php echo $post['link']; ?>"><?php echo $postCategoryTitle; ?></a>
                                        </div>
                                        <a class="h6 m-0" href="/<?php echo $postCategoryLink; ?>/<?php echo $post['link']; ?>"><?php echo $post['title']; ?></a>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php } } ?>
                    </div>
                    
                    <div class="mb-3 pb-3">
                        <a href=""><img class="img-fluid w-100" src="/public/site/img/ads-700x70.jpg" alt=""></a>
                    </div>
                    
                </div>
                
                <?php require_once __DIR__."/right-menu.php"; ?>
            </div>
        </div>
    </div>
    </div>
    <!-- News With Sidebar End -->