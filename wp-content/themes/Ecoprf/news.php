<?php
/*
Template Name: Статьи
*/
?>
<?php get_header(); ?>

  <div class="main-title-stripe">
    <h1 data-aos="fade-up" data-aos-duration="600" class="aos-init aos-animate"><?php the_title();?></h1>
  </div>

<!--   <div class="seo-text-start-page">
    <div class="content aos-init aos-animate" data-aos="fade-right" data-aos-duration="800">
      <?php the_content();?>
    </div>
  </div> -->


  <div class="wcat wcatinner">

    <div class="catalog">


                  <?php
                  $paged = (get_query_var('')) ? get_query_var('paged') : 1;
                  $args = array(
                    'posts_per_page' => -1,
                    'order' 	 => 'DESC',
                    'post_type' 	 => 'news',
                    'paged'	         => $paged
                  );

                  $MY_QUERY = new WP_Query( $args );

                  if ( $MY_QUERY->have_posts() ) :
                    while ( $MY_QUERY->have_posts() ) : $MY_QUERY->the_post(); ?>



          <div data-aos="fade-right" data-aos-duration="600" class="citem aos-init aos-animate">

            <a class="ciimage" href="<?php the_permalink()?>">
<!--                 <img itemprop="image" src="<?php the_post_thumbnail_url(); ?>" alt=""> -->
				<?php 
				the_post_thumbnail ('large');
				?>
            </a>

            <div class="cicont">

                <a class="cilink" style="margin-bottom:20px" href="<?php the_permalink()?>">
                <?php the_title() ?>
                </a>
                <div class="">
                <?php the_excerpt() ?>
                </div>
				<span class="modDate"><?php the_modified_date(); ?></span>



            </div>


          </div>



        <?php wp_reset_postdata(); ?>
                    <?php endwhile;
                    endif; ?>


    </div>
  </div>


<style>
	.modDate{
		background: #0d5bd9;
		color: #fff;
		padding: 13px 44px;
		    margin-left: auto;
    display: block;
    width: fit-content;
    margin-top: 20px;
	}
</style>



<?php get_footer(); ?>
