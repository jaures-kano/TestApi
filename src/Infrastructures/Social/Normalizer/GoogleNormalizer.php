<?php

namespace App\Infrastructures\Social\Normalizer;

use League\OAuth2\Client\Provider\GoogleUser;
use Normalizer;

class GoogleNormalizer extends Normalizer
{
    /**
     * @param GoogleUser $object
     */
    public static function normalize($object, string $format = null, array $context = []): array
    {
        return [
            'email' => $object->getEmail(),
            'google_id' => $object->getId(),
            'type' => 'Google',
            'username' => $object->getName(),
        ];
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof GoogleUser;
    }
}
