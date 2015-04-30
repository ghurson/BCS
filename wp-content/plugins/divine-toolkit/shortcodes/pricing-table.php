<?php
add_shortcode('pricing_table', 'dvt_shortcode_pricing_table');
add_shortcode('pt_caption', '__return_false');
add_shortcode('pt_price', '__return_false');
add_shortcode('pt_featured', '__return_false');
add_shortcode('pt_button', '__return_false');

function dvt_shortcode_pricing_table($atts, $content = null) {
    extract(shortcode_atts(array('class'), $atts));

    $caption   = dvt_get_shortcode($content, false, array('pt_caption'));
    $price     = dvt_get_shortcode($content, false, array('pt_price'));
    $featureds = dvt_get_shortcode($content, true, array('pt_featured'));
    $button    = dvt_get_shortcode($content, true, array('pt_button'));

    ob_start();
    ?>
    <div class="column <?php echo $atts['class'];?>">
        <ul>
            <?php if (isset($caption[0])): ?>
                <li class="title-row"><span></span><?php echo $caption[0]['content']; ?></li>
            <?php endif; ?>

            <?php if (isset($price[0])): ?>
                <li class="pricing-row">
                    <span class="triggle"></span>
                    <span class="h1"><?php echo $price[0]['atts']['prefix']; ?></span>
                    <span class="pt-price"><?php echo $price[0]['content']; ?></span>
                </li>
            <?php endif; ?>

            <?php if (isset($featureds) && count($featureds) > 0): ?>
                <?php foreach ($featureds as $featured): ?>
                    <li class="normal-row"><?php echo $featured['content'] ?></li>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php 
            if (isset($button[0])): 
                
                $target = $button[0]['atts']['target'];
                if(empty($target)){
                    $target = '_self';
                }

                ?>
                <li class="footer-row">
                    <a class="pt-btn" target="<?php echo $target; ?>" href="<?php echo esc_url($button[0]['atts']['url']); ?>"><?php echo esc_attr($button[0]['content']); ?></a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
    <?php
    $html = ob_get_contents();
    ob_end_clean();

    return apply_filters('dvt_shortcode_pricing_table', $html, $atts, $content);
}