    <div class="mb-3 pb-3 col-lg-12">
        <a href=""><img class="img-fluid w-100" src="/public/site/img/ads-700x70.jpg" alt=""></a>
    </div>


    <!-- News With Sidebar Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- News Detail Start -->
                    <div class="position-relative mb-3">
                        <img class="img-fluid w-100" src="/public/images/<?php echo $post['cover_image']; ?>" style="object-fit: cover;">
                        <div class="overlay position-relative bg-light">
                            <div>
                                <h3 class="mb-3"><?php echo $post['title']; ?></h3>
                                <p><?php echo $post['content']; ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- News Detail End -->
                </div>

                <div class="col-lg-4 pt-3 pt-lg-0">

                    <!-- Ads Start -->
                    <div class="mb-3 pb-3">
                        <a href=""><img class="img-fluid" src="/public/site/img/news-500x280-4.jpg" alt=""></a>
                    </div>
                    <!-- Ads End -->

                    <!-- Popular News Start -->
                    <div class="pb-3">
                        <div class="bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Other Posts</h3>
                        </div>

                        <?php foreach($otherPosts as $otherKey => $other){ 
                            foreach($categories as $categoryKey => $category){
                                if($category['id'] == $other['category_id']){
                                    $otherCategoryLink = $category['link'];
                                }
                            }
                        ?>
                        <div class="d-flex mb-3">
                            <a href="/<?php echo $otherCategoryLink; ?>/<?php echo $other['link']; ?>">
                            <img src="/public/images/<?php echo $other['cover_image']; ?>" style="width: 100px; height: 100px; object-fit: cover;">
                            </a>
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <a class="h6 m-0" href="/<?php echo $otherCategoryLink; ?>/<?php echo $other['link']; ?>"><?php echo $other['title']; ?></a>
                            </div>
                        </div>
                        <?php if($otherKey >= 3){ break; } } ?>
                    </div>
                    <!-- Popular News End -->

                    <!-- Ads Start -->
                    <div class="mb-3 pb-3">
                        <a href=""><img class="img-fluid" src="/public/site/img/news-500x280-4.jpg" alt=""></a>
                    </div>
                    <!-- Ads End -->

                    <!-- Popular News Start -->
                    <div class="pb-3">
                        <div class="bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Categories</h3>
                        </div>

                        <?php foreach($categories as $categoryKey => $category){ ?>
                        <div class="d-flex mb-3">
                            <a href="/<?php echo $category['link']; ?>">
                            <?php foreach($categoryImages as $imageKey => $image){
                                if($image['category_id'] == $category['id']){
                            ?>
                                <img src="/public/images/<?php echo $image['image']; ?>" style="width: 100px; height: 100px; object-fit: cover;">
                            <?php } } ?>
                            </a>
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <a class="h6 m-0" href="/<?php echo $category['link']; ?>"><?php echo $category['title']; ?></a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <!-- Popular News End -->

                </div>
            </div>
        </div>

        <div class="mb-3 pb-3">
            <a href=""><img class="img-fluid w-100" src="/public/site/img/ads-700x70.jpg" alt=""></a>
        </div>

    </div>
    </div>
    <!-- News With Sidebar End -->