<?php
define('JUASSI_REL_ROOT', './../');
$juassi_input_error = '';
include('../functions/juassi_common.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/general-admin-template.functions.php');



juassi_set_admin_title('Registro');
if (juassi_is_logged_in()) {
	juassi_set_header('Location: ' . $_SESSION['juassi_page']);
	juassi_send_headers();
	exit;
}


// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit'])) { // Form has been submitted.
	
	if (ALLOW_REGISTRATIONS == "NO") {
		$invite_code = $_POST['invite_code'];
		$invite = Invites::check_invite_code("$invite_code");
	}
	
	$username = trim($_POST['username']);
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$password = trim($_POST['password']);
	$repeat_password = trim($_POST['repeat_password']);
	$email = trim($_POST['email']);
	$signup_ip = $_SERVER['REMOTE_ADDR'];
	$country = $_POST['country'];
	$gender = $_POST['gender'];

	$check_username = User::check_user('username', $username);
	$check_email = User::check_user('email', $email);
	// $invite = Invites::check_invite_code("$invite_code");
	
	if (DEMO_MODE == 'ON') {
		$message = "<div class='notification-box warning-notification-box'><p>Lo sentimos, no puedes hacer esto mientras este activo el modo demo.</p><a href='#' class='notification-close warning-notification-close'>x</a></div><!--.notification-box .notification-box-warning end-->";
	} else {
		if ($username != "" && $password != "" && $repeat_password != ""  && $first_name != "" && $last_name != "" && $email != "" && $country != "" && $gender != "") {
		  if($password == $repeat_password){
			if(!$check_username){
				if(!$check_email){
					if (ALLOW_REGISTRATIONS == "NO") {
						if($invite){
							// now that everything is ok, we can now register the user.
							$plain_password = $password;
							$password = md5($password);
							$user->create_account($username, $password, $email, $first_name, $last_name, $plain_password, $signup_ip, $country, $gender, $invite_code);
						} else {
							$message = "<div class='notification-box warning-notification-box'><p>Lo sentimos pero este c&oacute;digo de invitado no existe.</p><a href='#' class='notification-close warning-notification-close'>x</a></div><!--.notification-box .notification-box-warning end-->";
						}
					} else {
						$plain_password = $password;
						$password = md5($password);
						$user->create_account($username, $password, $email, $first_name, $last_name, $plain_password, $signup_ip, $country, $gender);
					}
					// now that everything is ok, we can now register the user.
					// $plain_password = $password;
					// $password = md5($password);
					// $user->create_account($username, $password, $email, $first_name, $last_name, $plain_password, $signup_ip, $country, $gender);
				} else {
					$message = "<div class='notification-box warning-notification-box'><p>Lo sentimos, pero este email ya existe en nuestras base de datos.</p><a href='#' class='notification-close warning-notification-close'>x</a></div><!--.notification-box .notification-box-warning end-->";
				}
			} else {
				$message = "<div class='notification-box warning-notification-box'><p>Lo sentimos, Este usuario ya ha sido tomado.</p><a href='#' class='notification-close warning-notification-close'>x</a></div><!--.notification-box .notification-box-warning end-->";
			}
		  } else {
			$message = "<div class='notification-box warning-notification-box'><p>Las contrase&ntilde;as no coinciden.</p><a href='#' class='notification-close warning-notification-close'>x</a></div><!--.notification-box .notification-box-warning end-->";
		  }
	  	} else {
			$message = "<div class='notification-box warning-notification-box'><p>Por favor, rellene todos los campos.</p><a href='#' class='notification-close warning-notification-close'>x</a></div><!--.notification-box .notification-box-warning end-->";
		}
	}
  
} else { // Form has not been submitted.
  $username = "";
  $password = "";
  $repeat_password = "";
  $first_name = "";
  $last_name = "";
  $email = "";
  $invite_code = "";
  $gender = "";
  $country = "";
}

?>
<?php include('login/header.php'); ?>

