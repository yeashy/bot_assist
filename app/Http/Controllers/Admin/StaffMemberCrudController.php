<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StaffMemberRequest;
use App\Models\StaffMember;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class StaffMemberCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class StaffMemberCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(StaffMember::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/staff-member');
        CRUD::setEntityNameStrings('Персонал', 'Персонал');
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
            'name' => 'id',
            'label' => 'ID',
            'type' => 'number'
        ]);

        CRUD::addColumn([
            'name' => 'full_name',
            'label' => 'Полное имя',
            'type' => 'text'
        ]);

        CRUD::addColumn([
            'name' => 'company.name',
            'label' => 'Компания',
            'type' => 'string'
        ]);

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
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
        CRUD::setValidation(StaffMemberRequest::class);

        CRUD::addField([
            'name' => 'name',
            'label' => 'Имя',
            'type' => 'text',
            'wrapper' => ['class' => 'form-group col-md-4']
        ]);

        CRUD::addField([
            'name' => 'surname',
            'label' => 'Фамилия',
            'type' => 'text',
            'wrapper' => ['class' => 'form-group col-md-4']
        ]);

        CRUD::addField([
            'name' => 'patronymic',
            'label' => 'Отчество',
            'type' => 'text',
            'wrapper' => ['class' => 'form-group col-md-4']
        ]);

        CRUD::addField([
            'name' => 'phone_number',
            'label' => 'Номер телефона',
            'type' => 'text',
            'wrapper' => ['class' => 'form-group col-md-3']
        ]);

        CRUD::addField([
            'name' => 'date_of_birth',
            'label' => 'Дата рождения',
            'type' => 'date',
            'wrapper' => ['class' => 'form-group col-md-3']
        ]);

        CRUD::addField([
            'name' => 'photo_path',
            'label' => 'Фото',
            'type' => 'text',
            'wrapper' => ['class' => 'form-group col-md-3']
        ]);

        CRUD::addField([
            'name' => 'company_id',
            'label' => 'Компания',
            'type' => 'select',
            'entity' => 'company',
            'attribute' => 'name',
            'wrapper' => ['class' => 'form-group col-md-3']
        ]);

        CRUD::addField([
            'name' => 'description',
            'label' => 'Доп. информация',
            'type' => 'text'
        ]);

        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
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
