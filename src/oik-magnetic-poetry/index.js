/**
 * Implements Magnetic poetry a server rendered block
 *
 * Uses logic from oik-magnetic-poetry plugin
 *
 * @copyright (C) Copyright Bobbing Wide 2019, 2020, 2021, 2024
 * @author Herb Miller @bobbingwide
 */
import './style.scss';
import './editor.scss';

import { __ } from '@wordpress/i18n';
import clsx from 'clsx';
import { registerBlockType, createBlock } from '@wordpress/blocks';
import {AlignmentControl, BlockControls, InspectorControls, useBlockProps, PlainText} from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';
import {
	Toolbar,
	PanelBody,
	PanelRow,
	FormToggle,
	TextControl,
	SelectControl } from '@wordpress/components';
import { Fragment} from '@wordpress/element';
import { map, partial } from 'lodash';

/**
 * Register the WordPress block
 */
export default registerBlockType( 'oik-mp/magnetic-poetry',
	{
        example: {
        },
        transforms: {
            from: [
                {
                    type: 'block',
                    blocks: ['core/verse'],
                    transform: function( attributes ) {
                        return createBlock( 'oik-mp/magnetic-poetry', {
                            content: attributes.content,
                        });
                    },
                },
                {
                    type: 'block',
                    blocks: ['oik-block/magnetic-poetry'],
                    transform: function( attributes ) {
                        return createBlock( 'oik-mp/magnetic-poetry', {
                            content: attributes.content,
                        });
                    },
                },
            ],
            to: [
                {
                    type: 'block',
                    blocks: ['core/verse'],
                    transform: function( attributes ) {
                        return createBlock( 'core/verse', {
                            content: attributes.content,
                        });
                    },
                },
             ]
        },

        edit: props => {

			const { textAlign, label } = props.attributes;

			const blockProps = useBlockProps( {
				className: clsx( {
					[ `has-text-align-${ textAlign }` ]: textAlign,
				} ),
			} );

            const onChangeContent = ( value ) => {
                props.setAttributes( { content: value } );
            };

            const isSelected = props.isSelected;

            return (
                <Fragment>
					<BlockControls>
						<AlignmentControl
							value={ textAlign }
							onChange={ ( nextAlign ) => {
								props.setAttributes( { textAlign: nextAlign } );
							} }
						/>
					</BlockControls>

                    {!isSelected &&
					<div { ...blockProps}>
                    	<ServerSideRender
                        block="oik-mp/magnetic-poetry" attributes={props.attributes}
                    	/>
					</div>
                    }

                    {isSelected &&

					<div { ...blockProps}>
                        <PlainText
                            value={props.attributes.content}
                            placeholder={__('Write poetry','oik-magnetic-poetry')}
                            onChange={onChangeContent}
                        />
                    </div>
                    }
                </Fragment>
            );
        }
    },
);
