tinyMCEPopup.requireLangPack();

var IhfShortcodeSelector = {
	init: function() {
	},
	insertFeaturedListings: function(theForm) {
		var slug = this.getFieldValue(theForm.slug);
		var parameters = {
			sortBy: this.getFieldValue(theForm.sortBy),
			propertyType: this.getFieldValue(theForm.propertyType),
			displayType: this.getFieldValue(theForm.displayType),
			resultsPerPage: this.getFieldValue(theForm.resultsPerPage),
			header: this.getFieldValue(theForm.header),
			includeMap: this.getFieldValue(theForm.includeMap),
			status: this.getFieldValue(theForm.status)
		};
		this.buildShortcode(slug, parameters);
	},
	insertHotSheetListingReport: function(theForm) {
		var slug = this.getFieldValue(theForm.slug);
		var parameters = {
			id: this.getFieldValue(theForm.hotSheetId),
			sortBy: this.getFieldValue(theForm.sortBy),
			displayType: this.getFieldValue(theForm.displayType),
			resultsPerPage: this.getFieldValue(theForm.resultsPerPage),
			header: this.getFieldValue(theForm.header),
			includeMap: this.getFieldValue(theForm.includeMap),
			status: this.getFieldValue(theForm.status)
		};
		this.buildShortcode(slug, parameters);
	},
	insertHotSheetOpenHomeReport: function(theForm) {
		var slug = this.getFieldValue(theForm.slug);
		var parameters = {
			id: this.getFieldValue(theForm.hotSheetId),
			sortBy: this.getFieldValue(theForm.sortBy),
			header: this.getFieldValue(theForm.header),
			includeMap: this.getFieldValue(theForm.includeMap)
		};
		this.buildShortcode(slug, parameters);
	},
	insertHotSheetMarketReport: function(theForm) {
		var slug = this.getFieldValue(theForm.slug);
		var parameters = {
			id: this.getFieldValue(theForm.hotSheetId),
			header: this.getFieldValue(theForm.header),
			columns: this.getFieldValue(theForm.columns)
		};
		this.buildShortcode(slug, parameters);
	},
	insertSearchResults: function(theForm) {
		var slug = this.getFieldValue(theForm.slug);
		var parameters = {
			cityId: this.getFieldValue(theForm.cityId),
			propertyType: this.getFieldValue(theForm.propertyType),
			bed: this.getFieldValue(theForm.bed),
			bath: this.getFieldValue(theForm.bath),
			minPrice: this.getFieldValue(theForm.minPrice),
			maxPrice: this.getFieldValue(theForm.maxPrice),
			sortBy: this.getFieldValue(theForm.sortBy),
			displayType: this.getFieldValue(theForm.displayType),
			resultsPerPage: this.getFieldValue(theForm.resultsPerPage),
			header: this.getFieldValue(theForm.header),
			includeMap: this.getFieldValue(theForm.includeMap),
			status: this.getFieldValue(theForm.status)
		};
		this.buildShortcode(slug, parameters);
	},
	insertGallerySlider: function(theForm) {
		var slug = this.getFieldValue(theForm.slug);
		var parameters = {};
		parameters["id"] = this.getFieldValue(theForm.hotSheetId);
		if(theForm.fitToWidth == undefined || theForm.fitToWidth.checked == false) {
			parameters["width"] = this.getFieldValue(theForm.width);
		}
		parameters["height"] = this.getFieldValue(theForm.height);
		parameters["rows"] = this.getFieldValue(theForm.rows);
		parameters["nav"] = this.getFieldValue(theForm.nav);
		parameters["style"] = this.getFieldValue(theForm.style);
		parameters["columns"] = this.getFieldValue(theForm.columns);
		parameters["effect"] = this.getFieldValue(theForm.effect);
		parameters["auto"] = this.getFieldValue(theForm.auto);
		parameters["interval"] = this.getFieldValue(theForm.interval);
		parameters["status"] = this.getFieldValue(theForm.status);
		parameters["sortBy"] = this.getFieldValue(theForm.sortBy);
		parameters["maxResults"] = this.getFieldValue(theForm.maxResults);
		this.buildShortcode(slug, parameters);
	},
	insertValuationWidget: function(theForm) {
		var slug = this.getFieldValue(theForm.slug);
		var parameters = {};
		parameters["style"] = this.getFieldValue(theForm.style);
		this.buildShortcode(slug, parameters);
	},
	insertQuickSearch: function(theForm) {
		var slug = this.getFieldValue(theForm.slug);
		var parameters = {
			style: this.getFieldValue(theForm.style),
			showPropertyType: this.getFieldValue(theForm.showPropertyType)
		};
		this.buildShortcode(slug, parameters);
	},
	insertSearchByAddress: function(theForm) {
		var slug = this.getFieldValue(theForm.slug);
		var parameters = {
			style: this.getFieldValue(theForm.style)
		};
		this.buildShortcode(slug, parameters);
	},
	insertSearchByListingId: function(theForm) {
		var slug = this.getFieldValue(theForm.slug);
		this.buildShortcode(slug);
	},
	insertBasicSearch: function(theForm) {
		var slug = this.getFieldValue(theForm.slug);
		this.buildShortcode(slug);
	},
	insertAdvancedSearch: function(theForm) {
		var parameters = {};
		if(theForm.boardId != undefined) {
			parameters["boardId"] = this.getFieldValue(theForm.boardId);
		}
		var slug = this.getFieldValue(theForm.slug);
		this.buildShortcode(slug, parameters);
	},
	insertOrganizerLogin: function(theForm) {
		var slug = this.getFieldValue(theForm.slug);
		this.buildShortcode(slug);
	},
	insertEmailAlerts: function(theForm) {
		var slug = this.getFieldValue(theForm.slug);
		this.buildShortcode(slug);
	},
	insertValuationForm: function(theForm) {
		var slug = this.getFieldValue(theForm.slug);
		this.buildShortcode(slug);
	},
	insertContactForm: function(theForm) {
		var slug = this.getFieldValue(theForm.slug);
		this.buildShortcode(slug);
	},
	insertMapSearch: function(theForm) {
		var slug = this.getFieldValue(theForm.slug);
		var parameters = {};
		if(theForm.fitToWidth == undefined || theForm.fitToWidth.checked == false) {
			parameters["width"] = this.getFieldValue(theForm.width);
		}
		parameters["height"] = this.getFieldValue(theForm.height);
		parameters["centerlat"] = this.getFieldValue(theForm.centerlat);
		parameters["centerlong"] = this.getFieldValue(theForm.centerlong);
		parameters["address"] = this.getFieldValue(theForm.address);
		parameters["zoom"] = this.getFieldValue(theForm.zoom);
		this.buildShortcode(slug, parameters);
	},
	insertAgentDetail: function(theForm) {
		var slug = this.getFieldValue(theForm.slug);
		var parameters = {
			agentId: this.getFieldValue(theForm.agentId)
		};
		this.buildShortcode(slug, parameters);
	},
	insertAgentList: function(theForm) {
		var slug = this.getFieldValue(theForm.slug);
		this.buildShortcode(slug);
	},
	insertOfficeList: function(theForm) {
		var slug = this.getFieldValue(theForm.slug);
		this.buildShortcode(slug);
	},
	insertAgentListings: function(theForm) {
		var slug = this.getFieldValue(theForm.slug);
		var parameters = {
			agentId: this.getFieldValue(theForm.agentId)
		};
		this.buildShortcode(slug, parameters);
	},
	insertOfficeListings: function(theForm) {
		var slug = this.getFieldValue(theForm.slug);
		var parameters = {
			officeId: this.getFieldValue(theForm.officeId)
		};
		this.buildShortcode(slug, parameters);
	},
	insertHotSheetReportSignup: function(theForm) {
		var slug = this.getFieldValue(theForm.slug);
		var parameters = {
			id: this.getFieldValue(theForm.hotSheetId),
			reportType: this.getFieldValue(theForm.hotSheetReportType)
		};
		this.buildShortcode(slug, parameters);
	},
	buildShortcode: function(slug, parameters) {
		var result = "[" + slug;
		if(parameters) {
			for(var key in parameters) {
				var value = parameters[key];
				if(value != undefined && value != null && value.length != 0) {
					result += " " + key + "=\"" + value + "\"";
				}
			}
		}
		result += "]";
		tinyMCEPopup.editor.execCommand("mceInsertContent", false, result);
		tinyMCEPopup.close();
	},
	getFieldValue: function(formField) {
		var value = null;
		if(formField != undefined) {
			if(formField.type == "checkbox") {
				value = formField.checked;
			} else {
				value = formField.value;
			}
		}
		if (value === undefined || value === null || value.length === 0) {
			return null;
		} else {
			return value;
		}
	}
}

tinyMCEPopup.onInit.add(IhfShortcodeSelector.init, IhfShortcodeSelector);
