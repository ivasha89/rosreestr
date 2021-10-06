<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Plot;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ParserTest extends TestCase
{
    use WithFaker;
    
    public function fakePlots() {
        $faker = \Faker\Factory::create();
        $plots = [];
        for($j = 0;$j < 3;$j++) {
            $createReestrNumber = [];
            for($i = 0;$i < 4;$i++) {
                $createReestrNumber[] = $faker->numberBetween($min=10, $max=99);
            }
            $number = implode(':', $createReestrNumber);
            $plots[$j] = $number;
        }
        return $plots;
    }
    /**
     * Check plots array not Empty
     *
     * @return void
     */
    public function testIfPlotsArrayNotEmpty()
    {
        $plots = $this->fakePlots();
        $this->assertNotEmpty($plots);
    }

    /**
     * Check rosreestr array
     *
     * @return void
     */
    public function test_if_parsing_rosreestr()
    {
        $plots = ['69:27:22:1306', '69:27:22:1307'];
        $returnPlots = [];
        foreach($plots as $plot) {
            $response = json_decode(Http::get("https://pkk.rosreestr.ru/api/features/1/".$plot), true);
            isset($response['feature']['attrs']) ? $this->assertArrayHasKey('cad_cost', $response['feature']['attrs']) : '';
            $returnPlots[] = $response;
        }

        return $returnPlots;
    }

    public function test_if_plot_in_database() {
        $plots = $this->test_if_parsing_rosreestr();

        foreach($plots as $plot) 
        {
            try 
            {
                $basePlot = Plot::where('number', $plot['feature']['attrs']['cn'])->firstOrFail();
                $this->assertDatabaseHas('plots', [
                    'cad_cost' => $plot['feature']['attrs']['cad_cost']
                ]);
            }
            catch(ModelNotFoundException $ex) 
            {
                $this->assertDatabaseMissing('plots', [
                    'cad_cost' => $plot['feature']['attrs']['cad_cost']
                ]);
            }
        }
    }

    public function test_if_plot_can_be_created() {
        $plot = Plot::factory()->create();
        $this->assertModelExists($plot);
    }

    public function test_task_list_can_be_retrieved()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            []
        );

        $response = $this->get('/api/test/plots');
        $response->assertOk();
    }



}
