<?php

return array(
	'title'=>'PowerUp.by - Зарядись',
    'adminEmail' => 'olegperl@mail.ru',
    'deliveryMethods' => array(
        'minsk' => array(
            'id' => 'minsk',
            'title' => 'Бесплатная доставка по Минску',
            'info' => 'Бесплатная доставка на следующий день в пределах МКАД',
            'price' => 0,
            'allowed_payment_methods'=> array('cash'),
            'fields' => array(
                'name' => array('type'=>'text', 'label'=>'ФИО'),
                'phone' => array('type'=>'text', 'label'=>'Телефон'),
                'address' => array('type'=>'text', 'label'=>'Адрес'),
                'email' => array('type'=>'text', 'label'=>'Email')
            )
        ),
        'pickup' => array(
            'id' => 'pickup',
            'title' => 'Самовывоз',
            'info' => 'Наш адрес Пушкина 21. Вы можете подеъехать и забрать свой заказ',
            'price' => 0,
            'allowed_payment_methods'=> array('cash'),
            'fields' => array (
                'name' => array('type'=>'text', 'label'=>'ФИО'),
                'phone' => array('type'=>'text', 'label'=>'Телефон'),
                'email' => array('type'=>'text', 'label'=>'Email')
            )
        ),
        'post' => array(
            'id' => 'post',
            'title' => 'Почтой по Беларуси',
            'info' => 'Обычно доставка занимает 2-3 дня',
            'price' => 0,
            'allowed_payment_methods'=> array('post'),
            'fields' => array (
                'firstName' => array('type'=>'text', 'label'=>'Имя'),
                'lastName' => array('type'=>'text', 'label'=>'Фамилия'),
                'phone' => array('type'=>'text', 'label'=>'Телефон'),
                'email' => array('type'=>'text', 'label'=>'Email'),
                'city' => array('type'=>'text', 'label'=>'Город'),
                'postcode' => array('type'=>'text', 'label'=>'Почтовый индекс'),
                'area' => array('type'=>'text', 'label'=>'Область')
            )
        ),
        'express_post' => array(
            'id' => 'express_post',
            'title' => 'Экспресс-почтой по Беларуси',
            'info' => 'Стоимость доставки 80тыс.руб. Обычно занимает 1 день',
            'price' => 5,
            'allowed_payment_methods'=> array('post'),
            'fields' => array (
                'firstName' => array('type'=>'text', 'label'=>'Имя'),
                'lastName' => array('type'=>'text', 'label'=>'Фамилия'),
                'phone' => array('type'=>'text', 'label'=>'Телефон'),
                'email' => array('type'=>'text', 'label'=>'Email'),
                'city' => array('type'=>'text', 'label'=>'Город'),
                'postcode' => array('type'=>'text', 'label'=>'Почтовый индекс'),
                'area' => array('type'=>'text', 'label'=>'Область')
            )
        )
    ),

    'paymentMethods' => array(
        'cash' => array(
            'id' => 'cash',
            'title' => 'Наличными',
            'info' => 'Оплачиваете в белорусских рублях при доставке',
        ),
        'post' => array(
            'id' => 'post',
            'title' => 'Наложенным платежом',
            'info' => 'Оплачиваете заказ на почте при получении заказа',
        ),
    )

);
