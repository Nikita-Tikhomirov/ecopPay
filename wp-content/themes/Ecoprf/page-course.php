<?php
/**
 * Template Name: Course
 * Template Post Type: post
 */ ?>



<?php get_header('content'); ?>

<?php
// Get the related posts from the custom field 'posty_bez_b' for post ID 4134
$related_posts = get_field('posty_bez_b', 4134);

// Check if the current post is in the related posts array
$current_post_id = get_the_ID();
$is_related_post = $related_posts && in_array($current_post_id, wp_list_pluck($related_posts, 'ID'));

if ($is_related_post) {
  // Custom breadcrumbs for related posts
  ?>
  <div class="breadcrumbs" itemscope="" itemtype="http://schema.org/BreadcrumbList">
    <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
      <a class="breadcrumbs__link" href="https://ecoprf.ru/" itemprop="item"><span itemprop="name">Главная</span></a>
      <meta itemprop="position" content="1">
    </span>
    <span class="breadcrumbs__separator"> › </span>
    <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
      <a class="breadcrumbs__link" href="https://ecoprf.ru/category/povyshenie-kvalifikaczii/" itemprop="item"><span
          itemprop="name">Повышение квалификации</span></a>
      <meta itemprop="position" content="2">
    </span>
    <span class="breadcrumbs__separator"> › </span>
    <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
      <a class="breadcrumbs__link" href="https://ecoprf.ru/category/povyshenie-kvalifikaczii/ohrana-truda/"
        itemprop="item"><span itemprop="name">Охрана труда</span></a>
      <meta itemprop="position" content="3">
    </span>
    <span class="breadcrumbs__separator"> › </span>
    <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
      <a class="breadcrumbs__link" href="<?php echo esc_url(get_permalink(4134)); ?>" itemprop="item"><span
          itemprop="name">Программа В</span></a>
      <meta itemprop="position" content="4">
    </span>
    <span class="breadcrumbs__separator"> › </span>
    <span class="breadcrumbs__current">Безопасные методы и приемы выполнения ремонтных, монтажных и демонтажных работ
      зданий и сооружений</span>
  </div>
  <?php
} elseif (function_exists('dimox_breadcrumbs')) {
  // Default breadcrumbs for other posts
  dimox_breadcrumbs();
}
?>


<?php if (get_field("seo_tekst_vnachale_straniczy")) { ?>
  <div class="seo-text-finish-page">
    <div data-aos="fade-up" data-aos-duration="600" class="content">
      <?php the_field('seo_tekst_vnachale_straniczy'); ?>
    </div>
  </div>
<?php } ?>


<div data-aos="fade-right" data-aos-duration="600" class="citem citem-course-page" itemscope="itemscope"
  itemtype="https://schema.org/Product">


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



      <img itemprop="image" src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>"
        height="<?php echo $height; ?>" />



    <?php endif; ?>


  </a>



  <div class="cicont">
    <a class="cilink" href="<?php echo get_permalink(); ?>">
      <?php the_title(); ?>
      <meta itemprop="name" content="<?php the_title(); ?>">
    </a>

    <meta itemprop="description" content="">
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
    <div class="ciprice" itemprop="offers" itemscope="itemscope" itemtype="https://schema.org/Offer">
      <?php the_field('stoimost_kursa'); ?> руб.

      <meta itemprop="price" content="<?php the_field('stoimost_kursa'); ?>">
      <meta itemprop="priceCurrency" content="RUB">
    </div>
    <div class="specialPriceWrap">
      <svg xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
        <path
          d="M504 256c0 137-111 248-248 248S8 393 8 256C8 119.1 119 8 256 8s248 111.1 248 248zm-248 50c-25.4 0-46 20.6-46 46s20.6 46 46 46 46-20.6 46-46-20.6-46-46-46zm-43.7-165.3l7.4 136c.3 6.4 5.6 11.3 12 11.3h48.5c6.4 0 11.6-5 12-11.3l7.4-136c.4-6.9-5.1-12.7-12-12.7h-63.4c-6.9 0-12.4 5.8-12 12.7z" />
      </svg>
      <span>Специальные цены при коллективной заявке! </span>
      <a href="/price/" target="_blank">Подробнее в прайсе</a>

    </div>

  </div>



  <div class="ciinfo">
    <!--                <div><div>Дата начала:</div>30.11.0999</div>-->
    <div class="courseduration">
      <div>Продолжительность: <?php the_field('prodolzhitelnost'); ?></div>

    </div>

<?php
$exclude = [4, 13, 44]; // категории, где НЕ показываем
$categories = get_the_category();
$hide = false;

if ($categories) {
    foreach ($categories as $cat) {

        // если пост прямо в запрещённой категории
        if (in_array($cat->term_id, $exclude)) {
            $hide = true;
            break;
        }

        // если категория является дочерней от запрещённых
        $ancestors = get_ancestors($cat->term_id, 'category');

        if (array_intersect($exclude, $ancestors)) {
            $hide = true;
            break;
        }
    }
}

if (!$hide) {
?>
    <div class="cartBtnsWrap" data-product-id="<?php echo get_the_ID(); ?>"
      data-category-id="<?php echo get_the_category()[0]->term_id ?? 0; ?>"
      data-price="<?php the_field('stoimost_kursa'); ?>">

      <div class="cartBtn">
        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
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

      <?php
      $targets = [4, 13, 44];
      $categories = get_the_category();
      $show = false;

      if ($categories) {
          foreach ($categories as $cat) {

              // если категория совпадает
              if (in_array($cat->term_id, $targets)) {
                  $show = true;
                  break;
              }

              // если это дочерняя категория одной из targets
              $ancestors = get_ancestors($cat->term_id, 'category');

              if (array_intersect($targets, $ancestors)) {
                  $show = true;
                  break;
              }
          }
      }

      if ($show) {
      ?>
          <div>
              <a data-fancybox=""
                data-src="#hidden-content2"
                href="javascript:;"
                data-click="<?php the_title(); ?>"
                data-click2="<?php the_permalink(); ?>"
                class="header-message get-info">
                  Получить консультацию
              </a>
          </div>
      <?php } ?>

      <?php 
      if (!$hide) {
      ?>
          <div class="files-links-wrap">
      <?php if (get_field('zayavka_fiz_liczo2') || get_field('zayavka_yur_liczo')): ?>

        <div style="margin-bottom:10px">Скачать заявку:</div>
      <?php endif; ?>

      <?php if (get_field('zayavka_yur_liczo1')): ?>

        <a class="header-message__top" style="margin-bottom:5px; cursor:pointer"
          href="<?php the_field('zayavka_yur_liczo1'); ?>" target=”_blank”>Юр лицо</a>

      <?php endif; ?>
      <?php if (get_field('zayavka_fiz_liczo2')): ?>

        <a class="header-message__top" style="cursor:pointer" href="<?php the_field('zayavka_fiz_liczo2'); ?>"
          target=”_blank”>Физ
          лицо</a>

      <?php endif; ?>
    </div>
      <?php 
      }
       ?>



  </div>

  <meta itemprop="description" content='<?php echo get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true); ?>'>

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

</div>




<?php if (get_field("seo_tekst_v_koncze_straniczy")) { ?>
  <div class="seo-text-finish-page">
    <div data-aos="fade-up" data-aos-duration="600" class="content">
      <?php the_field('seo_tekst_v_koncze_straniczy'); ?>
    </div>
  </div>
<?php } ?>


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