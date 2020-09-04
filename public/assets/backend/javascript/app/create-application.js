$(document).ready(function()
{
    toastr.options = {
        "progressBar": true,
        "positionClass": "toast-bottom-right",
    };

    var _wizardEl       = KTUtil.getById('kt_wizard_v2'),
        _formEl         = KTUtil.getById('kt_form'),
        _validations    = [];
        _wizard         = new KTWizard(_wizardEl, {
                            // initial active step number
                            startStep: 1,
                            // to make steps clickable this set value true and add data-wizard-clickable="true" in HTML for class="wizard" element
                            clickableSteps: false
                        });
    // var initValidation = function () {
    //     // Step 1
    //     _validations.push(FormValidation.formValidation(
    //         _formEl,
    //         {
    //             fields: {
    //                 subject: {
    //                     validators: {
    //                         notEmpty: {
    //                             message: 'Subject field is required'
    //                         }
    //                     }
    //                 },
    //             },
    //             plugins: {
    //                 trigger: new FormValidation.plugins.Trigger(),
    //                 bootstrap: new FormValidation.plugins.Bootstrap()
    //             }
    //         }
    //     ));

    //     // Step 2
    //     _validations.push(FormValidation.formValidation(
    //         _formEl,
    //         {
    //             fields: {
    //                 representingFirm: {
    //                     validators: {
    //                         notEmpty: {
    //                             message: 'Applicant firm field is required'
    //                         }
    //                     }
    //                 },
    //                 fName: {
    //                     validators: {
    //                         notEmpty: {
    //                             message: 'First name field is required'
    //                         }
    //                     }
    //                 },
    //                 lName: {
    //                     validators: {
    //                         notEmpty: {
    //                             message: 'Last Name field is required'
    //                         }
    //                     }
    //                 },
    //                 phone: {
    //                     validators: {
    //                         notEmpty: {
    //                             message: 'Phone Number field is required'
    //                         }
    //                     }
    //                 },
    //                 address: {
    //                     validators: {
    //                         notEmpty: {
    //                             message: 'Address field is required'
    //                         }
    //                     }
    //                 },
    //                 email: {
    //                     validators: {
    //                         notEmpty: {
    //                             message: 'Email field is required'
    //                         },
    //                         emailAddress: {
    //                             message: 'The value is not a valid email address'
    //                         }
    //                     }
    //                 }
    //             },
    //             plugins: {
    //                 trigger: new FormValidation.plugins.Trigger(),
    //                 bootstrap: new FormValidation.plugins.Bootstrap()
    //             }
    //         }
    //     ));

    //     // Step 3
    //     _validations.push(FormValidation.formValidation(
    //         _formEl,
    //         {
    //             // fields: {
    //             //  company_doc: {
    //             //      validators: {
    //             //          notEmpty: {
    //             //              message: 'Company Doc is required'
    //             //          }
    //             //      }
    //             //  },
    //             // },
    //             plugins: {
    //                 trigger: new FormValidation.plugins.Trigger(),
    //                 bootstrap: new FormValidation.plugins.Bootstrap()
    //             }
    //         }
    //     ));

    //     // Step 4
    //     _validations.push(FormValidation.formValidation(
    //         _formEl,
    //         {
    //             fields: {
    //                 // locaddress1: {
    //                 //  validators: {
    //                 //      notEmpty: {
    //                 //          message: 'Address is required'
    //                 //      }
    //                 //  }
    //                 // },
    //                 // locpostcode: {
    //                 //  validators: {
    //                 //      notEmpty: {
    //                 //          message: 'Postcode is required'
    //                 //      }
    //                 //  }
    //                 // },
    //                 // loccity: {
    //                 //  validators: {
    //                 //      notEmpty: {
    //                 //          message: 'City is required'
    //                 //      }
    //                 //  }
    //                 // },
    //                 // locstate: {
    //                 //  validators: {
    //                 //      notEmpty: {
    //                 //          message: 'State is required'
    //                 //      }
    //                 //  }
    //                 // },
    //                 // loccountry: {
    //                 //  validators: {
    //                 //      notEmpty: {
    //                 //          message: 'Country is required'
    //                 //      }
    //                 //  }
    //                 // }
    //             },
    //             plugins: {
    //                 trigger: new FormValidation.plugins.Trigger(),
    //                 bootstrap: new FormValidation.plugins.Bootstrap()
    //             }
    //         }
    //     ));

    //     // Step 5
    //     _validations.push(FormValidation.formValidation(
    //         _formEl,
    //         {
    //             fields: {
    //                 // ccname: {
    //                 //  validators: {
    //                 //      notEmpty: {
    //                 //          message: 'Credit card name is required'
    //                 //      }
    //                 //  }
    //                 // },
    //                 // ccnumber: {
    //                 //  validators: {
    //                 //      notEmpty: {
    //                 //          message: 'Credit card number is required'
    //                 //      },
    //                 //      creditCard: {
    //                 //          message: 'The credit card number is not valid'
    //                 //      }
    //                 //  }
    //                 // },
    //                 // ccmonth: {
    //                 //  validators: {
    //                 //      notEmpty: {
    //                 //          message: 'Credit card month is required'
    //                 //      }
    //                 //  }
    //                 // },
    //                 // ccyear: {
    //                 //  validators: {
    //                 //      notEmpty: {
    //                 //          message: 'Credit card year is required'
    //                 //      }
    //                 //  }
    //                 // },
    //                 // cccvv: {
    //                 //  validators: {
    //                 //      notEmpty: {
    //                 //          message: 'Credit card CVV is required'
    //                 //      },
    //                 //      digits: {
    //                 //          message: 'The CVV value is not valid. Only numbers is allowed'
    //                 //      }
    //                 //  }
    //                 // }
    //             },
    //             plugins: {
    //                 trigger: new FormValidation.plugins.Trigger(),
    //                 bootstrap: new FormValidation.plugins.Bootstrap()
    //             }
    //         }
    //     ));

    //     // Step 6
    //     _validations.push(FormValidation.formValidation(
    //         _formEl,
    //         {
    //             fields: {
    //                 // ccname: {
    //                 //  validators: {
    //                 //      notEmpty: {
    //                 //          message: 'Credit card name is required'
    //                 //      }
    //                 //  }
    //                 // },
    //                 // ccnumber: {
    //                 //  validators: {
    //                 //      notEmpty: {
    //                 //          message: 'Credit card number is required'
    //                 //      },
    //                 //      creditCard: {
    //                 //          message: 'The credit card number is not valid'
    //                 //      }
    //                 //  }
    //                 // },
    //                 // ccmonth: {
    //                 //  validators: {
    //                 //      notEmpty: {
    //                 //          message: 'Credit card month is required'
    //                 //      }
    //                 //  }
    //                 // },
    //                 // ccyear: {
    //                 //  validators: {
    //                 //      notEmpty: {
    //                 //          message: 'Credit card year is required'
    //                 //      }
    //                 //  }
    //                 // },
    //                 // cccvv: {
    //                 //  validators: {
    //                 //      notEmpty: {
    //                 //          message: 'Credit card CVV is required'
    //                 //      },
    //                 //      digits: {
    //                 //          message: 'The CVV value is not valid. Only numbers is allowed'
    //                 //      }
    //                 //  }
    //                 // }
    //             },
    //             plugins: {
    //                 trigger: new FormValidation.plugins.Trigger(),
    //                 bootstrap: new FormValidation.plugins.Bootstrap()
    //             }
    //         }
    //     ));

    //     // Step 7
    //     _validations.push(FormValidation.formValidation(
    //         _formEl,
    //         {
    //             fields: {
    //                 // ccname: {
    //                 //  validators: {
    //                 //      notEmpty: {
    //                 //          message: 'Credit card name is required'
    //                 //      }
    //                 //  }
    //                 // },
    //                 // ccnumber: {
    //                 //  validators: {
    //                 //      notEmpty: {
    //                 //          message: 'Credit card number is required'
    //                 //      },
    //                 //      creditCard: {
    //                 //          message: 'The credit card number is not valid'
    //                 //      }
    //                 //  }
    //                 // },
    //                 // ccmonth: {
    //                 //  validators: {
    //                 //      notEmpty: {
    //                 //          message: 'Credit card month is required'
    //                 //      }
    //                 //  }
    //                 // },
    //                 // ccyear: {
    //                 //  validators: {
    //                 //      notEmpty: {
    //                 //          message: 'Credit card year is required'
    //                 //      }
    //                 //  }
    //                 // },
    //                 // cccvv: {
    //                 //  validators: {
    //                 //      notEmpty: {
    //                 //          message: 'Credit card CVV is required'
    //                 //      },
    //                 //      digits: {
    //                 //          message: 'The CVV value is not valid. Only numbers is allowed'
    //                 //      }
    //                 //  }
    //                 // }
    //             },
    //             plugins: {
    //                 trigger: new FormValidation.plugins.Trigger(),
    //                 bootstrap: new FormValidation.plugins.Bootstrap()
    //             }
    //         }
    //     ));
    // }

    _wizard.on('beforeNext', function (wizard)
    {
        // Validation before going to next page
        // _validations[wizard.getStep() - 1].validate().then(function (status) {
        //     if (status == 'Valid') {
        //         _wizard.goNext();
        //         KTUtil.scrollTop();
        //     } else {
        //         swal.fire({
        //             text: "Sorry, looks like there are some errors detected, please try again.",
        //             icon: "error",
        //             buttonsStyling: false,
        //             confirmButtonText: "Ok, got it!",
        //             confirmButtonClass: "btn font-weight-bold btn-light"
        //         }).then(function () {
        //             KTUtil.scrollTop();
        //         });
        //     }
        // });

        _wizard.stop();  // Don't go to the next step
    });

    // Change event
    _wizard.on('change', function (wizard) {
        KTUtil.scrollTop();
    });

    $("#save-info").on('click', function(event)
    {
        event.preventDefault();

        var sections    = $('.pb-5'),
            currentForm = sections.filter(function(index, element) {
                            return (typeof ($(element).attr('data-wizard-state')) !== "undefined")
                        }),
            sendForm    = 'save'+currentForm.attr('data-form');

        window[sendForm](sendForm, currentForm);
        _wizard.goNext();
        KTUtil.scrollTop();
        return;
    });

    $("#upload-info").on('click', function(event)
    {
        event.preventDefault();

        swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, submit it!"
        }).then(function(result)
        {
            if (result.value)
                submitCase();
            else
                return false;
        });
    });

    var InputsWrapper   = $(".fields"),
        fieldsCounter   = InputsWrapper.length,
        FieldCount      = 1;

    $('#add-party-fields').on('click', function(event)
    {
        FieldCount++;
        $(InputsWrapper).append('<div class="field-item mt-4" id="field_'+ FieldCount +'">'+
                                    '<div class="row">'+
                                        '<div class="col-lg-5">'+
                                            '<input type="text" class="form-control" placeholder="Enter party name" name="party[]">'+
                                            '<div class="d-md-none mb-2"></div>'+
                                        '</div>'+
                                        '<div class="col-lg-5">'+
                                            '<input type="text" class="form-control" placeholder="Enter party name" name="party[]">'+
                                            '<div class="d-md-none mb-2"></div>'+
                                        '</div>'+
                                        '<div class="col-lg-2">'+
                                            '<a href="#" class="remove">'+
                                                '<span class="svg-icon svg-icon-danger svg-icon-2s">'+
                                                    '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">'+
                                                        '<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">'+
                                                            '<rect x="0" y="0" width="24" height="24"/>'+
                                                            '<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>'+
                                                            '<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>'+
                                                        '</g>'+
                                                    '</svg>'+
                                                '</span>'+
                                            '</a>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'
                                );
        fieldsCounter++;
        return false;
    });

    $(document).on("click", ".remove", function(event)
    {
        if (fieldsCounter > 1 ) {
            $(this).closest('.field-item').remove();
            fieldsCounter--;
        }

        return false;
    });
});

