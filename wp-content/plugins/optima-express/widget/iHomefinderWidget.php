<?php

abstract class iHomefinderWidget extends WP_Widget {
	
	protected function isEnabled($instance) {
		$result = false;
		//type is only defined for ihomefinder page. 
		//If not set, then always display the widget.
		$virtualPageType = get_query_var(iHomefinderConstants::IHF_TYPE_URL_VAR);
		if(empty($virtualPageType)) {
			//always display the widget for non OE virtual pages
			$result = true;
		} elseif(!array_key_exists(iHomefinderVirtualPageFactory::LISTING_DETAIL, $instance)) {
			//If the widget instance does not have the listing detail key, then we have a plugin
			//That has been upgraded, but the user did not update the widget. In this case
			//we default to the previous behavior of displaying the widget on all pages.
			$result = true;
		} elseif(array_key_exists($virtualPageType, $instance) && $instance[$virtualPageType] === "true") {
			//We have enabled the type for this widget see iHomefinderVirtualPageFactory for valid types
			$result = true;
		} else {
			//Special cases that are not covered specifically by type
			if($instance[iHomefinderVirtualPageFactory::HOT_SHEET_LISTING_REPORT] === "true") {	
				//If set to display with Hotsheet, then also display in the Hotsheet list.
				if(
					$virtualPageType === iHomefinderVirtualPageFactory::HOT_SHEET_LIST
					|| $virtualPageType === iHomefinderVirtualPageFactory::HOT_SHEET_OPEN_HOME_REPORT
					|| $virtualPageType === iHomefinderVirtualPageFactory::HOT_SHEET_MARKET_REPORT
				) {
					$result = true;
				}
			} elseif($instance[iHomefinderVirtualPageFactory::ORGANIZER_LOGIN] === "true") {
				//If set to display for Organizer, then enabled for saved listings and search
				if($virtualPageType === iHomefinderVirtualPageFactory::ORGANIZER_VIEW_SAVED_LISTING_LIST) {
					$result = true;
				} elseif($virtualPageType === iHomefinderVirtualPageFactory::ORGANIZER_EDIT_SAVED_SEARCH) {
					$result = true;
				}
			} elseif($instance[iHomefinderVirtualPageFactory::ORGANIZER_EDIT_SAVED_SEARCH] === "true") {
				//Email Alerts page
				if($virtualPageType === iHomefinderVirtualPageFactory::ORGANIZER_EMAIL_UPDATES_CONFIRMATION) {
					$result = true;
				}
			}
		}
		return $result;
	}
	
	protected function updateContext($newInstance, $oldInstance) {
		$instance = $oldInstance;
		$virtualPages = $this->getVirtualPages();
		foreach($virtualPages as $virtualPageType => $label) {
			$instance[$virtualPageType] = empty($newInstance[$virtualPageType]) ? "false" : "true";
		}
		return $instance;
	}
	
	/**
	 * This function echos JavaScript and a set of checkboxes used to restrict the pages that the widget displays on. For example, we
	 * can configure a Featured Listings widget to NOT diplay on the Featured Listings page.
	 * 
	 * @param array $instance The settings for the particular instance of the widget
	 */
	protected function getPageSelector($instance) {
		//cannot use $this->id in the function name, b/c it has characters that are not allowed for JavaScript functions
		$selectAllCheckbox = "selectAllCheckbox" . $this->id;
		$selectAllCheckboxDiv = "selectAllContainer" . $this->id;
		?>
		<p>Display widget on selected IDX pages:</p>
		<label>
			<input
				id="<?php echo $selectAllCheckbox ?>"
				type="checkbox"
				onclick="ihfSelectAllCheckboxes('<?php echo $selectAllCheckbox ?>', '<?php echo $selectAllCheckboxDiv ?>');"
			/>
			Select All
		</label>
		<div id="<?php echo $selectAllCheckboxDiv ?>">	
			<?php
			$virtualPages = $this->getVirtualPages();
			foreach ($virtualPages as $virtualPageType => $label) {
				$fieldId = $this->get_field_id($virtualPageType);
				$fieldName = $this->get_field_name($virtualPageType);
				$fieldValue = true;
				if(array_key_exists($virtualPageType, $instance) && $instance[$virtualPageType] === "false") {
					$fieldValue = false;
				}
				?>
				<label>
					<input
						id="<?php echo $fieldId; ?>"
						name="<?php echo $fieldName; ?>"
						type="checkbox"
						value="true"
						onclick="ihfSelectAllCheckboxesReset('<?php echo $selectAllCheckbox; ?>', '<?php echo $selectAllCheckboxDiv; ?>')"
						<?php if($fieldValue) { ?>
							checked="checked"
						<?php } ?>
					/>
					<?php echo $label; ?>
				</label>
				<br />
			<?php } ?>
		</div>
		<?php
	}
	
