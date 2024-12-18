use App\Models\PenyuluhPetaniLapangan;

// Dalam method boot()
Route::bind('ppl', function ($value) {
    return PenyuluhPetaniLapangan::findOrFail($value);
}); 