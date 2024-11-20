<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RelationshipSeeder extends Seeder
{
    public function run(): void
    {
        $relationships = [
            'Child',
            'Grandchild',
            'Sibling',
            'Spouse',
            'Parent',
            'Aunt',
            'Uncle',
            'Niece',
            'Nephew',
            'Cousin',
            'Grandparent',
            'Mother-in-law',
            'Father-in-law',
            'Brother-in-law',
            'Sister-in-law',
            'Stepchild',
            'Stepparent',
            'Stepsibling',
        ];


        foreach ($relationships as $relationship) {
            DB::table('relationship_list')->insert([
                'relationship' => $relationship,
            ]);
        }
    }
}
