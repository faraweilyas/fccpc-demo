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
                            startStep: $("#current-step").val(),
                            // to make steps clickable this set value true and add data-wizard-clickable="true" in HTML for class="wizard" element
                            clickableSteps: true,
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

        // _wizard.stop();
        // Don't go to the next step
    });

    // Change event
    _wizard.on('change', function (wizard) {

        if($("#application-documentation-section").is(":visible")){
            $("#save-info").html('Next');
        } else {
            $("#save-info").html('Save & Continue');
        }
        $("#current-step").val(wizard.currentStep);
        KTUtil.scrollTop();
    });


    if($("#application-documentation-section").is(":visible")){
        $("#save-info").html('Next');
    } else {
        $("#save-info").html('Save & Continue');
    }

    $("#review-application").on('click', function (event) {

        window.location.href = "/application/applicant/"+$(this).attr('data-id')+"/review/"+$("#current-step").val();
    });

    $("#review-deficient").on('click', function (event) {

        window.location.href = "/application/applicant/"+$(this).attr('data-id')+"/review-deficient/"+$("#current-step").val();
    });

    $("#save-info").on('click', function(event)
    {
        event.preventDefault();

        var currentStep = _wizard.getStep();
        _wizard.goTo(currentStep - 1);

        var sections    = $('.pb-5'),
            currentForm = sections.filter(function(index, element) {
                            return (typeof ($(element).attr('data-wizard-state')) !== "undefined")
                        }),
            sendForm    = 'save'+currentForm.attr('data-form');
            if (sendForm == "saveChecklistDocument" || sendForm == "saveDeficientChecklistDocument") {
                window[sendForm](myDropzone, sendForm, currentForm);
            } else {
                window[sendForm](sendForm, currentForm);
            }
        // _wizard.goNext();
        // KTUtil.scrollTop();
        return;
    });

    // Validate amount paid to be digits
    formatInputAmount($(".amount_paid"));

    $(document).on("focus keyup change", ".amount_paid", function()
    {
        formatInputAmount(this);
    });

    $("#save-transaction-info").on('click', function(event)
    {
        event.preventDefault();

        var sections    = $('.pb-5'),
            currentForm = sections.filter(function(index, element) {
                            return (typeof ($(element).attr('data-wizard-state')) !== "undefined")
                        }),
            sendForm    = 'save'+currentForm.attr('data-form');

        var tracking_id        = $("#tracking_id").val(),
            formData           = new FormData(),
            additional_info    = currentForm.find('#additional_info').val(),
            totalfiles         = myDropzone.getFiles().length,
            review_route       = $(this).attr('data-review-route'),
            application_fee    = currentForm.find("#application_fee").val(),
            processing_fee     = currentForm.find("#processing_fee").val(),
            expedited_fee      = currentForm.find("#expedited_fee").val(),
            amount_paid        = currentForm.find("#amount_paid").val(),
            group_id           = currentForm.find("#group_id").val(),
            doc_id             = currentForm.find("#doc_id").val();

        if (doc_id !== '' && totalfiles > 0) {
            swal.fire({
                title: "Are you sure?",
                text: "This would override your previous uploads for this section!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, override it!"
            }).then(function(result)
            {
                if (result.value){
                    $("#previous-btn").attr('disabled', 'disabled');
                    $("#save-transaction-info").toggle();
                    $("#saving-img").removeClass('hide');

                    if (application_fee == null)
                    {
                        application_fee = '';
                    }

                    if (processing_fee == null)
                    {
                        processing_fee = '';
                    }

                    if (expedited_fee == null)
                    {
                        expedited_fee = 0;
                    }

                    if (amount_paid == null)
                    {
                        amount_paid = '';
                    }

                    for (var index = 0; index < totalfiles; index++) {
                      formData.append("files[]", myDropzone.getFiles()[index]);
                    }
                    formData.append('_token', $("#token").val());
                    formData.append('additional_info', additional_info);
                    formData.append('document_id', doc_id);
                    formData.append('group_id', group_id);
                    formData.append('application_fee', application_fee);
                    formData.append('processing_fee', processing_fee);
                    formData.append('expedited_fee', expedited_fee);
                    formData.append('amount_paid', amount_paid);
                    sendRequest(
                        '/application/create/'+tracking_id+'/'+sendForm,
                        formData,
                        false,
                        false,
                        function(data, status)
                        {
                            result = JSON.parse(data);
                            currentForm.find("#doc_id").val(result.response.id);
                            notify(result.responseType, result.message);
                            $("#previous-btn").removeAttr('disabled');
                            $("#save-transaction-info").toggle();
                            $("#saving-img").addClass('hide');
                            if (result.responseType !== 'error'){
                                myDropzone.clearAll();
                                window.location.replace(review_route);
                            }
                        }
                    );
                } else {
                    myDropzone.clearAll();
                    window.location.replace(review_route);
                }
            });
        } else {
            $("#previous-btn").attr('disabled', 'disabled');
            $("#save-transaction-info").toggle();
            $("#saving-img").removeClass('hide');

            if (application_fee == null)
            {
                application_fee = '';
            }

            if (processing_fee == null)
            {
                processing_fee = '';
            }

            if (expedited_fee == null)
            {
                expedited_fee = 0;
            }

            if (amount_paid == null)
            {
                amount_paid = '';
            }

            for (var index = 0; index < totalfiles; index++) {
              formData.append("files[]", myDropzone.getFiles()[index]);
            }
            formData.append('_token', $("#token").val());
            formData.append('additional_info', additional_info);
            formData.append('document_id', doc_id);
            formData.append('group_id', group_id);
            formData.append('application_fee', application_fee);
            formData.append('processing_fee', processing_fee);
            formData.append('expedited_fee', expedited_fee);
            formData.append('amount_paid', amount_paid);
            sendRequest(
                '/application/create/'+tracking_id+'/'+sendForm,
                formData,
                false,
                false,
                function(data, status)
                {
                    result = JSON.parse(data);
                    currentForm.find("#doc_id").val(result.response.id);
                    notify(result.responseType, result.message);
                    $("#previous-btn").removeAttr('disabled');
                    $("#save-transaction-info").toggle();
                    $("#saving-img").addClass('hide');
                    if (result.responseType !== 'error'){
                        myDropzone.clearAll();
                        window.location.replace(review_route);
                    }
                }
            );
        }

        return;
    });

    $("#save-deficient-doc").on('click', function(event)
    {
        event.preventDefault();

        var sections    = $('.pb-5'),
            currentForm = sections.filter(function(index, element) {
                            return (typeof ($(element).attr('data-wizard-state')) !== "undefined")
                        }),
            sendForm    = 'save'+currentForm.attr('data-form');

        var tracking_id        = $("#tracking_id").val(),
            formData           = new FormData(),
            additional_info    = currentForm.find('#additional_info').val(),
            totalfiles         = myDropzone.getFiles().length,
            review_route       = $(this).attr('data-review-route'),
            application_fee    = currentForm.find("#application_fee").val(),
            processing_fee     = currentForm.find("#processing_fee").val(),
            expedited_fee      = currentForm.find("#expedited_fee").val(),
            amount_paid        = currentForm.find("#amount_paid").val(),
            group_id           = currentForm.find("#group_id").val(),
            doc_id             = currentForm.find("#doc_id").val();

        if (doc_id !== '' && totalfiles > 0) {
            swal.fire({
                title: "Are you sure?",
                text: "This would override your previous uploads for this section!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, override it!"
            }).then(function(result)
            {
                if (result.value){
                    $("#previous-btn").attr('disabled', 'disabled');
                    $("#save-deficient-doc").toggle();
                    $("#saving-img").removeClass('hide');

                    if (application_fee == null)
                    {
                        application_fee = '';
                    }

                    if (processing_fee == null)
                    {
                        processing_fee = '';
                    }

                    if (expedited_fee == null)
                    {
                        expedited_fee = 0;
                    }

                    if (amount_paid == null)
                    {
                        amount_paid = '';
                    }

                    for (var index = 0; index < totalfiles; index++) {
                      formData.append("files[]", myDropzone.getFiles()[index]);
                    }

                    formData.append('_token', $("#token").val());
                    formData.append('additional_info', additional_info);
                    formData.append('document_id', doc_id);
                    formData.append('group_id', group_id);
                    formData.append('application_fee', application_fee);
                    formData.append('processing_fee', processing_fee);
                    formData.append('expedited_fee', expedited_fee);
                    formData.append('amount_paid', amount_paid);
                    sendRequest(
                        '/application/create/'+tracking_id+'/'+sendForm,
                        formData,
                        false,
                        false,
                        function(data, status)
                        {
                            result = JSON.parse(data);
                            currentForm.find("#doc_id").val(result.response.id);
                            notify(result.responseType, result.message);
                            $("#previous-btn").removeAttr('disabled');
                            $("#save-deficient-doc").toggle();
                            $("#saving-img").addClass('hide');
                            if (result.responseType !== 'error'){
                                myDropzone.clearAll();
                                window.location.replace(review_route);
                            }
                        }
                    );
                } else {
                    myDropzone.clearAll();
                    window.location.replace(review_route);
                }
            });
        } else {
            $("#previous-btn").attr('disabled', 'disabled');
            $("#save-deficient-doc").toggle();
            $("#saving-img").removeClass('hide');

            if (application_fee == null)
            {
                application_fee = '';
            }

            if (processing_fee == null)
            {
                processing_fee = '';
            }

            if (expedited_fee == null)
            {
                expedited_fee = 0;
            }

            if (amount_paid == null)
            {
                amount_paid = '';
            }

            for (var index = 0; index < totalfiles; index++) {
              formData.append("files[]", myDropzone.getFiles()[index]);
            }

            formData.append('_token', $("#token").val());
            formData.append('additional_info', additional_info);
            formData.append('document_id', doc_id);
            formData.append('group_id', group_id);
            formData.append('application_fee', application_fee);
            formData.append('processing_fee', processing_fee);
            formData.append('expedited_fee', expedited_fee);
            formData.append('amount_paid', amount_paid);
            sendRequest(
                '/application/create/'+tracking_id+'/'+sendForm,
                formData,
                false,
                false,
                function(data, status)
                {
                    result = JSON.parse(data);
                    currentForm.find("#doc_id").val(result.response.id);
                    notify(result.responseType, result.message);
                    $("#previous-btn").removeAttr('disabled');
                    $("#save-deficient-doc").toggle();
                    $("#saving-img").addClass('hide');
                    if (result.responseType !== 'error'){
                        myDropzone.clearAll();
                        window.location.replace(review_route);
                    }
                }
            );
        }
        return;
    });

    $(".checklist_doc").on('change', function(event)
    {
        var files    = $(this).prop("files")
        var names    = $.map(files, function (val) { return val.name; });
        var doc_name = $(this).attr('data-doc-name');
        $("#"+doc_name).empty();
        $.each(names, function (i, name) {
            $("#"+doc_name).append('<p class="document-uploaded my-1">'+name+'</p>')
        });
    });

    $("#upload-info").on('click', function(event)
    {
        event.preventDefault();
        // var declaration_name = $("#declaration_name").val(),
        //     declaration_rep  = $("#declaration_rep").val();

        // if (declaration_name == '' || declaration_rep == '')
        // {
        //     toastr.error("Please provide your name and representing firm");
        //     return;
        // }

        swal.fire({
            title: "Are you sure?",
            text: "Notification becomes irreversible upon submission",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Submit"
        }).then(function(result)
        {
            if (result.value)
                submitCase();
            else
                return false;
        });
    });

    $("#upload-deficient-info").on('click', function(event)
    {
        event.preventDefault();

        swal.fire({
            title: "Are you sure?",
            text: "Notification becomes irreversible upon submission",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Submit"
        }).then(function(result)
        {
            if (result.value)
                submitDeficientCase();
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
                                            '<input type="text" class="form-control" placeholder="" name="party[]">'+
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
            $(this).closest('.field-item').fadeOut();
            fieldsCounter--;
        }

        return false;
    });

    $("#save-form1A-info").on('click', function (event) {
        var name        = $("#form1a_declaration_name").val(),
            position    = $("#form1a_declaration_position").val(),
            form_text   = $(".form1a_declaration_text").val();

        if (isGreaterThan500Words(".form1a_declaration_text"))
        {
            notify("error", "Text cannot exceed 500 words.");
            return;
        }

        if (name !== '' && position !== '') {
            var tracking_id            = $("#tracking_id").val(),
                formData               = new FormData();


            $("#save-form1A-info").toggle();
            $("#save-form1A-upload-img").removeClass('hide');

            formData.append('_token',                 $("#token").val());
            formData.append('form_text',              form_text);
            formData.append('name',                   name);
            formData.append('position',               position);

            sendRequest(
                '/application/create/'+tracking_id+'/saveForm1AInfo',
                formData,
                false,
                false,
                function(data, status)
            {
                result = JSON.parse(data);
                notify(result.responseType, result.message);
                $("#save-form1A-info").toggle();
                $("#save-form1A-upload-img").addClass('hide');
                $('#form1ADeclarationModal').modal('hide');
                if (result.responseType !== 'error'){
                     _wizard.goNext();
                    KTUtil.scrollTop();
                }
            });

        } else {
            notify('error', 'Provide input fields!');
        }

        return;
    });
});

