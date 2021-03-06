<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Request;
use Response;

use App\Helpers\Helpers;
use App\models\userConceptsModel as Concepts;

class conceptsController extends Controller{

  public function __construct(){
    $this->middleware('isLogued');
    $this->middleware('isAdmin', ['only' => ['update']]);
  }

  public function index(){
    $concepts = Concepts::getConcepts();
    return Response::json([
      'result' => [
        'rows' => $concepts
      ],
      'msg' => 'Success'
    ], 200);
  }

  public function edit($concept_id){
    $concept = Concepts::getConcept($concept_id);
    if(count($concept) == 1){
      return Response::json([
        'result' => [
          'row' => $concept[0]
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

  public function update($concept_id){
    $concept = Request::get('concept', '');

    $data = [
      'concept' => $concept,
    ];
    Concepts::updateConcept($concept_id, $data);
    return Response::json([
      'result' => [],
      'msg' => 'success'
    ], 200);
  }

  public function create(){
    $user_id = Request::get('id', 0);
    $concept = Request::input('concept', '');

    $data = [
      'user_id' => $user_id,
      'concept' => $concept,
      'date_added' => date("Y-m-d H:i:s"),
    ];
    $newId = Concepts::createConcept($data);
    return Response::json([
      'result' => [
        'newId' => $newId
      ],
      'msg' => 'success'
    ], 200);
  }

}
