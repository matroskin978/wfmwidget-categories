( function ( blocks, element, serverSideRender, blockEditor ) {
    var el = element.createElement,
        registerBlockType = blocks.registerBlockType,
        ServerSideRender = serverSideRender,
        useBlockProps = blockEditor.useBlockProps;


    registerBlockType( 'wfmwidget-block/block', {
        apiVersion: 2,
        title: 'Widget Categories',
        icon: 'list-view',
        category: 'widgets',

        edit: function ( props ) {
            var blockProps = useBlockProps();
            return el(
                'div',
                blockProps,
                el( ServerSideRender, {
                    block: 'wfmwidget-block/block',
                    attributes: props.attributes,
                } )
            );
        },
    } );
} )(
    window.wp.blocks,
    window.wp.element,
    window.wp.serverSideRender,
    window.wp.blockEditor
);
