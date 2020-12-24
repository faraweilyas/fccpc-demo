$(document).ready(function()
{
    // On first run validate type of transaction
    validateTypeOfTransaction($("#typeOfTransaction").val());
    // On first run hide/show expedited option based on transaction type and generate fee
    // validateEpeditedOption();
    $(document).on("change", "#typeOfTransaction", function()
    {
        let typeOfTransaction = $(this).val();

        validateTypeOfTransaction(typeOfTransaction);

        calculateAnnualTurnOver();

        if (typeOfTransaction == '') return;

        console.log(typeOfTransaction);

        // validateEpeditedOption();
        // generateFee($("#combinedTurnover"));
    });

    // Show application fee
    showApplicationFee();
    $(document).on("keyup change", "#parties_number", function()
    {
        showApplicationFee();
    });

    // Show expedited fee
    showExpeditedFee();
    $(document).on("change", "#expedited", function()
    {
        showExpeditedFee();
        // generateFee($("#combinedTurnover"));
    });

    // Format amount
    $(document).on("keyup change", "#purchase_consideration, #turnover_a, #turnover_b, #turnover_c", function()
    {
        formatAmount($(this));
    });

    // Validate combined turnover to be digits and generate fee
    // $(document).on("keyup change", "#combinedTurnover", function()
    // {
    //     let validatedAmount = castNumber($(this).val()),
    //         formatter       = new Intl.NumberFormat('en-US');

    //     $(this).val(formatter.format(validatedAmount));
    //     generateFee($(this));
    // });

    $(".transaction_category").on('click', function(event)
    {
        let transaction_category = $(this).val();

        if (transaction_category == 'domestic')
        {
            $("#turnover_a").parent().removeClass('hide');
            $("#turnover_b").parent().removeClass('hide');
            $("#turnover_c").parent().addClass('hide');
        }

        if (transaction_category == 'ffm')
        {
            $("#turnover_a").parent().addClass('hide');
            $("#turnover_b").parent().addClass('hide');
            $("#turnover_c").parent().removeClass('hide');
        }
    });

    // ...
    $(".localGuideline").on('click', function()
    {
        $("#localGuideline").removeClass('hide');
        $("#localGuideline").removeClass('show');
    });

    $(".close-localGuideline").on('click', function()
    {
        $("#localGuideline").addClass('hide');
        $("#localGuideline").removeClass('show');
    });

    $(".ffmGuideline").on('click', function()
    {
        $("#ffmGuideline").removeClass('hide');
        $("#ffmGuideline").removeClass('show');
    });

    $(".close-ffmGuideline").on('click', function()
    {
        $("#ffmGuideline").addClass('hide');
        $("#ffmGuideline").removeClass('show');
    });
});

function showApplicationFee()
{
    let parties_number  = $("#parties_number"),
        partiesAmount   = castNumber(parties_number.val()),
        applicationFee  = $(".applicationFee"),
        formatter       = new Intl.NumberFormat('en-US', {minimumFractionDigits: 2});

    if (partiesAmount < 1)
    {
        applicationFeeAmount = 0;
    } else {
        applicationFeeAmount = partiesAmount * 50000;
    }
    applicationFee.html("&#8358;"+formatter.format(applicationFeeAmount));
    return applicationFeeAmount;
}

function showExpeditedFee()
{
    let expedited           = $("#expedited"),
        expeditedFee        = $(".expeditedFee"),
        expeditedFeeAmount  = (expedited.is(":checked")) ? 10000000 : 0,
        formatter           = new Intl.NumberFormat('en-US', {minimumFractionDigits: 2});

    expeditedFee.html("&#8358;"+formatter.format(expeditedFeeAmount));
    return expeditedFeeAmount;
}

function validateTypeOfTransaction(typeOfTransaction)
{
    if (typeOfTransaction == 'ffx' || typeOfTransaction == '')
    {
        $('.transaction-category-section').addClass('hide');
    } else {
        $('.transaction-category-section').removeClass('hide');
    }
}

