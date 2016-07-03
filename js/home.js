$(function () {
    /**
     * 解决 最新动态 ul.list  width不能用auto实现 同时解决当 li小于2时仍然能点击right
     */
    var iNewListCount = $('#news .list>li').length;
    $('#news .list').css('width',iNewListCount*560);
    if(iNewListCount <= 3){
        $('#news div.control i').eq(1).addClass('none');
    }
    /**
     * 轮播器动画
     */
    var aAside = $("div.wrap aside");
    var aI = $('#crs_home div.control i');
    var iNow = 0;
    var iOld = 0;
    //先给第二张图片加上还原动画
    aAside.eq(1).addClass('show');
    timer = setInterval(change, time);

    //循环z-index 为了能让前一张在后一张上面
    var c = 0;
    for (var i = (aAside.length) + 500; i > 0; i--) {
        if (c > 0) {
            aAside.eq(c).find('.title').addClass('c_title_animation');
            aAside.eq(c).find('.desc').addClass('c_desc_animation');
            aAside.eq(c).find('.mainImg').addClass('c_img_animation');
            aAside.eq(c).find('.more').addClass('c_button_animation');
        }
        aAside.eq(c).css('zIndex', i);
        c++;
    }

    //滑块控制
    aI.on('click', function () {
        clearInterval(timer);
        //获取当前点击的位置
        var iClick = aI.index(this);
        iOld = iNow;
        aI.eq(iClick).addClass('active').siblings().removeClass('active');

        //判断z-index解决切换相对之前的图片时候,因为Z-index不能正确显示
        var zIndex = aAside.eq(iNow).css('z-index');
        //执行切换
        aAside.eq(iOld).addClass('show').siblings().removeClass('show');
        aAside.eq(iClick).addClass('show');
        setTimeout(function(){
            aAside.eq(iClick).css('z-index', parseInt(zIndex) + Math.ceil(Math.random() * 20));
        },1800);



        $('#crs_home .title').eq(iClick).animate({
            'z-index': '3'
        });
        $('#crs_home .c_bg').eq(iNow).addClass('c_bg_animation');
        $('#crs_home .title').eq(iNow).addClass('c_title_animation');
        $('#crs_home .desc').eq(iNow).addClass('c_desc_animation');
        $('#crs_home .mainImg').eq(iNow).addClass('c_img_animation');
        $('#crs_home .more').eq(iNow).addClass('c_button_animation');

        //啊啊啊啊啊啊啊啊啊!这个BUG太诡异了,非要改动一下css才能执行 css的transition
        $('#crs_home .title').eq(iClick).animate({
            'z-index': '5'
        });
        $('#crs_home .title').eq(iClick).removeClass('c_title_animation');
        $('#crs_home .desc').eq(iClick).removeClass('c_desc_animation');
        $('#crs_home .mainImg').eq(iClick).removeClass('c_img_animation');
        $('#crs_home .more').eq(iClick).removeClass('c_button_animation');
        $('#crs_home .c_bg').eq(iClick).removeClass('c_bg_animation');


        aAside.eq(iNow).addClass('show').siblings().removeClass('show');
        iNow = iClick;
        aAside.eq(iNow).addClass('show');
        aAside.eq(iNow + 1).addClass('show');
        aAside.eq(iNow + 2).addClass('show');



        timer = setInterval(change, time);
    })

    //定时器动画
    function change() {
        lazyScroll(100);
        var c = 0;
        for (var i = (aAside.length) + 500; i > 0; i--) {
            aAside.eq(c).css('zIndex', i);
            c++;
        }
        //显示控制
        aAside.eq(iNow).addClass('show').siblings().removeClass('show');
        aAside.eq(iNow + 1).addClass('show');
        aAside.eq(iNow + 2).addClass('show');

        //切换背景
        $('#crs_home aside').eq(iNow).find('.c_bg').addClass('c_bg_animation');

        //给Title加动画
        $('#crs_home .title').eq(iNow).addClass('c_title_animation');
        $('#crs_home .title').eq(iNow + 1).removeClass('c_title_animation').css('transition', '.7s .6s ease-in');

        //给description 加动画 c_bg_animation
        $('#crs_home .desc').eq(iNow).addClass('c_desc_animation');
        $('#crs_home .desc').eq(iNow + 1).removeClass('c_desc_animation').css('transition', '.5s .5s ease-in');

        //按钮动画
        $('#crs_home .more').eq(iNow).addClass('c_button_animation');
        $('#crs_home .more').eq(iNow + 1).removeClass('c_button_animation');

        //主要图片加动画(right:0的图片)
        $('#crs_home .mainImg').eq(iNow).addClass('c_img_animation');
        $('#crs_home .mainImg').eq(iNow + 1).removeClass('c_img_animation').css('transition', 'all .8s .8s ease-in');

        iNow++;
        if (iNow >= aAside.length) {
            //这里采用的还是无缝轮播的技巧
            //这里将会切回第一张  这里有个BUG 当从最后一张图跳到第一张图的时候,将会花两倍的时间.
            aAside.eq(0).addClass('show').siblings().removeClass('show');
            $('#crs_home .title').eq(0).removeClass('c_title_animation');
            $('#crs_home .desc').eq(0).removeClass('c_desc_animation');
            $('#crs_home .mainImg').eq(0).removeClass('c_img_animation');
            $('#crs_home .more').eq(0).removeClass('c_button_animation');
            iNow = 0;
            aAside.eq(iNow + 1).addClass('show');
            aAside.eq(iNow + 2).addClass('show');
        }
        setTimeout(function(){
            aAside.eq(iNow-1).removeClass('show');
        },1200);

        //轮播器控制按钮
        var aControl = $('div.control>i');
        if (iNow == aAside.length - 1) {
            aControl.eq(0).addClass('active').siblings().removeClass('active');
        } else {
            aControl.eq(iNow).addClass('active').siblings().removeClass('active');
        }

        //给下面的图预加上样式,用来做un的动画,就是还原动画
        $('#crs_home .title').eq(iNow + 1).addClass('c_title_animation');
        $('#crs_home .desc').eq(iNow + 1).addClass('c_desc_animation');
        $('#crs_home .mainImg').eq(iNow + 1).addClass('c_img_animation');
        $('#crs_home .more').eq(iNow + 1).addClass('c_button_animation');
        $('#crs_home aside').eq(iNow).find('.c_bg').removeClass('c_bg_animation');
    }


    /**
     * 最新动态  滑动动画
     */
    var oNews = $('#news ul.list');
    //判断当前有多少li用来判断什么时候停止,这里强制判断双数,如果是单数,最后一个将不显示
    var iNewList = Math.floor(($('#news ul.list li').length) / 2);
    var aNewControl = $('#news div.control i');
    var newsV = 1000;//切换速度
    var iNewsNow = 0;

    aNewControl.click(function () {
        var iIndex = aNewControl.index(this);
        var iNum = parseInt(aNewControl.eq(iIndex).attr('control'));        //获取当前点击控制的 control值 left是1 right是-1

        //右键点击 如果将要超出的话给他加上none,如果没有的话,给俩都去掉none
        if (aNewControl.eq(1).hasClass('none') && parseInt(iNum) == -1) {
            return false;
        }
        if (aNewControl.eq(0).hasClass('none') && parseInt(iNum) == 1) {
            return false;
        }

        //执行动画
        oNews.stop(true, false);
        oNews.animate({
            'left': (iNewsNow + iNum) * 1120
        }, newsV);

        lazyScroll(newsV);

        //一下是分别判断 当前iNewsNow 的位置,用来设置 左右控制的None样式
        if (0 >= iNewsNow && iNewsNow >= (-iNewList + 1)) {
            aNewControl.eq(1).removeClass('none');
            aNewControl.eq(0).removeClass('none');
        }

        if (iNewsNow == -1 && parseInt(iNum) == 1) {
            aNewControl.eq(0).addClass('none');
        }

        if (iNewsNow == (-iNewList + 2) && parseInt(iNum) == -1) {
            aNewControl.eq(1).addClass('none');
        }

        iNewsNow = iNewsNow + iNum;

    });

    /**
     * 最新视频滚动条监听加载_left与_right事件
     */
    var aNewVideoList = $('#newVideo li');
    var aNewVideoList_kaiguan = true;
    var iNewVideo = 0;
    var aPositionArr = [0,1,4,5];//定义右边的数组
    /**
     * 音乐滚动条监听加载rotateM样式动画
     */
    var oMusicTitle = $('.musicTitle');
    var aMusicUl = $('#music ul');
    var iMusic_kaiguan = true;
    var iMusic = 0;
    var aLiNew = aMusicUl.eq(0).find('li');
    var aLiHot = aMusicUl.eq(1).find('li');
    var aLiOld = aMusicUl.eq(2).find('li');
    //获取当前是三个对象的最大需要循环多少次
    var arr = [aLiNew.length,aLiHot.length,aLiOld.length]
    var max = Math.max.apply(null,arr);
    $(document).scroll(function(){
        if(iMusic_kaiguan){
            if(gdjzf(oMusicTitle,300)){
                var oMusicTimer = setInterval(function(){
                    if(iMusic>max){
                        clearInterval(oMusicTimer);
                    }
                    aLiNew.eq(iMusic).addClass('rotateM');
                    aLiHot.eq(iMusic).addClass('rotateM');
                    aLiOld.eq(iMusic).addClass('rotateM');
                    iMusic++;
                },50);
                iMusic_kaiguan = false;
            }
        }

        if(aNewVideoList_kaiguan){//视频
            if(gdjzf($('#newVideo'),100)){
                setInterval(function(){
                    var index = aNewVideoList.index(aNewVideoList.eq(iNewVideo));
                    if(aPositionArr.indexOf(index) < 0){//没有在里面,应该加_right
                        aNewVideoList.eq(iNewVideo).addClass('_right');
                    }else{
                        switch(index){
                            case 0:
                                aNewVideoList.eq(1).addClass('_left');
                                break;
                            case 1:
                                aNewVideoList.eq(0).addClass('_left');
                                break;
                            case 4:
                                aNewVideoList.eq(5).addClass('_left');
                                break;
                            case 5:
                                aNewVideoList.eq(4).addClass('_left');
                                break;
                        }

                    }
                    iNewVideo++;
                    if(iNewVideo > aNewVideoList.length){
                        clearInterval(this);
                    }
                },100);
                aNewVideoList_kaiguan = false;
            }
        }
    })





});

/**
 * [滚动条滚动动画(这里是返回判断)]
 * @param  {[type]} div    [description]
 * @param  {[type]} offset [description]
 * @return {[type]}        [description]
 */
function gdjzf(div,offset){
    var a,b,c,d;
    d=$(div).offset().top;
    a=eval(d + offset);
    b=$(window).scrollTop();
    c=$(window).height();
    if(b+c>a){
        return true;
    }
}
