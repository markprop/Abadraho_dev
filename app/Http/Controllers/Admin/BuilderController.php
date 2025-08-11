<?php

namespace App\Http\Controllers\Admin;

use App\Models\Builder;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BuilderRequest;
use App\Helpers\AppHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BuilderController extends Controller
{

  public function __construct()
  {
    // $this->middleware('auth:admin');
    $this->middleware('manage_user_types');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $builders = Builder::all();
    return view('panel.admin.builder.index', compact('builders'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $builders = User::where('user_type_id', '-10025')->get();
    return view('panel.admin.builder.create', compact('builders'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(BuilderRequest $request)
  {
    $validated = $request->validate([
      'full_name'                   =>  'required',
      'contact_person_email'        =>  'required | unique:builders',
      'contact_person_name'         =>  'required',
      'contact_person_phone_number' =>  'required',
    ]);

    $user = User::find($request->contact_person_email);

    Builder::create([
      'full_name' => $request->full_name,
      'user_id' => $user->id,
      'email' => $user->email,
      'contact_person_name' => $request->contact_person_name,
      'contact_person_email' => $user->email,
      'contact_person_phone_number' => $request->contact_person_phone_number
    ]);

    return redirect('/admin/builder');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Builder  $builder
   * @return \Illuminate\Http\Response
   */
  public function show(Builder $builder)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Builder  $builder
   * @return \Illuminate\Http\Response
   */
  public function edit(Builder $builder)
  {
    return view('panel.admin.builder.edit', compact('builder'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Builder  $builder
   * @return \Illuminate\Http\Response
   */
  public function update(BuilderRequest $request, Builder $builder)
  {
    $builder->full_name = $request->full_name;
    $builder->contact_person_name = $request->contact_person_name;
    $builder->contact_person_email = $request->contact_person_email;
    $builder->contact_person_phone_number = $request->contact_person_phone_number;
    $builder->save();
    $builder->touch();

    return redirect('/admin/builder');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Builder  $builder
   * @return \Illuminate\Http\Response
   */

  // public function destroy(Builder $builder)
  // {
  //   Builder::destroy($builder->id);
  //   return back();
  // }

  public function destroy(Request $request)
  {

    $ErrorMsg = "";
    $data = [];
    // return $request->all();
    DB::beginTransaction();
    try {
      $validator = Validator::make($request->all(), [
        'builder_id' => ['required', 'numeric'],
      ]);

      if ($validator->fails()) {
        $data["status"] = false;
        $data["message"] = "Some thing went wrong: Validation Error.";
        $data["error"] = $validator->errors();
        return response()->json($data, 200);
      }

      // return $request->all();
      // return response()->json($data, 200);

      if ($ErrorMsg == "") {

        $eloquent = Builder::where("id", $request->builder_id);
        $deleteTrash = AppHelper::isArchiveRecord($eloquent);
        if ($deleteTrash["status"]) {
          $data["status"] = $deleteTrash["status"];
          $data["message"] = "Builder deleted successfully.";
        } else {
          $ErrorMsg = $deleteTrash["message"];
        }
      }
    } catch (\Throwable $e) {
      DB::rollback();
      $ErrorMsg = "Error Occurred while deleting Builder. Exception Msg : " . $e->getMessage();
      $data["status"] = false;
      $data["message"] = $ErrorMsg;
    }
    if ($ErrorMsg == "") {
      DB::commit();
      return response()->json($data, 200);
    } else {
      $data["status"] = false;
      $data["message"] = $ErrorMsg;
      // $data["Obj"] = $request->all();
      return response()->json($data, 200);
    }
  }
}
?>