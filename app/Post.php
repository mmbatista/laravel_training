<?php

namespace App;

use Carbon\Carbon;


class Post extends Model
{

	public function comments()
	{

		return $this->hasMany(Comment::class);

	}

    public function user()
    {
    
    	return $this->belongsTo(User::class);
    
    }



	public function addComment($body, Post $post)
	{

    	$this->comments()->create([

    		'user_id' => auth()->user()->id,

    		'body' => $body,

    		'post_id' => $post->id

    	]);
    	
    	//is the same:
/*    	$this->comments()->create(['body' => $body]);
*/
	}

    public function scopeFilter($query, $filters)
    {
        if($filters && $month = $filters['month']) {
            $query->whereMonth('created_at', Carbon::parse($month)->month);
        }

        if($filters && $year = $filters['year']) {
            $query->whereYear('created_at', $year);
        }


    }

}
