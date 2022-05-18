<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    const TYPE_INDIVIDUAL = 'individual';
    const TYPE_LEGAL = 'legal';

    const MARITAL_STATUS = [
        1 => 'Solteiro',
        2 => 'Casado',
        3 => 'Divorciado'
    ];

    const SEX = [
        'f',
        'm'
    ];

    protected $fillable = [
        'name',
        'document_number',
        'email',
        'phone',
        'defaulter',
        'date_birth',
        'sex',
        'marital_status',
        'physical_disability',
        'company_name',
        'client_type'
    ];

    public static function getClientType($type)
    {
        return $type == Client::TYPE_LEGAL ? $type : Client::TYPE_INDIVIDUAL;
    }

    public function getSexAttribute()
    {
        return $this->attributes['sex'] == 'm' ? 'Masculino' : 'Feminino';
    }

    public function getDateBirthAttribute()
    {
        return (new DateTime($this->attributes['date_birth']))->format('d/m/Y');
    }

    public function getDocumentNumberAttribute()
    {
        $document = $this->attributes['document_number'];
        if (!empty($document)) {
            if (strlen($document) == 11) {
                $document = preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $document);
            } elseif (strlen($document) == 14) {
                $document = preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $document);
            }
        }
        return $document;
    }

    public function setDocumentNumberAttribute($value)
    {
        $this->attributes['document_number'] = preg_replace('/[^0-9]/', '', $value);
    }
}
