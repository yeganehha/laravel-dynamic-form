<?php

namespace Yeganehha\DynamicForm\Tests\Services;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Yeganehha\DynamicForm\DefineProperty;
use Yeganehha\DynamicForm\Enums\FieldStatusEnum;
use Yeganehha\DynamicForm\Exceptions\FieldNotFoundException;
use Yeganehha\DynamicForm\Exceptions\FildTypeNotFoundException;
use Yeganehha\DynamicForm\Exceptions\FormNotFoundException;
use Yeganehha\DynamicForm\Exceptions\UnknownFieldLoaded;
use Yeganehha\DynamicForm\Fields\TextField;
use Yeganehha\DynamicForm\Models\Form;
use Yeganehha\DynamicForm\Services\FieldService;
use Tests\TestCase;
use Yeganehha\DynamicForm\Services\FormService;

class FieldServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testFindById()
    {
        $form = FormService::findOrRegister('test 1' , Form::class );
        $field = FieldService::insert($form , TextField::class);
        $this->assertEquals($field->form->id , $form->id);
    }

    public function testGetAllTypes()
    {
        Config::set(DefineProperty::$configFile.'.fields' , [TextField::class]);
        $fields = FieldService::getAllTypes();
        $this->assertCount(1 , $fields);
        $this->expectException(UnknownFieldLoaded::class);
        Config::set(DefineProperty::$configFile.'.fields' , [DefineProperty::class]);
        FieldService::getAllTypes();
    }

    public function testInsertCorrectForm()
    {
        $form = FormService::findOrRegister('test 1', Form::class);
        FieldService::insert($form, TextField::class, 'test 1');
        $this->assertDatabaseHas(config(DefineProperty::$configFile . '.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
            'label' => 'test 1',
        ]);
        FieldService::insert($form->id, TextField::class, 'test 2');
        $this->assertDatabaseHas(config(DefineProperty::$configFile . '.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
            'label' => 'test 2',
        ]);
        FieldService::insert([$form->id], (new TextField()), 'test 3');
        $this->assertDatabaseHas(config(DefineProperty::$configFile . '.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
            'label' => 'test 3',
        ]);
        FieldService::insert(['test' => 'test', 'id' => $form->id], (new TextField()), 'test 4');
        $this->assertDatabaseHas(config(DefineProperty::$configFile . '.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
            'label' => 'test 4',
        ]);
        FieldService::insert(['test' => 'test', 'name' => $form->name, 'model' => $form->model], (new TextField()), 'test 5');
        $this->assertDatabaseHas(config(DefineProperty::$configFile . '.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
            'label' => 'test 5',
        ]);
        FieldService::insert([$form->name, $form->model], (new TextField()), 'test 6');
        $this->assertDatabaseHas(config(DefineProperty::$configFile . '.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
            'label' => 'test 6',
        ]);
        $obj1 = new \stdClass();
        $obj1->id = $form->id;
        FieldService::insert($obj1, (new TextField()), 'test 7');
        $this->assertDatabaseHas(config(DefineProperty::$configFile . '.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
            'label' => 'test 7',
        ]);
        $obj2 = new \stdClass();
        $obj2->name = $form->name;
        $obj2->model = $form->model;
        FieldService::insert($obj2, (new TextField()), 'test 8');
        $this->assertDatabaseHas(config(DefineProperty::$configFile . '.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
            'label' => 'test 8',
        ]);
    }

    public function testInsertInCorrectForm()
    {
        $this->expectException(FormNotFoundException::class);
        FieldService::insert((new DefineProperty()) , TextField::class, 'test 1');
        FieldService::insert(-10 , TextField::class , 'test 2');
        FieldService::insert([-10] , (new TextField()) , 'test 3');
        FieldService::insert(['test' => 'test' , 'id' => -10] , (new TextField()) , 'test 4');
        FieldService::insert(['test' => 'test' , 'name' => 'in correct name', 'model' => Form::class] , (new TextField()) , 'test 5');
        FieldService::insert(['in correct name',Form::class] , (new TextField()) , 'test 6');
        $obj1 = new \stdClass();
        $obj1->id = -1;
        FieldService::insert($obj1 , (new TextField()) , 'test 7');
        $obj2 = new \stdClass();
        $obj2->name = 'in correct name';
        $obj2->model = Form::class;
        FieldService::insert($obj2 , (new TextField()) , 'test 8');
    }


    public function testInsertCorrectParent()
    {
        $form = FormService::findOrRegister('test 1', Form::class);
        $field = FieldService::insert($form, TextField::class, 'test 1');
        FieldService::insert($form->id, TextField::class, 'test 2' , $field);
        $this->assertDatabaseHas(config(DefineProperty::$configFile . '.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
            'label' => 'test 2',
            'parent_id' => $field->id
        ]);
        FieldService::insert([$form->id], (new TextField()), 'test 3',$field->id);
        $this->assertDatabaseHas(config(DefineProperty::$configFile . '.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
            'label' => 'test 3',
            'parent_id' => $field->id
        ]);
    }

    public function testInsertInCorrectParent()
    {
        $this->expectException(FieldNotFoundException::class);
        $form = FormService::findOrRegister('test 1', Form::class);
        FieldService::insert($form->id, TextField::class, 'test 2' , (new DefineProperty()));
        FieldService::insert([$form->id], (new TextField()), 'test 3',-10);
    }

    public function testInsertCorrectType()
    {
        $form = FormService::findOrRegister('test 1' , Form::class );
        FieldService::insert($form , TextField::class);
        $this->assertDatabaseHas(config(DefineProperty::$configFile.'.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
        ]);
        FieldService::insert($form , TextField::class , 'test 1');
        $this->assertDatabaseHas(config(DefineProperty::$configFile.'.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
            'label' => 'test 1',
        ]);
        FieldService::insert($form , (new TextField()) , 'test 2');
        $this->assertDatabaseHas(config(DefineProperty::$configFile.'.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
            'label' => 'test 2',
        ]);
    }

    public function testInsertInCorrectType()
    {
        $form = FormService::findOrRegister('test 1' , Form::class );
        $this->expectException(FildTypeNotFoundException::class);
        $this->expectException(UnknownFieldLoaded::class);
        FieldService::insert($form , DefineProperty::class , 'test 1');
        FieldService::insert($form , (new DefineProperty()) , 'test 2');
    }

    public function testInsertCorrectStatus()
    {
        $form = FormService::findOrRegister('test 1' , Form::class );
        FieldService::insert($form , TextField::class , 'test 1' , null, FieldStatusEnum::Hidden);
        $this->assertDatabaseHas(config(DefineProperty::$configFile.'.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
            'label' => 'test 1',
            'status' => FieldStatusEnum::Hidden,
        ]);
        FieldService::insert($form , TextField::class , 'test 2' , null, FieldStatusEnum::Required);
        $this->assertDatabaseHas(config(DefineProperty::$configFile.'.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
            'label' => 'test 2',
            'status' => FieldStatusEnum::Required,
        ]);
        FieldService::insert($form , TextField::class , 'test 3' , null, FieldStatusEnum::Show);
        $this->assertDatabaseHas(config(DefineProperty::$configFile.'.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
            'label' => 'test 3',
            'status' => FieldStatusEnum::Show,
        ]);
        FieldService::insert($form , TextField::class , 'test 4' );
        $this->assertDatabaseHas(config(DefineProperty::$configFile.'.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
            'label' => 'test 4',
            'status' => FieldStatusEnum::Show,
        ]);
    }

    public function testInsertCorrectMixed()
    {
        $form = FormService::findOrRegister('test 1' , Form::class );
        FieldService::insert($form ,
            TextField::class ,
            'test 1' ,
            null,
            FieldStatusEnum::Show,
            'Description',
            ['Value String',1],
            'fa fa-icon',
            ['required' , 'min:8'],
            100,
            'test',
            'style test',
            ['attr1' => false , 'attr2' => 1 ,  'attr3' => "test" ],
            ['data1' => false , 'data2' => 1 ,  'data3' => "test" ]
        );
        $this->assertDatabaseHas(config(DefineProperty::$configFile.'.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
            'label' => 'test 1',
            'status' => FieldStatusEnum::Show,
            'description' => 'Description',
            'value' => json_encode(['Value String',1]),
            'font_icon' => 'fa fa-icon',
            'validate' => json_encode(['required' , 'min:8']),
            'order_number' => 100,
            'class' => 'test',
            'style' => 'style test',
            'field_attributes' => json_encode(['attr1' => false , 'attr2' => 1 ,  'attr3' => "test" ]),
            'additional_data' => json_encode(['data1' => false , 'data2' => 1 ,  'data3' => "test" ]),
        ]);
    }


    public function testUpdateOrder()
    {
        $form = FormService::findOrRegister('test 1' , Form::class );
        $filed = FieldService::insert($form ,TextField::class );
        FieldService::updateOrder($filed ,10 );
        $this->assertDatabaseHas(config(DefineProperty::$configFile.'.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
            'order_number' => 10
        ]);
        FieldService::updateOrder($filed->id ,100 );
        $this->assertDatabaseHas(config(DefineProperty::$configFile.'.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
            'order_number' => 100
        ]);
        $this->expectException(FieldNotFoundException::class);
        FieldService::updateOrder((new DefineProperty()),10 );
        FieldService::updateOrder(-10,10 );
    }

    public function testUpdateAllFields()
    {
        $form = FormService::findOrRegister('test 1' , Form::class );
        $filed1 = FieldService::insert($form ,TextField::class , 'test 1');
        $filed2 = FieldService::insert($form ,TextField::class , 'test 2');
        FieldService::updateAllFields([[$filed1->id , 10 ],[$filed2->id , 100 ]]);
        $this->assertDatabaseHas(config(DefineProperty::$configFile.'.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
            'label' => 'test 1',
            'order_number' => 10
        ]);
        $this->assertDatabaseHas(config(DefineProperty::$configFile.'.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
            'label' => 'test 2',
            'order_number' => 100
        ]);
        FieldService::updateAllFields([[$filed1->id , 1000 ]]);
        $this->assertDatabaseHas(config(DefineProperty::$configFile.'.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
            'label' => 'test 1',
            'order_number' => 1000
        ]);
        $this->assertDatabaseHas(config(DefineProperty::$configFile.'.database.table_name.field'), [
            'form_id' => $form->id,
            'type_variable' => TextField::class,
            'label' => 'test 2',
            'order_number' => 100
        ]);
        $this->expectException(ModelNotFoundException::class);
        FieldService::updateAllFields([[-10 , 10 ],[$filed2->id , 100 ]]);
        FieldService::updateAllFields([['test' , 10 ],[$filed2->id , 100 ]]);
        FieldService::updateAllFields([['test' , 'test' ],[$filed2->id , 100 ]]);
        FieldService::updateAllFields([[$filed1->id , 'test' ],[$filed2->id , 200 ]]);
        $this->assertDatabaseHas(config(DefineProperty::$configFile.'.database.table_name.field'), [
            'id' => $filed2->id,
            'order_number' => 200
        ]);
        $this->assertDatabaseHas(config(DefineProperty::$configFile.'.database.table_name.field'), [
            'id' => $filed1->id,
            'order_number' => 0
        ]);
    }

    public function testGetType()
    {
        $field = FieldService::getType(TextField::class);
        $this->assertEquals($field::class , TextField::class);
    }

    public function testGetWrongType()
    {
        $this->expectException(UnknownFieldLoaded::class);
        FieldService::getType(self::class);
    }
}
