<?php
return array(
    'resolver_configs' => array(
        'paths' => array(
            __DIR__ . '/../',
        ),
        'collections' => array(

            'assets/css/myApplication.css' => array(
                'assets/css/slick.less',
                'assets/css/slick-theme.less',
                'assets/css/footer.less',
                'assets/css/style.less',
            ),

            'assets/js/myApplication.js' => array(
                'assets/js/slick.js',
                'assets/js/init.js',
            ),

        ),
    ),
    'filters' => array(
        'assets/css/myMovieAdviser.css' => array(
            ['filter' => 'LessphpFilter'],
            ['filter' => 'CssMinFilter'],
        ),
    ),
);
