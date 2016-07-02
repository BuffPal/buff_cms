<?php //if (is_dynamic_sidebar()): ?>
<?php //dynamic_sidebar() ?>
<?php //else: ?>
<!--当前位置-->
<?php if (!is_home()): ?>
    <style>
        /*
        *sidebar样式
        */
        div.sidebar{
            float: right;
            width: 290px;
            display: inline-block;
            margin-top: 10px;
            border-radius: 5px;
        }
        div.sidebar .bs-callout{
            width: 230px;
            padding: 10px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px #ddd;
        }
        .location{
            color: #aaa;
        }
        .location>a{
            color: #8195D4;
        }
        .location>span{
            color: #999;
        }
        .s_title{
            text-align: left;
            padding-left:5px;
            border-left: 3px solid #00A2FF;
            color: #888;
        }
        .new_post{
            margin-top: 10px;
        }
        ol{
            margin-left:25px;
            color: #666;
        }
        ol>li>a{
            color: #30405B;
            transition:.3s ease-in-out;
        }
        ol>li>a:hover{
            color: #00A2FF;
        }
        #comment>p>a{
            color: #00A2FF;
        }
        #comment>p{
            margin-top:20px;
        }
        #respond>p>a{
            color: #00A2FF;
        }
    </style>
    <div class="bs-callout bs-callout-warning">
        <div class="container-fluid p0 location">
            <i class="fa  fa-map-marker"></i>
            <a href='<?php bloginfo('url'); ?>'>首页</a> &#92;
            <?php if (is_category()): ?>
                <?php single_cat_title() ?>
            <?php elseif (is_search()): ?>
                <?php echo '<span style="color: #888">当前关键字:</span><font style="color: orangered;"> '.$s.'</font>' ?>
            <?php elseif (is_single()): ?>
                <?php
                $cat = get_the_category();
                $cat = $cat[0];
                echo '<a href="' . get_category_link($cat) . '">' . $cat->name . '</a> &#92; ';
                echo '<span>'.buff::omitString(get_the_title(), 10,'..').'</span>';
                ?>
            <?php elseif (is_page()): ?>
                <?php the_title() ?>
            <?php elseif (is_404()): ?>
                <?php echo '404' ?>
            <?php endif; ?>
        </div>
        <div class="new_post">
            <span class="s_title">最新文章</span>
            <ol>
                <?php
                $new_post_args = array(
                    'numberposts'     => 5,
                    'category' => buff::get_category()
                );
                $news_posts = get_posts($new_post_args);
                foreach($news_posts as $post):
                    setup_postdata($post);
                ?>
                <li><a href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo buff::omitString(get_the_title(),15,'') ?></a></a></li>
                <?php endforeach; ?>
            </ol>
        </div>
        <div class="hot_comment">
            <span class="s_title">最火文章</span>
            <ol>
                <?php $aComment = buff::get_posts_by_comemnt();
                    foreach($aComment as $v):
                        ?>
                            <li><a href="<?php echo get_the_permalink($v['ID']) ?>"><?php echo buff::omitString(get_the_title($v['ID']),15,'') ?></a></li>
                        <?php
                    endforeach;
                ?>
            </ol>
        </div>
    </div>

<?php endif; ?>


<?php //endif; ?>
