<?php

declare(strict_types=1);

namespace App\Serializer;

use App\Entity\Attendee;
use App\Entity\Workshop;
use Symfony\Component\Serializer\Exception\CircularReferenceException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class WorkshopNormalizer implements ContextAwareNormalizerInterface
{
    private $normalizer;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    public function supportsNormalization($data, $format = null, array $context = [])
    {
        return $data instanceof Workshop;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $customContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                if ($object instanceof Attendee) {
                    return $object->getFirstname() . ' ' . $object->getLastname();
                }

                if ($object instanceof Workshop) {
                    return $object->getTitle();
                }
                
                return (string) $object;
            }
        ];

        $context = array_merge($context, $customContext);

        $data = $this->normalizer->normalize($object, $format, $context);

        return $data;
    }
}
