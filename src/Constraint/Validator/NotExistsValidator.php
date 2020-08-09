<?php


namespace App\Constraint\Validator;


use App\Constraint\NotExists;
use App\Repository\ShortUrlRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class NotExistsValidator extends ConstraintValidator
{
    private ShortUrlRepository $repository;

    /**
     * NotExistsValidator constructor.
     * @param ShortUrlRepository $repository
     */
    public function __construct(ShortUrlRepository $repository)
    {
        $this->repository = $repository;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof NotExists) {
            throw new UnexpectedTypeException($constraint, NotExists::class);
        }
    }
}