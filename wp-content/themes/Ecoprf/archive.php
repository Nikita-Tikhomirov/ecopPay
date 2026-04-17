<?php get_header(); ?>

<?php
$queried_object = get_queried_object();
$taxonomy = $queried_object->taxonomy;
$term_id = $queried_object->term_id;
?>


<div class="main-title-stripe">


    <?php
        if(get_field('moj_n1', $taxonomy . '_' . $term_id)){
            ?>

            <h1><?php the_field('moj_n1', $taxonomy . '_' . $term_id); ?></h1>

          <?php
        }else{
            ?>

            <h1><?php single_cat_title( '', true ); ?></h1>

        <?php
        }
    ?>


</div>



<?php if (get_field('seo_tekst_vnachale_straniczy', $taxonomy . '_' . $term_id)){ ?>
    <div class="seo-text-start-page">
        <div class="content">
            <?php the_field('seo_tekst_vnachale_straniczy', $taxonomy . '_' . $term_id); ?>
        </div>
    </div>
<?php }?>



    <div class="wcat wcatinner">

        <div class="catalog">


            <?php


            ?>

            <?php if (have_posts()) : ?>

                <?php while (have_posts()) : the_post();
//                                var_dump($post->tag()); ?>


                    <div class="citem" itemscope="itemscope" itemtype="https://schema.org/Product">

                        <a class="ciimage" href="<?php echo get_permalink(); ?>">



              


                            <?php 

                            $image = get_field('kartinka_kursa');

                            if( !empty($image) ): 

                                // переменные
                                $url = $image['url'];
                                $title = $image['title'];
                                $alt = $image['alt'];
                                $caption = $image['caption'];

                                // миниатюра
                                $size = 'thumbnail';
                                $thumb = $image['sizes'][ $size ];
                                $width = $image['sizes'][ $size . '-width' ];
                                $height = $image['sizes'][ $size . '-height' ];

                                ?>



                                    <img itemprop="image" src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />



                            <?php endif; ?>



                        </a>

                        <div class="cicont">
                            <a class="cilink" href="<?php echo get_permalink(); ?>">
                                <?php the_title(); ?>
                                <meta itemprop="name" content="<?php the_title(); ?>">
                            </a>
                            <div class="ciparams">
                                <div><div><?php the_field('kategoriya_slushatelej_zagolovok'); ?> :</div><?php the_field('kategoriya_slushatelej'); ?></div>
                                <div><div><?php the_field('itogovyj_dokument_zagolovok'); ?> :</div><?php the_field('itogovyj_dokument'); ?></div>
                            </div>
                            <div class="ciprice" itemprop="offers" itemscope="itemscope" itemtype="https://schema.org/Offer" class="ciprice">
                                <?php the_field('stoimost_kursa'); ?> руб.

                                <meta itemprop="price" content="<?php the_field('stoimost_kursa'); ?>">
                                <meta itemprop="priceCurrency" content="RUB">
                            </div>
                        </div>
                        <div class="ciinfo">
                            <!--                <div><div>Дата начала:</div>30.11.0999</div>-->
                            <div><div>Продолжительность:</div><?php the_field('prodolzhitelnost'); ?></div>

                            <div>
                                <a data-fancybox="" data-src="#hidden-content2" href="javascript:;" data-click="<?php the_title(); ?>" data-click2="<?php the_permalink(); ?>" class="header-message get-info">Получить консультацию</a>
                            </div>
                        </div>

                        <meta itemprop="description" content='<?php echo get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true); ?>'>

                    </div>

                <?php  endwhile; ?>
            <?php endif; ?>

        </div>
    </div>



            <?php

            // Check rows exists.
            if( have_rows('info_taby_dlya_kategorij', $taxonomy . '_' . $term_id) ):
                ?>


<div class="content block_faq">


    <div class="faq-wrap">

        <div class="faq-controls">
            <h2 class="faq-controls-title">
                Информация
            </h2>


            <?php
                $i =0;
                // Loop through rows.
                while( have_rows('info_taby_dlya_kategorij', $taxonomy . '_' . $term_id) ) : the_row();
                    $i++;
                    if ($i == 1){
                        ?>

                        <button id="first-show-item" class="w3-bar-item w3-button tablink w3-red" onclick="openCity(event, '<?php echo 'faq-tab' . $i; ?>')">
                            <h2><?php the_sub_field('nazvanie_razdela'); ?></h2>
                        </button>

                        <?php
                    }else{
                        ?>
                        <button class="w3-bar-item w3-button tablink" onclick="openCity(event, '<?php echo 'faq-tab' . $i; ?>')">
                            <h2><?php the_sub_field('nazvanie_razdela'); ?></h2>
                        </button>

                        <!--                    <button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'faq-tab2')">-->
                        <!--                        Film Care-->
                        <!--                    </button>-->

                    <?php }
                    // Do something...

                    // End loop.
                endwhile;

            // No value.
            else :
                // Do something...
            endif;

            ?>
        </div>


        <div class="faq-content">




            <?php

            // Check rows exists.
            if( have_rows('info_taby_dlya_kategorij', $taxonomy . '_' . $term_id) ):

                $i =0;

                // Loop through rows.
                while( have_rows('info_taby_dlya_kategorij', $taxonomy . '_' . $term_id) ) : the_row();
                    $i++;

                    if ($i == 1){
                        ?>

                        <div id="<?php echo 'faq-tab' . $i; ?>" class="w3-container city">

                            <?php the_sub_field('kontent_razdela'); ?>

                        </div>

                    <?php } else{?>


                        <div id="<?php echo 'faq-tab' . $i; ?>" class="w3-container city" style="display:none">

                            <?php the_sub_field('kontent_razdela'); ?>

                        </div>


                    <?php }
                    // Do something...

                    // End loop.
                endwhile;

            // No value.
            else :
                // Do something...
                ?>

        </div>



        <?php
            endif;

            ?>

    </div>

</div>


<?php if (get_field('seo_tekst_v_koncze_straniczy', $taxonomy . '_' . $term_id)){ ?>
    <div class="seo-text-finish-page">
        <div class="content">
            <?php the_field('seo_tekst_v_koncze_straniczy', $taxonomy . '_' . $term_id); ?>
        </div>
    </div>
<?php }?>



<?php echo get_template_part('templates/faq-categories'); ?>


<script>
    function openCity(evt, cityName) {
        var i, x, tablinks;
        x = document.getElementsByClassName("city");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " w3-red";
    }
</script>


<?php get_footer(); ?>



<div style="display: none;" class="leave-request" id="hidden-content2">

    <p class="leave-request-title">
        Получить консультацию
    </p>

    <?php echo do_shortcode( '[contact-form-7 id="188" title="Форма Получить консультацию из блока Курса"]' ); ?>

</div>


<script>









</script>