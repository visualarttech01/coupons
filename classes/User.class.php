
<?php
	class User {
		
		static function CheckEmail($email){
			global $DB;
			
			$sql = "SELECT id 
						FROM users
						WHERE email = '".$email."' ";

			$objData = $DB->Select($sql);
			if($objData){
				return false;
			}
			else{
				return true;
			}
		}
		static function CheckCNIC($cnic){
			global $DB;
		
			$sql = "SELECT id
						FROM contacts
						WHERE cnic = '".$cnic."' ";
			$objData = $DB->Select($sql);
			// 			print_r($sql);
			// 			exit;
			if($objData){
				// 				echo '<pre>';
				// 				print_r($objdata);
				// 				exit;
				return false;
			}
			else{
				return true;
			}
		}
		static function get_all_other_users(){
			global $DB;
			$sql = "SELECT *
						FROM users
						WHERE is_active = '1'
						AND id != '".Session::GetUser()->id."'
					ORDER BY name;";
			
			$objData = $DB->Select($sql);
			if($objData){
				return $objData;
			}
			else{
				return true;
			}
		}
		
		static function Save($objData){
			global $DB;
						
			if(isset($objData->password) && $objData->password != ""){
				$objData->password = md5($objData->password);
			}
			$objData->created = date('Y-m-d H:i:s');
			if(!isset($objData->is_active)){
				$objData->is_active = '0';
			}
			
			$NewUserID = $DB->Save('docters',$objData);

			return $NewUserID;
		}
		
		static function Activate($code){
			global $DB;
			
			$objUser = self::LoadByCode($code);
			if($objUser){
				$DB->Update("UPDATE users SET is_active = '1' WHERE MD5(CONCAT(id,email)) = '".$code."' ");
				$objUser = self::Load($objUser->id);
				Session::AddUser($objUser);
				return true;
			}
			else{
				return false;
			}
		}
		
		static function Validate($objData){
			global $DB;
			
			$sql = "SELECT id 
						FROM users 
						WHERE email = '".$objData->email."' 
						AND password = '".md5($objData->password)."' 
						AND is_active = '1' ";
			$objData = $DB->Select($sql);
			if($objData){
				$objUser = User::Load($objData[0]->id);
				Session::AddUser($objUser);
				return true;
			}
			else{
				return false;
			}
		}
		
		static function Logout(){
			Session::Destroy();
			return true;
		}
		
		static function LoadByCode($code,$type=''){
			global $DB;
			
			if($code != ''){
				$sql = "SELECT id 
							FROM users
							WHERE MD5(CONCAT(id,email)) = '".$code."' ";
				if($type == 'Login'){
					$sql .= "AND last_login IS NOT NULL ";
				}
				$objData = $DB->Select($sql);
				if($objData){
					return $objData[0];
				}
				else{
					return false;
				}
			}
			else{
				return false;
			}
		}
		
		static function Load($ID){
			global $DB;
			
// 			$loginTime = date("Y-m-d H:i:s",strtotime("-30 Minutes"));

			$sql = "SELECT *
						FROM users
						WHERE is_active = '1' 
						AND id = '".$ID."' ";
			$objData = $DB->Select($sql);
			if($objData){
				$objUser = $objData[0];
				return $objUser;
			}
			else{
				return false;
			}
		}
				
		static function ForgotPWD($objData){
			global $DB;
			
			$sql = "SELECT id, email, CONCAT(CONCAT(id,email)) AS name
					FROM users
					WHERE email = '".$objData->email."' AND is_active= '1' ";
			$objUser = $DB->Select($sql);
			if($objUser){
				$objUser = $objUser[0];
				$expiryDate = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +1 day"));
				$securityCode = md5($expiryDate.$objUser->email);
				$DB->Update("UPDATE users SET securitycode = '".$securityCode."', expirydate = '".$expiryDate."' WHERE id = '".$objUser->id."' ");
				
				$ses = new SimpleEmailService(AWS_ACCESS_KEY,AWS_SECRET_KEY);	
				$objMail = new SimpleEmailServiceMessage();
				$objMail->setSubjectCharset('ISO-8859-1');
				$objMail->setMessageCharset('ISO-8859-1');
				$objMail->addTo($objUser->name.' <'.$objUser->email.'>');
				$objMail->setFrom(EMAIL_FROM_NAME .' <'.EMAIL_FROM_ADDRESS.'>');
				$objMail->setSubject('Forgot Password');
				
				$arrayFind = array("{Customer}","{Link}","{BasePath}");
				$arrayReplace = array($objUser->name,Request::$BASE_PATH.'changepassword/'.$securityCode,Request::$BASE_PATH);
				$mailBoddy = file_get_contents('templates/forgotpwd.email.html.php');
				$mailBoddy = str_replace($arrayFind,$arrayReplace,$mailBoddy);
				
				$objMail->setMessageFromString('',$mailBoddy);
				$ses->sendEmail($objMail);
								
				return true;
			}
			else{
				return false;
			}
		}
        
		static function ChangePWD($objData){
			global $DB;
			
			if($objData->securitycode) {
				$sql = "SELECT id, email, securitycode, expirydate 
						FROM users 
						WHERE securitycode = '".$objData->securitycode."' 
						AND expirydate > '".date("Y-m-d H:i:s")."' ";
				$objUserData = $DB->Select($sql);
				if($objUserData){
					$DB->Update("UPDATE users SET password = '".md5($objData->password)."', 
								securitycode = '', expirydate = '' 
								WHERE id = '".$objUserData[0]->id."' ");
					return true;
				}
				else{
					return false;
				}
			}
			else {
				$objUser = Session::GetUser();
				if($objUser){
					$DB->Update("UPDATE usersSET password = '".md5($objData->password)."' 
								WHERE id = '".$objUser->id."' ");
					return true;
				}
				else{
					return false;
				}
			}
		}

		static function CheckAvailability($email) {
			global $DB;
			
			$sql = "SELECT id 
						FROM users
						WHERE email = '".$email."' ";
			$objData = $DB->Select($sql);

			if($objData){
				return true;
			}
			else{
				return false;
			}
		}
		
	static function GetUserData($id) {
			global $DB;
			
			$sql = "SELECT * 
						FROM users
						WHERE id = '".$id."' ";
			$objData = $DB->Select($sql);

			if($objData){
				return $objData[0];
			}
			else{
				return false;
			}
		}
		
		static function Address($UserID, $ID = '') {
			global $DB;
			
			$sql = "SELECT id, user_id, street, address, city, state_id, zip_code, shipping_profile_id, lat, lng, comments, created, is_active, 
						(SELECT abbrev FROM states WHERE states.id = state_id) AS state_name 
						FROM usersaddresses 
						WHERE is_active = '1' 
						AND user_id = '".$UserID."' "; 
			if($ID != '') {
				$sql .= "AND id = '".$ID."' ";
			}
			$sql .=	"ORDER by created DESC ";
			$objData = $DB->Select($sql);
			if($objData){
				if($ID == '') {
					return $objData;
				}
				else{
					return $objData[0];
				}
			}
			else{
				return false;
			}			
		}
		
		static function PaymentProfiles($UserID, $ID = '') {
			global $DB;
			
			$sql = "SELECT id, card_type, card_name, card_number, cvv, expiry_date 
						FROM payment_profiles 
						WHERE is_active = '1' 
						AND user_id = '".$UserID."' "; 
			if($ID != '') {
				$sql .= "AND id = '".$ID."' ";
			}
			$sql .=	"ORDER by created DESC ";
			$objData = $DB->Select($sql);

			if($objData){
				if($ID == '') {
					return $objData;
				}
				else{
					return $objData[0];
				}
			}
			else{
				return false;
			}			
		}
		
		static function GiftCard($ID) {
			global $DB;
			
			$sql .= "SELECT SUM(amount) AS Current_Balance
						FROM gift_cards 
						WHERE is_active = '1' 
						AND user_id = '".$ID."' 
						ORDER by created DESC "; 
			$objData = $DB->Select($sql);
			if($objData){
				return $objData[0]->Current_Balance;
			}
			else{
				return false;
			}			
		}
		
		static function GiftCardHistory($ID) {
			global $DB;
			
			$objData = $DB->Select("SELECT orders.id, orders.order_number, orders.total_amount, orders.created FROM orders, users, payments 
							WHERE users.id = orders.user_id 
							AND payments.order_id = orders.id
							AND payments.user_id = users.id
							AND payments.payment_type = 'Gift Card'
							AND users.id = '".$ID."' ");
			if($objData){
				foreach($objData as $key => $fooditem) {
				$objData[$key]->name = $DB->Select("SELECT orders_food_items.id, food_items.name, orders_food_items.quantity, orders_food_items.price 
							FROM orders_food_items, food_items 
							WHERE food_items.id = orders_food_items.food_item_id 
							AND orders_food_items.order_id = '".$fooditem->id."' 
							AND orders_food_items.is_active = '1' ");
				}
				return $objData;
			}
			else{
				return false;
			}			
			
		}
		
		static function AddAddress($objData) {
			global $DB;
			
			$useraddress_id = $DB->Save('usersaddresses',$objData);
			if($useraddress_id) {
				return $useraddress_id;
			}
			else {
				return false;
			}
		}
		
		static function InviteFriend($objInviteFriends) {
			global $DB;
			$objUser = User::Load($objInviteFriends->user_id);
			$objInviteFriends->email = explode(",",$objInviteFriends->email);
			foreach($objInviteFriends->email as $email) {
				if($email != ''){
					$ses = new SimpleEmailService(AWS_ACCESS_KEY,AWS_SECRET_KEY);	
					$objMail = new SimpleEmailServiceMessage();
					$objMail->setSubjectCharset('ISO-8859-1');
					$objMail->setMessageCharset('ISO-8859-1');
					$objMail->addTo($email);
					$objMail->setFrom(EMAIL_FROM_NAME .' <'.EMAIL_FROM_ADDRESS.'>');
					$objMail->setSubject('Check out Nimble Foods!');
					
					$arrayFind = array("{Customer}","{BasePath}");
					$arrayReplace = array($objUser->name,Request::$BASE_PATH);
					$mailBoddy = file_get_contents('templates/invitation.email.html.php');
					$mailBody = str_replace($arrayFind,$arrayReplace,$mailBoddy);
					$objMail->setMessageFromString('',$mailBody);
					$ses->sendEmail($objMail);
					
					$DB->Insert("INSERT INTO invitations (user_id, name, email, created) 
									VALUES ('".$objInviteFriends->user_id."','".$email."','".$email."','".date('Y-m-d H:i:s')."') ");
				}
			}
			return true;
		}
		
		static function UpdateCustomerProfileID($UserID, $CustomerProfileId) {
			global $DB;
			
			$DB->Update("UPDATE users SET customer_profile_id = '".$CustomerProfileId."' WHERE id = '".$UserID."' ");
			return true;			
		}
		
		static function DeletePayment($PaymentID) {
			global $DB;
			
			$result = $DB->Update("UPDATE payment_profiles SET is_active = '0' WHERE id = '".$PaymentID."' ");
			if($result) {
				return true;
			}
			else {
				return false;
			}
		}
		
		static function DeleteAddress($AddressID) {
			global $DB;
			
			$result = $DB->Update("UPDATE usersaddresses SET is_active = '0' WHERE id = '".$AddressID."' ");
			if($result) {
				return true;
			}
			else {
				return false;
			}			
		}
		
		static function Subscribe($Email,$Status='1') {
			global $DB;
			
			$objSubscriber = $DB->Select("SELECT id, name FROM subscribers WHERE name = '".$Email."' ");
			if($objSubscriber){
				$DB->Update("UPDATE subscribers SET name = '".$Email."', created = '".date("Y-m-d H:i:s")."', is_active = '".$Status."' WHERE id = '".$objSubscriber[0]->id."' ");
			}
			else if($Status == '1'){
				$DB->Insert("INSERT INTO subscribers SET name = '".$Email."', created = '".date("Y-m-d H:i:s")."', is_active = '".$Status."'");
			}
			return true;
		}
		
		static function AddGiftCardUser($objData,$objGiftCards) {
			global $DB;
			
			$objUser = Session::GetUser();

			$password = rand(11111,99999);
			$objData->password = md5($password);
			$objData->created = date('Y-m-d H:i:s');
			$objData->is_active = '0';
			
			$NewUserID = $DB->Save('users',$objData);
			
			if($NewUserID) {
				// Send Mail
				$ses = new SimpleEmailService(AWS_ACCESS_KEY,AWS_SECRET_KEY);	
				$objMail = new SimpleEmailServiceMessage();
				$objMail->setSubjectCharset('ISO-8859-1');
				$objMail->setMessageCharset('ISO-8859-1');
				$objMail->addTo(($objData->first_name.' '.$objData->last_name).' <'.$objData->email.'>');
				$objMail->setFrom(EMAIL_FROM_NAME .' <'.EMAIL_FROM_ADDRESS.'>');
				$objMail->setSubject('Please verify your email address to set up your Nimble Foods account');
				
				$arrayFind = array("{BuyerName}","{Amount}","{Link}","{BasePath}","{PASSWORD}");
				$arrayReplace = array($objUser->first_name.' '.$objUser->last_name,$objGiftCards->amount,Request::$BASE_PATH.'activate/'.md5($NewUserID.$objData->email),Request::$BASE_PATH,$password);
				$mailBoddy = file_get_contents('templates/giftcard.email.html.php');
				$mailBoddy = str_replace($arrayFind,$arrayReplace,$mailBoddy);
				
				$objMail->setMessageFromString('',$mailBoddy);
				$ses->sendEmail($objMail);

				return $NewUserID;
			}
			else {
				return false;
			}
		}
		
		static function GiftCardEmail($objGiftCard) {
			global $DB;
			
			$objGiftCard->created = date('Y-m-d H:i:s');
			$id = $DB->Save('gift_cards',$objGiftCard);

			if($id) {
						
				// Send Email To Recipient
				$ses2_recipient = new SimpleEmailService(AWS_ACCESS_KEY,AWS_SECRET_KEY);	
				$objMail_recipient = new SimpleEmailServiceMessage();
				$objMail_recipient->setSubjectCharset('ISO-8859-1');
				$objMail_recipient->setMessageCharset('ISO-8859-1');
				$objMail_recipient->addTo(($objGiftCard->recipient_first_name).' <'.$objGiftCard->recipient_email.'>');
				$objMail_recipient->setFrom(EMAIL_FROM_NAME .' <'.EMAIL_FROM_ADDRESS.'>');
				//$objMail->setSubject('Please redeem the gift card by using following code');
				$objMail_recipient->setSubject("".ucfirst($objGiftCard->buyer_first_name)." sent you a Nimble Food's Gift Card");
				
				$arrayFind = array("{Buyer}","{Amount}","{Link}","{RedeemCode}","{RedeemLink}","{BasePath}");
				$arrayReplace = array($objGiftCard->buyer_first_name,$objGiftCard->amount,Request::$BASE_PATH.'signup',md5($id.$objGiftCard->buyer_email.$objGiftCard->recipient_email.$objGiftCard->created),Request::$BASE_PATH.'redeem_gift_card',Request::$BASE_PATH);
				$mailBody_recipient = file_get_contents('templates/giftcard.email.html.php');
				$mailBody_recipient = str_replace($arrayFind,$arrayReplace,$mailBody_recipient);
				
				$objMail_recipient->setMessageFromString('',$mailBody_recipient);
				$ses2_recipient->sendEmail($objMail_recipient);


				$order_detail = '<table width="100%" cellspacing="0" cellpadding="0" class="plan" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;color:#787878;font-family:Helvetica, Arial, sans-serif;font-size:12px">
								<tbody>
									<tr valign="middle">
										<th style="border:none;padding:2px;text-align:left;width:105px;">Recipient:</th><td style="text-align:left;border:none;">'.$objGiftCard->recipient_first_name.'</td>
									</tr>
									<tr valign="middle">
										<th style="border:none;padding:2px;text-align:left;width:105px;">Email Address:</th><td style="text-align:left;border:none;">'.$objGiftCard->recipient_email.'</td>
									</tr>
								</tbody>
								</table>
								<table width="100%" cellspacing="0" cellpadding="0" class="plan" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;color:#787878;font-family:Helvetica, Arial, sans-serif;font-size:12px">
									<tbody><tr valign="middle">
									<th height="40" style="text-align:left;border-bottom:1px solid #787878;padding-left:20px;">Product</th>
									<th style="text-align:center;border-bottom:1px solid #787878"><span>Price</span></th>
									<th style="text-align:center;border-bottom:1px solid #787878"><span>Quantity</span></th>
									<th style="text-align:center;border-bottom:1px solid #787878"><span>Total</span></th>
									</tr>';
									
					$order_detail .= '<tr valign="middle">
										<td height="40" align="left" style="border-collapse:collapse;color:#787878;line-height:24px;border-right:1px solid #787878;border-bottom:1px solid #787878;text-align:left;padding-left:20px;"><span style="color:#000;">Gift Card</span></td>
										<td style="border-collapse:collapse;color:#787878;line-height:24px;border-right:1px solid #787878;border-bottom:1px solid #787878;text-align:center"><span style="color:#000;">$'.number_format($objGiftCard->amount,2,".",",").'</span></td>
										<td style="border-collapse:collapse;color:#787878;line-height:24px;border-right:1px solid #787878;border-bottom:1px solid #787878;text-align:center"><span style="color:#000;">1</span></td>
										<td class="last" style="border-collapse:collapse;color:#787878;line-height:24px;border-right:0;border-bottom:1px solid #787878;text-align:center"><span style="color:#000;">$'.number_format(($objGiftCard->amount),2,".",",").'</span></td>
									</tr>';
									
				$order_detail .= '<tr valign="middle">
									<td height="40" align="left" style="border-collapse:collapse;color:#787878;line-height:24px;border-right:0;border-bottom:1px solid #787878;text-align:left"><span>&nbsp;</span></td>
									<td style="border-collapse:collapse;color:#787878;line-height:24px;border-right:1px solid #787878;border-bottom:1px solid #787878;text-align:center"><span>&nbsp;</span></td>
									<td style="border-collapse:collapse;color:#787878;line-height:24px;border-right:1px solid #787878;border-bottom:1px solid #787878;text-align:center;font-weight:bold;"><span>Subtotal</span></td>
									<td class="last" style="border-collapse:collapse;color:#787878;line-height:24px;border-right:0;border-bottom:1px solid #787878;text-align:center; "><span style="color:#000;">$'.number_format($objGiftCard->amount,2,".",",").'</span></td>
									</tr>';
				$order_detail .= '<tr valign="middle">
									<td height="40" align="left" style="border-collapse:collapse;color:#787878;line-height:24px;border-right:0;border-bottom:1px solid #787878;text-align:left"><span>&nbsp;</span></td>
									<td style="border-collapse:collapse;color:#787878;line-height:24px;border-right:1px solid #787878;border-bottom:1px solid #787878;text-align:center"><span>&nbsp;</span></td>
									<td style="border-collapse:collapse;color:#787878;line-height:24px;border-right:1px solid #787878;border-bottom:1px solid #787878;text-align:center;font-weight:bold;"><span>Total order</span></td>
									<td class="last" style="border-collapse:collapse;color:#787878;line-height:24px;border-right:0;border-bottom:1px solid #787878;text-align:center; "><span style="color:#000;">$'.number_format($objGiftCard->amount,2,".",",").'</span></td>
									</tr>
								</tbody></table>';
			
				
				// Send Email To Buyer
				$ses2_buyer = new SimpleEmailService(AWS_ACCESS_KEY,AWS_SECRET_KEY);	
				$objMail_buyer = new SimpleEmailServiceMessage();
				$objMail_buyer->setSubjectCharset('ISO-8859-1');
				$objMail_buyer->setMessageCharset('ISO-8859-1');
				$objMail_buyer->addTo(($objGiftCard->buyer_first_name).' <'.$objGiftCard->buyer_email.'>');
				$objMail_buyer->setFrom(EMAIL_FROM_NAME .' <'.EMAIL_FROM_ADDRESS.'>');
				$objMail_buyer->setSubject("Nimble Foods Gift Card Purchase Receipt");
				
				$arrayFind = array("{RECIPIENT_NAME}","{BasePath}","{OrderDetail}");
				$arrayReplace = array($objGiftCard->recipient_first_name,Request::$BASE_PATH,$order_detail);
				$mailBody_buyer = file_get_contents('templates/giftcard.buyer.email.html.php');
				$mailBody_buyer = str_replace($arrayFind,$arrayReplace,$mailBody_buyer);
				
				$objMail_buyer->setMessageFromString('',$mailBody_buyer);
				$ses2_buyer->sendEmail($objMail_buyer);
				//echo md5($id.$objGiftCard->buyer_email.$objGiftCard->recipient_email.$objGiftCard->created);
				
				return $id;
			}
			else {
				return false;
			}
			
		}
		
		static function UpdateGiftCard($Code,$objUser) {
			global $DB;
			
			$sql = "SELECT id,amount FROM gift_cards WHERE MD5(CONCAT(id,buyer_email,recipient_email,created)) = '".$Code."' AND user_id != '0' ";
			$card_redeem = $DB->Select($sql);
			if($card_redeem) {
				return 'Redeem';
			}
			else {
				$sql = "SELECT id,amount FROM gift_cards WHERE MD5(CONCAT(id,buyer_email,recipient_email,created)) = '".$Code."' AND user_id = '0' ";
				$codematch = $DB->Select($sql);
	
				if($codematch) {
					$sql = "UPDATE gift_cards SET user_id = '".$objUser->id."', redeem_date = '".date('Y-m-d H:i:s')."' WHERE id = '".$codematch[0]->id."' ";
					$response = $DB->Update($sql);
					if($response) {
											
						// Send Email To Buyer
						/*$ses1 = new SimpleEmailService(AWS_ACCESS_KEY,AWS_SECRET_KEY);	
						$objMail = new SimpleEmailServiceMessage();
						$objMail->setSubjectCharset('ISO-8859-1');
						$objMail->setMessageCharset('ISO-8859-1');
						$objMail->addTo(($objUser->first_name.' '.$objUser->last_name).' <'.$objUser->email.'>');
						$objMail->setFrom(EMAIL_FROM_NAME .' <'.EMAIL_FROM_ADDRESS.'>');
						$objMail->setSubject('Gift card success message');
						
						$arrayFind = array("{BasePath}","{Amount}","{RECIPIENT_NAME}");
						$arrayReplace = array(Request::$BASE_PATH,$codematch[0]->amount,'HELLO');
						$mailBoddy = file_get_contents('templates/giftcard.success.email.html.php');
						$mailBoddy = str_replace($arrayFind,$arrayReplace,$mailBoddy);
						
						$objMail->setMessageFromString('',$mailBoddy);
						$ses1->sendEmail($objMail);				*/
	
						return 'Success';
					}
					else {
						return 'Error';
					}
				}
				else {
					return 'Error';
				}
			}
		}
		
		static function Balance() {
			global $DB;
			
			$objUser = Session::GetUser();
			
			$sql = "SELECT SUM(amount) As amount FROM gift_cards WHERE user_id = '".$objUser->id."' ";
			$giftcard_amount = $DB->Select($sql);
			$sql = "SELECT SUM(amount) As amount FROM payments WHERE user_id = '".$objUser->id."' AND payment_type = 'Gift Card' ";
			$spentGiftCard_amount = $DB->Select($sql);
			
			if($giftcard_amount) {
				$total_gift_cart = $giftcard_amount[0]->amount - $spentGiftCard_amount[0]->amount;
				return $total_gift_cart;
			}
			return false;
		}
		
		static function Execute() {
			global $DB;
			
			$DB->Execute("ALTER TABLE `usersaddresses` ADD COLUMN `comments` MEDIUMTEXT CHARSET utf8 NULL AFTER `lng` ");
			/*$result = $DB->Select("SELECT * FROM payments WHERE user_id = '2295' ");
			echo '<pre>';
			print_r($result);
			exit;*/
		}
		
	}
