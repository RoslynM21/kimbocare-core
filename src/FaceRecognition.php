<?php

namespace Kimbocare\Core;

use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Exception;

/**
 * FaceRecognition Client pour interagir avec un service Flask de reconnaissance faciale.
 *
 * Cette classe permet de comparer deux images en envoyant une requête multipart à un service Flask qui 
 * exécute la comparaison des visages. Elle utilise la bibliothèque Guzzle pour effectuer les appels HTTP.
 */
class FaceRecognition
{

    /**
     * Instance du client HTTP Guzzle.
     *
     * Ce client est utilisé pour envoyer des requêtes HTTP au service Flask.
     * 
     * @var \GuzzleHttp\Client
     */
    private Client $client;


    /**
     * URL du service Flask de reconnaissance faciale.
     *
     * Cette URL est utilisée pour envoyer des requêtes de comparaison d'images vers le service Flask.
     * 
     * @var string
     */
    private string $flaskServiceUrl;


    /**
     * Constructeur pour initialiser le client Guzzle et l'URL du service Flask.
     *
     * Ce constructeur prend en paramètre l'URL du service Flask, et crée une nouvelle instance de Client
     * pour les appels HTTP. Il est utilisé pour envoyer des requêtes de comparaison d'images.
     *
     * @param string $flaskServiceUrl L'URL du service Flask qui traitera la comparaison des images.
     * 
     * @throws \InvalidArgumentException Si l'URL du service Flask est vide ou invalide.
     */
    public function __construct(string $flaskServiceUrl)
    {

        if (empty($flaskServiceUrl) || !filter_var($flaskServiceUrl, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException("L'URL du service Flask est invalide ou vide.");
        }

        $this->client = new Client();
        $this->flaskServiceUrl = $flaskServiceUrl;
    }

    /**
     * Compare two images by sending them to a Flask service for face recognition.
     *
     * Cette méthode envoie deux images à un service Flask pour effectuer la comparaison des visages. 
     * Elle utilise Guzzle pour envoyer une requête multipart et reçoit une réponse JSON indiquant 
     * si les visages des images correspondent.
     *
     * @param string $path_1 Le chemin du premier fichier image à comparer.
     * @param string $path_2 Le chemin du deuxième fichier image à comparer.
     * @return array La réponse JSON contenant le résultat de la comparaison des visages.
     * 
     * @throws \Exception Si une erreur survient lors de l'envoi de la requête ou du traitement de la réponse.
     */
    public function check($path_1, $path_2)
    {
        try {

            $mimeType1 = self::getMimeType($path_1);
            $mimeType2 = self::getMimeType($path_2);

            $options = [
                'multipart' => [
                    [
                        'name'     => 'image_1',
                        'contents' => fopen($path_1, 'r'),
                        'filename' => basename($path_1),
                        'headers'  => [
                            'Content-Type' => $mimeType1
                        ]
                    ],
                    [
                        'name'     => 'image_2',
                        'contents' => fopen($path_2, 'r'),
                        'filename' => basename($path_2),
                        'headers'  => [
                            'Content-Type' => $mimeType2
                        ]
                    ]
                ]
            ];

            $response = $this->client->post($this->flaskServiceUrl, $options);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data;

        } catch (Exception $e) {
            Log::error('Error occurred during image comparison: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Détecte le type MIME d'un fichier image.
     *
     * @param string $path Le chemin vers le fichier image.
     * @return string Le type MIME de l'image.
     */
    private static function getMimeType($path)
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE); 
        $mimeType = finfo_file($finfo, $path); 
        finfo_close($finfo); 
        return $mimeType;
    }
}
