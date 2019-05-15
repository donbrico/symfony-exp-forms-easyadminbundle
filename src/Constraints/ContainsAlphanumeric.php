<?php

namespace App\Constraints;

use Doctrine\Common\Annotations\Annotation;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsAlphanumeric extends Constraint
{
    public $message = 'The string "{{ string }}" contains an illegal character: it can only contain letters or numbers.';

    public function validatedBy()
    {
        return ContainsAlphaNumericValidator::class;
    }
}
