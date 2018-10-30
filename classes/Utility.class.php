
<?php
	class Utility {
	   	const VARIABLERANDOMLIST = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	   	const DANISHLIST = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789 ";
		static function RandomCharacterGenerator ($stringLength = 6, $randomCharList = false, $initialReverseCharList = false, $consistentReverseCharList = false) {
			if($randomCharList && is_array($randomCharList)) {
				$characterList = implode("", $randomCharList);
			} elseif ($randomCharList) {
			   	$characterList = $randomCharList;
			} else {
				$characterList = "1qazxsw23edcvfr45tgbnhy67ujm,ki89ol./;p0-[=]~WSX!QAZCDE#$RFVBGT%^YHNMJU&*IK<>LO()P:?{_}+|";
			}
			
			if((int) $stringLength == 0) {
				$stringLength = 6;
			}
			
			if($stringLength > strlen($characterList))  {
				throw new Exception ("Character List too small");
			}
			
			if($initialReverseCharList) {
				$characterList = strrev($characterList);
			}
			
			$generatedString = "";
			$reverseStage = false;
			for($iChar = 0; $iChar < $stringLength; $iChar++) {
				$currentCharListLength = strlen($characterList) - 1;
				$characterIndex = mt_rand(0, $currentCharListLength);
				$generatedString .= substr($characterList, $characterIndex, 1);
				$characterList = substr_replace($characterList, "", $characterIndex, 1);
				if($consistentReverseCharList) {
					$reverseStage = !$reverseStage;
					$characterList = ($reverseStage) ? strrev($characterList) : $characterList;
				}
			}
			
			return $generatedString;
			
		}
		
		static function HTMLSafe ($string, $allowableTags = "<b><strong><i><em>") {
			return strip_tags($string, $allowableTags);
		}
		
		static function isVariableSafe ($string, $minimum = 3, $maximum = 16) {
		   	return preg_match('/^[' . UtilityManager::VARIABLERANDOMLIST . ']{' . $minimum . ',' . $maximum . '}$/', $string);
		}
		
		static function customStringSafe ($string, $customString, $minimum = 3, $maximum = 16) {
		   	return preg_match('/^[' . $customString . ']{' . $minimum . ',' . $maximum . '}$/', $string);
		}
		
		static function pageLinks($thisPage,$totalPage,$request){
			if(isset($_GET['sortby']) && $_GET['sortby'] != ""){
				$request .= '?sortby='.$_GET['sortby'].'&';
			}
			else{
				$request .= '?';
			}
			if($totalPage > 1){
				if($thisPage > 1){
					$newPage = $thisPage - 1;
					$return .= '<a class="buttonlink" href="'.$request.'page='.$newPage.'">&lt; Geri</a>&nbsp;';
				}
				if(($thisPage - 5) > 1 && $totalPage > 11){
					$return .= '...&nbsp;';
				}
				for($i = 1; $i <= $totalPage; $i++){
					if(!(($i < ($thisPage - 5) && $i < ($totalPage - 10)) || ($i > ($thisPage + 5) && ($i - 10) > 1))){
						if($thisPage == $i){
							$return .= '<span>'.$i.'</span>&nbsp;';
						}
						else{
							$return .= '<a class="buttonlink" href="'.$request.'page='.$i.'">'.$i.'</a>&nbsp;';
						}
					}
				}
				if(($thisPage + 5) < $totalPage && $totalPage > 11){
					$return .= '...&nbsp;';
				}
				if($thisPage < $totalPage){
					$newPage = $thisPage + 1;
					$return .= '<a class="buttonlink" href="'.$request.'page='.$newPage.'">Ä°leri &gt;</a>&nbsp;';
				}
			}
			
			return $return;
		}
		
		static function pageFormLinks($thisPage,$totalPage){
			if($totalPage > 1){
				if($thisPage > 1){
					$newPage = $thisPage - 1;
					$return .= '<a class="buttonlink" href="#" onclick="return refreshPage(\'1\');"><<</a>&nbsp;';
					$return .= '<a class="buttonlink" href="#" onclick="return refreshPage(\''.$newPage.'\');"><</a>&nbsp;';
				}
				if(($thisPage - 5) > 1 && $totalPage > 11){
					$return .= '...&nbsp;';
				}
				for($i = 1; $i <= $totalPage; $i++){
					if(!(($i < ($thisPage - 5) && $i < ($totalPage - 10)) || ($i > ($thisPage + 5) && ($i - 10) > 1))){
						if($thisPage == $i){
							$return .= '<span style="font-size:14px;"><u>'.$i.'</u></span>&nbsp;';
						}
						else{
							$return .= '<a class="buttonlink" href="#" onclick="return refreshPage(\''.$i.'\');">'.$i.'</a>&nbsp;';
						}
					}
				}
				if(($thisPage + 5) < $totalPage && $totalPage > 11){
					$return .= '...&nbsp;';
				}
				if($thisPage < $totalPage){
					$newPage = $thisPage + 1;
					$return .= '<a class="buttonlink" href="#" onclick="return refreshPage(\''.$newPage.'\');">></a>&nbsp;';
					$return .= '<a class="buttonlink" href="#" onclick="return refreshPage(\''.$totalPage.'\');">>></a>';
				}
			}
			
			return $return;
		}
		
		static function CreateCaptcha(){
			$CaptchaHeight = 20;
			$CaptchaWidth  = 75;
			// Captcha Word
			$md5_hash = md5(rand(0,999)); 
			$CaptchaWord = substr($md5_hash, 15, 5);
			// Determine angle and position	
			$length	= strlen($CaptchaWord);
			$angle	= ($length >= 6) ? rand(-($length-6), ($length-6)) : 0;
			$x_axis	= rand(6, (360/$length)-16);			
			$y_axis = ($angle >= 0 ) ? rand($CaptchaWidth, $CaptchaHeight) : rand(6, 30);
			// Create image
			$Image = imagecreate($CaptchaWidth, $CaptchaHeight);
			//Image Colors
			$bg_color		= imagecolorallocate ($Image, 255, 255, 255);
			$border_color	= imagecolorallocate ($Image, 0, 0, 0);
			$text_color		= imagecolorallocate ($Image, 0, 0, 0);
			$grid_color		= imagecolorallocate($Image, 204, 204, 204);
			$shadow_color	= imagecolorallocate($Image, 204, 204, 204);
			//  Create the rectangle
			ImageFilledRectangle($Image, 0, 0, $CaptchaWidth, $CaptchaHeight, $bg_color);
			//  Create the spiral pattern
			$theta		= 1;
			$thetac		= 7;
			$radius		= 16;
			$circles	= 20;
			$points		= 32;
			
			for ($i = 0; $i < ($circles * $points) - 1; $i++){
				$theta = $theta + $thetac;
				$rad = $radius * ($i / $points );
				$x = ($rad * cos($theta)) + $x_axis;
				$y = ($rad * sin($theta)) + $y_axis;
				$theta = $theta + $thetac;
				$rad1 = $radius * (($i + 1) / $points);
				$x1 = ($rad1 * cos($theta)) + $x_axis;
				$y1 = ($rad1 * sin($theta )) + $y_axis;
				imageline($Image, $x, $y, $x1, $y1, $grid_color);
				$theta = $theta - $thetac;
			}
			//  Write the text
			$font_size	= 10;
			imagestring($Image, $font_size, 13, 2, $CaptchaWord, $text_color);
			//  Create the border
			imagerectangle($Image, 0, 0, $CaptchaWidth-1, $CaptchaHeight-1, $border_color);
			//  Generate the image
			$imageFile = 'captcha/'.Session::ID().'.jpg';
			ImageJPEG($Image, $imageFile);
			ImageDestroy($Image);
			//Save Captcha Word in Session
			Session::AddCaptcha($CaptchaWord);
			return $imageFile;
		}
		static function urdu_date($current_date){
			
			$date= date('d',strtotime( $current_date));
			$day=date('l',strtotime( $current_date));
			$month=date('F',strtotime( $current_date));
			$year=date('Y',strtotime( $current_date));
			$time = date('H:i',strtotime( $current_date));
			
			switch($day){
				case 'Monday':
					$day="Ù¾ÛŒØ±";
					break;
				case 'Tuesday':
					$day="Ù…Ù†Ú¯Ù„";
					break;
				case 'Wednesday':
					$day="Ø¨Ø¯Ú¾";
					break;
				case 'Thursday':
					$day="Ø¬Ù…Ø¹Ø±Ø§Øª";
					break;
				case 'Friday':
					$day="Ø¬Ù…Ø¹Û�";
					break;
				case 'Saturday':
					$day="Û�Ù�ØªÛ�";
					break;
				case 'Sunday':
					$day="Ø§ØªÙˆØ§Ø±";
					break;
				default:
					$day="";
			}
			
			switch($month){
				case 'January':
					$month="Ø¬Ù†ÙˆØ±ÛŒ";
					break;
				case 'February':
					$month="Ù�Ø±ÙˆØ±ÛŒ";
					break;
				case 'March':
					$month="Ù…Ø§Ø±Ú†";
					break;
				case 'April':
					$month="Ø§Ù¾Ø±ÛŒÙ„";
					break;
				case 'May':
					$month="Ù…Ø¦ÛŒ";
					break;
				case 'June':
					$month="Ø¬ÙˆÙ†";
					break;
				case 'July':
					$month="Ø¬ÙˆÙ„Ø§Ø¦ÛŒ";
					break;
				case 'August':
					$month="Ø§Ú¯Ø³Øª";
					break;
				case 'September':
					$month="Ø³ØªÙ…Ø¨Ø±";
					break;
				case 'October':
					$month="Ø§Ú©ØªÙˆØ¨Ø±";
					break;
				case 'November':
					$month="Ù†ÙˆÙ…Ø¨Ø±";
					break;
				case 'December':
					$month="Ø¯Ø³Ù…Ø¨Ø±";
					break;
				default:
					$month="";
			}
			
			$time = "( ".$time." ) ";
			
			$urduDate = $time."".$day." ". $date." ".$month;
			//$urduDate= "<div style='font-size: 12px; text-align: right; color: #666666;'>".$urduDate."</div>";
			
			
			return $urduDate;
			
		}
		
		static function urdu_main_date($current_date){
				
			$date= date('d',strtotime( $current_date));
			$day=date('l',strtotime( $current_date));
			$month=date('F',strtotime( $current_date));
			$year=date('Y',strtotime( $current_date));
			$time = date('h:m a',strtotime($current_date));
			switch($day){
				case 'Monday':
					$day="Ù¾ÛŒØ±";
					break;
				case 'Tuesday':
					$day="Ù…Ù†Ú¯Ù„";
					break;
				case 'Wednesday':
					$day="Ø¨Ø¯Ú¾";
					break;
				case 'Thursday':
					$day="Ø¬Ù…Ø¹Ø±Ø§Øª";
					break;
				case 'Friday':
					$day="Ø¬Ù…Ø¹Û�";
					break;
				case 'Saturday':
					$day="Û�Ù�ØªÛ�";
					break;
				case 'Sunday':
					$day="Ø§ØªÙˆØ§Ø±";
					break;
				default:
					$day="";
			}
				
			switch($month){
				case 'January':
					$month="Ø¬Ù†ÙˆØ±ÛŒ";
					break;
				case 'February':
					$month="Ù�Ø±ÙˆØ±ÛŒ";
					break;
				case 'March':
					$month="Ù…Ø§Ø±Ú†";
					break;
				case 'April':
					$month="Ø§Ù¾Ø±ÛŒÙ„";
					break;
				case 'May':
					$month="Ù…Ø¦ÛŒ";
					break;
				case 'June':
					$month="Ø¬ÙˆÙ†";
					break;
				case 'July':
					$month="Ø¬ÙˆÙ„Ø§Ø¦ÛŒ";
					break;
				case 'August':
					$month="Ø§Ú¯Ø³Øª";
					break;
				case 'September':
					$month="Ø³ØªÙ…Ø¨Ø±";
					break;
				case 'October':
					$month="Ø§Ú©ØªÙˆØ¨Ø±";
					break;
				case 'November':
					$month="Ù†ÙˆÙ…Ø¨Ø±";
					break;
				case 'December':
					$month="Ø¯Ø³Ù…Ø¨Ø±";
					break;
				default:
					$month="";
			}
			
			$urduDate = $day." ". $date." ".$month." ".$year;
			return $urduDate;
				
		}

		static function show_weather ($zipcode = NULL)
		{
			if(!$zipcode){
				$Clocation= file_get_contents('http://www.iplocationtools.com/182.189.125.234.html');
				//$Clocation= file_get_contents('http://www.iplocationtools.com/'.$_SERVER['REMOTE_ADDR'].'.html');
				$Clocation= strip_tags($Clocation);
				$Clocation=explode('Weather Station', $Clocation);
				$Clocation=explode('View Live Weather', $Clocation[1]);
				//$Clocation=$Clocation[0];
				//$Clocation=explode(")", explode("(", $Clocation[0])[1])[0];
				$zipcode=$Clocation;
			}
			//yahoo api call
			$api_result = file_get_contents('http://weather.yahooapis.com/forecastrss?p=' . $zipcode . '&u=f');
			$xml_data = simplexml_load_string($api_result);
			//get data
			$xml_data->registerXPathNamespace('yweather', 'http://xml.weather.yahoo.com/ns/rss/1.0');
			//get Weather location
			$location = $xml_data->channel->xpath('yweather:location');
			$output = '';
			if(!empty($location)) {
				foreach($xml_data->channel->item as $item)
				{
					$current = $item->xpath('yweather:condition');
					$forecast = $item->xpath('yweather:forecast');
					$current = $current[0];
					
					//format data
					//$output = '<h2>Weather forecast</h2><br />';
					//$output .= 'Time: ' . date('g:i A') .'<br />';
					//get weather image based on temperature
					$output = "
					{$location[0]['city']}<br>
					<span style=\"font-size:20px; font-weight:bold;\">{$current['temp']}&deg;F</span>
					<br />
					<img src=\"http://l.yimg.com/a/i/us/we/52/{$current['code']}.gif\" style=\"vertical-align: middle;\"          />&nbsp;
					{$current['text']}<br />
					<!--<u>Future forecast</u><br />-->
					{$forecast[0]['day']} - {$forecast[0]['text']}. High: {$forecast[0]['high']} Low: {$forecast[0]['low']}
					<br/>
					{$forecast[1]['day']} - {$forecast[1]['text']}. High: {$forecast[1]['high']} Low: {$forecast[1]['low']}";
				}
			} else {
				$output = '<h5>No weather forecast found</h5>';
			}
			return $output;
		}
		//Get Facebook Likes Count of a page
		static function fbLikeCount($url1){
			$addr="http://api.facebook.com/restserver.php?method=links.getStats&urls=".$url1;
			$page_source= Request::Curl($addr);
			//$page_source=file_get_contents($addr);
			$page = htmlentities($page_source);
			$like="<like_count>";
			$like1="</like_count>";
			$lik=strpos($page,htmlentities($like));
			$lik1=strpos($page,htmlentities($like1));
			$fullcount=strlen($page);
			$a=$fullcount-$lik1;
			$aaa=substr($page,$lik+18,-$a);
			$aaa1=substr($page,605,610);
			return $aaa;
		
		}
		static function dateDifference($startDate ){
			$dateDifference = '';
			$endDate = date("Y-m-d H:i:s");
			$startDate = strtotime($startDate);
			$endDate = strtotime($endDate);
			if($endDate > $startDate){
				$difference = $endDate - $startDate;
				if( $days = intval((floor($difference / 86400))) )
					$difference = $difference % 86400;
				if( $hours = intval((floor($difference / 3600))) )
					$difference = $difference % 3600;
				if( $minutes = intval((floor($difference / 60))) )
					$difference = $difference % 60;
				$difference = intval( $difference );
				//return $minutes;
				if($days > 6)
					$dateDifference=date("Y-m-d",$startDate);
				elseif($days > 0)
					$dateDifference = $days.' day '.$hours.' hrs '.$minutes.' mins ';
				elseif($hours > 0)
					$dateDifference = $hours.' hrs '.$minutes.' mins ';
				elseif($minutes > 0)
					$dateDifference = $minutes.' mins';
				else
					$dateDifference = 'Just now';
				
			}
			
			return $dateDifference;
		}
	//utility calls function
		static function getUrl() {
			$url  = isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http';
			$url .= '://' . $_SERVER['SERVER_NAME'];
			$url .= in_array( $_SERVER['SERVER_PORT'], array('80', '443') ) ? '' : ':' . $_SERVER['SERVER_PORT'];
			$url .= $_SERVER['REQUEST_URI'];
			return urldecode($url);
		}
		
		static function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
			$output = NULL;
			if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
				$ip = $_SERVER["REMOTE_ADDR"];
				if ($deep_detect) {
					if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
						$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
					if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
						$ip = $_SERVER['HTTP_CLIENT_IP'];
				}
			}
			$purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
			$support    = array("country", "countrycode", "state", "region", "city", "location", "address");
			$continents = array(
					"AF" => "Africa",
					"AN" => "Antarctica",
					"AS" => "Asia",
					"EU" => "Europe",
					"OC" => "Australia (Oceania)",
					"NA" => "North America",
					"SA" => "South America"
			);
			if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
				$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
				if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
					switch ($purpose) {
						case "location":
							$output = array(
							"city"           => @$ipdat->geoplugin_city,
							"state"          => @$ipdat->geoplugin_regionName,
							"country"        => @$ipdat->geoplugin_countryName,
							"country_code"   => @$ipdat->geoplugin_countryCode,
							"continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
							"continent_code" => @$ipdat->geoplugin_continentCode
							);
							break;
						case "address":
							$address = array($ipdat->geoplugin_countryName);
							if (@strlen($ipdat->geoplugin_regionName) >= 1)
								$address[] = $ipdat->geoplugin_regionName;
							if (@strlen($ipdat->geoplugin_city) >= 1)
								$address[] = $ipdat->geoplugin_city;
							$output = implode(", ", array_reverse($address));
							break;
						case "city":
							$output = @$ipdat->geoplugin_city;
							break;
						case "state":
							$output = @$ipdat->geoplugin_regionName;
							break;
						case "region":
							$output = @$ipdat->geoplugin_regionName;
							break;
						case "country":
							$output = @$ipdat->geoplugin_countryName;
							break;
						case "countrycode":
							$output = @$ipdat->geoplugin_countryCode;
							break;
					}
				}
			}
			return $output;
		}
	}
