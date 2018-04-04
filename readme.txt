=== WPSSO User Locale Selector ===
Plugin Name: WPSSO User Locale Selector
Plugin Slug: wpsso-user-locale
Text Domain: wpsso-user-locale
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://surniaulula.github.io/wpsso-user-locale/assets/
Tags: user locale, user language, user region, locale, language, region, select, toolbar, menu, polylang
Contributors: jsmoriss
Requires PHP: 5.4
Requires At Least: 3.8
Tested Up To: 4.9.5
Stable Tag: 1.2.1

WPSSO Core add-on to provide a user locale (language / region) drop-down menu in the WordPress admin back-end and front-end toolbar.

== Description ==

<img class="readme-icon" src="https://surniaulula.github.io/wpsso-user-locale/assets/icon-256x256.png">

**A WPSSO Core add-on to provide a user locale (language / region) drop-down menu in the WordPress admin back-end and front-end toolbar.**

Perfect for translators or anyone who needs to switch languages quickly and easily &mdash; allows logged-in users to change their preferred locale / language setting right from the toolbar menu (instead of having to update their WordPress user profile page).

The default WordPress behavior is to apply the user locale preference to the admin back-end only &mdash; this plugin can optionally extend the user locale preference to the front-end webpage as well (enabled by default in the SSO &gt; User Locale settings page).

WPSSO User Locale Selector is *incredibly fast* and coded for performance &mdash; WPSSO Core and its add-ons make full use of all available caching techniques (persistent / non-persistent object and disk caching), and load only the PHP library files and object classes they need, keeping their code small, fast, and light. WPSSO Core and its add-ons are also fully tested and compatible with PHP v7.x (PHP v5.4 or better required).

<h3>Power-Users / Developers</h3>

See the plugin [Other Notes](https://wordpress.org/plugins/wpsso-user-locale/other_notes/) page for information on available filters.

<h3>Do you use the Polylang plugin?</h3>

If the Polylang plugin is active, the user locale menu will automatically use the correct Polylang language URLs for the current webpage.

<h3>WPSSO Core Plugin Prerequisite</h3>

WPSSO User Locale Selector (aka WPSSO UL) is an add-on for the WPSSO Core plugin &mdash; which creates complete &amp; accurate meta tags and Schema markup from your existing content for social sharing, Social Media Optimization (SMO), Search Engine Optimization (SEO), Google Rich Cards, Pinterest Rich Pins, etc.

== Installation ==

<h3>Install and Uninstall</h3>

* [Install the WPSSO UL Add-on](https://wpsso.com/docs/plugins/wpsso-user-locale/installation/install-the-plugin/)
* [Uninstall the WPSSO UL Add-on](https://wpsso.com/docs/plugins/wpsso-user-locale/installation/uninstall-the-plugin/)

== Frequently Asked Questions ==

<h3>Frequently Asked Questions</h3>

* None

== Other Notes ==

<h3>Additional Documentation</h3>

* [Developer Resources](https://wpsso.com/docs/plugins/wpsso-user-locale/notes/developer/)
	* [Filters](https://wpsso.com/docs/plugins/wpsso-user-locale/notes/developer/filters/)
		* [Filter Examples](https://wpsso.com/docs/plugins/wpsso-user-locale/notes/developer/filters/examples/)
			* [Disable User Locale on Front-End](https://wpsso.com/docs/plugins/wpsso-user-locale/notes/developer/filters/examples/disable-user-locale-on-front-end/)
			* [Modify the Menu Title](https://wpsso.com/docs/plugins/wpsso-user-locale/notes/developer/filters/examples/modify-the-menu-title/)
			* [Modify the Redirect URL](https://wpsso.com/docs/plugins/wpsso-user-locale/notes/developer/filters/examples/modify-the-redirect-url/)
		* [Filters by Name](https://wpsso.com/docs/plugins/wpsso-user-locale/notes/developer/filters/by-name/)

== Screenshots ==

01. WPSSO User Locale selector in the WordPress toolbar menu.

== Changelog ==

<h3>Version Numbering</h3>

Version components: `{major}.{minor}.{bugfix}[-{stage}.{level}]`

* {major} = Major structural code changes / re-writes or incompatible API changes.
* {minor} = New functionality was added or improved in a backwards-compatible manner.
* {bugfix} = Backwards-compatible bug fixes or small improvements.
* {stage}.{level} = Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).

<h3>Free / Standard Version Repositories</h3>

* [GitHub](https://surniaulula.github.io/wpsso-user-locale/)
* [WordPress.org](https://plugins.trac.wordpress.org/browser/wpsso-user-locale/)

<h3>Changelog / Release Notes</h3>

**Version 1.2.2-dev.1 (2018/04/01)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Renamed some WpssoUtil methods for Gutenberg changes in WPSSO v3.57.0.

**Version 1.2.1 (2018/03/24)**

* *New Features*
	* None
* *Improvements*
	* Renamed plugin "Extensions" to "Add-ons" to avoid confusion and improve / simplify translations.
* *Bugfixes*
	* None
* *Developer Notes*
	* None

**Version 1.2.0 (2018/02/24)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Refactored the WpssoUl `min_version_notice()` method to use PHP's `trigger_error()` and include a notice to refresh plugin update information.

== Upgrade Notice ==

= 1.2.2-dev.1 =

(2018/04/01) Renamed some WpssoUtil methods for Gutenberg changes in WPSSO v3.57.0.

= 1.2.1 =

(2018/03/24) Renamed plugin "Extensions" to "Add-ons" to avoid confusion and improve / simplify translations.

