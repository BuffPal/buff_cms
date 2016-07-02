<?php if(!comments_open()):?>
    <h1>评论功能暂时关闭</h1>
<?php elseif(!have_comments()): ?>
    <li id="notReply"><a href="#commentform">还没没有评论赶快来说两句吧</a></li>
<?php else: ?>
    <ul id="clist">
        <?php
            wp_list_comments( array(
                'callback' => 'buffpal_list_comments',
                'avatar_size' => 56,
            ) );
        ?>
    </ul>
<?php endif; ?>

<?php if( get_option('comment_registration') && !is_user_logged_in() ){ ?>
    <p>您必须 <a href="<?php echo wp_login_url( get_permalink() ) ?> ">登录</a> 才能发表评论</p>
<?php }else ?>
<?php if ( comments_open() ){ 
    comment_form(array(
        'title_reply'    => '回复',
        'title_reply_before'=>'<div id="newTitle">',
        'title_reply_after' => '</div><p>　</p>',
        'comment_field'        => '<p class="comment-form-comment"><label for="comment">评论:</label> <textarea class="form-control" rows="3" id="comment" name="comment"  maxlength="255" aria-required="true" required="required"></textarea></p>',
        'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s btn btn-primary" value="%4$s" />'

    )); }?>
