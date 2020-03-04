<?php

use App\TodoItem;
use Illuminate\Database\Seeder;

class TodoItemSeeder extends Seeder
{
    /**
     * Sample todo item data
     * @var array
     */
    private $todoItems = [
        ['item' => 'make model', 'done' => true],//, 'user_id' => '2', 'image' => 'public/UGs2cQmfdkCXLYrwh80paNzJZ235vW5D6q2oGGO0.jpeg'],
        ['item' => 'make migration', 'done' => true],//, 'user_id' => '2', 'image' => 'public/UGs2cQmfdkCXLYrwh80paNzJZ235vW5D6q2oGGO0.jpeg'],
        ['item' => 'make controller', 'done' => true],//, 'user_id' => '2', 'image' => 'public/UGs2cQmfdkCXLYrwh80paNzJZ235vW5D6q2oGGO0.jpeg'],
        ['item' => 'make routes', 'done' => true],//, 'user_id' => '2', 'image' => 'public/UGs2cQmfdkCXLYrwh80paNzJZ235vW5D6q2oGGO0.jpeg'],
        ['item' => 'make vue', 'done' => false],//, 'user_id' => '2', 'image' => 'public/UGs2cQmfdkCXLYrwh80paNzJZ235vW5D6q2oGGO0.jpeg'],
        ['item' => 'make vue routes', 'done' => true],//, 'user_id' => '2', 'image' => 'public/UGs2cQmfdkCXLYrwh80paNzJZ235vW5D6q2oGGO0.jpeg'],
        ['item' => 'make seeder', 'done' => false],//, 'user_id' => '1', 'image' => 'public/sC7kL9B63UJvFAjB9ypUqVgAwqoWAubzP0vvENat.jpeg'],
        ['item' => 'smell the roses!', 'done' => false]//, 'user_id' => '1', 'image' => 'public/6VHs7w5Jec2CD6IZspUS19gj89zO5GEN32IDgLp5.jpeg'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->todoItems as $todoItem) {
            TodoItem::firstOrCreate([
              'item' => $todoItem['item'],
              'done' => $todoItem['done']
            //   'user_id' => $todoItem['user_id'], 
            //   'image' => $todoItem['image']
            ]);
          }
    }
}
