<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
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
use Widget;

/**
 * Class EmployeeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class EmployeeCrudController extends CrudController
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
        CRUD::setModel(Employee::class);

        $personId = Route::current()->parameter('person_id');
        CRUD::addClause('where', 'staff_member_id', $personId);

        $companyId = Route::current()->parameter('company_id');

        CRUD::setRoute(config('backpack.base.route_prefix') . '/company/' . $companyId . '/staff-member/' . $personId . '/employee');
        CRUD::setEntityNameStrings('Работник', 'Работники');
    }

    public function setupShowOperation()
    {
        $this->setupListOperation();

        $personId = Route::current()->parameter('person_id');
        $companyId = Route::current()->parameter('company_id');

        CRUD::button('staff-member')
            ->stack('line')
            ->view('crud::buttons.see_related_button')
            ->meta([
                'access' => true,
                'label' => 'Персоне',
                'icon' => 'la la-envelope',
                'class' => 'text-info',
                'url' => '/' . config('backpack.base.route_prefix') . '/company/' . $companyId . '/staff-member/' . $personId . '/show'
            ]);

        Widget::make([
            'type' => 'view',
            'view' => 'vendor.backpack.ui.widgets.employee_schedule'
        ])->to('after_content');
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
            'name' => 'position.name',
            'label' => 'Должность',
            'type' => 'text'
        ]);

        CRUD::addColumn([
            'name' => 'affiliate.name',
            'label' => 'Филиал',
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
        CRUD::setValidation(EmployeeRequest::class);

        CRUD::addField([
            'name' => 'job_position_id',
            'label' => 'Должность',
            'type' => 'select',
            'entity' => 'position',
            'attribute' => 'name',
            'wrapper' => ['class' => 'form-group col-md-3']
        ]);

        CRUD::addField([
            'name' => 'company_affiliate_id',
            'label' => 'Филиал',
            'type' => 'select',
            'entity' => 'affiliate',
            'attribute' => 'name',
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
        $this->setupCreateOperation();
    }

    public function store()
    {
        $personId = Route::current()->parameter('person_id');

        $this->crud->addField(['type' => 'hidden', 'name' => 'staff_member_id']);
        $this->crud->getRequest()->request->add(['staff_member_id' => $personId]);

        return $this->traitStore();
    }
}
