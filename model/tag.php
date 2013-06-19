<?php

define('TAG_NEWEST', 0);
define('TAG_MOST_POPULAR', 1);
define('TAG_BEST_SELLER', 2);
define('TAG_TOP_RANKED', 3);
define('TAG_USER_DEFINED', 4);

class Tag
{
	public static function printAll($currentTag)
	{
		$newestClass = "";
		$mostPopularClass = "";
		$bestSellerClass = "";
		$topRankedClass = "";
		
		switch ($currentTag) {
			case TAG_NEWEST:
				$newestClass = ' class="active"';
				break;
			case TAG_MOST_POPULAR:
				$mostPopularClass = ' class="active"';
				break;
			case TAG_BEST_SELLER:
				$bestSellerClass = ' class="active"';
				break;
			case TAG_TOP_RANKED:
				$topRankedClass = ' class="active"';
				break;
			default:
		}
		
		return <<< HTML
					<div class="well">
						<ul class="nav nav-list">
							<li$newestClass><a href="./">Newest</a></li>
							<li$mostPopularClass><a href="./most-popular">Most Popular</a></li>
							<li$bestSellerClass><a href="./best-seller">Best Seller</a></li>
							<li$topRankedClass><a href="./top-ranked">Top Ranked</a></li>
						</ul>
					</div>
HTML;
	}
}