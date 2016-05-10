<section class="videos" id="videos" style="display:none;">
  <div class="container">
    <div class="row">
      <a href="https://www.youtube.com/channel/UCa8ia60opNBDobNCcnQi7SQ" class="text-center" style="margin-bottom:0;"><p>Check Out Our Youtube Channel</p></a>
    </div>
  </div>
  <div class="container">
  <?php 
//Get youtube feed
$uri = 'https://www.youtube.com/feeds/videos.xml?channel_id=UCa8ia60opNBDobNCcnQi7SQ';
$feed = fetch_feed( $uri );
 
if ( is_wp_error( $feed ) ) {
    return false;
} else {
    $maxitems = $feed->get_item_quantity( 99 );
    $rss_items = $feed->get_items( 0, $maxitems );
 
    if ( $maxitems == 0 ) :
        return false;
    else :
        if ( is_array( $rss_items ) ) : 
        function pwd_get_yt_ID( $uri ) {
 
        // how long YT ID's are
        $id_len = 11;
     
        // where to start looking
        $id_begin = strpos( $uri, '?v=' );
        // if the id isn't at the beginning of the uri for some reason
        if( $id_begin === FALSE )
            $id_begin = strpos( $uri, "&v=" );
        // all else fails
        if( $id_begin === FALSE )
            wp_die( 'YouTube video ID not found. Please double-check your URL.' );
        // now go to the proper start
        $id_begin +=3;
     
        // get the ID
        $yt_ID = substr( $uri, $id_begin, $id_len);
     
        return $yt_ID;
      } 

    $i = 0;

    foreach ( array_reverse($rss_items) as $item ) :
        $id = pwd_get_yt_ID( $item->get_permalink() );
    ?>
    <?php if($i % 2 == 0) : ?>
      <div class="row">
    <?php endif; ?>
  <?php $video = $id; 
  include(plugin_dir_path(dirname(__FILE__)) .'/partials/video-partial.php'); ?>
      <?php if($i % 2 == 2) : ?>
      </div>
    <?php endif; ?>
<?php $i++; endforeach; ?>
<?php endif;
    endif;
} ?>
  </div>
</section>