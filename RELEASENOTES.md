## CAPTCHA - Google Invisible reCAPTCHA

A Joomla! 5.2 or later plugin to integrate with Google Invisible reCAPTCHA.

You can use this plugin to replace the now-defunct “CAPTCHA - Invisible reCAPTCHA” plugin.

### Requirements

* Joomla 5.2 or later
* PHP 8.1, 8.2, 8.3, or 8.4.

### Usage

This plugin can replace the core Joomla! “CAPTCHA - Invisible reCAPTCHA” plugin which is no longer shipped with Joomla! as of Joomla! 5.2.

Download and install the extension's ZIP file.

Go to System, Manage, Plugins and edit the “CAPTCHA - Google Invisible reCAPTCHA” plugin. You need to enter the Site Key and Secret Key. You can find these in [your reCAPTCHA account](https://www.google.com/recaptcha).

Go to System, Global Configuration and select this plugin as your Default CAPTCHA _instead of_ Joomla's now-defunct “CAPTCHA - Invisible reCAPTCHA”. If you have any extensions which were using Joomla's now-defunct plugin explicitly configure in them, remember to edit their options and choose the “CAPTCHA - Google Invisible reCAPTCHA” plugin instead.

Then, go to System, Manage, Plugins and **disable** Joomla's now-defunct “CAPTCHA - Invisible reCAPTCHA” plugin.

That's all there is to it.
