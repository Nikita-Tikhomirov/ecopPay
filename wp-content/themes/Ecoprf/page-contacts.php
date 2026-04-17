<?php
/**
 * Template Name: Contacts
 */?>



<?php get_header('content'); ?>






<div class="contact-and-address">

    <div data-aos="fade-right" data-aos-duration="600" class="our-form">

        <p class="leave-request-title">
            Отправить сообщение
        </p>

        <?php echo do_shortcode( '[contact-form-7 id="15" title="Форма из блока контакты"]' ); ?>
    </div>

    <div data-aos="fade-up" data-aos-duration="800" class="our-contacts" itemscope itemtype="https://schema.org/Organization">

        <span class="our-contacts-name" itemprop="name">Единый центр обучения и переподготовки</span>

        <p class="our-contacts-title">
            Наши контакты
        </p>

        <ul class="our-contacts-sub-area" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
            <li class="our-contacts-sub-area-title">
                Наш офис:
            </li>
            <li itemprop="addressLocality">
                г. Санкт-Петербург,
            </li>
            <li itemprop="streetAddress">
                ул. Новорощинская, д. 4А,
                офис 505-1
            </li>
        </ul>

        <ul class="our-contacts-sub-area">
            <li class="our-contacts-sub-area-title">
                E-mail:
            </li>
            <li>
                <a href="mailto:info@ecoprf.ru" itemprop="email">
                    info@ecoprf.ru
                </a>
            </li>
            <li>

            </li>
        </ul>

        <ul class="our-contacts-sub-area">
            <li class="our-contacts-sub-area-title">
                Телефон:
            </li>
            <li>
                <a href="tel:88005500320" itemprop="telephone">
                    8 (800) 550-03-20
                </a>
            </li>
            <li>
                <a href="tel:+79219605008" itemprop="telephone">
                    8 (921) 960-50-08
                </a>
            </li>
        </ul>

        <ul class="our-contacts-sub-area">
            <li class="our-contacts-sub-area-title">
                Время работы:
            </li>
            <li>
                <li itemprop="openingHours">
                    ПН-ЧТ: 9:00 – 18:00
                </li>
			   <li itemprop="openingHours">
					   ПТ: 9:00 – 17:00
                </li>
            </li>
            <li>
                <li itemprop="openingHours">
                    СБ-ВС: выходной
				</li>
            </li>
        </ul>




    </div>


</div>

<div id="map"></div>


<?php

?>





<?php get_footer(); ?>
