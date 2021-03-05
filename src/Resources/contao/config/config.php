<?php

/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['generatePage'][] = array(\Slashworks\ContaoSocialMediaBundle\Hook\GeneratePage::class, 'addSocialMediaTags');
