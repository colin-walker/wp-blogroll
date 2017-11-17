# WP Blogroll

Add a blogroll using a custom post type and shortcode.

## Usage

Once installed the 'Blogroll' post type will be available which uses custom fields for the URLs. A blogroll entry is composed of the following:

- title:		name/site name
- body:			a description of the entry
- Link URL:		the main site URL
- Feed URL:		the site RSS/Atom feed

The entries will be displayed as below:

[title](link URL)

body

[RSS Feed](Feed URL)


## Styling

Blogroll entries have classes assigned to allow for custom styling:

.blogroll-item 		- 	the item container which will probably contain \<P> tags  
.blogroll-title		-	the item \<H2> tag which contains an \<A> tag


## Custom post type

The blogroll post type does not support tags or categories. If you need these add

	'taxonomies' => array( 'post_tag', 'category' ),	
		
to the register_post_type array in br_post_type.php


## OPML

The plugin will create a blogroll.opml file in the root of your WordPress site so will be at: http(s)://your.domain/blogroll.opml

The file is dynamically created whenever the shortcode is triggered and includes the time of creation in the \<dateModified> tag. 
