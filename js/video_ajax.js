/**
 * Video页面 AJAX 动态加载数据
 */
var on = true;//定义一个开关 给下面用 解决了滚动条滚动 读取太多
$(document).ready(function(){//这里有BUG ajax会一直读取不知道为啥
    //AJAX滚动条 去后台取数据
    $(document).scroll(function(){
        var DHeight = $(document).height()-$(window).height();//浏览器窗口总高
        var sTop    = $(document).scrollTop();//滚动条距离浏览器TOP的值
        var limit = $('div.main>figure').length;//获取当前页面的总共有多少条视频
        if(sTop>(DHeight*0.9)&&on&&limit >= 15){//这个是判断 滚动条到哪里的  如果limit 不等于10就不给他显示,应为配置设置的默认十条
            on = false;//这个很关键, 第一次就把开关关闭了 解决滚动条下拉发送多条AJAX
            $.ajax({
                url : ajax_object.ajax_url,
                data : {
                    'limit':limit,
                    'action' : 'buffpal_video_ajax_process',
                    'cate' : cate_id
                },
                type : 'post',
                dataType: 'json',
                beforeSend : function(){//加载
                    $('#ajax').fadeIn();
                },
                success : function(data){
                    if(data.status){
                        //添加节点
                        get_html_by_json(data.msg);
                        on = true;
                    }else{
                        //$('#blogUl').append('<h1 id="notData">没有数据啦~</h1>');
                        $('#noData').html(data.msg).fadeIn();
                        on = false;
                    }
                },
                complete : function(){//完成
                    $('#ajax').fadeOut();
                }
            })
        }
    })
});

function get_html_by_json(data){
    var html = '';
    for(var i = 0;i<data.length;i++){
        html+='<figure class="_ease">';
        html+='<div class="img">';
        html+='<img src="'+data[i].thumb+'" width="272" height="160" title="'+data[i].title+'"> ';
        html+='<div class="hide">';
        html+='<a href="'+data[i].ID+'">'+data[i].title+'</a>';
        html+='</div>';
        html+=data[i].day ? data[i].day : '';
        html+='</div>';
        html+='<div class="post-deco">';
        html+='<div class="hex hex-small">';
        html+='<div class="hex-inner">';
        html+='<a href="'+data[i].ID+'" class="sharea">';
        html+='<i class="fa fa-play-circle-o"></i>';
        html+='</a>';
        html+='</div>';
        html+='<div class="corner-1"></div>';
        html+='<div class="corner-2"></div>';
        html+='</div>';
        html+='</div>';
        html+='<figcaption>'+data[i].excerpt+'</figcaption>';
        html+='</figure>\n';
    }
    //追加节点
    $('#content .main').append(html);
}
