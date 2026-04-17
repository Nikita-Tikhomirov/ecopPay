<div class="wcat wcatinner">

    <div class="catalog">



        <?php
        // 24 - рабочие профессии
        // 47 - бьюти индустрия
        // 2 - повышение квалификации
        // 3 - профпереподгатовка
        if (is_category(24)) {
            $args = array(
                'include' => 47,
                'hide_empty' => 1,

            );
            $categories = get_categories($args);
            usort($categories, function ($a, $b) {
                $a_rating = (int) get_field('rtng', 'category_' . $a->term_id);
                $b_rating = (int) get_field('rtng', 'category_' . $b->term_id);

                $a_rating = $a_rating ?: 0;
                $b_rating = $b_rating ?: 0;

                if ($a_rating === $b_rating) {
                    return strcasecmp($a->name, $b->name); // сортировка по алфавиту
                }

                return $b_rating - $a_rating; // по убыванию рейтинга
            });
            foreach ($categories as $category) {

                $taxonomy = $queried_object->taxonomy;
                ?>

                <div class="citem" itemscope="itemscope" itemtype="https://schema.org/Product">

                    <a class="ciimage" href="<?= get_category_link($category->term_id); ?>">
                        <img itemprop="image" src="<?php the_field('kartinka_kursa', $taxonomy . '_' . $category->term_id); ?>"
                            alt="<?php echo $category->name; ?>">
                    </a>

                    <div class="cicont">

                        <a class="cilink" href="<?= get_category_link($category->term_id); ?>">
                            <?php echo $category->name; ?>
                            <meta itemprop="name" content="<?php the_title(); ?>">
                        </a>

                        <div class="ciparams">
                            <div>
                                <div>
                                    <?php the_field('kategoriya_slushatelej_zagolovok', $taxonomy . '_' . $category->term_id); ?>
                                    :
                                </div>
                                <?php the_field('kategoriya_slushatelej', $taxonomy . '_' . $category->term_id); ?>
                            </div>
                            <div>
                                <div>
                                    <?php the_field('itogovyj_dokument_zagolovok', $taxonomy . '_' . $category->term_id); ?> :
                                </div>
                                <?php the_field('itogovyj_dokument', $taxonomy . '_' . $category->term_id); ?>
                            </div>
                        </div>

                    </div>
                    <div class="ciinfo">
                        <!-- 123 -->
                        <div>
                            <div>Продолжительность:</div>
                            <?php the_field('prodolzhitelnost', $taxonomy . '_' . $category->term_id); ?>
                        </div>

                        <div>
                            <a data-fancybox="" data-src="#hidden-content2" href="javascript:;"
                                data-click="<?php echo $category->name; ?>"
                                data-click2="<?= get_category_link($category->term_id); ?>"
                                class="header-message get-info">Получить консультацию</a>
                        </div>
<div class="cartBtnsWrap" data-product-id="<?php echo get_the_ID(); ?>"
                            data-category-id="<?php echo get_the_category()[0]->term_id ?? 0; ?>"
                            data-price="<?php the_field('stoimost_kursa'); ?>">

                            <div class="cartBtn">
                                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.5 19.5C10.0523 19.5 10.5 19.0523 10.5 18.5C10.5 17.9477 10.0523 17.5 9.5 17.5C8.94772 17.5 8.5 17.9477 8.5 18.5C8.5 19.0523 8.94772 19.5 9.5 19.5ZM9.5 20.5C10.6046 20.5 11.5 19.6046 11.5 18.5C11.5 17.3954 10.6046 16.5 9.5 16.5C8.39543 16.5 7.5 17.3954 7.5 18.5C7.5 19.6046 8.39543 20.5 9.5 20.5Z"
                                        fill="#0d5bd9" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M16.5 19.5C17.0523 19.5 17.5 19.0523 17.5 18.5C17.5 17.9477 17.0523 17.5 16.5 17.5C15.9477 17.5 15.5 17.9477 15.5 18.5C15.5 19.0523 15.9477 19.5 16.5 19.5ZM16.5 20.5C17.6046 20.5 18.5 19.6046 18.5 18.5C18.5 17.3954 17.6046 16.5 16.5 16.5C15.3954 16.5 14.5 17.3954 14.5 18.5C14.5 19.6046 15.3954 20.5 16.5 20.5Z"
                                        fill="#0d5bd9" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M3 4C3 3.72386 3.22386 3.5 3.5 3.5H5.5C5.71767 3.5 5.91033 3.64082 5.97641 3.84822L9.36993 14.5H17C17.2761 14.5 17.5 14.7239 17.5 15C17.5 15.2761 17.2761 15.5 17 15.5H9.00446C8.78679 15.5 8.59413 15.3592 8.52805 15.1518L5.13453 4.5H3.5C3.22386 4.5 3 4.27614 3 4Z"
                                        fill="#0d5bd9" />
                                    <path
                                        d="M8.5 13L6 6H19.3371C19.6693 6 19.9092 6.31795 19.8179 6.63736L18.1036 12.6374C18.0423 12.852 17.8461 13 17.6228 13H8.5Z"
                                        fill="#0d5bd9" />
                                </svg>
                            </div>
                            <a href="<?php the_permalink(18774) ?>" class="cartLink">Онлайн оплата / Рассрочка</a>


                        </div>

                    </div>

                    <meta itemprop="description"
                        content='<?php echo get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true); ?>'>

                </div>


                <?php
            }

        }

        if (is_category([3, 2])) {

            $queried_object = get_queried_object();
            $term_id = $queried_object->term_id;

            $obj_term = get_term($term_id);
            // echo $obj_term->count;
            $args = array(
                'parent' => $term_id,
                'hide_empty' => 1,

            );
            $categories = get_categories($args);
            usort($categories, function ($a, $b) {
                $a_rating = (int) get_field('rtng', 'category_' . $a->term_id);
                $b_rating = (int) get_field('rtng', 'category_' . $b->term_id);

                $a_rating = $a_rating ?: 0;
                $b_rating = $b_rating ?: 0;

                if ($a_rating === $b_rating) {
                    return strcasecmp($a->name, $b->name); // сортировка по алфавиту
                }

                return $b_rating - $a_rating; // по убыванию рейтинга
            });
            foreach ($categories as $category) {
                ?>

                <div class="citem" itemscope="itemscope" itemtype="https://schema.org/Product">

                    <a class="ciimage" href="<?= get_category_link($category->term_id); ?>">
                        <img itemprop="image" src="<?php the_field('kartinka_kursa', $taxonomy . '_' . $category->term_id); ?>"
                            alt="<?php echo $category->name; ?>">
                    </a>

                    <div class="cicont">

                        <a class="cilink" href="<?= get_category_link($category->term_id); ?>">
                            <?php echo $category->name; ?>
                            <meta itemprop="name" content="<?php the_title(); ?>">
                        </a>

                        <div class="ciparams">
                            <div>
                                <div>
                                    <?php the_field('kategoriya_slushatelej_zagolovok', $taxonomy . '_' . $category->term_id); ?>
                                    :
                                </div>
                                <?php the_field('kategoriya_slushatelej', $taxonomy . '_' . $category->term_id); ?>
                            </div>
                            <div>
                                <div>
                                    <?php the_field('itogovyj_dokument_zagolovok', $taxonomy . '_' . $category->term_id); ?> :
                                </div>
                                <?php the_field('itogovyj_dokument', $taxonomy . '_' . $category->term_id); ?>
                            </div>
                        </div>

                    </div>
                    <div class="ciinfo">

                        <div>
                            <a data-fancybox="" data-src="#hidden-content2" href="javascript:;"
                                data-click="<?php echo $category->name; ?>"
                                data-click2="<?= get_category_link($category->term_id); ?>"
                                class="header-message get-info">Получить консультацию</a>
                        </div>
                    </div>

                    <meta itemprop="description"
                        content='<?php echo get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true); ?>'>

                </div>


                <?php
            }

            ?>

            <?php


        } else {
            // Get the related posts from the custom field 'posty_bez_b' for post ID 4134
            $related_posts = get_field('posty_bez_b', 4134);

            // Prepare an array of post IDs to exclude
            $exclude_ids = array(1886); // Existing excluded post ID
            if ($related_posts && is_array($related_posts)) {
                $related_post_ids = wp_list_pluck($related_posts, 'ID');
                $exclude_ids = array_merge($exclude_ids, $related_post_ids);
            }

            // Get the queried object and term ID
            $queried_object = get_queried_object();
            $term_id = $queried_object->term_id;

            // Define the query arguments
            $args1 = array(
                'numberposts' => -1,
                'posts_per_page' => 10,
                'paged' => get_query_var('paged') ?: 1,
                'post_type' => 'post',
                'cat' => $term_id,
                'meta_key' => 'rtng',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'post__not_in' => $exclude_ids, // Exclude post 1886 and posts from posty_bez_b
            );


            // $myposts = get_posts( $args1 );
        
            $query = new WP_Query($args1);


            // foreach( $myposts as $post ){
            //     setup_postdata( $post );
        
            if ($query->have_posts()) {

                while ($query->have_posts()) {
                    $query->the_post();

                    ?>


                    <div class="citem" itemscope="itemscope" itemtype="https://schema.org/Product">

                        <a class="ciimage" href="<?php echo get_permalink(); ?>">




                            <?php

                            $image = get_field('kartinka_kursa');

                            if (!empty($image)):

                                // переменные
                                $url = $image['url'];
                                $title = $image['title'];
                                $alt = $image['alt'];
                                $caption = $image['caption'];

                                // миниатюра
                                $size = 'large';
                                $thumb = $image['sizes'][$size];
                                $width = $image['sizes'][$size . '-width'];
                                $height = $image['sizes'][$size . '-height'];

                                ?>

                                <img itemprop="image" src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>"
                                    width="<?php echo $width; ?>" height="<?php echo $height; ?>" />



                            <?php endif; ?>


                        </a>

                        <div class="cicont">
                            <a class="cilink" href="<?php echo get_permalink(); ?>">
                                <?php the_title(); ?>
                                <meta itemprop="name" content="<?php the_title(); ?>">
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
                                <a data-fancybox="" data-src="#hidden-content2" href="javascript:;"
                                    data-click="<?php the_title(); ?>" data-click2="<?php the_permalink(); ?>"
                                    class="header-message get-info">Получить консультацию</a>
                            </div>

                            <?php if (!is_category(4) && !is_category(13) && !is_category(44)) { ?>
<div class="cartBtnsWrap" data-product-id="<?php echo get_the_ID(); ?>"
                                data-category-id="<?php echo get_the_category()[0]->term_id ?? 0; ?>"
                                data-price="<?php the_field('stoimost_kursa'); ?>">

                                <div class="cartBtn">
                                    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M9.5 19.5C10.0523 19.5 10.5 19.0523 10.5 18.5C10.5 17.9477 10.0523 17.5 9.5 17.5C8.94772 17.5 8.5 17.9477 8.5 18.5C8.5 19.0523 8.94772 19.5 9.5 19.5ZM9.5 20.5C10.6046 20.5 11.5 19.6046 11.5 18.5C11.5 17.3954 10.6046 16.5 9.5 16.5C8.39543 16.5 7.5 17.3954 7.5 18.5C7.5 19.6046 8.39543 20.5 9.5 20.5Z"
                                            fill="#0d5bd9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.5 19.5C17.0523 19.5 17.5 19.0523 17.5 18.5C17.5 17.9477 17.0523 17.5 16.5 17.5C15.9477 17.5 15.5 17.9477 15.5 18.5C15.5 19.0523 15.9477 19.5 16.5 19.5ZM16.5 20.5C17.6046 20.5 18.5 19.6046 18.5 18.5C18.5 17.3954 17.6046 16.5 16.5 16.5C15.3954 16.5 14.5 17.3954 14.5 18.5C14.5 19.6046 15.3954 20.5 16.5 20.5Z"
                                            fill="#0d5bd9" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3 4C3 3.72386 3.22386 3.5 3.5 3.5H5.5C5.71767 3.5 5.91033 3.64082 5.97641 3.84822L9.36993 14.5H17C17.2761 14.5 17.5 14.7239 17.5 15C17.5 15.2761 17.2761 15.5 17 15.5H9.00446C8.78679 15.5 8.59413 15.3592 8.52805 15.1518L5.13453 4.5H3.5C3.22386 4.5 3 4.27614 3 4Z"
                                            fill="#0d5bd9" />
                                        <path
                                            d="M8.5 13L6 6H19.3371C19.6693 6 19.9092 6.31795 19.8179 6.63736L18.1036 12.6374C18.0423 12.852 17.8461 13 17.6228 13H8.5Z"
                                            fill="#0d5bd9" />
                                    </svg>
                                </div>
                                <a href="<?php the_permalink(18774) ?>" class="cartLink">Онлайн оплата / Рассрочка</a>


                            </div>

                            <?php } ?>
                        </div>

                        <meta itemprop="description"
                            content='<?php echo get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true); ?>'>

                    </div>
                    <?php
                }


                $argsp = array(
                    'show_all' => false,
                    // показаны все страницы участвующие в пагинации
                    'end_size' => 1,
                    // количество страниц на концах
                    'mid_size' => 1,
                    // количество страниц вокруг текущей
                    'prev_next' => true,
                    // выводить ли боковые ссылки "предыдущая/следующая страница".
                    'prev_text' => __('«'),
                    'next_text' => __('»'),
                    'add_args' => false,
                    // Массив аргументов (переменных запроса), которые нужно добавить к ссылкам.
                    'add_fragment' => '',
                    // Текст который добавиться ко всем ссылкам.
                    'screen_reader_text' => __('Posts navigation'),
                    'class' => 'pagination', // CSS класс, добавлено в 5.5.0.
                );

                ?>
                <div class="new-pag">
                    <?php
                    // Проверяем, что это не рубрика с ID 5
                    if (!is_category(5)) {

                        the_posts_pagination($argsp);

                        if ($query->found_posts >= 10) {
                            ?>
                            <div class="pag-counter">
                                Всего курсов <?php echo $query->found_posts; ?>
                            </div>
                            <?php
                        }

                    }
                    ?>
                </div>


                <?php

                wp_reset_query(); // сброс $wp_query
        
            }
        }

        ?>

        <?php
        if (is_category([4])) {

            $term = get_term(44);
            $catNow = get_category(44);
            $category_id = get_cat_ID($catNow->name);
            ?>

            <div class="citem" itemscope="itemscope" itemtype="https://schema.org/Product">

                <a class="ciimage" href="<?php echo get_category_link($category_id); ?>">

                    <img itemprop="image" src="<?php the_field('kartinka_kursa', $term); ?>"
                        alt="<?php echo $catNow->name; ?>" />

                </a>

                <div class="cicont">

                    <a class="cilink" href="<?php echo get_category_link($category_id); ?>">
                        <?php echo $catNow->name; ?>
                        <meta itemprop="name" content="<?php the_title(44); ?>">
                    </a>

                    <div class="ciparams">
                        <div>
                            <div>
                                <?php the_field('kategoriya_slushatelej_zagolovok', $term); ?>
                                :
                            </div>
                            <?php the_field('kategoriya_slushatelej', $term); ?>
                        </div>
                        <div>
                            <div>
                                <?php the_field('itogovyj_dokument_zagolovok', $term); ?> :
                            </div>
                            <?php the_field('itogovyj_dokument', $term); ?>
                        </div>
                    </div>
                    <div class="ciprice" itemprop="offers" itemscope="itemscope" itemtype="https://schema.org/Offer"
                        class="ciprice">
                        <?php the_field('czena_dlya_rubriki', $term); ?> руб.

                        <meta itemprop="price" content="<?php the_field('czena_dlya_rubriki', $term); ?>">
                        <meta itemprop="priceCurrency" content="RUB">
                    </div>

                </div>
                <div class="ciinfo">
                    <div>
                        <div>Продолжительность:</div>
                        <?php the_field('prodolzhitelnost', $term); ?>
                    </div>
                    <div>
                        <a data-fancybox="" data-src="#hidden-content2" href="javascript:;"
                            data-click="<?php echo $catNow->name; ?>"
                            data-click2="<?= get_category_link($catNow->term_id); ?>"
                            class="header-message get-info">Получить консультацию</a>
                    </div>
<div class="cartBtnsWrap" data-product-id="<?php echo get_the_ID(); ?>"
                        data-category-id="<?php echo get_the_category()[0]->term_id ?? 0; ?>"
                        data-price="<?php the_field('stoimost_kursa'); ?>">

                        <div class="cartBtn">
                            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M9.5 19.5C10.0523 19.5 10.5 19.0523 10.5 18.5C10.5 17.9477 10.0523 17.5 9.5 17.5C8.94772 17.5 8.5 17.9477 8.5 18.5C8.5 19.0523 8.94772 19.5 9.5 19.5ZM9.5 20.5C10.6046 20.5 11.5 19.6046 11.5 18.5C11.5 17.3954 10.6046 16.5 9.5 16.5C8.39543 16.5 7.5 17.3954 7.5 18.5C7.5 19.6046 8.39543 20.5 9.5 20.5Z"
                                    fill="#0d5bd9" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M16.5 19.5C17.0523 19.5 17.5 19.0523 17.5 18.5C17.5 17.9477 17.0523 17.5 16.5 17.5C15.9477 17.5 15.5 17.9477 15.5 18.5C15.5 19.0523 15.9477 19.5 16.5 19.5ZM16.5 20.5C17.6046 20.5 18.5 19.6046 18.5 18.5C18.5 17.3954 17.6046 16.5 16.5 16.5C15.3954 16.5 14.5 17.3954 14.5 18.5C14.5 19.6046 15.3954 20.5 16.5 20.5Z"
                                    fill="#0d5bd9" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3 4C3 3.72386 3.22386 3.5 3.5 3.5H5.5C5.71767 3.5 5.91033 3.64082 5.97641 3.84822L9.36993 14.5H17C17.2761 14.5 17.5 14.7239 17.5 15C17.5 15.2761 17.2761 15.5 17 15.5H9.00446C8.78679 15.5 8.59413 15.3592 8.52805 15.1518L5.13453 4.5H3.5C3.22386 4.5 3 4.27614 3 4Z"
                                    fill="#0d5bd9" />
                                <path
                                    d="M8.5 13L6 6H19.3371C19.6693 6 19.9092 6.31795 19.8179 6.63736L18.1036 12.6374C18.0423 12.852 17.8461 13 17.6228 13H8.5Z"
                                    fill="#0d5bd9" />
                            </svg>
                        </div>
                        <a href="<?php the_permalink(18774) ?>" class="cartLink">Онлайн оплата / Рассрочка</a>


                    </div>
                </div>

                <meta itemprop="description" content='<?php echo get_post_meta($catNow, '_yoast_wpseo_metadesc', true); ?>'>

            </div>

            <?php
        }
        ;

        if (is_category([7])) {

            $term = get_term(46);
            $catNow = get_category(46);
            $category_id = get_cat_ID($catNow->name);
            ?>

            <div class="citem" itemscope="itemscope" itemtype="https://schema.org/Product">

                <a class="ciimage" href="<?php echo get_category_link($category_id); ?>">
                    <?php

                    $image = get_field('kartinka_kursa');

                    if (!empty($image)):

                        // переменные
                        $url = $image['url'];
                        $title = $image['title'];
                        $alt = $image['alt'];
                        $caption = $image['caption'];

                        // миниатюра
                        $size = 'large';
                        $thumb = $image['sizes'][$size];
                        $width = $image['sizes'][$size . '-width'];
                        $height = $image['sizes'][$size . '-height'];

                        ?>



                        <img itemprop="image" src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>"
                            width="<?php echo $width; ?>" height="<?php echo $height; ?>" />

                        <!-- Проблема -->


                    <?php endif; ?>
                </a>

                <div class="cicont">

                    <a class="cilink" href="<?php echo get_category_link($category_id); ?>">
                        <?php echo $catNow->name; ?>
                        <meta itemprop="name" content="<?php the_title(44); ?>">
                    </a>

                    <div class="ciparams">
                        <div>
                            <div>
                                <?php the_field('kategoriya_slushatelej_zagolovok', $term); ?>
                                :
                            </div>
                            <?php the_field('kategoriya_slushatelej', $term); ?>
                        </div>
                        <div>
                            <div>
                                <?php the_field('itogovyj_dokument_zagolovok', $term); ?> :
                            </div>
                            <?php the_field('itogovyj_dokument', $term); ?>
                        </div>
                    </div>
                    <div class="ciprice" itemprop="offers" itemscope="itemscope" itemtype="https://schema.org/Offer"
                        class="ciprice">
                        <?php the_field('czena_dlya_rubriki', $term); ?> руб.

                        <meta itemprop="price" content="<?php the_field('czena_dlya_rubriki', $term); ?>">
                        <meta itemprop="priceCurrency" content="RUB">
                    </div>

                </div>
                <div class="ciinfo">
                    <div>
                        <div>Продолжительность:</div>
                        <?php the_field('prodolzhitelnost', $term); ?>
                    </div>
                    <div>
                        <a data-fancybox="" data-src="#hidden-content2" href="javascript:;"
                            data-click="<?php echo $catNow->name; ?>"
                            data-click2="<?= get_category_link($catNow->term_id); ?>"
                            class="header-message get-info">Получить консультацию</a>
                    </div>
<div class="cartBtnsWrap" data-product-id="<?php echo get_the_ID(); ?>"
                        data-category-id="<?php echo get_the_category()[0]->term_id ?? 0; ?>"
                        data-price="<?php the_field('stoimost_kursa'); ?>">

                        <div class="cartBtn">
                            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M9.5 19.5C10.0523 19.5 10.5 19.0523 10.5 18.5C10.5 17.9477 10.0523 17.5 9.5 17.5C8.94772 17.5 8.5 17.9477 8.5 18.5C8.5 19.0523 8.94772 19.5 9.5 19.5ZM9.5 20.5C10.6046 20.5 11.5 19.6046 11.5 18.5C11.5 17.3954 10.6046 16.5 9.5 16.5C8.39543 16.5 7.5 17.3954 7.5 18.5C7.5 19.6046 8.39543 20.5 9.5 20.5Z"
                                    fill="#0d5bd9" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M16.5 19.5C17.0523 19.5 17.5 19.0523 17.5 18.5C17.5 17.9477 17.0523 17.5 16.5 17.5C15.9477 17.5 15.5 17.9477 15.5 18.5C15.5 19.0523 15.9477 19.5 16.5 19.5ZM16.5 20.5C17.6046 20.5 18.5 19.6046 18.5 18.5C18.5 17.3954 17.6046 16.5 16.5 16.5C15.3954 16.5 14.5 17.3954 14.5 18.5C14.5 19.6046 15.3954 20.5 16.5 20.5Z"
                                    fill="#0d5bd9" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3 4C3 3.72386 3.22386 3.5 3.5 3.5H5.5C5.71767 3.5 5.91033 3.64082 5.97641 3.84822L9.36993 14.5H17C17.2761 14.5 17.5 14.7239 17.5 15C17.5 15.2761 17.2761 15.5 17 15.5H9.00446C8.78679 15.5 8.59413 15.3592 8.52805 15.1518L5.13453 4.5H3.5C3.22386 4.5 3 4.27614 3 4Z"
                                    fill="#0d5bd9" />
                                <path
                                    d="M8.5 13L6 6H19.3371C19.6693 6 19.9092 6.31795 19.8179 6.63736L18.1036 12.6374C18.0423 12.852 17.8461 13 17.6228 13H8.5Z"
                                    fill="#0d5bd9" />
                            </svg>
                        </div>
                        <a href="<?php the_permalink(18774) ?>" class="cartLink">Онлайн оплата / Рассрочка</a>


                    </div>
                </div>

                <meta itemprop="description" content='<?php echo get_post_meta($catNow, '_yoast_wpseo_metadesc', true); ?>'>

            </div>

            <?php
        }
        ;
        ?>

    </div>

</div>
<style>
    .new-pag nav:after {
        display: none;
    }

    .new-pag {
        display: flex;
        flex-wrap: wrap;
        align-content: center;
        justify-content: center;
        align-items: center;
    }

    .new-pag .pagination {
        padding: 0;
    }

    .pag-counter {
        margin-left: 20px;
        font-size: 20px;
        font-weight: 600;
        color: #0D5BD9;
    }

    .tabs-link {
        margin-bottom: 0;
    }

    .tabs-link:not(:first-child) {
        margin-top: 0;
    }
</style>



