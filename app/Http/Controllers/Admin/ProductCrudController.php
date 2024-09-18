<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use App\helper\AirtableService;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class ProductCrudController extends CrudController
{
    public function setup()
    {
        CRUD::setModel(Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('product', 'products');

        // Define columns
        CRUD::addColumn(['name' => 'id', 'label' => 'ID']);
        CRUD::addColumn(['name' => 'name', 'label' => 'Name']);
        CRUD::addColumn(['name' => 'description', 'label' => 'Description']);
        CRUD::addColumn(['name' => 'price', 'label' => 'Price']);
    }

    public function fetchAirtableData()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('AIRTABLE_API_KEY'),
            'Accept' => 'application/json',
        ])->get("https://api.airtable.com/v0/" . env('AIRTABLE_BASE_ID') . "/" . env('AIRTABLE_TABLE_NAME'));

        $data = $response->json();

        foreach ($data['records'] as $record) {
            Product::updateOrCreate(
                ['id' => $record['id']], // Assuming you want to match by Airtable ID
                $record['fields']
            );
        }
    }

    public function index()
    {
        $this->fetchAirtableData(); // Fetch data from Airtable
        return parent::index(); 
    }

}
