<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Service\ServiceRequest;
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
 * Class ServiceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ServiceCrudController extends CrudController
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
        $this->crud->setModel(Service::class);

        $companyId = Route::current()->parameter('company_id');
        $jobPositionId = Route::current()->parameter('job_position_id');

        $this->crud->addClause('where', 'company_id', $companyId);

        if (!empty($jobPositionId)) {
            $this->crud->addClause('whereHas', 'positions', function ($query) use ($jobPositionId) {
                $query->where('id', (int)$jobPositionId);
            });
        }

        $this->crud->setRoute(
            config('backpack.base.route_prefix')
            . '/company/'
            . $companyId
            . ($jobPositionId ? '/job_position/' . $jobPositionId : '')
            . '/service'
        );

        $this->crud->setEntityNameStrings('Услуга', 'Услуги');
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();

        $this->crud->addColumn([
            'name' => 'positions',
            'label' => 'Должности',
            'type' => 'select_multiple',
            'entity' => 'positions',
            'attribute' => 'name',
            'model' => JobPosition::class
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

        $this->crud->button('job_position')
            ->stack('line')
            ->view('crud::buttons.see_related_button')
            ->meta([
                'access' => true,
                'label' => 'Должностям',
                'icon' => 'la la-envelope',
                'class' => 'text-info',
                'url' => '/'
                    . config('backpack.base.route_prefix')
                    . '/company/'
                    . $companyId
                    . '/service/'
                    . Route::current()->parameter('id')
                    . '/job_position'
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
            'name' => 'allocated_time',
            'label' => 'Выделяемое время',
            'type' => 'time',
            'orderable' => 3,
            'sortable' => true
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
        $this->crud->setValidation(ServiceRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'label' => 'Название',
            'type' => 'text',
            'wrapper' => ['class' => 'form-group col-md-6']

        ]);

        $this->crud->addField([
            'name' => 'allocated_time',
            'label' => 'Выделяемое время',
            'type' => 'time',
            'wrapper' => ['class' => 'form-group col-md-6']
        ]);

        $this->crud->addField([
            'name' => 'positions',
            'label' => 'Должности',
            'type' => 'select_multiple',
            'model' => JobPosition::class,
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
