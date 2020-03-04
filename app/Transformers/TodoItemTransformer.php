<?php
    namespace App\Transformers;
    // use App\Transformers\Transformer;

    class TodoItemTransformer extends AbstractTransformer {
        /** 
         * Transform the todo item
         * @paraam $todoItem
         * @return array
         */
        public function transform($todoItem){
            return [
                'id' => $todoItem->id,
                'item' => $todoItem->item, 
                'done' => $todoItem->done
                // 'image' => $todoItem->image
            ];
        }
    }