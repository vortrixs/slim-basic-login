<?php

namespace SBL\Library;

abstract class AbstractModel
{
    /**
     * @var Crud
     */
    protected $crud;

    /**
     * AbstractModel constructor.
     *
     * @param Crud $crud
     */
    public function __construct(Crud $crud)
    {
        $this->crud = $crud;
    }
}