function notify(messageType, message)
{
    if (messageType == "success")
        toastr.success(message);

    if (messageType == "error")
        toastr.error(message);

    return;
}

function sendRequest(
    path,
    requestData,
    contentType = 'application/x-www-form-urlencoded; charset=UTF-8',
    processData = true,
    onSuccess = function(data, status)
    {
        result = JSON.parse(data);
        notify(result.responseType, result.message);
    },
    onError = function(xhr, desc, err)
    {
        notify(desc, err);
    },
    method = 'POST'
) {
    $.ajax({
        url: path,
        data: requestData,
        type: method,
        contentType: contentType,
        processData: processData,
        success: onSuccess,
        error: onError
    });
    return;
}

function saveCaseInfo(action, currentForm)
{
    var tracking_id = $("#tracking_id").val(),
        case_type   = $("input[name='case_type']:checked").val();

    sendRequest(
        '/application/create/'+tracking_id+'/'+action,
        {
            _token:         $("#token").val(),
            subject:        $("#subject").val(),
            parties:        $("input[name='party[]']").map(function() {
                                return $(this).val();
                            }).get().filter(function(party) {
                                return party != "";
                            }),
            case_type:      (typeof (case_type) === "undefined") ? '' : case_type,
        }
    );
    return;
}

function saveContactInfo(action, currentForm)
{
    var tracking_id = $("#tracking_id").val();

    sendRequest(
        '/application/create/'+tracking_id+'/'+action,
        {
            _token:                     $("#token").val(),
            applicant_firm:             $("input[name='applicant_firm']").val(),
            applicant_fullname:         $("input[name='applicant_fullname']").val(),
            applicant_email:            $("input[name='applicant_email']").val(),
            applicant_phone_number:     $("input[name='applicant_phone_number']").val(),
            applicant_address:          $("input[name='applicant_address']").val(),
        }
    );
    return;
}

