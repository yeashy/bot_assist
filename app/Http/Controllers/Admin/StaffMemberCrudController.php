<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StaffMemberRequest;
use App\Models\Gender;
use App\Models\StaffMember;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Route;

/**
 * Class StaffMemberCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class StaffMemberCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation { store as traitStore; }
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

        $companyId = Route::current()->parameter('company_id');
        CRUD::addClause('where', 'company_id', $companyId);

        CRUD::setRoute(config('backpack.base.route_prefix') . '/company/' . $companyId . '/staff-member');
        CRUD::setEntityNameStrings('Персонал', 'Персонал');
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();

        CRUD::addColumn([
            'name' => 'name',
            'label' => 'Имя',
            'type' => 'text',
        ]);

        CRUD::addColumn([
            'name' => 'surname',
            'label' => 'Фамилия',
            'type' => 'text',
        ]);

        CRUD::addColumn([
            'name' => 'patronymic',
            'label' => 'Отчество',
            'type' => 'text',
        ]);

        CRUD::addColumn([
            'name' => 'phone_number',
            'label' => 'Номер телефона',
            'type' => 'text',
        ]);

        CRUD::addColumn([
            'name' => 'date_of_birth',
            'label' => 'Дата рождения',
            'type' => 'date',
        ]);

        CRUD::addColumn([
            'name' => 'gender',
            'label' => 'Пол',
            'type' => 'select',
            'attribute' => 'name',
            'model' => Gender::class,
            'entity' => 'gender'
        ]);

        CRUD::addColumn([
            'name' => 'description',
            'label' => 'Доп. информация',
            'type' => 'textarea'
        ]);

        $companyId = Route::current()->parameter('company_id');

        CRUD::button('company')
            ->stack('line')
            ->view('crud::buttons.see_related_button')
            ->meta([
                'access' => true,
                'label' => 'Компании',
                'icon' => 'la la-envelope',
                'class' => 'text-info',
                'url' => '/' . config('backpack.base.route_prefix') . '/company/' . $companyId . '/show'
            ]);
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
            'name' => 'gender',
            'label' => 'Пол',
            'type' => 'select',
            'attribute' => 'name',
            'model' => Gender::class,
            'wrapper' => ['class' => 'form-group col-md-3']
        ]);

        CRUD::addField([
            'name' => 'photo_path',
            'label' => 'Фото',
            'type' => 'upload',
            'withFiles' => true,
            'wrapper' => ['class' => 'form-group col-md-6']
        ]);

        CRUD::addField([
            'name' => 'description',
            'label' => 'Доп. информация',
            'type' => 'textarea'
        ]);
    }

    public function store()
    {
        $companyId = Route::current()->parameter('company_id');

        $this->crud->addField(['type' => 'hidden', 'name' => 'company_id']);
        $this->crud->getRequest()->request->add(['company_id' => $companyId]);

        return $this->traitStore();
    }
}
