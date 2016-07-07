<?php get_header();
    $full = buffpal('buffpal_video_full');
?>
<style>
    body{
        background-color: #fff;
    }
    #content{
        min-height:20px;
    }
    /*
    *六边形开始
    */
    .post-deco{
        float: left;
        background: #7EB66F none repeat scroll 0 0;
        height: 5px;
        margin-bottom: 10px;
        position: relative;
        width: 272px;
        top:-5px;
    }
    .hex {
        background: #7EB66F none repeat scroll 0 0;
        left: 50%;
        margin-left: -19px;
        position: absolute;
        right: 50%;
        top: -8px;
    }
    .hex {
        background: #7EB66F none repeat scroll 0 0;
        background-position: 50% 50%;
        background-repeat: no-repeat;
        color: #fff;
        float: left;
        height: 86px;
        position: relative;
        text-align: center;
        width: 150px;
        z-index: 2;
    }
    .hex .hex-inner {
        position: relative;
        z-index: 4;
    }
    .hex .hex-inner>a>i{
        font-size: 30px;
        text-align: center;
        line-height:23px;
    }
    .hex a.sharea:hover >i{
        animation:10s color linear infinite;
    }
    .hex .corner-1, .hex .corner-2 {
        backface-visibility: hidden;
        background: inherit;
        height: 100%;
        left: 0;
        overflow: hidden;
        position: absolute;
        top: 0;
        width: 100%;
        z-index: 1;
    }
    .hex .corner-1 {
        transform: rotate(60deg);
        z-index: -1;
    }
    .hex .corner-2 {
        transform: rotate(-60deg);
    }
    .hex .corner-1::before, .hex .corner-2::before {
        backface-visibility: hidden;
        background-attachment: inherit;
        background-clip: inherit;
        background-color: inherit;
        background-image: inherit;
        background-origin: inherit;
        background-position: inherit;
        background-repeat: no-repeat;
        background-size: inherit;
        content: "";
        height: 173px;
        left: 0;
        position: absolute;
        top: 0;
        width: 173px;
        z-index: 3;
    }
    .hex .corner-1::before {
        transform: rotate(-60deg) translate(-144px, 0px);
        transform-origin: 0 0 0;
    }
    .hex .corner-2::before {
        bottom: 0;
        transform: rotate(60deg) translate(-72px, -3px);
    }
    .hex.hex-small {
        font-size: 14px;
        height: 22px;
        line-height: 21px;
        width: 38px;
    }
    .hex.hex-small .corner-1::before, .hex.hex-small .corner-2::before {
        height: 43px;
        width: 43px;
    }
    /*
    *end六边形
    */

    div.main{
    <?php if(empty($full)): ?>
        width: 880px;
    <?php else: ?>
        width: 100%;
    <?php endif; ?>
        min-height:400px;
        margin-top: 10px;
        display: inline-block;
        border-radius: 5px;
        padding-left:5px;
    }
    div.main figure{
        position: relative;
        display: inline-block;
        width: 272px;
        box-shadow: 0 0 5px #ddd;
        <?php if(empty('buffpal_video_list_bg')): ?>
        margin:5px 8px;
        <?php else: ?>
        margin:5px 9px;
        <?php endif; ?>
        transition:.5s ease-in-out;
        overflow: hidden;
    }
    div.main figure>div.img{
        overflow: hidden;
    }
    div.main figure>div.img>img{
        background-position: center center;
        transform:scale(1,1);
        transition:.5s ease-in-out;
    }
    div.main figure:hover{
        box-shadow: 0 0 15px #999;
    }
    div.main figure div.hide{
        position: absolute;
        top: 0;
        left: 0;
        width: 272px;
        height: 160px;
        background-color: rgba(0,0,0,0);
        transition:.4s ease-in-out;
    }
    div.main figure>div.img:hover .hide{
        background-color: rgba(0,0,0,0.3);
    }
    div.main figure>div.img:hover img{
        transform:scale(1.5,1.5);
    }
    div.main figure div.hide>a{
        display: block;
        position: relative;
        top: 0;
        width: 100%;
        margin-top:5px;
        text-align: center;
        transform-origin:top;
        transform:translate(0,-25px);
        transition:.4s .5s ease-in-out;
        opacity:.8;
    }
    div.main figure div.hide>a:hover{
        opacity:1;
    }
    div.main figure>div.img:hover .hide>a{
        transform:translate(0,0);
    }
    div.main figcaption{
        background-color: #fff;
        padding:20px 5px 1px 5px;
        color: #777;
        height: 78px;
    }
    /*
    *加载动画
    */
    .spinner {
        margin: 100px auto;
        width: 50px;
        height: 60px;
        text-align: center;
        font-size: 10px;
    }

    .spinner > div {
        background-color: #67CF22;
        height: 100%;
        width: 6px;
        display: inline-block;

        -webkit-animation: stretchdelay 1.2s infinite ease-in-out;
        animation: stretchdelay 1.2s infinite ease-in-out;
    }

    .spinner .rect2 {
        -webkit-animation-delay: -1.1s;
        animation-delay: -1.1s;
    }

    .spinner .rect3 {
        -webkit-animation-delay: -1.0s;
        animation-delay: -1.0s;
    }

    .spinner .rect4 {
        -webkit-animation-delay: -0.9s;
        animation-delay: -0.9s;
    }

    .spinner .rect5 {
        -webkit-animation-delay: -0.8s;
        animation-delay: -0.8s;
    }

    @-webkit-keyframes stretchdelay {
        0%, 40%, 100% { -webkit-transform: scaleY(0.4) }
        20% { -webkit-transform: scaleY(1.0) }
    }

    @keyframes stretchdelay {
        0%, 40%, 100% {
            transform: scaleY(0.4);
            -webkit-transform: scaleY(0.4);
        }  20% {
               transform: scaleY(1.0);
               -webkit-transform: scaleY(1.0);
           }
    }
    div.main{
        position: relative;
    }
    #ajax{
        display: none;
        left:50%;
        position: absolute;
        bottom:30px;
        height: 50px;
        transform-origin: center center;
        transform:translate(-50%,-50%);
    }
    #noData{
        position: absolute;
        bottom: -50px;
        text-align: center;
        color: #999;
        display: none;
    }
    div.day{
        position: absolute;
        top: 0;
        left: 20px;
        background-color: #ff6700;
        color: #fff;
        text-shadow: 0 0 1px #873800;
        border-radius:0 0 5px 5px;
        padding:2px 5px;
    }
