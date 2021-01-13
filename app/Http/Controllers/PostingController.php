<?php
 
namespace App\Http\Controllers;
 
use App\Models\Posting;
 
use Illuminate\Http\Request;
 
class PostingController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $posting = Posting::all();
        return response()->json($posting);
    }

    public function show($id){
        $posting = Posting::find($id);
        return response()->json($posting);
    }

    public function create(Request $request) {
        $this->validate($request, [
            'nama' => 'required|string',
            'harga' => 'required|integer',
            'deskripsi' => 'required|string',
            'kondisi' => 'in:baru,bekas',
            'lokasi' => 'required|string',
            'kategori' => 'required|in:kendaraan,elektronik,kuliner,fashion',
            'photo' => 'required|image',
           ]
        );

        $photo = Str::random(34);
        $request->file('photo')->move(storage_path('photo'), $photo);

        $data = $request->all(); // ambil semua yg ada dibody
        $posting = Posting::create($data); // yg ada di model Post
 
        return response()->json($posting);
    }

    public function get_photo($name)
    {
        $photo_path = storage_path('photo') . '/' . $name;if (file_exists($photo_path)) {
        $file = file_get_contents($photo_path);
        return response($file, 200)->header('Content-Type', 'image/jpeg');
        }$res['success'] = false;
        $res['message'] = "Avatar not found";
        
        return $res;
    }

    public function update(Request $request, $id) {
        $posting = Posting::find($id);
        if(!$posting) {
            return response()->json(['message' => 'Posting not found!'], 404);
        }

        $this->validate($request, [
            'nama' => 'required|string',
            'harga' => 'integer',
            'deskripsi' => 'string',
            'kondisi' => 'string',
            'lokasi' => 'string',
            'kategori' => 'string'
       ]);
        $data = $request->all();

        $posting->fill($data);

        $posting->save();
        return response()->json($posting);
    }

    public function destroy($id) {
        $posting = Posting::find($id);
        if(!$posting) {
             return response()->json(['message' => 'Posting not found!'], 404);
         }
 
         $posting->delete();
         return response()->json(['message' => 'Postingan has been deleted!']);
    }
}
