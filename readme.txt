=== WPSSO User Locale - Select a Language / Region in the WordPress Toolbar Menu ===
Plugin Name: WPSSO User Locale (WPSSO UL)
Plugin Slug: wpsso-user-locale
Text Domain: wpsso-user-locale
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Donate Link: https://www.paypal.me/surniaulula
Assets URI: https://surniaulula.github.io/wpsso-user-locale/assets/
Tags: user, locale, language, region, select, admin, back-end, front-end, polylang
Contributors: jsmoriss
Requires At Least: 4.7
Tested Up To: 4.7.1
Stable Tag: 1.0.0-1

WPSSO extension to add a user locale / language / region selector in the WordPress admin back-end and front-end toolbar menus.

== Description ==

<p><img src="https://surniaulula.github.io/wpsso-user-locale/assets/icon-256x256.png" width="256" height="256" style="width:33%;min-width:128px;max-width:256px;float:left;margin:0 40px 20px 0;" />Add a user locale drop-down menu item in the WordPress admin back-end admin and front-end toolbar menus.</p>

Allows users to easily change their preferred locale / language / region setting from the toolbar menu instead of having to update their WordPress profile page.

The default WordPress behavior is to apply the user locale preference to the admin back-end only &mdash; this plugin can optionally extend the user locale preference to the front-end webpage as well (enabled by default in the SSO &gt; User Locale settings page).

= Power-Users / Developers =

See the plugin [Other Notes](https://wordpress.org/plugins/wpsso-user-locale/other_notes/) page for information on available filters.

= Do you use the Polylang plugin? =

If the Polylang plugin is active, the user locale menu will automatically use the correct Polylang language URLs for the current webpage.

<blockquote>
<p><strong>Prerequisite</strong> &mdash; WPSSO User Locale (WPSSO UL) is an extension for the <a href="https://wordpress.org/plugins/wpsso/">WordPress Social Sharing Optimization (WPSSO)</a> plugin, which <em>automatically</em> creates complete and accurate meta tags and Schema markup for Social Sharing Optimization (SSO) and SEO.</p>
</blockquote>

== Installation ==

= Install and Uninstall =

* [Install the Plugin](https://wpsso.com/codex/plugins/wpsso-user-locale/installation/install-the-plugin/)
* [Uninstall the Plugin](https://wpsso.com/codex/plugins/wpsso-user-locale/installation/uninstall-the-plugin/)

== Frequently Asked Questions ==

= Frequently Asked Questions =

* None

== Other Notes ==

= Additional Documentation =

* [Developer Resources](https://wpsso.com/codex/plugins/wpsso-user-locale/notes/developer/)
	* [Filters](https://wpsso.com/codex/plugins/wpsso-user-locale/notes/developer/filters/)
		* [Filter Examples](https://wpsso.com/codex/plugins/wpsso-user-locale/notes/developer/filters/examples/)
			* [Disable User Locale on Front-End](https://wpsso.com/codex/plugins/wpsso-user-locale/notes/developer/filters/examples/disable-user-locale-on-front-end/)
			* [Modify the Menu Title](https://wpsso.com/codex/plugins/wpsso-user-locale/notes/developer/filters/examples/modify-the-menu-title/)
			* [Modify the Redirect URL](https://wpsso.com/codex/plugins/wpsso-user-locale/notes/developer/filters/examples/modify-the-redirect-url/)
		* [Filters by Name](https://wpsso.com/codex/plugins/wpsso-user-locale/notes/developer/filters/by-name/)

== Screenshots ==

01. An example user locale selector in the WordPress front-end toolbar menu.

== Changelog ==

= Repositories =

* [GitHub](https://surniaulula.github.io/wpsso-user-locale/)
* [WordPress.org](https://wordpress.org/plugins/wpsso-user-locale/developers/)

= Version Numbering Scheme =

Version components: `{major}.{minor}.{bugfix}-{stage}{level}`

* {major} = Major code changes / re-writes or significant feature changes.
* {minor} = New features / options were added or improved.
* {bugfix} = Bugfixes or minor improvements.
* {stage}{level} = dev &lt; a (alpha) &lt; b (beta) &lt; rc (release candidate) &lt; # (production).

Note that the production stage level can be incremented on occasion for simple text revisions and/or translation updates. See [PHP's version_compare()](http://php.net/manual/en/function.version-compare.php) documentation for additional information on "PHP-standardized" version numbering.

= Changelog / Release Notes =

**Version 1.1.0-rc1 (2017/01/12)**

* *New Features*
	* Added a new "Toolbar Menu Icon" option in the User Locale settings page.
* *Improvements*
	* Changed the "Toolbar Menu Title" default value from "User Locale (%s)" to "%s".
* *Bugfixes*
	* None
* *Developer Notes*
	* Added a new 'wpsso_user_locale_menu_dashicon' filter.
	* Added a new 'wpsso_user_locale_menu_items' filter.

**Version 1.0.0-1 (2017/01/08)**

* *New Features*
	* Initial release.
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* None

== Upgrade Notice ==

= 1.1.0-rc1 =

(2017/01/12) Added a new "Toolbar Menu Icon" option in the User Locale settings page. Added a new 'wpsso_user_locale_menu_items' filter.

= 1.0.0-1 =

(2017/01/08) Initial release.

