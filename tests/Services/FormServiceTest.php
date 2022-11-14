<?php

namespace Yeganehha\DynamicForm\Tests\Services;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Psy\Exception\FatalErrorException;
use Tests\TestCase;
use Yeganehha\DynamicForm\DefineProperty;
use Yeganehha\DynamicForm\Exceptions\FormNameRepeated;
use Yeganehha\DynamicForm\Models\Form;
use Yeganehha\DynamicForm\Services\FormService;

class FormServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testInvalidModel()
    {
        $this->expectException(FatalErrorException::class);
        FormService::registerForm('test 1' , 'Yeganehha\DynamicForm\Models\TestModel' );
    }

    public function testRegisterForm()
    {
        FormService::registerForm('test 1' , Form::class );
        $this->assertDatabaseHas(config(DefineProperty::$configFile.'.database.table_name.form'), [
            'name' => 'test 1',
            'model' => Form::class,
        ]);
    }

    public function testRegisterDuplicateForm()
    {
        $this->expectException(FormNameRepeated::class);
        FormService::registerForm('test 1' , Form::class );
        FormService::registerForm('test 1' , Form::class );
    }

    public function testFormExist()
    {
        FormService::registerForm('test Form Exist' , Form::class );
        $exist = FormService::formExist('test Form Exist' , Form::class);
        $this->assertTrue($exist);
        $notExist = FormService::formExist('test Form not Exist' , Form::class);
        $this->assertFalse($notExist);
        $notExist = FormService::formExist('test Form Exist' , User::class);
        $this->assertFalse($notExist);
    }

    public function testFindOrRegister()
    {
        $form1 = FormService::findOrRegister('test 1' , Form::class );
        $this->assertDatabaseHas(config(DefineProperty::$configFile.'.database.table_name.form'), [
            'name' => 'test 1',
            'model' => Form::class,
        ]);
        $form2 = FormService::findOrRegister('test 1' , Form::class );
        $this->assertEquals($form1->name , 'test 1' );
        $this->assertEquals($form1->name , $form2->name );
    }


    public function testFind()
    {
        FormService::findOrRegister('test 1' , Form::class );
        $form = FormService::find('test 1' , Form::class );
        $this->assertEquals($form->name , 'test 1' );
        $form = FormService::find('test 2' , Form::class );
        $this->assertNull($form);
    }

    public function testDelete()
    {
        FormService::findOrRegister('test 1' , Form::class );
        $form = FormService::find('test 1' , Form::class );
        $this->assertEquals($form->name , 'test 1' );
        FormService::delete('test 1' , Form::class );
        $form = FormService::find('test 1' , Form::class );
        $this->assertNull($form);
        $this->expectException(FatalErrorException::class);
        FormService::delete('test 1' , Form::class );
    }

    public function testGetModelForms()
    {
        FormService::findOrRegister('test 1' , Form::class );
        FormService::findOrRegister('test 2' , Form::class );
        FormService::findOrRegister('test 2' , Form::class );
        $forms = FormService::getModelForms( Form::class );
        $this->assertCount(2,$forms);
    }

    public function testDeleteAll()
    {
        FormService::findOrRegister('test 1' , Form::class );
        FormService::findOrRegister('test 2' , Form::class );
        FormService::deleteAll( Form::class );
        $form = FormService::find('test 1' , Form::class );
        $this->assertNull($form);
        $form = FormService::find('test 2' , Form::class );
        $this->assertNull($form);
    }
}
