<?php

class iHomefinderSearchResultsVirtualPageImpl extends iHomefinderAbstractVirtualPage {
	
	public function getTitle() {
		return "Property Search Results";
	}
	
	public function getPermalink() {
		return "homes-for-sale-results";
	}
			
	public function getContent() {
		$displayRules = iHomefinderDisplayRules::getInstance();
		$stateManager = iHomefinderStateManager::getInstance();
		$stateManager->setLastSearchUrl();
		//use a different requestType depending on the search
		$requestType = "listing-search-results";
		if($displayRules->isSearchByListingIdEnabled() && $stateManager->isListingIdResults()) {
			$requestType = "results-by-listing-id";
		}
		if($displayRules->isSearchByAddressEnabled() && $stateManager->isListingAddressResults()) {
			$requestType = "results-by-address";
		}
		$this->remoteRequest
			->addParameters($_REQUEST)
			->addParameter("requestType", $requestType)
			->addParameter("includeSearchSummary", true)
		;
		$this->remoteResponse = $this->remoteRequest->remoteGetRequest();
	}
	
}