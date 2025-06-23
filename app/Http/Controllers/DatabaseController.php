<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DatabaseController extends Controller
{
  public function index()
  {
    return view('database.index');
  }

  public function migrate()
  {
    $this->exportDatabaseToSql();

    // Download the exported .SQL file
    $fileName = 'database.sql';
    return response()->download(storage_path("app/app/backups/database.sql"));
  }

 
  private function exportDatabaseToSql()
  {
    $tables = [
        'users',
        'capacitacion_modulos',
        'capacitacion_articulos',
        'evaluacions',
        'audit_logs'

    ];

    $sql = '';
    foreach ($tables as $tableName) {
        $sql .= "-- Dumping data for table `{$tableName}`\n";

        // Get table schema (optional, depending on your needs)
        $columns = DB::connection()->getSchemaBuilder()->getColumnListing($tableName);

        $sql .= "INSERT INTO `{$tableName}` (";
        $sql .= implode(',', $columns);
        $sql .= ") VALUES\n";

        $data = DB::table($tableName)->get();
        foreach ($data as $row) {
            $values = [];
            foreach ($row as $key => $value) {
                $values[] = "'" . str_replace("'", "\\'", $value) . "'"; // Escape single quotes
            }
            $sql .= "(" . implode(',', $values) . "),\n";
        }

        $sql = rtrim($sql, ",\n") . ";\n\n"; // Remove trailing comma and newline
    }

    Storage::put('app/backups/database.sql', $sql);
    
}

  
  

  public function restore(Request $request)
  {
    if ($request->hasFile('backup')) {
      $file = $request->file('backup');
      $fileName = $file->getClientOriginalName();
      $filePath = storage_path('app/backups/' . $fileName);


      // Upload file (optional, can be removed if automatic upload is desired)
      $file->storeAs('backups', $fileName);

      DB::statement(file_get_contents($filePath));

      return redirect()->route('database.index')->with('success', 'Base de datos restaurada satisfactoriamente.');
    }
  }
}