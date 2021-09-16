( function ( $ ) {

var item_type = [ 'uael', 'uael_section', 'uael_column' ];
var item_type_elementor_hook = [ 'widget', 'column', 'section' ];

xsLocalStorage.init(
    {
        iframeUrl: uael_cross_domain.cross_domain_cdn,
        initCallback: function () {}
    }
);

UAE_Cross_Domain_Handler = {
    paste: function( bsf_container, element ) {

        var container = null,
            element_location = {
                index: 0
            },
            copied_widget_details = bsf_container.widgetCode,
            copied_widget_details_string = JSON.stringify( copied_widget_details ),
            copied_widget_type = copied_widget_details.elType,
            media_check = /\.(jpg|png|jpeg|gif|svg)/gi.test( copied_widget_details_string ),
            copied_widget = {
                elType: copied_widget_type,
                settings: copied_widget_details.settings
            },
            current_element = element,
            current_element_type = element.model.get( "elType" );
    
            switch( copied_widget_type ){
                case 'section':
                    copied_widget.elements = UAE_Cross_Domain_Handler.generateUniqueID( copied_widget_details.elements );
                    container = elementor.getPreviewContainer();
                    switch( current_element_type ){
                        case 'widget':
                            element_location.index = current_element.getContainer().parent.parent.view.getOption( "_index" ) + 1;
                            break;
                        case 'column':
                            element_location.index = current_element.getContainer().parent.view.getOption( "_index" ) + 1;
                            break;
                        case 'section':
                            element_location.index = current_element.getOption( "_index" ) + 1;
                            break;
                    }
                    break;
                case 'column':
                    copied_widget.elements = UAE_Cross_Domain_Handler.generateUniqueID( copied_widget_details.elements );
                    switch( current_element_type ){
                        case 'widget':
                            container = current_element.getContainer().parent.parent;
                            element_location.index = current_element.getContainer().parent.view.getOption( "_index" ) + 1;
                            break;
                        case 'column':
                            container = current_element.getContainer().parent;
                            element_location.index = current_element.getOption( "_index" ) + 1;
                            break;
                        case 'section':
                            container = current_element.getContainer();
                            break;
                    }
                    break;
                case 'widget':
                    copied_widget.widgetType = copied_widget_details.widgetType;
                    container = current_element.getContainer();
                    switch( current_element_type ){
                        case 'widget':
                            container = current_element.getContainer().parent;
                            element_location.index = current_element.getOption( "_index" ) + 1;
                            break;
    
                        case 'column':
                            container = current_element.getContainer();
                            break;
    
                        case 'section':
                            container = current_element.children.findByIndex(0).getContainer();
                            break;
    
                    }
                    break;
            }
    
        var new_element = $e.run( "document/elements/create", {
            model: copied_widget,
            container: container,
            options: element_location
        });
    
        if( undefined == new_element ) {
            if ( "widget" === current_element_type ) {
                if( current_element.$el.next( '.undefined.elementor-widget-empty' )  ) {
                    current_element.$el.next( '.undefined.elementor-widget-empty' ).after( '<div class="elementor-alert elementor-alert-warning">' + uael_cross_domain.widget_not_found + '</div>' );
                }
            } else {
                if( current_element.$el.find( '.undefined.elementor-widget-empty' ) ) {
                    current_element.$el.find( '.undefined.elementor-widget-empty' ).after( '<div class="elementor-alert elementor-alert-warning">' + uael_cross_domain.widget_not_found + '</div>' );
                }
            }
        }
    
        if ( media_check ) {
            jQuery.ajax({
                url: uael_cross_domain.ajaxURL,
                method: "POST",
                data: {
                    nonce: uael_cross_domain.nonce,
                    action: "uael_process_import",
                    content: copied_widget_details_string
                },
                beforeSend: function () {
                    new_element.view.$el.addClass( "uael-processing-import" );
                }
            }).done( function ( response ) {
                if ( response.success ) {
    
                    var media_element = response.data[0];
                    copied_widget.elType = media_element.elType;
                    copied_widget.settings = media_element.settings;
    
                    if( "widget" === copied_widget.elType ) {
                        copied_widget.widgetType = media_element.widgetType;
                    } else {
                        copied_widget.elements = media_element.elements;
                    }
    
                    $e.run( "document/elements/delete", {
                        container: new_element
                    });
    
                    $e.run( "document/elements/create", {
                        model: copied_widget,
                        container: container,
                        options: element_location
                    });
                }
            })
        }
    
    },
    
    generateUniqueID: function( elements ) {
    
        elements.forEach( function( item, index ) {
            item.id = elementor.helpers.getUniqueID();
            if( item.elements.length > 0 ) {
                UAE_Cross_Domain_Handler.generateUniqueID( item.elements );
            }
        } );
    
        return elements;
    }
    
}

item_type.forEach( function( item, index ) {
    elementor.hooks.addFilter( 'elements/' + item_type_elementor_hook[index] + '/contextMenuGroups', function ( groups, element ) {
        var loop_element = this;
        groups.push(
            {
                name: item_type[index],
                actions: [
                    {
                        name: 'copy',
                        title: uael_cross_domain.uae_copy,
                        icon: uael_cross_domain.cross_domain_icon,
                        callback: function () {
                            var widgetType = element.model.get( "widgetType" ),
                                widgetCode = element.model.toJSON(),
                                bsf_container = {
                                    widgetType : widgetType,
                                    widgetCode : widgetCode
                                };
                                xsLocalStorage.setItem( 'bsf_uael_container_new', JSON.stringify( bsf_container ) );

                        }
                    },
                    {
                        name: 'paste',
                        title: uael_cross_domain.uae_paste,
                        icon: uael_cross_domain.cross_domain_icon,
                        callback: function () {
                            var bsf_container = '';
                            xsLocalStorage.getItem( 'bsf_uael_container_new', function ( loop_element ) {
                                bsf_container = JSON.parse( loop_element.value );
                                UAE_Cross_Domain_Handler.paste( bsf_container, element );
                            });

                        }
                    }
                ]
            }
        );
        return groups;
    });
});

} )( jQuery );  
