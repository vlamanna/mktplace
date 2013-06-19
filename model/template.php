<?php

class Template
{	
	public static function create($userId, $name, $price, $categoryId)
	{
		$templateId = Mysql::insert("templates", array(
			'user_id'		=> $userId,
			'name'			=> $name,
			'price'			=> $price,
			'category_id'	=> $categoryId
		));
	}
	
	public static function update($templateId, $name, $price, $categoryId)
	{
		Mysql::update("templates", $templateId, array(
			'name'			=> $name,
			'price'			=> $price,
			'category_id'	=> $categoryId
		));
		
		return self::getBy('id', $userId);
	}
	
	public static function delete($templateId)
	{
		Mysql::delete("templates", array(
			'id'			=> $templateId
		));
		
		return true;
	}
	
	public static function getList($userId, $categoryId, $sort = null)
	{
		$filters = array();
		
		if (isset($userId)) {
			$filters['user_id'] = $userId;
		}
		
		if (isset($categoryId)) {
			$filters['category_id'] = $categoryId;
		}
		
		if (isset($sort)) {
			$filters['order_by'] = $sort;
		}
		
		return Mysql::select("templates", $filters, true);
	}
	
	public static function getBy($key, $value)
	{
		return Mysql::select("templates", array(
			$key	=> $value
		), false);
	}
	
	public static function buy($templateId, $userId, $amount)
	{
		Mysql::insert("purchases", array(
			'template_id'	=> $templateId,
			'user_id'		=> $userId,
			'amount'		=> $amount
		));
	}
	
	private static function printTemplate($templateId, $templateName, $templatePrice, $templateDate, $ownerId, $ownerName)
	{
		$templateUrl = $templateId . "-" . str_replace(" ", "-", strtolower($templateName));
		$ownerUrl = $ownerId . "-" . str_replace(" ", "-", strtolower($ownerName));
		$templatePrice = '$' . ($templatePrice / 100);
		$templateDate = substr($templateDate, 0, 10);
		
		return <<< HTML
				<div class="template-box-container">
					<div class="padding-10 template-box">
						<div class="template-preview">
							<a href="/template/$templateUrl" class="button"></a>
							<img src="http://lorempixel.com/560/280/" width="280" height="140" />
							<i class="icon-zoom-in"></i>
						</div>
						<div class="template-title">
						<a href="/template/$templateUrl">$templateName</a><br/>
						<span class="template-author">By <a href="/designer/$ownerUrl">$ownerName</a></span>
						<span class="template-author">Added $templateDate</span>
					</div>
						<div class="template-buy">
							<a href="/template/$templateUrl" class="button"></a>
							<i class="icon-shopping-cart"></i> $templatePrice
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
HTML;
	}
	
	public static function printAll($categoryId, $userId, $tagId, $sort = null)
	{
		$templates = self::getList($userId, $categoryId, $sort);
		
		$strTemplates = "";
		foreach ($templates as $template) {
			$templateOwner = User::getBy('id', $template['user_id']);
			$strTemplates .= self::printTemplate($template['id'], $template['name'], $template['price'], $template['creation_timestamp'], $templateOwner['id'], $templateOwner['name']);
		}
		
		return <<< HTML
			$strTemplates
HTML;
	}
}