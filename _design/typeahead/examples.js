$(document).ready(function() {
	// remote
	var bestPictures = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		prefetch: 'post_1960.json',
		remote: 'queries.php?%QUERY.json'
	});
	bestPictures.initialize();

	$('#remote .typeahead').typeahead(null, {
		name: 'best-pictures',
		displayKey: 'value',
		source: bestPictures.ttAdapter()
	});

	// custom templates
	$('#custom-templates .typeahead').typeahead(null, {
		name: 'best-pictures',
		displayKey: 'value',
		source: bestPictures.ttAdapter(),
		templates: {
			empty: [
				'<div class="empty-message">',
				'unable to find any Best Picture winners that match the current query',
				'</div>'
			].join('\n'),
			suggestion: Handlebars.compile('<p><strong>{{value}}</strong> â€“ {{year}}</p>')
		}
	});
});