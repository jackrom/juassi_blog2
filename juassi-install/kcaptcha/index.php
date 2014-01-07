<?php
/******************************************************************************
 *
 *	 COMPANY: Intelliants LLC
 *	 PROJECT: Subrion Content Management System
 *	 VERSION: 2.3.7
 *	 LICENSE: http://www.subrion.com/license.html
 *	 http://www.subrion.com/
 *
 *	 This program is an open source php content management system.
 *
 *	 Link to Subrion.com may not be removed from the software pages
 *	 without permission of Subrion CMS respective owners. Copyright
 *	 link may be removed for the paid versions only.
 *
 *	 PHP code copyright notice may not be removed from source code
 *	 in any case.
 *
 *	 Copyright 2009-2013 Intelliants LLC
 *	 http://www.intelliants.com/
 *
 ******************************************************************************/


require_once IA_PLUGINS . 'kcaptcha' . IA_DS . 'includes' . IA_DS . 'kcaptcha' . IA_DS . 'captcha.php';

$captcha = new KCAPTCHA();

$captcha->length = $iaCore->get('captcha_num_chars');

$captcha->getImage();

$_SESSION['pass'] = $captcha->getKeyString();