<section class="title">&nbsp;&nbsp;&nbsp;&nbsp;Crear una cuenta</section>
	<div class="container">	
		
		
		
		<form action="register.php" method="post" class="formee">
			<section id="main" class="formee">
				
				<?php if(ALLOW_REGISTRATIONS == "NO") : ?>
					<h4>Lo sentimos, pero en estos momentos los nuevos registros se encuentran cerrados, sin embargo, puedes entrar si tienes un c&oacute;digo de invitados.</h4>
				<div class="grid-4-12">
		                
		        </div>
				<div class="grid-4-12">
		                <label>Invite Code <em class="formee-req">*</em></label>
		               	<input type="text" id="invite_code" name="invite_code" required value="<?php echo htmlentities($invite_code); ?>" />
		        </div>
				<div class="clear"></div><!--.clear end-->
		        <hr />
				<?php endif; ?>
		        <div class="grid-4-12">
		                <label>Nombres <em class="formee-req">*</em></label>
		               	<input type="text" id="first_name" name="first_name" required value="<?php echo htmlentities($first_name); ?>" />
		        </div>
		        <div class="grid-4-12">
		                <label>Apellidos <em class="formee-req">*</em></label>
		               	<input type="text" id="last_name" name="last_name" required value="<?php echo htmlentities($last_name); ?>" />
		        </div>
		        <div class="grid-4-12">
		                <label>Pa&iacute;s <em class="formee-req">*</em></label>
		               	<select name="country" id="country" required="required" value="<?php echo $country ?>">
							<option value="Venezuela">Venezuela</option> 
                            <option value="United States">United States</option>
							<option value="United Kingdom">United Kingdom</option> 
							<option value="Afghanistan">Afghanistan</option> 
							<option value="Albania">Albania</option> 
							<option value="Algeria">Algeria</option> 
							<option value="American Samoa">American Samoa</option> 
							<option value="Andorra">Andorra</option> 
							<option value="Angola">Angola</option> 
							<option value="Anguilla">Anguilla</option> 
							<option value="Antarctica">Antarctica</option> 
							<option value="Antigua and Barbuda">Antigua and Barbuda</option> 
							<option value="Argentina">Argentina</option> 
							<option value="Armenia">Armenia</option> 
							<option value="Aruba">Aruba</option> 
							<option value="Australia">Australia</option> 
							<option value="Austria">Austria</option> 
							<option value="Azerbaijan">Azerbaijan</option> 
							<option value="Bahamas">Bahamas</option> 
							<option value="Bahrain">Bahrain</option> 
							<option value="Bangladesh">Bangladesh</option> 
							<option value="Barbados">Barbados</option> 
							<option value="Belarus">Belarus</option> 
							<option value="Belgium">Belgium</option> 
							<option value="Belize">Belize</option> 
							<option value="Benin">Benin</option> 
							<option value="Bermuda">Bermuda</option> 
							<option value="Bhutan">Bhutan</option> 
							<option value="Bolivia">Bolivia</option> 
							<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
							<option value="Botswana">Botswana</option> 
							<option value="Bouvet Island">Bouvet Island</option> 
							<option value="Brazil">Brazil</option> 
							<option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
							<option value="Brunei Darussalam">Brunei Darussalam</option> 
							<option value="Bulgaria">Bulgaria</option> 
							<option value="Burkina Faso">Burkina Faso</option> 
							<option value="Burundi">Burundi</option> 
							<option value="Cambodia">Cambodia</option> 
							<option value="Cameroon">Cameroon</option> 
							<option value="Canada">Canada</option> 
							<option value="Cape Verde">Cape Verde</option> 
							<option value="Cayman Islands">Cayman Islands</option> 
							<option value="Central African Republic">Central African Republic</option> 
							<option value="Chad">Chad</option> 
							<option value="Chile">Chile</option> 
							<option value="China">China</option> 
							<option value="Christmas Island">Christmas Island</option> 
							<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 
							<option value="Colombia">Colombia</option> 
							<option value="Comoros">Comoros</option> 
							<option value="Congo">Congo</option> 
							<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option> 
							<option value="Cook Islands">Cook Islands</option> 
							<option value="Costa Rica">Costa Rica</option> 
							<option value="Cote D'ivoire">Cote D'ivoire</option> 
							<option value="Croatia">Croatia</option> 
							<option value="Cuba">Cuba</option> 
							<option value="Cyprus">Cyprus</option> 
							<option value="Czech Republic">Czech Republic</option> 
							<option value="Denmark">Denmark</option> 
							<option value="Djibouti">Djibouti</option> 
							<option value="Dominica">Dominica</option> 
							<option value="Dominican Republic">Dominican Republic</option> 
							<option value="Ecuador">Ecuador</option> 
							<option value="Egypt">Egypt</option> 
							<option value="El Salvador">El Salvador</option> 
							<option value="Equatorial Guinea">Equatorial Guinea</option> 
							<option value="Eritrea">Eritrea</option> 
							<option value="Estonia">Estonia</option> 
							<option value="Ethiopia">Ethiopia</option> 
							<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 
							<option value="Faroe Islands">Faroe Islands</option> 
							<option value="Fiji">Fiji</option> 
							<option value="Finland">Finland</option> 
							<option value="France">France</option> 
							<option value="French Guiana">French Guiana</option> 
							<option value="French Polynesia">French Polynesia</option> 
							<option value="French Southern Territories">French Southern Territories</option> 
							<option value="Gabon">Gabon</option> 
							<option value="Gambia">Gambia</option> 
							<option value="Georgia">Georgia</option> 
							<option value="Germany">Germany</option> 
							<option value="Ghana">Ghana</option> 
							<option value="Gibraltar">Gibraltar</option> 
							<option value="Greece">Greece</option> 
							<option value="Greenland">Greenland</option> 
							<option value="Grenada">Grenada</option> 
							<option value="Guadeloupe">Guadeloupe</option> 
							<option value="Guam">Guam</option> 
							<option value="Guatemala">Guatemala</option> 
							<option value="Guinea">Guinea</option> 
							<option value="Guinea-bissau">Guinea-bissau</option> 
							<option value="Guyana">Guyana</option> 
							<option value="Haiti">Haiti</option> 
							<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option> 
							<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 
							<option value="Honduras">Honduras</option> 
							<option value="Hong Kong">Hong Kong</option> 
							<option value="Hungary">Hungary</option> 
							<option value="Iceland">Iceland</option> 
							<option value="India">India</option> 
							<option value="Indonesia">Indonesia</option> 
							<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
							<option value="Iraq">Iraq</option> 
							<option value="Ireland">Ireland</option> 
							<option value="Israel">Israel</option> 
							<option value="Italy">Italy</option> 
							<option value="Jamaica">Jamaica</option> 
							<option value="Japan">Japan</option> 
							<option value="Jordan">Jordan</option> 
							<option value="Kazakhstan">Kazakhstan</option> 
							<option value="Kenya">Kenya</option> 
							<option value="Kiribati">Kiribati</option> 
							<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option> 
							<option value="Korea, Republic of">Korea, Republic of</option> 
							<option value="Kuwait">Kuwait</option> 
							<option value="Kyrgyzstan">Kyrgyzstan</option> 
							<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
							<option value="Latvia">Latvia</option> 
							<option value="Lebanon">Lebanon</option> 
							<option value="Lesotho">Lesotho</option> 
							<option value="Liberia">Liberia</option> 
							<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 
							<option value="Liechtenstein">Liechtenstein</option> 
							<option value="Lithuania">Lithuania</option> 
							<option value="Luxembourg">Luxembourg</option> 
							<option value="Macao">Macao</option> 
							<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option> 
							<option value="Madagascar">Madagascar</option> 
							<option value="Malawi">Malawi</option> 
							<option value="Malaysia">Malaysia</option> 
							<option value="Maldives">Maldives</option> 
							<option value="Mali">Mali</option> 
							<option value="Malta">Malta</option> 
							<option value="Marshall Islands">Marshall Islands</option> 
							<option value="Martinique">Martinique</option> 
							<option value="Mauritania">Mauritania</option> 
							<option value="Mauritius">Mauritius</option> 
							<option value="Mayotte">Mayotte</option> 
							<option value="Mexico">Mexico</option> 
							<option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 
							<option value="Moldova, Republic of">Moldova, Republic of</option> 
							<option value="Monaco">Monaco</option> 
							<option value="Mongolia">Mongolia</option> 
							<option value="Montserrat">Montserrat</option> 
							<option value="Morocco">Morocco</option> 
							<option value="Mozambique">Mozambique</option> 
							<option value="Myanmar">Myanmar</option> 
							<option value="Namibia">Namibia</option> 
							<option value="Nauru">Nauru</option> 
							<option value="Nepal">Nepal</option> 
							<option value="Netherlands">Netherlands</option> 
							<option value="Netherlands Antilles">Netherlands Antilles</option> 
							<option value="New Caledonia">New Caledonia</option> 
							<option value="New Zealand">New Zealand</option> 
							<option value="Nicaragua">Nicaragua</option> 
							<option value="Niger">Niger</option> 
							<option value="Nigeria">Nigeria</option> 
							<option value="Niue">Niue</option> 
							<option value="Norfolk Island">Norfolk Island</option> 
							<option value="Northern Mariana Islands">Northern Mariana Islands</option> 
							<option value="Norway">Norway</option> 
							<option value="Oman">Oman</option> 
							<option value="Pakistan">Pakistan</option> 
							<option value="Palau">Palau</option> 
							<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 
							<option value="Panama">Panama</option> 
							<option value="Papua New Guinea">Papua New Guinea</option> 
							<option value="Paraguay">Paraguay</option> 
							<option value="Peru">Peru</option> 
							<option value="Philippines">Philippines</option> 
							<option value="Pitcairn">Pitcairn</option> 
							<option value="Poland">Poland</option> 
							<option value="Portugal">Portugal</option> 
							<option value="Puerto Rico">Puerto Rico</option> 
							<option value="Qatar">Qatar</option> 
							<option value="Reunion">Reunion</option> 
							<option value="Romania">Romania</option> 
							<option value="Russian Federation">Russian Federation</option> 
							<option value="Rwanda">Rwanda</option> 
							<option value="Saint Helena">Saint Helena</option> 
							<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
							<option value="Saint Lucia">Saint Lucia</option> 
							<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 
							<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option> 
							<option value="Samoa">Samoa</option> 
							<option value="San Marino">San Marino</option> 
							<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
							<option value="Saudi Arabia">Saudi Arabia</option> 
							<option value="Senegal">Senegal</option> 
							<option value="Serbia and Montenegro">Serbia and Montenegro</option> 
							<option value="Seychelles">Seychelles</option> 
							<option value="Sierra Leone">Sierra Leone</option> 
							<option value="Singapore">Singapore</option> 
							<option value="Slovakia">Slovakia</option> 
							<option value="Slovenia">Slovenia</option> 
							<option value="Solomon Islands">Solomon Islands</option> 
							<option value="Somalia">Somalia</option> 
							<option value="South Africa">South Africa</option> 
							<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option> 
							<option value="Spain">Spain</option> 
							<option value="Sri Lanka">Sri Lanka</option> 
							<option value="Sudan">Sudan</option> 
							<option value="Suriname">Suriname</option> 
							<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 
							<option value="Swaziland">Swaziland</option> 
							<option value="Sweden">Sweden</option> 
							<option value="Switzerland">Switzerland</option> 
							<option value="Syrian Arab Republic">Syrian Arab Republic</option> 
							<option value="Taiwan, Province of China">Taiwan, Province of China</option> 
							<option value="Tajikistan">Tajikistan</option> 
							<option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
							<option value="Thailand">Thailand</option> 
							<option value="Timor-leste">Timor-leste</option> 
							<option value="Togo">Togo</option> 
							<option value="Tokelau">Tokelau</option> 
							<option value="Tonga">Tonga</option> 
							<option value="Trinidad and Tobago">Trinidad and Tobago</option> 
							<option value="Tunisia">Tunisia</option> 
							<option value="Turkey">Turkey</option> 
							<option value="Turkmenistan">Turkmenistan</option> 
							<option value="Turks and Caicos Islands">Turks and Caicos Islands</option> 
							<option value="Tuvalu">Tuvalu</option> 
							<option value="Uganda">Uganda</option> 
							<option value="Ukraine">Ukraine</option> 
							<option value="United Arab Emirates">United Arab Emirates</option> 
							<option value="United Kingdom">United Kingdom</option> 
							<option value="United States">United States</option> 
							<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option> 
							<option value="Uruguay">Uruguay</option> 
							<option value="Uzbekistan">Uzbekistan</option> 
							<option value="Vanuatu">Vanuatu</option>  
							<option value="Viet Nam">Viet Nam</option> 
							<option value="Virgin Islands, British">Virgin Islands, British</option> 
							<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 
							<option value="Wallis and Futuna">Wallis and Futuna</option> 
							<option value="Western Sahara">Western Sahara</option> 
							<option value="Yemen">Yemen</option> 
							<option value="Zambia">Zambia</option> 
							<option value="Zimbabwe">Zimbabwe</option>
						</select>
		        </div>
				<div class="clear"></div><!--.clear end-->
				<div class="grid-4-12">
		                <label>Genero <em class="formee-req">*</em></label>
		               	<select name="gender" id="gender" required="required" value="<?php echo $gender ?>">
							<option value="Male">Masculino</option>
							<option value="Female">Femenino</option> 
						</select>
		        </div>
				<div class="grid-4-12">
		                <label>Direcci&oacute;n de email <em class="formee-req">*</em></label>
		               	<input type="email" id="email" name="email" required value="<?php echo htmlentities($email); ?>" />
		        </div>
				<div class="grid-4-12">
		                <label>Usuario <em class="formee-req">*</em></label>
		               	<input type="text" id="username" name="username" required value="<?php echo htmlentities($username); ?>" />
		        </div>
				<div class="grid-4-12">
		                <label>Contrase&ntilde;a <em class="formee-req">*</em></label>
		               	<input type="password" id="password" name="password" value="<?php echo htmlentities($password); ?>" />
		        </div>
				<div class="grid-4-12">
		                <label>Repetir Contrase&ntilde;a <em class="formee-req">*</em></label>
		               	<input type="password" id="repeat_password" name="repeat_password" value="<?php echo htmlentities($repeat_password); ?>" />
		        </div>
				<div class="grid-4-12">
		                <div class="settings_btn"><input class="button topm23" type="submit" name="submit" value="Crear cuenta" /></div><!--.settings_btn end-->
		        </div>
			</section><!--#main end-->
		</form>
	<div class="clear"></div><!--.clear end-->
</div><!--.container end-->
	
