<ul id="portfolio_quicksand_filters">
				<li><a href="#" class="all">All</a></li>
				<?php foreach($filters as $id => $filter): ?>
				<li><a href="#" class="<?php print $id; ?>"><?php print $filter; ?></a></li>
				<?php endforeach; ?>
</ul>
<ul id="portfolio_quicksand_projects">
				<?php foreach($nodes as $key => $node): ?>
				<li data-id="id_<?php print $key; ?>" data-type="<?php print $node["id"]; ?>"><?php print l($node["image"], $node["path"], array("html" => true)); ?></li>
				<?php endforeach; ?>
</ul>