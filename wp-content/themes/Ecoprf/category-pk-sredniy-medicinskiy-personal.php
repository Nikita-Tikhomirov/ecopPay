<!-- Подключаем стартовые переменные и первый экран -->
<?php include(TEMPLATEPATH . '/catTemplates/firstScreenTemplate.php'); ?>


<!-- Подключаем вывод постов и категорий-->
<?php include(TEMPLATEPATH . '/catTemplates/medicalCustomSort.php'); ?>



<!-- Подключаем блок с информацией -->
<?php include(TEMPLATEPATH . '/catTemplates/infoAboutThisPage.php'); ?>

<!-- Подключаем блок с СЕО текстом -->
<?php include(TEMPLATEPATH . '/catTemplates/seoText.php'); ?>

<!-- Подключаем похожие курсы -->
<?php include(TEMPLATEPATH . '/catTemplates/relativeCources.php'); ?>




<?php echo get_template_part('templates/faq-categories'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<section class="customRevsMain">
    <style>
        .customRevsMain{
            margin-top: 40px;
            margin-bottom: ;
        }
        .customRevsMain img{
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
            console.log('123');
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

    <?php echo do_shortcode('[contact-form-7 id="188" title="Форма Получить консультацию из блока Курса"]'); ?>

</div>