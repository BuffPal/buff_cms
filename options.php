<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */
function optionsframework_option_name()
{
    $optionsframework_settings = get_option('optionsframework');
    $optionsframework_settings['id'] = 'options_theme_customizer';
    update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'theme-textdomain'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options()
{

    $options = array();


    $options[] = array(
        'name' => '基本配置',
        'type' => 'heading'
    );

    $options[] = array(
        'name' =>'网站名',
        'desc' => '请输入您的网站名称',
        'id' => 'buffpal_web_name',
        'type' => 'text'
    );

    $options[] = array(
        'name' =>'网站描述',
        'desc' => '请输入200位之内的网站描述,用于seo优化',
        'id' => 'buffpal_web_description',
        'type' => 'textarea'
    );

    $options[] = array(
        'name' => '网站小图标',
        'desc' => '上传一个16*16或者32*32的网站小图标,用于显示网站小图标',
        'id' => 'buffpal_web_icon',
        'type' => 'upload'
    );

    $options[] = array(
        'name' => '网站Logo图片',
        'desc' => '上传一个一个210*60的网站Logo图片',
        'id' => 'buffpal_web_logo',
        'type' => 'upload'
    );

    $options[] = array(
        'name' => '默认分类选择',
        'type' => 'heading'
    );

    $options_categories = array();
    $options_categories_obj = get_categories();
    foreach ($options_categories_obj as $category) {
        $options_categories[$category->cat_ID] = $category->cat_name;
    }

    if ($options_categories) {
        $options[] = array(
            'name' => '幻灯片',
            'desc' => '选着幻灯片分类,请按着说明文档,来发布您的文章,以此来正确的显示幻灯片',
            'id' => 'buffpal_filmslide_category_id',
            'type' => 'select',
            'options' => $options_categories//键名是 分类id 键值是 分类名
        );
    }

    //过滤上面选着的分类
    $news_checkbox_arr = $options_categories;
    unset($news_checkbox_arr[buffpal('buffpal_filmslide_category_id')]);
    foreach ($news_checkbox_arr as $k => $v) {
        $count = buff::get_category_count($k);
        $news_checkbox_arr[$k] = $news_checkbox_arr[$k] . '　　(' . $count . ')';
    }


    $options[] = array(
        'name' => '最新动态分类选择',
        'desc' => '最新动态分类选择,将通过指定分类显示前台动态(这里将会屏蔽,上面设置的幻灯片分类)',
        'id' => 'buffpal_news_categorys',
        'type' => 'multicheck',
        'options' => $news_checkbox_arr
    );

    if ($options_categories) {
        $options[] = array(
            'name' => '最新电影',
            'desc' => '请选着最新电影,将要显示的分类',
            'id' => 'buffpal_newvideo_category_id',
            'type' => 'select',
            'options' => $options_categories//键名是 分类id 键值是 分类名
        );
    }

    if ($options_categories) {
        $options[] = array(
            'name' => '最新音乐分类',
            'desc' => '请选着最新音乐,将要显示的分类',
            'id' => 'buffpal_music_category_id',
            'type' => 'select',
            'options' => $options_categories//键名是 分类id 键值是 分类名
        );
    }

    $options[] = array(
        'name' => '主页显示配置',
        'type' => 'heading'
    );

    $options[] = array(
        'name' => '幻灯片切换时间',
        'desc' => '将定义前台幻灯片切换时间(ms)',
        'id' => 'buffpal_filmslide_time',
        'placeholder' => '默认为10000ms,请以ms为单位计算',
        'type' => 'text'
    );

    //如果没有封面图,设置默认封面图buffpal_search_default_poster
    $options[] = array(
        'name' => '最新动态背景图',
        'desc' => '如果上属分类,不存在封面图将会使用默认封面图 标准尺寸为 宽260px 高190px',
        'id' => 'buffpal_news_default_poster',
		'type' => 'upload'
	);

    //如果没有封面图,设置默认封面图
    $options[] = array(
        'desc' => '如果最新电影,不存在封面图将会使用默认封面图 标准尺寸为 宽255px 高150px',
        'id' => 'buffpal_newvideo_default_poster',
        'type' => 'upload'
    );
    //最新视频区域背景图设置
    $options[] = array(
        'name' => '最新视频,背景图设置',
        'desc' => '请上传最新视频区域的背景图',
        'id' => 'buffpal_newvideo_bg',
        'type' => 'upload'
    );

    //最新音乐区域,背景图设置
    $options[] = array(
        'name' => '最新音乐,背景图设置',
        'desc' => '请上传最新音乐区域的背景图',
        'id' => 'buffpal_newMusic_bg',
        'type' => 'upload'
    );

    $options[] = array(
        'name' => '搜索页配置',
        'type' => 'heading'
    );

    //如果没有封面图,设置默认封面图
    $options[] = array(
        'name' => '搜索页默认封面图',
        'desc' => '如果不存在封面图将会使用默认封面图 标准尺寸为 宽220px 高150px',
        'id' => 'buffpal_search_default_poster',
        'type' => 'upload'
    );

    //最新视频区域背景图设置
    $options[] = array(
        'name' => '搜索页背景',
        'desc' => '请上传搜索页背景图',
        'id' => 'buffpal_search_bg',
        'type' => 'upload'
    );

    $options[] = array(
        'name' => '背景图高度',
        'desc' => '单位为px',
        'id' => 'buffpal_search_height',
        'std' => '200',
        'class' => 'mini',
        'type' => 'text'
    );

    $options[] = array(
        'name' => '视屏页面设置',
        'type' => 'heading'
    );

    $options[] = array(
        'name' => '是否全屏显示',
        'desc' => '默认将输出 侧边栏,如果勾选则全屏显示视屏列表',
        'id' => 'buffpal_video_full',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => '默认显示条数',
        'desc' => '这个选项将控制,默认显示条数,其他条数将会使用ajax加载(建议15以上)',
        'id' => 'buffpal_video_list_max',
        'std' => '15',
        'class' => 'mini',
        'type' => 'text'
    );

    $options[] = array(
        'name' => '默认封面图',
        'desc' => '如果,视屏没有封面图,将会采用默认封面图',
        'id' => 'buffpal_video_bg_default',
        'type' => 'upload'
    );

    //视频区域背景图设置
    $options[] = array(
        'name' => '视屏页背景',
        'desc' => '请上传视屏页背景图',
        'id' => 'buffpal_video_bg',
        'type' => 'upload'
    );

    $options[] = array(
        'name' => '背景图高度',
        'desc' => '单位为px',
        'id' => 'buffpal_video_height',
        'std' => '200',
        'class' => 'mini',
        'type' => 'text'
    );


    $options[] = array(
        'name' => '音乐页面设置',
        'type' => 'heading'
    );


    $options[] = array(
        'name' => '是否全屏显示',
        'desc' => '默认将输出 侧边栏,如果勾选则全屏显示音乐列表',
        'id' => 'buffpal_music_full',
        'std' => '0',
        'type' => 'checkbox'
    );

    $options[] = array(
        'name' => '默认显示条数',
        'desc' => '这个选项将控制,默认显示条数,其他条数将会使用ajax加载(建议15以上)',
        'id' => 'buffpal_music_list_max',
        'std' => '15',
        'class' => 'mini',
        'type' => 'text'
    );

    $options[] = array(
        'name' => '设置最大的热度值',
        'desc' => '这个选项将控制,歌曲热度值(页面加载次数/最大热度值)默认将采用100',
        'id' => 'buffpal_music_list_max_hot',
        'std' => '100',
        'class' => 'mini',
        'type' => 'text'
    );


    //音乐区域背景图设置
    $options[] = array(
        'name' => '音乐页背景',
        'desc' => '请上传音乐页背景图',
        'id' => 'buffpal_music_bg',
        'type' => 'upload'
    );

    $options[] = array(
        'name' => '背景图高度',
        'desc' => '单位为px',
        'id' => 'buffpal_music_height',
        'std' => '200',
        'class' => 'mini',
        'type' => 'text'
    );

    return $options;
}