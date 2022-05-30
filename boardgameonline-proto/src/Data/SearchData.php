<?php

namespace App\Data;

use App\Entity\Category;
use phpDocumentor\Reflection\Types\Integer;

class SearchData
{
    /**
     * @var string
     */
    public ?string $q = '';

    /**
     * @var integer|null
     */
    public ?Integer $minPlayer;

    /**
     * @var integer|null
     */
    public ?Integer $maxPlayer;

    /**
     * @var Category[]
     */
    public array $category = [];


}