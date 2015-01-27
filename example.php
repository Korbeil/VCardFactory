<?php
/**
 * Created by PhpStorm.
 * User: baptisteleduc
 * Date: 27/01/15
 * Time: 22:59
 */

    require_once __DIR__.'/VCardFactory.obj.php';
    require_once __DIR__.'/VCardFactoryField.obj.php';

    date_default_timezone_set('Europe/Paris');

    // simple example with full features of the VCardFactory :)))

    $vcard = new VCardFactory();

    // name & formatted name
    $vcard->add(VCardFactoryField::setName('LEDUC', 'Baptiste', '', 'Mr.'));
    $vcard->add(VCardFactoryField::setFormattedName('LEDUC Baptiste'));

    // personnal
    $vcard->add(VCardFactoryField::setNickname('panda_'));
    $vcard->add(VCardFactoryField::setBirthday('1991-10-01', 'Y-m-d'));
    $vcard->add(VCardFactoryField::setNotes('Just another random bamboo eater.'));

    $vcard->add(VCardFactoryField::setEmail('baptiste.leduc@gmail.com', 'HOME'));
    $vcard->add(VCardFactoryField::setTelephone('0632176349', 'CELL'));
    $vcard->add(VCardFactoryField::setAddress('', '50', 'Avenue de Rompsay', 'La Rochelle', 'Poitou-Charente', '17000', 'France'));

    // work
    $vcard->add(VCardFactoryField::setOrganisation(array('EasyBill SAS', 'Sellsy')));
    $vcard->add(VCardFactoryField::setTitle('Support Developpement Manager'));
    $vcard->add(VCardFactoryField::setRole('Developper'));

    $vcard->add(VCardFactoryField::setEmail('bleduc@sellsy.com', 'WORK'));
    $vcard->add(VCardFactoryField::setTelephone('0547744620', 'WORK'));
    $vcard->add(VCardFactoryField::setAddress('', 'Batiment ARPAE', 'Avenue de Jean-Monnet', 'La Rochelle', 'Poitou-Charente', '17000', 'France'));

    echo $vcard->build();