function saveChecklistDocument(action, currentForm)
{
    var tracking_id        = $("#tracking_id").val(),
        formData           = new FormData(),
        checklists         = [],
        additional_info    = $(currentForm).find('#additional_info').val(),
        file               = $(currentForm).find('#checklist_doc')[0].files[0],
        checklist_doc_name = $("#checklist_doc_name").val();
        doc_id             = $("#doc_id").val();

    if(currentForm.find("#uploaded_doc").val() != '') {
        if (file) {
            swal.fire({
                title: "Are you sure?",
                text: "You want to override previously uploaded document for "+checklist_doc_name+"!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, override it!"
            }).then(function(result)
            {
                if (result.value) {
                     $(currentForm).find(':checkbox:checked').each(function(i)
                    {
                       checklists[i] = $(this).val();
                    });

                    formData.append('_token', $("#token").val());
                    formData.append('file', file);
                    formData.append('additional_info', additional_info);
                    formData.append('checklists', checklists);
                    formData.append('override', true);
                    formData.append('document_id', doc_id);

                    sendRequest(
                        '/application/create/'+tracking_id+'/'+action,
                        formData,
                        false,
                        false,
                        function(data, status)
                        {
                            result = JSON.parse(data);
                            notify(result.responseType, result.message);
                        }
                    );
                    return;
                } else {
                    return;
                }
            });
        } else {
            return;
        }
    } else {
        $(currentForm).find(':checkbox:checked').each(function(i)
        {
           checklists[i] = $(this).val();
        });

        formData.append('_token', $("#token").val());
        formData.append('file', file);
        formData.append('additional_info', additional_info);
        formData.append('checklists', checklists);
        sendRequest(
            '/application/create/'+tracking_id+'/'+action,
            formData,
            false,
            false,
            function(data, status)
            {
                result = JSON.parse(data);
                notify(result.responseType, result.message);
            }
        );
        return;
    }
}

function submitCase()
{
    var tracking_id = $("#tracking_id").val();

    $("#previous-btn").addClass('hide');
    $("#save-btns").addClass('hide');
    $("#upload-img").toggle();

    sendRequest(
        '/application/submit/'+tracking_id,
        {
            _token: $("#token").val(),
        },
        'application/x-www-form-urlencoded; charset=UTF-8',
        true,
        function(data, status)
        {
            result = JSON.parse(data);
            if (result.responseType != "success")
            {
                notify(result.responseType, result.message);
                setTimeout(() => { 
                    location.reload();
                }, 1500);
                return;
            }

            swal.fire(
                "Submitted!",
                "Your application has been submitted.",
                "success"
            ).then(function()
            {
                window.location.replace('/application/submitted/'+tracking_id);
            });
        },
        function(xhr, desc, err)
        {
            $("#previous-btn").removeClass('hide');
            $("#save-btns").removeClass('hide');
            $("#upload-img").toggle();
            notify(desc, err);
        }
    );
    return;
}
