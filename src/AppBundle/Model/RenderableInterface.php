<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 */

namespace AppBundle\Model;


interface RenderableInterface
{

    /**
     * @return string
     */
    public function render();

}