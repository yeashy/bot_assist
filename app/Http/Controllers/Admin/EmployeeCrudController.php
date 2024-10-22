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
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;

/**
 * Class EmployeeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class EmployeeCrudController extends CrudController
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
        $this->crud->setModel(Employee::class);

        $personId = Route::current()->parameter('person_id');
        $companyAffiliateId = Route::current()->parameter('company_affiliate_id');

        $parentRelation = 'staff-member';

        if ($personId) {
            $this->crud->addClause('where', 'staff_member_id', $personId);
        } elseif ($companyAffiliateId) {
            $this->crud->addClause('where', 'company_affiliate_id', $companyAffiliateId);
            $parentRelation = 'company-affiliate';
        }

        $companyId = Route::current()->parameter('company_id');

        $this->crud->setRoute(
            config('backpack.base.route_prefix')
            . '/company/' . $companyId
            . '/' . $parentRelation . '/'
            . ($personId ?? $companyAffiliateId)
            . '/employee'
        );

        $this->crud->setEntityNameStrings('Работник', 'Работники');
    }

    public function setupShowOperation()
    {
        $this->setupListOperation();

        $personId = Route::current()->parameter('person_id');
        $companyId = Route::current()->parameter('company_id');

        $this->crud->button('staff-member')
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
        // Добавляем JOIN заранее, чтобы поля из таблицы 'staff_members' были доступны
        $this->crud->query->join(
            'staff_members',
            'staff_members.id',
            '=',
            'employees.staff_member_id'
        );

        $this->crud->query->join(
            'job_positions',
            'job_positions.id',
            '=',
            'employees.job_position_id'
        );

        // Добавляем SELECT, чтобы эти поля были доступны для поиска и отображения
        $this->crud->query->select(
            'employees.*',
            'staff_members.name',
            'staff_members.surname',
            'staff_members.patronymic',
            'job_positions.name'
        );

        $this->crud->addColumn([
            'name' => 'id',
            'label' => 'ID',
            'type' => 'number',
            'priority' => 2,
            'orderable' => true,
            'searchable' => true
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
                        'concat(staff_members.surname, " ", staff_members.name, " ", staff_members.patronymic) like "%' . $searchTerm . '%"'
                    )->orWhereRaw(
                        'concat(staff_members.name, " ", staff_members.surname, " ", staff_members.patronymic) like "%' . $searchTerm . '%"'
                    );
            }
        ]);

        $this->crud->addColumn([
            'name' => 'position.name',
            'label' => 'Должность',
            'type' => 'text',
            'priority' => 3,
            'orderable' => true,
            'searchable' => true,
            'searchLogic' => function (Builder $query, $column, $searchTerm) {
                $query
                    ->orWhere(
                        'job_positions.name',
                        'like',
                        '%' . $searchTerm . '%'
                    );
            }
        ]);

        $this->crud->addColumn([
            'name' => 'affiliate.name',
            'label' => 'Филиал',
            'type' => 'text',
            'priority' => 4,
            'orderable' => true,
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
        $this->crud->setValidation(EmployeeRequest::class);

        $this->crud->addField([
            'name' => 'job_position_id',
            'label' => 'Должность',
            'type' => 'select',
            'entity' => 'position',
            'attribute' => 'name',
            'wrapper' => ['class' => 'form-group col-md-3']
        ]);

        $this->crud->addField([
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
