<?php

namespace Agro\Validators;

class TaxValidator
{
    private static string $errorMessage;

    public static function validateTaxNumber(string $taxNumber): bool
    {
        if ('' === $taxNumber) {
            self::$errorMessage = "Поле Tax номер не может быть пустым!";
            return false;
        } elseif (mb_strlen($taxNumber) <= 2) {
            self::$errorMessage = "Длина поля Tax номер должна быть больше 2 символов!";
            return false;
        }

        return true;
    }

    public static function validateProductId(int $productId): bool
    {
        if (0 === $productId) {
            self::$errorMessage = "Поле Product ID не может быть пустым!";
            return false;
        }

        return true;
    }

    public static function getValidatorError(): string
    {
        return self::$errorMessage;
    }
}
