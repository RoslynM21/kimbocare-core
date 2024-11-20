<?php

namespace Kimbocare\Core;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

/**
 * Classe utilitaire KimboUtils.
 *
 * Fournit des fonctions utilitaires réutilisables dans les microservices.
 */
class KimboUtils
{
    /**
     * Durée de mise en cache des requêtes en secondes.
     */
    public const REQUEST_CACHE_AGE = 180;

    /**
     * Montant minimum recommandé.
     */
    public const MIN_RECOMMANDATION_AMOUNT = 8;
    
    /**
     * Préfixe pour les URL raccourcies.
     *
     * @var string
     */
    private string $shortPrefix;

    /**
     * Constructeur de la classe KimboUtils.
     *
     * @param string $shortPrefix Le préfixe utilisé pour les URL raccourcies (exemple : "xyz").
     */
    public function __construct(?string $shortPrefix = 'l')
    {
        $this->shortPrefix = $shortPrefix;
    }


    /**
     * Raccourcit une URL avec un préfixe défini.
     *
     * @param string $url L'URL à raccourcir.
     * @return string L'URL raccourcie.
     */
    public function shortenUrl(string $url): string
    {
        $random = self::generateRandomString(3);
        Cache::put("{$random}_short", $url, now()->addDays(30));
        return "http://s.kimbocare.com/" . $this->shortPrefix . $random;
    }

    

    /**
     * Génère un hachage unique pour un objet.
     *
     * @param mixed $object L'objet à hacher.
     * @return string Le hachage de l'objet.
     */
    public static function objectHash($object): string
    {
        $serializedObject = serialize($object);
        return hash('sha256', $serializedObject);
    }

    /**
     * Génère une chaîne aléatoire d'une longueur donnée.
     *
     * @param int $length La longueur de la chaîne aléatoire (par défaut 10).
     * @return string La chaîne générée.
     */
    public static function generateRandomString(int $length = 10): string
    {
        return Str::random($length);
    }

    /**
     * Formate une date pour un graphique avec ou sans le jour.
     *
     * @param Carbon $date La date à formater.
     * @param string $locale La langue pour la traduction (par ex. 'en', 'fr').
     * @param bool $hasDay Inclure le jour dans la date (par défaut true).
     * @return string La date formatée.
     */
    public static function formatGraphDate(Carbon $date, string $locale, bool $hasDay = true): string
    {
        Carbon::setLocale($locale);
        return $hasDay ? $date->translatedFormat('jS F Y') : $date->translatedFormat('F Y');
    }

    /**
     * Calcule la période de début et de fin en fonction d'une période.
     *
     * @param string $period La période (par ex. 'day', 'month', 'year').
     * @param string|null $startAt Date de début personnalisée (format Y-m-d).
     * @param string|null $endAt Date de fin personnalisée (format Y-m-d).
     * @return array Tableau contenant les dates de début et de fin.
     */
    public static function formatGraphDatePeriod(string &$period, ?string $startAt = null, ?string $endAt = null): array
    {
        $startDate = now();
        $endDate = now();

        switch ($period) {
            case 'day':
                $startDate->startOfDay();
                break;
            case 'seven_day':
                $startDate->startOfWeek();
                break;
            case 'month':
                $startDate->startOfMonth();
                break;
            case 'year':
                $startDate->startOfYear();
                break;
            default:
                $startDate = Carbon::parse($startAt)->startOfDay();
                $endDate = Carbon::parse($endAt)->endOfDay();
                if ($endDate->diffInDays($startDate) >= 30) {
                    $period = 'year';
                }
                break;
        }

        return [$startDate, $endDate];
    }

    /**
     * Renvoie une liste de dates entre deux dates.
     *
     * @param Carbon $startDate La date de début.
     * @param Carbon $endDate La date de fin.
     * @param string $period La période (par ex. '1 day', '1 week').
     * @param bool $isFirst Inclure la première date.
     * @param bool $addEndDate Inclure la date de fin.
     * @return Collection Collection d'objets Carbon.
     */
    public static function getDatesBetweenTwoDates(Carbon $startDate, Carbon $endDate, string $period, bool $isFirst = false, bool $addEndDate = false): Collection
    {
        $periods = CarbonPeriod::create($startDate, $period, $endDate);
        $dates = new Collection();
        $index = 0;

        foreach ($periods as $p) {
            if (($p->notEqualTo($startDate) && $p->notEqualTo($endDate)) || ($isFirst && $index < count($periods) - 1) || ($addEndDate && $index > 0)) {
                $dates->push($p);
            }
            $index++;
        }

        return $dates;
    }
}
