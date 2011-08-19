<?php
/**
 * @file views-view-fields.tpl.php
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>

<?php 
  $photo = remember_photo($fields['field_photos']->content,$fields['field_user_photo']->content);
  if (!empty($photo)): $photo = '<div class="featured-photo grid-3 alpha">'.l($photo,'user/'.$fields['uid']->content,array('html'=>true)).'</div>'; endif;
  //$name = remember_name($fields['field_fname']->content,$fields['field_lname']->content);
  $name = $fields['name']->content;
  
?>
<?php echo $photo; ?>
<div class="hp-story-content grid-9 omega">
<?php if ($fields['counter']->content == 0) { echo '<h3>'.t('Featured Story').'</h3>'; }; ?>
<div class="story-shared">Shared <?php echo $fields['created']->content; ?></div>
<div class="story-name"><?php echo l($name."'s story",'user/'.$fields['uid']->content); ?></div>
<?php 
if (!empty($fields['field_video']->content)):
  echo '<div class="story-video">'.$fields['field_video']->content.'</div>';
else:
?>
  <div class="story"><?php echo $fields['field_where_now']->content; ?></div>
<?php endif; ?>
<div class="story-more"><?php echo l('Read the story','user/'.$fields['uid']->content); ?></div>
</div>

