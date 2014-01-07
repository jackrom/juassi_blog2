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


class iaCaptcha extends abstractUtil
{


	public function getImage()
	{
		$html =
			'<p class="field-captcha">' .
			'<img src=":url" onclick="$(this).attr(\'src\', \':url?\'+Math.random())" title=":title" alt="captcha" style="cursor:pointer; margin-right: 10px;" align="left" />' .
			':text<br />' .
			'<input type="text" class="span1" name="security_code" size=":length" maxlength=":length" id="securityCode" />' .
			'</p>' .
			'<div class="clearfix"></div>'
		;
		$html = iaDb::printf($html, array(
			'length' => (int)$this->iaCore->get('captcha_num_chars'),
			'url' => IA_URL . 'captcha/',
			'text' => iaLanguage::get('captcha_annotation'),
			'title' => iaLanguage::get('click_to_redraw')
		));

		return $html;
	}

	public function validate()
	{
		if (IN_USER)
		{
			return true;
		}

		$sc1 = isset($_POST['security_code']) ? $_POST['security_code'] : (isset($_GET['security_code']) ? $_GET['security_code'] : '');
		$sc2 = $_SESSION['pass'];

		$functionName = $this->iaCore->get('captcha_case_sensitive') ? 'strcmp' : 'strcasecmp';

		if (empty($_SESSION['pass']) || $functionName($sc1, $sc2) !== 0)
		{
			return false;
		}

		$_SESSION['pass'] = '';

		return true;
	}

	public function getPreview()
	{
		$html = '<img src=":url" onclick="$(this).attr(\'src\', \':url?\'+Math.random())" alt="captcha" style="cursor:pointer; margin-right: 10px;" align="left" />';
		$html = iaDb::printf($html, array(
			'url' => IA_URL . 'captcha/'
		));

		return $html;
	}
}