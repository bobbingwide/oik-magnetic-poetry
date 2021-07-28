# oik-magnetic-poetry 
![banner](https://raw.githubusercontent.com/bobbingwide/oik-magnetic-poetry/master/assets/oik-magnetic-poetry-banner-772x250.jpg)
* Contributors: bobbingwide
* Donate link: https://www.oik-plugins.com/oik/oik-donate/
* Tags: gutenberg, shortcode, blocks, oik
* Requires at least: 5.0.3
* Tested up to: 5.8
* Gutenberg compatible: Yes
* Stable tag: 0.2.0
* License: GPLv3 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html

## Description 
Magnetic Poetry block for the WordPress Block Editor.

A Server Side Rendered WordPress block that makes your poem look like poetry written using fridge magnets.

It doesn't have to be a poem.

## Installation 
1. Upload the contents of the oik-magnetic-poetry plugin to the `/wp-content/plugins/oik-magnetic-poetry' directory
1. Activate the oik-magnetic-poetry plugin through the 'Plugins' menu in WordPress

## Frequently Asked Questions 
# What if I leave the block blank? 
If you don't write anything, and Hello Dolly is activated, then you'll see a randomly selected line from the song.

# What if Hello Dolly is not activated? 
If it's not activated then it'll be "Code is Poetry".
No surprises there.

# It sometimes looks a bit funny 
Yes. It needs some better CSS.

# Can I choose the font size and amount each word is rotated? 
Not using the block's settings.
But you can write some custom CSS.


## Screenshots 
1. Magnetic poetry block - initial display
2. Magnetic poetry block - default display front end

## Upgrade Notice 
# 0.2.0 
Now compatible with WordPress 5.8 block widget editor.

# 0.1.0 
Now uses shared library functions for Server Side Rendered blocks.

# 0.0.0 
First version developed for "My Favourite Block", a lightning talk by Herb Miller.

## Changelog 
# 0.2.0 
* Changed: Refactored to be compatible with WordPress 5.8. Built using wp-scripts #4
* Tested: With WordPress 5.8 and WordPress Multi Site
* Tested: With PHP 8.0
* Tested: With Gutenberg 11.1.0

# 0.1.0 
* Changed: eliminate redundant code now we're using the shared libraries
* Changed: update to remove deprecated messages from the console
* Changed: use oik-blocks shared library logic for enqueuing block scripts and styles
* Changed: Import ServerSideRender from wp.editor not wp.components
* Tested: With WordPress 5.3.2 and WordPress Multi Site
* Tested: With Gutenberg 7.3.0
* Tested: With PHP 7.3 and PHP 7.4

# 0.0.0 
* Added: Based on oik-blocks, https://github.com/bobbingwide/oik-magnetic-poetry/issues/1
* Added: Operates as a standalone plugin, https://github.com/bobbingwide/oik-magnetic-poetry/issues/2
* Added: Screenshots for blocks.
* Tested: With WordPress 5.1
* Tested: With Gutenberg 5.1.1
* Tested: With PHP 7.2

## Further reading 
For more useful blocks see [oik-blocks](https://www.oik-plugins.com/blocks).
For many other blocks see [WordPress block reference](https://blocks.wp-a2z.org)

If you want to read more about oik plugins then please visit
[oik plugins](https://www.oik-plugins.com)


