<?php

namespace Slashworks\ContaoSocialMediaBundle\Hook;

use Contao\LayoutModel;
use Contao\PageModel;
use Contao\PageRegular;
use Slashworks\ContaoSocialMediaBundle\Classes\SocialMedia;

class GeneratePage
{

    public function addSocialMediaTags(PageModel $page, LayoutModel $layout, PageRegular $pageRegular)
    {
        $socialMedia = new SocialMedia();
        $socialMediaTags = $socialMedia->getSocialMediaDataByPage($page);

        $GLOBALS['TL_HEAD'][] = $socialMediaTags;
    }

}
