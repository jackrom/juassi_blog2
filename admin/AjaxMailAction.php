<?php
    require_once("include/config.inc.php");
    require_once("include/pop3lib/pop3.class.php");
    require_once("include/pop3lib/pop3message.class.php");
    require_once("include/pop3lib/pop3header.class.php");
    require_once("include/pop3lib/pop3attachment.class.php");
    require_once("include/AjaxMail.inc.php");
    require_once("include/JSON.php");
    
    //headers
    header("Content-Type: text/plain");
    header("Cache-control: No-Cache");
    header("Pragma: No-Cache");

    //get information
    $folder = $_GET["folder"];
    $page = (int) $_GET["page"];
    $action = $_GET["action"];

    //create new mailbox
    $mailbox = new AjaxMailbox();

    //create JSON object in case its needed
    $oJSON = new JSON();
    
    //output for the page
    $output = "";
    
    //determine what to do
    switch($action) {
        case "delete":
            $mailbox->deleteMessage($_GET["id"]);
            break;
        case "empty":
            $mailbox->emptyTrash();
            break;
        case "getfolder":
            //no extra processing needed       
            break;
        case "restore":
            $mailbox->restoreMessage($_GET["id"]);          
            break;        
    } 
    
    $info = $mailbox->getFolderPage($folder, $page);
    $output = $oJSON->encode($info);      
    echo $output; 
?>