function formatInputAmount(inputAmount)
{
    $(inputAmount).each(function(index)
    {
        let validatedAmount = Number(allowNumbers($(this).val())),
            formatter       = new Intl.NumberFormat('en-US');

        $(this).val((validatedAmount < 1) ? '' : formatter.format(validatedAmount));
    });
}

function notify(messageType, message)
{
    if (messageType == "success")
        toastr.success(message);

    if (messageType == "error")
        toastr.error(message);

    if (messageType == "warning")
        toastr.warning(message);

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
        $("#previous-btn").removeAttr('disabled');
        $("#save-info").toggle();
        $("#saving-img").addClass('hide');
        if (result.responseType === 'error'){
            $("#save-info").html('Save & Continue');
        }

        if (result.responseType !== 'error'){
             _wizard.goNext();
            KTUtil.scrollTop();
        }
    },
    onError = function(xhr, desc, err)
    {
        notify(desc, err);
        $("#previous-btn").removeAttr('disabled');
        $("#save-info").toggle();
        $("#save-transaction-info").removeClass('hide');
        $("#saving-img").addClass('hide');
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

function isGreaterThan500Words(elem)
{
    var wordsLength = $(elem).val().split(' ').length;
    // alert(wordsLength);
    console.log(wordsLength);
    return (wordsLength > 500) ? true : false;
}

function saveForm1AInfo(action, currentForm)
{
    if ($(".form1a_declaration_text").val() == '')
    {
        notify('error', 'Input field cannot be empty!');
        return;
    }

    if (isGreaterThan500Words(".form1a_declaration_text"))
    {
        notify('error', 'Text cannot exceed 500 words.');
        return;
    }

    $('#form1ADeclarationModal').modal('show');
}

function saveCaseInfo(action, currentForm)
{
    var tracking_id = $("#tracking_id").val(),
        case_type   = $("input[name='case_type']:checked").val();

    $("#save-info").toggle();
    $("#saving-img").removeClass('hide');

    sendRequest(
        '/application/create/'+tracking_id+'/'+action,
        {
            _token:         $("#token").val(),
            subject:        $("#subject").val(),
            parties:        $("input[name='party[]']").map(function()
                            {
                                return $(this).val();
                            }).get().filter(function(party)
                            {
                                return party != "";
                            }),
            case_type:      (typeof (case_type) === "undefined") ? '' : case_type,
        }
    );
    return;
}

function saveContactInfo(action, currentForm)
{
    var tracking_id            = $("#tracking_id").val(),
        formData               = new FormData();

    $("#previous-btn").attr('disabled', 'disabled');
    $("#save-info").toggle();
    $("#saving-img").removeClass('hide');

    formData.append('_token',                 $("#token").val());
    formData.append('applicant_firm',         $("input[name='applicant_firm']").val());
    formData.append('applicant_fullname',     $("input[name='applicant_fullname']").val());
    formData.append('applicant_email',        $("input[name='applicant_email']").val());
    formData.append('applicant_phone_number', $("input[name='applicant_phone_number']").val());
    formData.append('applicant_address',      $("input[name='applicant_address']").val());

    sendRequest(
        '/application/create/'+tracking_id+'/'+action,
        formData,
        false,
        false
    );
    return;
}

function saveChecklistDocument(myDropzone, action, currentForm)
{
    var tracking_id        = $("#tracking_id").val(),
        formData           = new FormData(),
        additional_info    = currentForm.find('#additional_info').val(),
        totalfiles         = myDropzone.getFiles().length,
        application_fee    = currentForm.find("#application_fee").val(),
        processing_fee     = currentForm.find("#processing_fee").val(),
        expedited_fee      = currentForm.find("#expedited_fee").val(),
        amount_paid        = currentForm.find("#amount_paid").val(),
        group_id           = currentForm.find("#group_id").val(),
        doc_id             = currentForm.find("#doc_id").val();

        if (doc_id !== '' && totalfiles > 0) {
            swal.fire({
                title: "Are you sure?",
                text: "This would override your previous uploads for this section!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, override it!"
            }).then(function(result)
            {
                if (result.value){
                    $("#previous-btn").attr('disabled', 'disabled');
                    $("#save-info").toggle();
                    $("#saving-img").removeClass('hide');

                    if (application_fee == null)
                    {
                        application_fee = '';
                    }

                    if (processing_fee == null)
                    {
                        processing_fee = '';
                    }

                    if (expedited_fee == null)
                    {
                        expedited_fee = 0;
                    }

                    if (amount_paid == null)
                    {
                        amount_paid = '';
                    }

                    for (var index = 0; index < totalfiles; index++) {
                      formData.append("files[]", myDropzone.getFiles()[index]);
                    }
                    formData.append('_token', $("#token").val());
                    formData.append('additional_info', additional_info);
                    formData.append('document_id', doc_id);
                    formData.append('group_id', group_id);
                    formData.append('application_fee', application_fee);
                    formData.append('processing_fee', processing_fee);
                    formData.append('expedited_fee', expedited_fee);
                    formData.append('amount_paid', amount_paid);
                    sendRequest(
                        '/application/create/'+tracking_id+'/'+action,
                        formData,
                        false,
                        false,
                        function(data, status)
                        {
                            result = JSON.parse(data);
                            currentForm.find("#doc_id").val(result.response.id);
                            notify(result.responseType, result.message);
                            $("#previous-btn").removeAttr('disabled');
                            $("#save-info").toggle();
                            $("#saving-img").addClass('hide');
                            if (result.responseType !== 'error'){
                                myDropzone.clearAll();
                                 _wizard.goNext();
                                KTUtil.scrollTop();
                            }
                        }
                    );
                } else {
                    myDropzone.clearAll();
                     _wizard.goNext();
                    KTUtil.scrollTop();
                    return;
                }
            });
        } else {
            $("#previous-btn").attr('disabled', 'disabled');
            $("#save-info").toggle();
            $("#saving-img").removeClass('hide');

            if (application_fee == null)
            {
                application_fee = '';
            }

            if (processing_fee == null)
            {
                processing_fee = '';
            }

            if (expedited_fee == null)
            {
                expedited_fee = 0;
            }

            if (amount_paid == null)
            {
                amount_paid = '';
            }

            for (var index = 0; index < totalfiles; index++) {
              formData.append("files[]", myDropzone.getFiles()[index]);
            }
            formData.append('_token', $("#token").val());
            formData.append('additional_info', additional_info);
            formData.append('document_id', doc_id);
            formData.append('group_id', group_id);
            formData.append('application_fee', application_fee);
            formData.append('processing_fee', processing_fee);
            formData.append('expedited_fee', expedited_fee);
            formData.append('amount_paid', amount_paid);
            sendRequest(
                '/application/create/'+tracking_id+'/'+action,
                formData,
                false,
                false,
                function(data, status)
                {
                    result = JSON.parse(data);
                    currentForm.find("#doc_id").val(result.response.id);
                    notify(result.responseType, result.message);
                    $("#previous-btn").removeAttr('disabled');
                    $("#save-info").toggle();
                    $("#saving-img").addClass('hide');
                    if (result.responseType !== 'error'){
                        myDropzone.clearAll();
                         _wizard.goNext();
                        KTUtil.scrollTop();
                    }
                }
            );
        }
    return;
}

function saveDeficientChecklistDocument(myDropzone, action, currentForm)
{
    var tracking_id        = $("#tracking_id").val(),
        formData           = new FormData(),
        additional_info    = currentForm.find('#additional_info').val(),
        totalfiles         = myDropzone.getFiles().length,
        application_fee    = currentForm.find("#application_fee").val(),
        processing_fee     = currentForm.find("#processing_fee").val(),
        expedited_fee      = currentForm.find("#expedited_fee").val(),
        amount_paid        = currentForm.find("#amount_paid").val(),
        group_id           = currentForm.find("#group_id").val(),
        doc_id             = currentForm.find("#doc_id").val();

    if (doc_id !== '' && totalfiles > 0) {
        swal.fire({
            title: "Are you sure?",
            text: "This would override your previous uploads for this section!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, override it!"
        }).then(function(result)
        {
            if (result.value){
                $("#previous-btn").attr('disabled', 'disabled');
                $("#save-info").toggle();
                $("#saving-img").removeClass('hide');

                if (application_fee == null)
                {
                    application_fee = '';
                }

                if (processing_fee == null)
                {
                    processing_fee = '';
                }

                if (expedited_fee == null)
                {
                    expedited_fee = 0;
                }

                if (amount_paid == null)
                {
                    amount_paid = '';
                }

                for (var index = 0; index < totalfiles; index++) {
                  formData.append("files[]", myDropzone.getFiles()[index]);
                }

                formData.append('_token', $("#token").val());
                formData.append('additional_info', additional_info);
                formData.append('document_id', doc_id);
                formData.append('group_id', group_id);
                formData.append('application_fee', application_fee);
                formData.append('processing_fee', processing_fee);
                formData.append('expedited_fee', expedited_fee);
                formData.append('amount_paid', amount_paid);
                sendRequest(
                    '/application/create/'+tracking_id+'/'+action,
                    formData,
                    false,
                    false,
                    function(data, status)
                    {
                        result = JSON.parse(data);
                        currentForm.find("#doc_id").val(result.response.id);
                        notify(result.responseType, result.message);
                        $("#previous-btn").removeAttr('disabled');
                        $("#save-info").toggle();
                        $("#saving-img").addClass('hide');
                        if (result.responseType !== 'error'){
                            myDropzone.clearAll();
                             _wizard.goNext();
                            KTUtil.scrollTop();
                        }
                    }
                );
            } else {
                myDropzone.clearAll();
                 _wizard.goNext();
                KTUtil.scrollTop();
                return;
            }
        });
    } else {
        $("#previous-btn").attr('disabled', 'disabled');
        $("#save-info").toggle();
        $("#saving-img").removeClass('hide');

        if (application_fee == null)
        {
            application_fee = '';
        }

        if (processing_fee == null)
        {
            processing_fee = '';
        }

        if (expedited_fee == null)
        {
            expedited_fee = 0;
        }

        if (amount_paid == null)
        {
            amount_paid = '';
        }

        for (var index = 0; index < totalfiles; index++) {
          formData.append("files[]", myDropzone.getFiles()[index]);
        }

        formData.append('_token', $("#token").val());
        formData.append('additional_info', additional_info);
        formData.append('document_id', doc_id);
        formData.append('group_id', group_id);
        formData.append('application_fee', application_fee);
        formData.append('processing_fee', processing_fee);
        formData.append('expedited_fee', expedited_fee);
        formData.append('amount_paid', amount_paid);
        sendRequest(
            '/application/create/'+tracking_id+'/'+action,
            formData,
            false,
            false,
            function(data, status)
            {
                result = JSON.parse(data);
                currentForm.find("#doc_id").val(result.response.id);
                notify(result.responseType, result.message);
                $("#previous-btn").removeAttr('disabled');
                $("#save-info").toggle();
                $("#saving-img").addClass('hide');
                if (result.responseType !== 'error'){
                    myDropzone.clearAll();
                     _wizard.goNext();
                    KTUtil.scrollTop();
                }
            }
        );
    }
    return;
}

function submitCase()
{
    var tracking_id      = $("#tracking_id").val(),
        declaration_name = $("#declaration_name").val(),
        declaration_rep  = $("#declaration_rep").val();

    $("#goback-btn").addClass('hide');
    $("#upload-info").addClass('hide');
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
                swal.fire(
                    "Not Submitted!",
                    result.message,
                    "error"
                );

                $("#goback-btn").removeClass('hide');
                $("#upload-info").removeClass('hide');
                $("#upload-img").toggle();
                return;
            }

            swal.fire(
                "Submitted!",
                "Your notification has been submitted. If complete and in an acceptable format, it shall be accepted as filed.",
                "success"
            ).then(function()
            {
                window.location.replace('/application/submitted/'+tracking_id);
            });
        },
        function(xhr, desc, err)
        {
            swal.fire(
                    "Not Submitted!",
                    err,
                    "error"
                );

            $("#goback-btn").removeClass('hide');
            $("#upload-info").removeClass('hide');
            $("#upload-img").toggle();
        }
    );
    return;
}


function submitDeficientCase()
{
    var tracking_id      = $("#tracking_id").val();

    $("#goback-btn").addClass('hide');
    $("#upload-deficient-info").addClass('hide');
    $("#upload-img").toggle();

    sendRequest(
        '/application/submit-deficient/'+tracking_id,
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
                swal.fire(
                    "Not Submitted!",
                    result.message,
                    "error"
                );

                $("#goback-btn").removeClass('hide');
                $("#upload-deficient-info").removeClass('hide');
                $("#upload-img").toggle();
                return;
            }

            swal.fire(
                "Submitted!",
                "Your notification has been submitted. if complete and in an acceptable format, it shall be accepted as filed",
                "success"
            ).then(function()
            {
                window.location.replace('/application/submitted/'+tracking_id);
            });
        },
        function(xhr, desc, err)
        {
            swal.fire(
                "Not Submitted!",
                err,
                "error"
            );

            $("#goback-btn").removeClass('hide');
            $("#upload-deficient-info").removeClass('hide');
            $("#upload-img").toggle();
        }
    );
    return;
}
