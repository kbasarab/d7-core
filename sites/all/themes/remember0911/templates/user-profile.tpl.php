<?php

/**
 * @file
 * Default theme implementation to present all user profile data.
 *
 * This template is used when viewing a registered member's profile page,
 * e.g., example.com/user/123. 123 being the users ID.
 *
 * Use render($user_profile) to print all profile items, or print a subset
 * such as render($content['field_example']). Always call render($user_profile)
 * at the end in order to print all remaining items. If the item is a category,
 * it will contain all its profile items. By default, $user_profile['summary']
 * is provided which contains data on the user's history. Other data can be
 * included by modules. $user_profile['user_picture'] is available
 * for showing the account picture.
 *
 * Available variables:
 *   - $user_profile: An array of profile items. Use render() to print them.
 *   - Field variables: for each field instance attached to the user a
 *     corresponding variable is defined; e.g., $user->field_example has a
 *     variable $field_example defined. When needing to access a field's raw
 *     values, developers/themers are strongly encouraged to use these
 *     variables. Otherwise they will have to explicitly specify the desired
 *     field language, e.g. $user->field_example['en'], thus overriding any
 *     language negotiation rule that was previously applied.
 *
 * @see user-profile-category.tpl.php
 *   Where the html is handled for the group.
 * @see user-profile-item.tpl.php
 *   Where the html is handled for each item in the group.
 * @see template_preprocess_user_profile()
 */

if (!empty($field_user_photo[0]['uri'])):
  $user_photo = theme_image_style(array('style_name'=>'130_wide','path'=>$field_user_photo[0]['uri']));
endif;

$images_130 = array();
$images_480 = array();
if (is_array($field_photos)):
  foreach ($field_photos as $x):
    $images_130[] = theme_image_style(array('style_name'=>'130_wide','path'=>$field_photos[0]['uri']));
  endforeach;
  foreach ($field_photos as $x):
    $images_480[] = theme_image_style(array('style_name'=>'wide_480','path'=>$field_photos[0]['uri']));
  endforeach;
endif;

$video = render($user_profile['field_video'])
?>


<div id="user-profile">
<div class="grid-12 push-2 story-content">
  
  <div class="grid-4 nav-return"><a href="#">Back to stories</a></div>
  <div class="alpha omega grid-5 prefix-3">
    <!-- AddThis Button BEGIN -->
    <div class="addthis_toolbox addthis_default_style ">
    <a class="addthis_counter addthis_pill_style"></a>
    <a class="addthis_button_google_plusone"></a>
    <a class="addthis_button_tweet"></a>
    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>    
    </div>
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=morrisdigitalworks"></script>
    <!-- AddThis Button END -->
  </div>
  
  <div class="story-text story-container clearfix clearLeft">
    <div class="pull-2 grid-2 story-section">My story</div>
    <div class="grid-3 user-avatar"><?php echo $user_photo; ?></div>
    <div class="grid-8">
      <div class="story-shared grid-3 alpha omega">Shared <?php echo date("M. j, Y",$user->created); ?></div>
      <div class="story-loc">Location during 9/11: <?php echo render($field_where[0]['safe_value']); ?></div>
      <h1 class="story-title clearRight clearLeft"><?php echo $fullname; ?>'s story</h1>
      <div class="story-content"><?php echo $field_where_now[0]['safe_value']; ?></div>
    </div>
  </div>
  <!-- Photos -->
  <?php if (!empty($images_480) && !empty($images_130)): ?>
  <div class="photos-container clearLeft clearfix">
    <div class="pull-2 grid-2 story-section">My pictures</div>
    <div class="grid-3 user-pictures">
      <ul>
      <?php 
      foreach ($images_130 as $x):
        echo '<li>'.$x.'</li>';
      endforeach;
      ?>
      </ul>
    </div>
    <div class="grid-8 user-pictures-large">
      <div class="img-content"><?php echo $images_480[0]; ?></div>
    </div>
  </div>
  <?php endif; ?>

  <!-- Videos -->
  <?php if (!empty($video)): ?>
  <div class="video-container clearLeft clearfix">
    <div class="pull-2 grid-2 story-section">My video</div>
    <div class="grid-11 user-video">
      <?php echo $video; ?>
    </div>
  </div>
  <?php endif; ?>
</div>
</div>


<?php 
//print_r(array_keys($user_profile));

//print $fullname;
//print $field_where[0]['safe_value'];
//print $field_where_now[0]['safe_value'];
//print render($user_profile['field_video']);

//print render($user_profile);


?>