<?php

namespace Slashworks\ContaoSocialMediaBundle\Classes;

use Contao\Controller;
use Contao\Environment;
use Contao\FilesModel;
use Contao\FrontendTemplate;
use Contao\PageModel;
use Contao\System;
use Contao\Validator;
use Symfony\Component\VarDumper\VarDumper;

class SocialMedia
{

    public function getSocialMediaDataByPage(PageModel $page, $recursive = true)
    {
        $pages = [];

        $socialMediaTitle = null;
        $socialMediaDescription = null;
        $socialMediaImage = null;

        $template = new FrontendTemplate('social_media_tags');

        $currentPage = $page;

        do {
            $pages[] = $page;
        } while (($page = PageModel::findById($page->pid)) !== null);

        // Recursively get data from parent pages if the current page does not contain any information.
        foreach ($pages as $page) {
            if (empty($socialMediaTitle)) {
                $socialMediaTitle = $page->sm_title;
            }

            if (empty($socialMediaDescription)) {
                $socialMediaDescription = $page->sm_description;
            }

            if (empty($socialMediaImage)) {
                $socialMediaImage = $page->sm_image;
            }
        }

        // Fallback to general meta data.
        if (empty($socialMediaTitle)) {
            $socialMediaTitle = $currentPage->title;
        }
        if (empty($socialMediaDescription)) {
            $socialMediaDescription = $currentPage->description;
        }

        $template->language = $currentPage->language;
        $template->title = $socialMediaTitle;
        $template->description = $socialMediaDescription;
        $template->image = $this->generateImageByUuid($socialMediaImage);
        $template->url = $currentPage->getAbsoluteUrl();
        $template->siteName = $currentPage->rootTitle;

        return $template->parse();
    }

    protected function generateImageByUuid($uuid)
    {
        $file = FilesModel::findByUuid($uuid);
        if ($file === null) {
            return false;
        }

        if (!is_file(System::getContainer()->getParameter('kernel.project_dir') . '/' . $file->path)) {
            return false;
        }

        $template = new FrontendTemplate();
        $imageItem = array
        (
            'singleSRC' => $file->path,
            'size'      => array(1200, 628),
        );
        Controller::addImageToTemplate($template, $imageItem, null, null, $file);

        return $template->getData();
    }

}
