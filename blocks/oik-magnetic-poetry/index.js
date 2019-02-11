/**
 * Implements Magnetic poetry a server rendered block
 *
 * Uses logic from oik-magnetic-poetry plugin
 *
 * @copyright (C) Copyright Bobbing Wide 2019
 * @author Herb Miller @bobbingwide
 */
//import './style.scss';
//import './editor.scss';

// Get just the __() localization function from wp.i18n
const { __ } = wp.i18n;
// Get registerBlockType from wp.blocks
const {
    registerBlockType,
} = wp.blocks;
const {
    InspectorControls,
    PlainText,
} = wp.editor;

const {
    Toolbar,
    PanelBody,
    PanelRow,
    FormToggle,
    ServerSideRender,
    TextControl,
    SelectControl,

} = wp.components;

import { map, partial } from 'lodash';
const Fragment = wp.element.Fragment;


/**
 * Register the WordPress block
 */
export default registerBlockType(
    // Namespaced, hyphens, lowercase, unique name
    'oik-block/magnetic-poetry',
    {
        // Localize title using wp.i18n.__()
        title: __( 'Magnetic Poetry' ),

        description: 'Write magnetic poetry refrigerator messages',

        // Category Options: common, formatting, layout, widgets, embed
        category: 'formatting',

        // Dashicons Options - https://goo.gl/aTM1DQ
        icon: 'editor-customchar',

        // Limit to 3 Keywords / Phrases
        keywords: [
            __( 'magnetic poetry' ),
            __( 'oik' ),
            __( 'verse'),
        ],

        // Set for each piece of dynamic data used in your block
        attributes: {

            content: {
                type: 'string',
            },


        },


        supports: {
            customClassName: false,
            className: false,
            html: false,
        },

        edit: props => {

            const onChangeContent = ( value ) => {
                props.setAttributes( { content: value } );
            };

            /**
             * Attempt a generic function to apply a change
             * using the partial technique
             *
             * key needs to be in [] otherwise it becomes a literal
             *
             */
            //onChange={ partial( handleChange, 'someKey' ) }

            function onChangeAttr( key, value ) {
                //var nextAttributes = {};
                //nextAttributes[ key ] = value;
                //setAttributes( nextAttributes );
                props.setAttributes( { [key] : value } );
            };

            const isSelected = props.isSelected;




            return (
                <Fragment>
                    <InspectorControls >
                        <PanelBody>

                            <PanelRow>

                            </PanelRow>

                        </PanelBody>

                    </InspectorControls>
                    {!isSelected &&
                    <ServerSideRender
                        block="oik-block/magnetic-poetry" attributes={props.attributes}
                    />
                    }

                    {isSelected &&
                    <div className="wp-block-oik-block-magnetic-poetry" key="content-input">
                        <PlainText
                            value={props.attributes.content}
                            placeholder={__('Write poetry')}
                            onChange={onChangeContent}
                        />
                    </div>
                    }


                </Fragment>

            );
        },


        save() {
            return null;
        },
    },
);
