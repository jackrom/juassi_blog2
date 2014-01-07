<?php
    require_once("include/config.inc.php");
    require_once("include/pop3lib/pop3.class.php");
    require_once("include/pop3lib/pop3message.class.php");
    require_once("include/pop3lib/pop3header.class.php");
    require_once("include/pop3lib/pop3attachment.class.php");
    require_once("include/AjaxMail.inc.php");
    
    //get information
    $id = $_GET["id"];

    //create new mailbox
    $mailbox = new AjaxMailbox();
    
    //get the attachment
    $attachment = $mailbox->getAttachment($id);

    //headers
    header("Content-Type: $attachment->contentType");
	  header("Content-Disposition: attachment; filename=$attachment->filename"); 

    //output the body
    echo $attachment->data;   
?>