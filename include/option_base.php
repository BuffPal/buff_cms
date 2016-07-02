<?php
class buffpal_cms_option_base {

    public function __construct()
    {
        //取消wordpress默认的顶部导航条
        show_admin_bar(false);
        //加载样式文件
        add_action( 'wp_enqueue_scripts', array($this,'photos_scripts'));
        //给文章设置缩略图
        add_theme_support( 'post-thumbnails' );
        add_image_size('buff-entry-thumb', 220,150);

        //加载菜单
        register_sidebar(
            array(
                'id' => 'sidebar-1',
                'name' => '侧边栏',//工具名称
                'before_widget' => '<div class=“sbox”>',//以这个为包裹的开头
                'after_widget' => '</div>',//以这个为包裹的闭合
                'before_title' => '<h2>',//包裹内标题以这个为开头
                'after_title' => '</h2>'//同上以这个为结尾
            )
        );


    }



    public function photos_scripts() {
        //禁止加载默认jq库
        wp_deregister_script('jquery');
        //引入css这个默认放在顶部
        wp_enqueue_style( 'buffpal_css', THEME_URI . '/css/buffpal.css');
        wp_enqueue_style( 'font_css', THEME_URI . '/font/css/font-awesome.min.css');
        if(is_home()) wp_enqueue_style( 'home_css', THEME_URI . '/css/home.css');
        //if(is_single()) wp_enqueue_style( 'single_css', THEME_URI . '/css/comment.css');
        if(is_single()) wp_enqueue_style( 'comments_css', THEME_URI . '/css/comment.css');
        //引入JS文件 第五个参数为true放在尾部
        wp_enqueue_script( 'jquery', THEME_URI . '/js/jQuery.js', array(),'',true);
        if(is_single() || is_search() || is_category())wp_enqueue_script( 'pin_scripts', THEME_URI . '/js/jquery.pin.js', array( 'jquery' ),'',true);
        if(is_home()) wp_enqueue_script('lazyload_scripts', THEME_URI . '/js/jquery.lazyload.min.js', array( 'jquery' ),'',true);
        if(is_home()) wp_enqueue_script( 'home_scripts', THEME_URI . '/js/home.js', array( 'jquery' ),'',true);

        /**
         * 视屏页面 AJAX动态加载数据 AJAX处理地址   不知道为什么放在 自定义的 option_base里面不行, 而且用 is_category也不行
         */
        if(is_category('video')) wp_enqueue_script('buffpal_video_ajax',THEME_URI . '/js/video_ajax.js', array( 'jquery' ),'',true);
        if(is_category('video')) wp_localize_script('buffpal_video_ajax','ajax_object',array('ajax_url'=>admin_url('admin-ajax.php')));

        /**
         * 音乐页面 AJAX动态加载数据 处理地址   问题同上
         */
        if(is_category('music')) wp_enqueue_script('buffpal_music_ajax',THEME_URI . '/js/music_ajax.js', array( 'jquery' ),'',true);
        if(is_category('music')) wp_localize_script('buffpal_music_ajax','ajax_object',array('ajax_url'=>admin_url('admin-ajax.php')));

    }

}