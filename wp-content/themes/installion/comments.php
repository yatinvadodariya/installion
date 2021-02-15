<?php
if (post_password_required()) {
    return;
}
?>
<div id="comments" class="comments-area comment_info blog-post-comment">
    <h2 class="default-black-title-1 mb-4"><?php _e('Comments', 'cartwright') ?></h2>
    <?php if (have_comments()) : ?>
        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style' => 'ol',
                'short_ping' => true,
                'avatar_size' => 56,
            ));
            ?>
        </ol>
    <?php endif; ?>

    <?php
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
        ?>
        <p class="no-comments"><?php _e('Comments are closed.', 'cartwright'); ?></p>
    <?php endif; ?>

    <?php comment_form(); ?>

</div>
