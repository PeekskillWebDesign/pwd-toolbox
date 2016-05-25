//To add a button to the wordpress editor copy the button and button functionality code. Edit all of the fields to match your button. Then add it to the array_push in the main plugin file.

(function() {
    tinymce.create("tinymce.plugins.shortcode_plugin", {

        //url argument holds the absolute url of our plugin directory
        init : function(ed, url) {

            //-----------------------------------columns button
        ed.addButton("pwd_button", {
            title:'pwd_toolbox',
            text:'PWD Toolbox',
            type:'listbox',
            values: [
            // COLUMNS
                {
                title : "Columns",
                text : 'Columns',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Columns',
                        body: [
                            {type: 'listbox', //COLUMNS
                            values: [
                                { text: 'One', value: 'one' },
                                { text: 'Two', value: 'two' },
                                { text: 'Three', value: 'three' },
                                { text: 'Four', value: 'four' },
                                { text: 'Five', value: 'five' },
                                { text: 'Six', value: 'six' },
                                { text: 'Seven', value: 'seven' },
                                { text: 'Eight', value: 'eight' },
                                { text: 'Nine', value: 'nine' },
                                { text: 'Ten', value: 'ten' },
                                { text: 'Eleven', value: 'eleven' },
                                { text: 'Twelve', value: 'twelve' },
                            ], name: 'columns', label: 'Columns'},
                            {type: 'listbox',  //OFFSET
                            values: [
                                { text: 'One', value: 'one' },
                                { text: 'Two', value: 'two' },
                                { text: 'Three', value: 'three' },
                                { text: 'Four', value: 'four' },
                                { text: 'Five', value: 'five' },
                                { text: 'Six', value: 'six' },
                                { text: 'Seven', value: 'seven' },
                                { text: 'Eight', value: 'eight' },
                                { text: 'Nine', value: 'nine' },
                                { text: 'Ten', value: 'ten' },
                                { text: 'Eleven', value: 'eleven' },
                                { text: 'Twelve', value: 'twelve' },
                            ], name: 'offset', label: 'Offset by'},
                            {type: 'textbox', name: 'class', label: 'Class'}
                        ],
                        onsubmit: function(e) {    
                            var selected_text = ed.selection.getContent();
                            var return_text = '[col columns="'+e.data.columns+'" offset="'+e.data.offset+'" class="'+e.data.class+'"]' + selected_text + "[/col]";
                            ed.execCommand("mceInsertContent", 0, return_text);
                        }
                    });
                }
            },
            {
                title : "Row",
                text : 'Row',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Row',
                        body: [
                            {type: 'textbox', name: 'class', label: 'Class'}
                        ],
                        onsubmit: function(e) {    
                            var selected_text = ed.selection.getContent();
                            var selected_text = ed.selection.getContent();
                            var return_text = '[row class="'+e.data.class+'"]' + selected_text + "[/row]";
                            ed.execCommand("mceInsertContent", 0, return_text);
                        }
                    });
                }
            },
            {
                title : "Container",
                text : 'Container',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Container',
                        body: [
                            {type: 'textbox', name: 'class', label: 'Class'}
                        ],
                        onsubmit: function(e) {    
                            var selected_text = ed.selection.getContent();
                            var selected_text = ed.selection.getContent();
                            var return_text = '[container class="'+e.data.class+'"]' + selected_text + "[/container]";
                            ed.execCommand("mceInsertContent", 0, return_text);
                        }
                    });
                }
            },
            {
                title : "Section",
                text : 'Section',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Section',
                        body: [
                            {type: 'textbox', name: 'class', label: 'Class'}
                        ],
                        onsubmit: function(e) {    
                            var selected_text = ed.selection.getContent();
                            var selected_text = ed.selection.getContent();
                            var return_text = '[section class="'+e.data.class+'"]' + selected_text + "[/section]";
                            ed.execCommand("mceInsertContent", 0, return_text);
                        }
                    });
                }
            },

            {
                title : "the_Accordion",
                text : 'Accordion Container',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Accordion Container',
                        body: [
                            {type: 'textbox', name: 'class', label: 'Class'}
                        ],
                        onsubmit: function(e) {    
                            var selected_text = ed.selection.getContent();
                            var selected_text = ed.selection.getContent();
                            var return_text = '[acc-container class="'+e.data.class+'"]' + selected_text + "[/acc-container]";
                            ed.execCommand("mceInsertContent", 0, return_text);
                        }
                    });
                }
            },
            {
                title : "Accordion_Title",
                text : 'Accordion Title',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Accordion Title',
                        body: [
                            {type: 'textbox', name: 'class', label: 'Class'}
                        ],
                        onsubmit: function(e) {    
                            var selected_text = ed.selection.getContent();
                            var selected_text = ed.selection.getContent();
                            var return_text = '[acc-title class="'+e.data.class+'"]' + selected_text + "[/acc-title]";
                            ed.execCommand("mceInsertContent", 0, return_text);
                        }
                    });
                }
            },
            {
                title : "Accordion_Content",
                text : 'Accordion Content',
                onclick : function() {
                    ed.windowManager.open({
                        title: 'Accordion Content',
                        body: [
                            {type: 'textbox', name: 'class', label: 'Class'}
                        ],
                        onsubmit: function(e) {    
                            var selected_text = ed.selection.getContent();
                            var selected_text = ed.selection.getContent();
                            var return_text = '[acc-content class="'+e.data.class+'"]' + selected_text + "[/acc-content]";
                            ed.execCommand("mceInsertContent", 0, return_text);
                        }
                    });
                }
            },
        ]
        });
            

            // BUTTON WITHOUT POPUP
            // //-----------------------------------Accordian Title button   
            // ed.addButton("acc_content_button", {
            //     title : "Accordian_Content",
            //     cmd : "accordian_content_command",
            //     text : 'Accordian Content'
            // });

            // //-----------------------------------Accordian Title functionality
            // ed.addCommand("accordian_content_command", function() {
            //     var selected_text = ed.selection.getContent();
            //     var return_text = '[acc-content class=""]' + selected_text + "[/acc-content]";
            //     ed.execCommand("mceInsertContent", 0, return_text);
            // });

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