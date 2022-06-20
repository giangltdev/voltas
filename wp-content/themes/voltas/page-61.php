<?php
    get_header();
?>



    <section class="banner_01">
        <div class="revSlider">
            <ul>

                <?php
                    $lay_du_lieu = new WP_Query(array('post_type'=>'slider'));
                    //$dem_so_slider = 0;
                    while($lay_du_lieu->have_posts()){  
                        $lay_du_lieu->the_post();
                        //$dem_so_slider++;
                        $anh_slider = get_field('hinh_anh_slider');
                        $noi_dung_slider = get_field('noi_dung_slider');
                        $shop_now = get_field('nut_bam_slider');
                        $url = get_field('duong_dan_sider');
                ?>

                 <li data-transition="boxfade" data-slotamount="7" d ata-masterspeed="1000">
                    <div class="tp-caption sft" data-x="right" data-y="top" data-hoffset="0" data-voffset="-80" data-speed="1000" data-start="800" data-easing="easeInOutCirc">
                        <div class="sliderImgs">
                            <img src="<?php echo $anh_slider['url'] ?>" alt="" />
                        </div>
                    </div>
                    <div class="tp-caption sfb" data-x="left" data-y="center" data-hoffset="0" data-voffset="0" data-speed="1000" data-start="800" data-easing="easeInQuad">
                        <h1 class="sl_h raleway"><?php echo the_title(); ?></h1>
                    </div>
                    <div class="tp-caption fade" data-x="left" data-y="center" data-hoffset="0" data-voffset="65" data-speed="1000" data-start="800" data-easing="easeInQuint">
                        <h6 class="sl_p poppins"><?php echo $noi_dung_slider; ?></h6>
                    </div>
                    <?php 
                        if ($shop_now=="") {
                            
                        } else {
                    ?>
                        <div class="tp-caption sfb" data-x="left" data-y="center" data-hoffset="0" data-voffset="145" data-speed="1000" data-start="800" data-easing="easeOutBounce">
                            <div class="slbutons leftslBtn">
                                <a href="<?php echo $url; ?>" class="vol_btn poppins"><?php echo $shop_now; ?><i class="flaticon-arrows-3"></i></a>
                            </div>
                        </div>
                    <?php
                        }
                    ?>

                    
                </li>

                <?php
                        // 
                        // echo'<hr>';

                        // echo get_field('noi_dung_slider');
                        // echo'<hr>';

                ?>
                <?php
                    } 
                    wp_reset_query();
                ?>

            </ul>
        </div>
    </section>

<?php
/** lấy dữ liệu dịch vụ 1 **/
    $hinh_anh_1 =  get_field('update_anh_dich_vu');
    $tieu_de_1= get_field('tieu_de_cua_dich_vu');
    $url_1= get_field('duong_dan_den_dich_vu');

/** lấy dữ liệu dịch vụ 2 **/
    $hinh_anh_2 =  get_field('update_anh_dich_vu_trang_chu_2');
    $tieu_de_2= get_field('tieu_de_cua_dich_vu_2');
    $url_2= get_field('duong_dan_den_dich_vu_2');

/** lấy dữ liệu dịch vụ 3 **/
    $hinh_anh_3 =  get_field('update_anh_dich_vu_trang_chu_3');
    $tieu_de_3= get_field('tieu_de_cua_dich_vu_3');
    $url_3= get_field('duong_dan_den_dich_vu_3');

?>
    <section class="comonSection">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="singleCats">
                        <img src="<?php echo $hinh_anh_1; ?>" alt="Men's Collenctions" />
                        <div class="catContent poppins">
                            <a href="<?php echo $url_1; ?>"><?php echo $tieu_de_1; ?></a>
                        </div>
                        <div class="hoverEffect"></div>
                    </div>
                </div>
                
                <div class="col-sm-4">
                    <div class="singleCats">
                        <img src="<?php echo $hinh_anh_2; ?>" alt="Women's Collenctions" />
                        <div class="catContent poppins">
                            <a href="<?php echo $url_2; ?>"><?php echo $tieu_de_2; ?></a>
                        </div>
                        <div class="hoverEffect"></div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="singleCats">
                        <img src="<?php echo $hinh_anh_3; ?>" alt="Accessories" />
                        <div class="catContent poppins">
                            <a href="<?php echo $url_3; ?>"><?php echo $tieu_de_3; ?></a>
                        </div>
                        <div class="hoverEffect"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
