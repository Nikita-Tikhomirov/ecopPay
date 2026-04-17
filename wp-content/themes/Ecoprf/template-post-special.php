<?php
/*
Template Name: ОТ программа В
Template Post Type: post
*/
?>





<?php get_header('content'); ?>





<?php if (get_field("seo_tekst_vnachale_straniczy")) { ?>
  <div class="seo-text-finish-page">
    <div data-aos="fade-up" data-aos-duration="600" class="content">
      <?php the_field('seo_tekst_vnachale_straniczy'); ?>
    </div>
  </div>
<?php } ?>
<?php
// Получаем посты из ACF-поля posty_bez_b
$related_posts = get_field('posty_bez_b'); // Имя поля из ACF

// Проверяем, есть ли посты
if (!empty($related_posts)) :
    // Если это не массив (Post Object), преобразуем в массив для единообразия
    $related_posts = is_array($related_posts) ? $related_posts : array($related_posts);
    ?>
    <div class="wcat wcatinner">
      <div class="catalog">

        <?php foreach ($related_posts as $post) : // Цикл по постам
            setup_postdata($post); // Устанавливаем контекст поста для ACF и WP функций
        ?>
            <div class="citem" itemscope="itemscope" itemtype="https://schema.org/Product">
                <?php
                // Поле ACF: kartinka_kursa (изображение)
                $image = get_field('kartinka_kursa', $post->ID);
                if (!empty($image)) : ?>
                    <a class="ciimage" href="<?php echo esc_url(get_permalink($post)); ?>">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    </a>
                <?php endif; ?>

                <div class="cicont">
                    <a class="cilink" href="<?php echo esc_url(get_permalink($post)); ?>">
                        <?php echo esc_html(get_the_title($post)); ?>
                    </a>
                    <div class="ciparams">
                        <div>
                            <div>
                                <?php the_field('kategoriya_slushatelej_zagolovok', $post->ID); ?> :
                            </div>
                            <?php the_field('kategoriya_slushatelej', $post->ID); ?>
                        </div>
                        <div>
                            <div>
                                <?php the_field('itogovyj_dokument_zagolovok', $post->ID); ?> :
                            </div>
                            <?php the_field('itogovyj_dokument', $post->ID); ?>
                        </div>
                    </div>
                    <div class="ciprice" itemprop="offers" itemscope="itemscope" itemtype="https://schema.org/Offer">
                        <?php the_field('stoimost_kursa', $post->ID); ?> руб.
                        <meta itemprop="price" content="<?php the_field('stoimost_kursa', $post->ID); ?>">
                        <meta itemprop="priceCurrency" content="RUB">
                    </div>
                </div>

                <div class="ciinfo">
                    <div>
                        <div>Продолжительность:</div>
                        <?php the_field('prodolzhitelnost', $post->ID); ?>
                    </div>
                    <div>
                        <div>
                            <a data-fancybox="" data-src="#hidden-content2" href="javascript:;"
                               data-click="<?php echo esc_attr(get_the_title($post)); ?>"
                               data-click2="<?php echo esc_url(get_permalink($post)); ?>"
                               class="header-message get-info">Получить консультацию</a>
                        </div>
                    </div>
                </div>

                <meta itemprop="description"
                      content="<?php echo esc_attr(get_post_meta($post->ID, '_yoast_wpseo_metadesc', true)); ?>">
            </div>
        <?php endforeach; ?>
        <?php wp_reset_postdata(); // Сбрасываем данные поста ?>

<?php else : ?>
    <p>Вы не просмотрели ни одного курса.</p>
<?php endif; ?>
      </div>
    </div>





