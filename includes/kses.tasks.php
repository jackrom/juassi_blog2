<?php

	function juassi_filter_kses_html($body) {
		global $juassi_allowed_html;

		return kses($body, $juassi_allowed_html);
	}

	function juassi_filter_kses_html_comments($body) {
		global $juassi_allowed_html_comments;

		return kses($body, $juassi_allowed_html_comments);
	}

	function juassi_filter_kses_html_events($body) {
		global $juassi_allowed_html_event_viewer;

		return kses($body, $juassi_allowed_html_event_viewer);
	}

?>