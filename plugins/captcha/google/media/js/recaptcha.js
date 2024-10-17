/*
 * @package     plg_captcha_google
 * @copyright   (C) 2024 Nicholas K. Dionysopoulos
 * @license     GPL-3.0+
 */

plg_captcha_google_init = () =>

    [].slice.call(document.getElementsByClassName("g-recaptcha"))
      .forEach(element => window.grecaptcha.execute(window.grecaptcha.render(element, element.dataset)));