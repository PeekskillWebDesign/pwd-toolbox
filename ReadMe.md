~Current Version:0.8.4~


PWD Toolset is a custom plugin to aid in the development of wordpress sites built by Peekskill Web Design.

This plugin includes:

- Shortcodes for creating a grid structure in the wordpress editor
- An admin menu that allows users to edit their favicon and google analytics
- A widget for adding social buttons
- a function to provide dynamic excerpt lengths
- An updator class to allow the plugin to be updated via Github

An explaination of each Tool is listed below:

********************* PWD Shortcodes *************************

----------------------------------------------------

Container

	[container][/container]

	Optional:

		class 
			Default = ''
			Adds a class to the div

----------------------------------------------------

Row

	[row][/row]

----------------------------------------------------

Col

	[col][/col]

	Required:

		cols
			Default = ''
			Adds column width e.g., "eight"

	Optional:

		offset
			Default = ''
			Adds offset to column e.g., "one"

		class
			Default = ''
			Adds class to columns section
----------------------------------------------------

Link

	[link]

	Required:

		link-to
			Default = ''
			adds location for link to go to

	Optional:

		class
			Default =''
			adds class(es)

----------------------------------------------------

********************* Admin Menu *************************

This allows users to dynamically add their google analytics information. A user can fill out this form and the correct analytics code will be printed on the front end pages.

This also allows a user to dynamically upload a favicon image. The image will be resized to 32 x 32, a standard format for most browsers. Future support will include an apple touch icon.

********************* Social Widget *************************

This allows a user to add social buttons to a widget area. Font awesome must be installed for this to work.

********************* Dynamic Excerpt Lenghts *************************

using the pwd_excerpt() function in your theme files will print an excerpt with the number of words specified as a perameter. The default is 55 words.

e.g. pwd_excerpt(5) will print an excerpt of five words. 

********************* Updater *************************

This function allows an admin to update the plugin via git hub. This happens via github releases.