function calculateAnnualTurnOver()
{
    let annual_turnover         = $("#annual_turnover"),
        typeOfTransaction       = $("#typeOfTransaction").val(),
        purchase_consideration  = castNumber($("#purchase_consideration").val()),
        annualTurnoverAmount    = 0;

    if (typeOfTransaction == '') return;

    if (typeOfTransaction == 'local')
    {
        let turnover_a          = castNumber($("#turnover_a").val()),
            turnover_b          = castNumber($("#turnover_b").val()),
            combinedTurnover    = turnover_a + turnover_b;

        annualTurnoverAmount    = (purchase_consideration > combinedTurnover) ? purchase_consideration : combinedTurnover;
    }

    if (typeOfTransaction == 'ffm')
    {
        let turnover_c          = castNumber($("#turnover_c").val());
        annualTurnoverAmount    = (purchase_consideration > turnover_c) ? purchase_consideration : turnover_c;
    }

    if (typeOfTransaction == 'ffx')
    {
        annualTurnoverAmount = 2500000;
    }

    annual_turnover.val(annualTurnoverAmount);
    formatAmount(annual_turnover);
}

function castNumber(value)
{
    return Number(allowNumbers(value));
}

function formatAmount(amount)
{
    let validatedAmount = castNumber(amount.val()),
        formatter       = new Intl.NumberFormat('en-US');

    amount.val(formatter.format(validatedAmount));
}

function generateFee()
{
    let amount                  = castNumber($("#annual_turnover").val()),
        parties_number          = $("#parties_number"),
        expedited               = $("#expedited"),
        applicationFee          = $(".applicationFee"),
        processingFee           = $(".processingFee"),
        expeditedFee            = $(".expeditedFee"),
        totalAmount             = $(".totalAmount"),
        result                  = 50000,
        typeOfTransaction       = document.querySelector('#typeOfTransaction'),
        typeOfTransactionValue  = typeOfTransaction.options[typeOfTransaction.selectedIndex].value,
        formatter               = new Intl.NumberFormat('en-US', {minimumFractionDigits: 2});

    if (amount <= 0)
    {
        applicationFee.html("&#8358;0.00");
        processingFee.html("&#8358;0.00");
        expeditedFee.html("-");
        totalAmount.html("&#8358;0.00");
        return;
    }

    if (typeOfTransactionValue == "local")
    {
        if (amount >= 500000000 && amount <= 1000000000)
        {
            result += (0.3 / 100) * 500000000;
            secondAmount = amount - 500000000;
            result += (0.225 / 100) * secondAmount;
        }
        if (amount > 1000000000)
        {
            result += (0.3 / 100) * 500000000;
            result += (0.225 / 100) * 500000000;
            thirdAmount = amount - 1000000000;
            result += (0.15 / 100) * thirdAmount;
        }
        applicationFee.html("&#8358;50,000.00");
        processingFee.html("&#8358;"+formatter.format(result - 50000));
        expeditedFee.html("-");
        totalAmount.html("&#8358;"+formatter.format(result));
    }

    if (typeOfTransactionValue == "ffm")
    {
        if (amount >= 500000000 && amount < 1000000000)
        {
            result += 2000000;
        }
        if (amount >= 1000000000)
        {
            otherAmount = (0.1 / 100) * amount;
            result += (otherAmount > 3000000) ? otherAmount : 3000000;
        }
        applicationFee.html("&#8358;50,000.00");
        processingFee.html("&#8358;"+formatter.format(result - 50000));
        expeditedFee.html("-");
        totalAmount.html("&#8358;"+formatter.format(result));
    }

    if (typeOfTransactionValue == "ffx")
    {
        if (amount >= 500000000 && amount < 1000000000)
        {
            result += 2000000;
        }
        if (amount >= 1000000000)
        {
            otherAmount = (0.1 / 100) * amount;
            result += (otherAmount > 3000000) ? otherAmount : 3000000;
        }
        applicationFee.html("&#8358;50,000.00");
        processingFee.html("&#8358;"+formatter.format(result - 50000));
        expeditedFee.html("&#8358;"+formatter.format(5000000));
        result += 5000000;
        totalAmount.html("&#8358;"+formatter.format(result));
    }
}

// ...
function validateEpeditedOption()
{
    let localGuideline          = $(".localGuideline"),
        ffmGuideline            = $(".ffmGuideline"),
        typeOfTransaction       = document.querySelector('#typeOfTransaction'),
        typeOfTransactionValue  = typeOfTransaction.options[typeOfTransaction.selectedIndex].value;

    if (typeOfTransactionValue == "local")
    {
        localGuideline.fadeIn('fast');
        ffmGuideline.fadeOut('fast');
    }

    if (typeOfTransactionValue == "ffm")
    {
        localGuideline.fadeOut('fast');
        ffmGuideline.fadeIn('fast');
    }

    if (typeOfTransactionValue == "ffx")
    {
        localGuideline.fadeOut('fast');
        ffmGuideline.fadeIn('fast');
    }
}