<div class="content block_faq">


  <div class="faq-wrap tabsWrapJs">
    <div class="faq-controls-title">Информация</div>
    <div class="faq-controls tabsNavJs">
      <?php
      if (wp_is_mobile()) {

      } else {

        if (have_rows('razdel_kursa')):

          $i = 0;

          while (have_rows('razdel_kursa')):
            the_row();
            $i++;


            if ($i == 1) {
              ?>



              <div class="tabs-link">
                <?php the_sub_field('nazvanie_razdela'); ?>
              </div>


              <?php
            } else {
              ?>

              <div class="tabs-link">
                <?php the_sub_field('nazvanie_razdela'); ?>
              </div>



            <?php }
            ?>
            <?php


          endwhile;

          ?>

          <?php if (have_rows('plan_kursa')): ?>



            <?php while (have_rows('plan_kursa')):
              the_row(); ?>


            <?php endwhile; ?>
            <div class="tabs-link">Учебный план</div>


          <?php endif; ?>


        <?php else:

        endif;

        ?>
      </div>
      <div class="faq-content tabsJs">

        <?php


        if (have_rows('razdel_kursa')):

          $i = 0;


          while (have_rows('razdel_kursa')):
            the_row();
            $i++;

            if ($i == 1) {
              ?>

              <div class="w3-container city tab-content">
                <h2>
                  <?php the_sub_field('nazvanie_razdela'); ?>
                </h2>

                <?php the_sub_field('kontent_razdela'); ?>

              </div>

            <?php } else { ?>


              <div class="w3-container city tab-content">
                <h2>
                  <?php the_sub_field('nazvanie_razdela'); ?>
                </h2>
                <?php the_sub_field('kontent_razdela'); ?>

              </div>


            <?php }

          endwhile; ?>






          <?php if (have_rows('plan_kursa')): ?>


            <div class="w3-container city tab-content">
              <h2 class="tabs-link">Учебный план</h2>
              <table id="tablepress-50" class="tablepress tablepress-responsive stacktable large-only">

                <thead>
                  <tr class="row-1 odd">
                    <th class="column-1">Раздел</th>
                    <th class="column-2">Тема</th>
                    <th class="column-3">Часы</th>
                  </tr>
                </thead>
                <tbody class="row-hover">
                  <?php $allHours = -1; ?>
                  <?php while (have_rows('plan_kursa')):
                    the_row();

                    // переменные
                    $nazvanie = get_sub_field('nazvanie');
                    $chasy = get_sub_field('chasy');
                    // $opisanie = get_sub_field('opisanie');
                    $plan_order = get_row_index();
                    $allHours = $allHours + $chasy;

                    ?>







                    <tr class="">
                      <td class="column-1">
                        <?php echo $plan_order; ?>
                      </td>
                      <td class="column-2">
                        <?php echo $nazvanie; ?>
                      </td>
                      <td class="column-3">
                        <?php echo $chasy; ?>
                      </td>
                    </tr>





                  <?php endwhile; ?>

                  <!-- <?php $allHours = ++$allHours; ?> -->
                </tbody>
                <tfoot>
                  <tr class="odd">
                    <th class="column-1"></th>
                    <th class="column-2">Всего:</th>
                    <th class="column-3">
                      <?php echo $allHours; ?>
                    </th>
                  </tr>
                </tfoot>
              </table>
              <!-- <div class="hours-plan">
            
          </div> -->
            </div>
          <?php endif; ?>


          <?php



          // No value.
        else:
          // Do something...
        endif;


      } ?>

    </div>

  </div>

  <div class="acrdn-wrap">


    <?php

    if (wp_is_mobile()) {
      // Check rows exists.
    
      if (have_rows('razdel_kursa')):


        while (have_rows('razdel_kursa')):
          the_row(); ?>

          <div class="accardionJs">
            <h2 class="accardion__title">
              <?php the_sub_field('nazvanie_razdela'); ?>

            </h2>


            <div class="accardionContentJs">
              <div class="accardion__content">
                <?php the_sub_field('kontent_razdela'); ?>
              </div>
            </div>
          </div>
          <?php

          // End loop.
        endwhile;

        // No value.
      else:
        // Do something...
      endif;







      if (have_rows('plan_kursa')): ?>
        <div class="accardionJs">
          <h2 class="accardion__title">Учебный план</h2>
          <div class="accardionContentJs">
            <div class="accardion__content">
              <table id="tablepress-50" class="tablepress tablepress-responsive stacktable large-only"
                style="display:table!important">

                <thead>
                  <tr class="row-1 odd">
                    <th class="column-1">Раздел</th>
                    <th class="column-2">Тема</th>
                    <th class="column-3">Часы</th>
                  </tr>
                </thead>
                <tbody class="row-hover">
                  <?php $allHours = -1; ?>
                  <?php while (have_rows('plan_kursa')):
                    the_row();

                    // переменные
                    $nazvanie = get_sub_field('nazvanie');
                    $chasy = get_sub_field('chasy');
                    // $opisanie = get_sub_field('opisanie');
                    $plan_order = get_row_index();
                    $allHours = $allHours + $chasy;

                    ?>







                    <tr class="">
                      <td class="column-1">
                        <?php echo $plan_order; ?>
                      </td>
                      <td class="column-2">
                        <?php echo $nazvanie; ?>
                      </td>
                      <td class="column-3">
                        <?php echo $chasy; ?>
                      </td>
                    </tr>





                  <?php endwhile; ?>

                  <!-- <?php $allHours = ++$allHours; ?> -->
                </tbody>
                <tfoot>
                  <tr class="odd">
                    <th class="column-1"></th>
                    <th class="column-2">Всего:</th>
                    <th class="column-3">
                      <?php echo $allHours; ?>
                    </th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>


        <!-- <div class="hours-plan">
    
  </div> -->

      <?php endif; ?>

    <?php } ?>






  </div>

</div>

<?php
if ($post->ID != 90) {

} else {
  include('templates/qwiz.php');
}
?>

