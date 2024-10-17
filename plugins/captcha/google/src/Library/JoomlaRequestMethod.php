<?php
/**
 * @package     plg_captcha_google
 * @copyright   (C) 2024 Nicholas K. Dionysopoulos
 * @license     GPL-3.0+
 */

namespace Dionysopoulos\Plugin\Captcha\Google\Library;

use Joomla\Http\Exception\InvalidResponseCodeException;
use Joomla\Http\Http;
use ReCaptcha\RequestMethod;
use ReCaptcha\RequestParameters;

defined('_JEXEC') || die;

final class JoomlaRequestMethod implements RequestMethod
{
	private const SITE_VERIFY_URL = 'https://www.google.com/recaptcha/api/siteverify';

	public function __construct(private readonly Http $http) {}

	public function submit(RequestParameters $params)
	{
		try
		{
			return (string) $this->http->post(self::SITE_VERIFY_URL, $params->toArray())->getBody();
		}
		catch (InvalidResponseCodeException $exception)
		{
			return '';
		}
	}
}
