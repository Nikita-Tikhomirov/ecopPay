<?php
/**
 * Template Name: Все просмотренные курсы
 */ ?>
<?php get_header(); ?>

<div class="main-content main-content-search">

    <div class="main-content-left blogs-content-left">

        <div class="main-title-stripe">
            <h1>Все просмотренные курсы</h1>
        </div>

    </div>

    <div class="wcat wcatinner">

        <div class="catalog">

            <?php
            // Получаем ID просмотренных курсов из куки
            $viewed = isset($_COOKIE['viewed_courses']) ? explode(',', $_COOKIE['viewed_courses']) : [];

            if (!empty($viewed)) {
                // Получаем посты, соответствующие ID из куки
                $courses = get_posts([
                    'post_type' => 'post', // Или другой кастомный тип, если это нужно
                    'post__in' => $viewed,
                    'orderby' => 'post__in',
                    'posts_per_page' => -1, // Показываем все просмотренные курсы
                ]);
            }

            if (!empty($courses)): ?>
                <?php foreach ($courses as $course): ?>
                    <div class="citem" itemscope="itemscope" itemtype="https://schema.org/Product">

                        <?php
                        $image = get_field('kartinka_kursa', $course->ID);
                        if (!empty($image)): ?>
                            <a class="ciimage" href="<?php echo get_permalink($course); ?>">
                                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                            </a>
                        <?php endif; ?>


                        <div class="cicont">
                            <a class="cilink" href="<?php echo get_permalink($course); ?>">
                                <?php echo get_the_title($course); ?>
                            </a>
                            <div class="ciparams">
                                <div>
                                    <div>
                                        <?php the_field('kategoriya_slushatelej_zagolovok', $course); ?> :
                                    </div>
                                    <?php the_field('kategoriya_slushatelej', $course); ?>
                                </div>
                                <div>
                                    <div>
                                        <?php the_field('itogovyj_dokument_zagolovok', $course); ?> :
                                    </div>
                                    <?php the_field('itogovyj_dokument', $course); ?>
                                </div>
                            </div>
                            <div class="ciprice" itemprop="offers" itemscope="itemscope" itemtype="https://schema.org/Offer">
                                <?php the_field('stoimost_kursa', $course); ?> руб.
                                <meta itemprop="price" content="<?php the_field('stoimost_kursa', $course); ?>">
                                <meta itemprop="priceCurrency" content="RUB">
                            </div>
                        </div>

                        <div class="ciinfo">
                            <div>
                                <div>Продолжительность:</div>
                                <?php the_field('prodolzhitelnost', $course); ?>
                            </div>

                            <div>
                                <div>
                                    <a data-fancybox="" data-src="#hidden-content2" href="javascript:;"
                                        data-click="Контрактный управляющий"
                                        data-click2="https://ecoprf.ru/profperepodgotovka/goszakupki-obuchenie/kontraktnyj-upravliaiushchij/"
                                        class="header-message get-info">Получить консультацию</a>
                                </div>
                            </div>
                        </div>

                        <meta itemprop="description"
                            content='<?php echo get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true); ?>'>

                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <p>Вы не просмотрели ни одного курса.</p>
            <?php endif; ?>

        </div>
    </div>

    <div style="margin-top:50px">
        <h2 style="font-size:30px;text-align:center;margin-bottom:30px">Найти другие курсы</h2>
        <form data-aos="fade-up" data-aos-duration="800" class="navbar-form navbar-left" role="search" method="get"
            id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
            <div class="form-group">
                <input type="text" value="" name="s" id="s" />
                <input type="submit" name="submit" class="btn btn-default" id="searchsubmit" value="Поиск" />
            </div>
        </form>
    </div>

</div>

<?php get_footer(); ?>