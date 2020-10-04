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

    public $message = "The alias '{{ string }}' is already exists in our system. Please choose a different alias or let our system generate one.";

     public function validatedBy() :string
    {
        return NotExistsValidator::class;
    }
}