<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'В: атрибут повинні бути прийняті.',
    'active_url'           => 'В: атрибут не є припустимою URL-Адресою.',
    'after'                => 'В: атрибут має бути дату після: Дата.',
    'alpha'                => 'В: атрибут може містити літери.',
    'alpha_dash'           => 'В: атрибут може містити лише літери, цифри та тире.',
    'alpha_num'            => 'В: атрибут може містити лише літери й цифри.',
    'array'                => 'В: атрибут має бути масиву.',
    'before'               => 'В: атрибут має бути дата перед: Дата.',
    'between'              => [
        'numeric' => 'В: атрибут має бути в межах: хв і: Макс.',
        'file'    => 'В: атрибут має бути в межах: хв і: Макс кілобайт.',
        'string'  => 'В: атрибут має бути в межах: хв і: Макс символів.',
        'array'   => 'В: атрибут має становити між: хв і: Макс елементів.',
    ],
    'boolean'              => 'В: поля атрибута має бути true або false.',
    'confirmed'            => 'В: атрибут не співпадають.',
    'date'                 => 'В: атрибут не є припустимою датою.',
    'date_format'          => 'В: не збігається формат: формат.',
    'different'            => 'В: атрибут і: інша повинна бути різними.',
    'digits'               => 'В: атрибут має бути: цифри цифр.',
    'digits_between'       => 'В: атрибут має бути в межах: хв і: Макс цифр.',
    'dimensions'           => 'В: атрибут має розміри неприпустимий зображення.',
    'distinct'             => 'В: поля атрибута має повторювані значення.',
    'email'                => 'В: атрибут має бути на дійсну адресу електронної пошти.',
    'exists'               => 'Вибрані: Неприпустимий атрибут.',
    'file'                 => 'В: атрибут має бути файл.',
    'filled'               => ':attribute поля атрибута не потрібно.',
    'image'                => 'В: атрибут має бути зображення.',
    'in'                   => 'Вибрані: Неприпустимий атрибут.',
    'in_array'             => 'В: поля атрибута не існує в: інші.',
    'integer'              => 'В: атрибут має бути цілим числом.',
    'ip'                   => 'В: атрибут має бути припустиму IP-адресу.',
    'json'                 => 'В: атрибуту повинні бути дійсними рядок JSON.',
    'max'                  => [
        'numeric' => 'В: атрибута не може бути більшим за: Макс.',
        'file'    => 'В: атрибута не може бути більшим за: Макс кілобайт.',
        'string'  => 'В: атрибута не може бути більшим за: Макс символів.',
        'array'   => 'В: атрибута не може мати більше: Макс елементів.',
    ],
    'mimes'                => 'В: атрибут має бути файл типу:: значення.',
    'min'                  => [
        'numeric' => 'В: атрибут має становити щонайменше: хв.',
        'file'    => 'В: атрибут має становити щонайменше: хв кілобайт.',
        'string'  => 'В: атрибут має становити щонайменше: хв символів.',
        'array'   => 'В: атрибут має становити принаймні: хв елементів.',
    ],
    'not_in'               => 'Вибрані: Неприпустимий атрибут.',
    'numeric'              => 'В: атрибут має бути числом.',
    'present'              => 'В: поля атрибута має бути присутнім.',
    'regex'                => 'В: Неприпустимий атрибут формат.',
    'required'             => 'В: поля атрибута не потрібно.',
    'required_if'          => 'В: поля атрибута не потрібно, коли: інша: значення.',
    'required_unless'      => 'В: поля атрибута не потрібно, якщо не: другий є: значення.',
    'required_with'        => 'В: поля атрибута не потрібно, коли: значення присутня.',
    'required_with_all'    => 'В: поля атрибута не потрібно, коли: значення присутня.',
    'required_without'     => 'В: поля атрибута не потрібно, коли: значень не є справжньою.',
    'required_without_all' => 'В: поля атрибута, коли жодна з: значень.',
    'same'                 => 'В: атрибут і: інші мають збігатися.',
    'size'                 => [
        'numeric' => 'В: атрибут має бути: розмір.',
        'file'    => 'В: атрибут має бути: розмір кілобайт.',
        'string'  => 'В: атрибут має бути: Розмір символів.',
        'array'   => 'В: атрибута має містити: розмір елементів.',
    ],
    'string'               => 'В: атрибут має бути string.',
    'timezone'             => 'В: атрибуту повинні бути дійсними зони.',
    'unique'               => 'В: атрибут вже були прийняті.',
    'url'                  => 'В: Неприпустимий атрибут формат.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'Настроювані повідомлення',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
