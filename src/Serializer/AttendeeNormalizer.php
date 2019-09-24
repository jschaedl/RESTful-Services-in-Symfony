<?php

declare(strict_types=1);

namespace App\Serializer;

use App\Entity\Attendee;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Exception\CircularReferenceException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class AttendeeNormalizer implements ContextAwareNormalizerInterface
{
    private $normalizer;
    private $urlGenerator;

    public function __construct(ObjectNormalizer $normalizer, UrlGeneratorInterface $urlGenerator)
    {
        $this->normalizer = $normalizer;
        $this->urlGenerator = $urlGenerator;
    }

    public function supportsNormalization($data, $format = null, array $context = [])
    {
        return $data instanceof Attendee;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $customContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getFirstname() . ' ' . $object->getLastname();
            }
        ];

        $context = array_merge($context, $customContext);

        $data = $this->normalizer->normalize($object, $format, $context);

        if (\is_array($data)) {
            $data['_links']['self']['href'] = $this->urlGenerator->generate('read_attendee', [
                'id' => $object->getId(),
            ], UrlGeneratorInterface::ABSOLUTE_URL);

            $data['_links']['collection']['href'] = $this->urlGenerator->generate('list_attendees', [], UrlGeneratorInterface::ABSOLUTE_URL);
        }

        return $data;
    }
}
