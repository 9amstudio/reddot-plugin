(function(blocks, components, editor, i18n, element) {

  const el = element.createElement;

  /* Blocks */
  const registerBlockType = blocks.registerBlockType;

  const AlignmentToolbar = editor.AlignmentToolbar;
  const BlockControls = editor.BlockControls;
  const InspectorControls = editor.InspectorControls;
  const ColorSettings = editor.PanelColorSettings;

  const TextControl = components.TextControl;
  const RangeControl = components.RangeControl;
  const SVG = components.SVG;
  const Path = components.Path;

  /* Register Block */
  registerBlockType('novaworks/contact-stores', {
    title: i18n.__('Contact Stores'),
    icon: 'format-image',
    category: 'reddot',
    attributes: {
      imgURL: {
        type: 'string',
        attribute: 'src',
        selector: 'img',
        default: '',
      },
      imgID: {
        type: 'number',
      },
      imgAlt: {
        type: 'string',
        attribute: 'alt',
        selector: 'img',
      },
      fontSize: {
        type: 'number',
        default: '16'
      },
      fontColor: {
        type: 'string',
        default: '#000'
      },
      align: {
        type: 'string',
        default: 'left'
      },
    },

    edit: function(props) {

      var attributes = props.attributes;

      return [
        el(
          InspectorControls, {
            key: 'nova_18_th_socials_settings'
          },
          el(
            'div', {
              className: 'main-inspector-wrapper',
            },
            el(
              RangeControl, {
                key: "nova_18_th_socials_font_size",
                value: attributes.fontSize,
                allowReset: false,
                initialPosition: 16,
                min: 10,
                max: 36,
                label: i18n.__('Icons Font Size'),
                onChange: function(newNumber) {
                  props.setAttributes({
                    fontSize: newNumber
                  });
                },
              }
            ),
            el(
              ColorSettings, {
                key: 'nova_18_th_socials_icons_color',
                title: i18n.__('Icons Color'),
                colorSettings: [{
                  label: i18n.__('Icons Color'),
                  value: attributes.fontColor,
                  onChange: function(newColor) {
                    props.setAttributes({
                      fontColor: newColor
                    });
                  },
                }, ]
              },
            ),
          ),
        ),
        el(
          BlockControls, {
            key: 'nova_18_th_socials_alignment_controls'
          },
          el(
            AlignmentToolbar, {
              key: 'nova_18_th_socials_alignment',
              value: attributes.align,
              onChange: function(newAlignment) {
                props.setAttributes({
                  align: newAlignment
                });
              }
            }
          ),
        ),
        el(
          'div', {
            key: 'nova_contact_stores_editor_wrapper',
            className: 'nova_contact_stores_editor_wrapper',
            style: {
              backgroundImage: 'url(' + attributes.imgURL + ')'
            }
          },
        ),
      ];
    },

    save: function() {
      return '';
    },
  });

})(
  window.wp.blocks,
  window.wp.components,
  window.wp.editor,
  window.wp.i18n,
  window.wp.element
);
