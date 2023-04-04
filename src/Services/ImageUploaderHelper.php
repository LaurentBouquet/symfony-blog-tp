<?php

namespace App\Services;

use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ImageUploaderHelper
{
    private $slugger;
    private $translator;

    public function __construct(SluggerInterface $slugger, TranslatorInterface $translator) {
        $this->slugger = $slugger;
        $this->translator = $translator;
    }


    public function uploadImage($form, $formation)
    {
        $imageFile = $form->get('image')->getData();
        if ($imageFile) {
            $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $this->slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
            try {
                $imageFile->move(
                    $this->getParameter('images_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                $this->addFlash('danger', $this->translator->trans('An error is append: ') . $e->getMessage());
            }
            $formation->setImageFilename($newFilename);
        }
 
    }
}
