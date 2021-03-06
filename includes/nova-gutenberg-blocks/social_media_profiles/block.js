( function( blocks, components, editor, i18n, element ) {

	const el = element.createElement;

	/* Blocks */
	const registerBlockType   	= blocks.registerBlockType;

	const AlignmentToolbar		= editor.AlignmentToolbar;
	const BlockControls       	= editor.BlockControls;
	const InspectorControls   	= editor.InspectorControls;
	const ColorSettings			= editor.PanelColorSettings;

	const TextControl 			= components.TextControl;
	const RangeControl			= components.RangeControl;
	const SVG 					= components.SVG;
	const Path 					= components.Path;

	/* Register Block */
	registerBlockType( 'nova/th-social-media-profiles', {
		title: i18n.__( 'Social Media Profiles' ),
		icon:
			el( SVG, { xmlns:'http://www.w3.org/2000/svg', viewBox:'0 0 24 24' },
				el( Path, { d:'M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92s2.92-1.31 2.92-2.92c0-1.61-1.31-2.92-2.92-2.92zM18 4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM6 13c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm12 7.02c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z' } ),
			),
		category: 'reddot',
		attributes: {
			fontSize: {
				type: 	 'number',
				default: '16'
			},
			fontColor: {
				type: 	 'string',
				default: '#000'
			},
			align: {
				type: 	 'string',
				default: 'left'
			},
		},

		edit: function( props ) {

			var attributes = props.attributes;

			return [
				el(
					InspectorControls,
					{
						key: 'nova_18_th_socials_settings'
					},
					el(
						'div',
						{
							className: 'main-inspector-wrapper',
						},
						el(
							RangeControl,
							{
								key: "nova_18_th_socials_font_size",
								value: attributes.fontSize,
								allowReset: false,
								initialPosition: 16,
								min: 10,
								max: 36,
								label: i18n.__( 'Icons Font Size' ),
								onChange: function( newNumber ) {
									props.setAttributes( { fontSize: newNumber } );
								},
							}
						),
						el(
							ColorSettings,
							{
								key: 'nova_18_th_socials_icons_color',
								title: i18n.__( 'Icons Color' ),
								colorSettings: [
									{
										label: i18n.__( 'Icons Color' ),
										value: attributes.fontColor,
										onChange: function( newColor) {
											props.setAttributes( { fontColor: newColor } );
										},
									},
								]
							},
						),
					),
				),
				el(
					BlockControls,
					{
						key: 'nova_18_th_socials_alignment_controls'
					},
					el(
						AlignmentToolbar,
						{
							key: 'nova_18_th_socials_alignment',
							value: attributes.align,
							onChange: function( newAlignment ) {
								props.setAttributes( { align: newAlignment } );
							}
						}
					),
				),
				el(
					'div',
					{
						key: 'nova_18_th_editor_social_media_wrapper',
						className: 'nova_18_th_editor_social_media_wrapper'
					},
					el(
						'h4',
						{
							key: 'nova_18_th_editor_social_media_title',
							className: 'nova_18_th_editor_social_media_title',
						},
						el(
							'span',
							{
								key: 'nova_18_th_editor_social_media_icon',
								className: 'nova_18_th_editor_social_media_icon',
							},
							el( SVG, { xmlns:'http://www.w3.org/2000/svg', viewBox:'0 0 24 24' },
								el( Path, { d:'M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92s2.92-1.31 2.92-2.92c0-1.61-1.31-2.92-2.92-2.92zM18 4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM6 13c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm12 7.02c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z' } ),
							),
						),
						i18n.__('Social Media Icons')
					),
					el(
						'p',
						{
							key: 'nova_18_th_editor_social_media_setup',
							className: 'nova_18_th_editor_social_media_setup',
						},
						i18n.__('Setup profile links under Appearance > Customize > Social Media')
					),
				),
			];
		},

		save: function() {
			return '';
		},
	} );

} )(
	window.wp.blocks,
	window.wp.components,
	window.wp.editor,
	window.wp.i18n,
	window.wp.element
);
