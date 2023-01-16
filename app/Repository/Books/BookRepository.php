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
            return Books::create([
                'title' => $form['title'],
                'sub_title' => $form['sub_title'],
                'author' => $form['author'],
                'price' => $form['price'],
            ]);
        }

        public function updateBook(int $id, array $form)
        {   
            $books = Books::whereId($id);
            
            return $books->update([
                    'title' => $form['title'],
                    'sub_title' => $form['sub_title'],
                    'author' => $form['author'],
                    'price' => $form['price'],
                ]);
        }

        public function deleteBook(int $id)
        {
            return Books::destroy($id);
        }
    }