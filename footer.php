<?php wp_footer() ?>
<script>
    var time = <?php $time = buffpal('buffPal_filmslide_time');
                    $time = empty($time) ? 10000 : $time;
        echo $time;
    ?>//幻灯片转换时间
    /**
     * 搜索框动画
     */
    var oSearch = $('#search1');
    var oSearchHide = $('#search_hide');
    oSearch.on('click',function(){
        oSearchHide.fadeIn('',function(){
            oSearchHide.find('input[type=text]').addClass('show').focus();
        });
    })
    oSearchHide.find('input[type=text]').blur(function(){
        setTimeout(function(){
            oSearchHide.fadeOut('',function(){
                $('#search').removeClass('show');
            });
        },2000);
    });
</script>
<!-- 页脚样式 -->
<style>
    .footer{
        color:#f1f1f1;
        padding:30px 0;
        border-top:1px solid #e5e5e5;
        margin-top:90px;
        background-color: #30405B;
    }
    .footer>.copyright{
        text-align: center;
    }
</style>
<footer class="footer">
    <div class="container copyright">
        COPYRIGHT (©) 2016 BuffPal. 京ICP备12069588号-4
    </div>
</footer>

<!--公用代码-->
<script>
    <?php if(is_home()){
        //图片延迟加载
        echo '$("img.lazy").lazyload({effect:"fadeIn",threshold:200});';
    }
    ?>
    //滚动条动画 为了让lazyload插件能出效果
    function lazyScroll(time){
        var scroll = $(document).scrollTop();
        $('html,body').animate({scrollTop: (scroll+1)+'px'}, time,function(){
            $('html,body').scrollTop(scroll);
        });
    }
</script>
</body>
</html>
