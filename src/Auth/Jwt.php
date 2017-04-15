<?php

namespace App\Auth;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\ValidationData;

class Jwt
{
    public function __construct(
        string $key,
        ValidationData $validation = null,
        Signer $signer = null
    ) {
        $this->key = $key;
        $this->validation = $validation ?? new ValidationData;
        $this->signer = $signer ?? new Sha256;
    }

    public function create(int $expiration, array $data = []) : Token
    {
        $issuer = $this->validation->get('iss');
        $audience = $this->validation->get('aud');
        $subject = $this->validation->get('sub');

        $token = (new Builder())
            ->setIssuer($issuer)
            ->setAudience($audience)
            ->setSubject($subject)
            ->setIssuedAt(time())
            ->setExpiration($expiration);

        foreach ($data as $key => $value) {
            $token->set($key, $value);
        }

        return $token
            ->sign($this->signer, $this->key)
            ->getToken();
    }

    public function accept(Token $token) : bool
    {
        $verified = $token->verify($this->signer, $this->key);
        $valid = $token->validate($this->validation);
        return $verified && $valid;
    }
}
