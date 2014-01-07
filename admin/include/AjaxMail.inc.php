<?php

class JSONObject {}


class AjaxMailAttachmentHeader {
    var $id;
    var $filename;
    
    function AjaxMailAttachmentHeader($id, $filename, $size) {
        $this->id = $id;
        $this->filename = $filename;
        $this->size = "".(round($size/1024*100)/100)." KB";
    }    
}

class AjaxMailAttachment {
    
    var $contentType;
    var $filename;
    var $size;
    var $data;
	

    function AjaxMailAttachment($contentType, $filename, $size, $data) {
        $this->contentType = $contentType;
        $this->filename = $filename;
        $this->size = $size;
        $this->data = $data;
    }
}

class AjaxMailMessage {

    var $to;
    var $from;
    var $cc;
    var $bcc;
    var $subject;
    var $message;
    var $date;
    var $attachments;
    var $unread;
    var $hasAttachments;
    var $id;
    
    function AjaxMailMessage() {
        $this->attachments = array();
    }

}

class AjaxMailbox {

    function connect() {
        $conn = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die("Could not connect : " . mysql_error());
        mysql_select_db(DB_NAME);
        return $conn;    
    }
    
    function disconnect($conn) {
        mysql_close($conn);
    }

    function getFolderPage($folder, $page) {
    
        //first make sure you have the most recent mail info
        $this->checkMail();
 
        //connect to the database
        $conn = $this->connect();
        
        //first get the total number of e-mails in the folder
        $query = "select count(MessageId) as count from blog_Messages";
        $query .= " where FolderId=$folder";
        $result = mysql_query($query, $conn);
        $row = mysql_fetch_assoc($result);
        
        //assign basic mail info
        $info = new JSONObject();
        $info->messageCount = (int) $row["count"];
        $info->page = $page;
        $info->pageCount = (int) ceil($info->messageCount/MESSAGES_PER_PAGE);
        $info->folder = $folder;
        
        //calculate first and last message to retrieve
        $firstMessageNum = ($page-1) * MESSAGES_PER_PAGE;
        
        //add info to the mail info
        $info->firstMessage = $firstMessageNum+1; //DB is 0-based, people like to see it 1-based :)
        $info->messages = array();
        
        $info->unreadCount = $this->getUnreadCount($conn);       

        
        //get the message information
        $query = "select * from blog_Messages where FolderId=$folder";
        $query .= " order by date desc limit $firstMessageNum, ";
        $query .= MESSAGES_PER_PAGE;
		
        $result = mysql_query($query, $conn);
		
        if (!$result) {
            $info->error = mysql_error($conn);
        } else {		
            //get the data and assign into new message info
            while ($row = mysql_fetch_assoc($result)) {
                $message = new JSONObject();
                $message->id = $row['MessageId'];
                $message->from = $row['From'];
                $message->subject = $row['Subject'];               
                $message->date = date("M j Y", intval($row["Date"]));
                $message->hasAttachments = ($row['HasAttachments']==1);
                $message->unread = ($row['Unread']==1);	
                $info->messages[] = $message;
            }
        }
        
		
        //close the database connection
		    $this->disconnect($conn);
		
		    //return the information
        return $info;   
    }
    
    function getUnreadCount($conn) {
        $query = "select count(MessageId) as UnreadCount from blog_Messages where FolderId=1 and Unread=1";
        $result = mysql_query($query, $conn);
        $row = mysql_fetch_assoc($result);
        return intval($row["UnreadCount"]);      
    }

    function getMessage($messageId) {
        $conn = $this->connect();
        
        //get the information
        $query = "select MessageId, `To`, `From`, CC, BCC, Subject, Date, ";
        $query .= "Message, HasAttachments, Unread from blog_Messages where";
        $query .= " MessageId=$messageId";
        $result = mysql_query($query, $conn);
        $row = mysql_fetch_assoc($result);
        
        //assign information to message object
        $message = new AjaxMailMessage();
        $message->id = $row["MessageId"];
        $message->to = $row["To"];
        $message->cc = $row["CC"];
        $message->bcc = $row["BCC"];
        $message->unread = ($row["Unread"]==1);
        $message->from = $row["From"];
        $message->subject = $row["Subject"];
        $message->date = date("M j, Y h:i A", intval($row["Date"]));
        $message->hasAttachments = ($row["HasAttachments"]==1);
        $message->unreadCount = $this->getUnreadCount($conn);
        $message->message = $row["Message"];
        
        //if there are attachments, get them
        if ($message->hasAttachments) {
            $query = "select AttachmentId, Filename, Size from blog_Attachments where MessageId=$messageId";
            $result = mysql_query($query, $conn);
            while ($row = mysql_fetch_assoc($result)) {
                $message->attachments[] = new AjaxMailAttachmentHeader($row["AttachmentId"], $row["Filename"], (int) $row["Size"]);              
            }
        }
        
		
        $this->disconnect($conn);
        
        return $message;
    }
	
    function getAttachment($attachmentId) {
        $conn = $this->connect();
        
        $query = "select * from blog_Attachments where ";
        $query .= " AttachmentId=$attachmentId";
        $result = mysql_query($query, $conn);
        $row = mysql_fetch_assoc($result);
        
        $this->disconnect($conn);
        
        return new AjaxMailAttachment($row["ContentType"], $row["Filename"], $row["Size"], $row["Data"]);        
    }
    
