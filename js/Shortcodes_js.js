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

            //-----------------------------------container button   
            ed.addButton("section_button", {
                title : "Section",
                cmd : "section_command",
                text : 'Section'
            });

            //-----------------------------------container button functionality
            ed.addCommand("section_command", function() {
                var selected_text = ed.selection.getContent();
                var return_text = '[section class=""]' + selected_text + "[/section]";
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


             //-----------------------------------Accordian Contain button   
            ed.addButton("acc_contain_button", {
                title : "the_Accordian",
                cmd : "accordian_contain_command",
                text : 'Accordian'
            });

            //-----------------------------------Accordian Contain functionality
            ed.addCommand("accordian_contain_command", function() {
                var selected_text = ed.selection.getContent();
                var return_text = '[acc-container class=""]' + selected_text + "[/acc-container]";
                ed.execCommand("mceInsertContent", 0, return_text);
            });
            //-----------------------------------Accordian Title button   
            ed.addButton("acc_title_button", {
                title : "Accordian_Title",
                cmd : "accordian_title_command",
                text : 'Accordian Title'
            });

            //-----------------------------------Accordian Title functionality
            ed.addCommand("accordian_title_command", function() {
                var selected_text = ed.selection.getContent();
                var return_text = '[acc-title class=""]' + selected_text + "[/acc-title]";
                ed.execCommand("mceInsertContent", 0, return_text);
            });
            //-----------------------------------Accordian Title button   
            ed.addButton("acc_content_button", {
                title : "Accordian_Content",
                cmd : "accordian_content_command",
                text : 'Accordian Content'
            });

            //-----------------------------------Accordian Title functionality
            ed.addCommand("accordian_content_command", function() {
                var selected_text = ed.selection.getContent();
                var return_text = '[acc-content class=""]' + selected_text + "[/acc-content]";
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