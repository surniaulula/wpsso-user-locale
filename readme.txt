=== WPSSO Select User Locale / Language in the WordPress Toolbar Menu ===
Plugin Name: WPSSO Select User Locale (WPSSO UL)
Plugin Slug: wpsso-user-locale
Text Domain: wpsso-user-locale
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Donate Link: https://www.paypal.me/jsmoriss
Assets URI: https://jsmoriss.github.io/wpsso-user-locale/assets/
Tags: user, locale, language, select, admin, back-end, front-end
Contributors: jsmoriss
Requires At Least: 4.7
Tested Up To: 4.7
Stable Tag: 1.0.0-1

WPSSO extension to add a user locale / language selector in the WordPress admin back-end and front-end toolbar menus.

== Description ==

<p><img src="https://surniaulula.github.io/wpsso-user-locale/assets/icon-256x256.png" width="256" height="256" style="width:33%;min-width:128px;max-width:256px;float:left;margin:0 40px 20px 0;" />Add a "User Locale" menu item for users in the WordPress back-end (admin) and front-end toolbar menus.</p>

Allow users to easily change their preferred locale / language instead of having to update their profile page.

The default WordPress behavior is to apply the user locale / language preference to the back-end only &mdash; this plugin extends the user locale / language preference to the front-end webpage as well.

If the Polylang plugin is available, the "User Locale" menu will use Polylang language URLs for that locale.

<blockquote>
<p><strong>Prerequisite</strong> &mdash; WPSSO Select User Locale (WPSSO UL) is an extension for the <a href="https://wordpress.org/plugins/wpsso/">WordPress Social Sharing Optimization (WPSSO)</a> plugin, which <em>automatically</em> creates complete and accurate meta tags and Schema markup for Social Sharing Optimization (SSO) and SEO.</p>
</blockquote>

= Developers =

See the plugin [Other Notes](https://wordpress.org/plugins/wpsso-user-locale/other_notes/) page for information on available filters.

== Installation ==

= Automated Install =

1. Go to the wp-admin/ section of your website.
1. Select the *Plugins* menu item.
1. Select the *Add New* sub-menu item.
1. In the *Search* box, enter the plugin name.
1. Click the *Search Plugins* button.
1. Click the *Install Now* link for the plugin.
1. Click the *Activate Plugin* link.

= Semi-Automated Install =

1. Download the plugin archive file.
1. Go to the wp-admin/ section of your website.
1. Select the *Plugins* menu item.
1. Select the *Add New* sub-menu item.
1. Click on *Upload* link (just under the Install Plugins page title).
1. Click the *Browse...* button.
1. Navigate your local folders / directories and choose the zip file you downloaded previously.
1. Click on the *Install Now* button.
1. Click the *Activate Plugin* link.

== Frequently Asked Questions ==

= Frequently Asked Questions =

* None

== Other Notes ==

= Additional Documentation =

**Developer Filters**

To exclude the "User Locale" menu item from the front-end toolbar menu, *and ignore the user locale / language preference in the front-end webpage*, add the following to your functions.php file:

`
add_filter( 'wpsso_user_locale_front_end', '__return_false' );
`

To modify the "User Locale" menu title, you can hook the 'wpsso_user_locale_menu_title' filter:

`
add_filter( 'wpsso_user_locale_menu_title', 
	'customize_user_locale_menu_title', 10, 2 );

function customize_user_locale_menu_title( $title, $user_locale ) {
	$menu_locale = $user_locale === 'site-default' ? 
		__( 'default', 'wpsso-user-locale' ) : $user_locale;

	$title = sprintf( __( 'Select Locale (%s)',
		'wpsso-user-locale' ), $menu_locale );

	return $title;
}
`

You can also modify the URL used to reload the page after selecting a locale by hooking the 'wpsso_user_locale_redirect_url' filter.

`
add_filter( 'wpsso_user_locale_redirect_url', 
	'customize_user_locale_redirect_url', 10, 2 );

function customize_user_locale_redirect_url( $url, $user_locale ) {
	// modify the redirect url here
	return $url;
}
`

== Screenshots ==

01. The "User Locale" menu item for users in the WordPress back-end and front-end toolbar menu.

== Changelog ==

= Repositories =

* [GitHub](https://github.com/jsmoriss/wpsso-user-locale)
* [WordPress.org](https://wordpress.org/plugins/wpsso-user-locale/developers/)

= Version Numbering Scheme =

Version components: `{major}.{minor}.{bugfix}-{stage}{level}`

* {major} = Major code changes / re-writes or significant feature changes.
* {minor} = New features / options were added or improved.
* {bugfix} = Bugfixes or minor improvements.
* {stage}{level} = dev &lt; a (alpha) &lt; b (beta) &lt; rc (release candidate) &lt; # (production).

Note that the production stage level can be incremented on occasion for simple text revisions and/or translation updates. See [PHP's version_compare()](http://php.net/manual/en/function.version-compare.php) documentation for additional information on "PHP-standardized" version numbering.

= Changelog / Release Notes =

**Version 1.0.0-1 (2017/01/06)**

* *New Features*
	* Initial release.
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* None

== Upgrade Notice ==

= 1.0.0-1 =

(2017/01/06) Initial release.

