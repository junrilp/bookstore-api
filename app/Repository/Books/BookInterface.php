<?php

namespace App\Repository\Books;

interface BookInterface 
{
    public function getList();

    public function getListById(int $id);

    public function addBook(array $form);

    public function updateBook(int $id, array $form);
    
    public function deleteBook(int $id);
}