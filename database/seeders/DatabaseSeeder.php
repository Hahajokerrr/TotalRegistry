<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Company;
use App\Models\Country;
use App\Models\Person;
use App\Models\Province;
use App\Models\purpose;
use App\Models\Series;
use App\Models\Ward;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Buihuycuong\Vnfaker\VNFaker;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create('vi_VN');

        // \App\Models\User::factory()->create([
        //     'name'=>"Test user",
        //     'email'=>"test@gmail.com",
        //     'password' => "password",
        //     'is_admin' => true
        // ]);

        // \App\Models\User::factory()->create([
        //     'name'=>"Test user",
        //     'email'=>"test1@gmail.com",
        //     'password' => "password",
        // ]);

        // \App\Models\Listing::factory(2)->create([
        //     'by_user_id' => 1
        // ]);
        // \App\Models\Listing::factory(10)->create([
        //     'by_user_id' => 2
        // ]);

        // $faker = Faker::create('vi_VN');
        // //$faker->addProvider(new VietnamAddressProvider($faker));
        // for ($i = 0; $i < 300; $i++) {
        //     Country::factory()->create([
        //         'country_name' => $faker->unique()->country,
        //     ]);
        // }

        // $provinces = vnfaker()->city($array = true);
        // for ($i = 0; $i < 63; $i++) {
        //     Province::factory()->create([
        //         'province_name' => $provinces[$i]
        //     ]);
        // }


        // $companies = [
        //     'Toyota',
        //     'Volkswagen',
        //     'Ford',
        //     'Honda',
        //     'Chevrolet',
        //     'Nissan',
        //     'Mercedes-Benz',
        //     'BMW',
        //     'Hyundai',
        //     'Kia',
        //     'Audi',
        //     'Subaru',
        //     'Mitsubishi',
        //     'Mazda',
        //     'Volvo',
        //     'Peugeot',
        //     'Renault',
        //     'Fiat',
        //     'Jeep',
        //     'Land Rover'
        // ];

        // for($i=0; $i<count($companies); $i++) {
        //     Brand::create([
        //         'brand_name' => $companies[$i],
        //     ]);
        // }


        // $seriesNames = [
        //     'Accord', 'Altima','Avalon','Beetle','Camaro','Camry','Charger','Cherokee','Civic','Corolla','CR-V','Crosstrek','Cruze',
        //     'CX-5','CX-9','Durango','Eclipse','Edge','Elantra','Enclave','Equinox','Escape','Expedition','Explorer','F-150','Fiesta',
        //     'Focus','Forester','Forte','Fusion','Ghibli','GLA','GLC','Golf','Grand Caravan','Grand Cherokee','Highlander','Impala','Jetta','Journey','Kicks','Kona','LaCrosse','Legacy','Malibu','Mazda3','Mazda6','Model 3','Model X','Murano','Mustang','Navigator','Odyssey','Optima','Outback','Pacifica','Pathfinder','Pilot','Q3','Q5','Q7','Ranger','Rav4','Renegade','Ridgeline','Rio','Rogue','S4','Santa Fe','Sentra','Sienna','Silverado','Sonata','Sorento','Soul','Sportage','Stinger','Suburban','Tacoma','Tahoe','Terrain','Tiguan','Touareg','Town & Country','Traverse','Tucson','Tundra','Venza','Versa','Volt','Wrangler','X1','X3','X4','X5','Yaris','Yukon'
        // ];


        // $countryIds = Country::pluck('id')->toArray();
        // $brandIds = Brand::pluck('id')->toArray();

        // for($i=0; $i<count($seriesNames); $i++) {
        //     Series::create([
        //         'series_name' => $seriesNames[$i],
        //         'brand_id' => $faker->randomElement($brandIds),
        //         'country_id' => $faker->randomElement($countryIds),
        //         'length' => $faker->numberBetween(300, 1500),
        //         'width' => $faker->numberBetween(150, 400),
        //         'height' => $faker->numberBetween(200, 400),
        //         'weight' => $faker->numberBetween(1000, 10000),
        //         'payload' => $faker->numberBetween(500, 2000) * 10,
        //         'seat' => $faker->numberBetween(5, 50),
        //         'output' => $faker->numberBetween(80, 500),
        //     ]);
        // }

        // $citizen_id = [];

        // for($i=0; $i<200; $i++) {
        //     $firstThree = $faker->numberBetween(1, 99);
        //     if ($firstThree < 10) {
        //         $firstThree = '00' . $firstThree;
        //     } else if ($firstThree < 100) {
        //         $firstThree = '0' . $firstThree;
        //     }
        //     // Generate the next 3 characters in format 'abc'
        //     $a = $faker->numberBetween(0, 3);
        //     if ($a < 2) {
        //         $b = $faker->numberBetween(40, 99);
        //     } else {
        //         $b = $faker->numberBetween(0, 4);
        //         if ($b < 10) {
        //             $b = '0' . $b;
        //         }
        //     }
        //     $abc = $a . $b;
        //     // Generate the last 6 characters randomly
        //     $lastSix = $faker->numerify('######');
        //     // Combine all parts into the final string
        //     $randomString = $firstThree . $abc . $lastSix;
        //     $citizen_id[$i] = $randomString;
        // }


        // $wardIds = Ward::pluck('code')->toArray();
        // for ($i = 0; $i < 200; $i++) {

        //     Person::create([
        //         'name' => vnfaker()->fullname(),
        //         'citizen_id' => $faker->unique()->randomElement($citizen_id),
        //         'dob' => $faker->dateTimeBetween('1940-01-01', '2004-12-31')->format('Y-m-d'),
        //         'ward_code' => $faker->randomElement($wardIds),
        //         'phone' => $faker->unique()->regexify('^0[0-9]{9}$'),
        //         'email' => $faker->unique()->email(),
        //         'gender' => $faker->randomElement(["nam", "nữ"])
        //     ]);
        // }

        // $wardIds = Ward::pluck('code')->toArray();

        // $companies =[];
        // for($i=0; $i<100; $i++) {
        //     $companies[$i] = vnfaker()->company();
        // }

        // for ($i = 0; $i < 50; $i++) {
        //     Company::create([
        //         'name' => $faker->unique()->randomElement($companies),
        //         'ward_code' => $faker->randomElement($wardIds),
        //         'phone' => $faker->unique()->regexify('^0[0-9]{9}$'),
        //         'email' => $faker->unique()->email(),
        //     ]);
        // }

        $persons = Person::all();
        $companies = Company::all();
        $provinceIds = Province::pluck('id')->toArray();
        $seriesIds = Series::pluck('id')->toArray();
        $purposeIds = Purpose::pluck('id')->toArray();


        for ($i = 0; $i < 20; $i++) {
                $car = new Car();
                $car->registration_no = $faker->unique()->randomElement([
                    $faker->regexify('\d{2}-[A-Z]\d \d{5}'),
                    $faker->regexify('\d{2}-[A-Z]\d \d{4}')
                ]);
                $car->registration_code  = $faker->unique()->regexify('[A-Z0-9]{12}');
                $car->owner_type = $faker->randomElement(['App\Models\Person', 'App\Models\Company']);
                if ($car->owner_type === 'App\Models\Person') {
                    $car->owner_id = $faker->randomElement($persons)->id;
                } else {
                    $car->owner_id = $faker->randomElement($companies)->id;
                }
                $car->province_id = 27;
                $car->registration_date = $faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d');
                $car->series_id = $faker->randomElement($seriesIds);
                $car->engine_no = $faker->regexify('[A-Z0-9]{10}');
                $car->chasis_no = $faker->regexify('[A-Z0-9]{15}');
                $car->purpose_id = $faker->randomElement($purposeIds);
                $car->save();
            }

        // $car_ids = Car::pluck('id')->toArray();

        // for ($i = 0; $i < 200; $i++) {
        //         $listing = new \App\Models\Listing();
        //         $listing->by_user_id = 3;
        //         $listing->car_id = $faker->unique()->randomElement($car_ids);
        //         $listing->inspection_date = $faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d');
        //         $listing->listing_code = $faker->unique()->regexify('[A-Z0-9]{12}');
        //         $expiration_date = \Carbon\Carbon::now()->addDays((rand(1,30)));
        //         $listing->expiration_date = $expiration_date->format('Y-m-d');
        //         $listing->save();
        //     }

    }
}
