<?php
/**
 * Created by PhpStorm.
 * User: Albert Eduardo Hidalgo Taveras
 * Date: 14/10/2018
 * Time: 12:57 PM
 */

use Core\Util\form_builder\PhpFormBuilder;

class LoginController extends Controller
{
    public function login(){
        $login_form = new PhpFormBuilder();
        //Atributos del formulario
        $login_form->set_att('action', Assets::href('login/loginCheck'));
        $login_form->set_att('method', 'post');
        $login_form->set_att('enctype', 'multipart / form-data');

        //Agregando campo user name
        $login_form->add_input('User',
            array('placeholder' => 'User name',
                'required' => 'true'),
            'user_name');

        //Agregando campo password
        $login_form->add_input('Password',
            array('type' => 'password',
                'placeholder' => '*****',
                'required' => 'true',),
            'password');

        //Agregando checkbox para recordar credenciales
        $login_form->add_input('Recordarme', array('type' => 'checkbox'), 'recordarme');

        //Agregando el boton submit
        $login_form->add_input('Login',
            array('type' => 'submit',
                'value' => 'Login'),
            'login');

        //Enviardo datos a la vista
        $data['form_login'] = $login_form->build_form();
        $this->setData($data);
        //Renderizando vista
        $this->render('login','login');
    }

    public function logincheck(){
        var_dump($_POST);
    }
}