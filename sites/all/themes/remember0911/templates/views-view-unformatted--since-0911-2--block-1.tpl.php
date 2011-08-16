<?php
/**
 * @file views-view-unformatted.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<div id="hp-recent-stores">
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
  <div class="hp-recent-wrapper">
  <?php $counter = 1; ?>
<?php foreach ($rows as $id => $row):
  if ($counter == 1) { $aoclass = 'alpha clearLeft'; $counter ++; }
  elseif ($counter == 3) { $aoclass = 'omega'; $counter = 1;}
  else { $aoclass = ''; $counter ++;}
?>
  <div class="hp-recent-item grid-4 <?php print $aoclass; ?>">
    <?php print $row; ?>
  </div>
  
<?php endforeach; ?>
  </div>
</div>