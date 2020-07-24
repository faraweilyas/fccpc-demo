<?php

use Illuminate\Database\Seeder;
use App\Models\ChecklistGroup;

class ChecklistGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $checklist_groups = [ 
	        [ 
	          'name'  => 'Letter of intent to merge',
	          'label' => 'Letter of intent to merge',
	        ],
	        [ 
	          'name'  => 'Information Memorandum',
	          'label' => 'Information Memorandum',
	        ],
	        [ 
	          'name'  => 'Consent and resolution documents',
	          'label' => 'Consent and resolution documents',
	        ],
	        [ 
	          'name'  => 'Incorporation Documents',
	          'label' => 'Incorporation Documents',
	        ],
	        [ 
	          'name'  => 'Transaction Agreement and regulatory approval/no-objection',
	          'label' => 'Transaction Agreement and regulatory approval/no-objection',
	        ],
	        [ 
	          'name'  => 'Financials',
	          'label' => 'Financials',
	        ],
	    ];
	    $id = 1;
	    foreach($checklist_groups as $group)
	    {
	        ChecklistGroup::create([
	        	'id'   => $id,
	           'name'  => $group['name'],
	           'label' => $group['label'],
	        ]);
	        $id++;
	   	}
    }
}
