<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WpOpal Team <opalwordpress@gmail.com>
 * @copyright  Copyright (C) 2015 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/questions/
 */
?>
<form role="search" method="get" class="searchform" action="<?php echo (function_exists('opalestate_get_search_link')? opalestate_get_search_link(): esc_url( home_url( '/' ) ) ); ?>">
	<div class="pbr-search input-group">
		<input name="search_text" maxlength="40" class="form-control input-large input-search" type="text" size="20" placeholder="<?php esc_html_e('Enter Your Keyword', 'fullhouse'); ?>">
		<span class="input-group-addon input-large btn-search">
			<input type="submit" class="fa" value="&#xf002;" />

			<?php if( !function_exists('opalestate_get_search_link') ): ?> 
			<input type="hidden" name="post_type" value="opalestate_property" />
			<?php endif; ?>
		</span>
	</div>
</form>


