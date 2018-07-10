<?php
    class SimpleCaptcha {
        public $code = '';

        private $captcha_config = array(
            'code' => '',
            'min_length' => 5,
            'max_length' => 5,
            'backgrounds' => array(
                '45-degree-fabric.png',
                'cloth-alike.png',
                'grey-sandbag.png',
                'kinda-jean.png',
                'polyester-lite.png',
                'stitched-wool.png',
                'white-carbon.png',
                'white-wave.png'
            ),
            'fonts' => array(
                'times_new_yorker.ttf'
            ),
            'characters' => 'ABCDEFGHJKLMNPRSTUVWXYZabcdefghjkmnprstuvwxyz23456789',
            'min_font_size' => 28,
            'max_font_size' => 28,
            'color' => '#666',
            'angle_min' => 0,
            'angle_max' => 10,
            'shadow' => true,
            'shadow_color' => '#fff',
            'shadow_offset_x' => -1,
            'shadow_offset_y' => 1
        );

        public function _construct(){

        }

        public function getCode(){
            $this->code = '';
            
            $length = 5;

            while( strlen($this->code) < $length ) {
                $this->code .= substr($this->captcha_config['characters'], rand() % (strlen($this->captcha_config['characters'])), 1);
            }

            return $this->code;
        }

        public function drawImage($code){

            $background_path = 'backgrounds/';
            $font_path = 'fonts/';

            $background = $background_path . $this->captcha_config['backgrounds'][rand(0, count($this->captcha_config['backgrounds']) -1)];

            list($bg_width, $bg_height, $bg_type, $bg_attr) = getimagesize($background);
            
            $captcha = imagecreatefrompng($background);
            
            $color = $this->hex2rgb($this->captcha_config['color']);
            $color = imagecolorallocate($captcha, $color['r'], $color['g'], $color['b']);
            
            // Determine text angle
            $angle = rand( $this->captcha_config['angle_min'], $this->captcha_config['angle_max'] ) * (rand(0, 1) == 1 ? -1 : 1);
            
            // Select font randomly
            $font = $font_path . $this->captcha_config['fonts'][rand(0, count($this->captcha_config['fonts']) - 1)];
            
            // Verify font file exists
            if( !file_exists($font) ) throw new Exception('Font file not found: ' . $font);
            
            //Set the font size.
            $font_size = rand($this->captcha_config['min_font_size'], $this->captcha_config['max_font_size']);
            $text_box_size = imagettfbbox($font_size, $angle, $font, $code);
            
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
            if( $this->captcha_config['shadow'] ){
                $shadow_color = $this->hex2rgb($this->captcha_config['shadow_color']);
                $shadow_color = imagecolorallocate($captcha, $shadow_color['r'], $shadow_color['g'], $shadow_color['b']);
                imagettftext($captcha, $font_size, $angle, $text_pos_x + $this->captcha_config['shadow_offset_x'], $text_pos_y + $this->captcha_config['shadow_offset_y'], $shadow_color, $font, $code);  
            }
            
            // Draw text
            imagettftext($captcha, $font_size, $angle, $text_pos_x, $text_pos_y, $color, $font, $code);   
            header("Content-type: image/png");
            imagepng($captcha_image);
 
        }

        private function hex2rgb($hex_str, $return_string = false, $separator = ',') {
            $hex_str = preg_replace("/[^0-9A-Fa-f]/", '', $hex_str); // Gets a proper hex string
            $rgb_array = array();
            if( strlen($hex_str) == 6 ) {
                $color_val = hexdec($hex_str);
                $rgb_array['r'] = 0xFF & ($color_val >> 0x10);
                $rgb_array['g'] = 0xFF & ($color_val >> 0x8);
                $rgb_array['b'] = 0xFF & $color_val;
            } elseif( strlen($hex_str) == 3 ) {
                $rgb_array['r'] = hexdec(str_repeat(substr($hex_str, 0, 1), 2));
                $rgb_array['g'] = hexdec(str_repeat(substr($hex_str, 1, 1), 2));
                $rgb_array['b'] = hexdec(str_repeat(substr($hex_str, 2, 1), 2));
            } else {
                return false;
            }
            return $return_string ? implode($separator, $rgb_array) : $rgb_array;
        }


    }
?>
