<?php
class VigenereCipher {
	public $plain_text, $key;
	public $tabula_recta = 'abcdefghijklmnopqrstuvwxyz';
	
	public function setPlainText($message)
	{
		$this->plain_text = $message;
	}
	
	public function setKey($key) {
        $plainTextLength = strlen($this->plain_text);
        $keyLength = strlen($key);
		$messageLength = strlen($this->plain_text);

        $repeatTimes = floor($messageLength / $keyLength);
        $paddingKeyLength = $messageLength - ($keyLength * $repeatTimes);
        
        $repeatedKey = '';

        for ($i = 0; $i < $repeatTimes; $i++) {
            $repeatedKey .= $key;
        }
        
        $paddedKey = $repeatedKey . substr($key, 0, $paddingKeyLength);
        
        $this->key = $paddedKey;
    }
	
	public function getPlainText()
	{
		return $this->plain_text;
	}
	
	public function getKey()
	{
		return $this->key;
	}
	
	public function encrypt()
	{
		$messageLength = strlen($this->plain_text);
		$cipher = '';
		
		for ($i = 0; $i < $messageLength; $i++) {
			$messageCharPosition = strpos($this->tabula_recta, substr($this->plain_text, $i, 1));
			$keyCharPosition = strpos($this->tabula_recta, substr($this->key, $i, 1));
			
			$shift = $messageCharPosition + $keyCharPosition;
			$cipherCharPosition = $shift % strlen($this->tabula_recta);
			$cipher .= substr($this->tabula_recta, $cipherCharPosition, 1);
		}
		
		return $cipher;
	}
	
	public function getCipherText()
	{
		return $this->encrypt();
	}
}
?>