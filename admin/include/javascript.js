// JavaScript Document

function ModDeleteAll() {
	for (var i=0; i < document.Moderation_Queue.length; i++) {
		if (document.Moderation_Queue[i].value == "0") {
			document.Moderation_Queue[i].checked = true;
		}
	}
}

function ModApproveAll() {
	for (var i=0; i < document.Moderation_Queue.length; i++) {
		if (document.Moderation_Queue[i].value == "1") {
			document.Moderation_Queue[i].checked = true;
		}
	}
}

function ModLeaveAll() {
	for (var i=0; i < document.Moderation_Queue.length; i++) {
		if (document.Moderation_Queue[i].value == "2") {
			document.Moderation_Queue[i].checked = true;
		}
	}
}

function LastDeleteAll() {
	for (var i=0; i < document.Last_Comments.length; i++) {
		if (document.Last_Comments[i].value == "0") {
			document.Last_Comments[i].checked = true;
		}
	}
}

function LastApproveAll() {
	for (var i=0; i < document.Last_Comments.length; i++) {
		if (document.Last_Comments[i].value == "1") {
			document.Last_Comments[i].checked = true;
		}
	}
}

function LastLeaveAll() {
	for (var i=0; i < document.Last_Comments.length; i++) {
		if (document.Last_Comments[i].value == "2") {
			document.Last_Comments[i].checked = true;
		}
	}
}

function form_view(val) {
	if(val) {
		document.getElementById('content_body_form').style.visibility = "hidden";
		document.getElementById('content_body_form').style.display = "none";
		document.getElementById('file_name_form').style.visibility = "visible";
		document.getElementById('file_name_form').style.display = "inline";
	}
	else {
		document.getElementById('content_body_form').style.visibility = "visible";
		document.getElementById('content_body_form').style.display = "inline";
		document.getElementById('file_name_form').style.visibility = "hidden";
		document.getElementById('file_name_form').style.display = "none";
	}
}

function juassi_select_plugins() {
	for (var i=0; i < document.juassi_plugins_list.length; i++) {
		if (document.juassi_plugins_list[i].checked == true) {
			document.juassi_plugins_list[i].checked = false;
		}
		else {
			document.juassi_plugins_list[i].checked = true;
		}
	}
}