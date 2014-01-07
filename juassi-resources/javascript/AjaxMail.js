
//URLs
var sAjaxMailURL = "AjaxMailAction.php";
var sAjaxMailNavigateURL = "AjaxMailNavigate.php";
var sAjaxMailAttachmentURL = "AjaxMailAttachment.php";
var sAjaxMailSendURL = "AjaxMailSend.php";
var sImagesDir = "../juassi-resources/img/";
var sRestoreIcon = sImagesDir + "icon_restore.gif";
var sDeleteIcon = sImagesDir + "icon_delete.gif";
var sInfoIcon = sImagesDir + "icon_info.gif";
var sErrorIcon = sImagesDir + "icon_alert.gif";
var aPreloadImages = [sRestoreIcon, sDeleteIcon, sInfoIcon, sErrorIcon];

//Strings
var sEmptyTrashConfirm = "Estas enviando este mensaje a la papelera!, Continuas??";
var sEmptyTrashNotice = "La papelera ha sido vaciada";
var sDeleteMailNotice = "El mensaje ha sido movido a la papelera.";
var sRestoreMailNotice = "El mensaje ha sido movidoa la bandeja de entrada.";
var sTo = "To ";
var sCC = "CC ";
var sBCC = "BCC ";
var sFrom = "From ";
var sRestore = "Restore";
var sDelete = "Move to Trash";

//Timeout Settings
var iShowNoticeTime = 5000;

//Folders
var INBOX = 1;
var TRASH = 2;
var aFolders = ["","Inbox", "Trash"];

//preload the images
for (var i=0; i < aPreloadImages.length; i++) {
    var oImg = new Image();
    oImg.src = aPreloadImages[i];
}

/**
 * The mailbox.
 */
