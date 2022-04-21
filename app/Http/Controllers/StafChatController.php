<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class StafChatController extends Controller
{
    public function data()
    {
        $belum_bacas = DB::table('chats')
            ->select(DB::raw('count(chats.dibaca) as belumbaca, users.name, chats.c_user_id, chats.c_user_to'))
            ->join('users', 'chats.c_user_to', '=', 'users.id')
            ->where('chats.dibaca', '=', 0)
            ->groupBy('users.name','chats.c_user_id','chats.c_user_to')
            ->orderBy('belumbaca', 'desc')
            ->get();

        $datas = DB::table('users')
            ->where('role', '=', 'staf')
            ->orWhere('role', '=', 'ketua')
            ->get();

        return view('staf/staf_chat/data', compact('datas','belum_bacas'));
        // return view('staf/staf_chat/data');
    }

    public function chat($id_from, $id_to)
    {
        DB::table('chats')->where([['c_user_id','=',$id_to],['c_user_to','=', $id_from]])->update([
            'dibaca' => 1
        ]);
        
        $chatss = DB::table('chats')
            ->select('chats.id', 'chats.c_isi', 'users.name', 'chats.c_user_id', 'chats.c_user_to', 'chats.created_at')
            ->join('users', 'chats.c_user_id', '=', 'users.id')
            ->where([['chats.c_user_id','=',$id_from],['chats.c_user_to','=', $id_to]])
            ->orWhere([['chats.c_user_id','=',$id_to],['chats.c_user_to','=', $id_from]])
            ->get();
        
        $datas = DB::table('users')
            ->where('role', '=', 'staf')
            ->orWhere('role', '=', 'ketua')
            ->get();
        
        $belum_bacas = DB::table('chats')
            ->select(DB::raw('count(chats.dibaca) as belumbaca, users.name, chats.c_user_id, chats.c_user_to'))
            ->join('users', 'chats.c_user_to', '=', 'users.id')
            ->where('chats.dibaca', '=', 0)
            ->groupBy('users.name','chats.c_user_id','chats.c_user_to')
            ->orderBy('belumbaca', 'desc')
            ->get();

        return view('staf/staf_chat/chat', compact('chatss','id_to','id_from','datas','belum_bacas'));
        // return view('staf/staf_chat/chat');
    }

    public function addChat(Request $request, $id_to, $id_from)
    {
        $now = now();
        $request->validate([
            'message' => 'required',
        ], [
            'message.required' => 'Pesan Tidak Boleh Kosong !',
        ]);

        DB::table('chats')->insert([
                'c_isi' => $request->message,
                'c_user_id' => $request->c_user_id,
                'c_user_to' => $request->c_user_to,
                'created_at' => $now,
                'dibaca' => 0
            ]);
        
        return $this->chat($id_from, $id_to);
    }
//Last Code
}
