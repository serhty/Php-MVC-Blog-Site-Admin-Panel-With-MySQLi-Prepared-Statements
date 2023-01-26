<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

<?php
function the_url($server, $use_forwarded_host = false)
{
    $ssl = (!empty( $server['HTTPS'] ) && $server['HTTPS'] == 'on');
    $protocol = substr(strtolower($server['SERVER_PROTOCOL']), 0, strpos(strtolower($server['SERVER_PROTOCOL']), '/')) . (($ssl) ? 's' : '');
    $host = ($use_forwarded_host && isset($server['HTTP_X_FORWARDED_HOST'])) ? $server['HTTP_X_FORWARDED_HOST'] : (isset($server['HTTP_HOST']) ? $server['HTTP_HOST'] : null);
    $host = isset($host) ? $host : $server['SERVER_NAME'];
    $urlprotocol = $protocol . '://' . $host;
    return ($urlprotocol);
}
$urlprotocol = the_url($_SERVER);
$fullurl = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$urlremove = str_replace($urlprotocol,"",$fullurl);
$types = explode("/", $urlremove);
?>

<?php if(empty($types[0]) && empty($types[1]) && empty($types[2])){ ?>
    <title><?php echo $settings['title']; ?></title>
    <meta content="<?php echo $settings['keywords']; ?>" name="keywords">
    <meta content="<?php echo $settings['description']; ?>" name="description">
<?php } ?>

<?php if(empty($types[0]) && !empty($types[1]) && empty($types[2])){ ?>
    <title><?php echo $settings['title']; ?> - <?php echo $category['title']; ?></title>
    <meta content="<?php echo $category['keywords']; ?>" name="keywords">
    <meta content="<?php echo $category['description']; ?>" name="description">
<?php } ?>

<?php if(empty($types[0]) && !empty($types[1]) && !empty($types[2])){ ?>
    <title><?php echo $settings['title']; ?> - <?php echo $post['title']; ?></title>
    <meta content="<?php echo $post['keywords']; ?>" name="keywords">
    <meta content="<?php echo $post['description']; ?>" name="description">
<?php } ?>

    <!-- Favicon -->
    <link href="/public/images/<?php echo $settings['logo']; ?>" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">   

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/public/site/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/public/site/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center bg-light px-lg-5">
            <div class="col-12 col-md-12">
                <div class="d-flex justify-content-between">
                    <div class="bg-primary text-white text-center py-2" style="width: 100px;">New Posts</div>
                    <div class="owl-carousel owl-carousel-1 tranding-carousel position-relative d-inline-flex align-items-center ml-3" style="width: calc(100% - 100px); padding-left: 90px;">
                        <?php foreach($posts as $postKey => $post){ ?>
                        <div class="text-truncate">
                            <?php foreach($categories as $categoryKey => $category){
                                if($category['id'] == $post['category_id']){
                                    $postCategoryLink = $category['link'];
                                }
                            }
                            ?>
                            <a class="text-secondary" href="/<?php echo $postCategoryLink; ?>/<?php echo $post['link']; ?>"><?php echo $post['title']; ?></a>
                        </div>
                        <?php
                            if($postKey == 3){ break; } 
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-2 px-lg-5">
            <div class="col-lg-4">
                <a href="<?php echo $settings['link']; ?>" class="navbar-brand d-none d-lg-block">
                    <h1 class="m-0 display-5 text-uppercase"><span class="text-primary"><?php echo $settings['title']; ?></span></h1>
                </a>
            </div>
            <div class="col-lg-8 text-center text-lg-right">
                <img class="img-fluid" src="/public/site/img/ads-700x70.jpg" alt="">
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid p-0 mb-3">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-2 py-lg-0 px-lg-5">
            <a href="<?php echo $settings['link']; ?>" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-5 text-uppercase"><span class="text-primary"><?php echo $settings['title']; ?></span></h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="<?php echo $settings['link']; ?>" class="nav-item nav-link">Home</a>
                    <?php foreach($categories as $categoryKey => $category){ ?>
                    <a href="/<?php echo $category['link']; ?>" class="nav-item nav-link"><?php echo $category['title']; ?></a>
                    <?php } ?>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->