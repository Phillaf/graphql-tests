<?php

namespace App\Auth;

use Cake\Core\Configure;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Token;

class Jwt
{
    public static function create(array $data = []) : Token
    {
        $token = (new Builder())
            ->setIssuer(Configure::read('jwt.issuer'))
            ->setAudience(Configure::read('jwt.audience'))
            ->setNotBefore(time())
            ->setSubject(Configure::read('jwt.subject'))
            ->setId(base64_encode(random_bytes(Configure::read('jwt.idLength'))), true)
            ->setIssuedAt(time())
            ->setExpiration(time() + Configure::read('jwt.expiration'));

        foreach ($data as $key => $value) {
            $token->set($key, $value);
        }

        return $token
            ->sign(new Sha256, Configure::read('jwt.key'))
            ->getToken();
    }

    public static function verify(Token $token) : bool
    {
        return $token->verify(new Sha256, Configure::read('jwt.key'));
    }
}
