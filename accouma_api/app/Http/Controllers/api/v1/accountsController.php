<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Request;
use Response;

use App\Helpers\Helpers;
use App\models\accountsModel as accounts;

class accountsController extends Controller{

  public function index(){
    $accounts = accounts::getAccounts();
    return Response::json([
      'result' => [
        'rows' => $accounts
      ],
      'msg' => 'Success'
    ], 200);
  }

  public function edit($id){
    $account = accounts::getAccount($id);
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

  public function update($id){
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
    accounts::updateAccount($id, $data);
    return Response::json([
      'result' => [],
      'msg' => 'success'
    ], 200);
  }

  public function create(){
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
    $newId = accounts::createAccount($data);
    return Response::json([
      'result' => [
        'newId' => $newId
      ],
      'msg' => 'success'
    ], 200);
  }



  public function active($id){
    accounts::activateAccount($id);
    return Response::json([
      'result' => [],
      'msg' => 'success'
    ], 200);
  }

  public function disable($id){
    accounts::disableAccount($id);
    return Response::json([
      'result' => [],
      'msg' => 'success'
    ], 200);
  }
}