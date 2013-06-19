<?php

class Category
{	
	public static function getList()
	{
		return Mysql::select("categories", array(), true);
	}
	
	public static function getBy($key, $value)
	{
		return Mysql::select("categories", array(
			$key	=> $value
		), false);
	}
	
	private static function printCategory($currentCategory, $categoryId, $categoryName)
	{
		$categoryClass = "";
		if ($currentCategory == $categoryId) {
			$categoryClass = ' class="active"';
		}
		
		$categoryUrl = str_replace(" ", "-", strtolower($categoryName));
		
		return <<< HTML
					<li$categoryClass><a href="/category/$categoryUrl/">$categoryName</a></li>		
HTML;
	}
	
	public static function printAll($currentCategory)
	{
		$categories = self::getList();
	
		$strCategories = "";
		foreach ($categories as $category) {
			$strCategories .= self::printCategory($currentCategory, $category['id'], $category['name']);
		}
		
		$allClass = "";
		if ($currentCategory == "all") {
			$allClass = ' class="active"';
		}
			
		return <<< HTML
		<div class="subnav clearfix">
			<div class="navbar">
				<ul class="nav">
					<li$allClass><a href="/">All</a></li>
					$strCategories
				</ul>
			</div>
		</div>
HTML;
	}
}