<?php get_header(); ?>
<!--轮播器-->
<div class="container-fluid" id="crs_home">
    <div class="wrap">
        <?php
            $iFilmslide = buffpal('buffpal_filmslide_category_id');
            $iFilmslideCount = buff::get_category_count($iFilmslide);   //通过ID获取分类的统计量.用于循环幻灯片下面的小按钮
            $aFilmslideLast = array();
            foreach(get_posts(array('category'=>$iFilmslide,'numberposts'=>8)) as $k=>$v):
                $data =buff::get_filmslide_arr($v->post_content);
                if($k == 0){
                    $aFilmslideLast['arr'] = $v;
                    $aFilmslideLast['data'] = buff::get_filmslide_arr($v->post_content);
                }
        ?>
        <aside class="show">
            <div class="c_bg" style="background: rgba(0, 0, 0, 0) url('<?php echo esc_url($data['background']) ?>'); background-size: cover;background-attachment: fixed;background-repeat: no-repeat;background-position: center center;"></div>
            <div class="info vision">
                <div class="container info_wrap">
                    <div class="mainImg"><img src="<?php echo esc_url($data['showPic']) ?>" width="518" height="550"></div>
                    <div class="aside_info">
                        <hgroup>
                            <div class="title c_title" style="color: <?php echo $data['tcolor'] ?>;"><?php echo $v->post_title; ?></div>
                            <div class="desc" style="color: <?php echo $data['dcolor'] ?>;"><?php echo $v->post_excerpt; ?></div>
                        </hgroup>
                        <div class="more">
                            <a href="<?php echo esc_url($data['location'])  ?>" class="button" target="_blank">LEARN MORE</a>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <?php endforeach; ?>
        <aside class="show">
            <div class="c_bg" style="background: rgba(0, 0, 0, 0) url('<?php echo esc_url($aFilmslideLast['data']['background']) ?>'); background-size: cover;background-attachment: fixed;background-repeat: no-repeat;background-position: center center;"></div>
            <div class="info vision">
                <div class="container info_wrap">
                    <div class="mainImg"><img src="<?php echo esc_url($aFilmslideLast['data']['showPic']) ?>" width="518" height="550"></div>
                    <div class="aside_info">
                        <hgroup>
                            <div class="title c_title" style="color: <?php echo $aFilmslideLast['data']['tcolor'] ?>;"><?php echo $aFilmslideLast['arr']->post_title; ?></div>
                            <div class="desc" style="color: <?php echo $aFilmslideLast['data']['dcolor'] ?>;"><?php echo $aFilmslideLast['arr']->post_excerpt; ?></div>
                        </hgroup>
                        <div class="more">
                            <a href="<?php echo esc_url($aFilmslideLast['data']['location'])  ?>" class="button" target="_blank">LEARN MORE</a>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

    </div>
    <div class="control">
        <i class="active"></i>
        <?php
            for($i = 1;$i<$iFilmslideCount;$i++){
                ?>
                <i></i>
                <?php
            }
        ?>
    </div>
</div>
<!--最新动态-->
<div id="news" class="container">
    <div class="top">
        <div class="title_box">
            <i class="fa fa-globe"><span> 最新动态</span></i>
        </div>
        <div class="control">
            <i class="fa  fa-chevron-left none" control="1"></i>
            <i class="fa  fa-chevron-right" control="-1"></i>
        </div>
    </div>

    <div class="wrap">
        <ul class="list container">
            <?php
                $news_args = array(
                    'numberposts'     => 10,
                    'category' => buff::get_category()
                );
                $news_posts = get_posts($news_args);
                $news_thumbnail = '';
                foreach($news_posts as $post):
                    setup_postdata($post);
                    //获取封面图URL
                    if(has_post_thumbnail()):
                        //输出缩略图(用上面的缩略图控制,控制大小)
                        $news_thumbnail = get_the_post_thumbnail_url(get_the_ID());
                    elseif(empty($news_thumbnail = buffpal('buffpal_news_default_poster'))):
                        $news_thumbnail = get_template_directory_uri().'/img/default.jpg';
                endif;
            ?>
                <li>
                    <figure>
                        <div class="img">
                            <img src="<?php echo get_template_directory_uri().'/img/loading.gif' ?>" title="<?php echo get_the_title() ?>" width="260" height="190" data-original="<?php echo $news_thumbnail ?>" class="lazy">
                            <div class="hide">
                                <div class="sixWrap">
                                    <div class="delta1"></div>
                                    <div class="oblong"><a href="<?php echo esc_url(get_the_permalink()) ?>"><i class="fa fa-link"></i></a></div>
                                    <div class="delta2"></div>
                                </div>
                            </div>
                        </div>
                        <figcaption>
                            <div class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title() ?>"><?php echo buff::omitString(get_the_title(),10,'..'); ?></a></div>
                            <p><?php echo buff::omitString(get_the_excerpt(),90,'...'); ?></p>
                        </figcaption>
                    </figure>
                    <a href="<?php the_permalink(); ?>" class="li_hide">more</a>
                    <time datetime="<?php echo date('Y-m-d H:i:s',get_the_time()) ?>"><?php echo buff::format_date(get_the_time('U')) ?></time>
                </li>
            <?php endforeach; ?>
    </ul>
    </div>
