<?php get_header() ?>
<?php
global $post;
the_post();
/*执行自增点击量*/
$view = get_post_meta(get_the_ID(),'_view',true);
$view = $view?$view:0;
update_post_meta(get_the_ID(),'_view',$view+1);
?>
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
        padding:10px;
        display: inline-block;
        border-radius: 5px;
        box-shadow: 0 0 30px #ddd;
    }
    div.main h1{
        height: 32px;
        font-size: 28px;
        color: #666;
        text-align: center;
        font-family: "Microsoft YaHei";
    }
    div.main aside{
        margin-top: 20px;
        padding-bottom:50px;
    }
    #post_info>li{
        width: 15%;
        float: left;
        text-align: center;
        color: #888;
    }
    #post_info>li:nth-of-type(1){
        margin-left:20%;
    }
    #post_info>li>a{
        color: #666;
        transition:.5s;
    }
    #post_info>li>a:hover{
        color: #30405B;
    }
    #singleTag{
        margin-top:20px;
    }
    #singleTag .tagspan>a{
        padding:3px 10px;
        background-color: #ddd;
        color: #888;
        border-radius: 5px;
        transition:.5s ease-in-out;
    }
    #singleTag .tagspan>a:hover{
        color: #fff;
        background-color: #30405B;
    }
    div.main img{
        max-width:840px;
        height:auto;
        float: left;
    }
</style>
<?php if(!empty($thumb = esc_url(get_the_post_thumbnail_url(get_the_ID())))): ?>
        <div class="container-fluid" style="background: rgba(0, 0, 0, 0) url('<?php echo $thumb ?>'); background-size: cover;background-attachment: fixed;background-repeat: no-repeat;background-position: center center;height: 200px;">
<?php endif; ?>
        </div>
        <div class="container" id="content">
            <div class="main">
                <article>
                    <header >
                        <h1><?php the_title() ?></h1>
                        <aside>
                            <ul id="post_info" class="container-fluid">
                                <?php echo buff::get_post_info(); ?>
                            </ul>
                        </aside>
                    </header>
                    <div id="the_content"  class="_ease"><?php the_content() ?></div>
                    <footer>
                        <!--TAG标签-->
                        <div class="container-fluid p0" id="singleTag">
                            <i class="fa fa-tags" style="color: #666;"></i>　
                            <span class="tagspan"><?php the_category('</span><span class="tagspan">') ?></span>
                        </div>
                        <div class="updown">
                            <div style="float:left"><?php previous_post_link('<i class="fa fa-arrow-left"></i> %link'); ?></div>
                            <div style="float:right"><?php next_post_link('%link <i class="fa fa-arrow-right"></i>');?></div>
                        </div>
                    </footer>
                    <div id="comment">
                        <?php comments_template() ?>
                    </div>
                </article>
            </div>
            <div class="sidebar">
                <?php get_sidebar() ?>
            </div>
        </div>
<?php get_footer(); ?>
<script>
    $(".bs-callout").pin()
</script>

