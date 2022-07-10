<?php

namespace App\Data;

use App\Entity\Category;
use phpDocumentor\Reflection\Types\Integer;

class SearchData
{
    /**
     * @var int
     */
    public $page =1;

    /**
     * @var string
     */
    public ?string $q = '';

    /**
     * @var null|int
     */
    public ?int $minPlayer;

    /**
     * @var null|int
     */
    public ?int $maxPlayer;

    /**
     * @var Category[]
     */
    public array $category = [];

    //TODO: Ajouter la durée de jeu d'une partie au filtre

    /**
     * @var null|int
     */
    public ?int $minPlayingTime;

    /**
     * @var null|int
     */
    public ?int $maxPlayingTime;


}