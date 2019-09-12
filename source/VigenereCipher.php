<?php
namespace amculin\encryption;

/**
 * This file is the main class for vigenere cipher encryption algortithm
 * 
 * @author Fahmi Auliya Tsani <amixcustomlinux@gmail.com>
 * @version 0.1
 */

class VigenereCipher
{
    /**
     * Default list of acceptable character to be encrypted using vigenere
     * By default, it just an alphabetical list.
     *
     * @var string
     */
    const TABULA_RECTA = 'abcdefghijklmnopqrstuvwxyz';

    /**
     * The plain text/message to be encrypted
     *
     * @var string
     */
    public $plain_text;

    /**
     * The key used to encrypt plain text/message
     *
     * @var string
     */
    public $key;

    /**
     * Set the plain text/message to be encrypted 
     *
     * @param string message
     * @return void
     */
    public function setPlainText($message)
    {
        $this->plain_text = $message;
    }

    /**
     * Set key
     * We loop the key then concatenate it until it has the same length with the plain text
     * Example:
     *     Plain text: vigenerecipher (14 characters)
     *     Key: abcd (4 characters)
     *     Repeated key: abcdabcdabcdab (14 characters)
     *
     * @param string key
     * @return void
     */
    public function setKey($key)
    {
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

    /**
     * Method to encrypt the plain text
     *
     * @return string
     */
    public function encrypt(): string
    {
        $messageLength = strlen($this->plain_text);
        $cipher = '';
        
        for ($i = 0; $i < $messageLength; $i++) {
            $messageCharPosition = strpos(self::TABULA_RECTA, substr($this->plain_text, $i, 1));
            $keyCharPosition = strpos(self::TABULA_RECTA, substr($this->key, $i, 1));
            
            $shift = $messageCharPosition + $keyCharPosition;
            $cipherCharPosition = $shift % strlen(self::TABULA_RECTA);
            $cipher .= substr(self::TABULA_RECTA, $cipherCharPosition, 1);
        }
        
        return $cipher;
    }

    /**
     * Method to get plain text
     *
     * @return string
     */
    public function getPlainText(): string
    {
        return $this->plain_text;
    }

    /**
     * Method to get key
     *
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * Method to get cipher text
     *
     * @return string
     */
    public function getCipherText(): string
    {
        return $this->encrypt();
    }
}
?>