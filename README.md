# CAPTCHA - Google Invisible reCAPTCHA

[![Downloads](https://img.shields.io/github/downloads/nikosdion/plg_captcha_google/latest/total?sort=semver&style=for-the-badge&logoColor=%23ffffff&label=Download
)](https://github.com/nikosdion/plg_captcha_google/releases)

Joomla! plugin to integrate with Google Invisible reCAPTCHA.

Copyright (C) 2024 Nicholas K. Dionysopoulos

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see [http://www.gnu.org/licenses/](http://www.gnu.org/licenses/).

## Usage

This plugin can replace the core Joomla! “CAPTCHA - Invisible reCAPTCHA” plugin which is no longer shipped with Joomla! as of Joomla! 5.2.

Download and install the extension's ZIP file.

Go to System, Manage, Plugins and edit the “CAPTCHA - Google Invisible reCAPTCHA” plugin. You need to enter the Site Key and Secret Key. 

⚠️ **IMPORTANT** Up until the end of 2024, you could find your Site Key and Secret Key in [your reCAPTCHA account](https://www.google.com/recaptcha). Starting February 2025, you need to [migrate your reCAPTCHA keys to a Google Cloud Project](https://cloud.google.com/recaptcha/docs/migrate-recaptcha#google-cloud-console). The catch is that you can only run a few thousand CAPTCHAs every month in the [free tier](https://cloud.google.com/recaptcha/docs/compare-tiers); beyond that, you will have to start paying Google for using reCAPTCHA. Please don't flame me for this; I am not Google, not am I affiliated with them. This situation sucks for me as much as it sucks for you. Thank you for your understanding.

Go to System, Global Configuration and select this plugin as your Default CAPTCHA _instead of_ Joomla's now-defunct “CAPTCHA - Invisible reCAPTCHA”. If you have any extensions which were using Joomla's now-defunct plugin explicitly configure in them, remember to edit their options and choose the “CAPTCHA - Google Invisible reCAPTCHA” plugin instead.

Then, go to System, Manage, Plugins and **disable** Joomla's now-defunct “CAPTCHA - Invisible reCAPTCHA” plugin.

That's all there is to it.

## Background info

Joomla! 5.2 removed all CAPTCHA plugins from the core. In the process, it broke the Invisible reCAPTCHA plugin for many sites despite the defunct plugin not being fully uninstalled.

This is no good. Thankfully, Joomla! is Free Software. Exercising my rights granted by Joomla's GNU GPL v2 or later license, I forked Joomla's nowdefunct plugin from a previous version, cleaned it up, modernised it, made it fully working, and distribute it under the GNU GPL v3 or later license, free of charge for anyone to use and distribute. 

The original plugin relied on a core CMS class added specifically for the reCAPTCHA plugin, a Composer dependency added to the core solely to support the reCAPTCHA plugin, and one CSS and one JS file. As a matter of future-proofing this plugin, I am using a forked and simplified version of the core class, I ship a copy of the Composer dependency which will only be loaded if / when Joomla! removes it from the core, and distilled the two static media files into less than 250 bytes of inline code (thereby saving you two network requests, decreasing the overall page load time).