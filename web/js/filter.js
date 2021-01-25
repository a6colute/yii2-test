$(document).ready(function() {
	var priceFrom = parseInt($('#filter-form input[name=priceFrom]').val());
	var priceTo = parseInt($('#filter-form input[name=priceTo]').val());
	
	function sendFilter() {
		var url = $(location).attr('href').split('?')[0];
		var params = [];  
		
		if ((filterPriceFrom = $('#filter-form input[type=text][name=priceFrom]').val()) !== '') {
			params.push('priceFrom=' + filterPriceFrom);
		}
		
		if ((filterPriceTo = $('#filter-form input[type=text][name=priceTo]').val()) !== '') {
			params.push('priceTo=' + filterPriceTo);
		}
		
		var attr = new Map();
		
		$('#filter-form input[type=checkbox]:checked').each(function() {
			var key = $(this).attr('name').replace('[]', '');
			if (attr.has(key)) {
				attr.set(key, attr.get(key) + ',' + $(this).val());
			} else {
				attr.set(key, $(this).val());
			}
		});
		
		attr.forEach(function(value,key) {
			params.push(key + '=' + value); 
		});
		
		if (params.length !== 0) {
			url += '?' + params.join('&');
		}
		
		location.href = url;
	}
	
	$('#filter-form input[type=checkbox]').change(function() {
		sendFilter();
	});
	
	$('#filter-form input[name=priceFrom]').mouseout(function() {
		var newPriceFrom = parseInt($(this).val());
		if (priceFrom !== newPriceFrom) {
			priceFrom = newPriceFrom;
			sendFilter();
		}
	});
	
	$('#filter-form input[name=priceTo]').mouseout(function() {
		var newPriceTo = parseInt($(this).val());
		if (priceTo !== newPriceTo) {
			priceTo = newPriceTo;
			sendFilter();
		}
	});
});