    function clearAll() {
        $conn = $this->connect();
        
        $query = "truncate table blog_Messages";
        mysql_query($query,$conn);
        
        $query = "truncate table blog_Attachments";
        mysql_query($query,$conn);
        
        $this->disconnect($conn);
    }
    

    function deleteMessage($messageId) {
        $conn = $this->connect();
        
        $query = "update blog_Messages set FolderId=2 where ";
        $query .= " MessageId=$messageId";
        mysql_query($query,$conn);
        
        $this->disconnect($conn);
    }
    
    function emptyTrash() {
        $conn = $this->connect();
        
        //delete any attachments
        $query = "delete from blog_Attachments where MessageId in (select MessageId from blog_Messages where FolderId=2)";
        mysql_query($query, $conn);
        
        //delete the e-mails
        $query = "delete from blog_Messages where FolderId=2";
        mysql_query($query,$conn);
        
        $this->disconnect($conn);        
    }
    
    function markMessageAsRead($messageId) {
        $conn = $this->connect();
        
        $query = "update blog_Messages set Unread=0 where MessageId=$messageId";
        mysql_query($query,$conn);
        
        $this->disconnect($conn);    
    }
	
    function markMessageAsUnread($messageId) {
        $conn = $this->connect();
        
        $query = "update blog_Messages set Unread=1 where MessageId=$messageId";
        mysql_query($query,$conn);
        
        $this->disconnect($conn);    
    }
    
    function restoreMessage($messageId) {
        $conn = $this->connect();
        
        $query = "update blog_Messages set FolderId=1 where MessageId=$messageId";
        mysql_query($query,$conn);
        
        $this->disconnect($conn);    
    }
    
    function checkMail() {
        $pop = new Pop3(POP3_SERVER, POP3_USER, POP3_PASSWORD);
        
        if ($pop->login()) {

            if ($pop->mailCount > 0) {
                
                $conn = $this->connect();
                $pop->getEmails();
                
                foreach ($pop->messages as $message) {
                    $query = "insert into blog_Messages(`To`,CC,BCC,`From`,";
                    $query .= 
                          "Subject,`Date`,Message,HasAttachments,FolderId,Unread)";
                    $query .= " values('%s','%s','%s','%s','%s',%s,'%s',"
                              .$message->hasAttachments.",1,1)";
                    $query = sprintf($query, 
                                     (addslashes($message->to)),
                                     (addslashes($message->cc)),
                                     (addslashes($message->bcc)),
                                     (addslashes($message->from)),
                                     (addslashes($message->subject)),
                                     $message->unixTimeStamp,
                                     (addslashes($message->getTextMessage()))
                             );
					
                    $result = mysql_query($query, $conn);
					
                    if ($message->hasAttachments) {

                        $messageId = mysql_insert_id($conn);   

                        foreach ($message->attachments as $attachment) {
                            $query = "insert into blog_Attachments(MessageId,";
                            $query .= "Filename, ContentType, Size, Data)";
                            $query .= "values($messageId, '%s', '%s', '%s', '%s')";
                            $query = sprintf($query,
                                             addslashes($attachment->fileName),
                                             $attachment->contentType,
                                             strlen($attachment->data),
                                             addslashes($attachment->data));  
                            mysql_query($query, $conn);                        
                        }
                    } 
                                   
                }
                $this->disconnect($conn);                 
            }
	
            $pop->logoff();   
        } 
    }

	
function sendMail($to, $subject, $message, $cc="") {
        $mailer = new PHPMailer();
    	
        //Add To's
        $tos = preg_split ("/;|,/", $to);
        foreach ($tos as $to) {
            preg_match("/(.*?)<?(.*?)>?/i", $to, $matches);
            
            $mailer->AddAddress($matches[2],str_replace('"','',$matches[1]));
        }
    	
        //Add the CCs
        if ($cc != "") {
            $ccs = preg_split ("/;|,/", $cc);
            
            foreach ($ccs as $cc) {
                preg_match("/(.*?)<?(.*?)>?/i", $cc, $matches);
                
                $mailer->AddCC($matches[2],str_replace('"','',$matches[1]));
            }
        }
    
        //set other information
        $mailer->From = EMAIL_FROM_ADDRESS;
        $mailer->FromName = EMAIL_FROM_NAME;
        $mailer->Subject = $subject;
        $mailer->Body = $message;
        $mailer->SMTPAuth = SMTP_DO_AUTHORIZATION;
        $mailer->Username = SMTP_USER;
        $mailer->Password = SMTP_PASSWORD;
        
        $mailer->Host = SMTP_SERVER;
        
        $mailer->Mailer = "smtp";
        
        $mailer->Send();	
        
        $mailer->SmtpClose();
        
        $response = new JSONObject();
        
        if ($mailer->IsError()) {
            $response->error = true;
            $response->message = $mailer->ErrorInfo;
        } else {
            $response->error = false;
            $response->message = "Your message has been sent.";
        }
	
        return $response;
    }
	
}

?>