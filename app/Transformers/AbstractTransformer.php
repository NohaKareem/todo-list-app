<?php
    namespace App\Transformers;

    abstract class AbstractTransformer {

        /**
         * Transform an item
         * @param $item
         * @return mixed
         */
        abstract public function transform($item);
    }