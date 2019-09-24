<?php

declare(strict_types=1);

namespace App\Serializer;

use App\Entity\Attendee;
use App\Entity\Workshop;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class WorkshopNormalizer implements ContextAwareNormalizerInterface
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
            },
        ];

        $context = array_merge($context, $customContext);

        $data = $this->normalizer->normalize($object, $format, $context);

        if (\is_array($data)) {
            $data['_links']['self']['href'] = $this->urlGenerator->generate('read_workshop', [
                'id' => $object->getId(),
            ], UrlGeneratorInterface::ABSOLUTE_URL);

            $data['_links']['collection']['href'] = $this->urlGenerator->generate('list_workshops', [], UrlGeneratorInterface::ABSOLUTE_URL);
        }

        return $data;
    }
}
