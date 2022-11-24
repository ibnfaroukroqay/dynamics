<?php

namespace Ibnfaroukroqay\Dynamics\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ibnfaroukroqay\Dynamics\Dynamics
 */
class Dynamics extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Ibnfaroukroqay\Dynamics\Dynamics::class;
    }
}
