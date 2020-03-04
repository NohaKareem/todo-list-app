<?php
    use App\Transformers\Transformer;
    namespace App\Transformers;

    class TodoItemTransformer extends Transformer {
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