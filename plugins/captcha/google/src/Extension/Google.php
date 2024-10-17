<?php
/**
 * @package         plg_captcha_google
 * @copyright   (C) 2024 Nicholas K. Dionysopoulos
 * @license         GPL-3.0+
 */

namespace Dionysopoulos\Plugin\Captcha\Google\Extension;

use Joomla\CMS\Application\CMSApplicationInterface;
use Joomla\CMS\Application\CMSWebApplicationInterface;
use Joomla\CMS\Form\Field\CaptchaField;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Event\DispatcherInterface;
use Joomla\Event\Event;
use Joomla\Event\SubscriberInterface;
use Joomla\Utilities\ArrayHelper;
use Joomla\Utilities\IpHelper;
use ReCaptcha\ReCaptcha;
use ReCaptcha\RequestMethod;
use RuntimeException;
use SimpleXMLElement;

defined('_JEXEC') || die;

final class Google extends CMSPlugin implements SubscriberInterface
{
	protected $autoloadLanguage = true;

	public function __construct(
		DispatcherInterface $dispatcher,
		array $config,
		private readonly RequestMethod $requestMethod,
		CMSApplicationInterface $app
	)
	{
		parent::__construct($dispatcher, $config);

		$this->setApplication($app);
	}

	public static function getSubscribedEvents(): array
	{
		return [
			'onPrivacyCollectAdminCapabilities' => 'reportPrivacyCapabilities',
		];
	}

	public function reportPrivacyCapabilities(Event $event): void
	{
		$event->setArgument(
			'result',
			array_merge(
				$event->getArgument('result', []) ?: [],
				[
					[
						$this->getApplication()->getLanguage()->_('PLG_CAPTCHA_GOOGLE') => [
							$this->getApplication()->getLanguage()->_(
								'PLG_CAPTCHA_GOOGLE_PRIVACY_CAPABILITY_IP_ADDRESS'
							),
						],
					],
				]
			)
		);
	}

	public function onInit(string $id = 'dynamic_recaptcha_invisible_1'): bool
	{
		$app = $this->getApplication();

		if (!$app instanceof CMSWebApplicationInterface)
		{
			return false;
		}

		$publicKey = $this->params->get('public_key', '');

		if ($publicKey === '')
		{
			throw new RuntimeException($app->getLanguage()->_('PLG_CAPTCHA_GOOGLE_ERROR_NO_PUBLIC_KEY'));
		}

		$apiSrc = sprintf(
			"https://www.google.com/recaptcha/api.js?onload=plg_captcha_google_init&render=explicit&hl=%s",
			$app->getLanguage()->getTag()
		);

		$app->getDocument()->getWebAssetManager()
			->registerAndUseScript('plg_captcha_google', 'plg_captcha_google/recaptcha.min.js', [], ['defer' => true])
			->registerAndUseScript('plg_captcha_google.api', $apiSrc, [], ['defer' => true], ['plg_captcha_google'])
			->registerAndUseStyle('plg_captcha_google', 'plg_captcha_google/recaptcha.css');

		return true;
	}

	public function onDisplay(?string $name = null, string $id = 'dynamic_recaptcha_invisible_1', string $class = ''
	): string
	{
		$attributes = [
			'id'                    => $id,
			'class'                 => ((trim($class) == '') ? 'g-recaptcha' : ($class . ' g-recaptcha')),
			'data-sitekey'          => $this->params->get('public_key', ''),
			'data-badge'            => $this->params->get('badge', 'bottomright'),
			'data-size'             => 'invisible',
			'data-tabindex'         => $this->params->get('tabindex', '0'),
			'data-callback'         => $this->params->get('callback', ''),
			'data-expired-callback' => $this->params->get('expired_callback', ''),
			'data-error-callback'   => $this->params->get('error_callback', ''),
		];

		return '<div ' . ArrayHelper::toString($attributes) . '></div>';
	}

	public function onCheckAnswer(?string $code = null)
	{
		$app        = $this->getApplication();
		$language   = $app->getLanguage();
		$privateKey = $this->params->get('private_key');
		$remoteIp   = IpHelper::getIp();
		$jsResponse = $app->getInput()->get('g-recaptcha-response', '', 'string');

		if (empty($privateKey))
		{
			throw new RuntimeException($language->_('PLG_RECAPTCHA_INVISIBLE_ERROR_NO_PRIVATE_KEY'));
		}

		if (empty($remoteIp))
		{
			throw new RuntimeException($language->_('PLG_RECAPTCHA_INVISIBLE_ERROR_NO_IP'));
		}

		if (trim($jsResponse) == '')
		{
			throw new RuntimeException($language->_('PLG_RECAPTCHA_INVISIBLE_ERROR_EMPTY_SOLUTION'));
		}

		$response = (new ReCaptcha($privateKey, $this->requestMethod))->verify($jsResponse, $remoteIp);

		if ($response->isSuccess())
		{
			return true;
		}

		foreach ($response->getErrorCodes() as $error)
		{
			throw new RuntimeException($error);
		}

		return false;
	}

	public function onSetupField(CaptchaField $field, SimpleXMLElement $element)
	{
		$element['hiddenLabel'] = 'true';
	}
}
