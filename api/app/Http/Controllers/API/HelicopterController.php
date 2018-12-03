<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Helicopter;
use Validator;
class HelicopterController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Helicopters = Helicopter::all();
        return $this->sendResponse($Helicopters->toArray(), 'Helicopters retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'type' => 'required',
            'speed' => 'required',
            'color' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $Helicopter = Helicopter::create($input);
        return $this->sendResponse($Helicopter->toArray(), 'Helicopter created successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Helicopter = Helicopter::find($id);
        if (is_null($Helicopter)) {
            return $this->sendError('Helicopter not found.');
        }
        return $this->sendResponse($Helicopter->toArray(), 'Helicopter retrieved successfully.');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Helicopter $Helicopter)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'type' => 'required',
            'speed' => 'required',
            'color' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $Helicopter->name = $input['name'];
        $Helicopter->detail = $input['detail'];
        $Helicopter->save();
        return $this->sendResponse($Helicopter->toArray(), 'Helicopter updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Helicopter $Helicopter)
    {
        $Helicopter->delete();
        return $this->sendResponse($Helicopter->toArray(), 'Helicopter deleted successfully.');
    }

    public function getGuzzleRequest()
    {   
 
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://jsonplaceholder.typicode.com/users');
        
        $stream = $res->getBody();
        $contents = $stream->getContents();
        // mostrar el username de 01 usuario
        //$user=(json_decode($contents , true));
        //print_r($user);
        //echo $user[0]['username'];
        //
        return $res->getBody();

    }

    public function getUser(){
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://api.github.com/user', ['auth' => ['edwin.bocanegra@gmail.com', 'comando2205']]);
        //echo $res->getStatusCode();
        //echo $res->getHeader('content-type');
        echo $res->getBody();
    }
}