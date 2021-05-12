<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

$app = Factory::getApplication();
$wa  = $this->getWebAssetManager();
$this->setGenerator('');

// Browsers support SVG favicons
$this->addHeadLink(HTMLHelper::_('image', 'templates/' . $this->template . '/images/joomla-favicon.svg', '', [], false, 1), 'icon', 'rel', ['type' => 'image/svg+xml']);
$this->addHeadLink(HTMLHelper::_('image', 'templates/' . $this->template . '/images/favicon.ico', '', [], false, 1), 'alternate icon', 'rel', ['type' => 'image/vnd.microsoft.icon']);
$this->addHeadLink(HTMLHelper::_('image', 'templates/' . $this->template . '/images/joomla-favicon-pinned.svg', '', [], false, 1), 'mask-icon', 'rel', ['color' => '#000']);

// Template path
$templatePath = 'templates/' . $this->template;

// Enable assets
$wa->registerAndUseStyle('style', $templatePath . '/css/style.css');
$wa->registerAndUseScript('winbox', $templatePath . '/js/winbox.bundle.js', [], ['defer' => true]);

// Params
$social_links_group = $this->params->get('social_links_group', '');
$menu_items_group = $this->params->get('menu_items_group', '');
$brand_name = $this->params->get('brand_name', 'Yiannis');

/**
 * Get Social Links
 */
// sample data if the social links have not been set yet in template parameters
$social_links_group_array_sample_data['social_links_group0'] = new stdClass;
$social_links_group_array_sample_data['social_links_group0']->title = "Facebook";
$social_links_group_array_sample_data['social_links_group0']->url = "https://www.facebook.com/Yiannistaos";

$social_links_group_array_sample_data['social_links_group1'] = new stdClass;
$social_links_group_array_sample_data['social_links_group1']->title = "Twitter";
$social_links_group_array_sample_data['social_links_group1']->url = "https://twitter.com/Yiannistaos";

$social_links_group_array_sample_data['social_links_group2'] = new stdClass;
$social_links_group_array_sample_data['social_links_group2']->title = "Instagram";
$social_links_group_array_sample_data['social_links_group2']->url = "https://www.instagram.com/yiannistaos/";

$social_links_group_array_sample_data['social_links_group3'] = new stdClass;
$social_links_group_array_sample_data['social_links_group3']->title = "Linkedin";
$social_links_group_array_sample_data['social_links_group3']->url = "https://cy.linkedin.com/in/yiannis-christodoulou-3a7b5514";

$social_links_group_array_sample_data['social_links_group4'] = new stdClass;
$social_links_group_array_sample_data['social_links_group4']->title = "Joomla!";
$social_links_group_array_sample_data['social_links_group4']->url = "https://volunteers.joomla.org/joomlers/yiannis-christodoulou";

$social_links_group_array_sample_data['social_links_group5'] = new stdClass;
$social_links_group_array_sample_data['social_links_group5']->title = "WordPress";
$social_links_group_array_sample_data['social_links_group5']->url = "https://profiles.wordpress.org/yiannistaos";

$social_links_group_array_sample_data['social_links_group6'] = new stdClass;
$social_links_group_array_sample_data['social_links_group6']->title = "Github";
$social_links_group_array_sample_data['social_links_group6']->url = "https://github.com/Yiannistaos";

$social_links = (!empty($social_links_group) && is_object($social_links_group)) ? $social_links_group : (object) $social_links_group_array_sample_data;

/**
 * Get Menu Items
 */
// sample data if the menu items have not been set yet in template parameters
$menu_items_group_array_sample_data['menu_items_group0'] = new stdClass;
$menu_items_group_array_sample_data['menu_items_group0']->title = "about";
$menu_items_group_array_sample_data['menu_items_group0']->heading = "About Me";
$menu_items_group_array_sample_data['menu_items_group0']->text = "<p>Hey, I am Yiannis Christodoulou.</p><p>I was born in beautiful Rhodes island of Greece. Today, I live in Cyprus, since January 2011.</p><p>I am a freelance Full-stack PHP Web Developer and the guy behind Web357. I love building websites and applications with Joomla! and WordPress. Also I love travels, food, video games and football.</p>";


$menu_items_group_array_sample_data['menu_items_group1'] = new stdClass;
$menu_items_group_array_sample_data['menu_items_group1']->title = "contact";
$menu_items_group_array_sample_data['menu_items_group1']->heading = "Contact Me";
$menu_items_group_array_sample_data['menu_items_group1']->text = "<p>You can contact me at the email and phone number below.</p><ul><li>Phone: (00357) 12345678</li><li>Email: yiannis@web357.com</li></ul>";

$menu_items = (!empty($menu_items_group) && is_object($menu_items_group)) ? $menu_items_group : (object) $menu_items_group_array_sample_data;

$this->setMetaData('viewport', 'width=device-width, initial-scale=1');
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="metas" />
	<jdoc:include type="styles" />
	<jdoc:include type="scripts" />
</head>

<body>
	<div class="container">

		<?php if (!empty($menu_items)): ?>
			<nav>
				<ul>
				<?php foreach ($menu_items as $menu_item): ?>
					<?php 
					$js_var = strtolower(str_replace(' ', '_', $menu_item->heading));  // about_me
					$id = strtolower(str_replace(' ', '-', $menu_item->heading));  // about-me
					?>
					<li id="<?php echo $id; ?>">/<?php echo $menu_item->title; ?></li>
				<?php endforeach; ?>
				</ul>
			</nav>
		<?php endif; ?>

		<main>
		<h1><?php echo $brand_name; ?>:$<span class="cursor">|</span></h1>

		<?php if (!empty($social_links)): ?>
			<h3><?php echo Text::_('TPL_BIOTERMINAL_FIND_ME_ONLINE'); ?>:</h3>
			<ul>
			<?php foreach ($social_links as $social_link): ?>
				<li>
					<a
					href="<?php echo $social_link->url; ?>"
					><?php echo $social_link->title; ?></a>
				</li>
			<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		</main>
    </div>

    <div class="hidden">

		<?php if (!empty($menu_items)): ?>

			<?php 
			$top = 50;
			$left = 50;
			$inline_javascript = '';
			foreach ($menu_items as $menu_item): ?>

				<?php 
				$js_var = strtolower(str_replace(' ', '_', $menu_item->heading));  // about_me
				$id = strtolower(str_replace(' ', '-', $menu_item->heading));  // about-me
				?>

				<div id="<?php echo $id; ?>-content">
					<h2><?php echo $id; ?>:$<span class="cursor">|</span></h2>
					<?php echo $menu_item->text; ?>
				</div>

				<?php
				$inline_javascript .= <<<JS

				const {$js_var} = document.querySelector('#{$id}');
				const {$js_var}Content = document.querySelector('#{$id}-content');

				{$js_var}.addEventListener('click', () => {
					const {$js_var}Box = new WinBox({
						title: '{$menu_item->heading}',
						// modal: true,
						width: '500px',
						height: '500px',
						top: {$top},
						right: 50,
						bottom: 50,
						left: {$left},
						mount: {$js_var}Content,
						onfocus: function () {
						this.setBackground('#00aa00')
						},
						onblur: function () {
						this.setBackground('#777')
						},
					})
				});
JS;
			$top+=50;
			$left+=200;
			endforeach; ?>

		<?php 
		$wa->addInlineScript($inline_javascript, [], ['type' => 'module', 'defer' => true]);
		endif; ?>
    </div>
</body>
</html>