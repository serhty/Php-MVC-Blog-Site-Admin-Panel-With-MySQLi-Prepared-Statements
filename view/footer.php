    <!-- Footer Start -->
    <div class="container-fluid bg-light pt-5 px-sm-3 px-md-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-5">
                <a href="<?php echo $settings['link']; ?>" class="navbar-brand">
                    <h1 class="mb-2 mt-n2 display-5 text-uppercase"><span class="text-primary"><?php echo $settings['title']; ?></span></h1>
                </a>
            </div>
            <div class="col-lg-5 col-md-6 mb-5">
                <h4 class="font-weight-bold mb-4">Categories</h4>
                <div class="d-flex flex-wrap m-n1">
                    <?php foreach($categories as $categoryKey => $category){ ?>
                    <a href="/<?php echo $category['link']; ?>" class="btn btn-sm btn-outline-secondary m-1"><?php echo $category['title']; ?></a>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5">
                <h4 class="font-weight-bold mb-4">New Posts</h4>
                <div class="d-flex flex-wrap m-n1">
                    <?php foreach($posts as $postKey => $post){ ?>
                    <a href="/<?php echo $postCategoryLink; ?>/<?php echo $post['link']; ?>" class="btn btn-sm btn-outline-secondary m-1"><?php echo $post['title']; ?></a>
                    <?php
                        if($postKey == 2){ break; } 
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4 px-sm-3 px-md-5">
        <p class="m-0 text-center">
            &copy; <a class="font-weight-bold" href="<?php echo $settings['link']; ?>"><?php echo $settings['title']; ?></a>. All Rights Reserved. 
        </p>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-dark back-to-top"><i class="fa fa-angle-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="/public/site/lib/easing/easing.min.js"></script>
    <script src="/public/site/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="/public/site/mail/jqBootstrapValidation.min.js"></script>
    <script src="/public/site/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="/public/site/js/main.js"></script>
</body>

</html>