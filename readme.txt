=== WPSSO User Locale Selector ===
Plugin Name: WPSSO User Locale Selector
Plugin Slug: wpsso-user-locale
Text Domain: wpsso-user-locale
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://surniaulula.github.io/wpsso-user-locale/assets/
Tags: locale, language, region, select, polylang
Contributors: jsmoriss
Requires Plugins: wpsso
Requires PHP: 7.4.33
Requires At Least: 5.9
Tested Up To: 6.7.0
Stable Tag: 4.3.0

Quick and easy locale / language / region selector for the WordPress admin toolbar.

== Description ==

<!-- about -->

**Provides a convenient locale / language / region selector in the WordPress admin toolbar.**

**Perfect for anyone that needs to switch languages quickly and easily:**

Allows logged-in users to easily change their preferred locale / language / region setting right from the toolbar menu, instead of having to modify their user profile settings.

<!-- /about -->

The default behavior of WordPress is to apply the user locale preference to the admin back-end only - the WPSSO User Locale Selector add-on can optionally extend the locale preference to the front-end webpage as well.

<h3>Do you use the Polylang plugin?</h3>

If the Polylang plugin is detected, the locale selector will automatically use the correct Polylang language URLs.

<h3>WPSSO Core Required</h3>

WPSSO User Locale Selector (WPSSO UL) is an add-on for the [WPSSO Core plugin](https://wordpress.org/plugins/wpsso/), which creates extensive and complete structured data to present your content at its best for social sites and search results – no matter how URLs are shared, reshared, messaged, posted, embedded, or crawled.

== Installation ==

<h3 class="top">Install and Uninstall</h3>

* [Install the WPSSO User Locale Selector add-on](https://wpsso.com/docs/plugins/wpsso-user-locale/installation/install-the-plugin/).
* [Uninstall the WPSSO User Locale Selector add-on](https://wpsso.com/docs/plugins/wpsso-user-locale/installation/uninstall-the-plugin/).

== Frequently Asked Questions ==

<h3 class="top">Frequently Asked Questions</h3>

* None.

<h3>Notes and Documentation</h3>

* [Developer Resources](https://wpsso.com/docs/plugins/wpsso-user-locale/notes/developer/)
	* [Filters](https://wpsso.com/docs/plugins/wpsso-user-locale/notes/developer/filters/)
		* [All Filters](https://wpsso.com/docs/plugins/wpsso-user-locale/notes/developer/filters/all/)
		* [Filter Examples](https://wpsso.com/docs/plugins/wpsso-user-locale/notes/developer/filters/examples/)
			* [Disable User Locale on Front-End](https://wpsso.com/docs/plugins/wpsso-user-locale/notes/developer/filters/examples/disable-user-locale-on-front-end/)
			* [Modify the Menu Title](https://wpsso.com/docs/plugins/wpsso-user-locale/notes/developer/filters/examples/modify-the-menu-title/)
			* [Modify the Redirect URL](https://wpsso.com/docs/plugins/wpsso-user-locale/notes/developer/filters/examples/modify-the-redirect-url/)

== Screenshots ==

01. WPSSO User Locale selector in the WordPress toolbar menu.

== Changelog ==

<h3 class="top">Version Numbering</h3>

Version components: `{major}.{minor}.{bugfix}[-{stage}.{level}]`

* {major} = Major structural code changes and/or incompatible API changes (ie. breaking changes).
* {minor} = New functionality was added or improved in a backwards-compatible manner.
* {bugfix} = Backwards-compatible bug fixes or small improvements.
* {stage}.{level} = Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).

<h3>Standard Edition Repositories</h3>

* [GitHub](https://surniaulula.github.io/wpsso-user-locale/)
* [WordPress.org](https://plugins.trac.wordpress.org/browser/wpsso-user-locale/)

<h3>Development Version Updates</h3>

<p><strong>WPSSO Core Premium edition customers have access to development, alpha, beta, and release candidate version updates:</strong></p>

<p>Under the SSO &gt; Update Manager settings page, select the "Development and Up" (for example) version filter for the WPSSO Core plugin and/or its add-ons. When new development versions are available, they will automatically appear under your WordPress Dashboard &gt; Updates page. You can reselect the "Stable / Production" version filter at any time to reinstall the latest stable version.</p>

<p><strong>WPSSO Core Standard edition users (ie. the plugin hosted on WordPress.org) have access to <a href="https://wordpress.org/plugins/wpsso-user-locale/advanced/">the latest development version under the Advanced Options section</a>.</strong></p>

<h3>Changelog / Release Notes</h3>

**Version 4.3.0 (2024/08/25)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Changed the main instantiation action hook from 'init_objects' to 'init_objects_preloader'.
* **Requires At Least**
	* PHP v7.4.33.
	* WordPress v5.9.
	* WPSSO Core v18.10.0.

== Upgrade Notice ==

= 4.3.0 =

(2024/08/25) Changed the main instantiation action hook from 'init_objects' to 'init_objects_preloader'.

