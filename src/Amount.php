<?php
namespace PUG;

use Exception;
use Precious\Precious;

final class Amount extends Precious
{
    protected function init() : array
    {
        return [
            self::required('cents', self::integerType()),
            self::required('precision', self::integerType()),
            self::required('currency', self::stringType()),
        ];
    }

    public static function fromString(string $amount)
    {
        if (!preg_match('/^([0-9]+)\.([0-9]+)\/([A-Z]{3})$/', $amount, $matches)) {
            throw new Exception("`{$amount}` is not a valid money representation");
        }

        $cents = intval($matches[1] . $matches[2]);
        $precision = strlen($matches[2]);
        $currency = $matches[3];

        return new self([
            'cents' => $cents,
            'precision' => $precision,
            'currency' => $currency,
        ]);
    }

    public function example(): void
    {
        // Check for undefined properties
        // $this->aaa;

        // Check for property immutability
        // $this->cents = 100;

        // Check for property types
        // needAnInteger($this->currency);
    }
}