var oMailbox = {

    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------
    
    //folder-related information
    info: new Object(),   //information about the mail being displayed
    processing: false,    //determines if processing is taking place
    message: new Object(),//information about the current message    
    nextNotice: null,    //information to be displayed to the user

    //-----------------------------------------------------
    // Data-Related Methods
    //-----------------------------------------------------
    
    /**
     * Moves a message to the trash.
     * @scope protected
     * @param sId The ID of the message.
     */
    deleteMessage: function (sId) {
        this.nextNotice = sDeleteMailNotice;
        this.request("delete", loadAndRender, sId);        
    },
    
    /**
     * Moves a message to the trash.
     * @scope protected
     * @param sId The ID of the message.
     */
    emptyTrash: function () {
        if (confirm(sEmptyTrashConfirm)) {
            this.nextNotice = sEmptyTrashNotice;
            if (this.info.folder == TRASH) {
                this.request("empty", loadAndRender);          
            } else {
                this.request("empty", execute);
            }      
        }
    },
    
    /**
     * Retrieves messages for the current folder and page.
     * @scope protected
     * @param iFolder The folder to retrieve.
     * @param iPage The page in that folder to retrieve.
     */
    getMessages: function (iFolder, iPage) {
        this.info.folder = iFolder;
        this.info.page = iPage;
        this.navigate("getfolder");
    },    
            
    /**
     * Loads data from the server into the mailbox.
     * @scope protected
     * @param vInfo A JSON-encoded string containing mailbox information or an info object.
     */
    loadInfo: function (vInfo) {
        if (typeof vInfo == "string") {
            this.info = JSON.parse(vInfo);  
        } else {
            this.info = vInfo;
        }  
    },    
    
    /**
     * Loads message data from the server into the mailbox.
     * @scope protected
     * @param vMessage A JSON-encoded string containing message information or a message object.
     */
    loadMessage: function (vMessage) {
        if (typeof vMessage == "string") {
            this.message = JSON.parse(vMessage);  
        } else {
            this.message = vMessage;
        }  
    },       
    
    /**
     * Makes a request to the server.
     * @scope protected
     * @param sAction The action to perform.
     * @param fnCallback The function to call when the request completes.
     * @param sId The ID of the message to act on (optional).
     */
    navigate: function (sAction, sId) {
        if (this.processing) return;
        try {
            this.setProcessing(true);
            var sURL = sAjaxMailNavigateURL + "?folder=" +this.info.folder + "&page=" + this.info.page + "&action=" + sAction;
            if (sId) {
                sURL += "&id=" + sId;
            }
            this.iLoader.src = sURL;
        } catch (oException) {
            this.showNotice("error", oException.message);
        }
    },        
    
    /**
     * Retrieves messages for the next page in the current folder.
     * @scope protected
     * @param iFolder The folder to retrieve.
     * @param iPage The page in that folder to retrieve.
     */
    nextPage: function () {
        this.getMessages(this.info.folder, this.info.page+1);
    },
        
    /**
     * Retrieves messages for the previous page in the current folder.
     * @scope protected
     * @param iFolder The folder to retrieve.
     * @param iPage The page in that folder to retrieve.
     */
    prevPage: function () {
        this.getMessages(this.info.folder, this.info.page-1);
    },   
    
    /**
     * Begins download of the given message.
     * @param sId The message ID to retrieve.
     */
    readMessage: function (sId) {
        this.navigate("getmessage", sId);
    },    
    
    /**
     * Refreshes the current folder's view.
     * @scope protected
     * @param iFolder The ID of the new folder to refresh.
     */
    refreshFolder: function (iFolder) {
        this.info.folder = iFolder;
        this.info.page = 1;
        this.request("getfolder", loadAndRender);     
    },        
    
    /**
     * Makes a request to the server.
     * @scope protected
     * @param sAction The action to perform.
     * @param fnCallback The function to call when the request completes.
     * @param sId The ID of the message to act on (optional).
     */
    request: function (sAction, fnCallback, sId) {
        if (this.processing) return;
        try {
            this.setProcessing(true);
            var oXmlHttp = zXmlHttp.createRequest();
            var sURL = sAjaxMailURL + "?folder=" +this.info.folder + "&page=" + this.info.page + "&action=" + sAction;
            if (sId) {
                sURL += "&id=" + sId;
            }

            oXmlHttp.open("get", sURL, true);
            oXmlHttp.onreadystatechange = function (){
                try {
                    if (oXmlHttp.readyState == 4) {
                        if (oXmlHttp.status == 200) {   
                            fnCallback(oXmlHttp.responseText);                     
                        } else {
                            throw new Error("An error occurred while attempting to contact the server. The action (" + sAction + ") did not complete.");
                        }
                    }
                } catch (oException) {
                    oMailbox.showNotice("error", oException.message);
                }
            };
            oXmlHttp.send(null);
        } catch (oException) {
            this.showNotice("error", oException.message);
        }
    },            
        
    /**
     * Moves a message from the trash to the inbox.
     * @scope protected
     * @param sId The ID of the message.
     */
    restoreMessage: function (sId) {
        this.nextNotice = sRestoreMailNotice;
        this.request("restore", loadAndRender, sId);        
    },  
    
    /**
     * Makes a request to the server.
     * @scope protected
     * @param sAction The action to perform.
     * @param fnCallback The function to call when the request completes.
     * @param sId The ID of the message to act on (optional).
     */
    sendMail: function () {
        if (this.processing) return;
        this.divComposeMailForm.style.display  = "none";
        this.divComposeMailStatus.style.display = "block";
        
        try {
            this.setProcessing(true);
            var oXmlHttp = zXmlHttp.createRequest();
            var sData = getRequestBody(document.forms["frmSendMail"]);

            oXmlHttp.open("post", sAjaxMailSendURL, true);
            oXmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                 
            oXmlHttp.onreadystatechange = function (){
                try {
                    if (oXmlHttp.readyState == 4) {
                        if (oXmlHttp.status == 200) {   
                            sendConfirmation(oXmlHttp.responseText);                     
                        } else {
                            throw new Error("An error occurred while attempting to contact the server. The mail was not sent.");
                        }
                    }
                } catch (oException) {
                    oMailbox.showNotice("error", oException.message);
                }
            };
            oXmlHttp.send(sData);
        } catch (oException) {
            this.showNotice("error", oException.message);
        }
    },              
    
    /**
     * Sets the UI to be enabled or disabled.
     * @scope protected
     * @param bProcessing True to enable, false to disable.
     */
    setProcessing: function (bProcessing) {
        this.processing = bProcessing;
        this.divFolderStatus.style.display = bProcessing ? "block" : "none";
    },
        
    /**
     * Switches the view to a new folder.
     * @scope protected
     * @param iNewFolder The ID of the new folder to switch to.
     */
    switchFolder: function (iNewFolder) {
        this.getMessages(iNewFolder, 1);        
    },        
        
    //-----------------------------------------------------
    // UI-Related Methods
    //-----------------------------------------------------
        
    /**
     * Cancels the reply and sends back to read mail view.
     * @scope protected
     */
    cancelReply: function () {
        history.go(-1);
    },    
            
    compose: function () {
        this.navigate("compose");
    },    
    
    displayCompose: function () {
        this.displayComposeMailForm("", "", "", ""); 
    },
    
    displayComposeMailForm: function (sTo, sCC, sSubject, sMessage) {
        this.txtTo.value = sTo;
        this.txtCC.value = sCC;        
        this.txtSubject.value = sSubject;
        this.txtMessage.value = sMessage;
        this.divReadMail.style.display = "none";
        this.divComposeMail.style.display = "block";     
        this.divFolder.style.display = "none";
        this.setProcessing(false);        
    },
        
    displayFolder: function (oInfo) {
        this.loadInfo(oInfo);
        this.renderFolder();
        this.setProcessing(false);
    },
    
    displayForward: function () {
        this.displayComposeMailForm("", "", 
                     "Fwd: " + this.message.subject,
                     "---------- Forwarded message ----------\n" + this.message.message);   
    },    
    
    displayMessage: function (oMessage) {
        this.loadMessage(oMessage);        
        this.renderMessage();
        this.setProcessing(false);
    },
   
    displayReply: function () {
        var sTo = this.message.from;
        var sCC = "";
    
        this.displayComposeMailForm(sTo, sCC, "Re: " + this.message.subject,
            "\n\n\n\n\n" + this.message.from + "said: \n" + this.message.message);
    
    },
    
    displayReplyAll: function () {
        var sTo = this.message.from + "," + this.message.to;
        var sCC = this.message.cc;
    
        this.displayComposeMailForm(sTo, sCC, "Re: " + this.message.subject,
            "\n\n\n\n\n" + this.message.from + "said: \n" + this.message.message);
    
    },
    
    forward: function () {
        this.navigate("forward");
    },
    
    /**
     * Initializes DOM pointers and other property values.
     * @scope protected
     */
    init: function () {
        var colAllElements = document.getElementsByTagName("*");
        if (colAllElements.length == 0) {
            colAllElements = document.all;
        }
        
        for (var i=0; i < colAllElements.length; i++) {
            if (colAllElements[i].id.length > 0) {
                this[colAllElements[i].id] = colAllElements[i];
            }
        }
         
        //assign event handlers        
        this.imgPrev.onclick = function () {
            oMailbox.prevPage();
        };
        
        this.imgNext.onclick = function () {
            oMailbox.nextPage();
        };
        
        this.spnCompose.onclick = function () {
            oMailbox.compose();
        };
        
        this.spnInbox.onclick = function () {
            if (oMailbox.info.folder == INBOX) {
                oMailbox.refreshFolder(INBOX);
            } else {
                oMailbox.switchFolder(INBOX);
            }
        };
        
        this.spnTrash.onclick = function () {
            if (oMailbox.info.folder == TRASH) {
                oMailbox.refreshFolder(TRASH);
            } else {
                oMailbox.switchFolder(TRASH);
            }
        };        
        this.spnEmpty.onclick = function () {
            oMailbox.emptyTrash();
        };        
        this.spnReply.onclick = function () {
            oMailbox.reply(false);
        };        
        this.spnReplyAll.onclick = function () {
            oMailbox.reply(true);
        };        
        this.spnForward.onclick = function () {
            oMailbox.forward();
        };
        this.spnCancel.onclick = function () {
            oMailbox.cancelReply();
        };        
        this.spnSend.onclick = function () {
            oMailbox.sendMail();
        };
    },
        
    /**
     * Initializes and loads the mailbox with the initial page.
     * @scope protected
     */
    load: function () {
        this.init();
        this.getMessages(INBOX, 1);        
    },
    
    /**
     * Renders the messages on the screen.
     * @scope protected
     */
    renderFolder: function () {;
        var tblMain = this.tblMain;

        //remove all child nodes
        while (tblMain.tBodies[0].hasChildNodes()) {
            tblMain.tBodies[0].removeChild(tblMain.tBodies[0].firstChild);
        }                

        //create document fragment to store new DOM objects
        var oFragment = document.createDocumentFragment();

        //add a new row for each message
        if (this.info.messages.length) {
            for (var i=0; i < this.info.messages.length; i++) {
                var oMessage = this.info.messages[i];
                var oNewTR = this.trTemplate.cloneNode(true);
                oNewTR.id = "tr" + oMessage.id;
                oNewTR.onclick = readMail;
                
                if (oMessage.unread) {
                    oNewTR.className = "new";
                }
                
                var colCells = oNewTR.getElementsByTagName("td");
                var imgAction = colCells[0].childNodes[0];
                imgAction.id = oMessage.id;
                if (this.info.folder == TRASH) {
                    imgAction.onclick = restoreMail;
                    imgAction.src = sRestoreIcon;
                    imgAction.title = sRestore;
                } else {
                    imgAction.onclick = deleteMail;
                    imgAction.src = sDeleteIcon;
                    imgAction.title = sDelete;
                }
                
                colCells[1].appendChild(document.createTextNode(cleanupEmail(oMessage.from)));
                colCells[2].firstChild.style.visibility = oMessage.hasAttachments ? "visible" : "hidden";
                colCells[3].appendChild(document.createTextNode(htmlEncode(oMessage.subject)));
                colCells[4].appendChild(document.createTextNode(oMessage.date));
                oFragment.appendChild(oNewTR);           
            }
        } else {
            var oNewTR = this.trNoMessages.cloneNode(true);
            oFragment.appendChild(oNewTR);
        }

        //add the message rows
        tblMain.tBodies[0].appendChild(oFragment);
        
        //only change folder name if it's different
        if (this.hFolderTitle.innerHTML != aFolders[this.info.folder]) {
            this.hFolderTitle.innerHTML = aFolders[this.info.folder];
        }
        
        //update unread message count for Inbox
        this.updateUnreadCount(this.info.unreadCount);
             
        //set up the message count (hide if there are no messages)
        this.spnItems.style.visibility = this.info.messages.length ? "visible" : "hidden";
        this.spnItems.innerHTML = this.info.firstMessage + "-" + (this.info.firstMessage + this.info.messages.length - 1) + " of " + this.info.messageCount;

        //determine show/hide of pagination images
        if (this.info.pageCount > 1) {
            this.imgNext.style.visibility = this.info.page < this.info.pageCount ? "visible" : "hidden";
            this.imgPrev.style.visibility = this.info.page > 1 ? "visible" : "hidden";
        } else {
            this.imgNext.style.visibility = "hidden";
            this.imgPrev.style.visibility = "hidden";
        }              
        
        this.divFolder.style.display = "block";
        this.divReadMail.style.display = "none";        
        this.divComposeMail.style.display = "none";        
    },
    
    renderMessage: function () {
        this.hSubject.innerHTML = htmlEncode(this.message.subject);
        this.divMessageFrom.innerHTML = sFrom + " " + htmlEncode(this.message.from);
        this.divMessageTo.innerHTML = sTo + " " + htmlEncode(this.message.to);
        this.divMessageCC.innerHTML = this.message.cc.length ? sCC + " " + htmlEncode(this.message.cc) : "";
        this.divMessageBCC.innerHTML = this.message.bcc.length ? sBCC + " " + htmlEncode(this.message.bcc) : "";
        this.divMessageDate.innerHTML = this.message.date;
        this.divMessageBody.innerHTML = this.message.message;
        
        if (this.message.hasAttachments) {
            this.ulAttachments.style.display = "";
            
            var oFragment = document.createDocumentFragment();
            
            for (var i=0; i < this.message.attachments.length; i++) {
                var oLI = document.createElement("li");
                oLI.className = "attachment";
                oLI.innerHTML = "<a href=\"" + sAjaxMailAttachmentURL + "?id=" + this.message.attachments[i].id + "\" target=\"_blank\">" + this.message.attachments[i].filename + "</a> (" + this.message.attachments[i].size + ")";
                oFragment.appendChild(oLI);
            }
            
            this.ulAttachments.appendChild(oFragment);
            this.liAttachments.style.display = "";
        } else {
            this.ulAttachments.style.display = "none";
            this.liAttachments.style.display = "none";
            this.ulAttachments.innerHTML = "";
        }
        
        this.updateUnreadCount(this.message.unreadCount);
        this.divFolder.style.display = "none";
        this.divReadMail.style.display = "block";
        this.divComposeMail.style.display = "none";
    },
    
    /**
     * Sets up the screen to reply to an e-mail.
     * @scope protected
     * @param blnAll Set to true for "reply to all"
     */
    reply: function (blnAll) {
        this.navigate("reply" + (blnAll ? "all" : ""));
    },
    
    /**
     * Shows a message on the screen.
     * @scope protected
     * @param sType The type of message to display.
     * @param sMessage The message to display.
     */
    showNotice: function (sType, sMessage) {
        var divNotice = this.divNotice;
        divNotice.className = sType;
        divNotice.innerHTML = sMessage;
        divNotice.style.visibility = "visible";
        setTimeout(function () {
            divNotice.style.visibility = "hidden";
        }, iShowNoticeTime);    
    },
    
    /**
     * Updates the count of unread messages displayed on
     * the screen.
     * @scope protected
     * @param iCount The number of unread messages.
     */
    updateUnreadCount: function (iCount) {
        this.spnUnreadMail.innerHTML = iCount > 0 ? " (" + iCount + ")" : "";
    }
};

