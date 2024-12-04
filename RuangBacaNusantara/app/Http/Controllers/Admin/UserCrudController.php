<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
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
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('user', 'users');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::setFromDb(); // set columns from db columns.

        // CRUD::addColumn(['name' => 'name', 'label' => 'Name']);
        // CRUD::addColumn(['name' => 'email', 'label' => 'Email']);
        // CRUD::addColumn(['name' => 'role', 'label' => 'Role', 'type' => 'select_multiple', 'entity' => 'role', 'attribute' => 'name']);
        CRUD::column('name');
        CRUD::column('email');

        // Menambahkan kolom role yang menampilkan nama role
        CRUD::addColumn([
            'name' => 'role_id',
            'label' => 'Role',
            'type' => 'select',
            'entity' => 'role',
            'attribute' => 'name',
            'model' => \Spatie\Permission\Models\Role::class,
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(UserRequest::class);
        // CRUD::setFromDb();


         CRUD::field('name');
        CRUD::field('email');
        CRUD::field('password');

        // Field gender dengan radio button
        CRUD::addField([
            'name' => 'gender',
            'label' => 'Gender',
            'type' => 'radio',
            'options' => [
                'male' => 'Male',
                'female' => 'Female',
            ],
        ]);
        
        // Menambahkan field address
    CRUD::addField([
        'name' => 'address',
        'label' => 'Address',
        'type' => 'textarea', // Gunakan textarea jika ingin alamat yang panjang
    ]);

    // Menambahkan field mobile number
    CRUD::addField([
        'name' => 'mobileNumber',
        'label' => 'Mobile Number',
        'type' => 'text', // Gunakan text jika hanya nomor yang dimasukkan
    ]);

        // Field role untuk memilih role pengguna
        CRUD::addField([
            'name' => 'role_id',
            'label' => 'Role',
            'type' => 'select',
            'entity' => 'role',
            'attribute' => 'name',
            'model' => \Spatie\Permission\Models\Role::class,
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
