<?php

namespace App\Infrastructures\Social\Normalizer;

use League\OAuth2\Client\Provider\FacebookUser;
use Normalizer;

class FacebookNormalizer extends Normalizer
{
    /**
     * @param FacebookUser $object
     */
    public static function normalize($object, string $format = null, array $context = []): array
    {
        return [
            'email' => $object->getEmail(),
            'facebook_id' => $object->getId(),
            'type' => 'Facebook',
            'username' => $object->getName(),
        ];
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof FacebookUser;
    }
}
