jQuery(document).ready(function() {

	//Check for change in revision dropdown and redirect to URL with &revision=value param
	jQuery('#edit_file_revisions_select').change(function() {
		var revision = this.value;
		var revision = 1;
		var urlBase = window.location.toString();
		var newUrl;

		//URL GET parameters
		var revisionParamBase = location.search.split('revision=')[0];
		var revisionParam = location.search.split('revision=')[1];

		if(typeof(revisionParam) == 'undefined') {
			newUrl = urlBase + '&revision=' + revision;
		} else {
			var tmpUrl = urlBase.substr(0, urlBase.indexOf('&revision=') );
			newUrl = tmpUrl + '&revision=' + revision;
		}

		location.href = newUrl;
	})
})