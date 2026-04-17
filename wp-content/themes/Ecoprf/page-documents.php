<?php
/**
 * Template Name: Documents
 */?>



<?php get_header('content'); ?>




<div class="content">

    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post();
    ?>

            <?php the_content(); ?>

        <?php endwhile; ?>
    <?php endif; ?>

    <?php

    // check for rows (parent repeater)
    if( have_rows('gruppa_fotografij_dokumenta') ): ?>
        <div class="documents-list">
            <?php

            // loop through rows (parent repeater)
            while( have_rows('gruppa_fotografij_dokumenta') ): the_row(); ?>
                <div>
                    <h3 data-aos="fade-right" data-aos-duration="600" class="documents-list-title"><?php the_sub_field('imya_dokumenta'); ?></h3>
                    <?php

                    // check for rows (sub repeater)
                    if( have_rows('fotografii_dokumenta') ): ?>
                        <ul class="documents-list-images">
                            <?php

                            // loop through rows (sub repeater)
                            while( have_rows('fotografii_dokumenta') ): the_row();

                                // display each item as a list - with a class of completed ( if completed )
                                ?>
                                <?php if( get_sub_field('kartinka_dokumenta') ){ ?>
                                <li data-aos="fade-right" data-aos-duration="800">
                                    <a href="<?php the_sub_field('kartinka_dokumenta'); ?>" data-fancybox="images" data-caption="My caption">
                                        <img src="<?php the_sub_field('kartinka_dokumenta'); ?>" alt="Картинка документа" />
                                    </a>
                                </li>
                            <?php }
                            endwhile; ?>
                        </ul>
                    <?php endif; //if( get_sub_field('items') ): ?>
                </div>

            <?php endwhile; // while( has_sub_field('to-do_lists') ): ?>
        </div>
    <?php endif; // if( get_field('to-do_lists') ): ?>
<h3 class="documents-list-title aos-init aos-animate" data-aos="fade-right" data-aos-duration="600">ОФЕРТА на заключение Договора оказания платных образовательных услуг</h3>
	<ul class="documents-list-images">
		<li>
	<a href="https://ecoprf.ru/wp-content/uploads/2025/12/oferta_ooo_eczop_na_obrazovatelnye_uslugi_dlya_sajta_ecoprf.pdf" target="_blank" data-fancybox="images" data-caption="My caption"><img src="https://ecoprf.ru/wp-content/uploads/2025/12/oferta_ooo_eczop.webp" alt="Оферта_ООО_ЕЦОП" width="300" height="419" class="alignleft size-medium wp-image-18197" /></a>
		</li>
	</ul>

</div>





<?php get_footer(); ?>
