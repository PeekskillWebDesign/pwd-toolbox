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

		href
			Default = ''
			adds location for link to go to

		content
			Default = ''
			adds the link text

	Optional:

		class
			Default =''
			adds class(es)

----------------------------------------------------









