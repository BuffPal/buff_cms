<?php
/**
 *自定义函数文件
 */
class buffpal_cms_customize_function{

    /**
     * 获取缩略图  为了那么一点优化
     * @param $id
     * @param $option
     * @param $path
     * @return mixed
     */
    public static function get_thumb($id,$option,$path)
    {
        if(has_post_thumbnail()):
            //输出缩略图(用上面的缩略图控制,控制大小)
            $news_thumbnail = get_the_post_thumbnail_url($id);
        elseif(empty($news_thumbnail = buffpal($option))):
            $news_thumbnail = get_template_directory_uri().'/img/'.$path;
        endif;
        return $news_thumbnail;
    }

    /**
     * 用来分割 音乐名与音乐作者
     * @param $str
     * @return array
     */
    public static function get_name_author($str)
    {
        $arr = explode('@',$str);
        $arr[0] = self::trimStrong($arr[0]);
        $arr[1] = self::trimStrong($arr[1]);
        return $arr;
    }

    /**
     * 加强版本的trim 能过滤全角空格
     * @param  [string] $string [需要过滤字符串]
     * @return [string]         [过滤完成字符串]
     */
    public static function trimStrong($string){
        //$string = mb_ereg_replace('^(([ \r\n\t])*(　)*)*', '', $string);  只去掉头部
        //$string = mb_ereg_replace('(([ \r\n\t])*(　)*)*$', '', $string);   只去掉尾部
        //下面俩是全部去除
        $string = mb_ereg_replace('(([ \r\n\t])*(　)*)*', '', $string);
        $string = mb_ereg_replace('(([ \r\n\t])*(　)*)*', '', $string);
        return $string;
    }


    /**
     * 根据文章的评论统计获取文章
     * @param $num 数
     */
    public static function get_posts_by_comemnt($num = 5)
    {
            global $wpdb;
            $prefix = $wpdb->prefix;
            $slq = 'SELECT `post_title`,`ID` FROM `'.$wpdb->prefix.'posts` WHERE `comment_status`="open" AND `post_status`="publish" AND `post_type`="post" ORDER BY `comment_count` DESC LIMIT '.$num;
            $arr = $wpdb->get_results($slq,'ARRAY_A');
            return $arr;
    }

    /**
     * 获取分类的文章ID并转换为 , 字符串,这里将过滤轮播图分类
     */
    public static function get_category()
    {
        //获取最新文章
        $options_categories = array();
        $options_categories_obj = get_categories();
        foreach ($options_categories_obj as $category) {
            $options_categories[$category->cat_ID] = $category->cat_name;
        }
        unset($options_categories[buffpal('buffpal_filmslide_category_id')]);
        /**
         * 这里就不能直接用 implode转换了,  因为存在布尔值,用implode  booleans依然会输出出来 , 先把里面booleans删除
         */
        $arr = buffpal('buffpal_news_categorys');
        foreach($arr as $k=>$v){
            if($v == false ){
                unset($options_categories[$k]);
            }
        }
        $category_id = implode(',',array_keys($options_categories));
        return $category_id;
    }

    /**
     * 正则分割post_content的内容,用于显幻灯片
     * @param $post_content     指定分类下的文章,格式请产考说明文档
     * @return array            返回可供输出数据
     */
    public static function get_filmslide_arr($post_content)
    {
        $result = array();
        $regPic = '/src=\"((?!\").*?)\"\s/is';
        //匹配 第一张背景图片[0] 与 第二张显示图片[1]
        preg_match_all($regPic,$post_content,$arr);

        //匹配 跳转地址 {$url@http://www.baidu.com}
        $regUrl = '/\{\$url@((?!\").*?)\}/is';
        preg_match_all($regUrl,$post_content,$arr1);

        //获取title的颜色
        $regUrl = '/\{\$tcolor@((?!\").*?)\}/is';
        preg_match_all($regUrl,$post_content,$arr2);

        //获取desc的颜色
        $regUrl = '/\{\$dcolor@((?!\").*?)\}/is';
        preg_match_all($regUrl,$post_content,$arr3);

        //压入
        $result['background'] = $arr[1][0] ? $arr[1][0] : TEMPLATEPATH.'/img/1.png';
        $result['showPic'] = $arr[1][1] ? $arr[1][1] : TEMPLATEPATH.'/img/html5.png';
        $result['location'] = $arr1[1][0] ? $arr1[1][0] : 'http://localhost/';
        $result['tcolor'] = @$arr2[1][0] ? @$arr2[1][0] : '#30405B';
        $result['dcolor'] = @$arr3[1][0] ? @$arr3[1][0] : '#fff';
        return $result;
    }

