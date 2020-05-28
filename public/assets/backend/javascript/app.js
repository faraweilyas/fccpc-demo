jQuery(document).ready(function($)
{
    $(".localGuideline").on('click', function() {
        $("#localGuideline").removeClass('hide');
        $("#localGuideline").removeClass('show');
    });

    $(".close-localGuideline").on('click', function() {
        $("#localGuideline").addClass('hide');
        $("#localGuideline").removeClass('show');
    });

    $(".ffmGuideline").on('click', function() {
        $("#ffmGuideline").removeClass('hide');
        $("#ffmGuideline").removeClass('show');
    });

    $(".close-ffmGuideline").on('click', function() {
        $("#ffmGuideline").addClass('hide');
        $("#ffmGuideline").removeClass('show');
    });
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

    function generateFee(combinedTurnover)
    {
        let amount                  = Number(allowNumbers(combinedTurnover.val())),
            fillingFee              = $(".fillingFee"),
            processingFee           = $(".processingFee"),
            expeditedFee            = $(".expeditedFee"),
            totalAmount             = $(".totalAmount"),
            expedited               = $("#expedited"),
            result                  = 50000,
            typeOfTransaction       = document.querySelector('#typeOfTransaction'),
            typeOfTransactionValue  = typeOfTransaction.options[typeOfTransaction.selectedIndex].value,
            formatter               = new Intl.NumberFormat('en-US', {minimumFractionDigits: 2});

        if (amount <= 0)
        {
            fillingFee.html("&#8358;0.00");
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
            fillingFee.html("&#8358;50,000.00");
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
            fillingFee.html("&#8358;50,000.00");
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
            fillingFee.html("&#8358;50,000.00");
            processingFee.html("&#8358;"+formatter.format(result - 50000));
                expeditedFee.html("&#8358;"+formatter.format(5000000));
                result += 5000000;
            totalAmount.html("&#8358;"+formatter.format(result));
        }
    }

    // on first run Hide/show expedited option based on transaction type and generate fee
    validateEpeditedOption();
    // Hide/show expedited option based on transaction type and generate fee
    $(document).on("change", "#typeOfTransaction", function()
    {
        validateEpeditedOption();
        generateFee($("#combinedTurnover"));
    });

    // Validate combined turn over to be digits and generate fee
    $(document).on("keyup change", "#combinedTurnover", function()
    {
        let validatedAmount = Number(allowNumbers($(this).val())),
            formatter       = new Intl.NumberFormat('en-US');

        $(this).val(formatter.format(validatedAmount));
        generateFee($(this));
    });

    // Onchange of expedited generate fee
    $(document).on("change", "#expedited", function()
    {
        generateFee($("#combinedTurnover"));
    });
});