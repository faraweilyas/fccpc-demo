<?php

use App\Models\User;
use App\Models\Cases;

dd(\Hash::make('password'), \Hash::make("17NileStreet"));

$search             = $_GET['query']            ?? "";
$case_type1         = $_GET['case_type1']       ?? "";
$case_type2         = $_GET['case_type2']       ?? "";
$case_category1     = $_GET['case_category1']   ?? "";
$case_category2     = $_GET['case_category2']   ?? "";
$case_category3     = $_GET['case_category3']   ?? "";
$case_state1        = $_GET['case_state1']      ?? "";
$case_state2        = $_GET['case_state2']      ?? "";

$case_types         = (!empty($case_type1) || !empty($case_type2))
                    ? array_filter([$case_type1, $case_type2])
                    : \AppHelper::keys('case_types');
$case_categories    = (!empty($case_category1) || !empty($case_category2) || !empty($case_category3))
                    ? array_filter([$case_category1, $case_category2, $case_category3])
                    : \AppHelper::keys('case_categories');
$case_states        = (!empty($case_state1) || !empty($case_state2))
                    ? array_filter([$case_state1, $case_state2])
                    : ["open", "closed"];

dump($search, $case_types, $case_categories, $case_states);
        // => function($query)
        // {
        //     $query->whereIn('case_handler.approval_status', ['approved']);
        // }
        // ])
$cases = Cases::with(['publication', 'active_handlers'])
            ->where('subject', 'like', '%'.$search.'%')
            ->orWhereIn('case_type', $case_types)
            ->orWhereIn('case_category', $case_categories)
            ->orderBy('id', 'DESC')
            ->paginate(10)
            ->reject(function($case) use ($case_states)
            {
                $reject = TRUE;

                if (!is_null($case->publication)):

                    $reject = FALSE;

                    // if ($case->isApprovalApproved() AND in_array("closed", $case_states))
                    //     $reject = FALSE;

                    // if (!$case->isApprovalApproved() AND in_array("open", $case_states))
                    //     $reject = FALSE;

                endif;

                    $reject = FALSE;
                return $reject;
            });

dd($cases->toArray());

$case           = Cases::find(1);
// $oldUser        = User::find(6);
// $newUser        = User::find(11);
// $supervisor     = User::find(5);
// return $case->reAssign($oldUser, $newUser, $supervisor);

// foreach(User::all() as $user)
// {
//     $user->notify(new NewUser(
//         "newuser",
//         "Hi {$user->getFirstName()}, Welcome to FCCPC - Mergers & Acquisition Platform.",
//         $user,
//         config('app.default_password')
//     ));
// }

// $user->notifications[0]->markAsRead();
// $user->notifications()->where('id', "fca8faa8-1557-490c-ba6b-9e48c339caba")->markAsRead();

// foreach (Cases::all() as $case)
// {
//     $case->subject = str_split($case->subject, 50)[0];
//     $case->amount_paid = rand(5000000, 10000000);
//     $case->save();
// }

// $documents = [];
// foreach (Cases::all() as $case)
// {
//     foreach ($case->documents as $document)
//     {
//         $document->date_case_submitted = $case->submitted_at;
//         $document->group_id = (!$document->checklists->isEmpty())
//             ? $document->checklists->first()->group->id
//             : NULL;
//         $document->save();
//         $documents[] = $document;
//     }
// }

// $submittedDocuments = $case->submittedDocuments();
// foreach ($submittedDocuments as $date => $documents)
// {
//     foreach ($documents as $document)
//     {
//         $checklists = $document->checklists;
//         $group      = $document->group;
//     }
// }
// $date = "2020-11-17 09:40:46";
// $submittedDocument = $case->getSubmittedDocumentByDate($date);

return [
    'applicationforms'      => $case->formatApplicationForms(),
    'notifications'         => $user->notifications,
    'unreadNotifications'   => $user->unreadNotifications,
    'readNotifications'     => $user->readNotifications,

    // $documents,
    // $case,
    // $case->documents,
    // $case->guest,
    // $case->isDeficient(),
    // $case->getDeficientGroupIds(),
    // $case->getCaseSubmittedChecklistByStatus('deficient'),
    // Gets all latest submitted document checklist, either approved, deficient or null
    // $case->getLatestSubmittedDocumentChecklists(),
    // Gets all latest submitted document checklist by specified status, default is deficient
    // $case->getLatestSubmittedDocumentChecklistsByStatus('deficient')->groupBy('group_id')->toArray(),
    // Gets all latest submitted document checklist IDs by specified status, default is deficient
    // $case->getLatestSubmittedDocumentChecklistsIDs('deficient'),
    // Gets all latest submitted document checklist group IDs by specified status, default is deficient
    // $case->getLatestSubmittedDocumentChecklistsGroupIDs('deficient'),
    // Gets all latest submitted document checklist groups by specified status, default is deficient
    // $case->getLatestSubmittedDocumentChecklistsGroups('deficient'),
    // Gets all latest submitted document checklist group names by specified status, default is deficient
    // $case->getLatestSubmittedDocumentChecklistsGroupNames('deficient'),

    // $submittedDocuments,
    // $submittedDocument,
    // $case->getSubmittedDocumentChecklistByDateAndStatus($date),
    // $case->unSubmittedDocuments(),
    // $case->getChecklistGroupUnSubmittedDocuments(),
    // $case->getChecklistGroupUnSubmittedDocumentsName(),
];
