<?php get_header();
$full = buffpal('buffpal_music_full');
?>
<style>
    body{
        background-color: #fff;
    }
    #content{
        min-height:20px;
    }
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
    .noData{
        position: absolute;
        bottom: -50px;
        text-align: center;
        color: #999;
        display: none;
    }
    /*
    *滚动条样式 , 只修改到了 -moz-
    */
    progress {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        width: 130px;
        height: 5px;
        border:none;
        box-shadow: 0 0 1px #30405B inset;
        border-radius: 3px;
        color: #00A2FF;
    }
    progress::-webkit-progress-bar, progress::-moz-progress-bar, progress::progress-bar {
        background:linear-gradient(90deg, #ff4927 0, #ff0020 100%) no-repeat;
        border-radius: 3px;
        box-shadow: 0 0 1px #9bf8ff inset;
    }
    progress::-moz-progress-bar {
        background:linear-gradient(90deg, #ff4927 0, #ff0020 100%) no-repeat;
        border-radius: 3px;
        box-shadow: 0 0 1px #9bf8ff inset;
    }
    /*
    *滚动条样式结束
    */
    #table{
        width: 100%;
        padding-right:20px;
    }
    #table th{
        text-align: center;
        font: 16px/30px "Microsoft YaHei";
        color: #888;
    }
    #table th:nth-of-type(4){
        text-align: center;
    }
    #table tr>td:nth-of-type(4)>progress{
        transform-origin:center center;
        <?php if(!empty($full)): ?>
        transform:translate(0,-8px);
        <?php endif; ?>
        transform:translate(-10px,-8px);
    }
    #table progress{
        margin-left:15%;
    }
    #table tr:nth-child(odd){
        background-color: #f8f8f8;
    }
    #table tr{
        text-align: center;
        height: 35px;
        color: #30405B;
        transition:.2s ease-in-out;
    }
    #table tr:hover{
        background: #f2f6ff;
    }
    #table td>a{
        color: #999;
        font-size: 23px;
        transition:.5s ease-in-out;
    }
    #table td>a:hover{
        color: #30405B;
    }



</style>
<?php if(!empty(buffpal('buffpal_music_bg'))): ?>
    <div class="container-fluid" style="background: rgba(0, 0, 0, 0) url('<?php echo buffpal('buffpal_music_bg'); ?>'); background-size: cover;background-attachment: fixed;background-repeat: no-repeat;background-position: center center;height: <?php echo buffpal('buffpal_music_height') ?>px;"></div>
<?php endif; ?>
<div class="container" id="content">
    <div class="main">
        <div class="main">
            <!--最新音乐-->
            <div class="buffpal_title container" style="padding-top: 0px;">
                <i class="fa fa-music"><span> 音乐列表</span></i>
            </div>
            <table id="table" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <th style="width: 10%;">编号</th>
                    <th style="width: 30%;">歌名</th>
                    <th style="width: 20%;">歌手</th>
                    <th style="width: 20%;">热度</th>
                    <th style="width: 10%;">操作</th>
                </tr>
                <?php
                    $categoryId = buffpal('buffpal_music_category_id');
                    $args = array(
                        'category'=>$categoryId,
                        'numberposts' => buffpal('buffpal_music_list_max') ? buffpal('buffpal_music_list_max') : 15
                    );
                    $dataArr = get_posts($args);
                    if(count($dataArr) > 0):
                        foreach($dataArr as $k=>$post):
                            setup_postdata($post);
                            $name_author = buff::get_name_author(get_the_title()); //正则获取 歌曲名,与歌手名
                            $hot = buffpal('buffpal_music_list_max_hot') ? buffpal('buffpal_music_list_max_hot') : 10;
                            $view = get_post_meta(get_the_ID(),'_view',true) ? get_post_meta(get_the_ID(),'_view',true) : 0;
                            $num = ($view/$hot)*100;  //获取百分比热度
                                ?>
                                <tr>
                                    <td><?php echo $k+1 ?></td>
                                    <td><?php echo $name_author[0] ?></td>
                                    <td><?php echo $name_author[1] ?></td>
                                    <td>
                                        <progress max="100" value="<?php echo $num ?>"></progress>
                                    </td>
                                    <td>
                                        <a href="<?php echo esc_url(get_the_permalink()) ?>"><i class="fa fa-play-circle-o"></i></a>
                                    </td>
                                </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <h1 class="noData container">暂时木有数据</h1>
                    <?php endif; ?>

            </table>
        </div>
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



<?php get_footer(); ?>


