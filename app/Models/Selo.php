<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Selo extends Model
{
    use HasFactory;

    protected $table = 'selos';

    protected $fillable = [
        'titulo',
        'imagem',
        'content',
        'link',
        'status'
    ];

    /**
     * Scopes
    */
    public function scopeAvailable($query)
    {
        return $query->where('status', 1);
    }

    public function scopeUnavailable($query)
    {
        return $query->where('status', 0);
    }

    /**
     * Accerssors and Mutators
    */
    public function getimagem()
    {
        if(empty($this->imagem) || !Storage::disk()->exists($this->imagem)) {
            return url(asset('backend/assets/images/image.jpg'));
        } 
        return Storage::url($this->imagem);
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = ($value == '1' ? 1 : 0);
    }
}
