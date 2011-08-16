<?php
/**
 * @file views-view-unformatted.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<div id="stories-thumbs" class="stories-recent">
 
  <?php $counter = 1; ?>
<?php foreach ($rows as $id => $row):
  if ($counter == 1) { $aoclass = 'alpha clearLeft'; $counter ++; }
  elseif ($counter == 4) { $aoclass = 'omega'; $counter = 1;}
  else { $aoclass = ''; $counter ++;}
?>
  <div class="stories-recent-item grid-3 <?php echo $aoclass; ?>">
    <?php print $row; ?>
  </div>
  
<?php endforeach; ?>
</div>