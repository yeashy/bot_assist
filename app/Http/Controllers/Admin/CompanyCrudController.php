<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\Font;
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
        CRUD::setEntityNameStrings('Компания', 'Компании');
    }

    public function setupShowOperation()
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
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CompanyRequest::class);

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

        CRUD::addField([
            'name' => 'background_color',
            'label' => 'Цвет основного фона',
            'type' => 'color',
            'wrapper' => ['class' => 'form-group col-md-3 col-6'],
            'tab' => 'Дизайн'
        ]);

        CRUD::addField([
            'name' => 'block_background_color',
            'label' => 'Цвет фона блоков',
            'type' => 'color',
            'wrapper' => ['class' => 'form-group col-md-3 col-6'],
            'tab' => 'Дизайн'
        ]);

        CRUD::addField([
            'name' => 'button_background_color',
            'label' => 'Цвет фона кнопок',
            'type' => 'color',
            'wrapper' => ['class' => 'form-group col-md-2 col-6'],
            'tab' => 'Дизайн'
        ]);

        CRUD::addField([
            'name' => 'main_background_color',
            'label' => 'Цвет фона глав.',
            'type' => 'color',
            'wrapper' => ['class' => 'form-group col-md-2 col-6'],
            'tab' => 'Дизайн'
        ]);

        CRUD::addField([
            'name' => 'additional_background_color',
            'label' => 'Цвет фона доп.',
            'type' => 'color',
            'wrapper' => ['class' => 'form-group col-md-2 col-6'],
            'tab' => 'Дизайн'
        ]);

        CRUD::addField([
            'name' => 'text_color',
            'label' => 'Цвет основного текста',
            'type' => 'color',
            'wrapper' => ['class' => 'form-group col-md-3 col-6'],
            'tab' => 'Дизайн'
        ]);

        CRUD::addField([
            'name' => 'button_text_color',
            'label' => 'Цвет текста кнопок',
            'type' => 'color',
            'wrapper' => ['class' => 'form-group col-md-3 col-6'],
            'tab' => 'Дизайн'
        ]);

        CRUD::addField([
            'name' => 'main_text_color',
            'label' => 'Цвет текста глав.',
            'type' => 'color',
            'wrapper' => ['class' => 'form-group col-md-3 col-6'],
            'tab' => 'Дизайн'
        ]);

        CRUD::addField([
            'name' => 'additional_text_color',
            'label' => 'Цвет текста доп.',
            'type' => 'color',
            'wrapper' => ['class' => 'form-group col-md-3 col-6'],
            'tab' => 'Дизайн'
        ]);

        CRUD::addField([
            'name' => 'border_color',
            'label' => 'Цвет основных границ',
            'type' => 'color',
            'wrapper' => ['class' => 'form-group col-md-3 col-6'],
            'tab' => 'Дизайн'
        ]);

        CRUD::addField([
            'name' => 'font',
            'label' => 'Шрифт',
            'type' => 'select',
            'attribute' => 'name',
            'model' => Font::class,
            'allows_null' => false,
            'wrapper' => ['class' => 'form-group col-md-3'],
            'tab' => 'Дизайн'
        ]);

        CRUD::addField([
            'name' => 'email',
            'label' => 'Почта',
            'type' => 'email',
            'wrapper' => ['class' => 'from-group col-md-3'],
            'tab' => 'Доп. информация'
        ]);

        CRUD::addField([
            'name' => 'phone_number',
            'label' => 'Номер телефона',
            'type' => 'text',
            'wrapper' => ['class' => 'from-group col-md-3'],
            'tab' => 'Доп. информация'
        ]);

        CRUD::addField([
            'name' => 'address',
            'label' => 'Главный адрес',
            'type' => 'text',
            'wrapper' => ['class' => 'from-group col-md-3'],
            'tab' => 'Доп. информация'
        ]);

        CRUD::addField([
            'name' => 'main_link',
            'label' => 'Ссылка на сайт',
            'type' => 'url',
            'wrapper' => ['class' => 'from-group col-md-3'],
            'tab' => 'Доп. информация'
        ]);

        CRUD::addField([
            'name' => 'logo_path',
            'label' => 'Логотип',
            'type' => 'upload',
            'withFiles' => true,
            'wrapper' => ['class' => 'form-group col-md-6'],
            'tab' => 'Доп. информация'
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
