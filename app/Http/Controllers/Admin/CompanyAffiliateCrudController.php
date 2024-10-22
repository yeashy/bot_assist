<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CompanyAffiliate\CompanyAffiliateCreateRequest;
use App\Http\Requests\Admin\CompanyAffiliate\CompanyAffiliateUpdateRequest;
use App\Models\CompanyAffiliate;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Route;

/**
 * Class CompanyAffiliateCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CompanyAffiliateCrudController extends CrudController
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
        $this->crud->setModel(CompanyAffiliate::class);

        $companyId = Route::current()->parameter('company_id');
        $this->crud->addClause('where', 'company_id', $companyId);

        $this->crud->setRoute(config('backpack.base.route_prefix') . '/company/' . $companyId . '/company-affiliate');
        $this->crud->setEntityNameStrings('Филиал', 'Филиалы');
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();

        $this->crud->addColumn([
            'name' => 'address',
            'label' => 'Адрес',
            'type' => 'text'
        ]);

        $this->crud->addColumn([
            'name' => 'coordinates',
            'label' => 'Координаты',
            'type' => 'text'
        ]);

        $this->crud->addColumn([
            'name' => 'is_main',
            'label' => 'Главное здание',
            'type' => 'boolean'
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

        $this->crud->button('employee')
            ->stack('line')
            ->view('crud::buttons.see_related_button')
            ->meta([
                'access' => true,
                'label' => 'Должностям',
                'icon' => 'la la-envelope',
                'class' => 'text-info'
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
            'name' => 'name',
            'label' => 'Название',
            'type' => 'text',
            'priority' => 1,
            'orderable' => true,
            'searchable' => true,
        ]);

        $this->crud->addColumn([
            'name' => 'phone_number',
            'label' => 'Телефон',
            'type' => 'text',
            'priority' => 3,
            'orderable' => true
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
        $this->crud->setValidation(CompanyAffiliateCreateRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'label' => 'Название',
            'type' => 'text',
            'wrapper' => ['class' => 'from-group col-md-6'],
        ]);

        $this->crud->addField([
            'name' => 'phone_number',
            'label' => 'Телефон',
            'type' => 'text',
            'wrapper' => ['class' => 'from-group col-md-6'],
        ]);

        $this->crud->addField([
            'name' => 'address',
            'label' => 'Адрес',
            'type' => 'address-input',
            'wrapper' => ['class' => 'from-group col-md-6'],
        ]);

        $this->crud->addField([
            'name' => 'latitude',
            'label' => 'Широта',
            'type' => 'hidden',
        ]);

        $this->crud->addField([
            'name' => 'longitude',
            'label' => 'Долгота',
            'type' => 'hidden',
        ]);

        $this->crud->addField([
            'name' => 'is_main',
            'label' => 'Главное здание',
            'type' => 'boolean'
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
        $this->crud->setValidation(CompanyAffiliateUpdateRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'label' => 'Название',
            'type' => 'text',
            'wrapper' => ['class' => 'from-group col-md-6'],
        ]);

        $this->crud->addField([
            'name' => 'phone_number',
            'label' => 'Телефон',
            'type' => 'text',
            'wrapper' => ['class' => 'from-group col-md-6'],
        ]);

        $this->crud->addField([
            'name' => 'address',
            'label' => 'Адрес',
            'type' => 'address-input',
            'wrapper' => ['class' => 'from-group col-md-6'],
        ]);

        $this->crud->addField([
            'name' => 'latitude',
            'label' => 'Широта',
            'type' => 'hidden',
        ]);

        $this->crud->addField([
            'name' => 'longitude',
            'label' => 'Долгота',
            'type' => 'hidden',
        ]);

        $this->crud->addField([
            'name' => 'is_main',
            'label' => 'Главное здание',
            'type' => 'boolean'
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
