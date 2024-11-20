<?php

namespace Kimbocare\Core;

use InvalidArgumentException;

/**
 * Classe utilitaire TestUtils.
 *
 * Fournit des outils pour générer des données de test aléatoires
 * et effectuer des tests par lots dans des environnements de tests automatisés.
 */
class TestUtils
{
    /**
     * Liste des spécialités médicales disponibles pour les tests.
     */
    private const SPECIALITIES = [
        "cardiologie",
        "neurochirurgie",
        "dermatologie",
        "endocrinologie",
        "geriatrie",
        "gynecologie",
        "hematologie",
        "radiologie",
        "radiotherapie",
        "rhumatologie",
        "psychiatrie",
        "pneumologie",
        "pediatrie",
        "orthopedie",
        "ophtalmologie",
        "obstetrique",
        "oncologie",
        "odontologie",
        "neurologie",
        "hepatologie",
        "infectiologie",
        "neonatologie",
        "nephrologie",
        "chirurgie"
    ];

    /**
     * Retourne une liste aléatoire de spécialités médicales.
     *
     * @return array Liste des spécialités sélectionnées.
     */
    public static function randomSpecialities(): array
    {
        $specialities = self::SPECIALITIES;
        $length = random_int(1, count($specialities)); // Au moins une spécialité
        shuffle($specialities);
        return array_slice($specialities, 0, $length);
    }

    /**
     * Exécute des tests par lots pour vérifier les autorisations.
     *
     * @param mixed $user L'utilisateur à tester.
     * @param callable $testFunction La fonction de test qui prend deux arguments ($user, $param).
     * @param array $paramsOk Les paramètres attendus pour lesquels l'accès doit être autorisé.
     * @param array $paramsForbidden Les paramètres attendus pour lesquels l'accès doit être refusé.
     *
     * @throws InvalidArgumentException Si les paramètres ne sont pas des tableaux.
     */
    public static function utilBatchTest(
        $user,
        callable $testFunction,
        array $paramsOk,
        array $paramsForbidden
    ): void {
        if (!is_array($paramsOk) || !is_array($paramsForbidden)) {
            throw new InvalidArgumentException('Les paramètres "paramsOk" et "paramsForbidden" doivent être des tableaux.');
        }

        foreach ($paramsOk as $param) {
            $testFunction($user, $param)->assertOk();
        }

        foreach ($paramsForbidden as $param) {
            $testFunction($user, $param)->assertForbidden();
        }
    }
}
