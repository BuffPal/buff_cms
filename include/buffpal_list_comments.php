<?php
if(!function_exists('buffpal_list_comments')):
    function buffpal_list_comments($comment, $args, $depth){
        ?>
        <ul id="commentList">
            <li id="li-comment-<?php comment_ID() ?>">

                <div id="comment-<?php echo (get_comment_ID()); ?>">
                    <div>
                        <?php /* 通过评论作者的id判断是否为文章作者，如果是则增加authComment class*/ ?>
                        <div class="comment-author vcard <?php if(1 == $comment->user_id ) {echo 'authComment';} ?>">

                            <?php echo get_avatar( $comment->comment_author_email, $args['avatar_size'] ); ?>
                            <?php printf(__('<cite class="fn text-center">%s</cite>'), get_comment_author_link())?>

                        </div>
                        <?php if ($comment->comment_approved == '0') : ?>
                            <em><?php _e('多谢留言，您的评论正在等待审核，请稍等^_^') ?></em>
                        <?php endif; ?>
                        <?php /*评论meta信息和编辑评论链接*/ ?>
                    </div>

                    <div id="commentContent">
                        <div class="comment-meta commentmetadata">
                            <span class="time"><i class="fa fa-clock-o"></i>
                                <?php $time = buff::format_date(get_comment_time('U'));
                                echo $time?$time:date('Y-m-d H:i:s');
                                ?>
                            </span>
                            <?php edit_comment_link(__('(Edit)'),'  ','') ?>
                        </div>
                        <?php /*评论内容*/ ?>
                        <?php comment_text() ?>
                        <?php /*回复链接*/ ?>
                        <div class="reply">
                            <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                        </div>
                    </div>

                </div>
            </li>
        </ul>
        <hr style="margin-bottom: 5px;">

        <?php
    }
endif;
?>