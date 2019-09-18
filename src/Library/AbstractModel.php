<?php

namespace SBL\Library;

abstract class AbstractModel
{
    protected $crud;

    public function __construct(Crud $crud)
    {
        $this->crud = $crud;
    }
}
