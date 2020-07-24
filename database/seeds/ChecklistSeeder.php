<?php

use App\Models\Checklist;
use Illuminate\Database\Seeder;

class ChecklistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $checklists = [ 
	        [ 
	          'group_id'  => 1,
	          'name'  	  => 'Letter of intent to merge',
	          'label' 	  => 'Letter of intent to merge',
	        ],
	        [ 
	          'group_id'  => 2,
	          'name'  	  => 'Background of the transaction, including any preliminary and final studies (if available) regarding the subject of consideration.',
	          'label' 	  => 'Background of the transaction, including any preliminary and final studies (if available) regarding the subject of consideration.',
	        ],
	        [ 
	          'group_id'  => 2,
	          'name'  	  => 'Detailed information about products and all stock keeping units of Target, Acquirer and Holder specifying produced, imported or exported.',
	          'label' 	  => 'Detailed information about products and all stock keeping units of Target, Acquirer and Holder specifying produced, imported or exported.',
	        ],
	        [ 
	          'group_id'  => 2,
	          'name'  	  => 'Identify specific competitor products that are considered equivalent substitute or otherwise interchangeable with products between Target, Acquirer and or Holder and other competitors',
	          'label' 	  => 'Identify specific competitor products that are considered equivalent substitute or otherwise interchangeable with products between Target, Acquirer and or Holder and other competitors',
	        ],
	        [ 
	          'group_id'  => 2,
	          'name'  	  => 'List of competitors',
	          'label' 	  => 'List of competitors',
	        ],
	        [ 
	          'group_id'  => 2,
	          'name'  	  => 'Market Share of the Target, Acquirer and of competitors.',
	          'label' 	  => 'Market Share of the Target, Acquirer and of competitors.',
	        ],
	        [ 
	          'group_id'  => 2,
	          'name'  	  => 'Turnover/revenue of Target, Acquirer, and or Holder.',
	          'label' 	  => 'Turnover/revenue of Target, Acquirer, and or Holder.',
	        ],
	        [ 
	          'group_id'  => 2,
	          'name'  	  => 'Any business relationships between Target, Acquirer and or Holder currently existing.',
	          'label' 	  => 'Any business relationships between Target, Acquirer and or Holder currently existing.',
	        ],
	        [ 
	          'group_id'  => 2,
	          'name'  	  => 'Competition Analysis. [S.94]',
	          'label' 	  => 'Competition Analysis. [S.94]',
	        ],
	        [ 
	          'group_id'  => 2,
	          'name'  	  => 'Effect of the Transaction on the relevant market including, any material post transaction changes to the market position and share of emergent organization.',
	          'label' 	  => 'Effect of the Transaction on the relevant market including, any material post transaction changes to the market position and share of emergent organization.',
	        ],
	        [ 
	          'group_id'  => 2,
	          'name'  	  => 'Structure and Organization of the Target and Acquirer',
	          'label' 	  => 'Structure and Organization of the Target and Acquirer',
	        ],
	        [ 
	          'group_id'  => 2,
	          'name'  	  => 'Identify geographic market segment/areas in Nigeria where specific products of Target, Acquirer and or Holder.',
	          'label' 	  => 'Identify geographic market segment/areas in Nigeria where specific products of Target, Acquirer and or Holder.',
	        ],
	        [ 
	          'group_id'  => 2,
	          'name'  	  => 'Any goods or ancillary goods or service providers or suppliers that are mutual to Target, Acquirer and Holder.',
	          'label' 	  => 'Any goods or ancillary goods or service providers or suppliers that are mutual to Target, Acquirer and Holder.',
	        ],
	        [ 
	          'group_id'  => 2,
	          'name'  	  => 'Market Analysis (s 71)',
	          'label' 	  => 'Market Analysis (s 71)',
	        ],
	        [ 
	          'group_id'  => 2,
	          'name'  	  => 'Any interest in or relationship with goods or service providers or suppliers.',
	          'label' 	  => 'Any interest in or relationship with goods or service providers or suppliers.',
	        ],
	        [ 
	          'group_id'  => 3,
	          'name'  	  => 'Extract of Board Resolutions of the Merging Companies duly certified by a Director and the Company Secretary',
	          'label' 	  => 'Extract of Board Resolutions of the Merging Companies duly certified by a Director and the Company Secretary',
	        ],
	        [ 
	          'group_id'  => 3,
	          'name'  	  => 'Signed and notarized consent letters of Directors and Parties to the merger',
	          'label' 	  => 'Signed and notarized consent letters of Directors and Parties to the merger',
	        ],
	        [ 
	          'group_id'  => 3,
	          'name'  	  => '2 Copies of draft Proxy forms for each of the merging parties',
	          'label' 	  => '2 Copies of draft Proxy forms for each of the merging parties',
	        ],
	        [ 
	          'group_id'  => 3,
	          'name'  	  => 'Evidence of dispatch of Scheme documents to the shareholders of the merging undertakings',
	          'label' 	  => 'Evidence of dispatch of Scheme documents to the shareholders of the merging undertakings',
	        ],
	        [ 
	          'group_id'  => 3,
	          'name'  	  => 'A copy of the letter appointing the Financial Adviser(s)',
	          'label' 	  => 'A copy of the letter appointing the Financial Adviser(s)',
	        ],
	        [ 
	          'group_id'  => 4,
	          'name'  	  => 'Copies of the Certificates of Incorporation of the merging entities certified by the Company Secretary [S.92]',
	          'label' 	  => 'Copies of the Certificates of Incorporation of the merging entities certified by the Company Secretary [S.92]',
	        ],
	        [ 
	          'group_id'  => 4,
	          'name'  	  => 'Certified True Copy (CTC) of CAC Form(s) showing Statement of Share Capital, Return of Allotment, and particulars of directors. This should bear the original stamp of the CAC. [S.92]',
	          'label' 	  => 'Certified True Copy (CTC) of CAC Form(s) showing Statement of Share Capital, Return of Allotment, and particulars of directors. This should bear the original stamp of the CAC. [S.92]',
	        ],
	        [ 
	          'group_id'  => 4,
	          'name'  	  => 'Memorandum and Articles of Association of the merging entities duly certified by CAC',
	          'label' 	  => 'Memorandum and Articles of Association of the merging entities duly certified by CAC',
	        ],
	        [ 
	          'group_id'  => 5,
	          'name'  	  => '2 hard copies of Scheme Document and an electronic copy',
	          'label' 	  => '2 hard copies of Scheme Document and an electronic copy',
	        ],
	        [ 
	          'group_id'  => 5,
	          'name'  	  => 'Draft Financial Services Agreement between the merging parties and their Financial Advisers',
	          'label' 	  => 'Draft Financial Services Agreement between the merging parties and their Financial Advisers',
	        ],
	        [ 
	          'group_id'  => 5,
	          'name'  	  => 'Copy of merger implementation agreement and any other agreements executed by the merging parties (where applicable)',
	          'label' 	  => 'Copy of merger implementation agreement and any other agreements executed by the merging parties (where applicable)',
	        ],
	        [ 
	          'group_id'  => 5,
	          'name'  	  => 'Evidence of increase in Authorized Share Capital (where necessary)',
	          'label' 	  => 'Evidence of increase in Authorized Share Capital (where necessary)',
	        ],
	        [ 
	          'group_id'  => 5,
	          'name'  	  => 'Agreement between the Companies and their Shareholders’ Representatives(where applicable)',
	          'label' 	  => 'Agreement between the Companies and their Shareholders’ Representatives(where applicable)',
	        ],
	        [ 
	          'group_id'  => 5,
	          'name'  	  => 'A letter of undertaking to file evidence of settlement of all tax liabilities with the Federal Inland Revenue Services (FIRS)',
	          'label' 	  => 'A letter of undertaking to file evidence of settlement of all tax liabilities with the Federal Inland Revenue Services (FIRS)',
	        ],
	        [ 
	          'group_id'  => 5,
	          'name'  	  => 'A letter of “No objection” from the Companies’ Regulator(s) (where applicable) [S.105]',
	          'label' 	  => 'A letter of “No objection” from the Companies’ Regulator(s) (where applicable) [S.105]',
	        ],
	        [ 
	          'group_id'  => 6,
	          'name'  	  => 'Certificate of capital importation (where applicable)',
	          'label' 	  => 'Certificate of capital importation (where applicable)',
	        ],
	        [ 
	          'group_id'  => 6,
	          'name'  	  => 'List of claims and litigation of the merging parties',
	          'label' 	  => 'List of claims and litigation of the merging parties',
	        ],
	        [ 
	          'group_id'  => 6,
	          'name'  	  => 'Evidence of payment of processing fee as well as fees for proxy materials as captured in the Appendix on Fees',
	          'label' 	  => 'Evidence of payment of processing fee as well as fees for proxy materials as captured in the Appendix on Fees',
	        ],
	        [ 
	          'group_id'  => 6,
	          'name'  	  => 'The Audited Accounts of the merging entities for the preceding Three (3 ) year. [S. 93]',
	          'label' 	  => 'The Audited Accounts of the merging entities for the preceding Three (3 ) year. [S. 93]',
	        ],
	        [ 
	          'group_id'  => 6,
	          'name'  	  => 'Evidence of payment of merger filing fee of N50, 000.00 (Fifty Thousand Naira only) per merging entity. [S23 (2)(d)]',
	          'label' 	  => 'Evidence of payment of merger filing fee of N50, 000.00 (Fifty Thousand Naira only) per merging entity. [S23 (2)(d)]',
	        ],
	    ];
	    $id = 1;
	    foreach($checklists as $checklist)
	    {
	        Checklist::create([
	           'id'        => $id,
	           'group_id'  => $checklist['group_id'],
	           'name'      => $checklist['name'],
	           'label'     => $checklist['label'],
	        ]);
	        $id++;
	   	}
    }
}
