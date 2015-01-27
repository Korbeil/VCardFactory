<?php
/**
 * Created by PhpStorm.
 * User: baptisteleduc
 * Date: 27/01/15
 * Time: 20:20
 */

class VCardFactoryField {

    protected $_key     = '';
    protected $_value   = '';

    public function __construct($key) {
        $this->_key = $key;
    }

    public function setValue($value) {
        $this->_value = $value;
    }

    public function build() {
        return $this->_key. ':' .$this->_value. "\r\n";
    }

////////////////////////////////////////////////////////////

    public static function buildOne($key, $value) {
        $obj = new self($key);
        $obj->setValue($value);
        return $obj;
    }

////////////////////////////////////////////////////////////
    // utils

    protected static function toISO8601($date, $format, $withHours = false) {
        $string         = '';
        $objDate        = DateTime::createFromFormat($format, $date);

        $string        .= $objDate->format('Y-m-d');

        if($withHours) {
            $string    .= 'T';
            $string    .= $objDate->format('Y-m-d');
        }

        $string        .= 'Z';
        return $string;
    }

////////////////////////////////////////////////////////////
    // meta
    public static function begin() {
        return self::buildOne('BEGIN', 'VCARD');
    }
    public static function version() {
        return self::buildOne('VERSION', '3.0');
    }
    public static function end() {
        return self::buildOne('END', 'VCARD');
    }
    public static function revision() {
        return self::buildOne('REV', date('Y-m-d'). 'T' .date("H:i:s"). 'Z');
    }

    // mandatory
    public static function setName($name, $forename = '', $surname = '', $title = '', $suffix = '') {
        $array = Array($name, $forename, $surname, $title, $suffix);
        return self::buildOne('N', implode(';', $array));
    }
    public static function setFormattedName($name) {
        return self::buildOne('FN', $name);
    }

    // additionnal
    public static function setNickname($nickname) {
        return self::buildOne('NICKNAME', $nickname);
    }
    public static function setPhoto($uri) {
        return self::buildOne('PHOTO', $uri);
    }
    public static function setBirthday($date, $format = 'u') {
        return self::buildOne('BDAY', self::toISO8601($date, $format));
    }
    public static function setOrganisation($orgs) {
        return self::buildOne('ORG', implode(';', $orgs));
    }
    public static function setTitle($title) {
        return self::buildOne('TITLE', $title);
    }
    // types: HOME/WORK
    public static function setEmail($email, $type = 'HOME') {
        return self::buildOne('EMAIL;TYPE=' .$type, $email);
    }
    // types: CELL/IPHONE/HOME/WORK/MAIN/PAGER/OTHER
    public static function setTelephone($numero, $type = 'CELL') {
        return self::buildOne('TEL;TYPE=' .$type, $numero);
    }
    // types: HOME/WORK/OTHER
    public static function setAddress($postal = '', $address = '', $street = '', $city = '', $state = '', $postalCode = '', $country = '', $type = 'HOME') {
        $parts = array($postal, $address, $street, $city, $state, $postalCode, $country);
        return self::buildOne('ADR;TYPE=' .$type, implode(';', $parts));
    }
    public static function setNotes($notes) {
        return self::buildOne('NOTE', $notes);
    }
    public static function setRole($role) {
        return self::buildOne('ROLE', $role);
    }
    public static function setCategories($categories) {
        return self::buildOne('CATEGORIES', implode(',', $categories));
    }
}
