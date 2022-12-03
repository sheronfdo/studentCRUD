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
            "name" => $request["name"],
            "phone" => $request["phone"],
            "dob" => $request["dob"],
            "email" => $request["email"],
            "address" => $request["address"],
            "nic" => $request["nic"],
            "gender" => $request["gender"],
            "guardian" => [
                "name" => $request["guardianname"],
                "phone" => $request["guardianphone"],
                "relation" => $request["guardianrelation"],
                "email" => $request["guardianemail"],
                "address" => $request["guardianaddress"]
            ]
        ];
        $ref = $this->database->getReference($this->ref_tablename)->push($data);
        $postkey = $ref->getKey();
        if ($ref) {
            return response()->json('blog has been created' . $postkey);
        }
    }
}
