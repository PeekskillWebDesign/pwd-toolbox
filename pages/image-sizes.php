<section class='image-sizes' id="image-sizes" style="display:none;">
  <form name="form1" method="post" action="<?php echo admin_url( 'admin.php' ); ?>">
  <input type="hidden" name="action" value="pwd_images" />
  <div class="container">
    <?php $types = get_post_types();
    $type_i = 0;
      foreach( $types as $type ) :
      if($type != 'attachment' && $type != 'revision' && $type != 'nav_menu_item' && $type != 'acf') :
     ?>
     <?php if($type_i % 3 == 0) : ?>
      <div class="row">
    <?php endif; ?>
      <div class="four columns text-center pwd_admin-card image-size-card">
        <h5 style="margin-bottom:5px;">Featured Image</h5>
        <h6><?php echo $type ?></h6>
        <p>Enter the optimal image size for this post to be displayed on the featured image metabox</p>
        <input type="text" name="pwd-<?php echo $type;?>-image" value="<?php echo get_option('pwd-'.$type.'-image-size') ?>" placeholder="500px x 500px">
        <div class="submit text-center">
          <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
        </div>
      </div>
    <?php if($type_i % 3 == 3) : ?>
      </div>
    <?php endif; ?>
  <?php $type_i++; endif; endforeach; ?>
  </div>
  </form>
</section>