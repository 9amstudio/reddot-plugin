( function( blocks ) {
	var blockCategories = blocks.getCategories();
	blockCategories.unshift({ 'slug': 'reddot', 'title': 'Nova Reddot Blocks'});
	blocks.setCategories(blockCategories);
})(
	window.wp.blocks
);
