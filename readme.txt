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
Requires Plugins: wpsso
Requires PHP: 7.2.34
Requires At Least: 5.5
Tested Up To: 6.4.0
Stable Tag: 3.8.2

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

<h3>Users Love the WPSSO UL Add-on</h3>

&#x2605;&#x2605;&#x2605;&#x2605;&#x2605; - "Practical and Fast - Works as advertised. Very easy to use." - [grouper](https://wordpress.org/support/topic/practical-and-fast/)

<h3>WPSSO Core Required</h3>

WPSSO User Locale Selector (WPSSO UL) is an add-on for the [WPSSO Core plugin](https://wordpress.org/plugins/wpsso/), which provides complete structured data for WordPress to present your content at its best on social sites and in search results – no matter how URLs are shared, reshared, messaged, posted, embedded, or crawled.

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

**Version 3.9.0-dev.10 (2021/11/04)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Refactored the settings page load process.
* **Requires At Least**
	* PHP v7.2.34.
	* WordPress v5.5.
	* WPSSO Core v16.7.0-dev.10.

**Version 3.8.2 (2023/07/13)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Minor code optimization and standardization:
		* Replaced `{get|update|delete}_{comment|post|term|user}_meta()` functions by `{get|update|delete}_metadata()`.
* **Requires At Least**
	* PHP v7.2.34.
	* WordPress v5.5.
	* WPSSO Core v15.16.0.

**Version 3.8.1 (2023/01/26)**

* **New Features**
	* None.
* **Improvements**
	* Updated the minimum WordPress version from v5.2 to v5.5.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Updated the `WpssoAbstractAddOn` library class.
* **Requires At Least**
	* PHP v7.2.34.
	* WordPress v5.5.
	* WPSSO Core v14.7.0.

**Version 3.8.0 (2023/01/20)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Updated the `SucomAbstractAddOn` common library class.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.
	* WPSSO Core v14.5.0.

**Version 3.7.0 (2022/12/28)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Added a new `WpssoUlFiltersOptions` class.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.
	* WPSSO Core v14.0.0.

**Version 3.6.1 (2022/03/07)**

Maintenance release.

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* None.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.
	* WPSSO Core v11.5.0.

**Version 3.6.0 (2022/01/19)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Renamed the lib/abstracts/ folder to lib/abstract/.
	* Renamed the `SucomAddOn` class to `SucomAbstractAddOn`.
	* Renamed the `WpssoAddOn` class to `WpssoAbstractAddOn`.
	* Renamed the `WpssoWpMeta` class to `WpssoAbstractWpMeta`.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.
	* WPSSO Core v9.14.0.

**Version 3.5.1 (2021/11/16)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Refactored the `WpssoUlLocale->add_locale_toolbar()` method.
	* Refactored the `SucomAddOn->get_missing_requirements()` method.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.
	* WPSSO Core v9.8.0.

**Version 3.5.0 (2021/11/10)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Replaced `SucomUtilWP::get_available_languages()` by `SucomUtil::get_available_locales()` for consistency.
* **Requires At Least**
	* PHP v7.0.
	* WordPress v5.0.
	* WPSSO Core v9.7.0.

== Upgrade Notice ==

= 3.9.0-dev.10 =

(2021/11/04) Refactored the settings page load process.

= 3.8.2 =

(2023/07/13) Minor code optimization and standardization.

= 3.8.1 =

(2023/01/26) Updated the minimum WordPress version from v5.2 to v5.5.

= 3.8.0 =

(2023/01/20) Updated the `SucomAbstractAddOn` common library class.

= 3.7.0 =

(2022/12/28) Added a new `WpssoUlFiltersOptions` class.

= 3.6.1 =

(2022/03/07) Maintenance release.

= 3.6.0 =

(2022/01/19) Renamed the lib/abstracts/ folder and its classes.

= 3.5.1 =

(2021/11/16) Refactored the `WpssoUlLocale->add_locale_toolbar()` and `SucomAddOn->get_missing_requirements()` methods.

= 3.5.0 =

(2021/11/10) Replaced `SucomUtilWP::get_available_languages()` by `SucomUtil::get_available_locales()` for consistency.

