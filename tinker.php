
$stations = \App\Models\Station::all();
foreach ($stations as $s) {
    if ($s->tokens->isEmpty()) {
        $t = \Illuminate\Support\Str::random(40);
        \App\Models\StationToken::create([
            'station_id' => $s->id,
            'plain_token' => $t,
            'token_hash' => hash('sha256', $t),
            'name' => 'Default Token'
        ]);
        echo "Created token for station: " . $s->name . "\n";
    }
}
