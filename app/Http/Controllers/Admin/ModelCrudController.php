<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ModelRequest;
use App\Models\CarModel;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ModelCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ModelCrudController extends CrudController
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
        CRUD::setModel(CarModel::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/model');
        CRUD::setEntityNameStrings('модель', 'Справочник моделей');

    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([
                'label' => 'Название модели',
                'name' => 'name',
                'type' => 'string'
            ]
        );

    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ModelRequest::class);
        $this->crud->addFields([
            // This is the field im trying to get working
            [
                'label' => 'Модель',
                'type' => 'text',
                'name' => 'name',
                'model' => 'App\Models\CarModel',
            ],
            [
                'label' => 'Марка',
                'type' => 'select',
                'name' => 'brand_id',
                'entity' => 'brand',
                'attribute' => 'name',
                'model' => 'App\Models\Brand',
            ],

        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
