<?php

namespace App\Domain\ValueObject\Post;

enum Status: string
{
    case Draft = 'draft';
    case Published = 'published';
    case Edited = 'edited';
}
