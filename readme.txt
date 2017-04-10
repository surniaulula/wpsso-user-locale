=== WPSSO User Locale Selector - Select a Locale / Language / Region in the WP Toolbar Menu ===
Plugin Name: WPSSO User Locale Selector (WPSSO UL)
Plugin Slug: wpsso-user-locale
Text Domain: wpsso-user-locale
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://surniaulula.github.io/wpsso-user-locale/assets/
Tags: user locale, user language, user region, locale, language, region, select, toolbar, menu, polylang
Contributors: jsmoriss
Requires At Least: 3.7
Tested Up To: 4.7.3
Stable Tag: 1.1.4

WPSSO extension to add a user locale / language / region selector in the WordPress admin back-end and front-end toolbar menus.

== Description ==

<img src="https://surniaulula.github.io/wpsso-user-locale/assets/icon-256x256.png" width="128" height="128" class="readme-plugin-icon">

<p><strong>Add a user locale drop-down menu item in the WordPress admin back-end admin and front-end toolbar menus.</strong></p>

<strong>Perfect for translators or anyone who needs to switch languages quickly and easily</strong> &mdash; allows logged-in users to change their preferred locale / language setting right from the toolbar menu (instead of having to update their WordPress user profile page).

The default WordPress behavior is to apply the user locale preference to the admin back-end only &mdash; this plugin can optionally extend the user locale preference to the front-end webpage as well (enabled by default in the SSO &gt; User Locale settings page).

= Power-Users / Developers =

See the plugin [Other Notes](https://wordpress.org/plugins/wpsso-user-locale/other_notes/) page for information on available filters.

= Do you use the Polylang plugin? =

If the Polylang plugin is active, the user locale menu will automatically use the correct Polylang language URLs for the current webpage.

<blockquote>
<p><strong>Prerequisite</strong> &mdash; WPSSO User Locale Selector (WPSSO UL) is an extension for the <a href="https://wordpress.org/plugins/wpsso/">WordPress Social Sharing Optimization (WPSSO)</a> plugin, which <em>automatically</em> generates complete and accurate meta tags + Schema markup from your content for Social Sharing Optimization (SSO) and Search Engine Optimization (SEO).</p>
</blockquote>

== Installation ==

= Install and Uninstall =

* [Install the Plugin](https://wpsso.com/docs/plugins/wpsso-user-locale/installation/install-the-plugin/)
* [Uninstall the Plugin](https://wpsso.com/docs/plugins/wpsso-user-locale/installation/uninstall-the-plugin/)

== Frequently Asked Questions ==

= Frequently Asked Questions =

* None

== Other Notes ==

= Additional Documentation =

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

= Repositories =

* [GitHub](https://surniaulula.github.io/wpsso-user-locale/)
* [WordPress.org](https://wordpress.org/plugins/wpsso-user-locale/developers/)

= Version Numbering =

Version components: `{major}.{minor}.{bugfix}[-{stage}.{level}]`

* {major} = Major structural code changes / re-writes or incompatible API changes.
* {minor} = New functionality was added or improved in a backwards-compatible manner.
* {bugfix} = Backwards-compatible bug fixes or small improvements.
* {stage}.{level} = Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).

= Changelog / Release Notes =

**Version 1.1.4 (2017/04/08)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Minor revision to move URLs in the extension config to the main WPSSO plugin config.
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

= 1.1.4 =

(2017/04/08) Minor revision to move URLs in the extension config to the main WPSSO plugin config.

= 1.1.2-1 =

(2017/04/05) Updated the plugin icon images and the documentation URLs.

= 1.1.1-1 =

(2017/03/25) Minor updates to textdomain translation strings.

= 1.1.0-1 =

(2017/01/13) Added a new "Toolbar Menu Icon" option in the User Locale settings page. Added a new 'wpsso_user_locale_menu_items' filter.

