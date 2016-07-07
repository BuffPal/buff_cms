/**
 * Music页面 AJAX 动态加载数据
 */
var on = true;//定义一个开关 给下面用 解决了滚动条滚动 读取太多
$(document).ready(function(){//这里有BUG ajax会一直读取不知道为啥
    //AJAX滚动条 去后台取数据
    $(document).scroll(function(){
        var DHeight = $(document).height()-$(window).height();//浏览器窗口总高
        var sTop    = $(document).scrollTop();//滚动条距离浏览器TOP的值
        var limit = $('#table tr').length-1;//获取当前页面的总共有多少条音乐
        if(sTop>(DHeight*0.9)&&on&&limit >= 2){//这个是判断 滚动条到哪里的  如果limit 不等于15就不给他显示,应为配置设置的默认15条
            on = false;//这个很关键, 第一次就把开关关闭了 解决滚动条下拉发送多条AJAX
            $.ajax({
                url : ajax_object.ajax_url,
                data : {
                    'limit':limit,
                    'action' : 'buffpal_music_ajax_process',
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
                        get_html_by_json(data.msg,limit);
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

function get_html_by_json(data,limit){
    var html = '';
    for(var i = 0;i<data.length;i++){
    html+='<tr style="_ease">';
    html+='<td>'+(i+limit+1)+'</td>';
    html+='<td>'+data[i].name+'</td>';
    html+='<td>'+data[i].author+'</td>';
    html+='<td>';
    html+='<progress max="100" value="'+data[i].num+'"></progress>';
    html+='</td><td>';
    html+='<a href="'+data[i].ID+'"><i class="fa fa-play-circle-o"></i></a>';
    html+='</td></tr>';
    }
    //追加节点
    $('#table').append(html);
}
