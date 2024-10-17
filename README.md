# CAPTCHA - Google Invisible reCAPTCHA

Joomla! plugin to integrate with Google Invisible reCAPTCHA

[Download](https://github.com/nikosdion/)

Copyright (C) 2024 Nicholas K. Dionysopoulos

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see [http://www.gnu.org/licenses/](http://www.gnu.org/licenses/).

## Usage

Download and install the extension's ZIP file.

Go to System, Manage, Plugins and edit the “CAPTCHA - Google Invisible reCAPTCHA” plugin. You need to enter the Site Key and Secret Key. You can find these in [your reCAPTCHA account](https://www.google.com/recaptcha).

Go to System, Global Configuration and select this plugin as your Default CAPTCHA _instead of_ Joomla's now-defunct “CAPTCHA - Invisible reCAPTCHA”. If you have any extensions which were using Joomla's now-defunct plugin explicitly configure in them, remember to edit their options and choose the “CAPTCHA - Google Invisible reCAPTCHA” plugin instead.

Then, go to System, Manage, Plugins and **disable** Joomla's now-defunct “CAPTCHA - Invisible reCAPTCHA” plugin.

That's all there is to it.

## Background info

Joomla! 5.2 removed all CAPTCHA plugins from the core. In the process, it broke the Invisible reCAPTCHA plugin which wasn't uninstalled, but it wasn't left intact either.

Exercising my rights granted to me by Joomla's GPL 2 or later license, I forked Joomla's now-removed plugin from a previous version, cleaned it up, modernised it, made it fully working, and packaged it for those poor souls who relied on it.