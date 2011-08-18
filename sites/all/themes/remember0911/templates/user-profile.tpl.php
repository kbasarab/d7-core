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
else:
  $user_photo = '&nbsp;';
endif;

$images_130 = array();
$images_480 = array();
$counter = 0;
if (is_array($field_photos)):
  echo '<script type="text/javascript">';
  echo 'var image_arr = new Array();';
  
  foreach ($field_photos as $x):
    if ($counter == 0) { $sel = ' selected'; } else {$sel = ''; };
    $images_130[$counter] = '<a href="javascript:image_click('.$counter.');" class="image img-'.$counter.''.$sel.'">'.theme_image_style(array('style_name'=>'130_wide','path'=> $x['uri'])).'</a>';
    $images_480[$counter] = theme_image_style(array('style_name'=>'wide_480','path'=>$x['uri']));
    echo 'image_arr['.$counter.'] = \''.$images_480[$counter].'\';'."\n";
    $counter++;
  endforeach;
  echo '</script>';
endif;

$video = render($user_profile['field_video'])
?>

<script type="text/javascript">
function image_click(key) {
  jQuery(".user-pictures-large .img-content").html(image_arr[key]);
  jQuery(".selected").removeClass("selected");
  jQuery(".img-"+key).addClass("selected");
}


</script>
<div id="user-profile">
<div class="grid-12 push-2 story-content">
  <a name="story"></a>
  <div class="grid-4 nav-return"><?php echo l('Back to stories','stories/recent'); ?></div>
  <div class="share_tools">
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
  
  <div class="story-text story-container clearfix clearLeft clearRight">
    <div class="pull-2 grid-2 story-section"><a href="#story">My story</a></div>
    <div class="grid-3 user-avatar"><?php echo $user_photo; ?></div>
    <div class="grid-8">
      <div class="story-shared grid-3 alpha omega">Shared <?php echo date("M. j, Y",$user_created); ?></div>
      <div class="story-loc">Location during 9/11: <?php echo render($field_where[0]['safe_value']); ?></div>
      <h1 class="story-title clearRight clearLeft">
        <?php echo $fullname; ?>'s story
      </h1>
      <div class="story-content"><?php echo $field_where_now[0]['safe_value']; ?>
                <?php
            if ($uid == $user->uid || in_array('administrator',$user->roles)):
              echo ' <span>'.l('[Edit]','user/'.$uid.'/edit',array('attributes'=>array('class'=>'user-edit'))).'</span>';
            endif;
          ?>
      </div>
    </div>
  </div>
  <!-- Photos -->
  <?php if (!empty($images_480) && !empty($images_130)): ?>
  <div class="photos-container clearLeft clearfix">
    <div class="pull-2 grid-2 story-section"><a href="#story">My pictures</a></div>
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
    <div class="pull-2 grid-2 story-section"><a href="#story">My video</a></div>
    <div class="grid-11 user-video">
      <?php echo $video; ?>
    </div>
  </div>
  <?php endif; ?>
<?php
if (in_array('administrator',$user->roles)):
  echo '<div class="action-flags grid-12">';
  echo render($user_profile['flags']);
  echo '</div>';
endif;
?>
</div>
</div>

<div id="story-footer" class="grid-8 push-4">
  <div class="block-inner">
    <h2 class="block-title">Join in the conversation</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ulla.</p>
    <div id="share-story"><?php print l('Share your story','share'); ?></div>
  </div>
</div>



<?php 


//print $fullname;
//print $field_where[0]['safe_value'];
//print $field_where_now[0]['safe_value'];
//print render($user_profile['field_video']);

//print render($user_profile);


?>