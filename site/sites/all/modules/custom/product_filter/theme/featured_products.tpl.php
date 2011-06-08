<ol>
    <?php foreach($products as $product): ?>
    <li class="product">
    <?php print $product["image"]; ?>
    <div class="title"><?php print l($product["title"], $product["path"]); ?></div>
    <div class="price"><b>Price</b>: <?php print $product["price"]; ?></div>
    </li>
<?php endforeach; ?>
</ol>
<div class="clear"></div>