    /**
     * 统计一个分类下的所有文章的总数  这里建这个方法只是为了加快查询速度
     * @param $id
     * @return int
     */
    public static function get_category_count($id)
    {
        global $wpdb;
        $SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->term_taxonomy.term_id=$id";
        return $wpdb->get_var($SQL);
    }

    /**
     *  裁剪字符串长度
     * @param  [type] $string [description]
     * @param  [type] $length [description]
     * @return [type]         [description]
     */
    public static function omitString($string,$length,$str = '……'){
        if($string){
            if(mb_strlen($string,'utf-8') > $length){
                $string = mb_substr($string, 0,$length,'utf-8').$str;
            }
        }
        return $string;
    }

    /**
     * [将时间戳,转换为 多久前发布 的格式]
     * @param  [string] $time [时间戳]
     * @return [string]       [string]
     */
    public static function format_date($time){
        $t=time()-$time;
        $f=array(
            '31536000'=>'年',
            '2592000'=>'个月',
            '604800'=>'星期',
            '86400'=>'天',
            '3600'=>'小时',
            '60'=>'分钟',
            '1'=>'秒'
        );
        foreach ($f as $k=>$v)    {
            if (0 !=$c=floor($t/(int)$k)) {
                return $c.$v.'前';
            }
        }
    }

    public static function get_post_info(){
        //获得评论总数
        $comment_count = get_comment_count(get_the_ID())['all'];
        $comment_string = '<li><i class="fa fa-comments"></i> :<span> '.$comment_count.'</span> 评论</li>';

        //获得浏览次数
        if(!$view_count = get_post_meta(get_the_ID(),'_view',true)){
            $view_count = 0;
        }
        $view_string = '<li><i class="fa fa-eye"></i> :<span> '.$view_count.'</span> 浏览</li>';

        //获取时隔多久发布的
        $time = self::format_date(get_the_time('U'));
        $time_string = '<li><i class="fa  fa-clock-o"></i> :<time datetime="'.get_the_time('Y-m-d H:i:s').'"> '.$time.'</time></li>';

        //获取作者
        $author = get_the_author_link();
        $author_string = '<li><i class="fa fa-pencil-square-o"></i> : '.$author.'</li>';

        return $comment_string.$view_string.$time_string.$author_string;
    }


    /**
     * SQL查询,获取数据库内 点击量最高的音乐
     */
    public static function get_music_by_view()
    {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $music_category = buffpal('buffpal_music_category_id');
        $sql = 'SELECT 
                            p.`post_title`,
                            p.`ID`,m.`meta_value` 
                FROM 
                            `'.$prefix.'posts` as p 
                LEFT JOIN 
                            `'.$prefix.'term_relationships` as t 
                        ON 
                            t.`object_id` = p.`ID` 
                LEFT JOIN 
                            `'.$prefix.'postmeta` as m 
                        ON 
                            p.`ID` = m.`post_id` 
                WHERE 
                            t.`term_taxonomy_id` = '.$music_category.' 
                AND 
                            p.`post_status` = "publish"
                AND
                            p.`post_type` = "post"
                AND
                            m.`meta_key` = "_view"  
                ORDER BY 
                            (m.`meta_value`+0) DESC 
                LIMIT 
                            11';
        $category = $wpdb->get_results($sql,'ARRAY_A');
        return $category;
    }



}
class_alias('buffpal_cms_customize_function','buff');
