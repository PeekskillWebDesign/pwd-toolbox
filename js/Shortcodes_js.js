//To add a button to the wordpress editor copy the button and button functionality code. Edit all of the fields to match your button. Then add it to the array_push in the main plugin file.

(function() {
    tinymce.create("tinymce.plugins.shortcode_plugin", {

        //url argument holds the absolute url of our plugin directory
        init : function(ed, url) {

            //-----------------------------------columns button
            ed.addButton("column_button", {
                title : "Columns",
                cmd : "col_command",
                text : 'Columns'
            });

            //-----------------------------------columns button functionality
            ed.addCommand("col_command", function() {
                var selected_text = ed.selection.getContent();
                var return_text = '[col columns="" offset="" class=""]' + selected_text + "[/col]";
                ed.execCommand("mceInsertContent", 0, return_text);
            });

            //-----------------------------------row button   
            ed.addButton("row_button", {
                title : "Row",
                cmd : "row_command",
                text : 'Row'
            });

            //-----------------------------------row button functionality
            ed.addCommand("row_command", function() {
                var selected_text = ed.selection.getContent();
                var return_text = '[row class=""]' + selected_text + "[/row]";
                ed.execCommand("mceInsertContent", 0, return_text);
            });

             //-----------------------------------container button   
            ed.addButton("container_button", {
                title : "Container",
                cmd : "container_command",
                text : 'Container'
            });

            //-----------------------------------container button functionality
            ed.addCommand("container_command", function() {
                var selected_text = ed.selection.getContent();
                var return_text = '[container class=""]' + selected_text + "[/container]";
                ed.execCommand("mceInsertContent", 0, return_text);
            });

             //-----------------------------------link button   
            ed.addButton("link_button", {
                title : "Link",
                cmd : "link_command",
                text : 'Link'
            });

            //-----------------------------------container button functionality
            ed.addCommand("link_command", function() {
                var selected_text = ed.selection.getContent();
                var return_text = '[link link-to="" class=""]' + selected_text + "[/link]";
                ed.execCommand("mceInsertContent", 0, return_text);
            });

        },

        createControl : function(n, cm) {
            return null;
        },

        getInfo : function() {
            return {
                longname : "Extra Buttons",
                author : "Narayan Prusty",
                version : "1"
            };
        }
    });

    tinymce.PluginManager.add("shortcode_plugin", tinymce.plugins.shortcode_plugin);
})();