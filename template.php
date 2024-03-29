<?php

require_once('lib/cookie.php');
require_once('lib/mysql.php');

require_once('model/user.php');
require_once('model/document.php');
require_once('model/template.php');
require_once('model/category.php');

$connected = false;

$auth = Cookie::get('auth');

if (isset($auth)) {
	$key = str_replace("MKTPLACE", "", base64_decode($auth));
	
	$user = User::getBy('key', $key);
	
	if (isset($user)) {
		$connected = true;
	}
}

$templateId = str_replace('/template/', '', $_SERVER['REQUEST_URI']);
$templateId = explode("-", $templateId);
$templateId = $templateId[0];
$template = Template::getBy('id', $templateId);
$templateOwner = User::getBy('id', $template['user_id']);

if (!$connected) {
	$user = array(
		'name'	=> ""
	);
}
?>
<!DOCTYPE html>
<html lang="en">
<?= Document::printHead($template['name'], ""); ?>
	<body>
<?= Document::printNav(TAB_NONE, $connected, $user['name']); ?>
		
		<div class="container">
		
<?= Category::printAll(null); ?>

		<div class="row">
		  <div class="span12 template-info-full-preview">
				<h2 class="padding-top-30"><?= $template['name']; ?></h2>
				<p>By <a href="/designer/<?= $templateOwner['id'] . "-" . str_replace(" ", "-", strtolower($templateOwner['name'])); ?>"><?= $templateOwner['name']; ?></a></p>
		  </div>
		</div>
		<div class="row">
		  <div class="span8">
				<div class="template-box template-box-full-preview padding-10">
  				<div class="template-preview template-full-preview">
						<a href="/template/<?= $template['id'] . "-" . str_replace(" ", "-", strtolower($template['name'])); ?>" class="button"></a>
						<img src="http://lorempixel.com/1200/680/" width="600" height="340" />
						<i class="icon-zoom-in"></i>
  				</div>
  				<h4 class="padding-top-30">Template Description</h4>
  				<p>
    				Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
  				</p>
				</div>
		  </div>
			<div class="span4">
				<p>
					<script src="/js/paypal-button.min.js?merchant=vincent_lamanna@hotmail.com"
						data-button="buynow"
						data-name="<?= $template['name']; ?>"
						data-number="<?= $template['id']; ?>"
						data-currency="USD"
						data-amount="<?= ($template['price']/100); ?>"
						data-callback="http://themeup.co/ipn"
						data-return="http://themup.co/thank-you"
						data-cancel_return="http://themeup.co/template/<?= $template['id']; ?>"
					>
					</script>
				</p>
				
				<div class="padding-top-20">
				  Template info
				</div>

			</div>
		</div>
		
<?= Document::printFooter($connected); ?>
		<script>
			$('button.paypal-button').html("<i class='icon-usd'></i><?= ($template['price']/100); ?>");
			$('button.paypal-button').on('mouseenter', function() {
				$(this).data('content', $(this).html());
				$(this).html('BUY');
			});
			$('button.paypal-button').on('mouseleave', function() {
				$(this).html($(this).data('content'));
				$(this.data('content', ''));
			});
		</script>
		</div>
	</body>
</html>