<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Company\CompanyCreateRequest;
use App\Http\Requests\Admin\Company\CompanyUpdateRequest;
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
    public function setup(): void
    {
        CRUD::setModel(Company::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/company');
        CRUD::setEntityNameStrings('Компания', 'Компании');
    }

    public function setupShowOperation(): void
    {
        CRUD::addColumn([
            'name' => 'name',
            'label' => 'Название',
            'type' => 'text',
            'tab' => 'Основная информация'
        ]);

        CRUD::addColumn([
            'name' => 'code_name',
            'label' => 'Кодовое имя',
            'type' => 'text',
            'tab' => 'Основная информация'
        ]);

        CRUD::addColumn([
            'name' => 'bot_token',
            'label' => 'Токен бота',
            'type' => 'text',
            'tab' => 'Основная информация'
        ]);

        CRUD::addColumn([
            'name' => 'company_type_id',
            'label' => 'Тип компании',
            'type' => 'select',
            'entity' => 'type',
            'attribute' => 'name',
            'tab' => 'Основная информация'
        ]);

        CRUD::addColumn([
            'name' => 'email',
            'label' => 'Почта',
            'type' => 'email',
            'tab' => 'Доп. информация'
        ]);

        CRUD::addColumn([
            'name' => 'phone_number',
            'label' => 'Номер телефона',
            'type' => 'text',
            'tab' => 'Доп. информация'
        ]);

        CRUD::addColumn([
            'name' => 'address',
            'label' => 'Главный адрес',
            'type' => 'text',
            'tab' => 'Доп. информация'
        ]);

        CRUD::addColumn([
            'name' => 'main_link',
            'label' => 'Ссылка на сайт',
            'type' => 'url',
            'tab' => 'Доп. информация'
        ]);

        CRUD::addColumn([
            'name' => 'logo_path',
            'label' => 'Логотип',
            'type' => 'upload',
            'withFiles' => true,
            'tab' => 'Доп. информация'
        ]);

        CRUD::button('company-affiliate')
            ->stack('line')
            ->view('crud::buttons.see_related_button')
            ->meta([
                'access' => true,
                'label' => 'Филиалам',
                'icon' => 'la la-envelope',
                'class' => 'text-info'
            ]);

        CRUD::button('client')
            ->stack('line')
            ->view('crud::buttons.see_related_button')
            ->meta([
                'access' => true,
                'label' => 'Клиентам',
                'icon' => 'la la-envelope',
                'class' => 'text-info'
            ]);

        CRUD::button('staff-member')
            ->stack('line')
            ->view('crud::buttons.see_related_button')
            ->meta([
                'access' => true,
                'label' => 'Персоналу',
                'icon' => 'la la-envelope',
                'class' => 'text-info'
            ]);

        CRUD::button('service')
            ->stack('line')
            ->view('crud::buttons.see_related_button')
            ->meta([
                'access' => true,
                'label' => 'Услугам',
                'icon' => 'la la-envelope',
                'class' => 'text-info'
            ]);

        CRUD::button('job_position')
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
    protected function setupListOperation(): void
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

        CRUD::addColumn([
            'name' => 'type.name',
            'label' => 'Тип',
            'type' => 'text'
        ]);

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
    protected function setupCreateOperation(): void
    {
        CRUD::setValidation(CompanyCreateRequest::class);

        CRUD::addField([
            'name' => 'name',
            'label' => 'Название',
            'type' => 'text',
            'wrapper' => ['class' => 'from-group col-md-6'],
            'tab' => 'Основная информация'
        ]);

        CRUD::addField([
            'name' => 'code_name',
            'label' => 'Кодовое имя',
            'type' => 'text',
            'wrapper' => ['class' => 'from-group col-md-6'],
            'tab' => 'Основная информация'
        ]);

        CRUD::addField([
            'name' => 'bot_token',
            'label' => 'Токен бота',
            'type' => 'text',
            'wrapper' => ['class' => 'from-group col-md-6'],
            'tab' => 'Основная информация'
        ]);

        CRUD::addField([
            'name' => 'company_type_id',
            'label' => 'Тип компании',
            'type' => 'select',
            'entity' => 'type',
            'attribute' => 'name',
            'wrapper' => ['class' => 'from-group col-md-6'],
            'tab' => 'Основная информация'
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
    protected function setupUpdateOperation(): void
    {
        CRUD::setValidation(CompanyUpdateRequest::class);

        CRUD::addField([
            'name' => 'email',
            'label' => 'Почта',
            'type' => 'email',
            'wrapper' => ['class' => 'from-group col-md-3'],
            'tab' => 'Информация'
        ]);

        CRUD::addField([
            'name' => 'phone_number',
            'label' => 'Номер телефона',
            'type' => 'text',
            'wrapper' => ['class' => 'from-group col-md-3'],
            'tab' => 'Информация'
        ]);

        CRUD::addField([
            'name' => 'address',
            'label' => 'Главный адрес',
            'type' => 'text',
            'wrapper' => ['class' => 'from-group col-md-3'],
            'tab' => 'Информация'
        ]);

        CRUD::addField([
            'name' => 'main_link',
            'label' => 'Ссылка на сайт',
            'type' => 'url',
            'wrapper' => ['class' => 'from-group col-md-3'],
            'tab' => 'Информация'
        ]);

        CRUD::addField([
            'name' => 'logo_path',
            'label' => 'Логотип',
            'type' => 'upload',
            'withFiles' => true,
            'wrapper' => ['class' => 'form-group col-md-6'],
            'tab' => 'Информация'
        ]);

        CRUD::addField([
            'name' => 'primary_color',
            'label' => 'Основной цвет',
            'type' => 'color',
            'wrapper' => ['class' => 'form-group col-md-3 col-6'],
            'tab' => 'Дизайн'
        ]);

        CRUD::addField([
            'name' => 'secondary_color',
            'label' => 'Вторичный цвет',
            'type' => 'color',
            'wrapper' => ['class' => 'form-group col-md-3 col-6'],
            'tab' => 'Дизайн'
        ]);

        CRUD::addField([
            'name' => 'accent_color',
            'label' => 'Цвет акцента',
            'type' => 'color',
            'wrapper' => ['class' => 'form-group col-md-3 col-6'],
            'tab' => 'Дизайн'
        ]);

        CRUD::addField([
            'name' => 'background_color',
            'label' => 'Цвет фона',
            'type' => 'color',
            'wrapper' => ['class' => 'form-group col-md-3 col-6'],
            'tab' => 'Дизайн'
        ]);
    }
}
