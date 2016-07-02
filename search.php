<?php get_header() ?>
<style>
    body{
        background-color: #F1F1F1;
    }
    #content{
        background-color: #F1F1F1;
        min-height:20px;
    }
    div.main{
        width: 840px;
        background-color: #fff;
        min-height:400px;
        margin-top: 10px;
        display: inline-block;
        border-radius: 5px;
        box-shadow: 0 0 30px #ddd;
    }
    div.main article{
        height: 150px;
        width: 95%;
        padding:20px;
        transition:.5s;
    }
    article:hover{
        background: #edfcff;
    }
    div.main div.img{
        float: left;
        position: relative;
        perspective: 800px;
    }
    div.main div.img>a{
        position: absolute;
        top: 50%;
        left:50%;
        transform-origin: center center;
        transform:translate(-50%,-50%) rotateY(270deg);
        background-color: rgba(0,0,0,.4);
        border-radius: 50%;
        width: 50px;
        height: 50px;
        opacity:0;
        text-align: center;
        line-height:60px;
        transition:.5s ease-in-out;
    }
    div.main div.img:hover a{
        opacity:1;
        transform:translate(-50%,-50%) rotateY(0deg);
    }
    div.main div.img>a>i{
        font-size:30px;
        color: #fff;
    }
    div.main div.img>img{
        border-radius: 10px;
    }
    div.main header{
        float: right;
        height: 25px;
        width: 70%;
    }
    div.main header>a{
        text-align: left;
        font-size:16px;
        color: #555;
        line-height:25px;
        transition:.3s ease-in-out;
    }
    div.main header>a:hover{
        color: #30405B;
    }
    #the_content{
        float: right;
        color: #888;
        width: 70%;
        max-height: 110px;
    }
    div.main footer{
        width: 70%;
        float: right;
    }
    ul.info li{
        display: inline-block;
        margin:5px 10px 0;
        color: #888;
    }
    ul.info li a{
        color: #888;
        transition:.5s ease-in-out;
    }
    ul.info li a:hover{
        color: #5A83C0;
    }
</style>
<?php if(!empty(buffpal('buffpal_search_bg'))): ?>
<div class="container-fluid" style="background: rgba(0, 0, 0, 0) url('<?php echo buffpal('buffpal_search_bg'); ?>'); background-size: cover;background-attachment: fixed;background-repeat: no-repeat;background-position: center center;height: <?php echo buffpal('buffpal_search_height') ?>px;"></div>
<?php endif; ?>
<div class="container" id="content">
    <div class="main">
        <?php
        if(have_posts()):
            while ( have_posts() ) : the_post();?>
                <?php
                    $news_thumbnail = buff::get_thumb(get_the_ID(),'buffpal_search_default_poster','cdefault.jpg');
                ?>
                <article class="_ease">
                    <div class="img">
                        <img src="<?php echo $news_thumbnail; ?>" title="<?php the_title() ?>" width="220" height="150">
                        <a href="<?php echo esc_url(get_the_permalink()) ?>"><i class="fa fa-link"></i></a>
                    </div>
                    <header>
                        <a href="<?php echo esc_url(get_the_permalink()) ?>"><?php the_title() ?></a>
                    </header>
                    <div id="the_content">
                        <?php echo buff::omitString(get_the_excerpt(),240,''); ?>
                    </div>
                    <footer>
                        <ul class="info">
                            <?php echo buff::get_post_info() ?>
                        </ul>
                    </footer>
                </article>
            <?php
            endwhile;
        else: ?>
            <h1 style="color: #888;text-align: center;">未搜索到有关 <span style="color: orangered;"><?php echo $s; ?></span> 相关的内容</h1>
        <?php
        endif;
        ?>
    </div>
    <div class="sidebar">
        <?php get_sidebar() ?>
    </div>
</div>
<?php get_footer(); ?>
<script>
    $(".bs-callout").pin()
</script>