	private function getVirtualPages() {
		$results = array();
		$results[iHomefinderVirtualPageFactory::OPEN_HOME_SEARCH_FORM] = "Open Home Search";
		$results[iHomefinderVirtualPageFactory::LISTING_SEARCH_RESULTS] = "Search Results";
		$results[iHomefinderVirtualPageFactory::LISTING_DETAIL] = "Listing Details";
		$results[iHomefinderVirtualPageFactory::LISTING_SOLD_DETAIL] = "Sold Property Details";
		$results[iHomefinderVirtualPageFactory::SOLD_FEATURED_LISTING] = "Sold Featured Listing";
		$results[iHomefinderVirtualPageFactory::SUPPLEMENTAL_LISTING] = "Supplemental Listing";
		$results[iHomefinderVirtualPageFactory::FEATURED_SEARCH] = "Featured Properties";
		$results[iHomefinderVirtualPageFactory::HOT_SHEET_LISTING_REPORT] = "Market Reports <small>(Saved Search)</small>";
		$results[iHomefinderVirtualPageFactory::ORGANIZER_LOGIN] = "Organizer Pages";
		$results[iHomefinderVirtualPageFactory::VALUATION_FORM] = "Valuation Request";
		if(iHomefinderDisplayRules::getInstance()->isAgentBioEnabled()) {
			$results[iHomefinderVirtualPageFactory::AGENT_DETAIL] = "Agent Bio";
			$results[iHomefinderVirtualPageFactory::AGENT_LIST] = "Agent List";
		}
		if(iHomefinderDisplayRules::getInstance()->isOfficeEnabled()) {
			$results[iHomefinderVirtualPageFactory::OFFICE_DETAIL] = "Office Detail";
			$results[iHomefinderVirtualPageFactory::OFFICE_LIST] = "Office List";
		}
		if(!is_a($this, "iHomefinderQuickSearchWidget")) {
			$results[iHomefinderVirtualPageFactory::LISTING_SEARCH_FORM] = "Search Form";
			$results[iHomefinderVirtualPageFactory::LISTING_ADVANCED_SEARCH_FORM] = "Advanced Search Form";
			$results[iHomefinderVirtualPageFactory::ORGANIZER_EDIT_SAVED_SEARCH] = "Email Alerts";
			$results[iHomefinderVirtualPageFactory::MAP_SEARCH_FORM] = "Map Search";
		}
		if(!is_a($this, "iHomefinderContactFormWidget")) {
			$results[iHomefinderVirtualPageFactory::CONTACT_FORM] = "Contact Form";
		}
		asort($results);
		return $results;
	}
	
	/**
	 * We had an issue where the "Display widget on selected IDX pages" setting was using numeric keys instead of using the keys
	 * specified in iHomefinderVirtualPageFactory. This method looks for numeric keys and converts them to the correct keys. We
	 * only convert the keys if the number of virtual pages saved match the number of possible saved virtual pages.
	 */
	protected function migrate($instance) {
		if($instance !== null) {
			$virtualPages = $this->getVirtualPages();
			$newKeys = array_keys($virtualPages);
			$oldKeys = array();
			foreach($instance as $oldKey => $value) {
				if(is_numeric($oldKey)) {
					$oldKeys[] = $oldKey;
				}
			}
			if(count($newKeys) == count($oldKeys)) {
				foreach($oldKeys as $oldKey) {
					$value = $instance[$oldKey];
					$newKey = $newKeys[$oldKey];
					$instance[$newKey] = $value;
					unset($instance[$oldKey]);
				}
			}
		}
		return $instance;
	}

}
