<?php
/**
 * @file views-view-unformatted.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<div id="hp-featured">
<?php $counter = 0; ?>
<?php foreach ($rows as $id => $row): ?>
  <div class="hp-recent-item grid-12">
    <?php print $row; ?>
  </div>
  
<?php endforeach; ?>
</div>