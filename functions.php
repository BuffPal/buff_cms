<?php
date_default_timezone_set('Asia/Shanghai');
define("THEME_URI", get_stylesheet_directory_uri());
define("OPTIONS_FRAMEWORK_DIRECTORY", get_template_directory_uri() . "/inc/");
require_once TEMPLATEPATH . "/inc/options-framework.php";
function p($arr){
    echo '<pre>';
    print_r($arr);
    die;
}



/*
*前台video_ajax处理    不知道为何写在 calss里面调用 ajax不行
*/
add_action('wp_ajax_buffpal_video_ajax_process','buffpal_video_ajax_process_fun');
add_action('wp_ajax_nopriv_buffpal_video_ajax_process','buffpal_video_ajax_process_fun');

function buffpal_video_ajax_process_fun()
{
    sleep(1);
    $new_day = date('Y-m-d');       //获取当前时间
    $num = 15;//一次加载多少条
    $limit = $_POST['limit'];
    $cate_id = $_POST['cate'];
    $args = array(
        'numberposts' => $num,
        'offset' => $limit,
        'category'=> $cate_id
    );
    $post_arr = get_posts($args);
    if(count($post_arr) <= 0){
        echo json_encode(array('status'=>0,'msg'=>'暂时木有数据了'));
    }else{
        //压入数组
        $arr = array();
        foreach($post_arr as $k=>$v){
            /**
             * 判断是不是今天的内容
             */
            $old = date('Y-m-d',strtotime($v->post_date));
            if($old == $new_day){
                $arr[$k]['day'] = '<div class="day">今日</div>';
            }
            $arr[$k]['ID'] = get_the_permalink($v->ID);
            $arr[$k]['time'] = strtotime($v->post_date);
            $arr[$k]['thumb'] = get_the_post_thumbnail_url($v->ID) ? get_the_post_thumbnail_url($v->ID) : buffpal('buffpal_news_default_poster');
            $arr[$k]['title'] = buff::omitString($v->post_title,15,'');
            $arr[$k]['excerpt'] = buff::omitString($v->post_excerpt,50,'');
        }
        echo json_encode(array('status'=>1,'msg'=>$arr));
    }
    wp_die();
}
/**
 * 前台video_ajax处理  结束!
 */


/*
*前台music_ajax处理   问题同上
*/
add_action('wp_ajax_buffpal_music_ajax_process','buffpal_music_ajax_process_fun');
add_action('wp_ajax_nopriv_buffpal_music_ajax_process','buffpal_music_ajax_process_fun');

function buffpal_music_ajax_process_fun()
{
    sleep(1);
    $num = 15;//一次加载多少条
    $limit = $_POST['limit'];
    $cate_id = $_POST['cate'];
    $args = array(
        'numberposts' => $num,
        'offset' => $limit,
        'category'=> $cate_id
    );
    $post_arr = get_posts($args);
    if(count($post_arr) <= 0){
        echo json_encode(array('status'=>0,'msg'=>'暂时木有数据了'));
    }else{
        //压入数组
        $arr = array();
        $hot = buffpal('buffpal_music_list_max_hot') ? buffpal('buffpal_music_list_max_hot') : 100;
        foreach($post_arr as $k=>$v){
            $view = get_post_meta($v->ID,'_view',true) ? get_post_meta($v->ID,'_view',true) : 0;
            $num = ($view/$hot)*100;  //获取百分比热度
            //获取歌名与作者
            $name_author = buff::get_name_author($v->post_title);
            $arr[$k]['ID'] = get_the_permalink($v->ID);
            $arr[$k]['name'] = $name_author[0];
            $arr[$k]['author'] = $name_author[1];
            $arr[$k]['num'] = $num;
        }
        echo json_encode(array('status'=>1,'msg'=>$arr));
    }
    wp_die();
}
/**
 * 前台video_ajax处理  结束!
 */



//引入设置文件
include_once TEMPLATEPATH.'/include/option_base.php';
new buffpal_cms_option_base();
//引入自定义函数文件(静态) 类被别名为 buffpal
include_once TEMPLATEPATH.'/include/functions.php';
//引入buffpal_list_comments 自定义comment显示函数
include_once TEMPLATEPATH.'/include/buffpal_list_comments.php';
