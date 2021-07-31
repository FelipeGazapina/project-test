<?php


class HomeController{
    
    public function index(){
       echo 'home';
    }
    public function login($user_name,$user_pass){

        $user = new User();
        $resp = $user->search($user_name);

        $pass = $this->pw_check($user_pass, $resp['user_pass']);
        if($pass){
            echo 'dashboard';
        }else{
            echo 'home';
        }
    }


    
    public function hmac($key, $data, $hash = 'md5', $blocksize = 64) {
        if (strlen($key)>$blocksize) {
         $key = pack('H*', $hash($key));
        }
        $key  = str_pad($key, $blocksize, chr(0));
        $ipad = str_repeat(chr(0x36), $blocksize);
        $opad = str_repeat(chr(0x5c), $blocksize);
        return $hash(($key^$opad) . pack('H*', $hash(($key^$ipad) . $data)));
      }
  
   
    public  function make_seed() {
         list($usec, $sec) = explode(' ', microtime());
         return (float) $sec + ((float) $usec * 100000);
      }
  
    public  function pw_encode($password) {
        mt_srand($this->make_seed());
        $seed = substr('00' . dechex(mt_rand()), -3) .
         substr('00' . dechex(mt_rand()), -3) .
         substr('0' . dechex(mt_rand()), -2);
        return $this->hmac($seed, $password, 'md5', 64) . $seed;
      }
    public function pw_check($password, $stored_value) {
        $seed = substr($stored_value, 32, 8);
        return $this->hmac($seed, $password, 'md5', 64) . $seed==$stored_value;
      }
}
