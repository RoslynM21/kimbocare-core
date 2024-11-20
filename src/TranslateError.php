<?php

namespace Kimbocare\Core;


/**
 * Classe utilitaire TranslateError.
 *
 * Fournit des constantes pour les traductions des messages d'erreur dans les microservices.
 * Chaque méthode retourne une clé de traduction qui peut être utilisée pour générer des messages
 * d'erreur personnalisés basés sur le système de traduction de Laravel.
 */
class TranslateError
{
    public static function validationError()
    {
        return 'errors.validation';
    }


    public static function linkError()
    {
        return 'errors.link';
    }

    public static function maxUsage()
    {
        return 'errors.max-usage';
    }

    public static function recaptchaError()
    {
        return 'errors.recaptcha';
    }

    public static function noShowDateError()
    {
        return 'errors.noShowDateError';
    }

    public static function noShowError()
    {
        return 'errors.noShowError';
    }

    public static function unAuthorized()
    {
        return 'errors.unauthorized';
    }

    public static function noFile()
    {
        return 'errors.nofile';
    }

    public static function alreadyPayed()
    {
        return 'errors.already-payed';
    }

    public static function wrongFileType()
    {
        return 'errors.wrong-file-type';
    }

    public static function fileTooBig()
    {
        return 'errors.max-file-size';
    }

    public static function alreadyCancelled()
    {
        return 'errors.already-cancelled';
    }

    public static function alreadyHcUsed()
    {
        return 'errors.already-used';
    }

    public static function userRoleAlreadyExist()
    {
        return 'errors.user-role-exist';
    }

    public static function codeNoSend()
    {
        return 'errors.send-code-error';
    }

    public static function wrongPassword()
    {
        return 'errors.wrongpassword';
    }

    public static function wrong2FA()
    {
        return 'errors.wrong2fa';
    }

    public static function errorAssignBuyedTohcp()
    {
        return 'errors.assign-chp';
    }

    public static function errorLinkpackageTohcp()
    {
        return 'errors.link-hcpackage';
    }

    public static function errorAssignBuyedToPatient()
    {
        return 'errors.assign-patient';
    }

    public static function notReady()
    {
        return 'errors.not-ready';
    }

    public static function notWaiting()
    {
        return 'errors.not-waiting';
    }

    public static function notInuse()
    {
        return 'errors.not-inuse';
    }

    public static function finalInvoiceNotFund()
    {
        return 'errors.final-invoice-fund';
    }

    public static function finalInvoiceAreMultiple()
    {
        return 'errors.final-invoice-are-multiple';
    }

    public static function finalInvoiceAmount()
    {
        return 'errors.final-amount-missing';
    }

    public static function finalInvoiceBudget()
    {
        return 'errors.final-amount-budget';
    }

    public static function noHealCredit()
    {
        return 'errors.healt-credit-small';
    }

    public static function forbidden()
    {
        return 'errors.forbidden';
    }

    public static function onlyOneRole()
    {
        return 'errors.one-role';
    }

    public static function oneRoleRest()
    {
        return 'errors.one-role-rest';
    }

    public static function notFound()
    {
        return 'errors.not-found';
    }

    public static function blocked()
    {
        return 'errors.blocked';
    }

    public static function wait()
    {
        return 'errors.wait';
    }


    public static function maxFileSizePerDayWait()
    {
        return 'errors.max-file-size-per-day-wait';
    }

    public static function contactAlreadyExist()
    {
        return 'errors.contact-already-exist';
    }

    public static function packageAlreadyAssigned()
    {
        return 'errors.package-already-assigned';
    }

    public static function phoneAlreadyExist()
    {
        return 'errors.phone-already-exist';
    }

    public static function emailAlreadyExist()
    {
        return 'errors.email-already-exist';
    }

    public static function sendCreateAccountInvitation()
    {
        return 'errors.send-create-account-invitation';
    }

    public static function codeInfluencerUse()
    {
        return 'errors.influencer-code';
    }

    public static function codeAlreadyUse()
    {
        return 'errors.code-already-use';
    }

    public static function codeNotFound()
    {
        return 'errors.code-not-found';
    }

    public static function cannotDeleteProfile()
    {
        return 'errors.delete-profile';
    }

    public static function minAmountRecommandation()
    {
        return 'errors.min-recommandation-amount';
    }

    public static function countryAlreadyExist()
    {
        return 'errors.country-already-exist';
    }

    public static function wrongApiKey()
    {
        return 'errors.wrong-api-key';
    }

    public static function memberAlreadyExist()
    {
        return 'errors.member-already-exist';
    }

    public static function memberRoleExist()
    {
        return 'errors.member-role-exist';
    }

    public static function invalidInvoice()
    {
        return 'errors.not-valid-invoice';
    }

    public static function errorGoogleAdminAuth()
    {
        return 'errors.error-google-admin-auth';
    }

    public static function invalidGoogleAccount()
    {
        return 'errors.invalid-google-account';
    }

    public static function wrongPatientCode()
    {
        return 'errors.worng-patient-code';
    }

}