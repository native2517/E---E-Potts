
<?php if($settings["brand"] || $settings["type"]):?>
<div id="filter-info">
    Selected filter(s)
    <?php if($settings["brand"]):?><em><?php print $settings["brand"];?></em>,<?php endif; ?>
    <?php if($settings["type"]):?><em><?php print $settings["type"];?></em>,<?php endif; ?>
    total found: <em><?php print $settings["amount"]; ?></em>
</div>
<?php else: ?>
<div id="filter-info">
    All products, total found: <em><?php print $settings["amount"]; ?></em>
</div>
<?php endif; ?>
<?php foreach ($products as $product): ?>
<?php print $product; ?>
<?php endforeach; ?>
