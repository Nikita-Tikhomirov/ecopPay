<?php the_post(); ?>
<?php get_header('news'); ?>

<style>

</style>



<div class="seo-text-finish-page">
<div class="breadcrumbs" itemscope="" itemtype="http://schema.org/BreadcrumbList"><span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a class="breadcrumbs__link" href="<?php echo get_home_url(); ?>" itemprop="item"><span itemprop="name">Главная</span></a><meta itemprop="position" content="1"></span><span class="breadcrumbs__separator"> › </span><span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a class="breadcrumbs__link" href="/news/" itemprop="item"><span itemprop="name">Блог</span></a><meta itemprop="position" content="2"></span><span class="breadcrumbs__separator"> › </span><span class="breadcrumbs__current"><?php the_title(); ?></span></div>
<!--   <div data-aos="fade-up" data-aos-duration="600" class="content aos-init aos-animate">
    <?php the_excerpt();?>
  </div> -->
  <div style="margin-top:20px">
  <div class="news-content">
<?php the_content(); ?>
  </div>
  

  </div>



  <?php

$featured_posts = get_field('related-posts');



if( $featured_posts ): ?>

<div class="wcat" style="box-shadow:none;min-height:auto;">
    <h3 style="font-size:30px">Вам будет интересно</h3>
</div>


<style>
    .relative-course__wrap{
        display: grid;
        grid-template-columns: repeat(4,1fr);
        grid-gap: 20px;
    }
    .relative-course__img-wrap{
        overflow:hidden;
    }
    .relative-course__img-wrap img{
        max-width:100%;
        transition:0.2s;
    }
    .relative-course{
        box-shadow: 0 0 5px rgb(67 73 108 / 10%);
        transition:0.2s;

    }
    .relative-course:hover{
        box-shadow: 0 0 20px rgb(67 73 108 / 10%);
    }
    .relative-course:hover img{
        transform: scale(1.1)
    }
    .relative-course__title{
        padding: 15px 20px;
    }

    @media (max-width: 1024px){
        .relative-course__wrap{
            grid-template-columns: repeat(3,1fr);
        }
    }
    @media (max-width: 992px){
        .relative-course__wrap{
            grid-template-columns: repeat(2,1fr);
        }
    }

    @media (max-width: 576px){
        .relative-course__wrap{
            grid-template-columns: 1fr
        }
    }

</style>

<div class="wcat wcatinner" style="margin-bottom:40px; box-shadow:none; padding:10px;">
    <div class=" relative-course__wrap">






        <?php foreach( $featured_posts as $featured_post ):
            $permalink = get_permalink( $featured_post->ID );
            $title = get_the_title( $featured_post->ID );
            ?>




            <div data-aos="fade-right" data-aos-duration="600" class="relative-course" itemscope="itemscope" itemtype="https://schema.org/Product">

                <div class="relative-course__img-wrap">
					<?php 
						$image = get_field('kartinka_kursa', $featured_post->ID);
						if( !empty( $image ) ): ?>
							<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
						<?php endif; ?>
                   
                </div>

                <a href="<?php echo esc_url( $permalink ); ?>" class="relative-course__title">
                    <?php echo esc_html( $title ); ?>
                </a>
            </div>







        <?php endforeach; ?>


    </div>
</div>
<?php endif; ?>

</div>




<?php get_footer(); ?>