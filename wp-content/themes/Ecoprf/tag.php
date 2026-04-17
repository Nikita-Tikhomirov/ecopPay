<?php get_header(); ?>


    <div class="main-content main-content-posters">

        <div class="main-content-left">

            <div class="main-title-stripe">
                <h1>Афіша</h1>
            </div>

            <ul class="posters-navigation">
                <li class="nav-movie">
                    <a href="/tag/kino/">Кіно</a>
                </li>
                <li class="nav-concert">
                    <a href="/tag/konczert/">Концерт</a>
                </li>
                <li class="nav-spectacle">
                    <a href="/tag/vystavy/">Вистави</a>
                </li>
                <li class="nav-festivals">
                    <a href="/tag/festyvali/">Фестивалі</a>
                </li>
                <li class="nav-festivals2">
                    <a href="/tag/festyvali/">Фестивалі</a>
                </li>
                <li class="nav-exhibitions">
                    <a href="/tag/vystavky/">Виставки</a>
                </li>
                <li class="nav-for-children">
                    <a href="/tag/dlya-ditej/">Для дітей</a>
                </li>
                <li class="nav-sport">
                    <a href="/tag/sport/">Спорт</a>
                </li>
                <li class="nav-evolution">
                    <a href="/tag/rozvytok/">Розвиток</a>
                </li>
            </ul>


        <div class="main-content-posters-area">

<?php
$postersUrl = explode('/', $_SERVER['REQUEST_URI']);
$args = array(
    'numberposts' => 12,
    'post_status' => 'publish',
    'post_type'   => array('poster', 'blogs'),
    'tag' => $postersUrl[2]
);
$posts = get_posts( $args );
foreach( $posts as $post ){
    ?>

            <a href="<?php echo get_permalink(); ?>" class="poster-preview" style="background-image: url('<?php the_post_thumbnail_url( 'large' ); ?>')">

                <div class="poster-preview-date">
                    <?php echo get_the_date('d.m.Y'); ?>
                </div>

                <div class="poster-preview-title">
                    <?php the_title(); ?>
                </div>

                <div class="swiper-main-news-slide-gradient">
                </div>

            </a>

    <?php
}
wp_reset_postdata(); // сброс
?>

        </div>


        </div>

        <div class="main-content-right">

            <?php echo get_template_part('templates/main-right-bar'); ?>

        </div>

    </div>




<?php get_footer(); ?>