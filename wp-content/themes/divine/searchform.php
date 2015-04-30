<form method="get" class="search-form clearfix" action="<?php echo trailingslashit(home_url('/')); ?>">        
    <input type="text" maxlength="20" class="search-text" name="s" placeholder="<?php _e('Search...', divine_get_domain()); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php _e('Search...', divine_get_domain()); ?>'">    
    <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
</form>