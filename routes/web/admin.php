<?php

use Illuminate\Support\Facades\Route;

// Application
Route::prefix('application')
    ->name('application.')
    ->namespace('Backend')
    ->middleware('XssSanitizer')
    ->group(function()
    {
        Route::get(
            'test',
            'ApplicationController@test'
        )
        ->name('test');

        Route::get(
            'checklist/{guest:tracking_id}/{case_category}',
            'ApplicationController@checklistDocuments'
        )
        ->name('checklist-documents');

        Route::get(
            'select/{guest:tracking_id}',
            'ApplicationController@index'
        )
        ->name('index');

        Route::post(
            'create/{guest:tracking_id}/{action}',
            'ApplicationController@create'
        )
        ->name('create');

        Route::post(
            'submit/{guest:tracking_id}',
            'ApplicationController@submit'
        )
        ->name('submit');

        Route::post(
            'submit-deficient/{guest:tracking_id}',
            'ApplicationController@submitDeficient'
        )
        ->name('submit.deficient');

        Route::get(
            'submitted/{guest:tracking_id}',
            'ApplicationController@applicationSubmitted'
        )
        ->name('submitted');

        Route::get(
            'upload/documents/{guest:tracking_id}',
            'ApplicationController@uploadDocuments'
        )
        ->name('upload');

        Route::get(
            '{guest:tracking_id}/{case_category}',
            'ApplicationController@show'
        )
        ->name('show');

        Route::get(
            'applicant/download-form/{form}',
            'ApplicationController@downloadForm'
        )
        ->name('download_form');

        Route::get(
            'applicant/{guest:tracking_id}/review/{step}',
            'ApplicationController@review'
        )
        ->name('review');

        Route::get(
            'applicant/{guest:tracking_id}/review-deficient/{step}',
            'ApplicationController@reviewDeficient'
        )
        ->name('review.deficient');
    });

// Enquiries
Route::prefix('pre-notifications')
    ->name('enquiries.')
    ->namespace('Backend')
    ->middleware('XssSanitizer')
    ->group(function()
    {
        Route::get(
            'select',
            'EnquiriesController@index'
        )
        ->name('index');

        Route::get(
            'all',
            'EnquiriesController@logs'
        )
        ->name('logs')
        ->middleware('auth');

        Route::post(
            'assign/handler',
            'EnquiriesController@assignLog'
        )
        ->name('assign')
        ->middleware('auth');

        Route::get(
            'file/download/{file}',
            'EnquiriesController@download'
        )
        ->name('download')
        ->middleware('auth');

        Route::get(
            '{type}',
            'EnquiriesController@create'
        )
        ->name('create');

        Route::post(
            '/',
            'EnquiriesController@store'
        )
        ->name('store');
    });

// FAQ
Route::prefix('faq')
    ->name('faq.')
    ->namespace('Backend')
    ->middleware(['auth', 'XssSanitizer'])
    ->group(function()
    {
        Route::get('create', 'FaqController@create')->name('create');

        Route::post('create', 'FaqController@store')->name('create');

        Route::get('edit/{faq}', 'FaqController@edit')->name('edit');

        Route::post('edit/{faq}', 'FaqController@update')->name('update');

        Route::get('all', 'FaqController@index')->name('faqs');

        Route::get('detail/{faq}', 'FaqController@viewFaqDetail')->name(
            'faq_detail'
        );

        Route::get('faq/{faq}', 'FaqController@destroy')->name('delete');
    });

// User
Route::prefix('/')
    ->name('dashboard.')
    ->namespace('Backend')
    ->middleware('XssSanitizer')
    ->group(function()
    {
        Route::get('dashboard', 'DashboardController@index')->name('index');

        Route::get('user/create', 'DashboardController@createUser')->name(
            'create_user'
        );

        Route::post('user/create', 'DashboardController@storeUser')->name(
            'user_store'
        );

        Route::get('users', 'DashboardController@viewUsers')->name('users');

        Route::get(
            'users/status/update/{id}',
            'DashboardController@updateUserStatus'
        )
        ->name('update_users_status');

        Route::get(
            'profile/update',
            'DashboardController@viewProfileUpdate'
        )
        ->name('update_profile');

        Route::post(
            'profile/update',
            'DashboardController@updateProfile'
        )
        ->name('update_user_profile');

        Route::get(
            'id-requests',
            'DashboardController@viewIDRequests'
        )
        ->name('id_requests');

        Route::get(
            'suggested-cases/{id}',
            'DashboardController@viewSuggestedCases'
        )
        ->name('suggested_cases');

        Route::get(
            'send-id/{case}/{request_id}',
            'DashboardController@sendCaseID'
        )
        ->name('send_id');

        Route::get(
            'profile/{user?}',
            'DashboardController@viewProfile'
        )
        ->name('profile');

        Route::get('mark-notifications', 'DashboardController@markNotifications')->name('mark_notifications');

        Route::get('clear-notification', 'DashboardController@clearReadNotification')->name('clear_notification');

        Route::get('report/{show}', 'DashboardController@generateReportTable')->name(
            'report.show'
        );

        Route::get('report-amount-paid/{category}', 'DashboardController@getGeneratedAmountPaidReport')->name(
            'report.amount_paid'
        );

        Route::get('report', 'DashboardController@generateReport')->name(
            'report'
        );

        Route::get('report/{start_date_end_date}/{category}/{type}', 'DashboardController@exportReportCSV')->name(
            'report.export'
        );
    });

