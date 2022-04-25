<?php
namespace App\Form\DataTransformer;

use App\Entity\Envio;
use App\Entity\EnvioContenedor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class EnvioToNumberTransformer implements DataTransformerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Transforms an object (envio) to a string (number).
     *
     * @param  Envio|null $envio
     */
    public function transform($envio): int
    {
        if (null === $envio) {
            return 0;
        }

        return $envio->getId();
    }

    /**
     * Transforms a int (number) to an object (envio).
     *
     * @param  int $envioNumber
     * @throws TransformationFailedException if object (envio) is not found.
     */
    public function reverseTransform($envioNumber): ?Envio
    {
        // no envio number? It's optional, so that's ok
        if (!$envioNumber) {
            return null ;
        }

        $envio = $this->entityManager
            ->getRepository(Envio::class)->find($envioNumber)
        ;
        $ec= new EnvioContenedor();
        $ec->setEnvio($envio);

        if (null === $envio) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'An envio with number "%s" does not exist!',
                $ec
            ));
        }

        return $envio;
    }
}