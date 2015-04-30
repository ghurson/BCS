<?php
add_shortcode('list', 'dvt_shortcode_list');
add_shortcode('item', '__return_false');

function dvt_shortcode_list($atts, $content = null) {
    extract(shortcode_atts(array('class'), $atts));

    $items = dvt_get_shortcode($content, true, array('item'));

    ob_start();
    if (isset($items) && count($items) > 0):
        ?>
        <ul class="kopa-mission-list">
            <?php foreach ($items as $item): ?>
                <li>
                    <span class="<?php echo $item['atts']['class']; ?>"></span>
                    <span><?php echo strip_tags($item['content']); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
    endif;
    $html = ob_get_contents();
    ob_end_clean();

    return apply_filters('dvt_shortcode_list', $html, $atts, $content);
}