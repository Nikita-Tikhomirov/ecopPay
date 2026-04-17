<?php get_header(); ?>



<div class="main-content main-content-search">

    <div class="main-content-left blogs-content-left">

        <div class="main-title-stripe">
            <h1>Результаты поиска</h1>
        </div>

    </div>

    <div class="wcat wcatinner">

        <div class="catalog">


            <?php if (have_posts()): ?>
                <?php while (have_posts()):
                    the_post();
                    ?>

                    <div class="citem" itemscope="itemscope" itemtype="https://schema.org/Product">

                        <!-- <a class="ciimage" href="<?php echo get_permalink(); ?>">
                            <img itemprop="image" src="<?php the_field('kartinka_kursa'); ?>" alt="">
                        </a> -->
                        <?php

                        $image = get_field('kartinka_kursa');

                        if (!empty($image)): ?>
                            <a class="ciimage" href="<?php echo get_permalink(); ?>">
                                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                            </a>

                        <?php endif; ?>

                        <div class="cicont">
                            <a class="cilink" href="<?php echo get_permalink(); ?>">
                                <?php the_title(); ?>
                                <!-- <meta itemprop="name" content="<?php the_title(); ?>"> -->
                            </a>
                            <div class="ciparams">
                                <div>
                                    <div>
                                        <?php the_field('kategoriya_slushatelej_zagolovok'); ?> :
                                    </div>
                                    <?php the_field('kategoriya_slushatelej'); ?>
                                </div>
                                <div>
                                    <div>
                                        <?php the_field('itogovyj_dokument_zagolovok'); ?> :
                                    </div>
                                    <?php the_field('itogovyj_dokument'); ?>
                                </div>
                            </div>
                            <div class="ciprice" itemprop="offers" itemscope="itemscope" itemtype="https://schema.org/Offer"
                                class="ciprice">
                                <?php the_field('stoimost_kursa'); ?> руб.

                                <meta itemprop="price" content="<?php the_field('stoimost_kursa'); ?>">
                                <meta itemprop="priceCurrency" content="RUB">
                            </div>
                        </div>
                        <div class="ciinfo">
                            <!--                <div><div>Дата начала:</div>30.11.0999</div>-->
                            <div>
                                <div>Продолжительность:</div>
                                <?php the_field('prodolzhitelnost'); ?>
                            </div>

                            <div>
                                <div>
                                    <a data-fancybox="" data-src="#hidden-content2" href="javascript:;" class="header-message get-info">Получить консультацию</a>
                                </div>
                                <!-- 
    <?php

            if (is_singular('post')) {
                ?>
            <a data-fancybox="" data-src="#hidden-content2" href="javascript:;" data-click="<?php the_title(); ?>" data-click2="<?php the_permalink(); ?>" class="header-message get-info">Получить консультацию</a>
            <?php
            }
            ?> -->





                            </div>
                        </div>

                        <meta itemprop="description"
                            content='<?php echo get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true); ?>'>

                    </div>


                <?php endwhile; ?>
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
<div style="display: none;" class="leave-request" id="hidden-content2">

    <p class="leave-request-title">
        Получить консультацию
    </p>

    <?php echo do_shortcode('[contact-form-7 id="188" title="Форма Получить консультацию из блока Курса"]'); ?>

</div>