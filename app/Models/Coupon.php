<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    // Definimos los atributos que se pueden asignar masivamente
    protected $fillable = [
        'code', // Código del cupón
        'type', // Tipo de descuento (percentage/fixed)
        'value', // Valor del descuento
    ];

    // Si prefieres usar 'guarded' puedes utilizarlo en lugar de 'fillable'
    // protected $guarded = [];

    /**
     * Método para aplicar el descuento basado en el tipo de cupón
     *
     * @param float $total
     * @return float
     */
    public function applyDiscount(float $total)
    {
        if ($this->type === 'percentage') {
            return ($total * $this->value) / 100; // Descuento en porcentaje
        }

        if ($this->type === 'fixed') {
            return $this->value; // Descuento fijo
        }

        return 0;
    }
}