</div>
<!--最新视频-->
<div class="buffpal_title container">
    <i class="fa fa-youtube-play"><span> 最新电影</span></i>
</div>
<div class="container-fluid" style="background: rgba(0, 0, 0, 0) url('<?php echo buffpal('buffpal_newvideo_bg') ? buffpal('buffpal_newvideo_bg') : get_template_directory_uri().'/img/video.jpg' ?>'); background-size: cover;background-attachment: fixed;background-repeat: no-repeat;background-position: center center;overflow: hidden;">
    <ul class="container" id="newVideo">
        <?php
        $iNewVideo = buffpal('buffpal_newvideo_category_id');
        $new_video = array(
            'numberposts'     => 8,
            'category' => $iNewVideo
        );
        $new_video_arr = get_posts($new_video);
        $new_video_thumbnail = '';
        foreach($new_video_arr as $post):
        setup_postdata($post);
        //获取封面图URL
        $new_video_thumbnail = buff::get_thumb(get_the_ID(),'buffpal_newvideo_default_poster','vdefault.jpg');
        ?>
        <li>
            <figure>
                <div class="img">
                    <div class="hide"></div>
                    <div class="hide1">
                        <div class="title"><a href="<?php the_permalink() ?>"><?php echo buff::omitString(get_the_title(),14,'') ?></a></div>
                        <time datetime="<?php echo date('Y-m-d H:i:s',get_the_time('U')) ?>"><?php echo buff::format_date(get_the_time('U')); ?></time>
                    </div>
                    <img src="<?php echo esc_url($new_video_thumbnail); ?>" title="<?php the_title() ?>" width="255" height="150">
                </div>
                <div class="post-deco">
                    <div class="hex hex-small">
                        <div class="hex-inner">
                            <a href="<?php the_permalink() ?>" class="sharea">
                                <i class="fa fa-play-circle-o"></i>
                            </a>
                        </div>
                        <div class="corner-1"></div>
                        <div class="corner-2"></div>
                    </div>
                </div>
                <figcaption>
                    <?php echo buff::omitString(get_the_excerpt(),40,'') ?>
                </figcaption>
            </figure>
        </li>
        <?php endforeach; ?>

    </ul>
</div>
<!--最新音乐-->
<div class="buffpal_title container">
    <i class="fa fa-music"><span> 音乐</span></i>
</div>
<div class="musicTitle container">
        <blockquote>
            <span>最新推荐</span>
        </blockquote>
        <blockquote>
            <span>最热推荐</span>
        </blockquote>
        <blockquote>
            <span>历史排行</span>
        </blockquote>
</div>
<div id="music" class="container" style="background: rgba(0, 0, 0, 0) url('<?php echo buffpal('buffpal_newmusic_bg') ? buffpal('buffpal_newmusic_bg') : get_template_directory_uri().'/img/music.jpg' ?>'); background-size: cover;background-attachment: fixed;background-repeat: no-repeat;background-position: center center;">
    <ul class="new">
        <?php
            $music_categoryId = buffpal('buffpal_music_category_id');
            $args_new = array(
                'numberposts'=>11,
                'category'=>$music_categoryId
            );
            $music_arr_new = get_posts($args_new);
            if($music_arr_new):
                foreach($music_arr_new as $v):
                    $name_author_new = buff::get_name_author($v->post_title);
        ?>
                    <li><span><?php echo $name_author_new[0].' - '.$name_author_new[1] ?></span><a href="<?php echo esc_url(get_the_permalink($v->ID)) ?>"><i class="fa fa-play-circle-o"></i></a></li>
                <?php endforeach; ?>
            <?php endif; ?>
    </ul>
    <ul class="hot">
        <?php
            $data_hot = buff::get_music_by_view();
            if(count($data_hot)>0):
                foreach($data_hot as $v):
                    $name_author_hot = buff::get_name_author($v['post_title']);
        ?>
                    <li><span><?php echo $name_author_hot[0].' - '.$name_author_hot[1] ?></span><a href="<?php echo esc_url(get_the_permalink($v['ID'])) ?>"><i class="fa fa-play-circle-o"></i></a></li>
                <?php endforeach; ?>
            <?php endif; ?>
    </ul>
    <ul class="old">
        <?php
        $music_categoryId = buffpal('buffpal_music_category_id');
        $args_old = array(
            'numberposts'=>11,
            'category'=>$music_categoryId,
            'order'=>'ASC'
        );
        $music_arr_old = get_posts($args_old);
        if($music_arr_old):
            foreach($music_arr_old as $v):
                $name_author_old = buff::get_name_author($v->post_title);
                ?>
                <li><span><?php echo $name_author_old[0].' - '.$name_author_old[1] ?></span><a href="<?php echo esc_url(get_the_permalink($v->ID)) ?>"><i class="fa fa-play-circle-o"></i></a></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>
<?php get_footer(); ?>
