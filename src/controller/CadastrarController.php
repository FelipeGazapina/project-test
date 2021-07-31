<?php


class CadastrarController{
    
    public function index(){
        echo 'cadastrar';
    }

    public function criar($name,$user,$password){

        $pass_en =$this->pw_encode($password);

        $usuario =  new User();
        $usuario->create($name,$user,$pass_en);

        echo 'home';
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
}