</style>
<?php if(!empty(buffpal('buffpal_video_bg'))): ?>
    <div class="container-fluid" style="background: rgba(0, 0, 0, 0) url('<?php echo buffpal('buffpal_video_bg'); ?>'); background-size: cover;background-attachment: fixed;background-repeat: no-repeat;background-position: center center;height: <?php echo buffpal('buffpal_video_height') ?>px;"></div>
<?php endif; ?>
<div class="container" id="content">
    <div class="main">
        <?php
        $categoryId = buffpal('buffpal_newvideo_category_id');
        $args = array(
            'category'=>$categoryId,
            'numberposts' => buffpal('buffpal_video_list_max')
        );
        $dataArr = get_posts($args);
        if($dataArr):
        $new_day = date('Y-m-d');       //获取当前时间
        foreach($dataArr as $post):
            setup_postdata($post);
            $news_thumbnail = buff::get_thumb(get_the_ID(),'buffpal_video_bg_default','vcdefault.jpg');
            /**
             * 判断是否是今天
             */
            $old = date('Y-m-d',get_the_time('U'));
            if($old == $new_day){
                $day = '1';
            }else{
                $day = '0';
            }
        ?>
            <figure class="_ease">
                <div class="img">
                    <img src="<?php echo $news_thumbnail ?>" width="272" height="160" title="<?php echo get_the_title()?>">
                    <div class="hide">
                        <a href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo buff::omitString(get_the_title(),15,''); ?></a>
                    </div>
                    <?php if($day == 1): ?>
                    <div class="day">今日</div>
                    <?php endif; ?>
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
                    <?php echo buff::omitString(get_the_excerpt(),50,''); ?>
                </figcaption>
            </figure>
        <?php
        endforeach;
        else: ?>
        <h1 style="color: #888;text-align: center;">该分类还未有任何的视屏,请按照说明文档,上传您的视屏</h1>
        <?php
        endif;
        ?>
        <div id="ajax">
            <div class="spinner">
                <div class="rect1"></div>
                <div class="rect2"></div>
                <div class="rect3"></div>
                <div class="rect4"></div>
                <div class="rect5"></div>
            </div>
        </div>
        <h1 id="noData" class="container"></h1>
    </div>
    <?php
        //判断是否勾选了全屏显示
        if(empty($full)):
    ?>
    <div class="sidebar">
        <?php get_sidebar() ?>
    </div>
    <?php endif; ?>
</div>
<script>
    var cate_id = <?php echo $categoryId ?>;
</script>
<?php get_footer(); ?>
<?php if(empty($full)): ?>
    <script>
        $(".bs-callout").pin()
<?php endif; ?>
    </script>


