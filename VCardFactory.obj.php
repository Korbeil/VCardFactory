<?php
/**
 * Created by PhpStorm.
 * User: baptisteleduc
 * Date: 27/01/15
 * Time: 20:19
 */

class VCardFactory {

    protected $_fields;
    protected $_locked;

    public function __construct() {
        $this->_fields      = Array();
        $this->_locked      = false;
    }

    public function add( $field) {
        $this->_fields[] = $field;
    }

    public function build() {
        $more       = Array();

        $more[]     = VCardFactoryField::begin();
        $more[]     = VCardFactoryField::version();

        $more = array_merge($more, $this->_fields);

        $more[]     = VCardFactoryField::end();

        $vcard      = '';
        foreach($more as $field) {
            $vcard .= $field->build();
        }

        return $vcard;
    }

    public function download($filename = 'contact') {
        $output = $this->build();

        header('Content-type: text/x-vcard; charset=UTF-8');
        header('Content-Disposition: attachment; filename=' .$filename. '.vcf;');

        header('Content-Length: ' . strlen($output));
        header('Connection: close');

        echo $output;
    }

////////////////////////////////////////////////////////////
    // utils


////////////////////////////////////////////////////////////

} 