<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Captcha extends Frontend_Controller {

	public function index(){

	}

    public function image(){

    	$this->load->helper('captcha_helper');

	    $captcha_config = unserialize($_SESSION['_CAPTCHA']['config']);
	    if( !$captcha_config ) exit();
	    
	    //unset($_SESSION['_CAPTCHA']);
	    
	    // Use milliseconds instead of seconds
	    srand(microtime() * 100);
	    
	    // Pick random background, get info, and start captcha
	    $background = $captcha_config['backgrounds'][rand(0, count($captcha_config['backgrounds']) -1)];
	    list($bg_width, $bg_height, $bg_type, $bg_attr) = getimagesize($background);
	    
	    $captcha = imagecreatefrompng($background);
	    
	    $color = hex2rgb($captcha_config['color']);
	    $color = imagecolorallocate($captcha, $color['r'], $color['g'], $color['b']);
	    
	    // Determine text angle
	    $angle = rand( $captcha_config['angle_min'], $captcha_config['angle_max'] ) * (rand(0, 1) == 1 ? -1 : 1);
	    
	    // Select font randomly
	    $font = $captcha_config['fonts'][rand(0, count($captcha_config['fonts']) - 1)];
	    
	    // Verify font file exists
	    if( !file_exists($font) ) throw new Exception('Font file not found: ' . $font);
	    
	    //Set the font size.
	    $font_size = rand($captcha_config['min_font_size'], $captcha_config['max_font_size']);
	    $text_box_size = imagettfbbox($font_size, $angle, $font, $captcha_config['code']);
	    
	    // Determine text position
	    $box_width = abs($text_box_size[6] - $text_box_size[2]);
	    $box_height = abs($text_box_size[5] - $text_box_size[1]);
	    $text_pos_x_min = 0;
	    $text_pos_x_max = ($bg_width) - ($box_width);
	    $text_pos_x = rand($text_pos_x_min, $text_pos_x_max);            
	    $text_pos_y_min = $box_height;
	    $text_pos_y_max = ($bg_height) - ($box_height / 2);
	    $text_pos_y = rand($text_pos_y_min, $text_pos_y_max);
	    
	    // Draw shadow
	    if( $captcha_config['shadow'] ){
	        $shadow_color = hex2rgb($captcha_config['shadow_color']);
	         $shadow_color = imagecolorallocate($captcha, $shadow_color['r'], $shadow_color['g'], $shadow_color['b']);
	        imagettftext($captcha, $font_size, $angle, $text_pos_x + $captcha_config['shadow_offset_x'], $text_pos_y + $captcha_config['shadow_offset_y'], $shadow_color, $font, $captcha_config['code']);    
	    }
	    
	    // Draw text
	    imagettftext($captcha, $font_size, $angle, $text_pos_x, $text_pos_y, $color, $font, $captcha_config['code']);    
	    
		$this->output
		->set_content_type('image/png')
		->set_output(imagepng($captcha));

    }

}