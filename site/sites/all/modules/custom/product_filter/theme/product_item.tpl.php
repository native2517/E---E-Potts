<div class="product">
    <?php print $product["image"]; ?>
    <div class="title"><?php print l($product["title"], $product["path"]); ?></div>
    <p class="price"><b>Price</b>: <?php print $product["price"]; ?></p>
    <p><b>Description</b>: <?php print $product["body"]; ?></p>
    <div class="clear"></div>
</div>
