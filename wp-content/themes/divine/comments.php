<?php
if (post_password_required())
    return;
?>

<div id="comments">
    <?php
    if (have_comments()) :
        global $post;
        ?>         
        <?php if($count = divine_get_comments_by_post_id($post->ID)): ?>
            <h4 class="comments-title widget-title style3"><?php echo esc_attr($count); ?></h4>        
        <?php endif;?>

        <ol class="comments-list clearfix">
            <?php
            wp_list_comments(array(
                'walker' => null,
                'style' => 'ul',
                'short_ping' => true,
                'callback' => 'kopa_list_comments',
                'type' => 'all'
            ));
            ?>
        </ol>
        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>           
            <div class="pagination kopa-comment-pagination">  
                <?php
                paginate_comments_links(array(
                    'prev_text' => __('<span>&laquo;</span> Previous', divine_get_domain()),
                    'next_text' => __('Next <span>&raquo;</span>', divine_get_domain())
                ));
                ?>
            </div>
        <?php endif; ?>
        <?php if (!comments_open() && get_comments_number()) : ?>
            <blockquote><?php _e('Comments are closed.', divine_get_domain()); ?></blockquote>
        <?php endif; ?>    
        <?php
    endif;
    kopa_comment_form();
    ?>
</div>
<?php

function kopa_comment_form($args = array(), $post_id = null) {
    if (null === $post_id)
        $post_id = get_the_ID();
    $commenter = wp_get_current_commenter();
    $user = wp_get_current_user();
    $user_identity = $user->exists() ? $user->display_name : '';
    $args = wp_parse_args($args);
    if (!isset($args['format']))
        $args['format'] = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';
    $req = get_option('require_name_email');
    $aria_req = ( $req ? ' aria-required="true"' : '' );
    $html5 = 'html5' === $args['format'];
    $fields = array();

    $fields['author'] = '<div class="row">';
    $fields['author'].= '<div class="col-md-4 col-sm-4 col-xs-4">';
    $fields['author'].= '<p class="input-block">';
    $fields['author'].= sprintf('<input type="text" value="%s" id="comment_name" name="author" size="30" placeholder="%s" %s>', esc_attr($commenter['comment_author']), '', $aria_req);
    $fields['author'].= '</p>';
    $fields['author'].= '</div>';
    $fields['author'].= '<div class="col-md-8 col-sm-8 col-xs-8">';
    $fields['author'].= '<div class="input-label">';
    $fields['author'].= sprintf('<p>%s <span>(*)</span></p>', __('Name', divine_get_domain()));
    $fields['author'].= sprintf('<p>%s</p>', __('Your full name please.', divine_get_domain()));
    $fields['author'].= '</div>';
    $fields['author'].= '</div>';
    $fields['author'].= '</div>';

    $fields['email'] = '<div class="row">';
    $fields['email'].= '<div class="col-md-4 col-sm-4 col-xs-4">';
    $fields['email'].= '<p class="input-block">';
    $fields['email'].= sprintf('<input type="%s" value="%s" id="comment_email" name="email" size="30" placeholder="%s" %s>', ( $html5 ? 'email' : 'text'), esc_attr($commenter['comment_author_email']), __('Your email', divine_get_domain()), $aria_req);
    $fields['email'].= '</p>';
    $fields['email'].= '</div>';
    $fields['email'].= '<div class="col-md-8 col-sm-8 col-xs-8">';
    $fields['email'].= '<div class="input-label">';
    $fields['email'].= sprintf('<p>%s <span>(*)</span></p>', __('Email address', divine_get_domain()));
    $fields['email'].= sprintf('<p>%s</p>', __('Used for gravatar.', divine_get_domain()));
    $fields['email'].= '</div>';
    $fields['email'].= '</div>';
    $fields['email'].= '</div>';

    $fields['url'] = '<div class="row">';
    $fields['url'].= '<div class="col-md-4 col-sm-4 col-xs-4">';
    $fields['url'].= '<p class="input-block">';
    $fields['url'].= sprintf('<input type="%s" value="%s" id="comment_url" name="url" size="30" placeholder="%s" %s>', ( $html5 ? 'url' : 'text'), esc_attr($commenter['comment_author_url']), '', $aria_req);
    $fields['url'].= '</p>';
    $fields['url'].= '</div>';
    $fields['url'].= '<div class="col-md-8 col-sm-8 col-xs-8">';
    $fields['url'].= '<div class="input-label">';
    $fields['url'].= sprintf('<p>%s</p>', __('Website', divine_get_domain()));
    $fields['url'].= sprintf('<p>%s</p>', __('Link back if you want.', divine_get_domain()));
    $fields['url'].= '</div>';
    $fields['url'].= '</div>';
    $fields['url'].= '</div>';

    $comment_field = '<div class="row">';
    $comment_field.= '<div class="col-md-12 col-sm-12 col-xs-12">';
    $comment_field.= sprintf('<p class="textarea-label">%s <span>(*)</span></p>', __('Your comments', divine_get_domain()));
    $comment_field.= '<p class="textarea-block">';
    $comment_field.= sprintf('<textarea name="comment" id="comment_message" rows="10" placeholder="%s" %s></textarea>', '', $aria_req);
    $comment_field.= '</p>';
    $comment_field.= '</div>';
    $comment_field.= '</div>';

    $fields = apply_filters('comment_form_default_fields', $fields);

    $defaults = array(
        'fields' => $fields,
        'comment_field' => $comment_field,
        'must_log_in' => '<p class="must-log-in">' . sprintf(__('You must be <a href="%s">logged in</a> to post a comment.', divine_get_domain()), wp_login_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</p>',
        'logged_in_as' => '<p class="logged-in-as">' . sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', divine_get_domain()), get_edit_user_link(), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</p>',
        'comment_notes_before' => '',
        'comment_notes_after' => '',
        'id_form' => 'comments-form',
        'id_submit' => 'submit-contact',
        'title_reply' => __('Leave a Reply', divine_get_domain()),
        'title_reply_to' => __('Leave a Reply to %s', divine_get_domain()),
        'cancel_reply_link' => __('(Cancel)', divine_get_domain()),
        'label_submit' => __('Post Comment', divine_get_domain()),
        'format' => 'xhtml',
    );
    $args = wp_parse_args($args, apply_filters('comment_form_defaults', $defaults));
    ?>
    <?php if (comments_open($post_id)) : ?>
        <?php
        do_action('comment_form_before');
        ?>
        <div id="respond">            
            <h4 class="contact-title widget-title style3">
                <?php comment_form_title($args['title_reply'], $args['title_reply_to']); ?>
                <?php cancel_comment_reply_link($args['cancel_reply_link']); ?>
            </h4>                        

            <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
                <?php echo $args['must_log_in']; ?>
                <?php
                do_action('comment_form_must_log_in_after');
                ?>
            <?php else : ?>            
                <form action="<?php echo site_url('/wp-comments-post.php'); ?>" method="post" id="<?php echo esc_attr($args['id_form']); ?>" class="contact-form comment-form clearfix" <?php echo $html5 ? ' novalidate' : ''; ?>>                    
                    <?php
                    do_action('comment_form_top');
                    ?>
                    <?php if (is_user_logged_in()) : ?>
                        <?php
                        echo apply_filters('comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity);
                        ?>
                        <?php
                        do_action('comment_form_logged_in_after', $commenter, $user_identity);
                        ?>
                    <?php else : ?>                        
                        <?php
                        do_action('comment_form_before_fields');
                        foreach ((array) $args['fields'] as $name => $field) {
                            echo apply_filters("comment_form_field_{$name}", $field) . "\n";
                        }
                        do_action('comment_form_after_fields');
                        ?>
                    <?php endif; ?>
                    <?php
                    echo apply_filters('comment_form_field_comment', $args['comment_field']);
                    ?>
                    <?php echo $args['comment_notes_after']; ?>


                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <p class="contact-button clearfix">   
                                <span><input type="submit" name="submit"  value="<?php echo esc_attr($args['label_submit']); ?>" id="<?php echo esc_attr($args['id_submit']); ?>"></span>                                                                                        
                                <?php comment_id_fields($post_id); ?>                                                                     
                            </p>
                        </div>
                    </div>

                    <?php
                    do_action('comment_form', $post_id);
                    ?>
                </form>
            <?php endif; ?>
        </div><!-- #respond -->
        <?php
        do_action('comment_form_after');
    else :
        do_action('comment_form_comments_closed');
    endif;
}

function kopa_list_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class('clearfix'); ?> id="comment-<?php comment_ID(); ?>">
        <article class="comment-wrap clearfix">
            <div class="comment-avatar">
                <?php echo get_avatar($comment->comment_author_email, 80); ?>
            </div>

            <div class="media-body clearfix">
                <header class="clearfix">
                    <div class="pull-left">
                        <h6><?php comment_author_link(); ?></h6>
                    </div>
                    <div class="comment-button pull-right">
                        <span class="comment-date"><?php comment_time(get_option('date_format') . ' - ' . get_option('time_format')); ?></span>

                        <?php comment_reply_link(array_merge($args, array('reply_text' => '<span class="fa fa-mail-reply"></span>', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>                                                                                                                                                                        

                        <?php edit_comment_link('<span class="fa fa-pencil"></span>','', ''); ?>
                    </div>
                </header>
                <?php comment_text(true); ?>      
            </div>
        </article>                                                                      
    
    <?php
}
