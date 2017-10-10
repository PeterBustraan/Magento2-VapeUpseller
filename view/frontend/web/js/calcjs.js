function main($, AjaxUrl) {
    let ajax_url = AjaxUrl;
        $("#primaryButton").click( function()
        {
            OhmsLaw()
        });

        $(".calcReset").click(function () {
            clearField("#" + $(this).data("field"))
        });
        
        $(".error-explainer").click(function () {
            $(this).hide();
        });

        $(".ohmLaws > input").keyup(function() {
            validate($(this).val(),this);
        })

    function OhmsLaw() {
        let details =
            {
                'ajax'  : '1',
                'volts' : $("#volts").val(),
                'amps'  : $("#amps").val(),
                'ohms'  : $("#ohms").val(),
                'watts' : $("#watts").val()
            };
        $.ajax({
            url:ajax_url,
            type: 'POST',
            data: details,
            dataType: 'json'
        }).done(function (data){
            $("#volts").val(data.volts)
            $("#amps").val(data.amps)
            $("#ohms").val(data.ohms)
            $("#watts").val(data.watts)
        })
    }

    function validate(value,field) {
        if (isNaN(value)) {
            showError(field)
        }else {
            hideError(field)
        }
    }

    function showError(field) {
        $(field).closest(".ohmLaws").find(".error-explainer").show();
    }

    function hideError(field) {
        $(field).closest(".ohmLaws").find(".error-explainer").hide();
    }

    function clearField(field) {
        $(field).val('0.0');
    }

};