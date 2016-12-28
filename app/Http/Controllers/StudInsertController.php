<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use DB;
use Illuminate\Http\Request;

class StudInsertController extends Controller
{
    public function insertform()
    {
        return view('stud_create');
    }

    public function insert(Request $request)
    {
        $name = $request->input('stud_name');
        DB::insert('insert into student (name) values(?)', [$name]);
        echo "Record inserted successfully.<br/>";
        echo '<a href="/insert">Click Here</a> to go back.';
    }
}