<?php
	
namespace App;
use Illuminate\Database\Eloquent\Model;
class Phonebook extends Model
{  
	protected $table = 'phonebooks';
    public $fillable = ['name','user_id','mobile','email','contact_group','details'];
}