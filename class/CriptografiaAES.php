<?php 
class CriptografiaAES
{
    public static function encrypt($message, $key)
    {
        if (mb_strlen($key, '8bit') !== 32) {
            return "Precisa-se de uma chave de 256 bits!";
        }
        $ivsize = openssl_cipher_iv_length('aes-256-cbc');
        $iv = openssl_random_pseudo_bytes($ivsize);
        
        $ciphertext = openssl_encrypt(
            $message,
            'aes-256-cbc',
            $key,
            OPENSSL_RAW_DATA,
            $iv
        );
        
        return $iv . $ciphertext;
    }

    public static function decrypt($message, $key)
    {
        if (mb_strlen($key, '8bit') !== 32) {
            return "Precisa-se de uma chave de 256 bits!";
        }
        $ivsize = openssl_cipher_iv_length('aes-256-cbc');
        $iv = mb_substr($message, 0, $ivsize, '8bit');
        $ciphertext = mb_substr($message, $ivsize, null, '8bit');
        
        return openssl_decrypt(
            $ciphertext,
            'aes-256-cbc',
            $key,
            OPENSSL_RAW_DATA,
            $iv
        );
    }
}    
?>