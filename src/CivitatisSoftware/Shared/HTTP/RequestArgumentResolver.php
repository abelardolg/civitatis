<?php


namespace App\CivitatisSoftware\Shared\HTTP;


use App\CivitatisSoftware\Shared\DTOs\RequestDTO;
use Generator;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class RequestArgumentResolver implements ArgumentValueResolverInterface
{

    /**
     * @var ValidatorInterface
     */
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        try {
            $reflectionClass = new ReflectionClass($argument->getType());
            return $reflectionClass->implementsInterface(RequestDTO::class);
        } catch (ReflectionException $e) {
            return false;
        }

    }

    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        $class = $argument->getType();

        $dto = new $class($request);
        $errors = $this->validator->validate($dto);

//        if (0 < count($errors)) {
//            throw new BadRequestException((string) $errors);
//        }

        yield $dto;
    }
}
