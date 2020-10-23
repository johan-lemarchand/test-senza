<?php
namespace App\Services;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ImageUploader
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function upload($file, $directory = null)
    {
        if ($file === null) {
            return false;
        }

        // On détermine le dossier cible en fonction de $directory
        if ($directory === null) {

            $directory = $this->params->get('image_directory');
        }

        // On utilise la méthode move() comme on le faisait le contrôleur
        $file->move($directory, $file->getClientOriginalName());
        return true;
    }
}
