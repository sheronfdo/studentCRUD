<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;


class StudentController extends Controller
{
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->ref_tablename = "student";
    }

    public function store(Request $request)
    {
        $data = [
            'title' => $request['title'],
            'content' => $request['content']
        ];
        $ref = $this->database->getReference($this->ref_tablename)->push($data);
        $postkey = $ref->getKey();
        if($ref){
            return response()->json('blog has been created');
        }
    }
}
