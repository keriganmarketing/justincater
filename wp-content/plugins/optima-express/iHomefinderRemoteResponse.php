<?php

class iHomefinderRemoteResponse {
	
	private $response;
	
	public function __construct($response) {
		$this->setResponse($response);
	}
	
	public function getResponse() {
		return $this->response;
	}
	
	public function setResponse($response) {
		$this->response = $response;
	}
	
	public function getBody() {
		$content = null;
		if(is_null($this->response)) {
			//We could reach this code, if the iHomefinder services are down.
			$content = "<br />Sorry we are experiencing system issues. Please try again.<br />";
		} elseif(property_exists($this->response, "error")) {
			//Report the error from iHomefinder
			$content = "<br />" . $this->response->error . "<br />";
		} elseif(property_exists($this->response, "view")) {
			//success, display the view
			$content = html_entity_decode($this->response->view, null, "UTF-8");
		}
		return $content;
	}
	
	public function hasBody() {
		return $this->hasProperty("view");
	}
	
	public function getCss() {
		$result = $this->getProperty("css");
		$result = $this->convertItemValues($result);
		return $result;
	}
	
	public function hasCss() {
		return $this->hasProperty("css");
	}
	
	public function getJs() {
		$result = $this->getProperty("javascript");
		$result = $this->convertItemValues($result);
		return $result;
	}
	
	public function hasJs() {
		return $this->hasProperty("javascript");
	}
	
	public function getError() {
		return $this->getProperty("error");
	}
	
	public function hasError() {
		return $this->hasProperty("error");
	}
	
	public function getHead() {
		return $this->getProperty("head");
	}
	
	public function hasHead() {
		return $this->hasProperty("head");
	}
	
	public function getTitle() {
		return $this->getProperty("title");
	}
	
	public function hasTitle() {
		return $this->hasProperty("title");
	}
	
	public function getJson() {
		return $this->getProperty("json");
	}
	
	public function hasJson() {
		return $this->hasProperty("json");
	}
	
	public function getVariables() {
		return $this->getProperty("variables");
	}
	
	public function hasVariables() {
		return $this->hasProperty("variables");
	}
	
	public function getLeadCaptureUserId() {
		$result = (string) $this->getProperty("leadCaptureId");
		return $result;
	}
	
	public function hasLeadCaptureUserId() {
		return $this->hasProperty("leadCaptureId");
	}
	
	public function getSessionId() {
		$result = (string) $this->getProperty("ihfSessionId");
		return $result;
	}
	
	public function hasSessionId() {
		return $this->hasProperty("ihfSessionId");
	}
	
	public function getListingInfo() {
		return $this->getProperty("listingInfo");
	}
	
	public function hasListingInfo() {
		return $this->hasProperty("listingInfo");
	}
	
	public function getSubscriberId() {
		$result = null;
		if($this->hasSubscriberId()) {
			$result = (string) $this->getProperty("subscriberInfo")->subscriberId;
		}
		return $result;
	}
	
	public function hasSubscriberId() {
		$result = false;
		if($this->hasProperty("subscriberInfo")) {
			$subscriber = $this->getProperty("subscriberInfo");
			if(property_exists($subscriber, "subscriberId")) {
				$result = true;
			}
		}
		return $result;
	}
	
	public function getSearchSummary() {
		return $this->getProperty("searchSummary");
	}
	
	public function hasSearchSummary() {
		return $this->getProperty("searchSummary");
	}
	
	public function getHotSheets() {
		$result = $this->getProperty("hotsheetsList");
		$result = $this->convertItemValues($result);
		return $result;
	}
	
	public function getCities() {
		$result = $this->getProperty("citiesList");
		$result = $this->convertItemValues($result);
		return $result;
	}
	
	public function getCityZips() {
		$result = $this->getProperty("cityZipList");
		$result = $this->convertItemValues($result);
		return $result;
	}
	
	public function getPropertyTypes() {
		$result = $this->getProperty("propertyTypesList");
		$result = $this->convertItemValues($result);
		return $result;
	}
	
	public function getAgents() {
		$result = $this->getProperty("agentList");
		$result = $this->convertItemValues($result);
		return $result;
	}
	
	public function getBoards() {
		$result = $this->getProperty("boardList");
		$result = $this->convertItemValues($result);
		return $result;
	}
	
	public function getOffices() {
		$result = $this->getProperty("officeList");
		$result = $this->convertItemValues($result);
		return $result;
	}
	
	private function getProperty($name) {
		$result = null;
		if(is_object($this->response) && property_exists($this->response, $name)) {
			$result = $this->response->{"$name"};
		}
		return $result;
	}
	
	private function hasProperty($name) {
		return is_object($this->response) && property_exists($this->response, $name);
	}
	
	/**
	 * This function was added to convert our xml based array into a proper
	 * php array for use in admin search forms.
	 * @param unknown_type $from
	 */
	private function convertItemValues($fromValue) {
		if(iHomefinderDisplayRules::getInstance()->hasItemInSearchFormData()) {
			$result = array();
			foreach($fromValue->item as $element) {
				$result[] = $element;
			}
		} else {
			$result = $fromValue;
		}
		return $result;
	}
	
}