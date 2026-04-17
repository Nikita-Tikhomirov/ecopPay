<?php
/**
 * Template Name: Content
 */?>



<?php get_header('content'); ?>




<div data-aos="fade-right" data-aos-duration="600" class="content">

    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post();
    ?>

            <?php the_content(); ?>

        <?php endwhile; ?>
    <?php endif; ?>


</div>

	<?php
		if( is_page( 143 ) ){
			?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
				  <style>
        .clientImg{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .clientImg img{
            max-width: 100%;
            height: 80px;
        }
        .clientName{
            text-align: center;
            font-size: 20px;
            margin-top: 15px;
        }
        .ourClients{
            padding: 20px;
        }
		
		.swiper-button-next{
			right:40%;
			top:auto;
			bottom: 0px;
		}
				.swiper-button-prev{
			left:40%;
			top:auto;
			bottom: 0px;
		}
		.swiper{
			padding-bottom:70px
		}
    </style>
<section class="ourClients">
        <h3 class="content-title">Наши Клиенты</h3>
    <!-- Slider main container -->
    <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <?php if (have_rows('klient_kartochka', 'option')): ?>



                <?php while (have_rows('klient_kartochka', 'option')):
                    the_row();

                    // переменные
                    $image = get_sub_field('klient_logo');
                    $content = get_sub_field('klient');


                    ?>






                    <div class="swiper-slide">

                        <div class="clientImg">
                            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
                        </div>
                        <div class="clientName">
                            <?php echo $content; ?>
                        </div>
                    </div>






                <?php endwhile; ?>



            <?php endif; ?>



        </div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

    </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const swiper = new Swiper('.swiper', {
            // Optional parameters

            slidesPerView: 5,
            spaceBetween: 10,
            // Responsive breakpoints
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 1,
                    spaceBetween: 20
                },
                // when window width is >= 480px
                480: {
                    slidesPerView: 3,
                    spaceBetween: 30
                },
                // when window width is >= 640px
                640: {
                    slidesPerView: 6,
                    spaceBetween: 40
                }
            },


            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

        });
    })

</script>
			
			<?php
			
			
		}

	?>



<?php get_footer(); ?>
