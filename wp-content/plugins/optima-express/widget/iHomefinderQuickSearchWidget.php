<?php

class iHomefinderQuickSearchWidget extends iHomefinderWidget {
	
	private $enqueueResource;
	private $displayRules;
	
	public function __construct() {
		parent::__construct(
			"iHomefinderQuickSearchWidget",
			"IDX: Quick Search",
			array(
				"description" => "Property Search form."
			)
		);
		$this->enqueueResource = iHomefinderEnqueueResource::getInstance();
		$this->displayRules = iHomefinderDisplayRules::getInstance();
	}
	
	public function widget($args, $instance) {
		$instance = $this->migrate($instance);
		if($this->isEnabled($instance)) {
			$beforeWidget = $args["before_widget"];
			$afterWidget = $args["after_widget"];
			$beforeTitle = $args["before_title"];
			$afterTitle = $args["after_title"];
			$title = apply_filters("widget_title", $instance["title"]);
			$remoteRequest = new iHomefinderRequestor();
			$remoteRequest
				->addParameter("requestType", "listing-search-form")
				->addParameter("smallView", true)
				->addParameter("style", $instance["style"])
				->addParameter("showPropertyType", $instance["showPropertyType"])
			;
			$remoteRequest->setCacheExpiration(60*60*24);
			$remoteResponse = $remoteRequest->remoteGetRequest();
			$content = $remoteResponse->getBody();
			$this->enqueueResource->addToFooter($remoteResponse->getHead());
			echo $beforeWidget;
			if(!empty($title)) {
				echo $beforeTitle . $title . $afterTitle;
			}
			if($this->displayRules->hasExtraLineBreaksInWidget()) {
				echo "<br/>";
				echo $content;
				echo "<br/>";
			} else {
				echo $content;
			}
			echo $afterWidget;
		}
	}
	
	public function update($newInstance, $oldInstance) {
		$newInstance = $this->migrate($newInstance);
		$oldInstance = $this->migrate($oldInstance);
		$instance = $oldInstance;
		$instance["title"] = strip_tags(stripslashes($newInstance["title"]));
		$instance["style"] = strip_tags(stripslashes($newInstance["style"]));
		$instance["showPropertyType"] = $newInstance["showPropertyType"];
		$instance = $this->updateContext($newInstance, $instance);
		return $instance;
	}
	
	public function form($instance) {
		$instance = $this->migrate($instance);
		$title = null;
		if (array_key_exists("title", $instance)) {
			$title = esc_attr($instance["title"]);
		}
		$style = null;
		if (array_key_exists("style", $instance)) {
			$style = esc_attr($instance["style"]);
		}
		$showPropertyType = null;
		if (array_key_exists("showPropertyType", $instance)) {
			$showPropertyType = $instance["showPropertyType"];
		}
		?>
		<p>
			<label>
				Title:
				<input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php 
					if(isset($title)) {
						echo $title;
					}
				?>" />
			</label>
		</p>
		<?php if($this->displayRules->supportsMultipleQuickSearchLayouts()) { ?>
			<p>
				<label>
					Style:
					<select class="widefat" id="<?php echo $this->get_field_id("style"); ?>" name="<?php echo $this->get_field_name("style"); ?>">
						<option value="vertical" <?php if($style=="vertical") {echo(' selected');} ?>>Vertical</option>
						<option value="horizontal" <?php if($style=="horizontal") {echo(' selected');} ?>>Horizontal</option>
						<option value="twoline" <?php if($style=="twoline") {echo(' selected');} ?>>Two Line</option>
					</select>
				</label> 		
			</p>
			<?php } ?>
			<?php if($this->displayRules->supportsQuickSearchPropertyType()) { ?>
			<p>
				<label>
					<input type="checkbox" name="<?php echo $this->get_field_name("showPropertyType"); ?>" value="true" <?php if($showPropertyType === "true") {echo "checked";} ?> />
					<span><?php _e("Show Property Type"); ?></span>
				</label>
			</p>
		<?php } ?>
		<?php 
		$this->getPageSelector($instance);
		?>
		<br />
		<?php
	}
	
}
