<?php
/**
 * @package         plg_captcha_google
 * @copyright   (C) 2024 Nicholas K. Dionysopoulos
 * @license         GPL-3.0+
 */

defined('_JEXEC') or die;

use Dionysopoulos\Plugin\Captcha\Google\Extension\Google;
use Dionysopoulos\Plugin\Captcha\Google\Library\JoomlaRequestMethod;
use Joomla\CMS\Extension\PluginInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\Http\HttpFactory;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Event\DispatcherInterface;
use ReCaptcha\ReCaptcha;

return new class () implements ServiceProviderInterface {
	public function register(Container $container)
	{
		// Just in case Joomla! removes this in the future...
		if (!class_exists(ReCaptcha::class))
		{
			require_once __DIR__ . '/../vendor/autoload.php';
		}

		$container->set(
			PluginInterface::class,
			fn(Container $container) => new Google(
				$container->get(DispatcherInterface::class),
				(array) PluginHelper::getPlugin('captcha', 'google'),
				new JoomlaRequestMethod(HttpFactory::getHttp()),
				Factory::getApplication()
			)
		);
	}
};
