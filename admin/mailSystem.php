<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Mail');
	juassi_set_in_admin(true);
        include 'include/html-header.php';
?>

<ul id="ulMainMenu">
    <li id="liCompose"><span class="link" id="spnCompose">Nuevo Mail</span></li>
    <li><span class="link" id="spnInbox" ">Bandeja de Entrada<span id="spnUnreadMail" style="color:red;"></span></span></li>
    <li><span class="link" id="spnTrash">Papelera</span> <span class="link" id="spnEmpty" style="color:red;"><?php echo '|'.juassi_total_mailTrash_count().'|'; ?></span></li>
</ul>
<div id="divNotice"></div>       
        <div id="divFolder">            
            <div id="divFolderHeader" class="header">
                 <h1 id="hFolderTitle">Bandeja de Entrada</h1>
                 <div id="divFolderStatus" class="status"><img src="../juassi-resources/img/ajax_loader.gif"/></div>
                 <div id="divItemCount"><img src="../juassi-resources/img/btn_prev.gif" alt="Previous Page" title="Previous Page" id="imgPrev" /><span id="spnItems"></span><img src="../juassi-resources/img/btn_next.gif" alt="Next Page" title="Next Page" id="imgNext" /></div>
            </div>
            <table border="0" cellpadding="0" cellspacing="0" id="tblMain">
                <thead>
                    <tr id="trTemplate">
                        <td><img src="../juassi-resources/img/icon_delete.gif" /></td>
                        <td class="from"></td>
                        <td class="attachment"><img src="../juassi-resources/img/icon_attachment.gif" title="Attachment" /></td>
                        <td class="subject"></td>
                        <td class="date" nowrap="nowrap"></td>
                    </tr>       
                    <tr id="trNoMessages">
                        <td colspan="5">No hay mensajes en esta carpeta.</td>
                    </tr>         
                </thead>
                <tbody>
                    <tr style="visibility: hidden">
                        <td colspan="5"></td>
                    </tr>                    
                </tbody>
            </table>
        </div>  
        <div id="divReadMail" style="display: none">
            <div class="header">
                 <h1 id="hSubject"></h1>
            </div>
             <div class="message-headers">
                 <div id="divMessageFrom"></div>
                 <div id="divMessageDate"></div>
             </div>    
             <div id="divMessageTo"></div>
             <div id="divMessageCC"></div>    
             <div id="divMessageBCC"></div>
             <ul class="message-actions">
                 <li><span class="link" id="spnReply">Responder</span></li>
                 <li><span class="link" id="spnReplyAll">Responder todos</span></li>
                 <li><span class="link" id="spnForward">Siguiente</span></li>  
                 <li id="liAttachments"><a href="#attachments">Ver adjuntos</a></li>                                              
             </ul>             
            <div id="divMessageBody"></div>
            <a name="attachments" id="aAttachments">Adjuntos</a>
            <div id="divMessageAttachments">
                <ul id="ulAttachments">
                </ul>
            </div>

        </div>        
               
        <div id="divComposeMail" style="display: none">
            <div class="header">
                 <h1 id="hComposeHeader">Nuevo mail</h1>
            </div>
            <div id="divComposeMailForm">
             <ul id="ulComposeActions" class="message-actions">
                 <li><span class="link" id="spnSend">Enviar</span></li>
                 <li><span class="link" id="spnCancel">Cancelar</span></li>                
             </ul>             
             <div id="divComposeBody">
                 <form method="post" name="frmSendMail">
                     <table border="0" cellpadding="0" cellspacing="0">
                         <tr>
                             <td class="field-label-container"><label for="txtTo" class="field-label">Para:</label></td>
                             <td class="field-container"><textarea rows="2" cols="30" id="txtTo" name="txtTo" class="form-field"></textarea></td>
                         </tr>
                         <tr>
                             <td class="field-label-container"><label for="txtCC" class="field-label">CC:</label></td>
                             <td class="field-container"><textarea rows="2" cols="30" id="txtCC" name="txtCC" class="form-field"></textarea></td>
                         </tr>
                         <tr>
                             <td class="field-label-container"><label for="txtSubject" class="field-label">Asunto:</label></td>
                             <td class="field-container"><input type="text" id="txtSubject" name="txtSubject"  class="form-field" /></td>
                         </tr>
                         <tr>
                             <td class="message-container" colspan="2"><textarea id="txtMessage" name="txtMessage" rows="15" cols="30" class="form-field"></textarea></td>
                         </tr>
                     </table>
                 </form>             
             </div>
             </div>
             <div id="divComposeMailStatus" style="display: none">
                 <h2>Enviando...</h2>
                 <img src="../juassi-resources/img/sendmail.gif" />
             </div>
        </div>                
        <iframe id="iLoader" src="about:blank"></iframe>
<script src="../juassi-resources/javascript/gebo_dashboard.js"></script>        
<?php
include 'include/sidebar.php';
include 'include/html-footer.php';
?>