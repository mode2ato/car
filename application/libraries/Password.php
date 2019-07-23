<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Password {

        protected $CI;

        // We'll use a constructor, as you can't directly call a function
        // from a property definition.
        public function __construct()
        {
                // Assign the CodeIgniter super-object
                $this->CI =& get_instance();
                $this->CI->load->library('encryption');
        }

        private $encryption_key = 'mdk';

        public function encrypt($pure_string) {
            $code = base64_encode($pure_string);
            $base64 = base64_encode($code.$this->encryption_key);
            $encrypted_string = base64_encode($base64);
            return $this->CI->encryption->encrypt($encrypted_string);
        }

        public function decrypt($encrypted_string) {
            $data = $this->CI->encryption->decrypt($encrypted_string);
            $code = base64_decode($data);
            $base64 = base64_decode($code);
            $ps = str_replace($this->encryption_key,'',$base64);
            $decrypted_string = base64_decode($ps,true);
            return $decrypted_string;
        }

}
?>