/*-------------------------------------------------------
 * Callback Functions
 *-------------------------------------------------------*/

/**
 * Callback function to execute a client-server request and display
 * a notification about the result.
 * @scope protected.
 * @param sInfo The information returned from the server.
 */
function execute(sInfo) {
    if (oMailbox.nextNotice) {
        oMailbox.showNotice("info", oMailbox.nextNotice);
        oMailbox.nextNotice = null;
    }
    oMailbox.setProcessing(false);
}

/**
 * Callback function to execute a client-server request and then
 * load and display new mail information.
 * @scope protected.
 * @param sInfo The information returned from the server.
 */
function loadAndRender(sInfo) {

    oMailbox.loadInfo(sInfo);
    oMailbox.renderFolder();
    
    if (oMailbox.nextNotice) {
        oMailbox.showNotice("info", oMailbox.nextNotice);
        oMailbox.nextNotice = null;
    }
    oMailbox.setProcessing(false);        
}

/**
 * The callback function when attempting to send an e-mail.
 * @scope protected
 * @param sData The data returned from the server.
 */
function sendConfirmation(sData) {
    var oResponse = JSON.parse(sData);
    if (oResponse.error) {
        alert("An error occurred:\n" + oResponse.message);
    } else {
        oMailbox.showNotice("info", oResponse.message);
        oMailbox.divComposeMail.style.display = "none";
        oMailbox.divReadMail.style.display = "none";
        oMailbox.divFolder.style.display = "block";
    }
    oMailbox.divComposeMailForm.style.display  = "block";
    oMailbox.divComposeMailStatus.style.display = "none";        
    oMailbox.setProcessing(false);
}

/*-------------------------------------------------------
 * Event Handlers and Function Pointers
 *-------------------------------------------------------*/


function deleteMail() {
    oMailbox.deleteMessage(this.id); 
}

function restoreMail() {
    oMailbox.restoreMessage(this.id); 
}

function readMail() {
    oMailbox.readMessage(this.id.substring(2));
}






/*-------------------------------------------------------
 * Helper Functions/Data
 *-------------------------------------------------------*/

var reNameAndEmail = /(.*?)<(.*?)>/i;

function cleanupEmail(sText) {
    if (reNameAndEmail.test(sText)) {
        return RegExp.$1.replace(/"/g, "");
    } else {
        return sText;
    }
}

function htmlEncode(sText) {
    if (sText) {
        return sText.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;")
    } else {
        return "";
    }
}

function getRequestBody(oForm) {
    var aParams = new Array();
    
    for (var i=0 ; i < oForm.elements.length; i++) {
        var sParam = encodeURIComponent(oForm.elements[i].name);
        sParam += "=";
        sParam += encodeURIComponent(oForm.elements[i].value);
        aParams.push(sParam);
    } 
    
    return aParams.join("&");        
}
        
//assign the mailbox to load when the page has completed loading
window.onload = function () {
    oMailbox.load();
};