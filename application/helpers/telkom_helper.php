<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	/**
		* Dump and die detail 
		* @param $var = variabel/input yang akan di dump
	*/
	if (!function_exists('debug')){
		function debug($var){
			echo "<pre>";
			var_dump($var);
			echo "</pre>";
			die();
		}
	}
	
	/**
		* Dump and die detail (print_r style)
		* @param $var = variabel/input yang akan di dump
	*/
	if (!function_exists('ddp')){
		function ddp($var){
			echo "<pre>";
			print_r($var);
			echo "</pre>";
			die();
		}
	}


	if (!function_exists('rupiah')){
		function rupiah($angka){
			$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
			return $hasil_rupiah;
		}
	}
	
	/**
		* Merubah format tanggal menjadi format indonesia
		* @param $tanggal = variable date dengan format YYYY-MM-DD
	*/
	if (!function_exists('tgl_indo')){
		function tgl_indo($tanggal){
			$bulan = array (
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
			);
			$pecahkan = explode('-', $tanggal);
			
			// variabel pecahkan 0 = tanggal
			// variabel pecahkan 1 = bulan
			// variabel pecahkan 2 = tahun
			
			return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
		}
	}
	
	if (!function_exists('date_eng')){
		function date_eng($tanggal){
			$timestamp	= strtotime($tanggal); 
			$new_date 	= date('d-m-Y', $timestamp);
			$bulan      = array (
			1  => 'January',
			2  => 'February',
			3  => 'March',
			4  => 'April',
			5  => 'May',
			6  => 'June',
			7  => 'July',
			8  => 'August',
			9  => 'September',
			10 => 'October',
			11 => 'November',
			12 => 'December'
			);
			$pecahkan = explode('-', $new_date);
			return sprintf("%'.02d",$pecahkan[0]).' '.$bulan[(int)$pecahkan[1]].' '.$pecahkan[2];
		}
	}
	
	if (!function_exists('date_eng2')){
		function date_eng2($tanggal){
			return date("jS F Y", strtotime($tanggal));
		}
	}
	
	if (!function_exists('date_eng3')){
		function date_eng3($tanggal){
			return date("d/m/Y", strtotime($tanggal));
		}
	}
	
	if (!function_exists('date_eng4')){
		function date_eng4($tanggal){
			return date("M d, Y, h:i A", strtotime($tanggal));
		}
	}
	if (!function_exists('date_eng5')){
		function date_eng5($tanggal){
			return date("M d, Y", strtotime($tanggal));
		}
	}
	if (!function_exists('date_eng6')){
		function date_eng6($tanggal){
			return date("d M Y", strtotime($tanggal));
		}
	}

	if (!function_exists('date_time')){
		function date_time($tanggal){
			return date("H:i ,j M Y ", strtotime($tanggal));
		}
	}

	if (!function_exists('convert_date')){
		function convert_date($tanggal){
			return date('l, d M Y H:i', strtotime($tanggal)).' WIB';
		}
	}

	if (!function_exists('time_since')){
		function time_since($tanggal,  $full = false){
			$now 	= new DateTime;
		    $ago 	= new DateTime($tanggal);
		    $diff 	= $now->diff($ago);

		    if($diff->days<=7){
		    $diff->w = floor($diff->d / 7);
		    $diff->d -= $diff->w * 7;
			    $string = array(
			        'y' => 'year',
			        'm' => 'month',
			        'w' => 'week',
			        'd' => 'day',
			        'h' => 'hour',
			        'i' => 'minute',
			        's' => 'second',
			    );
			    foreach ($string as $k => &$v) {
			        if ($diff->$k) {
			            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			        } else {
			            unset($string[$k]);
			        }
			    }

			    if (!$full) $string = array_slice($string, 0, 1);
			    return $string ? implode(', ', $string) . ' ago' : 'just now';
		    }else{
				return date('l, d M Y H:i', strtotime($tanggal)).' WIB';
		    }
		}
	}

	/**
		* Mengambil extensi filename
		* @param $string = filename string, contoh : rapat.pdf
	*/
	if (!function_exists('get_extension')){
		function get_extension($string){
			$i 	    = strrpos($string,".");
			if (!$i) { return ""; }
			$l 	    = strlen($string) - $i;
			$ext 	= strtolower(substr($string,$i+1,$l));
			return $ext;
		}
	}
	
	/**
		* Mengencrypt id yang di pass
		* @param $value = id yang akan di encrypt
	*/
	if (!function_exists('encrypt_id')){
		function encrypt_id($value){
			$result = rand(10,99).base64_encode(rand(10,99).base64_encode(rand(10,99).base64_encode(rand(10,99).$value)));
			return $result;
		}
	}
	
	if (!function_exists('encrypt_exp')){
		function encrypt_exp($value){
			date_default_timezone_set("Asia/Jakarta");
			$now    = date('Y-m-d');
			// header key 	= 8 char
			$header = chr(rand(65,90)).rand(10,99).chr(rand(97,122)).rand(10,99).chr(rand(97,122)).rand(1,9);
			
			// head  		= 4 char
			$head1 	= chr(rand(65,90)).rand(10,99).chr(rand(97,122));
			$head2 	= chr(rand(97,122)).rand(10,99).chr(rand(65,90));
			$head3 	= chr(rand(65,90)).rand(10,99).chr(rand(97,122));
			$head4 	= chr(rand(97,122)).rand(10,99).chr(rand(65,90));

			$encrypt= base64_encode($head1.base64_encode($head2.base64_encode($head3.base64_encode($now)).".".base64_encode($head4.base64_encode($value))));
			$result = "SECURE_".$header.$encrypt;
			return $result;
		}
	}
	
	if (!function_exists('decrypt_exp')){
		function decrypt_exp($value){
			date_default_timezone_set("Asia/Jakarta");
			$now    = date('Y-m-d');
			$yesterday    = date('Y-m-d',strtotime("-1 Day"));
			$result = null;
			// check contain SECURE
			if(preg_match("/^SECURE/", $value)) {
				// berawalan secure
				$value 	= str_replace("SECURE_","",$value);
				// check decrypt
				$temp 	= explode(".",substr(base64_decode(substr(base64_decode(substr($value,8)),4)),4));
				if((isset($temp[0]) && $temp[0]) && (isset($temp[1]) && $temp[1])){
					// check expired date
					$key	= base64_decode(substr(base64_decode($temp[0]),4));
					if($key == $now || $key == $yesterday){
						$result = base64_decode(substr(base64_decode($temp[1]),4));
					}
				}
			}
			return $result;
		}
	}
	if (!function_exists('decrypt_broadcast')){
		function decrypt_broadcast($value){
			date_default_timezone_set("Asia/Jakarta");
			$now    = date('Y-m-d');
			$yesterday    = date('Y-m-d',strtotime("-1 Day"));
			$result = null;
			// check contain SECURE
			if(preg_match("/^SECURE/", $value)) {
				// berawalan secure
				$value 	= str_replace("SECURE_","",$value);
				// check decrypt
				$temp 	= explode(".",substr(base64_decode(substr(base64_decode(substr($value,8)),4)),4));
				if((isset($temp[0]) && $temp[0]) && (isset($temp[1]) && $temp[1])){
					// check expired date
					$key	= base64_decode(substr(base64_decode($temp[0]),4));
					$result = base64_decode(substr(base64_decode($temp[1]),4));
				}
			}
			return $result;
		}
	}

	/**
		* Mendecrypt id yang di pass
		* @param $value = id yang akan di decrypt
	*/
	if (!function_exists('decrypt_id')){
		function decrypt_id($value){
			$result = substr(base64_decode(substr(base64_decode(substr(base64_decode(substr($value,2)),2)),2)),2);
			return $result;
		}
	}
	
	
	/**
		* Mendapatkan nama file tanpa ekstensi
		* @param $value = string nama file, contoh : gajah.jpg
	*/
	if (!function_exists('get_title')){
		function get_title($string){
			$i 	    = strrpos($string,".");
			if (!$i) { return ""; }
			$l 	    = strlen($string);
			$title 	= substr($string,0,$l-($l-$i));
			return $title;
		}
	}
	
	if (!function_exists('relative_date')){
		function relative_date($date){
			$now 	= time();
			$date 	= strtotime($date);
			$diff 	= $now - $date;
			if ($diff < 60){
				return sprintf($diff > 1 ? '%s seconds ago' : 'a second ago', $diff);
			}
			
			$diff = floor($diff/60);
			if ($diff < 60){
				return sprintf($diff > 1 ? '%s minutes ago' : 'one minute ago', $diff);
			}
			
			$diff = floor($diff/60);
			if ($diff < 24){
				return sprintf($diff > 1 ? '%s hours ago' : 'an hour ago', $diff);
			}
			
			$diff = floor($diff/24);
			if ($diff < 7){
				return sprintf($diff > 1 ? '%s days ago' : 'yesterday', $diff);
			}
			
			if ($diff < 30){
				$diff = floor($diff / 7);
				
				return sprintf($diff > 1 ? '%s weeks ago' : 'one week ago', $diff);
			}
			
			$diff = floor($diff/30);
			if ($diff < 12){
				return sprintf($diff > 1 ? '%s months ago' : 'last month', $diff);
			}
			
			$diff = date('Y', $now) - date('Y', $date);
			return sprintf($diff > 1 ? '%s years ago' : 'last year', $diff);
		}
	}
	
	if (!function_exists('number_viewer')){
		function number_viewer($n){
			if($n > 0){
				// $base   	= log($n) / log(1000);
				// $suffix 	= array("", "K", "M", "B", "T")[floor($base)];
				// $number   	= round(pow(1000, $base - floor($base)),1).$suffix;
				// return $number;
				
				$unit = array("", "K", "M", "B", "T");
				$exp = floor(log($n, 1000)) | 0;
				return round($n / (pow(1000, $exp))).$unit[$exp];
			}else{
				return '0';
			}
		}
	}
	if(!function_exists('formatBytes')){
		function formatBytes($size, $precision = 2){
		    $base = log($size, 1024);
		    $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');   

		    return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
		}	
	}

	if (!function_exists('clean_string')){
		function clean_string($string){
			return htmlentities(strip_tags(trim($string)));
		}
	}
	
	if (!function_exists('meta_clear')){
		function meta_clear($string){
			$result = str_replace( array( '\'', '"', ',' , ';', '<', '>','`','+' ), ' ', $string);
			return $result;
		}
	}
	
	if (!function_exists('mask_number')){
		function mask_number($string){
			$result = str_replace( array( '.', ','), '', $string);
			return $result;
		}
	}
	
	if (!function_exists('meta_subject')){
		function meta_subject($string){
			$result = str_replace(" ",", ",$string);
			return $result;
		}
	}
	
	if (!function_exists('string_limit')){
		function string_limit($string, $length, $url=null){
			if (strlen($string) > $length) {
				$stringCut 	= substr($string, 0, $length);
				$result 	= substr($stringCut, 0, strrpos($stringCut, ' '));
				if(isset($url) && $url){
					return strip_tags($result).'...<a href="'.$url.'" class="btn-link ml-2">Read More</a>';
				}else{
					return strip_tags($result);
				}
			}else{
				$result 	= $string;
				// if($result){
				// 	return strip_tags($result).'...';
				// }else{
				return strip_tags($result);
				// }
			}
		}
	}
	if (!function_exists('string_limit2')){
		function string_limit2($string, $length, $url=null){
			if (strlen($string) > $length) {
				$stringCut 	= substr($string, 0, $length);
				$result 	= substr($stringCut, 0, strrpos($stringCut, ' '));
				if(isset($url) && $url){
					return strip_tags($result).'...<a href="'.$url.'" class="btn-link ml-2">Read More</a>';
				}else{
					return strip_tags($result).'...';
				}
			}else{
				$result 	= $string;
				// if($result){
				// 	return strip_tags($result).'...';
				// }else{
				return strip_tags($result);
				// }
			}
		}
	}
	if (!function_exists('string_check')){
		function string_check($string, $length){
			if (strlen($string) > $length) {
				return true;
			}else{
				return false;
			}
		}
	}
	
	// EN SHA256
	if (!function_exists('encrypt256')){
		function encrypt256($value){
			$result = hash("sha256",$value);
			return $result;
		}
	}
	
	if (!function_exists('img_error')){
		function img_error($folder){
			if($folder=='avatar'){
				$img_error 	= 'onError="this.onerror=null;this.src=\''.base_url().LINK_DEFAULT.'avatar-cover.jpg\';"';
				}else if($folder=='channel'){
				$img_error 	= 'onError="this.onerror=null;this.src=\''.base_url().LINK_DEFAULT.'avatar-group.jpg\';"';
				}else if($folder=='header'){
				$img_error  = 'onError="this.onerror=null;this.src=\''.base_url().LINK_DEFAULT.'header.jpg\';"';
				}else if($folder=='video'){
				$img_error  = 'onError="this.onerror=null;this.src=\''.base_url().LINK_DEFAULT.'video.jpg\';"';
				}else if($folder=='photo'){
				$img_error  = 'onError="this.onerror=null;this.src=\''.base_url().LINK_DEFAULT.'photo.jpg\';"';
				}else if($folder=='social'){
				$img_error  = 'onError="this.onerror=null;this.src=\''.base_url().LINK_DEFAULT.'social.png\';"';
				}else if($folder=='apps'){
				$img_error  = 'onError="this.onerror=null;this.src=\''.base_url().LINK_DEFAULT.'app_img.png\';"';
				}else if($folder=='general'){
				$img_error  = 'onError="this.onerror=null;this.src=\''.base_url().LINK_DEFAULT.'general.jpg\';"';
				}else if($folder=='banner'){
				$img_error  = 'onError="this.onerror=null;this.src=\''.base_url().LINK_DEFAULT.'banner.png\';"';
			}
			return $img_error;
		}
	}
	
	if (!function_exists('img_avatar')){
		function img_avatar(){
			$img_error 	= "onError=\"this.onerror=null;this.src=\\'".base_url().LINK_DEFAULT."avatar.jpg\\';\"";
			return $img_error;
		}
	}

	if (!function_exists('clean_hashtag')){
		function clean_hashtag($string){
			$string = str_replace(' ', '', $string);
			return preg_replace('/[^A-Za-z0-9\-._]/', '', $string); // Removes special chars.
		}
	}
	
	if (!function_exists('clean_text')){
		function clean_text($string){
			// $string = str_replace('&amp', '&', $string);
			return preg_replace('/[^A-Za-z0-9\-._ ()+~|&]/', '', $string); // Removes special chars.
		}
	}
	
	if (!function_exists('format_bytes')){
		function format_bytes($bytes, $precision = 2){
			if($bytes>0){
				$units = array('B', 'KB', 'MB', 'GB', 'TB'); 
				
				$bytes = max($bytes, 0); 
				$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
				$pow = min($pow, count($units) - 1); 
				
				// Uncomment one of the following alternatives
				$bytes /= pow(1024, $pow);
				// $bytes /= (1 << (10 * $pow)); 
				
				return round($bytes, $precision) . ' ' . $units[$pow]; 
			}else{
				return '0 KB'; 
			}
		}
	}
	
	if(!function_exists('get_curl')){
		function get_curl($url){
			// Initiate the curl session
			$ch = curl_init();
			// Set the URL
			curl_setopt($ch, CURLOPT_URL, $url);
			// Removes the headers from the output
			curl_setopt($ch, CURLOPT_HEADER, 0);
			// Return the output instead of displaying it directly
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		    // Execute the curl session
			$output = curl_exec($ch);
			if ($output === false) $output = curl_error($ch);
			// echo stripslashes($output);
		    // Close the curl session
			curl_close($ch);
		    // Return the output as a variable
			return $output;
		}
	}

	if(!function_exists('get_header_request')){
		function get_header_request($index=null){
			if($index){
				foreach(getallheaders() as $key => $val){
					if($key == $index){
						return $val;
					}
				}
			}else{
				return getallheaders();
			}
		}
	}	

	if(!function_exists('check_mobile_token')){
		function check_mobile_token(){
			$CI = get_instance();
			$CI->load->model('api/m_auth');
			// pengecekan token
			$username = get_header_request("username");
			$token = get_header_request("token");
			if($username && $token){
				$detail_token = $CI->m_auth->detail_token($username, $token);
				if(!($detail_token && isset($detail_token->status) && ($detail_token->status == "1"))){
					$myResp = array("status" => "0","data"=> array(),"msg"=> "You are not authorized, please login");
					header('Content-Type: application/json');
					echo json_encode($myResp);
					exit;
				}
			}else{
				$myResp = array("status" => "0","data"=> array(),"msg"=> "You are not authorized, please login");
				header('Content-Type: application/json');
				echo json_encode($myResp);
				exit;
			}
		}
	}
	/**
		* Mengencrypt id yang di pass
		* @param $value = id yang akan di encrypt
	*/
	if (!function_exists('encrypt_xtoken')){
		function encrypt_xtoken($value){
			date_default_timezone_set("Asia/Jakarta");
			$now    = date('Y-m-d H:i:s');
			$result = generateRandomString(rand(20,30)).".".generateRandomString(30,40).".".rand(10,99).base64_encode(rand(10,99).base64_encode(rand(10,99).$value));
			return $result;
		}
	}
	
	/**
		* Mendecrypt id yang di pass
		* @param $value = id yang akan di decrypt
	*/
	if (!function_exists('decrypt_xtoken')){
		function decrypt_xtoken($value){
			$value = explode(".",$value)[2];
			$result = substr(base64_decode(substr(base64_decode(substr($value,2)),2)),2);
			return $result;
		}
	}
	if (!function_exists('generateRandomString')){
		function generateRandomString($length = 10) {
		    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $charactersLength = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
		    return $randomString;
		}
	}

	#obfuscate js
	if (!function_exists('jsObfuscate')) {
		function jsObfuscate($data, $location, $fromFile = FALSE)
		{
			$CI = &get_instance();
			if ($fromFile) {
				$packed_js = file_get_contents($location);
			} else {
				$packed_js = $CI->load->view($location, $data, TRUE);
			}
			$packer = new Tholu\Packer\Packer($packed_js, 'Normal', true, false, true);
			$packed_js = $packer->pack();
			return $packed_js;
		}
	}

	if(!function_exists('nik_to_name')){
		function nik_to_name($nik){
			$CI = get_instance();
			$CI->load->model('m_user');
			// pengecekan token
			$detail = $CI->m_user->detail_username($nik);
			if($detail){
				return $detail->fullname;
			}else{
				return null;
			}
		}
	}


	
