<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BookRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BookCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BookCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Book::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/book');
        CRUD::setEntityNameStrings('book', 'books');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::setFromDb();
        CRUD::column('title');
        CRUD::column('author');
        CRUD::column('ISBN');
        CRUD::column('publisher');
        CRUD::column('language');
        CRUD::column('year_of_publication');
        CRUD::column('category');
        CRUD::column('quantity');
        CRUD::column('image')->type('url');  // Menampilkan URL gambar sebagai link

    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(BookRequest::class);
        // CRUD::setFromDb();

        CRUD::field('title');
        CRUD::field('author');
        CRUD::field('ISBN');
        CRUD::field('publisher');
        CRUD::field('language');
        CRUD::field('year_of_publication');
        CRUD::field('description');
        CRUD::field('category');
        CRUD::field('quantity');

        // Menggunakan 'text' untuk link gambar
        CRUD::addField([
            'name' => 'image',
            'label' => 'Book Image Link',  // Label yang akan muncul di form
            'type' => 'text',  // Menggunakan text untuk memasukkan link gambar
        ]);
    
    
    }
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
