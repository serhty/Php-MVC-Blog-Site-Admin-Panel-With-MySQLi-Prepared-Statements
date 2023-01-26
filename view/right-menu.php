<div class="col-lg-3 pt-3 pt-lg-0">

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
        <?php foreach($categoryImages as $imageKey => $image){
            if($image['category_id'] == $category['id']){
        ?>
            <a href="/<?php echo $category['link']; ?>">
            <img src="/public/images/<?php echo $image['image']; ?>" style="width: 100px; height: 100px; object-fit: cover;">
            </a>
        <?php } } ?>
        <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
            <a class="h6 m-0" href="/<?php echo $category['link']; ?>"><?php echo $category['title']; ?></a>
        </div>
    </div>
    <?php } ?>
</div>
<!-- Popular News End -->

<!-- Ads Start -->
<div class="mb-3 pb-3">
    <a href=""><img class="img-fluid" src="/public/site/img/news-500x280-4.jpg" alt=""></a>
</div>
<!-- Ads End -->

</div>