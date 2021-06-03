$(document).ready(function()
{
    // On first run validate type of transaction
    validateTypeOfTransaction($("#typeOfTransaction").val());
    $(document).on("change", "#typeOfTransaction", function()
    {
        let typeOfTransaction = $(this).val();

        validateTypeOfTransaction(typeOfTransaction);

        generateFee();
    });

    // Show application fee
    // getApplicationFee();
    $(document).on("keyup change", "#parties_number", function()
    {
        generateFee();
    });

    // Show expedited fee
    // getExpeditedFee();
    $(document).on("change", "#expedited", function()
    {
        generateFee();
    });

    // Format amount
    $(document).on("keyup change focus", "#purchase_consideration, #turnover_a, #turnover_b, #turnover_c", function()
    {
        formatAmount($(this));
        generateFee();
    });

    $(".transaction_category").on('click', function(event)
    {
        let transaction_category = $("input[name=transaction_category]:checked").val();

        generateFee();

        if (transaction_category == 'domestic')
        {
            $("#turnover_a").parent().removeClass('hide');
            $("#turnover_b").parent().removeClass('hide');
            $("#turnover_c").parent().addClass('hide');
            $("#annual_turnover").parent().removeClass('hide');
        }

        if (transaction_category == 'ffm')
        {
            $("#turnover_a").parent().addClass('hide');
            $("#turnover_b").parent().addClass('hide');
            $("#turnover_c").parent().removeClass('hide');
            $("#annual_turnover").parent().removeClass('hide');
        }

        if (transaction_category == 'ffx')
        {
            $("#annual_turnover").parent().addClass('hide');
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

function getApplicationFee()
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

function getExpeditedFee()
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
        $('.purchase_consideration').addClass('hide');
        $("#annual_turnover").parent().addClass('hide');
    } else {
        $('.transaction-category-section').removeClass('hide');
        $('.purchase_consideration').removeClass('hide');
        $("#annual_turnover").parent().removeClass('hide');
    }
}

function getAnnualTurnOver()
{
    let transaction_category    = $("input[name=transaction_category]:checked").val(),
        typeOfTransaction       = $("#typeOfTransaction").val(),
        annual_turnover         = $("#annual_turnover"),
        annualTurnoverAmount    = 0;

    if (transaction_category == 'domestic')
    {
        let turnover_a              = castNumber($("#turnover_a").val()),
            turnover_b              = castNumber($("#turnover_b").val());
            annualTurnoverAmount    = turnover_a + turnover_b;
    }

    if (transaction_category == 'ffm')
    {
        annualTurnoverAmount        = castNumber($("#turnover_c").val());
    }

    if (typeOfTransaction == 'ffx' || typeOfTransaction == '')
    {
        annualTurnoverAmount        = 0;
    }

    annual_turnover.val(annualTurnoverAmount);
    formatAmount(annual_turnover);
    return annualTurnoverAmount;
}

function getProcessingFee()
{
    let typeOfTransaction       = $("#typeOfTransaction").val(),
        annualTurnover          = getAnnualTurnOver(),
        purchaseConsideration   = castNumber($("#purchase_consideration").val()),
        processingFee           = $(".processingFee"),
        formatter               = new Intl.NumberFormat('en-US', {minimumFractionDigits: 2});

    let processingFeeAmount, purchaseConsiderationAmount, annualTurnoverAmount = 0;

    if (typeOfTransaction == 'local' || typeOfTransaction == 'ffm')
    {
        // generate purchase consideration
        purchaseConsiderationAmount     = calculatePurchaseConsideration(purchaseConsideration);
        // generate annual turnover
        annualTurnoverAmount            = calculateAnnualTurnover(annualTurnover);
        // calculate processing fee
        processingFeeAmount             = (purchaseConsiderationAmount > annualTurnoverAmount)
                                        ? purchaseConsiderationAmount
                                        : annualTurnoverAmount;
    }

    if (typeOfTransaction == 'ffx')
    {
        processingFeeAmount     = 2500000;
    }

    // console.log(annualTurnover);
    // console.log(annualTurnoverAmount);
    // console.log(purchaseConsideration);
    // console.log(purchaseConsiderationAmount);
    // console.log(processingFeeAmount);

    processingFee.html("&#8358;"+formatter.format(processingFeeAmount));
    return processingFeeAmount;
}

function calculatePurchaseConsideration(purchase_consideration)
{
    let firstAmount, secondAmount, thirdAmount, result = 0;

    if (purchase_consideration >= 500000000)
    {
        result += firstAmount = (0.3 / 100) * 500000000;
        result += secondAmount = (0.225 / 100) * 500000000;
        thirdAmount = purchase_consideration - 1000000000;
        result += (0.15 / 100) * thirdAmount;
    }

    return result;
}

function calculateAnnualTurnover(annualTurnover)
{
    let firstAmount, secondAmount, thirdAmount, result = 0;

    if (annualTurnover >= 500000000)
    {
        result += firstAmount = (0.3 / 100) * 500000000;
        result += secondAmount = (0.225 / 100) * 500000000;
        thirdAmount = annualTurnover - 1000000000;
        result += (0.75 / 100) * thirdAmount;
    }

    return result;
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
    // console.log(getProcessingFee());

    let applicationFee  = getApplicationFee(),
        processingFee   = Number(getProcessingFee()),
        expeditedFee    = getExpeditedFee(),
        totalAmount     = $(".totalAmount"),
        result          = 0,
        formatter       = new Intl.NumberFormat('en-US', {minimumFractionDigits: 2});

    result = applicationFee + processingFee + expeditedFee;
    totalAmount.html("&#8358;"+formatter.format(result));
    return result;
}
