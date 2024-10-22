<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Client\ClientCreateRequest;
use App\Http\Requests\Admin\Client\ClientUpdateRequest;
use App\Models\Client;
use App\Models\Gender;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;

/**
 * Class ClientCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ClientCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation {
        store as traitStore;
    }
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
        $this->crud->setModel(Client::class);

        $companyId = Route::current()->parameter('company_id');
        $this->crud->addClause('where', 'company_id', $companyId);

        $this->crud->setRoute(config('backpack.base.route_prefix') . '/company/' . $companyId . '/client');
        $this->crud->setEntityNameStrings('Клиент', 'Клиенты');
    }

    protected function setupShowOperation()
    {
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Имя',
            'type' => 'text',
        ]);

        $this->crud->addColumn([
            'name' => 'surname',
            'label' => 'Фамилия',
            'type' => 'text',
        ]);

        $this->crud->addColumn([
            'name' => 'patronymic',
            'label' => 'Отчество',
            'type' => 'text',
        ]);

        $this->crud->addColumn([
            'name' => 'phone_number',
            'label' => 'Номер телефона',
            'type' => 'text',
        ]);

        $this->crud->addColumn([
            'name' => 'address',
            'label' => 'Адрес проживания',
            'type' => 'text',
        ]);

        $this->crud->addColumn([
            'name' => 'date_of_birth',
            'label' => 'Дата рождения',
            'type' => 'date',
        ]);

        $this->crud->addColumn([
            'name' => 'description',
            'label' => 'Доп. информация',
            'type' => 'textarea'
        ]);

        $companyId = Route::current()->parameter('company_id');

        $this->crud->button('company')
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
        $this->crud->addColumn([
            'name' => 'id',
            'label' => 'ID',
            'type' => 'number',
            'priority' => 2,
            'orderable' => true,
            'searchable' => true,
        ]);

        $this->crud->addColumn([
            'name' => 'full_name',
            'label' => 'Полное имя',
            'type' => 'text',
            'priority' => 1,
            'orderable' => true,
            'searchable' => true,
            'searchLogic' => function (Builder $query, $column, $searchTerm) {
                $query
                    ->orWhereRaw(
                        'concat(surname, " ", name, " ", patronymic) like "%' . $searchTerm . '%"',
                    )->orWhereRaw(
                        'concat(name, " ", surname, " ", patronymic) like "%' . $searchTerm . '%"'
                    );
            }
        ]);

        $this->crud->addColumn([
            'name' => 'phone_number',
            'label' => 'Номер телефона',
            'type' => 'string',
            'priority' => 3,
            'orderable' => true,
            'searchable' => true,
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
        $this->crud->setValidation(ClientCreateRequest::class);

        $this->crud->removeSaveActions([
            'save_and_back',
            'save_and_new',
            'save_and_preview'
        ]);

        $this->crud->addField([
            'name' => 'surname',
            'label' => 'Фамилия',
            'type' => 'text',
            'wrapper' => ['class' => 'form-group col-md-3']
        ]);

        $this->crud->addField([
            'name' => 'name',
            'label' => 'Имя',
            'type' => 'text',
            'wrapper' => ['class' => 'form-group col-md-3']
        ]);

        $this->crud->addField([
            'name' => 'patronymic',
            'label' => 'Отчество',
            'type' => 'text',
            'wrapper' => ['class' => 'form-group col-md-3']
        ]);

        $this->crud->addField([
            'name' => 'user_phone_number',
            'label' => 'Номер телефона',
            'type' => 'text',
            'wrapper' => ['class' => 'form-group col-md-3']
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
        $this->crud->setValidation(ClientUpdateRequest::class);

        $this->crud->addField([
            'name' => 'surname',
            'label' => 'Фамилия',
            'type' => 'text',
            'wrapper' => ['class' => 'form-group col-md-4']
        ]);

        $this->crud->addField([
            'name' => 'name',
            'label' => 'Имя',
            'type' => 'text',
            'wrapper' => ['class' => 'form-group col-md-4']
        ]);

        $this->crud->addField([
            'name' => 'patronymic',
            'label' => 'Отчество',
            'type' => 'text',
            'wrapper' => ['class' => 'form-group col-md-4']
        ]);

        $this->crud->addField([
            'name' => 'phone_number',
            'label' => 'Номер телефона',
            'type' => 'text',
            'wrapper' => ['class' => 'form-group col-md-3']
        ]);

        $this->crud->addField([
            'name' => 'address',
            'label' => 'Адрес проживания',
            'type' => 'text',
            'wrapper' => ['class' => 'form-group col-md-3']
        ]);

        $this->crud->addField([
            'name' => 'date_of_birth',
            'label' => 'Дата рождения',
            'type' => 'date',
            'wrapper' => ['class' => 'form-group col-md-3']
        ]);

        $this->crud->addField([
            'name' => 'gender',
            'label' => 'Пол',
            'type' => 'select',
            'attribute' => 'name',
            'model' => Gender::class,
            'wrapper' => ['class' => 'form-group col-md-3'],
            'allows_null' => false,
        ]);

        $this->crud->addField([
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
