var cat_html = ''
    var category_links = ''
    $(".single-portfolio .portfolio-category span").each(function( index ) {
    	 var portfolio_cat_arr = $(this).text().split(',')
    	
    	 var new_portfolio_cat_arr = [];
    	 i = 0;
    	 jQuery.each(portfolio_cat_arr, $.proxy(function(index, cat) {

    	 	//Remove space at beginning of string if its there
    	 	function ltrim(cat) {
			  if(!cat) return cat;
			  return cat.replace(/^\s+/g, '');
			}
		    var cat_name = ltrim(cat);

		    //Create slug from name
		    var cat_slug = cat_name.replace(/\s+/g, '-').toLowerCase();

		    //Build URL to category archive page
            var cat_url = '<a href="'+ '/portfolio-category/' + cat_slug + '">' + cat_name + '</a>'

            //Create array of all the link markup
            new_portfolio_cat_arr[i++] = cat_url;

            //Turn array intro comma separated string
            category_links = new_portfolio_cat_arr.join();

		}, this));

    	 //Replace category span with these links
    	 $(this).html(category_links);

	});