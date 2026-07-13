<?php

namespace App\Rules;

use App\Models\Kegiatan;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class JamTidakBentrok implements ValidationRule
{
    protected $tanggal;
    protected $jamMulai;
    protected $userId;
    protected $ignoreId;

    public function __construct($tanggal, $jamMulai, $userId, $ignoreId = null)
    {
        $this->tanggal = $tanggal;
        $this->jamMulai = $jamMulai;
        $this->userId = $userId;
        $this->ignoreId = $ignoreId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // $value di sini adalah jam_selesai
        $query = Kegiatan::where('user_id', $this->userId)
            ->where('tanggal', $this->tanggal)
            ->where(function ($q) use ($value) {
                $q->where(function ($q2) use ($value) {
                    // Bentrok kalau: mulai_baru < selesai_lama DAN selesai_baru > mulai_lama
                    $q2->where('jam_mulai', '<', $value)
                       ->where('jam_selesai', '>', $this->jamMulai);
                });
            });

        if ($this->ignoreId) {
            $query->where('id', '!=', $this->ignoreId);
        }

        if ($query->exists()) {
            $fail('Jam ini bentrok dengan kegiatan lain yang sudah kamu catat di tanggal yang sama.');
        }
    }
}