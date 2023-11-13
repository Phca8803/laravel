<?php

namespace App\Services;

use App\Models\JournalNew;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Auth;

class JournalNewService
{
    public function paginate($limit, User $user): LengthAwarePaginator
    {
        return $this->buildQuery($user)->paginate($limit);
    }

    private function buildQuery(User $user): Builder
    {
        $query = JournalNew::query();
  
        $query->when(request('id'), function($query,$id){
            return $query->whereId($id);
        });

        if(request('title')){
            $query->when('title', function($query){
                return $query->where('title','LIKE','%' . request('title') . '%');
            });
        }

        if(request('text')){
            $query->when('text', function($query){
                return $query->where('text','LIKE','%' . request('text') . '%');
            });
        }

        
        return $query->where('user_id',$user->id);
    }

    public function create($data,$user): JournalNew
    {
        $journalNew = new JournalNew(); 
        $journalNew->title = $data['title'];
        $journalNew->text = $data['text'];
        $journalNew->user_id = $user->id;
        
        $journalNew->save();

        return $journalNew;
    }

    public function update($data, JournalNew $journalNew): JournalNew 
    {
        $journalNew->title = $data['title'];
        $journalNew->text = $data['text'];
        $journalNew->save();

        return $journalNew;
    }

    public function delete(JournalNew $journalNew){
        
        return $journalNew->delete();
    }

}