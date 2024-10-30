<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\BeneficiaryImport;
use App\Models\Barangay;
use App\Models\Beneficiary;
use App\Models\Municipality;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Excel;

class ImportFromExcel extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'import:beneficiaries
                          {file : Path to the Excel file}
                          {--year= : The year for the import}
                          {--delete : Delete existing data before import}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Import beneficiaries from an Excel file with options for year and data deletion';

  /**
   * Execute the console command.
   */
  public function handle()
  {
    // Retrieve arguments and options
    $file = $this->argument('file');
    $year = $this->option('year');
    $delete = $this->option('delete');

    // Validate the file existence
    if (!file_exists($file)) {
      $this->error("The file {$file} does not exist.");
      return 1; // Return a non-zero code to indicate failure
    }

    // Optional: Validate the year
    if (!$year || !is_numeric($year)) {
      $this->error("Please provide a valid year using the --year option.");
      return 1;
    }

    // Confirm deletion if --delete is set
    if ($delete) {
      if ($this->confirm('Are you sure you want to delete existing data?')) {
        Schema::disableForeignKeyConstraints();
        Beneficiary::truncate();
        Barangay::truncate();
        Municipality::truncate();
        Schema::enableForeignKeyConstraints();
        $this->info('Existing data has been deleted.');
      } else {
        $this->info('Data deletion aborted.');
        return 0;
      }
    }

    try {
      // Perform the import
      Excel::import(new BeneficiaryImport($year), $file);
      $this->info('Beneficiaries imported successfully.');
    } catch (\Exception $e) {
      $this->error('Error during import: ' . $e->getMessage());
      return 1;
    }

    return 0; // Success
  }
}
