<?php

namespace App\Transformers;

class Transformer {
    /**
     * Transform a todo item
     * @param $todoItem
     * @return mixed
     */
	public function transform($todoItem) {
        return [
            'id' => $todoItem->id,
            'item' => $todoItem->item,
            'done' => $todoItem->done
            // 'image' => $image->image
        ];
    }
}