<?php
// Получаем текущий объект категории и его родителя
$queried_object = get_queried_object();
$taxonomy = 'category';
$term_id = $queried_object->term_id;

// Получаем категории поста
$categories = get_the_category();
$category_id = $categories[0]->term_id;
$parentCatId = $categories[0]->parent;

// Определяем ID категории для использования: родительская или текущая
$faq_category_id = $parentCatId ? $parentCatId : $category_id;

// Проверяем, есть ли блоки FAQ в определенной категории
if (have_rows('blok_faq', $taxonomy . '_' . $faq_category_id)): ?>
  <div class="accordion-wrap">
    <?php
    while (have_rows('blok_faq', $taxonomy . '_' . $faq_category_id)):
      the_row();
      ?>
      <div class="accordion-item-wrap" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <button class="accordion" itemprop="name"><?php the_sub_field('vopros'); ?></button>
        <div class="panel" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
          <div class="accordion-answer" itemprop="text">
            <?php the_sub_field('otvet'); ?>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
<?php else: ?>
  <p>Нет доступных вопросов-ответов.</p>
<?php endif; ?>









<?php if (get_field("seo_tekst_v_koncze_straniczy")) { ?>
  <div class="seo-text-finish-page">
    <div data-aos="fade-up" data-aos-duration="600" class="content">
      <?php the_field('seo_tekst_v_koncze_straniczy'); ?>
    </div>
  </div>
<?php } ?>

<?php

$featured_posts = get_field('related-posts');



if ($featured_posts): ?>

  <div class="wcat" style="box-shadow:none;min-height:auto;">
    <h3 style="font-size:30px">
      <?php the_field('pohozhie_kursy_zagolovok'); ?>
    </h3>
  </div>


  <style>
    .relative-course__wrap {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      grid-gap: 20px;
    }

    .relative-course__img-wrap {
      overflow: hidden;
    }

    .relative-course__img-wrap img {
      max-width: 100%;
      transition: 0.2s;
    }

    .relative-course {
      box-shadow: 0 0 5px rgb(67 73 108 / 10%);
      transition: 0.2s;

    }

    .relative-course:hover {
      box-shadow: 0 0 20px rgb(67 73 108 / 10%);
    }

    .relative-course:hover img {
      transform: scale(1.1)
    }

    .relative-course__title {
      padding: 15px 20px;
    }

    .faq-wrap {
      width: 100%;
    }

    .faq-content {
      width: inherit;
    }

    .tabs-link {
      margin-bottom: 0;
    }

    .tabs-link:not(:first-child) {
      margin-top: 0;
    }

    .header-message.get-info {
      text-align: center;
    }

    @media (max-width: 1024px) {
      .relative-course__wrap {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    @media (max-width: 992px) {
      .relative-course__wrap {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 576px) {
      .relative-course__wrap {
        grid-template-columns: 1fr
      }
    }
  </style>

  <div class="wcat wcatinner" style="margin-bottom:40px; box-shadow:none; padding:10px;">
    <div class=" relative-course__wrap">






      <?php foreach ($featured_posts as $featured_post):
        $permalink = get_permalink($featured_post->ID);
        $title123 = get_the_title($featured_post->ID);
        ?>




        <div data-aos="fade-right" data-aos-duration="600" class="relative-course" itemscope="itemscope"
          itemtype="https://schema.org/Product">

          <div class="relative-course__img-wrap">

            <?php

            $image = get_field('kartinka_kursa', $featured_post->ID);

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



              <img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>"
                height="<?php echo $height; ?>" />



            <?php endif; ?>





          </div>

          <a href="<?php echo esc_url($permalink); ?>" class="relative-course__title">
            <?php echo esc_html($title123); ?>
          </a>
        </div>







      <?php endforeach; ?>


    </div>
  </div>
<?php endif; ?>


<?php echo get_template_part('templates/faq'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<section class="customRevsMain">
  <style>
    .customRevsMain {
      margin-top: 40px;
      margin-bottom: ;
    }

    .customRevsMain img {
      max-width: 100%;
    }
  </style>
  <?php include(TEMPLATEPATH . '/templates/customRevsCats.php'); ?>
</section>

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
  if (window.innerWidth <= 700) {

    jQuery('.tablink').on('click', function () {
      var id = jQuery(this).attr('data-id');
      var nameClass = `.${id}`;
      var nameId = `#${id}`;
      //console.log(id);
      jQuery(nameId).hide().clone().appendTo(nameClass).show();

      jQuery(this).addClass('w3-red');
    })

  }
</script>




<?php get_footer(); ?>





<div style="display: none;" class="leave-request" id="hidden-content2">

  <p class="leave-request-title">
    Получить консультацию
  </p>

  <?php echo do_shortcode("[contact-form-7 id='188' title='Форма Получить консультацию из блока Курса']"); ?>

</div>