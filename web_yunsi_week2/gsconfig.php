<?php

if (basename($_SERVER['PHP_SELF']) == 'gsconfig.php') { 
	die('You cannot load this page directly.');
}; 



# Extra salt to secure your password with. Default is empty for backwards compatibility.
#define('GSLOGINSALT', 'your_unique_phrase');

# Turn off auto-generation of SALT and use a custom value. Used for cookies & upload security.
#define('GSUSECUSTOMSALT', 'your_new_salt_value_here');

# Default thumbnail width of uploaded image
define('GSIMAGEWIDTH', '200');

# Change the administrative panel folder name
#define('GSADMIN', 'admin');

# Turn on debug mode
#define('GSDEBUG', TRUE);

# Ping search engines upon sitemap generation?
define('GSDONOTPING', 1);

# Turn off CSRF protection. Uncomment this if you keep receiving the error message "CSRF error detected..."
#define('GSNOCSRF', TRUE);

# Set override CHMOD mode
#define('GSCHMOD', 0755);

# Disable chmod operations
# define('GSDOCHMOD',false);

# Enable Canonical Redirects?
#define('GSCANONICAL', 1);

# Use Uploadify to upload files?
#define('GSNOUPLOADIFY', 1);

# WYSIWYG editor height (default 500)
#define('GSEDITORHEIGHT', '400');

# WYSIWYG toolbars (advanced, basic or [custom config]) 
#define('GSEDITORTOOL', 'advanced');

# WYSIWYG editor language (default en)
#define('GSEDITORLANG', 'en');

# WYSIWYG Editor Options
#define('GSEDITOROPTIONS', '');

# Set email from address


# Autosave within edit.php. Value is the autosave interval in seconds
#define('GSAUTOSAVE', 900);

# Enable the External API to be shown on settings page 
#define('GSEXTAPI', 1);
	
# Set PHP locale
# http://php.net/manual/en/function.setlocale.php
#setlocale(LC_ALL, 'en_US');

# Define default timezone of server, accepts php timezone string
# valid timeszones can be found here http://www.php.net/manual/en/timezones.php
# define('GSTIMEZONE', 'America/Chicago');

# Disable loading of external CDN versions of scripts (jQuery/jQueryUI)
#define("GSNOCDN",true);

# Disable Codemirror theme editor
#define("GSNOHIGHLIGHT",true);

# Forces suppression of php errors when GSDEBUG is false, despite php ini settings
define('GSSUPPRESSERRORS',true);

# Disable check for Apache web server, default false
#define('GSNOAPACHECHECK', true);

# Disable header version check
#define('GSNOVERCHECK', true);

# Enable alternate admin styles, current style constants are
# GSSTYLE can be a comma delimied list of flags
# note: stylesheets are cached, flush cache after changing
#
# style flags:
# GSSTYLEWIDE = wide fluid
# GSSTYLE_SBFIXED = fixed sidemenu
# 
# eg. 
# define('GSSTYLE',GSSTYLE_SBFIXED);
# define('GSSTYLE',GSSTYLEWIDE);
#define('GSSTYLE',implode(',',array(GSSTYLEWIDE,GSSTYLE_SBFIXED)));

# Disable Sitemap generation and menu items
# define('GSNOSITEMAP',true);

# Enable auto meta descriptions from content excerpts when empty
# define('GSAUTOMETAD',true);

# Set default language for missing lang token merge, 
# accepts a lang string, default is 'en_US', false to disable
# define('GSMERGELANG',false);

# GS can prevent backend or frontend pages from being loaded inside a frame 
# this is done by sending an x-frame-options header, and helps protect against clickjacking attacks
# This is enabled by default for backend pages (true/GSBACK)
# setting GSNOFRAME to (false) will disable this behavior
# You can also customize this by passing the gs location definitions,
# GSFRONT, GSBACK or GSBOTH definitions enable this for front and/or backends
# define('GSNOFRAME',GSBOTH); # prevent in frames ALWAYS
#define('GSNOFRAME',false);  # prevent in frames NEVER

# GS can format its xml files before saving them if you require human readable source for them
# define('GSFORMATXML',true);

?>
