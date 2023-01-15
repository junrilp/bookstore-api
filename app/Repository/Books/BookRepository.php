<?php
    namespace App\Repository\Books;

use App\Models\Books;

    class BookRepository implements BookInterface
    {
        public function getList()
        {
            return Books::all();
        }

        public function getListById(int $id)
        {
            return Books::find($id);
        }

        public function addBook(array $form)
        {
            $imageName = NULL;

            if (isset($form['image'])) {
                $imageName = time().'.'.$form['image']->extension();
                $form['image']->move(public_path('images'), $imageName);
            }
            
            return Books::create([
                'title' => $form['title'],
                'sub_title' => $form['sub_title'],
                'author' => $form['author'],
                'price' => $form['price'],
                'image' => $imageName,
            ]);
        }

        public function updateBook(int $id, array $form)
        {   
            $books = Books::whereId($id);
            $imageName = $books->select('image')->first()->image;
            
            if (isset($form['image'])) {
                $imageName = time().'.'.$form['image']->extension();
                $form['image']->move(public_path('images'), $imageName);
            }
            return $books->update([
                    'title' => $form['title'],
                    'sub_title' => $form['sub_title'],
                    'author' => $form['author'],
                    'price' => $form['price'],
                    'image' => $imageName,
                ]);
        }

        public function deleteBook(int $id)
        {
            return Books::destroy($id);
        }
    }