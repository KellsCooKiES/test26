<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CarRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CarCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CarCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Car::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/car');
        CRUD::setEntityNameStrings('Автомобиль', 'Автомобили');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumns([
            [
                'label'=>'Марка',
                 'name'  => 'brand', // name of relationship method in the model
                 'type'  => 'relationship',
            ],
            [
                'label'=>'Модель',
                'name' => 'model',
                'type' => 'relationship'
            ],
            [
                'label'=>'Год выпуска',
                'name' => 'vehicle_release',
                'type' => 'date',
                'format' => 'Y'
            ],
            [
                'label'=>'Пробег, км',
                'name' => 'mileage',
                'type' => 'number'
            ],
            [
                'label'=>'Цвет',
                'name' => 'color',
                'type' => 'string'
            ],
            [
                'label'=>'Цена, рублуй',
                'name' => 'price',
                'type' => 'number'
            ],
        ]);
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CarRequest::class);

        CRUD::addFields([
            [
                'label' => 'Марка',
                'type' => 'select',
                'name' => 'brand_id',
                'entity' => 'brand',
                'attribute' => 'name',
                'model' => 'App\Models\Brand',
            ],
            [
                'label' => 'Модель',
                'type' => 'select2_grouped',
                'name' => 'model_id',
                'attribute' => 'name',
                'group_by'  => 'brand',
                'group_by_attribute' => 'name',
                'group_by_relationship_back' => 'models',
                'model' => 'App\Models\CarModel',

            ],
            [
                'label'=>'Год выпуска',
                'name' => 'vehicle_release',
                'type'  => 'number',
            ],
            [
                'label'=>'Пробег, км',
                'name' => 'mileage',
                'type' => 'number'
            ],
            [
                'label'=>'Цвет',
                'name' => 'color',
                'type' => 'text'
            ],
            [
                'label'=>'Цена, рублей',
                'name' => 'price',
                'type' => 'number'
            ],

        ]); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
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