// Header category
    $category_main_title = get_field('tieu_de');
    $category_main_content = get_field('noi_dung');

// Danh mục 1
    $category_img = get_field('hinh_anh_danh_muc_1');
    $category_title =  get_field('tieu_de_danh_muc_1');
    $category_button = get_field('nut_bam_danh_muc_1');
    $category_url = get_field('duong_dan_danh_muc_1');

// Danh mục 2
    $category_img_1 = get_field('hinh_anh_danh_muc_2');
    $category_title_1 =  get_field('tieu_de_danh_muc_2');
    $category_button_1 = get_field('nut_bam_danh_muc_2');
    $category_url_1 = get_field('duong_dan_danh_muc_2');

// Danh mục 3
    $category_img_2 = get_field('hinh_anh_danh_muc_3');
    $category_title_2 =  get_field('tieu_de_danh_muc_3');
    $category_button_2 = get_field('nut_bam_danh_muc_3');
    $category_url_2 = get_field('duong_dan_danh_muc_3');

// Danh mục 4
    $category_img_3 = get_field('hinh_anh_danh_muc_4');
    $category_title_3 =  get_field('tieu_de_danh_muc_4');
    $category_button_3 = get_field('nut_bam_danh_muc_4');
    $category_url_3 = get_field('duong_dan_danh_muc_4');



?>

    <section class="comonSection noPaddingTop">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="normalHr"></div>
                    <div class="sectionTitle text-center">
                        <h2 class="poppins"><?php echo $category_main_title; ?></h2>
                        <div class="titleBars"></div>
                        <p>
                            <?php echo $category_main_content; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 paddingRight5px">
                    <div class="singleFeatured wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms">
                        <img src="<?php echo $category_img; ?>" alt="" />
                        <div class="feaContent poppins">
                            <h4><?php echo $category_title; ?></h4>
                            <a href="<?php echo $category_url; ?>"><?php echo $category_button; ?><i class="flaticon-arrows-3"></i></a>
                        </div>
                    </div>
                    <div class="singleFeatured wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms">
                        <img src="<?php echo $category_img_1; ?>" alt="" />
                        <div class="feaContent poppins">
                            <h4><?php echo $category_title_1; ?></h4>
                            <a href="<?php echo $category_url_1; ?>"><?php echo $category_button_1; ?><i class="flaticon-arrows-3"></i></a>
                        </div>
                    </div>   
                </div>
                <div class="col-sm-6 paddingLeft5px">
                    <div class="singleFeatured wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms">
                        <img src="<?php echo $category_img_2; ?>" alt="" />
                        <div class="feaContent poppins">
                            <h4><?php echo $category_title_2; ?></h4>
                            <a href="<?php echo $category_url_2; ?>"><?php echo $category_button_2; ?><i class="flaticon-arrows-3"></i></a>
                        </div>
                    </div>
                    <div class="singleFeatured wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms">
                        <img src="<?php echo $category_img_3; ?>" alt="" />
                        <div class="feaContent poppins">
                            <h4><?php echo $category_title_3; ?></h4>
                            <a href="<?php echo $category_url_3; ?>"><?php echo $category_button_3; ?><i class="flaticon-arrows-3"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php 
    $sale_img = get_field('sale_image');
    $sale_title=get_field('sale_title');
    $sale_content=get_field('sale_content');
    $sale_button=get_field('sale_button');
    $sale_link=get_field('sale_link');
?>

    <section class="comonSection noPadding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="callToActions text-center poppins wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms" style="background-image: url('<?php echo $sale_img; ?>');">
                        <h2><?php echo $sale_title; ?></h2>
                        <p><?php echo $sale_content; ?></p>
                        <a href="<?php echo $sale_link; ?>" class="vol_btn"><?php echo $sale_button ?><i class="flaticon-arrows-3"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <?php echo do_shortcode("[recent_products per_page='1']"); ?>
    </div>


<?php
    get_footer(); 
?>