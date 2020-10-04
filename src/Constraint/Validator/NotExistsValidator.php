<?php


namespace App\Constraint\Validator;


use App\Constraint\NotExists;
use App\Service\ShortUrlService;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class NotExistsValidator extends ConstraintValidator
{
    private ShortUrlService $shortUrlService;

    /**
     * NotExistsValidator constructor.
     * @param ShortUrlService $shortUrlService
     */
    public function __construct(ShortUrlService $shortUrlService)
    {
        $this->shortUrlService = $shortUrlService;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof NotExists) {
            throw new UnexpectedTypeException($constraint, NotExists::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }
        if ($this->shortUrlService->find($value) !== null) {
            $this->context->buildViolation($constraint->message)
                ->setParameter("{{ string }}", $value)
                ->addViolation();
        }
    }
}