// Cases
Route::prefix('cases')
    ->name('cases.')
    ->namespace('Backend')
    ->middleware('XssSanitizer')
    ->group(function()
    {
        Route::get('search', 'CasesController@searchCases')->name('search');

        Route::get('new', 'CasesController@unassignedCases')->name(
            'unassigned'
        );

        Route::get(
            'all/{handler?}',
            'CasesController@allCases'
        )->name('all');

        Route::get(
            'assigned/{handler?}',
            'CasesController@assignedCases'
        )->name('assigned');

        Route::get('dropped/{handler}', 'CasesController@droppedCases')->name(
            'dropped'
        );

        Route::get(
            'ongoing/{handler?}',
            'CasesController@workingonCases'
        )->name('working_on');

        Route::get(
            'approved/{handler?}',
            'CasesController@approvedCases'
        )->name('approved');

        Route::get(
            'on-hold/{handler?}',
            'CasesController@onholdCases'
        )->name('on-hold');

        Route::get(
            'archived',
            'CasesController@archivedCases'
        )->name('archived');

        Route::get(
            'archive/{case}',
            'CasesController@archiveCase'
        )->name('archive');

        Route::get(
            'form-1A/generate-pdf/{case}',
            'CasesController@generateForm1APdf'
        )->name('generate_form1A_pdf');

        Route::get(
            'analyze/{case}',
            'CasesController@analyzeCase'
        )->name('analyze');

        Route::get(
            'publish/{case}',
            'CasesController@publishCase'
        )->name('publish')->withoutMiddleware('XssSanitizer');

        Route::post(
            'publish/{case}',
            'CasesController@strorePublishCase'
        )->name('cases.publish')->withoutMiddleware('XssSanitizer');

        Route::get(
            'analyze-documents/{case}',
            'CasesController@analyzeCaseDocuments'
        )->name('analyze-documents');

        Route::get(
            'checklist-approval/{case}/{date}',
            'CasesController@checklistApproval'
        )->name('checklist-approval');

        Route::get(
            'review-checklist-approval/{case}/{date}',
            'CasesController@reviewChecklistApproval'
        )->name('review-checklist-approval');

        Route::get(
            'checklist-status-count/{case}/{date}',
            'CasesController@getChecklistCount'
        )->name('checklist-status-count');

        Route::get(
            'checklist-by-status/{case}/{date}',
            'CasesController@getChecklistByStatus'
        )->name('checklist-by-status');

        Route::post(
            'checklist-approval/{document}',
            'CasesController@saveChecklistApproval'
        )->name('checklist-approval-submit');

        Route::post(
            'checklist-approval-reason/{document}',
            'CasesController@saveChecklistApprovalReason'
        );

        Route::post(
            'issue-deficiency/{case}/{date?}',
            'CasesController@issueDeficiency'
        )->name('issue-deficiency');

        Route::post(
            'approve-checklists/{case}',
            'CasesController@approveChecklists'
        )->name('approve-checklists');

        Route::post(
            'issue-recommendation/{case}',
            'CasesController@issueRecommendation'
        )->name('issue-recommendation');

        Route::post(
            'request-approval/{case}',
            'CasesController@requestApproval'
        )->name('request-approval');

        Route::post(
            'resolve-recommendation/{case}',
            'CasesController@resolveRecommendation'
        )->name('resolve-recommendation');

        Route::post(
            'assign/{case}/{user}',
            'CasesController@assignCase'
        )->name('assign');

        Route::post(
            'update-working-on/{case}/{user}',
            'CasesController@updateWorkingOn'
        )->name('update_working_on');

        Route::get(
            'checklists/{case}',
            'CasesController@caseChecklists'
        )->name('checklists');

        Route::get('documents/{case}', 'CasesController@caseDocuments')->name(
            'documents'
        );

        Route::get(
            'document/icon/{document}',
            'CasesController@getDocumentIconText'
        )->name('documents');

        Route::post(
            'unassign/{case}/{user}',
            'CasesController@unassignCase'
        )->name('unassign');

        Route::post(
            'reassign/{case}/{old_user}/{new_user}',
            'CasesController@reassignCase'
        )->name('assign');

        Route::post(
            'update/{status}/{id}',
            'CasesController@updateCaseStatus'
        )->name('update_status');

        Route::get(
            'download-analysis-document/{document}',
            'CasesController@downloadAnalysisDocument'
        )->name('download_analysis_document');
    });

// Case Handler
Route::prefix('handlers')
    ->name('handlers.')
    ->namespace('Backend')
    ->middleware('XssSanitizer')
    ->group(function()
    {
        Route::get('/', 'CaseHandlersController@index')->name('index');

        Route::get('create', 'CaseHandlersController@create')->name('create');

        Route::post('create', 'CaseHandlersController@storeHandler')->name(
            'store'
        );

        Route::get(
            'status/update/{handler}',
            'CaseHandlersController@updateHandlerStatus'
        )->name('update_status');

        Route::get('view/{id}', 'CaseHandlersController@show')->name('view');
    });
