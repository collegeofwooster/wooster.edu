<form role="search" method="get" id="searchform" class="searchform" action="/" _lpchecked="1">
	<input type="text" value="<?php print ( isset( $_REQUEST['s'] ) ? htmlspecialchars( $_REQUEST['s'] ) : '' ); ?>" name="s" id="s" placeholder="Search">
	<input type="submit" id="searchsubmit" value="Search" class="btn-arrow">
	<div class="search-filter">
		<label><input type="checkbox" name="post_type[]" value="page"<?php print ( isset( $_REQUEST['post_type'] ) ? ( in_array( 'page', $_REQUEST['post_type'] ) ? ' checked="yes"' : '' ) : '' ) ?> /> Pages</label>
		<label><input type="checkbox" name="post_type[]" value="post"<?php print ( isset( $_REQUEST['post_type'] ) ? ( in_array( 'post', $_REQUEST['post_type'] ) ? ' checked="yes"' : '' ) : '' ) ?> /> Articles</label>
		<label><input type="checkbox" name="post_type[]" value="people"<?php print ( isset( $_REQUEST['post_type'] ) ? ( in_array( 'people', $_REQUEST['post_type'] ) ? ' checked="yes"' : '' ) : '' ) ?> /> People</label>
		<label><input type="checkbox" name="post_type[]" value="event"<?php print ( isset( $_REQUEST['post_type'] ) ? ( in_array( 'event', $_REQUEST['post_type'] ) ? ' checked="yes"' : '' ) : '' ) ?> /> Events</label>
		<label><input type="checkbox" name="post_type[]" value="area"<?php print ( isset( $_REQUEST['post_type'] ) ? ( in_array( 'area', $_REQUEST['post_type'] ) ? ' checked="yes"' : '' ) : '' ) ?> /> Areas of Study</label>
	</div>
</form>