<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CompanyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CompanyCrudController extends CrudController
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
        CRUD::setModel(Company::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/company');
        CRUD::setEntityNameStrings('company', 'companies');
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
            'name' => 'name',
            'label' => 'Название',
            'type' => 'text'
        ]);
//
//        CRUD::addColumn([
//            'name'      => 'type_name',
//            'label'     => 'Тип',
//            'type'      => 'text'
//        ]);

        CRUD::addColumn([
            'name' => 'created_at',
            'label' => 'Дата создания',
            'type' => 'text',
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
        CRUD::setValidation(CompanyRequest::class);

        CRUD::addField([
            'name' => 'name',
            'label' => 'Название',
            'type' => 'text',
            'wrapper' => ['class' => 'from-group col-md-6']
        ]);

        CRUD::addField([
            'name' => 'code_name',
            'label' => 'Кодовое имя',
            'type' => 'text',
            'wrapper' => ['class' => 'from-group col-md-6']
        ]);

        CRUD::addField([
            'name' => 'bot_token',
            'label' => 'Токен бота',
            'type' => 'text',
            'wrapper' => ['class' => 'from-group col-md-6']
        ]);

        CRUD::addField([
            'name' => 'company_type_id',
            'label' => 'Тип компании',
            'type' => 'select',
            'entity' => 'type',
            'attribute' => 'name',
            'wrapper' => ['class' => 'from-group col-md-6']
        ]);

//        CRUD::addField([
//            'name' => 'primaryColor',
//            'label' => 'Главный цвет',
//            'type' => 'color',
//            'wrapper' => ['class' => 'form-group col-md-3'],
//        ]);

//        CRUD::addField([
//            'name' => 'design.secondary_color',
//            'label' => 'Побочный цвет',
//            'type' => 'color',
//            'wrapper' => ['class' => 'form-group col-md-3']
//        ]);
//
//        CRUD::addField([
//            'name' => 'design.font_color',
//            'label' => 'Цвет шрифта',
//            'type' => 'color',
//            'wrapper' => ['class' => 'form-group col-md-3']
//        ]);
//
//        CRUD::addField([
//            'name' => 'design.font',
//            'label' => 'Шрифт',
//            'type' => 'text',
//            'wrapper' => ['class' => 'form-group col-md-3']
//        ]);
//
//        CRUD::addField([
//            'name' => 'info.email',
//            'label' => 'Почта',
//            'type' => 'email',
//            'wrapper' => ['class' => 'from-group col-md-3']
//        ]);
//
//        CRUD::addField([
//            'name' => 'info.phone_number',
//            'label' => 'Номер телефона',
//            'type' => 'text',
//            'wrapper' => ['class' => 'from-group col-md-3']
//        ]);
//
//        CRUD::addField([
//            'name' => 'info.address',
//            'label' => 'Главный адрес',
//            'type' => 'text',
//            'wrapper' => ['class' => 'from-group col-md-3']
//        ]);
//
//        CRUD::addField([
//            'name' => 'info.main_link',
//            'label' => 'Ссылка на сайт',
//            'type' => 'url',
//            'wrapper' => ['class' => 'from-group col-md-3'],
//        ]);
//
//        CRUD::addField([
//            'name' => 'info.logo_path',
//            'label' => 'Логотип',
//            'type' => 'upload',
//            'withFiles' => true
//        ]);

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