<?php

namespace App\Http\Controllers;

use http\Env\Response;
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
            return response()->json('student has been created' . $postkey);
        }
    }

    public function getStudents()
    {
        $students = $this->database->getReference($this->ref_tablename)->getValue();
        return Response()->json($students);
    }

    public function getStudent($id)
    {
        $students = $this->database->getReference($this->ref_tablename)->getChild($id)->getValue();
        return Response()->json($students);
    }

    public function updateStudent(Request $request, $id)
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
        $ref = $this->database->getReference($this->ref_tablename . "/" . $id)->update($data);
        if ($ref) {
            return response()->json('student has been updated');
        }
    }

    public function deleteStudent($id)
    {
        $ref = $this->database->getReference($this->ref_tablename . "/" . $id)->remove();
        if ($ref) {
            return response()->json('student has been deleted');
        }
    }


}
