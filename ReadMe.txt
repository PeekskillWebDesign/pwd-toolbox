PWD Shortcodes

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

Slick

	[slick]

	Required:

		post_type
			Default = ''
			adds specific custom post type to query

	Optional:

		class
			Default = 'slider'
			changes class of slider (use for multiple sliders)

		size
			Default = ''
			sets the size of the images for the slider. (use just as you sould the_post_thumbnail(xxx);)

		dots
			Default ='true'
			controls dot display

		arrows
			Default = 'true'
			controls arrow display

		autoplay
			Default = 'false'
			turns autoplay on/off

		autoplay_speed
			Default = '1000'
			sets autoplay speed if autoplay is set to true (milliseconds)

		slides_to_show
			Default = '1'
			sets the slides to show at a time in the slider

		fade
			Default = 'false'
			set to true to make the slides fade when transitioning

		enter_mode
			Default = 'false'
			use with odd number slides_to_show to display a centered image slider

		as_nav_for
			Default = null
			set the slider to control another slider e.g. ".slider"

		gallery
			Default = 'false'
			sets the slider to use the attachments of a single post as images for slider. MUST BE USED WITH gallery_id.

		gallery_id 
			Default= ''
			sets the id of the post used for attachments









