<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\JobPosition\JobPositionRequest;
use App\Models\JobPosition;
use App\Models\Service;
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
 * Class JobPositionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class JobPositionCrudController extends CrudController
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
        $this->crud->setModel(JobPosition::class);

        $companyId = Route::current()->parameter('company_id');
        $serviceId = Route::current()->parameter('service_id');

        $this->crud->addClause('where', 'company_id', $companyId);

        if (!empty($serviceId)) {
            $this->crud->addClause('whereHas', 'services', function ($query) use ($serviceId) {
                $query->where('id', (int)$serviceId);
            });
        }

        $this->crud->setRoute(
            '/' .
            config('backpack.base.route_prefix')
            . '/company/' . $companyId
            . ($serviceId ? '/service/' . $serviceId : '')
            . '/job_position'
        );

        $this->crud->setEntityNameStrings('Должность', 'Должности');
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();

        $this->crud->addColumn([
            'name' => 'services',
            'label' => 'Услуги',
            'type' => 'select_multiple',
            'entity' => 'services',
            'attribute' => 'name',
            'model' => Service::class
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

        $this->crud->button('service')
            ->stack('line')
            ->view('crud::buttons.see_related_button')
            ->meta([
                'access' => true,
                'label' => 'Услугам',
                'icon' => 'la la-envelope',
                'class' => 'text-info',
                'url' => '/'
                    . config('backpack.base.route_prefix')
                    . '/company/'
                    . $companyId
                    . '/job_position/'
                    . Route::current()->parameter('id')
                    . '/service'
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
            'searchable' => true
        ]);

        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Название',
            'type' => 'text',
            'priority' => 1,
            'orderable' => true,
            'searchable' => true
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
        $this->crud->setValidation(JobPositionRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'label' => 'Название',
            'type' => 'text'
        ]);

        $this->crud->addField([
            'name' => 'services',
            'label' => 'Услуги',
            'type' => 'select_multiple',
            'model' => Service::class,
            'attribute' => 'name',
            'pivot' => true
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

    public function store()
    {
        $companyId = Route::current()->parameter('company_id');

        $this->crud->addField(['type' => 'hidden', 'name' => 'company_id']);
        $this->crud->getRequest()->request->add(['company_id' => $companyId]);

        return $this->traitStore();
    }
}
