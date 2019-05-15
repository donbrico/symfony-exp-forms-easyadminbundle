<?php

namespace App\Models;

use Symfony\Component\Validator\Constraints as Assert;

class Comment
{
    /**
     * @Assert\NotBlank()
     */
    public $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Email
     */
    public $email;

    /**
     * @Assert\NotBlank()
     */
    public $text;
}
