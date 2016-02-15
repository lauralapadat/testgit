/*global wc_country_select_params */
jQuery( function( $ ) {

    // wc_country_select_params is required to continue, ensure the object exists
    if ( typeof wc_country_select_params === 'undefined' ) {
        return false;
    }

    function getEnhancedSelectFormatString() {
        var formatString = {
            formatMatches: function( matches ) {
                if ( 1 === matches ) {
                    return wc_country_select_params.i18n_matches_1;
                }

                return wc_country_select_params.i18n_matches_n.replace( '%qty%', matches );
            },
            formatNoMatches: function() {
                return wc_country_select_params.i18n_no_matches;
            },
            formatAjaxError: function() {
                return wc_country_select_params.i18n_ajax_error;
            },
            formatInputTooShort: function( input, min ) {
                var number = min - input.length;

                if ( 1 === number ) {
                    return wc_country_select_params.i18n_input_too_short_1;
                }

                return wc_country_select_params.i18n_input_too_short_n.replace( '%qty%', number );
            },
            formatInputTooLong: function( input, max ) {
                var number = input.length - max;

                if ( 1 === number ) {
                    return wc_country_select_params.i18n_input_too_long_1;
                }

                return wc_country_select_params.i18n_input_too_long_n.replace( '%qty%', number );
            },
            formatSelectionTooBig: function( limit ) {
                if ( 1 === limit ) {
                    return wc_country_select_params.i18n_selection_too_long_1;
                }

                return wc_country_select_params.i18n_selection_too_long_n.replace( '%qty%', limit );
            },
            formatLoadMore: function() {
                return wc_country_select_params.i18n_load_more;
            },
            formatSearching: function() {
                return wc_country_select_params.i18n_searching;
            }
        };

        return formatString;
    }

    // Semantic UI select dropdowns
    $( document.body ).bind( 'country_to_state_changed', function() {
        $( 'select.country_select:visible, select.state_select:visible' ).dropdown('refresh');
    });

    /* State/Country select boxes */
    var states_json = wc_country_select_params.countries.replace( /&quot;/g, '"' ),
        states = $.parseJSON( states_json );

    $( document.body ).on( 'change', 'div.country_to_state select, input.country_to_state', function() {
        var country = $( this ).val(),
            $statebox = $( this ).closest( 'form' ).find( '#billing_state, #shipping_state, #calc_shipping_state' ),
            $parent = $statebox.closest( 'div.form-row' ),
            input_name = $statebox.attr( 'name' ),
            input_id = $statebox.attr( 'id' ),
            value = $statebox.val(),
            placeholder = $statebox.attr( 'placeholder' );

        if ( states[ country ] ) {
            if ( $.isEmptyObject( states[ country ] ) ) {
                $parent.hide().find( '.ui.dropdown' ).dropdown('destroy').detach();

                if ( $statebox.is( '.hidden' ) ) {
                    $statebox.replaceWith( '<input type="hidden" class="hidden" disabled="disabled" name="' + input_name + '" id="' + input_id + '" value="" placeholder="' + placeholder + '" />' );
                } else {
                    $parent.append( '<input type="hidden" class="hidden" disabled="disabled" name="' + input_name + '" id="' + input_id + '" value="" placeholder="' + placeholder + '" />' );
                }

                $( document.body ).trigger( 'country_to_state_changed', [country, $( this ).closest( 'form' )] );

            } else {
                var options = '',
                    state = states[ country ];

                for( var index in state ) {
                    if ( state.hasOwnProperty( index ) ) {
                        options = options + '<option value="' + index + '">' + state[ index ] + '</option>';
                    }
                }

                $parent.show();

                if ( $statebox.is( 'input' ) ) {
                    // Change for select
                    $statebox.replaceWith( '<select name="' + input_name + '" id="' + input_id + '" class="ui search selection dropdown state_select" placeholder="' + placeholder + '"></select>' );
                    $statebox = $( this ).closest( 'form' ).find( '#billing_state, #shipping_state, #calc_shipping_state' );
                }

                $statebox.html( '<option value="">' + wc_country_select_params.i18n_select_state_text + '</option>' + options );
                $statebox.val( value ).change();

                $( document.body ).trigger( 'country_to_state_changed', [country, $( this ).closest( 'form' )] );

            }
        } else {
            if ( $statebox.is( 'select' ) ) {
                $parent.show().find( '.ui.dropdown' ).dropdown( 'destroy' ).detach();
                $parent.append( '<input type="text" class="input-text" name="' + input_name + '" id="' + input_id + '" placeholder="' + placeholder + '" />' );

                $( document.body ).trigger( 'country_to_state_changed', [country, $( this ).closest( 'form' )] );

            } else if ( $statebox.is( '.hidden' ) ) {
                if ( $statebox.is('input') ) {
                    $statebox.replaceWith( '<input type="text" class="input-text" name="' + input_name + '" id="' + input_id + '" placeholder="' + placeholder + '" />' );
                } else {
                    $parent.show().find( '.ui.dropdown' ).dropdown( 'destroy' ).detach();
                    $parent.append( '<input type="text" class="input-text" name="' + input_name + '" id="' + input_id + '" placeholder="' + placeholder + '" />' );
                }

                $( document.body ).trigger( 'country_to_state_changed', [country, $( this ).closest( 'form' )] );

            }
        }

        $( document.body ).trigger( 'country_to_state_changing', [country, $( this ).closest( 'form' )] );

    });

    $(function() {
        $( ':input.country_to_state' ).change();
    });

});
