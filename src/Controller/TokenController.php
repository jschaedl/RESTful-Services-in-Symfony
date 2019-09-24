<?php

declare(strict_types=1);

namespace App\Controller;

use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/token", methods={"POST"}, format="json")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class TokenController extends ApiController
{
    private $jwtEncoder;

    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        JWTEncoderInterface $jwtEncoder
    ) {
        parent::__construct($serializer, $validator);

        $this->jwtEncoder = $jwtEncoder;
    }

    public function __invoke(Request $request)
    {
        $token = $this->jwtEncoder->encode([
            'username' => $request->getUser(),
        ]);

        return $this->createApiResponse($request, ['token' => $token], Response::HTTP_OK);
    }
}
