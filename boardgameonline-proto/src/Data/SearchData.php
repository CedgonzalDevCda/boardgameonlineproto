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
     * @var null|integer
     */
    public ?integer $minPlayer;

    /**
     * @var null|integer
     */
    public ?integer $maxPlayer;

    /**
     * @var Category[]
     */
    public array $category = [];


}