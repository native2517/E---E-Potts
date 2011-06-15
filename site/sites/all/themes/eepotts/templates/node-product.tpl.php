<?php
// $Id: node-product.tpl.php,v 1.1 2010/06/30 20:23:04 nomonstersinme Exp $


/**
 * @file node-product.tpl.php
 *
 * Theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: Node body or teaser depending on $teaser flag.
 * - $picture: The authors picture of the node output from
 *   theme_user_picture().
 * - $date: Formatted creation date (use $created to reformat with
 *   format_date()).
 * - $links: Themed links like "Read more", "Add new comment", etc. output
 *   from theme_links().
 * - $name: Themed username of node author output from theme_user().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $submitted: themed submission information output from
 *   theme_node_submitted().
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $teaser: Flag for the teaser state.
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 */
?>
<div<?php print $attributes; ?>>

    <div class="node-content">
        <div class="product-image">
<?php print $node->field_image[0]["view"]; ?>
        </div>
        <div class="product-text">
            <p class="price"><b>Price</b>: <?php print $node->field_price[0]["view"]; ?></p>
            <p class="part"><b>Part Number</b>: <?php print $node->field_part_number[0]["view"]; ?></p>
            <?php foreach($node->taxonomy as $term): ?>
            <p class="term"><?php print db_fetch_object(db_query("SELECT name FROM vocabulary WHERE vid = %d", $term->vid))->name; ?>: <?php print $term->name; ?></p>
            <?php endforeach; ?>
            <?php print $node->content["body"]["#value"]; ?>
        </div>
    </div>
    <div class="node-links">
<?php print $links; ?>
    </div>
</div>