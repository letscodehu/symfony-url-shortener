<?php
declare(strict_types=1);

namespace App\Constraint;


use App\Constraint\Validator\NotExistsValidator;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotExists extends Constraint
{

 public function validatedBy() :string
{
    return NotExistsValidator::class;
}
}