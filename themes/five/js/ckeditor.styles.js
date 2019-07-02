/*
Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/*
 * This file is used/requested by the 'Styles' button.
 * The 'Styles' button is not enabled by default in DrupalFull and DrupalFiltered toolbars.
 */
if(typeof(CKEDITOR) !== 'undefined') {
    CKEDITOR.addStylesSet( 'drupal',
    [
            /* Block Styles */

            // These styles are already available in the "Format" drop-down list, so they are
            // not needed here by default. You may enable them to avoid placing the
            // "Format" drop-down list in the toolbar, maintaining the same features.

            { name : 'Paragraph'		, element : 'p' },
            { name : 'Heading 1'		, element : 'h1' },
            { name : 'Heading 2'		, element : 'h2' },
            { name : 'Heading 3'		, element : 'h3' },
            { name : 'Heading 4'		, element : 'h4' },
            { name : 'Heading 5'		, element : 'h5' },
            { name : 'Heading 6'		, element : 'h6' },
            { name : 'Preformatted Text', element : 'pre' },
            { name : 'Address'			, element : 'address' },


				/* Position Styles */
				// These are used to position content around the page.
				{ name: 'white box', element: 'div', attributes: { 'class': 'white-bg' } },
				{ name: 'float right', element: 'div', attributes: { 'class': 'float-right' } },
				{ name: 'expand', element: 'div', attributes: { 'class': 'expand' } },
				{ name: 'row', element: 'div', attributes: { 'class': 'row' } },
				{ name: 'col-12', element: 'div', attributes: { 'class': 'col-md-12' } },
				{ name: 'col-10', element: 'div', attributes: { 'class': 'col-md-10' } },
				{ name: 'col-8', element: 'div', attributes: { 'class': 'col-md-8' } },
				{ name: 'col-6', element: 'div', attributes: { 'class': 'col-md-6' } },
				{ name: 'col-4', element: 'div', attributes: { 'class': 'col-md-4' } },
				{ name: 'col-2', element: 'div', attributes: { 'class': 'col-md-2' } },


            /*
{ name : 'Blue Title'		, element : 'h3', styles : { 'color' : 'Blue' } },
            { name : 'Red Title'		, element : 'h3', styles : { 'color' : 'Red' } },
*/

            /* Inline Styles */

            // These are core styles available as toolbar buttons. You may opt enabling
            // some of them in the "Styles" drop-down list, removing them from the toolbar.
            /*
            { name : 'Strong'			, element : 'strong', overrides : 'b' },
            { name : 'Emphasis'			, element : 'em'	, overrides : 'i' },
            { name : 'Underline'		, element : 'u' },
            { name : 'Strikethrough'	, element : 'strike' },
            { name : 'Subscript'		, element : 'sub' },
            { name : 'Superscript'		, element : 'sup' },
            */

            /*
{ name : 'Marker: Yellow'	, element : 'span', styles : { 'background-color' : 'Yellow' } },
            { name : 'Marker: Green'	, element : 'span', styles : { 'background-color' : 'Lime' } },

            { name : 'Big'				, element : 'big' },
            { name : 'Small'			, element : 'small' },
            { name : 'Typewriter'		, element : 'tt' },

            { name : 'Computer Code'	, element : 'code' },
            { name : 'Keyboard Phrase'	, element : 'kbd' },
            { name : 'Sample Text'		, element : 'samp' },
            { name : 'Variable'			, element : 'var' },

            { name : 'Deleted Text'		, element : 'del' },
            { name : 'Inserted Text'	, element : 'ins' },

            { name : 'Cited Work'		, element : 'cite' },
            { name : 'Inline Quotation'	, element : 'q' },

            { name : 'Language: RTL'	, element : 'span', attributes : { 'dir' : 'rtl' } },
            { name : 'Language: LTR'	, element : 'span', attributes : { 'dir' : 'ltr' } },
*/

            /* Object Styles */

            {
                    name : 'Image on Left',
                    element : 'img',
                    attributes :
                    {
                            'class' : 'img-left'
                    }
            },

            {
                    name : 'Image on Right',
                    element : 'img',
                    attributes :
                    {
                            'class' : 'img-right'
                    }
            },

            {
                    name : 'Image full width',
                    element : 'img',
                    attributes :
                    {
                            'class' : 'file-100',
                    }
            },

            {
                    name : 'OGA Button',
                    element : 'a',
                    attributes :
                    {
                            'class' : 'oga-plaid'
                    }
            },

            {
                    name : 'JGA Button',
                    element : 'a',
                    attributes :
                    {
                            'class' : 'jga-plaid'
                    }
            },

            {
                    name : 'Green Button',
                    element : 'a',
                    attributes :
                    {
                            'class' : 'green'
                    }
            },

            {
                    name : 'Blue Button',
                    element : 'a',
                    attributes :
                    {
                            'class' : 'blue'
                    }
            },

            {
                    name : 'Yellow Button',
                    element : 'a',
                    attributes :
                    {
                            'class' : 'yellow'
                    }
            },

            {
                    name : 'Show caption align right',
                    element : 'img',
                    attributes :
                    {
                            'class' : 'caption',
                            'align' : 'right'
                    }
            },

            {
                    name : 'Show caption align left',
                    element : 'img',
                    attributes :
                    {
                            'class' : 'caption',
                            'align' : 'left'
                    }
            },

            {
                    name : 'Show caption',
                    element : 'img',
                    attributes :
                    {
                            'class' : 'caption',
                    }
            },


{
                    name : 'Responsive table',
                    element : 'table',
                    attributes :
                    {
                            'class' : 'responsive-enabled'
                    }
            },

            {
                    name : 'Default priority',
                    element : 'td',
                    attributes :
                    {
                            'class' : 'default'
                    }
            },

            {
                    name : 'Medium priority',
                    element : 'td',
                    attributes :
                    {
                            'class' : 'medium priority'
                    }
            },

            {
                    name : 'Low priority',
                    element : 'td',
                    attributes :
                    {
                            'class' : 'medium priority'
                    }
            },


    ]);
}
