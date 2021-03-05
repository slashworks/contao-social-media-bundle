<?php

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Contao\PageModel;

$socialMediaPalette = PaletteManipulator::create()
                                        ->addLegend('social_media_legend', 'meta_legend',
                                            PaletteManipulator::POSITION_AFTER, true)
                                        ->addField(array('sm_title', 'sm_description', 'sm_image'), 'social_media_legend',
                                            PaletteManipulator::POSITION_APPEND);

$socialMediaPalette->applyToPalette('root', PageModel::getTable());
$socialMediaPalette->applyToPalette('regular', PageModel::getTable());

$GLOBALS['TL_DCA']['tl_page']['fields']['sm_title'] = array
(
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => array('tl_class' => 'w50'),
    'sql'       => "varchar(255) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_page']['fields']['sm_description'] = array
(
    'exclude'     => true,
    'inputType'   => 'textarea',
    'eval'        => array('tl_class' => 'clr'),
    'explanation' => 'insertTags',
    'sql'         => "mediumtext NULL",
);

$GLOBALS['TL_DCA']['tl_page']['fields']['sm_image'] = array
(
    'exclude'   => true,
    'inputType' => 'fileTree',
    'eval'      => array('filesOnly' => true, 'fieldType' => 'radio', 'tl_class' => 'clr'),
    'sql'       => "binary(16) NULL",
);
