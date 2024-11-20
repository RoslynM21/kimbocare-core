<?php

namespace Kimbocare\Core;

use Illuminate\Support\Facades\App;

/**
 * Classe utilitaire Formatter.
 *
 * Fournit des fonctions de formatage courantes et des outils utiles
 * pour manipuler des données dans les microservices.
 */
class Formatter
{
    /**
     * Formate un numéro de téléphone en supprimant les caractères non valides
     * et en remplaçant les préfixes de type '00' par '+'.
     *
     * @param string $phoneNumber Le numéro de téléphone à formater.
     * @return string Le numéro de téléphone formaté.
     */
    public static function formatPhoneNumber(string $phoneNumber): string
    {
        $withoutCharacters = preg_replace('~^(\+)|\D~', '\1', $phoneNumber);
        $withoutCharacters = preg_replace('/[\/\\\\]/', '', $withoutCharacters);
        return preg_replace('~^0{2}(?!$)~', '+', $withoutCharacters);
    }

    /**
     * Retourne l'erreur en mode debug uniquement.
     *
     * @param mixed $error L'erreur à afficher.
     * @return mixed|null L'erreur si l'application n'est pas en production, sinon null.
     */
    public static function errorDebugOnly($error)
    {
        return App::isProduction() ? null : $error;
    }

    /**
     * Formate un type morphique pour correspondre à un modèle Laravel.
     *
     * @param string $model Le type morphique à formater.
     * @return string|null Le type formaté ou null si invalide.
     */
    public static function formatMorphType(string $model): ?string
    {
        if (strlen($model) <= 1) {
            return null;
        }

        return strpos($model, 'Models') !== false 
            ? $model 
            : 'App\Models\\' . ucfirst($model);
    }

    /**
     * Arrondit un montant au multiple le plus proche d'un pas donné.
     *
     * @param float $amount Le montant à arrondir.
     * @param int $step Le pas d'arrondi (par défaut 5).
     * @return float Le montant arrondi.
     */
    public static function roundToNearest(float $amount, int $step = 5): float
    {
        return (round($amount) % $step === 0) 
            ? round($amount) 
            : round(($amount + $step / 2) / $step) * $step;
    }

    /**
     * Arrondit un montant à l'entier inférieur.
     *
     * @param float $amount Le montant à arrondir.
     * @return int Le montant arrondi.
     */
    public static function floorAmount(float $amount): int
    {
        return (int) floor($amount);
    }

    /**
     * Arrondit un montant à l'entier supérieur.
     *
     * @param float $amount Le montant à arrondir.
     * @return int Le montant arrondi.
     */
    public static function ceilAmount(float $amount): int
    {
        return (int) ceil($amount);
    }
}
