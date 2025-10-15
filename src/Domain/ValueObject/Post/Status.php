<?php

namespace App\Domain\ValueObject\Post;

enum Status: string
{
    case draft = 'draft';
    case published = 'published';
    case edited = 'edited';
}