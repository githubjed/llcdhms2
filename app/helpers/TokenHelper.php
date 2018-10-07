<?php

namespace App\helpers;

class TokenHelper
{
	static function cryptoSecure($params) 
	{
		$min = $params['min'];
		$max = $params['max'];

		$range = $max - $min;

		if ($range < 0)
			return $min; // not so random...
		$log    = log ( $range, 2 );
		$bytes  = ( int ) ($log / 8) + 1; // length in bytes
		$bits   = ( int ) $log + 1; // length in bits
		$filter = ( int ) (1 << $bits) - 1; // set all lower bits to 1
		do {
			$rnd = hexdec ( bin2hex ( openssl_random_pseudo_bytes ( $bytes ) ) );
			$rnd = $rnd & $filter; // discard irrelevant bits
		} while ( $rnd >= $range );

		return $min + $rnd;
	}

	static function activationCode($params) 
	{
		$length 	   = $params['length'];
		$alphanumeric  = $params['alphanumeric'];
		
		$token 		   = "";
		$code_alphabet = "0123456789";

		if ($alphanumeric) {
			$code_alphabet .= "A0B1C2D3E4F5G6H7I8J9K0L1M2N3O4P5Q6R7S8T9U0V1W2X3Y4Z5";
			$code_alphabet .= "a6b7c8d9e1f2g3h4i5j6k7l8m9n0o1p2q3r4s5t6u7v8w9x0y1z";
		}

		for($i = 0; $i < $length; $i ++) {
			$token .= $code_alphabet[ TokenHelper::cryptoSecure( array('min' => 0, 'max' => strlen($code_alphabet) )) ];
		}

		return $token;
	}

} // End of Class