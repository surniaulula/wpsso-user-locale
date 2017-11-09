=== WPSSO User Locale Selector - Select a Locale / Language / Region in the WP Toolbar Menu ===
Plugin Name: WPSSO User Locale Selector
Plugin Slug: wpsso-user-locale
Text Domain: wpsso-user-locale
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://surniaulula.github.io/wpsso-user-locale/assets/
Tags: user locale, user language, user region, locale, language, region, select, toolbar, menu, polylang
Contributors: jsmoriss
Requires PHP: 5.3
Requires At Least: 3.7
Tested Up To: 4.9
Stable Tag: 1.1.8

WPSSO Core extension to add a user locale / language / region selector in the WordPress admin back-end and front-end toolbar menus.

== Description ==

<img class="readme-icon" src="https://surniaulula.github.io/wpsso-user-locale/assets/icon-256x256.png">

<p><strong>Add a user locale drop-down menu item in the WordPress admin back-end admin and front-end toolbar menus.</strong></p>

<strong>Perfect for translators or anyone who needs to switch languages quickly and easily</strong> &mdash; allows logged-in users to change their preferred locale / language setting right from the toolbar menu (instead of having to update their WordPress user profile page).

The default WordPress behavior is to apply the user locale preference to the admin back-end only &mdash; this plugin can optionally extend the user locale preference to the front-end webpage as well (enabled by default in the SSO &gt; User Locale settings page).

**WPSSO UL is *incredibly fast* and coded for performance:**

WPSSO Core and its extensions make full use of all available caching techniques (persistent / non-persistent object and disk caching), and load only the PHP library files and object classes they need, keeping their code small, fast, and light.

WPSSO Core and its extensions are fully tested and compatible with PHP v7.x (PHP v5.3 or better required).

<h3>Power-Users / Developers</h3>

See the plugin [Other Notes](https://wordpress.org/plugins/wpsso-user-locale/other_notes/) page for information on available filters.

<h3>Do you use the Polylang plugin?</h3>

If the Polylang plugin is active, the user locale menu will automatically use the correct Polylang language URLs for the current webpage.

<h3>WPSSO Core Plugin Prerequisite</h3>

WPSSO User Locale Selector is an extension for the WPSSO Core plugin &mdash; which creates complete &amp; accurate meta tags and Schema markup from your content for social sharing, social media / SMO, search / SEO / rich cards, and more.

== Installation ==

<h3>Install and Uninstall</h3>

* [Install the WPSSO UL Plugin](https://wpsso.com/docs/plugins/wpsso-user-locale/installation/install-the-plugin/)
* [Uninstall the WPSSO UL Plugin](https://wpsso.com/docs/plugins/wpsso-user-locale/installation/uninstall-the-plugin/)

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

01. An example user locale selector in the WordPress front-end toolbar menu.

== Changelog ==

<h3>Free / Standard Version Repositories</h3>

* [GitHub](https://surniaulula.github.io/wpsso-user-locale/)
* [WordPress.org](https://wordpress.org/plugins/wpsso-user-locale/developers/)

<h3>Version Numbering</h3>

Version components: `{major}.{minor}.{bugfix}[-{stage}.{level}]`

* {major} = Major structural code changes / re-writes or incompatible API changes.
* {minor} = New functionality was added or improved in a backwards-compatible manner.
* {bugfix} = Backwards-compatible bug fixes or small improvements.
* {stage}.{level} = Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).

<h3>Changelog / Release Notes</h3>

**Version 1.1.9-a.3 (2017/11/09)**

* *New Features*
	* None
* *Improvements*
	* Added a method call to clear WPSSO notifications when switching languages.
* *Bugfixes*
	* None
* *Developer Notes*
	* None

**Version 1.1.8 (2017/10/15)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Minor code refactoring for WPSSO v3.47.0.
		* Renamed the SucomUtil get_locale_opt() call to get_key_value.

**Version 1.1.7 (2017/09/10)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Minor code refactoring for WPSSO v3.46.0.

**Version 1.1.6 (2017/04/30)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Code refactoring to rename the $is_avail array to $avail for WPSSO v3.42.0.

**Version 1.1.5 (2017/04/16)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Refactored the plugin init filters and moved/renamed the registration boolean from `is_avail[$name]` to `is_avail['p_ext'][$name]`.

**Version 1.1.4 (2017/04/08)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Minor revision to move URLs in the extension config to the main WPSSO Core plugin config.
	* Dropped the package number from the production version string.

**Version 1.1.2-1 (2017/04/05)**

* *New Features*
	* None
* *Improvements*
	* Updated the plugin icon images and the documentation URLs.
* *Bugfixes*
	* None
* *Developer Notes*
	* None

**Version 1.1.1-1 (2017/03/25)**

* *New Features*
	* None
* *Improvements*
	* Minor updates to textdomain translation strings.
* *Bugfixes*
	* None
* *Developer Notes*
	* None

**Version 1.1.0-1 (2017/01/13)**

* *New Features*
	* Added a new "Toolbar Menu Icon" option in the User Locale settings page.
* *Improvements*
	* Changed the "Toolbar Menu Title" default value from "User Locale (%s)" to "%s".
* *Bugfixes*
	* None
* *Developer Notes*
	* Added a new 'wpsso_user_locale_menu_dashicon' filter.
	* Added a new 'wpsso_user_locale_menu_items' filter.

== Upgrade Notice ==

= 1.1.9-a.3 =

(2017/11/09) Added a method call to clear WPSSO notifications when switching languages.

= 1.1.8 =

(2017/10/15) Minor code refactoring for WPSSO v3.47.0.

= 1.1.7 =

(2017/09/10) Minor code refactoring for WPSSO v3.46.0.

= 1.1.6 =

(2017/04/30) Code refactoring to rename the $is_avail array to $avail for WPSSO v3.42.0.

= 1.1.5 =

(2017/04/16) Refactored the plugin init filters and moved/renamed the registration boolean.

= 1.1.4 =

(2017/04/08) Minor revision to move URLs in the extension config to the main WPSSO Core plugin config.

= 1.1.2-1 =

(2017/04/05) Updated the plugin icon images and the documentation URLs.

= 1.1.1-1 =

(2017/03/25) Minor updates to textdomain translation strings.

= 1.1.0-1 =

(2017/01/13) Added a new "Toolbar Menu Icon" option in the User Locale settings page. Added a new 'wpsso_user_locale_menu_items' filter.

