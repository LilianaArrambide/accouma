<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Request;
use Response;

use App\Helpers\Helpers;
use App\models\accountRegistersModel as Registers;

class accountRegistersController extends Controller{

  public function __construct(){
		$this->middleware('isLogued');
    $this->middleware('pagination', ['only' => ['index']]);
	}

  public function index(){
    $accounts = Registers::getAccountRegisters();
    return Response::json([
      'result' => [
        'rows' => $accounts
      ],
      'msg' => 'Success'
    ], 200);
  }

  public function get($account){
    $accounts = Registers::getAccountRegisters();
    return Response::json([
      'result' => [
        'rows' => $accounts
      ],
      'msg' => 'Success'
    ], 200);
  }

  public function accountAccomulated($account){
    $accounts = Registers::getAccountRegisters();
    return Response::json([
      'result' => [
        'rows' => $accounts
      ],
      'msg' => 'Success'
    ], 200);
  }

  public function editAccountRegister($account,$register_id){
    $account = Registers::getAccountRegister($register_id);
    if(count($account) == 1){
      return Response::json([
        'result' => [
          'row' => $account[0]
        ],
        'msg' => 'success'
      ], 200);
    }else{
      return Response::json([
        'result' => [],
        'msg' => 'Not Found'
      ], 404);
    }
  }

  public function updateAccountRegister($account,$register_id){
    $names = Request::input('names', '');
    $description = Request::input('description', '');
    $user_id = Request::input('user_id', '');
    $date_created = date("Y-m-d H:i:s");
    $status = 2;

    $data = [
      'name' => $name,
      'description' => $description,
      'user_id' => $user_id,
      'date_created' => $date_created,
      'status' => $status
    ];
    Registers::updateAccountRegister($register_id, $data);
    return Response::json([
      'result' => [],
      'msg' => 'success'
    ], 200);
  }

  public function createAccountRegister($account){
    $names = Request::input('names', '');
    $description = Request::input('description', '');
    $user_id = Request::input('user_id', '');
    $date_created = date("Y-m-d H:i:s");
    $status = 2;

    $data = [
      'name' => $name,
      'description' => $description,
      'user_id' => $user_id,
      'date_created' => $date_created,
      'status' => $status
    ];
    $newId = Registers::createAccountRegister($data);
    return Response::json([
      'result' => [
        'newId' => $newId
      ],
      'msg' => 'success'
    ], 200);
  }



  public function recoveAccountRegister($account,$register_id){
    Registers::activateAccountRegister($register_id);
    return Response::json([
      'result' => [],
      'msg' => 'success'
    ], 200);
  }

  public function deleteAccountRegister($account,$register_id){
    Registers::disableAccountRegister($register_id);
    return Response::json([
      'result' => [],
      'msg' => 'success'
    ], 200);
  }
}
