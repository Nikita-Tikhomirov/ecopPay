<?php
/**
 * Template Name: Feed-Back
 */ ?>



<?php get_header('content'); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


<style>
    .swiper img{
        max-width: 100%;
    }
</style>

<div class="content">

<?php include(TEMPLATEPATH . '/templates/customRevsRevs.php'); ?>

    <?php
    if (have_rows('otzyvy')):
        while (have_rows('otzyvy')):
            the_row(); ?>

            <div data-aos="fade-right" data-aos-duration="600" class="feed-back-item">
                <p class="feed-back-item-author">

                    <span>
                        <?php the_sub_field('imya_avtora_otzyva'); ?>
                    </span>

                    <img src="<?php the_sub_field('foto_avtora_otzyva'); ?>" alt="">
                </p>


                <div class="feed-back-item-content">
                    <?php the_sub_field('tekst_otzyva'); ?>
                </div>
            </div>


            <?php
        endwhile;

        // No value.
    else:
        // Do something...
    endif;
    ?>



</div>





<?php get_footer(); ?>